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
                            <label class="requir" for="first_name">Primer nombre</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" required
                                autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="middle_name">Segundo nombre</label>
                            <input type="text" id="middle_name" name="middle_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="requir" for="last_name">Primer apellido</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="second_last_name">Segundo apellido</label>
                            <input type="text" id="second_last_name" name="second_last_name" class="form-control">
                        </div>
                        <div class="form-group"> <label class="requir" for="id_type">Tipo de identificación
                            </label> <select id="id_type" name="id_type" class="form-control" required>
                                <option value="cedula_ciudadania">Cédula de ciudadanía</option>
                                <option value="cedula_extranjeria">Cédula de extranjería</option>
                                <option value="pasaporte">Pasaporte</option>
                                <option value="documento_extranjero">Documento de identificación extranjero</option>
                                <option value="nit">NIT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="requir" for="id_number">Número de identificación</label>
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

                            <div class="form-group"> <label class="requir" for="city">Municipio
                                </label> <select id="city" name="city" class="form-control" required>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="requir" for="address">Dirección</label>
                                <input type="text" id="address" name="address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="requir" for="phone">Celular</label>
                                <input type="text" id="phone" name="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="requir" for="email">Correo electrónico</label>
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
                        <div class="form-group"> <label class="requir" for="type_contract">Tipo de contrato
                            </label> <select id="type_contract" name="type_contract" class="form-control" required>
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
                                <label class="requir" for="hiring_date">Fecha de contratación</label>
                                <input type="date" id="hiring_date" name="hiring_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="requir" for="contract_end_date">Fecha de fin de contrato</label>
                                <input type="date" id="contract_end_date" name="contract_end_date"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="row_d">
                            <div class="form-group"> <label class="requir" for="salary">Salario</label>
                                <div class="input-group"> <span class="input-group-text">$</span> <input type="text"
                                        id="salary" name="salary" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-group-radio">
                                <label class="requir" for="salario_integral">Salario Integral</label>
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
                        <div class="form-group"> <label class="requir" for="paym_frec">Frecuencia de pago
                            </label> <select id="paym_frec" name="paym_frec" class="form-control" required>
                                <option value="mensual">Mensual</option>
                                <option value="quincenal">Quincenal</option>
                            </select>
                        </div>
                        <div class="form-group"> <label class="requir" for="worker_type">Tipo de trabajador
                            </label> <select id="worker_type" name="worker_type" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group"> <label class="requir" for="worker_subtype">Subtipo de trabajador
                            </label> <select id="worker_subtype" name="worker_subtype" class="form-control" required>
                                <option value="no_aplica">No aplica</option>
                                <option value="dependiente_pensionado_vejez">Dependiente pensionado por vejez activa
                                </option>
                            </select>
                        </div>
                        <div class="row_d">
                            <div class="form-group form-group-radio">
                                <label class="requir" for="salario_integral">Auxilio de transporte</label>
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
                                <label class="requir" for="salario_integral">Alto riesgo</label>
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
                                <label class="requir" for="salario_integral">¿Sábado laboral?</label>
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
                        <div class="form-group"> <label class="requir" for="risk_level" class="R">Nivel de
                                riesgo</label> <select id="risk_level" name="risk_level" class="form-control" required>
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
                                <label class="requir" for="city">Cargo</label>
                                <input type="text" id="charge" name="charge" class="form-control" required>
                            </div>
                            <div class="form-group"> <label class="requir" for="area">Área</label> <select
                                    id="area" name="area" class="form-control" required>
                                    <option value="administrativa">Administrativa</option>
                                    <option value="operativa">Operativa</option>
                                    <option value="ventas">Ventas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="requir" for="address">Días de vacaciones acumuladas</label>
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
                        <div class="form-group"> <label class="requir" for="payment_method">Método de pago
                            </label> <select id="payment_method" name="payment_method" class="form-control" required>
                                <option value="pago_efectivo">Pago en efectivo</option>
                                <option value="transferencia_bancaria">Transferencia bancaria</option>
                                <option value="cheque_bancario">Cheque bancario</option>
                                <option value="pago_especie">Pago en especie (bonos o vales)</option>
                            </select>
                        </div>

                        <div id="transferencia_info" style="display: none;">
                            <div class="form-group">
                                <label for="banco">Banco</label>
                                <select id="banco" name="banco" class="form-control">
                                    <option value="bancamia">Bancamía</option>
                                    <option value="bancolombia">Bancolombia</option>
                                    <option value="bancoomeva">Bancoomeva</option>
                                    <option value="banco_agrario">Banco Agrario</option>
                                    <option value="banco_av_villas">Banco AV Villas</option>
                                    <option value="banco_caja_social">Banco Caja Social</option>
                                    <option value="banco_credifinanciera">Banco Credifinanciera</option>
                                    <option value="banco_bogota">Banco de Bogotá</option>
                                    <option value="banco_occidente">Banco de Occidente</option>
                                    <option value="banco_falabella">Banco Falabella</option>
                                    <option value="banco_finandina">Banco Finandina</option>
                                    <option value="banco_gnb_sudameris">Banco GNB Sudameris</option>
                                    <option value="banco_jp_morgan">Banco J.P. MORGAN</option>
                                    <option value="banco_mundo_mujer">Banco Mundo Mujer</option>
                                    <option value="banco_nu">Banco NU</option>
                                    <option value="banco_pichincha">Banco Pichincha</option>
                                    <option value="banco_popular">Banco Popular</option>
                                    <option value="banco_santander">Banco Santander</option>
                                    <option value="banco_serfinanza">Banco Serfinanza</option>
                                    <option value="banco_w">Banco W</option>
                                    <option value="bbva">BBVA</option>
                                    <option value="citibank">Citibank</option>
                                    <option value="coopcentral">Coopcentral</option>
                                    <option value="cooperativa_confiar">Cooperativa Confiar</option>
                                    <option value="cooperativa_cootramed">Cooperativa Cootramed</option>
                                    <option value="cooperativa_cotrafa">Cooperativa Cotrafa</option>
                                    <option value="cooperativa_acn">Cooperativa de Ahorro y Crédito Nacional</option>
                                    <option value="cooperativa_fa">Cooperativa Financiera de Antioquia</option>
                                    <option value="cooperativa_uh">Cooperativa Utrahuilca</option>
                                    <option value="cooprofesores">Cooprofesores</option>
                                    <option value="davivienda">Davivienda</option>
                                    <option value="daviplata">Daviplata</option>
                                    <option value="mibanco">Mibanco</option>
                                    <option value="nequi">Nequi</option>
                                    <option value="itau">Itaú</option>
                                    <option value="scotibank_colpatria">Scotibank Colpatria</option>
                                    <option value="juriscoop">Juriscoop</option>
                                    <option value="dale">DALE</option>
                                    <option value="crediflores">Crediflores</option>
                                    <option value="lulo_bank">Lulo Bank</option>
                                    <option value="global66">Global66</option>
                                    <option value="rappipay">RappiPay</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="numero_cuenta">Número de cuenta</label>
                                <input type="text" id="numero_cuenta" name="numero_cuenta" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tipo_cuenta">Tipo de cuenta</label>
                                <select id="tipo_cuenta" name="tipo_cuenta" class="form-control">
                                    <option value="corriente">Corriente</option>
                                    <option value="ahorro">Ahorro</option>
                                    <option value="billetera_digital">Billetera digital</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-section">
                    <div class="card mb-3">
                        <div class="card-header">Afiliación</div>
                        <div class="card-body">
                            <div class="form-group"> <label class="requir" for="eps">EPS
                                </label> <select id="eps" name="eps" class="form-control" required>
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
                            <div class="form-group"> <label class="requir" for="caja_compensacion">Caja de compensación
                                </label> <select id="caja_compensacion" name="caja_compensacion" class="form-control"
                                    required>
                                    <option value="administrativa">Administrativa</option>
                                    <option value="operativa">Operativa</option>
                                    <option value="ventas">Ventas</option>
                                </select>
                            </div>
                            <div class="form-group"> <label class="requir" for="fondo_pensiones">Fondo de pensiones
                                </label> <select id="fondo_pensiones" name="fondo_pensiones" class="form-control"
                                    required>
                                    <option value="administrativa">Administrativa</option>
                                    <option value="operativa">Operativa</option>
                                    <option value="ventas">Ventas</option>
                                </select>
                            </div>
                            <div class="form-group"> <label class="requir" for="caja_compensacion">Caja de compensación
                                </label> <select id="caja_compensacion" name="caja_compensacion" class="form-control"
                                    required>
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
