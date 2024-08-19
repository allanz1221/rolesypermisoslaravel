@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Dashboard") }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session("status") }}
                    </div>
                    @endif 
                    @if(auth()->check())
                    <h2>Bienvenido, {{ auth()->user()->name }}!</h2>
                    <ul>
                        <li>Email: {{ auth()->user()->email }}</li>
                        <li>ID: {{ auth()->id() }}</li>
                        Rol: {{ auth()->user()->roles->first()->name }}
                        @if(auth()->user()->hasRole('admin'))
                        <li>Admin</li>
                        @endif 
                    </ul>
                    @else
                    <p>Por favor, inicia sesión para ver esta información.</p>
                    @endif

                    {{ __("You are logged in!") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
