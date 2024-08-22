@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inicio</h1>
@stop


@section('content')


<div class="container">
    <h1 class="my-4">Bienvenido al Portal de Recursos</h1>
    <p>Este sitio te ofrece acceso a una variedad de recursos, tutoriales, manuales y servicios para ayudarte en tus estudios y proyectos. Explora las secciones disponibles a continuación.</p>

    <div class="row">
        @foreach($sections as $section)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">{{ $section['title'] }}</h4>
                        <p class="card-text">{{ $section['description'] }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ $section['link'] }}" class="btn btn-primary">Ir a {{ $section['title'] }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection