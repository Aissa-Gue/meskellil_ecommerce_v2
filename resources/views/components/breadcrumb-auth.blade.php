<!-- Auth breadcrumb area start -->
<section class="breadcrumb__area include-bg text-center pt-95 pb-50" style="background-color: {{ $breadcrumbData['bgColor'] ?? '#EFF1F5' }};">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="breadcrumb__content p-relative z-index-1">
                    <h3 class="breadcrumb__title">{{ $breadcrumbData['title'] ?? 'Authentication' }}</h3>
                    <div class="breadcrumb__list">
                        @if(isset($breadcrumbData['breadcrumbs']) && is_array($breadcrumbData['breadcrumbs']))
                            @foreach($breadcrumbData['breadcrumbs'] as $index => $breadcrumb)
                                @if($index < count($breadcrumbData['breadcrumbs']) - 1)
                                    <span><a href="{{ $breadcrumb['url'] ?? '#' }}">{{ $breadcrumb['name'] }}</a></span>
                                @else
                                    <span>{{ $breadcrumb['name'] }}</span>
                                @endif
                            @endforeach
                        @else
                            <span><a href="{{ route('home') }}">Home</a></span>
                            <span>{{ $breadcrumbData['title'] ?? 'Authentication' }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Auth breadcrumb area end -->
