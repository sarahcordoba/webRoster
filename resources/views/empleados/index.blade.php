@extends('layouts.app')

@section('title', 'Nuevo Empleado/a')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Empleados 2024</h1>
        <div>
            <a href="{{ route('empleados.create') }}" class="btn btn-primary">+ Nuevo empleado</a>
        </div>
    </div>
    <p>Crea tus empleados uno a uno. Total de empleados: 1</p>
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .6rem;">Filtar
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Id</th>
                        <th scope="col">Salario</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->nombre }}</td>
                        <td>{{ $empleado->cargo }}</td>
                        <td>{{ $empleado->id }}</td>
                        <td>{{ number_format($empleado->salario, 2) }}</td>
                        <td>
                            <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-secondary">Ver Detalles</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    @endsection