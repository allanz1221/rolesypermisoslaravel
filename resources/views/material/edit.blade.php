@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inicio</h1>
@stop


@section('content')


    <div class="container">
        <h1>Editar Material</h1>
        <form action="{{ route('materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('material._form')
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection 