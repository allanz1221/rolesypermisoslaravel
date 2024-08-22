@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inicio</h1>
@stop


@section('content')

   <div class="container">
        <h1>Crear Nuevo Material</h1>
        <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('material._form')
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection