@extends('layouts.app')
@section('title', 'Dirección de envío')
@section('css')
    @livewireStyles
@endsection
@section('js')
    @livewireScripts
@endsection


@section('content')

Direccion de envio <br>
{{ $userCookie['firstName'] }} {{ $userCookie['lastName'] }}<br>
{{ $userCookie['phone'] }}<br>
{{ $userCookie['email'] }}<br>
{{ $userCookie['address'] }}<br>
{{ $userCookie['suburb'] }}<br>
{{ $userCookie['city'] }}, {{ $userCookie['state'] }}, {{ $userCookie['zip'] }}<br>

@endsection
