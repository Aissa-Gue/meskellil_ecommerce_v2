<div class="row">
    @foreach ($products as $product)
        <div class="col-xl-4 col-md-6 col-sm-6 infinite-item">
            @if(isset($useListItem) && $useListItem)
                @include('components.product.product_list_item', ['product' => $product])
            @else
                @include('components.product.product_card', ['product' => $product])
            @endif
        </div>
    @endforeach
</div>

