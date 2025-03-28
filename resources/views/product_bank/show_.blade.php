@extends('layouts.app')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    {{-- @dd($product) --}}

    <div class="row px-2 mx-auto">

        <div class="col-sm-12 col-md-12 text-center">
            <h1>{{ $product->name }}</h1>
        </div>

        <div class="col-sm-12 col-md-6">
            <x-products.carousel :images="$product->images" />
        </div>

        <div class="col-sm-12 col-md-6">

            <h2 class="text-success">${{ $product->price }}</h2>
            {{-- <p class="text-muted mb-4">view: {{ $product->view }}</p>
            <p class="text-muted mb-4">ratingValue: {{ $product->ratingValue }}</p>
            <p class="text-muted mb-4">reviewCount: {{ $product->reviewCount }}</p> --}}
            <p>{{ $product->short_description }}</p>


            <div class="col-sm-12 col-md-8">
                <form action="{{ route('product.store', [$product->id, $product->slug]) }}" method="post">
                    @csrf
                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text">Cantidad</span>
                        <input name="quantity" type="number" class="form-control" inputmode="numeric" pattern="[0-9]*"
                            value="1" min="1" size="1" aria-label="Cantidad"
                            aria-describedby="btnGroupAddon">
                        <button class="btn btn-primary">Comprar ahora</button>
                    </div>
                </form>
            </div>


            {{-- <div class="input-group mb-3 border border-success">
                <span class="input-group-text" id="basic-addon1">Cantidad: </span>
                <select name="quantity" class="form-select" aria-label="Default select example">
                    @for ($i = 1; $i < 30; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div> --}}

            <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">
                <div class="input-group-text" id="quantityTextLabel">Compartir: </div>


                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                    href="#">
                    <img src="/svg/facebook.svg" width="48" alt="facebook Logo">
                </a>

                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                    href="#">
                    <img src="/svg/whatsapp.svg" width="48" alt="whatsapp Logo">
                </a>

                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                    href="#">
                    <img src="/svg/instagram.svg" width="48" alt="instagram Logo">
                </a>


                <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                <label class="btn btn-outline-primary" for="btncheck2">X</label>
            </div>

            <x-products.accordion :product="$product" />

        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('productAdd') == 'success')
        <script>
            Swal.fire({
                    icon: 'success',
                    title: "{{ $product->name }}",
                    text: 'Se agrego con exito ',
                    showCancelButton: true,
                    cancelButtonText: 'Seguir comprando',
                    confirmButtonText: 'Pagar'
                })
                .then(function(result) {
                    if (result.value) {
                        window.location = "checkout/cart";
                    }
                })
        </script>
    @endif
@endsection
