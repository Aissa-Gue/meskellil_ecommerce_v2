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
            const name = checkbox.name.match(/filter\[([^\]]+)\]/)[1];
            if (!filters[name]) {
                filters[name] = [];
            }
            if (Array.isArray(filters[name])) {
                filters[name].push(checkbox.value);
            } else {
                filters[name] = [filters[name], checkbox.value];
            }
        });

        // Collect price range
        const priceSlider = document.getElementById('slider-range');
        if (priceSlider && typeof $ !== 'undefined' && $.ui) {
            const values = $(priceSlider).slider('values');
            if (values) {
                filters.price1_min = values[0];
                filters.price1_max = values[1];
            }
        }

        return filters;
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
        });

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

    showError(message) {
        // You can implement a toast notification or alert here
        console.error(message);
    }

    reinitializeProductScripts() {
        // Reinitialize any product-specific JavaScript like tooltips, quick view, etc.
        // This depends on your existing product scripts
        if (typeof initializeProductTooltips === 'function') {
            initializeProductTooltips();
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new ProductFilters();
});
