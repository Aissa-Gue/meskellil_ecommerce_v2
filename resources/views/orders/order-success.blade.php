@extends('layouts.app')

@section('content')
    @include('components.area.general-header-area')
    <div>
    {{--@include('components.breadcrumb2', $breadcrumbData)--}}

    <section class="tp-order-success-area pt-60 pb-60" style="background:#EFF1F5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="tp-order-success-card p-4 text-center rounded shadow-sm white-bg">
                        <div class="mb-4">
                            <svg width="64" height="64" fill="none"><circle cx="32" cy="32" r="32" fill="#0AB27B"/><path fill="#fff" d="M44 26L28.5 42 20 34.5l2-2L28.5 39.5 42 24l2 2z"/></svg>
                        </div>
                        <h2 class="mb-2">Order Placed Successfully!</h2>
                        <p class="mb-3" style="font-size:1.25rem;">
                            Your order (<b>#{{ $order->id }}</b>) has been received.<br>
                            We will contact you soon to confirm delivery.
                        </p>
                        <ul class="list-unstyled mb-3">
                            <li><b>Total Amount:</b> {{ number_format($order->total_price, 2) }} DZD</li>
                            <li><b>Order Code:</b> #{{ $order->id }}</li>
                            <li><b>Status:</b> {{ ucfirst($order->order_status) }}</li>
                        </ul>
                        <a href="{{ route('home') }}" class="tp-btn tp-btn-blue w-100 mb-2">Continue Shopping</a>
                        @if(auth()->check())
                            <a href="{{ route('orders.show', $order) }}" class="tp-btn tp-btn-outline w-100">View Order Details</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('components.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function() {
                window.meskellilStorage.clearCart();
                console.log('cart cleared');
            }, 200); //200 ms
        });
    </script>
@endsection

