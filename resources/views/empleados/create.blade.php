@extends('layouts.app')

@section('title', 'Nuevo Empleado/a')

@section('content')
    <div class="container">
        <h1 class="titulito">Nuevo empleado/a</h1>
        <p>Registra la información de nómina de las personas que integran tu equipo de trabajo.</p>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('empleados.store') }}" method="POST" id="empleado_form " autocomplete="off">
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
                        {{-- <div class="row"> --}}
                        <div class="form-group">
                            <label for="first_name">Primer nombre *</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" required
                                autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="middle_name">Segundo nombre</label>
                            <input type="text" id="middle_name" name="middle_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Primer apellido *</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="second_last_name">Segundo apellido</label>
                            <input type="text" id="second_last_name" name="second_last_name" class="form-control">
                        </div>
                        <div class="form-group"> <label for="id_type">Tipo de identificación
                                *</label> <select id="id_type" name="id_type" class="form-control" required>
                                <option value="cedula_ciudadania">Cédula de ciudadanía</option>
                                <option value="cedula_extranjeria">Cédula de extranjería</option>
                                <option value="pasaporte">Pasaporte</option>
                                <option value="documento_extranjero">Documento de identificación extranjero</option>
                                <option value="nit">NIT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_number">Número de identificación *</label>
                            <input type="text" id="id_number" name="id_number" class="form-control" required>
                        </div>
                        {{-- </div> --}}
                    </div>
                </div>

                <!-- Dirección y contacto -->
                <div class="form-section">
                    <div class="card mb-3">
                        <div class="card-header">Dirección y contacto</div>
                        <div class="card-body">
                            {{-- <div class="row"> --}}
                            {{-- <div class="form-group">
                                <label for="city">Municipio *</label>
                                <input type="text" id="city" name="city" class="form-control" required>
                            </div> --}}

                            <div class="form-group"> <label for="city">Municipio
                                    *</label> <select id="city" name="city" class="form-control" required>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="address">Dirección *</label>
                                <input type="text" id="address" name="address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Celular</label>
                                <input type="text" id="phone" name="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico *</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contrato -->
            <div class="form-section hidden">
                <div class="card mb-3">
                    <div class="card-header">Contrato</div>
                    <div class="card-body">
                        {{-- <div class="row"> --}}
                        <div class="form-group"> <label for="type_contract">Tipo de contrato
                                *</label> <select id="type_contract" name="type_contract" class="form-control" required>
                                <option value="termino_fijo">Término Fijo</option>
                                <option value="termino_indefinido">Término Indefinido</option>
                                <option value="labor_obra">Labor u obra</option>
                                <option value="aprendizaje">Aprendizaje</option>
                                {{-- <option value="practica">Práctica</option>
                                <option value="pasantia">Pasantía</option> --}}
                            </select>
                        </div>
                        <div class="row_d">
                            <div class="form-group">
                                <label for="hiring_date">Fecha de contratación *</label>
                                <input type="date" id="hiring_date" name="hiring_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contract_end_date">Fecha de fin de contrato *</label>
                                <input type="date" id="contract_end_date" name="contract_end_date"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="row_d">
                            <div class="form-group"> <label for="salary">Salario *</label>
                                <div class="input-group"> <span class="input-group-text">$</span> <input
                                        type="text" id="salary" name="salary" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-group-radio">
                                <label for="salario_integral">Salario Integral *</label>
                                <div>
                                    <div class="form-check form-check-inline radios ">
                                        <input class="form-check-input" type="radio" name="salario_integral"
                                            id="salario_integral_si" value="si">
                                        <label class="form-check-label" for="salario_integral_si">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline radios">
                                        <input class="form-check-input" type="radio" name="salario_integral"
                                            id="salario_integral_no" value="no" checked>
                                        <label class="form-check-label" for="salario_integral_no">No</label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group"> <label for="paym_frec">Frecuencia de pago
                                *</label> <select id="paym_frec" name="paym_frec" class="form-control" required>
                                <option value="mensual">Mensual</option>
                                <option value="quincenal">Quincenal</option>
                            </select>
                        </div>
                        <div class="form-group"> <label for="worker_type">Tipo de trabajador
                                *</label> <select id="worker_type" name="worker_type" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group"> <label for="worker_subtype">Subtipo de trabajador
                                *</label> <select id="worker_subtype" name="worker_subtype" class="form-control"
                                required>
                                <option value="no_aplica">No aplica</option>
                                <option value="dependiente_pensionado_vejez">Dependiente pensionado por vejez activa
                                </option>
                            </select>
                        </div>
                        <div class="row_d">
                            <div class="form-group form-group-radio">
                                <label for="salario_integral">Auxilio de transporte *</label>
                                <div>
                                    <div class="form-check form-check-inline radios">
                                        <input class="form-check-input" type="radio" name="aux_transp"
                                            id="aux_transp_si" value="si">
                                        <label class="form-check-label" for="aux_transp_si">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline radios">
                                        <input class="form-check-input" type="radio" name="aux_transp"
                                            id="aux_transp_no" value="no" checked>
                                        <label class="form-check-label" for="aux_transp_no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-radio">
                                <label for="salario_integral">Alto riesgo *</label>
                                <div>
                                    <div class="form-check form-check-inline radios">
                                        <input class="form-check-input" type="radio" name="aux_transport"
                                            id="aux_transport_si" value="si">
                                        <label class="form-check-label" for="aux_transport_si">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline radios">
                                        <input class="form-check-input" type="radio" name="alto_riesgo"
                                            id="alto_riesgo_no" value="no" checked>
                                        <label class="form-check-label" for="alto_riesgo_no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-radio">
                                <label for="salario_integral">¿Sábado laboral? *</label>
                                <div>
                                    <div class="form-check form-check-inline radios">
                                        <input class="form-check-input" type="radio" name="sabado_laboral"
                                            id="sabado_laboral_si" value="si">
                                        <label class="form-check-label" for="sabado_laboral_si">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline radios">
                                        <input class="form-check-input" type="radio" name="sabado_laboral"
                                            id="sabado_laboral_no" value="no" checked>
                                        <label class="form-check-label" for="sabado_laboral_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"> <label for="risk_level" class="R">Nivel de riesgo *</label> <select
                                id="risk_level" name="risk_level" class="form-control" required>
                                <option value="I">Riesgo I - 0.522%</option>
                                <option value="II">Riesgo I - 1.044%</option>
                                <option value="III">Riesgo III - 2.436%</option>
                                <option value="IV">Riesgo IV - 4.350%</option>
                                <option value="V">Riesgo V - 6.960%</option>
                            </select>
                        </div>


                        {{-- </div> --}}
                    </div>
                </div>

                <div class="form-section">
                    <div class="card mb-3">
                        <div class="card-header">Puesto de trabajo</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="city">Cargo *</label>
                                <input type="text" id="charge" name="charge" class="form-control" required>
                            </div>
                            <div class="form-group"> <label for="area">Área
                                    *</label> <select id="area" name="area" class="form-control" required>
                                    <option value="administrativa">Administrativa</option>
                                    <option value="operativa">Operativa</option>
                                    <option value="ventas">Ventas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Días de vacaciones acumuladas *</label>
                                <input type="text" id="holiday" name="holiday" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Datos de pago -->
            <div class="form-section hidden">
                <div class="card mb-3">
                    <div class="card-header">Datos de pago</div>
                    <div class="card-body">
                        <div class="form-group"> <label for="payment_method">Método de pago
                                *</label> <select id="payment_method" name="payment_method" class="form-control"
                                required>
                                <option value="transferencia_bancaria">Transferencia bancaria</option>
                                <option value="cheque_bancario">Cheque bancario</option>
                                <option value="pago_efectivo">Pago en efectivo</option>
                                <option value="tarjeta_preparada">Tarjeta prepagada</option>
                                <option value="pse">Pago Seguro en Línea (PSE)</option>
                                <option value="pago_movil">Pago por medio de plataformas móviles (Nequi, Daviplata)
                                </option>
                                <option value="pago_especie">Pago en especie (bonos o vales)</option>
                                <option value="paypal">Pago por PayPal</option>
                                <option value="fintech">Pago a través de fintechs</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="card mb-3">
                        <div class="card-header">Afiliación</div>
                        <div class="card-body">
                            <div class="form-group"> <label for="eps">EPS
                                    *</label> <select id="eps" name="eps" class="form-control" required>
                                    <option value="transferencia_bancaria">Transferencia bancaria</option>
                                    <option value="cheque_bancario">Cheque bancario</option>
                                    <option value="pago_efectivo">Pago en efectivo</option>
                                    <option value="tarjeta_preparada">Tarjeta prepagada</option>
                                    <option value="pse">Pago Seguro en Línea (PSE)</option>
                                    <option value="pago_movil">Pago por medio de plataformas móviles (Nequi, Daviplata)
                                    </option>
                                    <option value="pago_especie">Pago en especie (bonos o vales)</option>
                                    <option value="paypal">Pago por PayPal</option>
                                    <option value="fintech">Pago a través de fintechs</option>
                                </select>
                            </div>
                            <div class="form-group"> <label for="caja_compensacion">Caja de compensación
                                    *</label> <select id="caja_compensacion" name="caja_compensacion"
                                    class="form-control" required>
                                    <option value="administrativa">Administrativa</option>
                                    <option value="operativa">Operativa</option>
                                    <option value="ventas">Ventas</option>
                                </select>
                            </div>
                            <div class="form-group"> <label for="fondo_pensiones">Fondo de pensiones
                                    *</label> <select id="fondo_pensiones" name="fondo_pensiones" class="form-control"
                                    required>
                                    <option value="administrativa">Administrativa</option>
                                    <option value="operativa">Operativa</option>
                                    <option value="ventas">Ventas</option>
                                </select>
                            </div>
                            <div class="form-group"> <label for="caja_compensacion">Caja de compensación
                                    *</label> <select id="caja_compensacion" name="caja_compensacion"
                                    class="form-control" required>
                                    <option value="administrativa">Administrativa</option>
                                    <option value="operativa">Operativa</option>
                                    <option value="ventas">Ventas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones del formulario -->
            <div class="form-actions">
                <button type="button" class="btn btn-outline-primary" onclick="showPreviousSection()">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="showNextSection()">Siguiente</button>
            </div>

            <p class="mt-3">Los campos marcados con * son obligatorios</p>
        </form>
    </div>
@endsection
<script type="text/javascript" src="{{ asset('js/forms/empleado-form.js') }}"></script>
