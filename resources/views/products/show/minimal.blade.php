@extends('layouts.minimal.app')

@section('meta_social')
    <!-- Meta Open Graph para Facebook y WhatsApp -->
    <meta property="og:title" content="{{ $productStore['product']['name'] }}" />
    <meta property="og:description" content="{{ $productStore['description'] }}" />
    <meta property="og:image" content="{{ route('images.show', $productStore['image']) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:logo" content="" />
    <meta property="og:type" content="product" />

    <!-- Meta Twitter Cards para X -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $productStore['product']['name'] }}" />
    <meta name="twitter:description" content="{{ $productStore['description'] }}" />
    <meta name="twitter:image" content="{{ route('images.show', $productStore['image']) }}" />
    <meta name="twitter:url" content="{{ url()->current() }}" />
@endsection

@section('meta')
    <meta name="description" content="{{ $productStore['description'] }}" />
    <meta name="keywords" content="" />
@endsection

@section('title', $productStore['product']['name'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 text-center text-uppercase border">
                <h1 class="text">{{ $productStore['product']['name'] }}</h1>
            </div>

            <!-- Columna de miniaturas a la izquierda -->
            <div class="col-1">
                @foreach ($productStore['product']['images'] as $image)
                    <div class="mb-2">
                        <img src="{{ asset('images/' . $image) }}" 
                             class="img-thumbnail img-fluid thumbnail-image" 
                             alt="{{ $productStore['product']['name'] }}"
                             style="cursor: pointer;">
                    </div>
                @endforeach
            </div>

            <!-- Imagen principal -->
            <div class="col-5 mb-3">
                <img id="mainImage" src="{{ route('images.show', $productStore['image']) }}" 
                     class="img-fluid" 
                     alt="{{ $productStore['product']['name'] }}">
            </div>

            <!-- Detalles del producto -->
            <div class="col-6">
                <p>Status: {{ $productStore['status'] }}</p>
                <p>Price: $ {{ $productStore['price'] }} <small class="text-muted">{{ $productStore['currency'] }}</small></p>
                <p>Description: {{ $productStore['description'] }}</p>
                <p>Brand: <a href="/brand/{{ $productStore['product']['brand']['slug'] }}">{{ $productStore['product']['brand']['name'] }}</a></p>

                <form class="add-to-cart-form" data-url="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_store_id" value="{{ $productStore['id'] }}">
                    <div class="input-group mb-3" style="max-width: 200px;">
                        <span class="input-group-text">Cantidad</span>
                        <input type="number" name="quantity" class="form-control" min="1" value="1" required>
                        <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                    </div>
                </form>

                <h3>Detalles del producto:</h3>
                <ul>
                    @foreach ($productStore['product']['features'] as $feature)
                        @if ($feature['parent'])
                            <li>{{ $feature['parent'] }}: {{ $feature['name'] }}</li>
                        @else
                            <li>{{ $feature['name'] }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Manejo de imágenes en miniatura
            const thumbnails = document.querySelectorAll('.thumbnail-image');
            const mainImage = document.getElementById('mainImage');
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    mainImage.src = this.src;
                });
            });

            // Manejo del formulario de agregar al carrito
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const url = this.getAttribute('data-url');
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const formData = new FormData(this);

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: '¡Agregado!',
                                text: data.message,
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonText: 'Ver carrito',
                                cancelButtonText: 'Seguir comprando',
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: 'btn btn-primary mx-2',
                                    cancelButton: 'btn btn-secondary mx-2'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '{{ route('cart.view') }}';
                                }
                            });
                        } else {
                            Swal.fire('Error', data.message || 'No se pudo agregar el producto', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Ocurrió un problema al agregar el producto: ' + error.message, 'error');
                    });
                });
            });
        });
    </script>
@endsection