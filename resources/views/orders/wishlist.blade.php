@extends('layouts.app')

@section('content')

    @include('components.area.off-canvas-area')
    @include('components.area.mobile-menu-area')
    @include('components.search-area')
    @include('components.area.cart-mini-area')
    @include('components.area.general-header-area')


    <main>
        @include('components.breadcrumb2', $breadcrumbData)

        <!-- wishlist area start -->
        <section class="tp-wishlist-area pt-95 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tp-section-title-wrapper-6 text-center mb-40">
                            <span class="tp-section-title-pre-6">My Wishlist</span>
                            <h3 class="tp-section-title-6">Saved Products</h3>
                        </div>
                    </div>
                </div>

                <div class="row" id="wishlist-container">
                    <!-- Wishlist items will be populated by JavaScript -->
                    <div class="col-12 text-center" id="loading-message">
                        <p>Loading wishlist...</p>
                        <div class="mt-3">
                            <button class="tp-btn-2" onclick="testStorage()">Test Storage</button>
                            <button class="tp-btn-2 ml-2" onclick="addTestItem()">Add Test Item</button>
                        </div>
                    </div>
                </div>

                <div class="row" id="empty-wishlist" style="display: none;">
                    <div class="col-12 text-center">
                        <div class="tp-empty-wishlist">
                            <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#e3e3e0"/>
                            </svg>
                            <h4>Your wishlist is empty</h4>
                            <p>Start adding products to your wishlist to see them here!</p>
                            <a href="/" class="tp-btn-2">Continue Shopping</a>
                            <div class="mt-3">
                                <button class="tp-btn-2" onclick="addTestItem()">Add Test Item</button>
                                <button class="tp-btn-2 ml-2" onclick="refreshWishlist()">Refresh</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Manual test section -->
                <div class="row mt-4" id="manual-test-section">
                    <div class="col-12 text-center">
                        <h4>Manual Test Section</h4>
                        <p>Use these buttons to test the storage functionality:</p>
                        <div class="mt-3">
                            <button class="tp-btn-2" onclick="testStorage()">Test Storage</button>
                            <button class="tp-btn-2 ml-2" onclick="addTestItem()">Add Test Item</button>
                            <button class="tp-btn-2 ml-2" onclick="refreshWishlist()">Refresh</button>
                            <button class="tp-btn-2 ml-2" onclick="clearStorage()">Clear Storage</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- wishlist area end -->
    </main>

    @include('components.footer')

        <script>
    console.log('Wishlist script loaded');

    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded in wishlist script');
        // Initialize wishlist display
        console.log('DOM loaded, checking for storage...');
        console.log('window.meskellilStorage:', window.meskellilStorage);

    if (window.meskellilStorage) {
        console.log('Storage found, calling displayWishlist');
        displayWishlist();
            } else {
            console.log('Storage not found, waiting 1 second...');
            // Fallback if storage is not loaded
            setTimeout(() => {
                console.log('Timeout reached, checking again...');
                if (window.meskellilStorage) {
                    console.log('Storage now found, calling displayWishlist');
                    displayWishlist();
                } else {
                    console.log('Storage still not found');
                    // Show error message
                    const container = document.getElementById('wishlist-container');
                    const loadingMessage = document.getElementById('loading-message');
                    if (container && loadingMessage) {
                        loadingMessage.innerHTML = `
                            <div class="col-12 text-center">
                                <p class="text-danger">Storage system not available. Please refresh the page.</p>
                                <button class="tp-btn-2" onclick="location.reload()">Refresh Page</button>
                            </div>
                        `;
                        loadingMessage.style.display = 'block';
                    }
                }
            }, 1000);
        }

        function displayWishlist() {
            console.log('displayWishlist called');
            const wishlist = window.meskellilStorage ? window.meskellilStorage.getWishlist() : [];
            console.log('Wishlist data:', wishlist);
            const container = document.getElementById('wishlist-container');
            const emptyMessage = document.getElementById('empty-wishlist');
            const loadingMessage = document.getElementById('loading-message');
            console.log('Container:', container);
            console.log('Empty message:', emptyMessage);
            console.log('Loading message:', loadingMessage);

            // Hide loading message
            if (loadingMessage) {
                loadingMessage.style.display = 'none';
            }

            if (wishlist.length === 0) {
                container.style.display = 'none';
                emptyMessage.style.display = 'block';
                return;
            }

            container.style.display = 'flex';
            emptyMessage.style.display = 'none';

            container.innerHTML = wishlist.map(item => `
                <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
                    <div class="tp-product-item p-relative transition-3">
                        <div class="tp-product-thumb p-relative fix m-img">
                            <a href="#">
                                <img src="${item.image || '/assets/img/product/product-1.jpg'}" alt="${item.name}">
                            </a>

                            <!-- product action -->
                            <div class="tp-product-action">
                                <div class="tp-product-action-item d-flex flex-column">
                                    <button type="button" class="tp-product-action-btn tp-product-add-cart-btn"
                                            data-product-id="${item.id}">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.93795 5.34749L4.54095 12.5195C4.58495 13.0715 5.03594 13.4855 5.58695 13.4855H5.59095H16.5019H16.5039C17.0249 13.4855 17.4699 13.0975 17.5439 12.5825L18.4939 6.02349C18.5159 5.86749 18.4769 5.71149 18.3819 5.58549C18.2879 5.45849 18.1499 5.37649 17.9939 5.35449C17.7849 5.36249 9.11195 5.35049 3.93795 5.34749ZM4.58495 14.9855C4.26795 14.9855 3.15295 13.9575 3.04595 12.6425L2.12995 1.74849L0.622945 1.48849C0.213945 1.41649 -0.0590549 1.02949 0.0109451 0.620487C0.082945 0.211487 0.477945 -0.054513 0.877945 0.00948704L2.95795 0.369487C3.29295 0.428487 3.54795 0.706487 3.57695 1.04649L3.81194 3.84749C18.0879 3.85349 18.1339 3.86049 18.2029 3.86849C18.7599 3.94949 19.2499 4.24049 19.5839 4.68849C19.9179 5.13549 20.0579 5.68649 19.9779 6.23849L19.0289 12.7965C18.8499 14.0445 17.7659 14.9855 16.5059 14.9855H16.5009H5.59295H5.58495Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.8979 9.04382H12.1259C11.7109 9.04382 11.3759 8.70782 11.3759 8.29382C11.3759 7.87982 11.7109 7.54382 12.1259 7.54382H14.8979C15.3119 7.54382 15.6479 7.87982 15.6479 8.29382C15.6479 8.70782 15.3119 9.04382 14.8979 9.04382Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.15474 17.702C5.45574 17.702 5.69874 17.945 5.69874 18.246C5.69874 18.547 5.45574 18.791 5.15474 18.791C4.85274 18.791 4.60974 18.547 4.60974 18.246C4.60974 17.945 4.85274 17.702 5.15474 17.702Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.15374 18.0409C5.04074 18.0409 4.94874 18.1329 4.94874 18.2459C4.94874 18.4729 5.35974 18.4729 5.35974 18.2459C5.35974 18.1329 5.26674 18.0409 5.15374 18.0409ZM5.15374 19.5409C4.43974 19.5409 3.85974 18.9599 3.85974 18.2459C3.85974 17.5319 4.43974 16.9519 5.15374 16.9519C5.86774 16.9519 6.44874 17.5319 6.44874 18.2459C6.44874 18.9599 5.86774 19.5409 5.15374 19.5409Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.435 17.702C16.736 17.702 16.98 17.945 16.98 18.246C16.98 18.547 16.736 18.791 16.435 18.791C16.133 18.791 15.89 18.547 15.89 18.246C15.89 17.945 16.133 17.702 16.435 17.702Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.434 18.0409C16.322 18.0409 16.23 18.1329 16.23 18.2459C16.231 18.4749 16.641 18.4729 16.64 18.2459C16.64 18.1329 16.547 18.0409 16.434 18.0409ZM16.434 19.5409C15.72 19.5409 15.14 18.9599 15.14 18.2459C15.14 17.5319 15.72 16.9519 16.434 16.9519C17.149 16.9519 17.73 17.5319 17.73 18.2459C17.73 18.9599 17.149 19.5409 16.434 19.5409Z" fill="currentColor"/>
                                        </svg>
                                        <span class="tp-product-tooltip">Add to Cart</span>
                                    </button>
                                    <button type="button" class="tp-product-action-btn"
                                            data-product-id="${item.id}">
                                        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.78158 8.88867C3.15121 13.1386 8.5623 16.5749 10.0003 17.4255C11.4432 16.5662 16.8934 13.0918 18.219 8.89257C19.0894 6.17816 18.2815 2.73984 15.0714 1.70806C13.5162 1.21019 11.7021 1.5132 10.4497 2.4797C10.1879 2.68041 9.82446 2.68431 9.56069 2.48555C8.23405 1.49079 6.50102 1.19947 4.92136 1.70806C1.71613 2.73887 0.911158 6.17718 1.78158 8.88867ZM10.0013 19C9.88015 19 9.75999 18.9708 9.65058 18.9113C9.34481 18.7447 2.14207 14.7852 0.386569 9.33491C0.385592 8.38633C-0.71636 5.90244 0.510636 1.59018 4.47199 0.316764C6.33203 -0.283407 8.35911 -0.019371 9.99836 1.01242C11.5868 0.0108324 13.6969 -0.26587 15.5198 0.316764C19.4851 1.59213 20.716 5.90342 19.615 9.33394C17.9162 14.7218 10.6607 18.7408 10.353 18.9094C10.2436 18.9698 10.1224 19 10.0013 19Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.7806 7.42904C15.4025 7.42904 15.0821 7.13968 15.0508 6.75775C14.9864 5.95687 14.4491 5.2807 13.6841 5.03421C13.2983 4.9095 13.0873 4.49737 13.2113 4.11446C13.3373 3.73059 13.7467 3.52209 14.1335 3.6429C15.4651 4.07257 16.398 5.24855 16.5123 6.63888C16.5445 7.04127 16.2446 7.39397 15.8412 7.42612C15.8206 7.42807 15.8011 7.42904 15.7806 7.42904Z" fill="currentColor"/>
                                        </svg>
                                        <span class="tp-product-tooltip">Remove from Wishlist</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- product content -->
                        <div class="tp-product-content">
                            <div class="tp-product-category">
                                <a href="#">Product</a>
                            </div>
                            <h3 class="tp-product-title">
                                <a href="#">${item.name}</a>
                            </h3>
                            <div class="tp-product-price-wrapper">
                                <span class="tp-product-price">$${item.price.toFixed(2)}</span>
                            </div>
                            <div class="tp-product-added-date">
                                <small class="text-muted">Added: ${new Date(item.added_at).toLocaleDateString()}</small>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');

            // Add event listeners for the new buttons
            addWishlistEventListeners();
        }

        function addWishlistEventListeners() {
            // Add to cart buttons
            document.querySelectorAll('.tp-product-add-cart-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = parseInt(this.getAttribute('data-product-id'));
                    const wishlist = window.meskellilStorage ? window.meskellilStorage.getWishlist() : [];
                    const product = wishlist.find(item => item.id === productId);

                    if (product && window.meskellilStorage) {
                        window.meskellilStorage.addToCart(product);
                    }
                });
            });

            // Remove from wishlist buttons
            document.querySelectorAll('.tp-product-action-btn').forEach(btn => {
                // Check if it's the remove button (second button in the group)
                if (btn.querySelector('svg path[d*="1.78158"]')) {
                    btn.addEventListener('click', function() {
                        const productId = parseInt(this.getAttribute('data-product-id'));

                        if (window.meskellilStorage) {
                            window.meskellilStorage.removeFromWishlist(productId);
                            // Refresh the display
                            displayWishlist();
                        }
                    });
                }
            });
        }

        // Test functions
        window.testStorage = function() {
            console.log('Testing storage...');
            console.log('window.meskellilStorage:', window.meskellilStorage);

            // Check localStorage directly
            console.log('localStorage keys:', Object.keys(localStorage));
            console.log('meskellil_wishlist in localStorage:', localStorage.getItem('meskellil_wishlist'));
            console.log('meskellil_cart in localStorage:', localStorage.getItem('meskellil_cart'));

            if (window.meskellilStorage) {
                console.log('Storage methods:', Object.getOwnPropertyNames(Object.getPrototypeOf(window.meskellilStorage)));
                console.log('Wishlist:', window.meskellilStorage.getWishlist());
                console.log('Cart:', window.meskellilStorage.getCart());
                alert('Storage is working! Check console for details.');
            } else {
                alert('Storage not available. Check console for errors.');
            }
        };

        window.addTestItem = function() {
            if (window.meskellilStorage) {
                const testProduct = {
                    id: 999,
                    name: 'Test Product',
                    price: 29.99,
                    image: '/assets/img/product/product-1.jpg'
                };
                window.meskellilStorage.addToWishlist(testProduct);
                displayWishlist();
            } else {
                alert('Storage not available');
            }
        };

        window.refreshWishlist = function() {
            displayWishlist();
        };

        window.clearStorage = function() {
            if (window.meskellilStorage) {
                window.meskellilStorage.clearCart();
                window.meskellilStorage.setItem('meskellil_wishlist', []);
                displayWishlist();
                alert('Storage cleared!');
            } else {
                // Clear localStorage directly
                localStorage.removeItem('meskellil_wishlist');
                localStorage.removeItem('meskellil_cart');
                alert('Storage cleared directly from localStorage!');
            }
        };
    });
    </script>


@endsection
