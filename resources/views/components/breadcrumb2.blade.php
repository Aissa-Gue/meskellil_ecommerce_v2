<!-- breadcrumb area start -->
<section class="breadcrumb__area include-bg pt-95 pb-50" data-bg-color="{{ $bgColor ?? '#EFF1F5' }}">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="breadcrumb__content p-relative z-index-1">
                    <h3 class="breadcrumb__title">{{ $title ?? 'Page Title' }}</h3>
                    <div class="breadcrumb__list">
                        @if(isset($breadcrumbs) && is_array($breadcrumbs))
                            @foreach($breadcrumbs as $index => $breadcrumb)
                                @if($index < count($breadcrumbs) - 1)
                                    <span><a href="{{ $breadcrumb['url'] ?? '#' }}">{{ $breadcrumb['name'] }}</a></span>
                                @else
                                    <span>{{ $breadcrumb['name'] }}</span>
                                @endif
                            @endforeach
                        @else
                            <span><a href="{{ url('/') }}">Home</a></span>
                            <span>{{ $title ?? 'Current Page' }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb area end -->
