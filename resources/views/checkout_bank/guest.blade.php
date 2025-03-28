@extends('layouts.app')
@section('title', 'Dirección de envío')
@section('css')
    @livewireStyles
@endsection
@section('js')
    @livewireScripts
@endsection


@section('content')
    <main>
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
            {{-- <x-items :productsData="$shopping_cart" /> --}}
            <x-products :productsData="$shopping_cart" />
            </div>

            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Dirección de envío</h4>
                <form class="needs-validation" action="{{ route('checkout.guest.address.store') }}" method="POST">
                    @csrf

                    @livewire('sepomex')

                    <hr class="my-4">

                    {{-- <x-checkout.creditcard /> --}}

                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
    </main>
@endsection
