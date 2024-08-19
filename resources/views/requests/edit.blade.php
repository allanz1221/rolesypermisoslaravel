@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inicio</h1>

@stop

@section('plugins.Select2', true)


@section('content')
<script src="{{ url('/') }}/vendor/jquery/jquery.min.js"></script>

<style>
    .material {
        margin-bottom: 15px;
    }
    .material label {
        display: block;
        margin-bottom: 5px;
    }
    .material select,
    .material input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .material .select2-container {
        width: 100% !important;
    }
    button {
        padding: 10px 15px;
        margin-right: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button[type="button"] {
        background-color: #008CBA;
    }
    button:hover {
        opacity: 0.8;
    }
</style>
<div class="container">

    <h1>Crear Solicitud</h1>

    <form action="{{ route('requests.store') }}" method="POST">
        @csrf

        <div id="materials">
            <div class="material">
                <label for="material_id">Material</label>
                <select class="material-select" name="materials[0][id]" required>
                </select>
                <label for="quantity">Cantidad</label>
                <input type="number" name="materials[0][quantity]" min="1" required>
            </div>
        </div>


        <button type="button" onclick="addMaterial()">Agregar otro material</button>
        <button type="submit" class="btn btn-primary">Enviar solicitud</button>
    </form>
</div>

<script>
    let materialIndex = 1;

    function initializeSelect2(selectElement) {
        $(selectElement).select2({
            placeholder: 'Buscar material',
            minimumInputLength: 2,
            ajax: {
                url: '{{ route("materials.search") }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    function addMaterial() {
        const materialsDiv = document.getElementById('materials');
        const newMaterialDiv = document.createElement('div');
        newMaterialDiv.classList.add('material');
        newMaterialDiv.innerHTML = `
            <label for="material_id">Material</label>
            <select class="material-select" name="materials[${materialIndex}][id]" required>
            </select>
            <label for="quantity">Cantidad</label>
            <input type="number" name="materials[${materialIndex}][quantity]" min="1" required>
            <button type="button" onclick="removeMaterial(this)">Eliminar</button>
        `;
        materialsDiv.appendChild(newMaterialDiv);
        initializeSelect2(newMaterialDiv.querySelector('.material-select'));
        materialIndex++;
    }

    function removeMaterial(button) {
        const materialDiv = button.parentElement;
        materialDiv.remove();
    }

    $(document).ready(function() {
        initializeSelect2('.material-select');
    });
</script>
@endsection