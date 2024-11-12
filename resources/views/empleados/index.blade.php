@extends('layouts.app')

@section('title', 'Nuevo Empleado/a')

@section('content')
    <div class="container my-5">
        <h1 class="titulito">Nuevo empleado/a</h1>
        <p>Registra la información de nómina de las personas que integran tu equipo de trabajo.</p>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('empleados.store') }}" method="POST">
            @csrf

            <div id="steps-header" class="steps-header d-flex justify-content-center mb-4">
                <div class="step active">1 Datos principales</div>
                <div class="step">2 Contrato</div>
                <div class="step">3 Datos de pago</div>
            </div>

            <!-- Datos principales -->
            <div class="form-section active">
                <div class="card mb-3">
                    <div class="card-header">Datos principales</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first_name">Primer nombre *</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="middle_name">Segundo nombre</label>
                                <input type="text" id="middle_name" name="middle_name" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Primer apellido *</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="second_last_name">Segundo apellido</label>
                                <input type="text" id="second_last_name" name="second_last_name" class="form-control">
                            </div>
                            <div class="form-group col-md-6"> <label for="id_type">Tipo de identificación
                                    *</label> <select id="id_type" name="id_type"
                                    class="form-control" required>
                                    <option value="cedula_ciudadania">Cédula de ciudadanía</option>
                                    <option value="cedula_extranjeria">Cédula de extranjería</option>
                                    <option value="pasaporte">Pasaporte</option>
                                    <option value="documento_extranjero">Documento de identificación extranjero</option>
                                    <option value="nit">NIT</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="id_number">Identification number *</label>
                                <input type="text" id="id_number" name="id_number" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dirección y contacto -->
                <div class="form-section">
                    <div class="card mb-3">
                        <div class="card-header">Dirección y contacto</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="city">Municipio *</label>
                                    <input type="text" id="city" name="city" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address">Dirección *</label>
                                    <input type="text" id="address" name="address" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Celular</label>
                                    <input type="text" id="phone" name="phone" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Correo electrónico *</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contrato -->
            <div class="form-section hidden">
                <div class="card mb-3">
                    <div class="card-header">Contrato</div>
                    <div class="card-body">
                        <!-- Añade los campos de contrato aquí -->
                    </div>
                </div>
            </div>

            <!-- Datos de pago -->
            <div class="form-section hidden">
                <div class="card mb-3">
                    <div class="card-header">Datos de pago</div>
                    <div class="card-body">
                        <!-- Añade los campos de datos de pago aquí -->
                    </div>
                </div>
            </div>

            <!-- Acciones del formulario -->
            <div class="form-actions d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" onclick="showPreviousSection()">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="showNextSection()">Siguiente</button>
            </div>

            <p class="text-muted mt-3">Los campos marcados con * son obligatorios</p>
        </form>
    </div>
@endsection
<script type="text/javascript" src="{{ asset('js/forms/empleado-form.js') }}"></script>
