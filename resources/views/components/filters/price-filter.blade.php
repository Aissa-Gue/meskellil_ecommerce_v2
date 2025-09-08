<!-- Price Filter Component -->
<div class="tp-shop-widget mb-35">
    <h3 class="tp-shop-widget-title no-border">Price Filter</h3>
    
    <div class="tp-shop-widget-content">
        <div class="tp-shop-widget-filter">
            <div id="slider-range{{ $suffix ?? '' }}" class="mb-10"></div>
            <div class="tp-shop-widget-filter-info d-flex align-items-center justify-content-between">
                <span class="input-range">
                    <input type="text" id="amount{{ $suffix ?? '' }}" readonly>
                </span>
                <button class="tp-shop-widget-filter-btn price-filter-btn" type="button">
                    Filter
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const suffix = '{{ $suffix ?? "" }}';
    const minPrice = {{ $priceRange['min'] ?? 0 }};
    const maxPrice = {{ $priceRange['max'] ?? 1000 }};
    
    if (typeof $ !== 'undefined' && $.ui) {
        $("#slider-range" + suffix).slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            values: [minPrice, maxPrice],
            slide: function(event, ui) {
                $("#amount" + suffix).val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        
        $("#amount" + suffix).val("$" + $("#slider-range" + suffix).slider("values", 0) +
            " - $" + $("#slider-range" + suffix).slider("values", 1));
    }
});
</script>
