@extends('layouts.app')

@section('title', 'Lq')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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

            <!-- Botón para abrir el modal de añadir comisiones -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalComision">
                Añadir Comisión
            </button>

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
                                    @if(in_array($comisiona->comision_id, [1])) disabled @endif>
                                <label class="form-check-label" for="isPercentage-{{ $comisiona->id }}">
                                    ¿Es porcentaje?
                                </label>
                            </div>

                            <input
                                type="number"
                                step="0.01"
                                class="form-control mt -2"
                                id="percentageInput-{{ $comisiona->id }}"
                                name="porcentaje[{{ $comisiona->id }}]"
                                value="{{ $comisiona->esporcentaje ? $comisiona->monto : '' }}"
                                placeholder="Porcentaje (%)"
                                @if(!$comisiona->esporcentaje || in_array($comisiona->comision_id, [1])) disabled @endif>
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
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDeduccion">
                Añadir Deducción
            </button>
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
                            <form id="delete-deduccion-{{ $deducciona->deduccion_id }}"
                                action="{{ route('deduccionnomina.delete', [$deducciona->nomina_id, $deducciona->deduccion_id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary" onclick="return confirm('¿Estás seguro de que deseas eliminar esta deducción?');">
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
        <div style="display:flex; gap: .5rem;">
            <a href="{{ route('nominas.edit', $nomina->id) }}" class="btn btn-primary">Guardar</a>
        </div>
    </div>
</div>

<!-- Modal para añadir comisión -->
<div class="modal fade" id="modalComision" tabindex="-1" aria-labelledby="modalComisionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalComisionLabel">Añadir Comisión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="selectComision" class="form-label">Seleccionar Comisión</label>
                    <select id="selectComision" class="form-select">
                        <option value="">-- Seleccionar --</option>
                        @foreach ($comisionesDisponibles as $comision)
                        <option value="{{ $comision->id }}"
                            data-esporcentaje="{{ $comision->esporcentaje }}"
                            data-monto="{{ $comision->monto }}">
                            {{ $comision->descripcion }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxComisionPorcentaje">
                    <label class="form-check-label" for="checkboxComisionPorcentaje">¿Es porcentaje?</label>
                </div>
                <div class="mb-3">
                    <label for="inputComisionMonto" class="form-label">Monto</label>
                    <input type="number" step="0.01" id="inputComisionMonto" class="form-control">
                </div>
                <button id="btnGuardarComision" class="btn btn-primary">Guardar Comisión</button>
                <button id="btnNuevaComision" class="btn btn-link">Crear Nueva Comisión</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para nueva comisión -->
<div class="modal fade" id="modalNuevaComision" tabindex="-1" aria-labelledby="modalNuevaComisionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNuevaComisionLabel">Crear Nueva Comisión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="inputComisionTipo" class="form-label">Tipo</label>
                    <input type="text" id="inputComisionTipo" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="inputComisionDescripcion" class="form-label">Descripción</label>
                    <input type="text" id="inputComisionDescripcion" class="form-control">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNuevaComisionPorcentaje">
                    <label class="form-check-label" for="checkboxNuevaComisionPorcentaje">¿Es porcentaje?</label>
                </div>
                <div class="mb-3">
                    <label for="inputNuevaComisionMonto" class="form-label">Monto</label>
                    <input type="number" step="0.01" id="inputNuevaComisionMonto" class="form-control">
                </div>
                <button id="btnGuardarNuevaComision" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    // Configuración del token CSRF para las solicitudes
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function sendPostRequest(url, data, onSuccess, onError) {
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(onSuccess)
            .catch(onError);
    }

    // Actualizar campos al seleccionar una comisión
    document.getElementById('selectComision').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const esPorcentaje = selectedOption.getAttribute('data-esporcentaje') === '1';
        const monto = parseFloat(selectedOption.getAttribute('data-monto')) || 0;

        document.getElementById('checkboxComisionPorcentaje').checked = esPorcentaje;
        document.getElementById('inputComisionMonto').value = esPorcentaje ? monto * 100 : monto;
    });

    // Cambiar monto según "es porcentaje"
    document.getElementById('checkboxComisionPorcentaje').addEventListener('change', function() {
        const monto = parseFloat(document.getElementById('inputComisionMonto').value) || 0;
        document.getElementById('inputComisionMonto').value = this.checked ? monto * 100 : monto / 100;
    });

    // Guardar nueva comisión
    document.getElementById('btnGuardarNuevaComision').addEventListener('click', function() {
        const tipo = document.getElementById('inputComisionTipo').value;
        const descripcion = document.getElementById('inputComisionDescripcion').value;
        const esPorcentaje = document.getElementById('checkboxNuevaComisionPorcentaje').checked ? 1 : 0;
        const monto = parseFloat(document.getElementById('inputNuevaComisionMonto').value) || 0;

        sendPostRequest('/api/add/comisiones', {
            tipo,
            descripcion,
            esporcentaje: esPorcentaje,
            monto
        }, function(response) {
            alert('Nueva comisión creada con éxito.');
            // Insertar automáticamente en comisiones_nomina
            sendPostRequest('/api/add/comisionesnomina', {
                nomina_id: '<?= $nomina->id ?>',
                comision_id: response.id,
                esporcentaje: esPorcentaje,
                monto
            }, function() {
                alert('Comisión asignada a la nómina.');
                location.reload();
            });
        }, function() {
            alert('Error al crear la nueva comisión.');
        });
    });

    // Guardar comisión seleccionada
    document.getElementById('btnGuardarComision').addEventListener('click', function() {
        const comisionId = document.getElementById('selectComision').value;
        const esPorcentaje = document.getElementById('checkboxComisionPorcentaje').checked ? 1 : 0;
        const monto = parseFloat(document.getElementById('inputComisionMonto').value) || 0;

        sendPostRequest('/api/add/comisionesnomina', {
            nomina_id: '<?= $nomina->id ?>',
            comision_id: comisionId,
            esporcentaje: esPorcentaje,
            monto
        }, function() {
            alert('Comisión guardada con éxito.');
            location.reload();
        }, function() {
            alert('Error al guardar la comisión.');
        });
    });

    // Abrir modal para crear nueva comisión
    document.getElementById('btnNuevaComision').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('modalNuevaComision'));
        modal.show();
    });
</script>
@endsection