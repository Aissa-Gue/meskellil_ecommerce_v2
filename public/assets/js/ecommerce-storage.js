/**
 * E-commerce Storage Management
 * Handles wishlist, cart, currency, and language using both cookies and localStorage
 */

class EcommerceStorage {
    constructor() {
        this.cookieExpiry = 365; // days
        this.storageKeys = {
            wishlist: 'meskellil_wishlist',
            cart: 'meskellil_cart',
            currency: 'meskellil_currency',
            language: 'meskellil_language'
        };

        this.defaults = {
            currency: 'DZD',
            language: 'English'
        };

        this.init();
    }

    init() {
        console.log('EcommerceStorage initializing...');
        this.loadFromStorage();
        this.updateUI();
        this.bindEvents();
        console.log('EcommerceStorage initialized successfully');
    }

    // ==================== COOKIE METHODS ====================

    setCookie(name, value, days = this.cookieExpiry) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${JSON.stringify(value)};expires=${expires.toUTCString()};path=/`;
    }

    getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) {
                try {
                    return JSON.parse(c.substring(nameEQ.length, c.length));
                } catch (e) {
                    return c.substring(nameEQ.length, c.length);
                }
            }
        }
        return null;
    }

    deleteCookie(name) {
        document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;`;
    }

    // ==================== LOCAL STORAGE METHODS ====================

    setLocalStorage(key, value) {
        try {
            localStorage.setItem(key, JSON.stringify(value));
        } catch (e) {
            console.error('Error saving to localStorage:', e);
        }
    }

    getLocalStorage(key) {
        try {
            const item = localStorage.getItem(key);
            return item ? JSON.parse(item) : null;
        } catch (e) {
            console.error('Error reading from localStorage:', e);
            return null;
        }
    }

    deleteLocalStorage(key) {
        try {
            localStorage.removeItem(key);
        } catch (e) {
            console.error('Error deleting from localStorage:', e);
        }
    }

    // ==================== DUAL STORAGE METHODS ====================

    setItem(key, value) {
        this.setCookie(key, value);
        this.setLocalStorage(key, value);
    }

    getItem(key) {
        // Try localStorage first, then cookie
        let value = this.getLocalStorage(key);
        if (value === null) {
            value = this.getCookie(key);
            // If found in cookie but not localStorage, sync it
            if (value !== null) {
                this.setLocalStorage(key, value);
            }
        }
        return value;
    }

    deleteItem(key) {
        this.deleteCookie(key);
        this.deleteLocalStorage(key);
    }

    // ==================== WISHLIST METHODS ====================

    addToWishlist(product) {
        const wishlist = this.getWishlist();
        const existingIndex = wishlist.findIndex(item => item.id === product.id);

        if (existingIndex === -1) {
            wishlist.push({
                id: product.id,
                name: product.name,
                price: product.price,
                image: product.image,
                added_at: new Date().toISOString()
            });
            this.setItem(this.storageKeys.wishlist, wishlist);
            this.updateWishlistUI();
            this.showNotification('Product added to wishlist!', 'success');
            return true;
        } else {
            this.showNotification('Product already in wishlist!', 'info');
            return false;
        }
    }

    removeFromWishlist(productId) {
        const wishlist = this.getWishlist();
        const filteredWishlist = wishlist.filter(item => item.id !== productId);
        this.setItem(this.storageKeys.wishlist, filteredWishlist);
        this.updateWishlistUI();
        this.showNotification('Product removed from wishlist!', 'success');
    }

    getWishlist() {
        return this.getItem(this.storageKeys.wishlist) || [];
    }

    isInWishlist(productId) {
        const wishlist = this.getWishlist();
        return wishlist.some(item => item.id === productId);
    }

    // ==================== CART METHODS ====================

    addToCart(product) {
        const cart = this.getCart();
        const existingItem = cart.find(item => item.id === product.id);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                ...product,
                quantity: 1,
                added_at: new Date().toISOString()
            });
        }

        this.setItem(this.storageKeys.cart, cart);
        this.updateCartUI();
        this.showNotification('Product added to cart!', 'success');
    }

    removeFromCart(productId) {
        const cart = this.getCart();
        const updatedCart = cart.filter(item => item.id !== productId);
        this.setItem(this.storageKeys.cart, updatedCart);
        this.updateCartUI();
        this.showNotification('Product removed from cart!', 'info');
    }

    updateCartQuantity(productId, quantity) {
        const cart = this.getCart();
        const item = cart.find(item => item.id === productId);

        if (item) {
            if (quantity <= 0) {
                this.removeFromCart(productId);
            } else {
                item.quantity = quantity;
                this.setItem(this.storageKeys.cart, cart);
                this.updateCartUI();
            }
        }
    }

    getCart() {
        return this.getItem(this.storageKeys.cart) || [];
    }

    getCartCount() {
        const cart = this.getCart();
        return cart.reduce((total, item) => total + item.quantity, 0);
    }

    getCartTotal() {
        const cart = this.getCart();
        return cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    }

    clearCart() {
        this.setItem(this.storageKeys.cart, []);
        this.updateCartUI();
        this.showNotification('Cart cleared!', 'info');
    }

    // ==================== CURRENCY METHODS ====================

    setCurrency(currency) {
        this.setItem(this.storageKeys.currency, currency);
        this.updateCurrencyUI();
        this.showNotification(`Currency changed to ${currency}!`, 'success');
    }

    getCurrency() {
        return this.getItem(this.storageKeys.currency) || this.defaults.currency;
    }

    // ==================== LANGUAGE METHODS ====================

    setLanguage(language) {
        this.setItem(this.storageKeys.language, language);
        this.updateLanguageUI();
        this.showNotification(`Language changed to ${language}!`, 'success');
    }

    getLanguage() {
        return this.getItem(this.storageKeys.language) || this.defaults.language;
    }

    // ==================== UI UPDATE METHODS ====================

    updateWishlistUI() {
        const wishlist = this.getWishlist();
        const wishlistCount = wishlist.length;

        // Update wishlist count in header
        const wishlistBadges = document.querySelectorAll('.tp-header-action-badge');
        wishlistBadges.forEach(badge => {
            if (badge.closest('.tp-header-action-item') &&
                badge.closest('.tp-header-action-item').querySelector('a[href="/wishlist"]')) {
                badge.textContent = wishlistCount;
            }
        });

        // Update wishlist buttons
        document.querySelectorAll('.tp-product-add-to-wishlist-btn').forEach(btn => {
            const productId = btn.getAttribute('data-product-id');
            if (productId) {
                if (this.isInWishlist(parseInt(productId))) {
                    btn.classList.add('btn-danger');
                    btn.classList.remove('btn-outline-danger');
                    btn.setAttribute('title', 'Remove from Wishlist');
                } else {
                    btn.classList.remove('btn-danger');
                    btn.classList.add('btn-outline-danger');
                    btn.setAttribute('title', 'Add to Wishlist');
                }
            }
        });
    }

    updateCartUI() {
        const cartCount = this.getCartCount();

        // Update cart count in header
        const cartBadges = document.querySelectorAll('.tp-header-action-badge');
        cartBadges.forEach(badge => {
            if (badge.closest('.tp-header-action-item') &&
                badge.closest('.tp-header-action-item').querySelector('.cartmini-open-btn')) {
                badge.textContent = cartCount;
            }
        });

        // Update cart buttons (regular and large)
        document.querySelectorAll('.tp-product-add-cart-btn, .tp-product-add-cart-btn-large').forEach(btn => {
            const productId = btn.getAttribute('data-product-id');
            if (productId) {
                const cart = this.getCart();
                const cartItem = cart.find(item => item.id === parseInt(productId));
                if (cartItem) {
                    if (btn.classList.contains('tp-product-add-cart-btn-large')) {
                        btn.classList.add('btn-success');
                        btn.classList.remove('btn-primary');
                    } else {
                        btn.classList.add('btn-success');
                        btn.classList.remove('btn-primary');
                    }
                    btn.setAttribute('title', `In Cart (${cartItem.quantity})`);
                } else {
                    if (btn.classList.contains('tp-product-add-cart-btn-large')) {
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-primary');
                    } else {
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-primary');
                    }
                    btn.setAttribute('title', 'Add to Cart');
                }
            }
        });
    }

    updateCurrencyUI() {
        const currency = this.getCurrency();

        // Update currency toggles
        document.querySelectorAll('.tp-header-currency-toggle, .offcanvas__currency-selected-currency').forEach(toggle => {
            toggle.textContent = currency;
        });
    }

    updateLanguageUI() {
        const language = this.getLanguage();

        // Update language toggles
        document.querySelectorAll('.tp-header-lang-toggle, .offcanvas__lang-selected-lang').forEach(toggle => {
            toggle.textContent = language;
        });
    }

    updateUI() {
        this.updateWishlistUI();
        this.updateCartUI();
        this.updateCurrencyUI();
        this.updateLanguageUI();
    }

    // ==================== LOAD FROM STORAGE ====================

    loadFromStorage() {
        // Load all data from storage on page load
        const wishlist = this.getItem(this.storageKeys.wishlist);
        const cart = this.getItem(this.storageKeys.cart);
        const currency = this.getItem(this.storageKeys.currency);
        const language = this.getItem(this.storageKeys.language);

        // Set defaults if not found
        if (!currency) this.setItem(this.storageKeys.currency, this.defaults.currency);
        if (!language) this.setItem(this.storageKeys.language, this.defaults.language);
        if (!wishlist) this.setItem(this.storageKeys.wishlist, []);
        if (!cart) this.setItem(this.storageKeys.cart, []);
    }

    // ==================== EVENT BINDING ====================

    bindEvents() {
        // Wishlist buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.tp-product-add-to-wishlist-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.tp-product-add-to-wishlist-btn');
                const productId = btn.getAttribute('data-product-id');

                if (productId) {
                    if (this.isInWishlist(parseInt(productId))) {
                        this.removeFromWishlist(parseInt(productId));
                    } else {
                        const product = this.getProductData(btn);
                        this.addToWishlist(product);
                    }
                }
            }
        });

        // Add to cart buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.tp-product-add-cart-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.tp-product-add-cart-btn');
                const productId = btn.getAttribute('data-product-id');

                if (productId) {
                    const product = this.getProductData(btn);
                    this.addToCart(product);
                }
            }
        });

        // Currency toggles
        document.addEventListener('click', (e) => {
            if (e.target.closest('.tp-header-currency-toggle, .offcanvas__currency-selected-currency')) {
                const toggle = e.target.closest('.tp-header-currency-toggle, .offcanvas__currency-selected-currency');
                const currencyList = toggle.nextElementSibling;
                if (currencyList && currencyList.tagName === 'UL') {
                    currencyList.style.display = currencyList.style.display === 'block' ? 'none' : 'block';
                }
            }
        });

        // Language toggles
        document.addEventListener('click', (e) => {
            if (e.target.closest('.tp-header-lang-toggle, .offcanvas__lang-selected-lang')) {
                const toggle = e.target.closest('.tp-header-lang-toggle, .offcanvas__lang-selected-lang');
                const languageList = toggle.nextElementSibling;
                if (languageList && languageList.tagName === 'UL') {
                    languageList.style.display = languageList.style.display === 'block' ? 'none' : 'block';
                }
            }
        });

        // Currency selection
        document.addEventListener('click', (e) => {
            if (e.target.closest('.tp-header-currency-list li, .offcanvas__currency-list li')) {
                const currency = e.target.textContent.trim();
                this.setCurrency(currency);

                // Hide dropdown
                const dropdown = e.target.closest('ul');
                if (dropdown) dropdown.style.display = 'none';
            }
        });

        // Language selection
        document.addEventListener('click', (e) => {
            if (e.target.closest('.tp-header-lang ul li, .offcanvas__lang-list li')) {
                const language = e.target.textContent.trim();
                this.setLanguage(language);

                // Hide dropdown
                const dropdown = e.target.closest('ul');
                if (dropdown) dropdown.style.display = 'none';
            }
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.tp-header-top-menu-item, .offcanvas__currency-wrapper, .offcanvas__select')) {
                document.querySelectorAll('.tp-header-top-menu ul, .offcanvas__currency-list, .offcanvas__lang-list').forEach(dropdown => {
                    dropdown.style.display = 'none';
                });
            }
        });
    }

    // ==================== UTILITY METHODS ====================

    getProductData(button) {
        const productItem = button.closest('.tp-product-item, .tp-product-item-3');
        if (!productItem) return null;

        const name = productItem.querySelector('.tp-product-title a, .tp-product-title-3 a')?.textContent.trim();
        const priceElement = productItem.querySelector('.tp-product-price, .tp-product-price-3');
        const price = this.extractPrice(priceElement);
        const image = productItem.querySelector('img')?.src;

        // Try to get ID from data attribute first, then generate from name
        let id = button.getAttribute('data-product-id');
        if (!id) {
            id = this.generateProductId(name);
        }

        return {
            id: parseInt(id),
            name: name || 'Unknown Product',
            price: price || 0,
            image: image || ''
        };
    }

    extractPrice(priceElement) {
        if (!priceElement) return 0;

        const priceText = priceElement.textContent.trim();
        const priceMatch = priceText.match(/[\d,]+\.?\d*/);
        if (priceMatch) {
            return parseFloat(priceMatch[0].replace(/,/g, ''));
        }
        return 0;
    }

    generateProductId(name) {
        return Math.abs(name.split('').reduce((a, b) => {
            a = ((a << 5) - a + b.charCodeAt(0)) & 0xffffffff;
            return a;
        }, 0));
    }

    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        const alertClass = type === 'success' ? 'alert-success' : type === 'error' ? 'alert-danger' : 'alert-info';
        notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        // Add Bootstrap styling
        notification.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 10000;
            max-width: 300px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        `;

        // Add to page
        document.body.appendChild(notification);

        // Auto remove after 3 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 3000);

        // Close button functionality
        notification.querySelector('.btn-close').addEventListener('click', () => {
            notification.remove();
        });


    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM ready, creating EcommerceStorage instance...');
    try {
        window.meskellilStorage = new EcommerceStorage();
        console.log('EcommerceStorage instance created and assigned to window.meskellilStorage');
    } catch (error) {
        console.error('Error creating EcommerceStorage:', error);
    }
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = EcommerceStorage;
}
