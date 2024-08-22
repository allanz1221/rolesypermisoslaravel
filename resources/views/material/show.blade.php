@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inicio</h1>
@stop


@section('content')


  <div class="container">
        <h1>{{ $material->name }}</h1>
        <div class="card">
            <div class="card-header">
                Detalles del Material
            </div>
            <div class="card-body">
                <p><strong>Marca:</strong> {{ $material->marca }}</p>
                <p><strong>Modelo:</strong> {{ $material->modelo }}</p>
                <p><strong>No. de Serie:</strong> {{ $material->noserie }}</p>
                <p><strong>Ubicación:</strong> {{ $material->ubicacion }}</p>
                <p><strong>Costo:</strong> {{ $material->costo }}</p>
                <p><strong>Estado:</strong> {{ $material->estado }}</p>
                <p><strong>Ocupado:</strong> {{ $material->ocupado }}</p>
                <p><strong>Descripción:</strong> {{ $material->description }}</p>
                <p><strong>Cantidad:</strong> {{ $material->quantity }}</p>
                <a href="{{ route('materials.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>

@endsection