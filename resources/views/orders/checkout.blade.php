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

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="px-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="tp-checkout-bill-form">
                                <form action="#">
                                    <div class="tp-checkout-bill-inner">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Client name <span>*</span></label>
                                                    <input type="text" name="client_name" id="client_name" value="{{ old('client_name', auth()->user()->name ?? '') }}" placeholder="Client name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label>Client Phone <span>*</span></label>
                                                    <input type="text" name="client_phone" id="client_phone" value="{{ old('client_phone', auth()->user()->phone ?? '') }}" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label for="wilaya_id">Wilaya</label>
                                                    <select id="wilaya_id" name="wilaya_id">
                                                        @foreach(\Kossa\AlgerianCities\Wilaya::all() as $wilaya)
                                                            <option value="{{ $wilaya->id }}"
                                                                {{ (old('wilaya_id', auth()->user()->wilaya_id ?? '') == $wilaya->id) ? 'selected' : '' }}>
                                                                {{ $wilaya->name . ' ('.$wilaya->arabic_name. ')' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tp-checkout-input">
                                                    <label for="commune_id">Commune</label>
                                                    <select id="commune_id" name="commune_id"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Order notes (optional)</label>
                                                    <textarea name="notes" id="notes"
                                                              placeholder="Notes about your order, e.g. special notes for delivery.">{{old('notes')}}</textarea>
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
                                    <!--<li class="tp-order-info-list-desc">Test item * 2 = 200</li>-->
                                </ul>
                            </div>

                            <div class="tp-checkout-summary mt-3">
                                <div class="d-flex justify-content-between"><span>Subtotal</span><strong
                                        id="cart-subtotal">0.00</strong></div>
                                <div class="d-flex justify-content-between"><span>Shipping</span><strong
                                        id="cart-shipping">0.00</strong></div>
                                <div class="d-flex justify-content-between"><span>Total</span><strong id="cart-total">0.00</strong>
                                </div>
                            </div>

                            <!-- hidden form to submit order to server -->
                            <form id="place-order-form" method="POST" action="{{route('orders.store')}}">
                                @csrf
                                <input type="hidden" name="client_name" id="client_name_h">
                                <input type="hidden" name="client_phone" id="client_phone_h">
                                <input type="hidden" name="wilaya_id" id="wilaya_id_h">
                                <input type="hidden" name="commune_id" id="commune_id_h">
                                <input type="hidden" name="notes" id="notes_h">

                                <div class="tp-checkout-btn-wrapper mt-3">
                                    <button type="button" id="place-order-btn" onclick="placeOrder()"
                                            class="tp-checkout-btn w-100">Place
                                        Order
                                    </button>
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

        // Get current user values from server (Blade)
        const userWilayaId = "{{ old('wilaya_id', auth()->user()->wilaya_id ?? '') }}";
        const userCommuneId = "{{ old('commune_id', auth()->user()->commune_id ?? '') }}";

        //Load wilayas and communes
        function loadCommunes(wilayaId, selectedCommuneId = null) {
            fetch(`/api/wilayas/${wilayaId}/communes`)
                .then(r => r.json())
                .then(data => {
                    const $sel = $('#commune_id');
                    $sel.empty();
                    data.forEach(c => {
                        $sel.append(`<option value="${c.id}">${c.name} (${c.arabic_name})</option>`);
                    });
                    if (selectedCommuneId) {
                        $sel.val(selectedCommuneId);
                    }
                    $sel.niceSelect('update');
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Set wilaya select, update communeselect
            $('#wilaya_id').val(userWilayaId).niceSelect('update');
            loadCommunes(userWilayaId, userCommuneId);

            $('#wilaya_id').on('change', function () {
                loadCommunes(this.value);
                updateSummary();
            });

            setTimeout(function() {
                // Debug output
                console.log('Cart on DOMContentLoaded:', window.meskellilStorage ? window.meskellilStorage.getCart() : []);
                updateSummary();
            }, 100); // Wait a little for storage to initialize!
        });

        function getCart() {
            return window.meskellilStorage ? window.meskellilStorage.getCart() : [];
        }


        function getShippingPrice(wilayaId, callback) {
            fetch(`/api/wilayas/${wilayaId}/shipping`)
                .then(r => r.json())
                .then(data => {
                    const shippingPrice = Number(data.shipping_price) || 0;
                    callback(shippingPrice);
                });
        }

        // Use this function to update the summary (cart + shipping)
        function updateSummary() {
            const cart = window.meskellilStorage ? window.meskellilStorage.getCart() : [];
            const subtotal = cart.reduce((t, i) => t + (i.price * i.quantity), 0);
            const wilayaId = $('#wilaya_id').val();

            getShippingPrice(wilayaId, function (shipping) {
                const total = subtotal + shipping;

                $('#cart-subtotal').text(`${subtotal.toFixed(2)}`);
                $('#cart-shipping').text(`${shipping.toFixed(2)}`);
                $('#cart-total').text(`${total.toFixed(2)}`);

                const list = document.getElementById('order-items-list');
                // remove previous items except header
                list.querySelectorAll('.tp-order-info-list-desc').forEach(n => n.remove());

                cart.forEach(item => {
                    const li = document.createElement('li');
                    li.className = 'tp-order-info-list-desc';
                    li.innerHTML = `<p>${item.name} <span> x ${item.quantity}</span></p><span>${(item.price * item.quantity).toFixed(2)}</span>`;
                    list.appendChild(li);
                });
            });
        }

        function placeOrder() {
            const cart = getCart();
            if (!cart || cart.length === 0) {
                alert('Your cart is empty');
                return;
            }

            // build items inputs according to expected payload items[][product_id], items[][qte], items[][price]
            const form = document.getElementById('place-order-form');
            // remove existing dynamic inputs
            form.querySelectorAll('input[name^="items"]').forEach(n => n.remove());

            cart.forEach((it, idx) => {
                const fields = [
                    { name: "product_id", value: it.id },
                    { name: "qte", value: it.quantity },
                    { name: "price", value: it.price },
                    { name: "shape", value: it.shape },
                    { name: "size", value: it.size },
                    { name: "color", value: it.color },
                    { name: "taste", value: it.taste }
                ];
                fields.forEach(f => {
                    const inp = document.createElement('input');
                    inp.type = 'hidden';
                    inp.name = `items[${idx}][${f.name}]`;
                    inp.value = f.value ?? '';
                    form.appendChild(inp);
                });
            });

            // try to read visible checkout inputs for name/phone/notes/wilaya_id/commune_id
            document.querySelector('#client_name_h').value = document.querySelector('#client_name')?.value || 'Guest';
            document.querySelector('#client_phone_h').value = document.querySelector('#client_phone')?.value || '';
            document.querySelector('#wilaya_id_h').value = document.querySelector('#wilaya_id')?.value || '';
            document.querySelector('#commune_id_h').value = document.querySelector('#commune_id')?.value || '';
            document.querySelector('#notes_h').value = document.querySelector('#notes')?.value || '';

            // submit the form (normal POST) so Laravel handles redirect
            form.submit();
        }

    </script>
@endsection
