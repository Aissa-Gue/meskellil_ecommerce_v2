@php
    // $category is provided. We can eager load deeper children if needed.
    $hasChildren = $category->children && $category->children->count() > 0;
@endphp

<li class="{{ $hasChildren ? 'has-dropdown' : '' }}">
    <a href="{{ route('products.index', ['category' => $category->id]) }}">
        @if($category->image)
            <span><img src="{{ $category->image }}" alt="{{ $category->name }}" style="width:18px;height:18px;object-fit:cover;margin-inline-end:6px"></span>
        @endif
        {{ $category->name }}
    </a>

    @if($hasChildren)
        <ul class="tp-submenu">
            @foreach($category->children as $child)
                @include('components.partials.category-menu-item', ['category' => $child])
            @endforeach
        </ul>
    @endif
</li>
