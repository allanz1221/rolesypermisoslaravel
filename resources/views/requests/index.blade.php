@extends('adminlte::page') @section('title', 'Dashboard')
@section('content_header')
<h1>Inicio</h1>

@stop @section('plugins.Select2', true) @section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true) @section('content')
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
        width: 50%;
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
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button[type="button"] {
        background-color: #008cba;
    }
    button:hover {
        opacity: 0.8;
    }
</style>
<div class="container">
    <a href="{{ route('requests.create') }}" class="btn btn-primary"
        >Nueva solicitud</a
    >

    <select id="estadoFilter">
        <option value="">Todos</option>
        <option value="Pendiente">Pendiente</option>
        <option value="Aprobado">Aprobado</option>
        <option value="Vigente">Vigente</option>
        <option value="Vencido">Vencido</option>
        <option value="Concluido">Concluido</option>
        <option value="Rechazado">Rechazado</option>
        <option value="Cancelado">Cancelado</option>
    </select>

    <table id="miTabla" class="table table-bordered table-striped">
        <thead>
            <tr>
                <td>Folio</td>
                <td>Material</td>
                <td>Fecha de solicitud</td>
                <td>Fecha de actualización</td>
                <td>Solicito</td>
                <td class="d-none">última modificación</td>
                <td>Estatus</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $requests)
            <tr>
                <td>Lab-00{{ $requests->id }}</td>
                <td>
                    <table width="100%">
                        <!-- <tr>
                            <td>Material</td>
                            <td>Cantidad</td>
                        </tr> -->
                        @foreach ($requests->materials as $materiales)

                        <tr>
                                <td>
                                    {{ $materiales->name }}
                                </td>
                                <td>{{ $materiales->quantity }}</td>
                        </tr>

                        @endforeach
                    </table>
                </td>
                <td>
                    {{ $requests->created_at }}
                </td>
                <td>
                    {{ $requests->updated_at }}
                </td>
                <td>
                    {{ $requests->user->name }}
                    {{--
                    <a
                        href="{{ route('requests.edit',$requests->id) }}"
                        class="btn btn-primary"
                        >Actualizar</a
                    >
                    --}}
                </td>
                <td class="d-none">
                    {{ $requests->lastModifiedBy->name }}
                </td>
                <td>
                    {{ $requests->status }}
                </td>
                <td>
                    @php $estadosDisponiblesPendiente = [ 'Aprobado' =>
                    'btn-success', 'Rechazado' => 'btn-danger', ]; @endphp
                    @if($requests->status == "Pendiente") @if(Auth::user()->rol
                    == 'Laboratorio' || Auth::user()->rol == 'Admin') {{--
                    <p>Puede cambiar a Rechazado o Aprobado</p>
                    --}} @foreach($estadosDisponiblesPendiente as $estado =>
                    $claseBtn)
                    <form
                        method="POST"
                        action="{{ route('requests.changeStatus', ['request' => $requests->id, 'newStatus' => $estado]) }}"
                        style="display: inline"
                    >
                        @csrf @method('PATCH')
                        <button
                            type="button"
                            onclick="confirmarCambioEstado(this.form, '{{
                                $estado
                            }}')"
                            class="btn {{ $claseBtn }}"
                        >
                            {{ $estado }}
                        </button>
                    </form>
                    @endforeach @elseif(Auth::user()->id == $requests->user->id)
                    {{--
                    <p>Puede cambiar a Cancelado</p>
                    --}}
                    <form
                        method="POST"
                        action="{{ route('requests.changeStatus', ['request' => $requests->id, 'newStatus' => 'Cancelado']) }}"
                        style="display: inline"
                    >
                        @csrf @method('PATCH')
                        <button
                            type="button"
                            onclick="confirmarCambioEstado(this.form, 'Cancelado')"
                            class="btn btn-success"
                        >
                            Cancelar
                        </button>
                    </form>
                    @endif @endif @if($requests->status == "Aprobado")
                    @if(Auth::user()->rol == 'Laboratorio' || Auth::user()->rol
                    == 'Admin') {{--
                    <p>Puede cambiar a Vigente o cancelado</p>
                    --}}
                    <form
                        method="POST"
                        action="{{ route('requests.changeStatus', ['request' => $requests->id, 'newStatus' => 'Vigente']) }}"
                        style="display: inline"
                    >
                        @csrf @method('PATCH')
                        <button
                            type="button"
                            onclick="confirmarCambioEstado(this.form, 'Vigente')"
                            class="btn btn-success"
                        >
                            Iniciar vigencia
                        </button>
                    </form>

                    <button type="button" value="cancelar">cancelar</button>
                    @elseif(Auth::user()->id == $requests->user->id)
                    {{-- puede cambiar a vigente --}}
                    <form
                        method="POST"
                        action="{{ route('requests.changeStatus', ['request' => $requests->id, 'newStatus' => 'Vigente']) }}"
                        style="display: inline"
                    >
                        @csrf @method('PATCH')
                        <button
                            type="button"
                            onclick="confirmarCambioEstado(this.form, 'Vigente')"
                            class="btn btn-success"
                        >
                            Iniciar vigencia
                        </button>
                    </form>
                    @endif @endif @if($requests->status == "Vigente")
                    @if(Auth::user()->rol == 'Laboratorio' || Auth::user()->rol
                    == 'Admin') {{--
                    <p>Puede cambiar a Vencido o concluido</p>
                    --}}
                    <form
                        method="POST"
                        action="{{ route('requests.changeStatus', ['request' => $requests->id, 'newStatus' => 'Concluido']) }}"
                        style="display: inline"
                    >
                        @csrf @method('PATCH')
                        <button
                            type="button"
                            onclick="confirmarCambioEstado(this.form, 'Concluido')"
                            class="btn btn-success"
                        >
                            Concluir
                        </button>
                    </form>
                    <form
                        method="POST"
                        action="{{ route('requests.changeStatus', ['request' => $requests->id, 'newStatus' => 'Vencido']) }}"
                        style="display: inline"
                    >
                        @csrf @method('PATCH')
                        @if(Carbon\Carbon::parse($requests->updated_at)->diffInDays(Carbon\Carbon::now())
                        > 7)
                        @if(Carbon\Carbon::parse($requests->updated_at)->diffInDays(Carbon\Carbon::now())
                        > 7)
                        <button
                            type="button"
                            onclick="confirmarCambioEstado(this.form, 'Vencido')"
                            class="btn btn-success"
                        >
                            Iniciar vencimiento
                        </button>
                        @endif @endif
                    </form>

                    @endif @endif @if($requests->status == "Vencido")
                    @if(Auth::user()->rol == 'Laboratorio' || Auth::user()->rol
                    == 'Admin')
                    <form
                        method="POST"
                        action="{{ route('requests.changeStatus', ['request' => $requests->id, 'newStatus' => 'Concluido']) }}"
                        style="display: inline"
                    >
                        @csrf @method('PATCH')
                        <button
                            type="button"
                            onclick="confirmarCambioEstado(this.form, 'Concluido')"
                            class="btn btn-success"
                        >
                            Concluir
                        </button>
                    </form>
                    @endif @endif
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            // Inicializar DataTable
            var table = $("#miTabla").DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: false,
                info: true,
                autoWidth: true,
                responsive: true,
            });

            // Aplicar filtro personalizado
            $("#estadoFilter").on("change", function () {
                table.column(6).search(this.value).draw(); // Asumiendo que la columna de estado es la 6ta (índice 5)
            });
        });
    </script>

    <script>
        function confirmarCambioEstado(form, nuevoEstado) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: `¿Quieres cambiar el estado de esta solicitud a "${nuevoEstado}"?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, cambiar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.value == true) {
                    form.submit();
                }
            });
        }
    </script>
    @endsection
</div>
