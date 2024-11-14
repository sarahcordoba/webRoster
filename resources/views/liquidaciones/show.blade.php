@extends('layouts.app')

@section('title', 'Lq')

@section('content')
<div class="container">
    <h1>Detalles de la Liquidación</h1>
    <div class="row mt-4" style="display:flex;">
        <div class="col-md-6">
            <div class="card" style="height: 6rem">
                <div class="card-body text-center">
                    <p><strong> Progreso</strong> 10%</p>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="height: 6rem">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Periodo de liquidacion</strong> {{ $liquidacion->fecha_inicio }} - {{ $liquidacion->fecha_fin }}</li>
                    <li class="list-group-item"><strong>Estado:</strong> {{ $liquidacion->estado }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="width: 100%;">
        <ul class="list-group list-group-horizontal list-group-flush">
            <li class="list-group-item d-flex flex-column">
                <strong>Empleados</strong>
                <span>x</span>
            </li>
            <li class="list-group-item d-flex flex-column">
                <strong>Salario:</strong> {{ $liquidacion->salario }}
            </li>
            <li class="list-group-item d-flex flex-column">
                <strong>Total deducciones:</strong> {{ $liquidacion->total_deducciones }}
            </li>
            <li class="list-group-item d-flex flex-column">
                <strong>Total comisiones:</strong> {{ $liquidacion->total_comisiones }}
            </li>
            <li class="list-group-item d-flex flex-column">
                <strong>Total:</strong> {{ $liquidacion->total }}
            </li>
        </ul>
    </div>
    <div class="container my-5">
        <h1 class="titulito">Empleados</h1>
        <div class="titlebutton">
            <p>Gestiona la información de tus empleados/as que vas a tener en cuenta para liquidar la nómina de este período.</p>
            <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#liquidacionModal">
                Agregar empleado
            </button>
        </div>
        <button type="button" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .6rem;">Filtar
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Id</th>
                    <th scope="col">Salarios</th>
                    <th scope="col">Deducciones</th>
                    <th scope="col">Comisiones</th>
                    <th scope="col">Total</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">hola</th>
                    <td>1234567</td>
                    <td>10000000</td>
                    <td>567000</td>
                    <td>230000</td>
                    <td>99999999</td>
                    <td><button type="button" class="btn btn-secondary">Liquidar
                        </button><button type="button" class="btn btn-secondary">Editar
                        </button>
                        <button type="button" class="btn btn-secondary">Ver
                        </button>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
<script type="text/javascript" src="{{ asset('js/forms/empleado-form.js') }}"></script>