@extends('layouts.minimal.app')

@section('content')
    <h1>{{ $category->name }}</h1>

    @if ($subcategories->count() > 0)
        <h2>Subcategorías</h2>
        <ul>
            @foreach ($subcategories as $subcategory)
                <li>{{ $subcategory->category->name }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Productos</h2>
    <ul>
        @foreach ($products as $product)
            <li>
                Nombre: <a href="{{route('product.show', [$category->slug, $product['slug']] ) }}">{{ $product['name'] }}</a><br>
                Marca: {{ $product['brand'] }}<br>
                Precio: {{ $product['price'] }}<br>
                Stock: {{ $product['stock'] }}<br>
                <img src="{{ route('images.show', ['filename' => $product['image']]) }}" alt="{{ $product['name'] }}" height="200">
            </li>
        @endforeach
    </ul>
@endsection
