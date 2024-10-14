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
    <h1 class="page-title fw-semibold fs-18 mb-0">Raspberrys</h1>
    <div class="ms-md-1 ms-0">
        <nav>
            <ol class="breadcrumb breadcrumb-example1">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Inicio</a>
                </li>
            </ol>
        </nav>
    </div>
</div>

    <div class="col-xl-12">
        <div class="card-body">
            <div class="table-responsive">
                <table id="raspTable" class="table table-bordered text-nowrap w-100">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Nombre Rasp</th>
                            <th scope="col" class="text-center">Estado</th>
                            <th scope="col" class="text-center">Controlar</th>
                            <th scope="col" class="text-center">Historial Subida</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($codigos as $codigo)
                        <tr>
                            <td class="text-center">{{ $codigo }}</td>
                            <td class="text-center"> Activa </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-icon waves-effect waves-light btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Controllar">
                                    <i class="bx bx-mouse-alt"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <!-- Aquí se actualiza el botón para redirigir al historial correspondiente -->
                                <a href="{{ url('/historial/' . $codigo) }}" class="btn btn-icon waves-effect waves-light btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Historial">
                                    <i class="bx bx-history"></i>
                                </a>
                            </td>
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

<script src="https:////cdn.datatables.net/plug-ins/2.0.4/i18n/es-ES.json"></script>

<script>
    $(document).ready(function () {
        // Inicializa DataTable
        var table = $('#raspTable').DataTable({
            responsive: true,
        });
    });
</script>
@endsection