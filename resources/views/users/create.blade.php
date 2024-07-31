@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inicio</h1>
@stop


@section('content')


<h1> Usuarios </h1>

<form action="{{ route("users.store") }}" method="POST">
    @include('users._form',['pasw' => true])
</form>

@endsection