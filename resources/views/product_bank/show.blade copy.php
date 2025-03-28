@extends('layouts.app')

@section('content')
{{-- @dd($product) --}}
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card text-black">
                        <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/3.webp"
                            class="card-img-top" alt="Apple Computer" />
                        <div class="card-body">
                            <div class="text-center">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="text-muted mb-4">Apple pro display XDR</p>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between">
                                    <span>Pro Display XDR</span><span>{{ $product->price }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Pro stand</span><span>$999</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Vesa Mount Adapter</span><span>$199</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                <span>Total</span><span>$7,197.00</span>
                            </div>
                            <form action="{{ route('product.store', [$product->id, $product->slug]) }}" method="post">
                                @csrf
                                <div class="input-group mb-3 border border-success">
                                    <span class="input-group-text" id="basic-addon1">Cantidad: </span>
                                    <select name="quantity" class="form-select" aria-label="Default select example">
                                        @for ($i = 1; $i < 30; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <button class="btn btn-primary">
                                    Add to cart
                            </form>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('productAdd') == 'success')
        <script>
            Swal.fire({
                    icon: 'success',
                    title: "{{$product->name}}",
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
