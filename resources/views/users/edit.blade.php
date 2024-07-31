@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inicio</h1>
@stop


@section('content')



<form action="{{ route("users.update",$user->id) }}" method="POST">
    @method('PUT')
    @include('users._form',['pasw' => false])
</form>

@endsection 