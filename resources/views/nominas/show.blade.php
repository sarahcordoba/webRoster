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
                            @if($comisiona->esporcentaje)
                            {{ $comisiona->monto }}%
                            @else
                            N/A
                            @endif
                        </li>
                        <li class="list-group-item d-flex flex-column">
                            <strong>Monto</strong>
                            @if($comisiona->comision->esporcentaje)
                            {{-- Calcula el monto como el porcentaje del salario --}}
                            ${{ number_format($nomina->empleado->salario * ($comisiona->monto / 100), 2) }}
                            @else
                            {{-- Muestra el monto directamente si no es un porcentaje --}}
                            ${{ number_format($comisiona->monto, 2) }}
                            @endif
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
                            @if($deducciona->esporcentaje)
                            {{ $deducciona->monto }}%
                            @else
                            N/A
                            @endif
                        </li>
                        <li class="list-group-item d-flex flex-column">
                            <strong>Monto</strong>
                            @if($deducciona->esporcentaje)
                            {{-- Calcula el monto como el porcentaje del salario --}}
                            ${{ number_format($nomina->empleado->salario * ($deducciona->monto / 100), 2) }}
                            @else
                            {{-- Muestra el monto directamente si no es un porcentaje --}}
                            ${{ number_format($deducciona->monto, 2) }}
                            @endif
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

            <a href="{{ route('nominas.show', $nomina->id) }}" class="btn btn-primary">Liquidar</a>
        </div>
    </div>

</div>
@endsection