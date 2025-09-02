@extends('layouts.app')

@section('content')

    @include('components.area.off-canvas-area')
    @include('components.area.mobile-menu-area')
    @include('components.search-area')
    @include('components.area.cart-mini-area')
    @include('components.area.general-header-area')


    <main>
        @include('components.breadcrumb2', $breadcrumbData)

        <!-- checkout area start -->
        <section class="tp-checkout-area pb-120" data-bg-color="#EFF1F5">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-xl-7 col-lg-7">
                        <div class="tp-checkout-verify">
                            <div class="tp-checkout-verify-item">
                                <p class="tp-checkout-verify-reveal">Returning customer? <button type="button" class="tp-checkout-login-form-reveal-btn">Click here to login</button></p>

                                <div id="tpReturnCustomerLoginForm" class="tp-return-customer">
                                    <form action="#">

                                        <div class="tp-return-customer-input">
                                            <label>Email</label>
                                            <input type="text" placeholder="Your Email">
                                        </div>
                                        <div class="tp-return-customer-input">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password">
                                        </div>

                                        <div class="tp-return-customer-suggetions d-sm-flex align-items-center justify-content-between mb-20">
                                            <div class="tp-return-customer-remeber">
                                                <input id="remeber" type="checkbox">
                                                <label for="remeber">Remember me</label>
                                            </div>
                                            <div class="tp-return-customer-forgot">
                                                <a href="forgot.html">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <button type="submit" class="tp-return-customer-btn tp-checkout-btn">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-7">
                        <div class="tp-checkout-bill-area">
                            <h3 class="tp-checkout-bill-title">Billing Details</h3>

                            <div class="tp-checkout-bill-form">
                                <form action="#">
                                    <div class="tp-checkout-bill-inner">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>First Name <span>*</span></label>
                                                    <input type="text" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Last Name <span>*</span></label>
                                                    <input type="text" placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Company name (optional)</label>
                                                    <input type="text" placeholder="Example LTD.">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Country / Region </label>
                                                    <input type="text" placeholder="United States (US)">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Street address</label>
                                                    <input type="text" placeholder="House number and street name">
                                                </div>

                                                <div class="tp-checkout-input">
                                                    <input type="text" placeholder="Apartment, suite, unit, etc. (optional)">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Town / City</label>
                                                    <input type="text" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>State / County</label>
                                                    <select>
                                                        <option>New York US</option>
                                                        <option>Berlin Germany</option>
                                                        <option>Paris France</option>
                                                        <option>Tokiyo Japan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Postcode ZIP</label>
                                                    <input type="text" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Phone <span>*</span></label>
                                                    <input type="text" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Email address <span>*</span></label>
                                                    <input type="email" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-option-wrapper">
                                                    <div class="tp-checkout-option">
                                                        <input id="create_free_account" type="checkbox">
                                                        <label for="create_free_account">Create an account?</label>
                                                    </div>
                                                    <div class="tp-checkout-option">
                                                        <input id="ship_to_diff_address" type="checkbox">
                                                        <label for="ship_to_diff_address">Ship to a different address?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Order notes (optional)</label>
                                                    <textarea placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- checkout place order -->
                        <div class="tp-checkout-place white-bg">
                            <h3 class="tp-checkout-place-title">Your Order</h3>

                            <div class="tp-order-info-list">
                                <ul id="order-items-list">
                                    <li class="tp-order-info-list-header">
                                        <h4>Product</h4>
                                        <h4>Total</h4>
                                    </li>
                                </ul>
                            </div>

                            <div class="tp-checkout-summary mt-3">
                                <div class="d-flex justify-content-between"><span>Subtotal</span><strong id="cart-subtotal">$0.00</strong></div>
                                <div class="d-flex justify-content-between"><span>Shipping</span><strong id="cart-shipping">$0.00</strong></div>
                                <div class="d-flex justify-content-between"><span>Total</span><strong id="cart-total">$0.00</strong></div>
                            </div>

                            <div class="tp-checkout-agree">
                                <div class="tp-checkout-option">
                                    <input id="read_all" type="checkbox">
                                    <label for="read_all">I have read and agree to the website.</label>
                                </div>
                            </div>

                            <!-- hidden form to submit order to server -->
                            <form id="place-order-form" method="POST" action="/orders">
                                @csrf
                                <input type="hidden" name="payment_status" value="pending">
                                <input type="hidden" name="payment_method" value="cash">
                                <input type="hidden" name="client_name" id="client_name" value="">
                                <input type="hidden" name="client_phone" id="client_phone" value="">
                                <input type="hidden" name="commune_id" id="commune_id" value="">
                                <input type="hidden" name="is_verified" value="0">
                                <input type="hidden" name="order_status" value="pending">
                                <input type="hidden" name="notes" id="order_notes" value="">

                                <div class="tp-checkout-btn-wrapper mt-3">
                                    <button type="button" id="place-order-btn" class="tp-checkout-btn w-100">Place Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- checkout area end -->
    </main>

    @include('components.footer')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function getCart() {
            return window.meskellilStorage ? window.meskellilStorage.getCart() : [];
        }

        function updateSummary() {
            const cart = getCart();
            const subtotal = cart.reduce((t, i) => t + (i.price * i.quantity), 0);
            const shipping = subtotal > 0 ? 5.99 : 0;
            const total = subtotal + shipping;

            document.getElementById('cart-subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('cart-shipping').textContent = `$${shipping.toFixed(2)}`;
            document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;

            const list = document.getElementById('order-items-list');
            // remove previous items except header
            list.querySelectorAll('.tp-order-info-list-desc').forEach(n => n.remove());

            cart.forEach(item => {
                const li = document.createElement('li');
                li.className = 'tp-order-info-list-desc';
                li.innerHTML = `<p>${item.name} <span> x ${item.quantity}</span></p><span>$${(item.price * item.quantity).toFixed(2)}</span>`;
                list.appendChild(li);
            });
        }

        function gatherClientData() {
            // try to read visible checkout inputs for name/phone/notes
            const name = document.querySelector('.tp-checkout-bill-form input[type="text"]')?.value || '';
            const phone = document.querySelector('input[placeholder="Phone"]')?.value || document.querySelector('input[placeholder=""]')?.value || '';
            const notes = document.querySelector('textarea')?.value || '';
            return { name, phone, notes };
        }

        updateSummary();

        document.getElementById('place-order-btn').addEventListener('click', function() {
            const cart = getCart();
            if (!cart || cart.length === 0) {
                alert('Your cart is empty');
                return;
            }

            if (!document.getElementById('read_all').checked) {
                alert('Please accept the terms.');
                return;
            }

            // build items inputs according to expected payload items[][product_id], items[][qte], items[][price]
            const form = document.getElementById('place-order-form');
            // remove existing dynamic inputs
            form.querySelectorAll('input[name^="items"]').forEach(n => n.remove());

            cart.forEach((it, idx) => {
                const pid = document.createElement('input'); pid.type='hidden'; pid.name = `items[${idx}][product_id]`; pid.value = it.id; form.appendChild(pid);
                const q = document.createElement('input'); q.type='hidden'; q.name = `items[${idx}][qte]`; q.value = it.quantity; form.appendChild(q);
                const p = document.createElement('input'); p.type='hidden'; p.name = `items[${idx}][price]`; p.value = it.price; form.appendChild(p);
            });

            const client = gatherClientData();
            document.getElementById('client_name').value = client.name || 'Guest';
            document.getElementById('client_phone').value = client.phone || '';
            document.getElementById('order_notes').value = client.notes || '';

            // submit the form (normal POST) so Laravel handles redirect
            form.submit();
        });
    });
    </script>
@endsection
