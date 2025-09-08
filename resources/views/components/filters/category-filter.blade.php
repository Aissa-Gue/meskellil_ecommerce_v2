<!-- Categories Filter Component -->
<div class="tp-shop-widget mb-50">
    <h3 class="tp-shop-widget-title">Categories</h3>

    <div class="tp-shop-widget-content">
        <div class="tp-shop-widget-categories">
            <ul>
                @foreach($categories as $category)
                    <li>
                        <label class="filter-checkbox-label">
                            <input type="checkbox" name="filter[category][]" value="{{ $category->id }}"
                                   {{ in_array($category->id, request('filter.category', [])) ? 'checked' : '' }}>
                            <a href="#">{{ $category->name }} 
                                <span>{{ $category->products_count ?? 0 }}</span>
                            </a>
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
