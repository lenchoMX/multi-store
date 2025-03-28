@extends('layouts.app')

@section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($productStores as $product)
            <div class="col">
                <x-card :dataItem="$product"/>
            </div>
        @endforeach
    </div>
@endsection
