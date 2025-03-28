@extends('layouts.app')

@php
    $modal_name = 'registerModal2';
@endphp

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6 mx-auto">
            <x-products :productsData="$shopping_cart" />
        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="row">
                <div class="col-md-4 col-sm-12 py-1 d-grid gap-2">
                    <a href="#" class="btn btn-primary">Inicia sesión</a>
                </div>
                <div class="col-md-4 col-sm-12 py-1 d-grid gap-2">
                    <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#registerModal2">
                        Crea cuenta
                    </a>
                </div>
                <div class="col-md-4 col-sm-12 py-1 d-grid gap-2">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <button class="w-100 btn btn-success" type="submit">Compra como invitado</button>
                    </form>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <x-user.register :modalName="$modal_name" />
@endsection
