@extends('layouts.minimal.app')

@section('meta')
    <meta name="description" content="Bienvenido a nuestra tienda online, encuentra los mejores productos aquí." />
    <meta name="keywords" content="tienda, productos, online" />
@endsection

@section('title', 'Inicio')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">Inicio</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @foreach ($categoriesData as $category)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('category.show', $category['slug']) }}">{{ $category['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @foreach ($categoriesData as $category)
            <h2 id="{{ $category['slug'] }}">{{ $category['name'] }}</h2>
            <div class="row">
                @foreach ($category['products'] as $product)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ route('images.show', ['filename' => $product['image']]) }}"
                                alt="{{ $product['name'] }}" height="200">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product['name'] }}</h5>
                                <p class="card-text">{{ $product['price'] }}</p>
                                <a href="{{ route('product.show', [$category['slug'], $product['slug']]) }}"
                                    class="btn btn-primary">Ver Producto</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
