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
                {{-- //la tabla --}}
            </div>
        </div>


@endsection