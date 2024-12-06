@extends('layouts.app')

@section('title', 'Detalles del Empleado')

@section('content')
    <div class="container-show-empleados">
        <div class="header">
            <div class="details">
                <div class="name">Sarah Matuz</div>
                <div class="salary">Salario: $ 56,565,656</div>
            </div>
            <div class="actions">
                <button class="dots">⋮</button>
                <button class="edit-button">✏️ Editar</button>
                <button class="new-button">+ Nueva novedad</button>
            </div>
        </div>

        <div class="tabs">
            <div class="tab active">Información general</div>
            <div class="tab">Conceptos recurrentes</div>
        </div>

        <div class="content">
            <div class="info-card">
                <div class="title">Inicio de labores</div>
                <div class="value">1/11/2024</div>
            </div>
            <div class="info-card">
                <div class="title">Tiempo laborado</div>
                <div class="value">36 días</div>
            </div>
            <div class="info-card">
                <div class="title">Cargo</div>
                <div class="value">linda</div>
            </div>
            <div class="info-card">
                <div class="title">Salario neto</div>
                <div class="value">$ 56,565,656</div>
            </div>
            <div class="info-card">
                <div class="title">Días de vacaciones</div>
                <div class="value">0</div>
            </div>
        </div>
    </div>
@endsection
