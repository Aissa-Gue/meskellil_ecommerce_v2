/**
 * Product Filtering System
 * Handles AJAX filtering for products page
 */
class ProductFilters {
    constructor() {
        this.filterForm = document.getElementById('product-filters-form');
        this.productsContainer = document.querySelector('.infinite-container');
        this.resultsInfo = document.querySelector('.tp-shop-top-result p');
        this.sortSelect = document.querySelector('.tp-shop-top-select select');
        this.currentPage = 1;
        this.isLoading = false;
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.initPriceSliders();
    }

    bindEvents() {
        // Filter form submission
        if (this.filterForm) {
            this.filterForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.applyFilters();
            });
        }

        // Checkbox filters
        document.addEventListener('change', (e) => {
            if (e.target.matches('input[type="checkbox"][name^="filter"]')) {
                this.applyFilters();
            }
        });

        // Category filter links
        document.addEventListener('click', (e) => {
            if (e.target.matches('.category-filter-link')) {
                e.preventDefault();
                this.filterByCategory(e.target.dataset.categoryId);
            }
        });

        // Price filter button
        document.addEventListener('click', (e) => {
            if (e.target.matches('.price-filter-btn')) {
                e.preventDefault();
                this.applyPriceFilter();
            }
        });

        // Sort change
        if (this.sortSelect) {
            this.sortSelect.addEventListener('change', () => {
                this.applyFilters();
            });
        }

        // Clear filters
        document.addEventListener('click', (e) => {
            if (e.target.matches('.clear-filters-btn')) {
                e.preventDefault();
                this.clearFilters();
            }
        });

        // Pagination links
        document.addEventListener('click', (e) => {
            if (e.target.closest('.tp-pagination a')) {
                e.preventDefault();
                const link = e.target.closest('a');
                const url = new URL(link.href);
                const page = url.searchParams.get('page') || 1;
                this.loadPage(page);
            }
        });
    }

    initPriceSliders() {
        // Initialize price sliders if jQuery UI is available
        if (typeof $ !== 'undefined' && $.ui) {
            const sliders = document.querySelectorAll('[id^="slider-range"]');
            sliders.forEach(slider => {
                const suffix = slider.id.replace('slider-range', '');
                const amountInput = document.getElementById('amount' + suffix);
                
                if (slider.dataset.initialized !== 'true') {
                    const minPrice = parseInt(slider.dataset.min) || 0;
                    const maxPrice = parseInt(slider.dataset.max) || 1000;
                    
                    $(slider).slider({
                        range: true,
                        min: minPrice,
                        max: maxPrice,
                        values: [minPrice, maxPrice],
                        slide: function(event, ui) {
                            if (amountInput) {
                                amountInput.value = `$${ui.values[0]} - $${ui.values[1]}`;
                            }
                        }
                    });
                    
                    if (amountInput) {
                        amountInput.value = `$${minPrice} - $${maxPrice}`;
                    }
                    
                    slider.dataset.initialized = 'true';
                }
            });
        }
    }

    applyFilters() {
        if (this.isLoading) return;
        
        this.isLoading = true;
        this.showLoading();
        
        const formData = new FormData();
        const filters = this.collectFilters();
        
        // Add filters to form data
        Object.keys(filters).forEach(key => {
            if (Array.isArray(filters[key])) {
                filters[key].forEach(value => {
                    formData.append(`filter[${key}][]`, value);
                });
            } else if (filters[key] !== null && filters[key] !== '') {
                formData.append(`filter[${key}]`, filters[key]);
            }
        });

        // Add sort parameter
        if (this.sortSelect && this.sortSelect.value) {
            formData.append('sort', this.getSortValue(this.sortSelect.value));
        }

        // Add AJAX header
        const headers = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        };

        fetch(window.location.pathname, {
            method: 'POST',
            body: formData,
            headers: headers
        })
        .then(response => response.json())
        .then(data => {
            this.updateProductsDisplay(data);
            this.updateUrl(filters);
        })
        .catch(error => {
            console.error('Filter error:', error);
            this.showError('An error occurred while filtering products.');
        })
        .finally(() => {
            this.isLoading = false;
            this.hideLoading();
        });
    }

    collectFilters() {
        const filters = {};
        
        // Collect checkbox filters
        document.querySelectorAll('input[type="checkbox"][name^="filter"]:checked').forEach(checkbox => {
            const name = checkbox.name.match(/filter\[([^\]]+)\]/)?.[1];
            if (name) {
                if (!filters[name]) filters[name] = [];
                filters[name].push(checkbox.value);
            }
        });

        // Collect price range
        const priceSliders = document.querySelectorAll('[id^="slider-range"]');
        priceSliders.forEach(slider => {
            if (typeof $ !== 'undefined' && $.ui && $(slider).slider('instance')) {
                const values = $(slider).slider('values');
                if (values && values.length === 2) {
                    filters.price_min = values[0];
                    filters.price_max = values[1];
                }
            }
        });

        return filters;
    }

    updateProductsDisplay(data) {
        // Update grid view
        const gridContainer = document.getElementById('products-container');
        if (gridContainer && data.html) {
            gridContainer.innerHTML = data.html;
        }

        // Update list view
        const listContainer = document.getElementById('products-list-container');
        if (listContainer && data.list_html) {
            listContainer.innerHTML = data.list_html;
        }

        // Update pagination
        const paginationContainer = document.getElementById('pagination-container');
        if (paginationContainer && data.pagination_html) {
            paginationContainer.innerHTML = data.pagination_html;
        }

        // Update results info
        const resultsContainer = document.querySelector('.tp-shop-top-result');
        if (resultsContainer && data.results_html) {
            resultsContainer.innerHTML = data.results_html;
        }

        // Reinitialize any product scripts
        this.reinitializeProductScripts();
    }

    getSortValue(sortText) {
        const sortMap = {
            'Default Sorting': 'default',
            'Low to Hight': 'price_asc',
            'High to Low': 'price_desc',
            'New Added': 'newest',
            'On Sale': 'discount'
        };
        return sortMap[sortText] || 'default';
    }

    filterByCategory(categoryId) {
        // Clear existing category filters
        document.querySelectorAll('input[name="filter[category_id][]"]').forEach(input => {
            input.checked = false;
        });

        // Set new category filter
        const categoryInput = document.querySelector(`input[name="filter[category_id][]"][value="${categoryId}"]`);
        if (categoryInput) {
            categoryInput.checked = true;
        }

        this.applyFilters();
    }

    applyPriceFilter() {
        this.applyFilters();
    }

    loadPage(page) {
        if (this.isLoading) return;
        
        this.isLoading = true;
        this.showLoading();
        
        const formData = new FormData();
        const filters = this.collectFilters();
        
        // Add filters to form data
        Object.keys(filters).forEach(key => {
            if (Array.isArray(filters[key])) {
                filters[key].forEach(value => {
                    formData.append(`filter[${key}][]`, value);
                });
            } else if (filters[key] !== null && filters[key] !== '') {
                formData.append(`filter[${key}]`, filters[key]);
            }
        });

        // Add sort parameter
        if (this.sortSelect && this.sortSelect.value) {
            formData.append('sort', this.getSortValue(this.sortSelect.value));
        }

        // Add page parameter
        formData.append('page', page);

        // Add AJAX header
        const headers = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        };

        fetch(window.location.pathname, {
            method: 'POST',
            body: formData,
            headers: headers
        })
        .then(response => response.json())
        .then(data => {
            this.updateProductsDisplay(data);
            this.updateUrlWithPage(filters, page);
        })
        .catch(error => {
            console.error('Pagination error:', error);
            this.showError('An error occurred while loading the page.');
        })
        .finally(() => {
            this.isLoading = false;
            this.hideLoading();
        });
    }

    updateUrl(filters) {
        const url = new URL(window.location);
        
        // Clear existing filter parameters
        Array.from(url.searchParams.keys()).forEach(key => {
            if (key.startsWith('filter[')) {
                url.searchParams.delete(key);
            }
        });

        // Add new filter parameters
        Object.keys(filters).forEach(key => {
            if (Array.isArray(filters[key])) {
                filters[key].forEach(value => {
                    url.searchParams.append(`filter[${key}][]`, value);
                });
            } else if (filters[key] !== null && filters[key] !== '') {
                url.searchParams.set(`filter[${key}]`, filters[key]);
            }
        });

        // Update URL without page reload
        window.history.pushState({}, '', url);
    }

    updateUrlWithPage(filters, page) {
        const url = new URL(window.location);
        
        // Clear existing filter parameters
        Array.from(url.searchParams.keys()).forEach(key => {
            if (key.startsWith('filter[') || key === 'sort' || key === 'page') {
                url.searchParams.delete(key);
            }
        });

        // Add current filters
        Object.keys(filters).forEach(key => {
            if (Array.isArray(filters[key])) {
                filters[key].forEach(value => {
                    url.searchParams.append(`filter[${key}][]`, value);
                });
            } else if (filters[key] !== null && filters[key] !== '') {
                url.searchParams.set(`filter[${key}]`, filters[key]);
            }
        });

        // Add page parameter
        if (page > 1) {
            url.searchParams.set('page', page);
        }

        // Update URL without page reload
        window.history.pushState({}, '', url);
    }

    clearFilters() {
        // Clear all checkboxes
        document.querySelectorAll('input[type="checkbox"][name^="filter"]').forEach(checkbox => {
            checkbox.checked = false;
        });

        // Reset price sliders
        if (typeof $ !== 'undefined' && $.ui) {
            document.querySelectorAll('[id^="slider-range"]').forEach(slider => {
                const minPrice = parseInt(slider.dataset.min) || 0;
                const maxPrice = parseInt(slider.dataset.max) || 1000;
                $(slider).slider('values', [minPrice, maxPrice]);
                
                const suffix = slider.id.replace('slider-range', '');
                const amountInput = document.getElementById('amount' + suffix);
                if (amountInput) {
                    amountInput.value = `$${minPrice} - $${maxPrice}`;
                }
            });
        }

        // Reset sort
        if (this.sortSelect) {
            this.sortSelect.selectedIndex = 0;
        }

        this.applyFilters();
    }

    showLoading() {
        if (this.productsContainer) {
            this.productsContainer.style.opacity = '0.5';
            this.productsContainer.style.pointerEvents = 'none';
        }
    }

    hideLoading() {
        if (this.productsContainer) {
            this.productsContainer.style.opacity = '1';
            this.productsContainer.style.pointerEvents = 'auto';
        }
    }

    showError(message) {
        console.error(message);
    }

    reinitializeProductScripts() {
        // Reinitialize any product-specific JavaScript like tooltips, quick view, etc.
        if (typeof initializeProductTooltips === 'function') {
            initializeProductTooltips();
        }
    }
}
