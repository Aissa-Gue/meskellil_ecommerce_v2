<!-- Product Status Filter Component -->
<div class="tp-shop-widget mb-50">
    <h3 class="tp-shop-widget-title">Product Status</h3>

    <div class="tp-shop-widget-content">
        <div class="tp-shop-widget-checkbox">
            <ul class="filter-items filter-checkbox">
                <li class="filter-item checkbox">
                    <input id="on_sale{{ $suffix ?? '' }}" type="checkbox" name="filter[discount_greater_than]" value="0" 
                           {{ request('filter.discount_greater_than') ? 'checked' : '' }}>
                    <label for="on_sale{{ $suffix ?? '' }}">On sale</label>
                    @if(isset($statusCounts['on_sale']))
                        <span class="filter-count">({{ $statusCounts['on_sale'] }})</span>
                    @endif
                </li>
                <li class="filter-item checkbox">
                    <input id="in_stock{{ $suffix ?? '' }}" type="checkbox" name="filter[instock]" value="1"
                           {{ request('filter.instock') ? 'checked' : '' }}>
                    <label for="in_stock{{ $suffix ?? '' }}">In Stock</label>
                    @if(isset($statusCounts['in_stock']))
                        <span class="filter-count">({{ $statusCounts['in_stock'] }})</span>
                    @endif
                </li>
            </ul><!-- .filter-items -->
        </div>
    </div>
</div>
