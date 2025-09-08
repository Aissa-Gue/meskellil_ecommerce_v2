@foreach ($products as $product)
    @include('components.product.product_list_item', ['product' => $product])
@endforeach
