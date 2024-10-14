@extends('layouts.master')

@section('styles')
<!-- DATA TABLES CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<style>
    .btn-icon {
        line-height: 10px;
    }

    .custom-icon {
        width: 15px;
        height: 15px;
        vertical-align: middle;
        display: inline-block;
    }

    .tooltip-middle .tooltip-inner {
        margin-top: -3px;
    }
</style>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">Historial de {{$codigo}}</h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb breadcrumb-example1">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Historal</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card custom-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Filtros</div>
        <div class="d-flex justify-content-end align-items-center">
            <div class="d-flex align-items-center me-3">
                <label for="estadoFilter" class="form-label me-2">Estado:</label>
                <select id="estadoFilter" class="form-select form-select-sm" style="width: 200px;">
                    <option value="todos">Todos</option>
                    <option value="Error">Error</option>
                    <option value="En cola">En cola</option>
                    <option value="Subiendo">Subiendo</option>
                    <option value="Exito">Exito</option>
                </select>
            </div>
            <div class="d-flex align-items-center me-3">
                <label for="fechaFilter" class="form-label me-2">Fecha:</label>
                <select id="fechaFilter" class="form-select form-select-sm" style="width: 200px;">
                    <option value="todos">Todos</option>
                    <option value="hoy">Hoy</option>
                    <option value="ayer">Ayer</option>
                    <option value="semana">Esta semana</option>
                    <option value="mes">Este mes</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12">
    <div class="card-body">
        <div class="table-responsive">
            <table id="historialTable" class="table table-bordered text-nowrap w-100">
                <thead>
                    <tr>
                        @php
                        $headers = $csvData[0];
                        array_shift($csvData);
                        @endphp
                        <th scope="col" class="text-center"> Carpeta </th>
                        <th scope="col" class="text-center"> Mb Locales</th>
                        <th scope="col" class="text-center"> Mb S3</th>
                        <th scope="col" class="text-center">Directorio S3</th>
                        <th scope="col" class="text-center">Estado</th> <!-- Columna de estado -->
                        <th scope="col" class="text-center">Fecha Subida</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($csvData as $row)
                    @if ($row[0] == '' )
                    @continue
                    @endif

                    <tr>
                        @foreach ($row as $cell)
                        <td class="text-center">{{ $cell }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- JQUERY JS -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<!-- DATATABLES CDN JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script src="https://cdn.datatables.net/plug-ins/2.0.4/i18n/es-ES.json"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<script>
    $(document).ready(function () {
        // Inicializa DataTable con orden personalizado
    var table = $('#historialTable').DataTable({
        responsive: true,
        order: [[4, 'asc']],  // Ordenar por la columna de estado (índice 4)
        columnDefs: [
            {
                targets: 4,  // Índice de la columna "Estado"
                orderDataType: 'estado-precedence',  // Tipo de orden personalizado
                orderable: true
            }
        ]
    });

    // Definir el orden personalizado para los estados
    $.fn.dataTable.ext.order['estado-precedence'] = function (settings, colIndex) {
        return this.api().column(colIndex, { order: 'index' }).nodes().map(function (td, i) {
            var estado = $(td).text();

            // Asignar valor numérico según el estado
            switch (estado) {
                case 'Subiendo':
                    return 1;  // Prioridad más alta
                case 'En cola':
                    return 2;
                case 'Error':
                    return 3;
                case 'Exito':
                    return 4;  // Prioridad más baja
                default:
                    return 5;  // Si no coincide con ninguno, asignar un valor alto para ir al final
            }
        });
    };

        // Función para aplicar filtros
        function filterTable() {
            var estadoSeleccionado = $('#estadoFilter').val();
            var fechaSeleccionada = $('#fechaFilter').val();
            var hoy = moment().startOf('day');
            var ayer = moment().subtract(1, 'days').startOf('day');
            var inicioSemana = moment().startOf('week');
            var inicioMes = moment().startOf('month');

            // Filtrar por estado
            if (estadoSeleccionado !== 'todos') {
                table.column(4).search(estadoSeleccionado).draw();  // Columna de estado es la 5ta (índice 4)
            } else {
                table.column(4).search('').draw();  // Mostrar todos si es 'todos'
            }

            // Filtrar por fecha
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var fechaSubida = moment(data[5], 'YYYY-MM-DD');  // Columna de Fecha Subida (índice 5)
                if (fechaSeleccionada === 'hoy') {
                    return fechaSubida.isSame(hoy, 'day');
                } else if (fechaSeleccionada === 'ayer') {
                    return fechaSubida.isSame(ayer, 'day');
                } else if (fechaSeleccionada === 'semana') {
                    return fechaSubida.isSameOrAfter(inicioSemana);
                } else if (fechaSeleccionada === 'mes') {
                    return fechaSubida.isSameOrAfter(inicioMes);
                }
                return true;  // Si es "todos", no filtramos
            });

            table.draw();
        }

        // Al cambiar el estado o la fecha, aplicar el filtro
        $('#estadoFilter, #fechaFilter').on('change', function () {
            $.fn.dataTable.ext.search.pop();  // Elimina cualquier filtro previo antes de aplicar el nuevo
            filterTable();
        });

        // Inicialización de tabla
        filterTable();  // Aplicar el filtro inicial si ya hay un estado seleccionado

        function actualizarTabla() {
    $.ajax({
        url: '{{ route("fetchHistorialJson", ["codigo" => $codigo]) }}',
        method: 'GET',
        success: function (data) {
            // Limpiar la tabla existente
            table.clear();

            // Contar el número de columnas de la tabla
            var numColumns = $('#historialTable thead tr th').length;

            // Insertar las nuevas filas de datos
            data.forEach(function (fila) {
                if (fila.length === numColumns) {  // Asegúrate de que la fila tenga el número correcto de columnas
                    table.row.add(fila);
                } else {
                    console.error("La fila no tiene el número correcto de columnas:", fila);
                }
            });

            // Redibujar la tabla con los nuevos datos
            table.draw();
        },
        error: function () {
            console.error("Error al actualizar los datos");
        }
    });
}


        // Actualizar la tabla automáticamente cada 5 segundos
        setInterval(actualizarTabla, 5000);
    });
</script>
@endsection
