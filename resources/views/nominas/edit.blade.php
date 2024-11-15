@extends('layouts.app')

@section('title', 'Lq')

@section('content')
<div class="container">
    <h1>Detalles de la Liquidación</h1>

    <div class="card" style="width: 100%; height: fit-content">
        <div class="card-body text-center">
            <p style="font-size:xx-large"><strong> Colilla de pago</strong></p>
            <p style="font-size:x-large"><strong>Resumen del Pago</strong></p>

            <div class="card">
                <style>
                    p {
                        margin-bottom: 0;
                    }
                </style>
                <p>datos de la empresa</p>
                <p>nit</p>
                <p>direccion</p>
                <p>correo</p>
            </div>
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Empleado:</strong> {{ $nomina->empleado->primer_nombre}} {{ $nomina->empleado->segundo_nombre}} {{ $nomina->empleado->primer_apellido}} {{ $nomina->empleado->segundo_apellido}}</li>
                    <li class="list-group-item"><strong>Identificacion:</strong> {{ $nomina->empleado->id}}</li>
                    <li class="list-group-item"><strong>Periodo de liquidacion:</strong> {{ $nomina->liquidacion->fecha_inicio }} - {{ $nomina->liquidacion->fecha_fin }}</li>
                    <li class="list-group-item"><strong>Estado:</strong> {{ $nomina->estado }}</li>
                </ul>
            </div>
            <div class="card">
                <ul class="list-group list-group-horizontal list-group-flush">
                    <li class="list-group-item d-flex flex-column">
                        <strong>Salario:</strong> ${{ number_format($nomina->salario_base,2) }}
                    </li>
                    <li class="list-group-item d-flex flex-column">
                        <strong>Total deducciones:</strong> ${{ number_format($nomina->total_deducciones,2) }}
                    </li>
                    <li class="list-group-item d-flex flex-column">
                        <strong>Total comisiones:</strong> ${{ number_format($nomina->total_comisiones,2) }}
                    </li>
                    <li class="list-group-item d-flex flex-column">
                        <strong>Total:</strong> ${{ number_format($nomina->total,2) }}
                    </li>
                </ul>
            </div>

            <p style="font-size:x-large"><strong>Comisiones</strong></p>

            <div class="card">
                <ul class="list-group">
                    @foreach($comisionesAplicadas as $comisiona)
                    <ul class="list-group list-group-horizontal list-group-flush">
                        <li class="list-group-item d-flex flex-column">
                            <strong>Tipo</strong> {{ $comisiona->comision->tipo }}
                        </li>
                        <li class="list-group-item d-flex flex-column">
                            <strong>Descripción</strong> {{ $comisiona->comision->descripcion }}
                        </li>
                        <li class="list-group-item d-flex flex-column">
                            <strong>Porcentaje</strong>
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="isPercentage-{{ $comisiona->id }}"
                                    name="esporcentaje[{{ $comisiona->id }}]"
                                    value="1"
                                    {{ $comisiona->esporcentaje ? 'checked' : '' }}
                                    @if(in_array($comisiona->comision_id, [1, 2, 3])) disabled @endif>
                                <label class="form-check-label" for="isPercentage-{{ $comisiona->id }}">
                                    ¿Es porcentaje?
                                </label>
                            </div>

                            <input
                                type="number"
                                step="0.01"
                                class="form-control mt-2"
                                id="percentageInput-{{ $comisiona->id }}"
                                name="porcentaje[{{ $comisiona->id }}]"
                                value="{{ $comisiona->esporcentaje ? $comisiona->monto : '' }}"
                                placeholder="Porcentaje (%)"
                                @if(!$comisiona->esporcentaje || in_array($comisiona->comision_id, [1, 2, 3])) disabled @endif>
                        </li>

                        <li class="list-group-item d-flex flex-column">
                            <strong>Monto</strong>
                            <input
                                type="number"
                                step="0.01"
                                class="form-control mt-2"
                                id="amountInput-{{ $comisiona->id }}"
                                name="monto[{{ $comisiona->id }}]"
                                value="{{ !$comisiona->esporcentaje ? $comisiona->monto : '' }}"
                                placeholder="Monto ($)"
                                @if($comisiona->esporcentaje || in_array($comisiona->comision_id, [1])) disabled @endif>
                        </li>

                        <li class="list-group-item d-flex flex-column">
                            <form id="delete-comision-{{ $comisiona->comision_id }}"
                                action="{{ route('comisionnomina.delete', [$comisiona->nomina_id, $comisiona->comision_id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary" onclick="return confirm('¿Estás seguro de que deseas eliminar esta comisión?');">
                                    X
                                </button>
                            </form>

                        </li>
                    </ul>
                    @endforeach

                </ul>
            </div>

            <p style="font-size:x-large"><strong>Deducciones</strong></p>

            <div class="card">
                <ul class="list-group">
                    @foreach($deduccionesAplicadas as $deducciona)
                    <ul class="list-group list-group-horizontal list-group-flush">
                        <li class="list-group-item d-flex flex-column">
                            <strong>Tipo</strong> {{ $deducciona->deduccion->tipo }}
                        </li>
                        <li class="list-group-item d-flex flex-column">
                            <strong>Descripción</strong> {{ $deducciona->deduccion->descripcion }}
                        </li>
                        <li class="list-group-item d-flex flex-column">
                            <strong>Porcentaje</strong>
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="isPercentage-{{ $deducciona->id }}"
                                    name="esporcentaje[{{ $deducciona->id }}]"
                                    value="1"
                                    {{ $deducciona->esporcentaje ? 'checked' : '' }}
                                    @if(in_array($deducciona->deduccion_id, [1, 2, 3])) disabled @endif>
                                <label class="form-check-label" for="isPercentage-{{ $deducciona->id }}">
                                    ¿Es porcentaje?
                                </label>
                            </div>

                            <input
                                type="number"
                                step="0.01"
                                class="form-control mt-2"
                                id="percentageInput-{{ $deducciona->id }}"
                                name="porcentaje[{{ $deducciona->id }}]"
                                value="{{ $deducciona->esporcentaje ? $deducciona->monto : '' }}"
                                placeholder="Porcentaje (%)"
                                @if(!$deducciona->esporcentaje || in_array($deducciona->deduccion_id, [1, 2, 3])) disabled @endif>
                        </li>

                        <li class="list-group-item d-flex flex-column">
                            <strong>Monto</strong>
                            <input
                                type="number"
                                step="0.01"
                                class="form-control mt-2"
                                id="amountInput-{{ $deducciona->id }}"
                                name="monto[{{ $deducciona->id }}]"
                                value="{{ !$deducciona->esporcentaje ? $deducciona->monto : '' }}"
                                placeholder="Monto ($)"
                                @if($deducciona->esporcentaje || in_array($deducciona->deduccion_id, [1, 2, 3])) disabled @endif>
                        </li>
                        <li class="list-group-item d-flex flex-column">
                            <form id="delete-comision-{{ $deducciona->deduccion_id }}"
                                action="{{ route('deduccionnomina.delete', [$deducciona->nomina_id, $deducciona->deduccion_id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary" onclick="return confirm('¿Estás seguro de que deseas eliminar esta deduccion?');">
                                    X
                                </button>
                            </form>
                        </li>
                    </ul>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
    <div style="display:flex; justify-content: space-between;">

        <a href="{{ route('nominas.show', $nomina->id) }}" class="btn btn-secondary">Cancelar</a>
        <div style="display:flex;  gap: .5rem;">
            <a href="{{ route('nominas.edit', $nomina->id) }}" class="btn btn-primary">Editar</a>

            <a href="{{ route('nominas.liquidar', $nomina->id) }}" class="btn btn-primary">Liquidar</a>
        </div>
    </div>

</div>
@endsection