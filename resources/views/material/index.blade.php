@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')
  <div class="container">
        <h1>Materiales</h1>
        <a href="{{ route('materials.create') }}" class="btn btn-primary">Crear Nuevo Material</a>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $material->name }}</td>
                        <td>{{ $material->marca }}</td>
                        <td>{{ $material->modelo }}</td>
                        <td>
                            <a href="{{ route('materials.show', $material->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning">Editar</a>
                            <button class="btn btn-danger" onclick="deleteMaterial('{{ $material->id }}')">Eliminar</button>
                            <form id="delete-form-{{ $material->id }}" action="{{ route('materials.destroy', $material->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $materials->links() }}
    </div>

    <script>
        function deleteMaterial(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
