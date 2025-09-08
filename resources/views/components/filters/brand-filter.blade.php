<!-- Brand Filter Component -->
<div class="tp-shop-widget mb-50">
    <h3 class="tp-shop-widget-title">Popular Brands</h3>

    <div class="tp-shop-widget-content">
        <div class="tp-shop-widget-checkbox">
            <ul class="filter-items filter-checkbox">
                @foreach($brands as $brand)
                    <li class="filter-item checkbox">
                        <input id="brand_{{ $brand->id }}{{ $suffix ?? '' }}" type="checkbox" 
                               name="filter[brand_id][]" value="{{ $brand->id }}"
                               {{ in_array($brand->id, request('filter.brand_id', [])) ? 'checked' : '' }}>
                        <label for="brand_{{ $brand->id }}{{ $suffix ?? '' }}">{{ $brand->name }}</label>
                        <span class="filter-count">({{ $brand->products_count ?? 0 }})</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
