@extends('layouts.app')

@section('title', 'Detalles del Empleado')

@section('content')
<div class="container my-4">
    <style>
        .container {
            margin-top: 20px;
        }

        .card {
            border: none;
        }

        .card-header {
            background-color: var(--color-primary-light);
            color: white;
            text-align: center;
        }

         

        .header-title {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            padding: 10px;
        }

        .information-card {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .information-card h5 {
            border-bottom: 2px solid var(--color-primary-light);
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .information-card p {
            margin: 5px 0;
        }

        .summary-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .summary-card p {
            margin: 5px 0;
        }

        .nav-tabs {
            margin-bottom: 20px;
        }

        .nav-tabs .nav-link {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-bottom: none;
            margin-right: 5px;
        }

        .nav-tabs .nav-link.active {
            background-color: var(--color-primary-light);
            color: white;
        }

    </style>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Detalles del Empleado</h3>
        </div>
        <div class="card-body">
            <!-- Encabezado con el nombre -->
            <div class="header-title">
                {{ $empleado->nombre_completo }}
            </div>

            <!-- Tarjetas de Resumen -->
            <div class="summary-card">
                <p><strong>Fecha de Contratación:</strong> {{ $empleado->fecha_contratacion }}</p>
                <p><strong>Fecha Fin de Contrato:</strong> {{ $empleado->fecha_fin_contrato }}</p>
                <p><strong>Días Trabajados:</strong> {{ $empleado->dias_trabajados }}</p>
                <p><strong>Cargo:</strong> {{ $empleado->cargo }}</p>
                <p><strong>Salario Neto:</strong> {{ number_format($empleado->salario_neto, 2) }}</p>
                <p><strong>Días de Vacaciones:</strong> {{ $empleado->dias_vacaciones }}</p>
            </div>

            <!-- Pestañas -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Información General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Conceptos Recurrentes</a>
                </li>
            </ul>

            <!-- Información en Columnas -->
            <div class="row">
                <div class="col">
                    <!-- Información General -->
                    <div class="information-card">
                        <h5>Información General</h5>
                        <p><strong>Nombre Completo:</strong> {{ $empleado->nombre_completo }}</p>
                        <p><strong>Tipo de Identificación:</strong> {{ $empleado->tipo_identificacion }}</p>
                        <p><strong>Número de Identificación:</strong> {{ $empleado->numero_identificacion }}</p>
                        <p><strong>Municipio:</strong> {{ $empleado->municipio }}</p>
                        <p><strong>Dirección:</strong> {{ $empleado->direccion }}</p>
                        <p><strong>Celular:</strong> {{ $empleado->celular }}</p>
                        <p><strong>Correo Electrónico:</strong> {{ $empleado->correo }}</p>
                    </div>
                </div>
                <div class="col">
                    <!-- Información Laboral -->
                    <div class="information-card">
                        <h5>Información Laboral</h5>
                        <p><strong>Tipo de Contrato:</strong> {{ $empleado->tipo_contrato }}</p>
                        <p><strong>Salario:</strong> {{ number_format($empleado->salario, 2) }}</p>
                        <p><strong>Tipo de Trabajador:</strong> {{ $empleado->tipo_trabajador }}</p>
                        <p><strong>Subtipo de Trabajador:</strong> {{ $empleado->subtipo_trabajador }}</p>
                        <p><strong>Área:</strong> {{ $empleado->area }}</p>
                        <p><strong>Puesto de Trabajo:</strong> {{ $empleado->puesto_trabajo }}</p>
                        <p><strong>Frecuencia de Pago:</strong> {{ $empleado->frecuencia_pago }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <!-- Datos de Pago -->
                    <div class="information-card">
                        <h5>Datos de Pago</h5>
                        <p><strong>Método de Pago:</strong> {{ $empleado->metodo_pago }}</p>
                        <p><strong>Banco:</strong> {{ $empleado->banco }}</p>
                        <p><strong>Número de Cuenta:</strong> {{ $empleado->numero_cuenta }}</p>
                        <p><strong>Tipo de Cuenta:</strong> {{ $empleado->tipo_cuenta }}</p>
                    </div>
                </div>
                <div class="col">
                    <!-- Entidades -->
                    <div class="information-card">
                        <h5>Entidades</h5>
                        <p><strong>EPS:</strong> {{ $empleado->eps }}</p>
                        <p><strong>Fondo de Pensión:</strong> {{ $empleado->fondo_pensiones }}</p>
                        <p><strong>Fondo de Cesantías:</strong> {{ $empleado->fondo_cesantias }}</p>
                        <p><strong>Caja de Compensación:</strong> {{ $empleado->caja_compensacion }}</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
        </div>
    </div>
</div>
@endsection
