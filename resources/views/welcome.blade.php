@extends('layouts.master')

@section('styles')
<!-- DATA TABLES CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="{{asset('build/assets/libs/leaflet/leaflet.css')}}">

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

    .custom-card {
        height: 100%;
        width: auto;
    }
</style>
@endsection

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">Parques</h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb breadcrumb-example1">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Parques</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card custom-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Filtros</div>
        <div class="d-flex justify-content-end">
            <!-- Aquí se podrían añadir los filtros de búsqueda -->
        </div>
    </div>
    <div class="card-body">
        <table id="tabla-parques" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Propietario</th>
                    <th>Región</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                    <th>Último Levantamiento</th>
                </tr>
            </thead>
            <tbody>
                @foreach($parques as $parque)
                    <tr>
                        <td>{{ $parque->nombre }}</td>
                        <td>{{ $parque->codigo }}</td>
                        <td>
                            @foreach($propietarios as $propietario)
                                @if($propietario->id == $parque->propietario_id)
                                    {{ $propietario->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $parque->region_id }}</td>
                        <td>{{ $parque->lat }}</td>
                        <td>{{ $parque->lon }}</td>
                        <td>
                            @foreach($levantamientos as $levantamiento)
                                @if($levantamiento->parque_id == $parque->id)
                                    {{ $levantamiento->fecha }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<!-- DATA TABLES JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabla-parques').DataTable({
            responsive: true,
            autoWidth: false
        });
    });
</script>
@endsection
