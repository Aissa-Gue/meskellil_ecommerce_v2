@extends('layouts.app')

@section('content')

    @include('components.area.off-canvas-area')
    @include('components.area.mobile-menu-area')
    @include('components.search-area')
    @include('components.area.cart-mini-area')
    @include('components.area.general-header-area')


    <main>
        @include('components.breadcrumb2', $breadcrumbData)

        <!-- cart area start -->
        <section class="tp-cart-area pt-95 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tp-section-title-wrapper-6 text-center mb-40">
                            <span class="tp-section-title-pre-6">Shopping Cart</span>
                            <h3 class="tp-section-title-6">Your Cart Items</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8">
                        <div class="tp-cart-list mb-45" id="cart-container">
                            <!-- Cart items will be populated by JavaScript -->
                        </div>

                        <div class="tp-cart-empty" id="empty-cart" style="display: none;">
                            <div class="text-center py-5">
                                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" fill="#e3e3e0"/>
                                    <path d="M3 6h18" stroke="#e3e3e0" stroke-width="2"/>
                                    <path d="M16 10a4 4 0 01-8 0" stroke="#e3e3e0" stroke-width="2"/>
                                </svg>
                                <h4>Your cart is empty</h4>
                                <p>Start shopping to add products to your cart!</p>
                                <a href="/" class="tp-btn-2">Continue Shopping</a>
                            </div>
                        </div>
                    </div>

                                        <div class="col-xl-4">
                        <div class="tp-cart-checkout-wrapper">
                            <div class="tp-cart-checkout-top d-flex align-items-center justify-content-between">
                                <span class="tp-cart-checkout-top-title">Subtotal</span>
                                <span class="tp-cart-checkout-top-price" id="cart-subtotal">$0.00</span>
                            </div>
                            <div class="tp-cart-checkout-shipping">
                                <h4 class="tp-cart-checkout-shipping-title">Shipping</h4>
                                <div class="tp-cart-checkout-shipping-option-wrapper">
                                    <div class="tp-cart-checkout-shipping-option">
                                        <input id="flat_rate" type="radio" name="shipping" checked>
                                        <label for="flat_rate">Flat rate: <span id="cart-shipping">$0.00</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="tp-cart-checkout-total d-flex align-items-center justify-content-between">
                                <span>Total</span>
                                <span id="cart-total">$0.00</span>
                            </div>
                            <div class="tp-cart-checkout-proceed">
                                <button class="tp-btn tp-btn-2 w-100 mb-3" id="update-cart-btn">Update Cart</button>
                                <button class="tp-btn tp-btn-2 tp-btn-blue w-100 mb-3" id="checkout-btn">Proceed to Checkout</button>
                                <button class="tp-btn tp-btn-2 tp-btn-border w-100" id="clear-cart-btn">Clear Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cart area end -->

    </main>

    @include('components.footer')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize cart display
        if (window.meskellilStorage) {
            displayCart();
        } else {
            // Fallback if storage is not loaded
            setTimeout(displayCart, 1000);
        }

        function displayCart() {
            const cart = window.meskellilStorage ? window.meskellilStorage.getCart() : [];
            const container = document.getElementById('cart-container');
            const emptyMessage = document.getElementById('empty-cart');

            if (cart.length === 0) {
                container.style.display = 'none';
                emptyMessage.style.display = 'block';
                updateCartSummary([]);
                return;
            }

            container.style.display = 'block';
            emptyMessage.style.display = 'none';

                container.innerHTML = `
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2" class="tp-cart-header-product">Product</th>
                                <th class="tp-cart-header-price">Price</th>
                                <th class="tp-cart-header-quantity">Quantity</th>
                                <th class="tp-cart-header-total">Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${cart.map(item => `
                                <tr data-product-id="${item.id}">
                                    <td style="width:80px"><img src="${item.image || '/assets/img/default-product.png'}" alt="${item.name}" style="width:70px; height:70px; object-fit:cover"></td>
                                    <td>${item.name}</td>
                                    <td>$${item.price.toFixed(2)}</td>
                                    <td>
                                        <div class="tp-cart-quantity">
                                            <button class="tp-cart-minus" data-product-id="${item.id}">-</button>
                                            <input type="number" class="tp-cart-input" data-product-id="${item.id}" value="${item.quantity}" min="1">
                                            <button class="tp-cart-plus" data-product-id="${item.id}">+</button>
                                        </div>
                                    </td>
                                    <td>$${(item.price * item.quantity).toFixed(2)}</td>
                                    <td><button class="tp-cart-action-btn" data-product-id="${item.id}">Remove</button></td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between mt-3">
                        <button id="update-cart-btn" class="tp-btn-2">Update Cart</button>
                        <div>
                            <a href="/checkout" id="checkout-link" class="tp-btn-2">Proceed to Checkout</a>
                            <button id="clear-cart-btn" class="tp-btn-2">Clear Cart</button>
                        </div>
                    </div>
                `;

            updateCartSummary(cart);
            addCartEventListeners();
        }

                function updateCartSummary(cart) {
            const subtotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
            const shipping = subtotal > 0 ? 5.99 : 0;
            const total = subtotal + shipping;

            document.getElementById('cart-subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('cart-shipping').textContent = `$${shipping.toFixed(2)}`;
            document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;
        }

        function addCartEventListeners() {
            // Quantity minus buttons
            document.querySelectorAll('.tp-cart-minus').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = parseInt(this.getAttribute('data-product-id'));
                    const input = document.querySelector(`input[data-product-id="${productId}"]`);
                    let quantity = parseInt(input.value);
                    if (quantity > 1) {
                        quantity--;
                        input.value = quantity;
                        if (window.meskellilStorage) {
                            window.meskellilStorage.updateCartQuantity(productId, quantity);
                            displayCart(); // Refresh display
                        }
                    }
                });
            });

            // Quantity plus buttons
            document.querySelectorAll('.tp-cart-plus').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = parseInt(this.getAttribute('data-product-id'));
                    const input = document.querySelector(`input[data-product-id="${productId}"]`);
                    let quantity = parseInt(input.value);
                    quantity++;
                    input.value = quantity;
                    if (window.meskellilStorage) {
                        window.meskellilStorage.updateCartQuantity(productId, quantity);
                        displayCart(); // Refresh display
                    }
                });
            });

            // Quantity input changes
            document.querySelectorAll('.tp-cart-input').forEach(input => {
                input.addEventListener('change', function() {
                    const productId = parseInt(this.getAttribute('data-product-id'));
                    const quantity = parseInt(this.value);
                    if (quantity > 0 && window.meskellilStorage) {
                        window.meskellilStorage.updateCartQuantity(productId, quantity);
                        displayCart(); // Refresh display
                    }
                });
            });

            // Remove item buttons
            document.querySelectorAll('.tp-cart-action-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = parseInt(this.getAttribute('data-product-id'));
                    if (window.meskellilStorage) {
                        window.meskellilStorage.removeFromCart(productId);
                        displayCart(); // Refresh display
                    }
                });
            });

            // Update cart button
            document.getElementById('update-cart-btn').addEventListener('click', function() {
                displayCart();
            });

            // Clear cart button
            document.getElementById('clear-cart-btn').addEventListener('click', function() {
                if (window.meskellilStorage) {
                    window.meskellilStorage.clearCart();
                    displayCart();
                }
            });

            // Checkout button
            document.getElementById('checkout-btn').addEventListener('click', function() {
                const cart = window.meskellilStorage ? window.meskellilStorage.getCart() : [];
                if (cart.length > 0) {
                    alert('Checkout functionality will be implemented here. Cart total: $' +
                        cart.reduce((total, item) => total + (item.price * item.quantity), 0).toFixed(2));
                } else {
                    alert('Your cart is empty!');
                }
            });
        }
    });
    </script>


@endsection
