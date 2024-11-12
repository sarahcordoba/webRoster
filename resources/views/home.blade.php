@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Greeting Section -->
    <div class="row">
        <div class="col-md-12">
            <h1>¡Buenos días, [User's Name]!</h1>
            <p>Aquí puedes ver tus resúmenes y accesos rápidos.</p>
        </div>
    </div>

    <!-- Summary Section -->
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p>Última nómina creada</p>
                    <h4>0</h4>
                </div>
            </div>
        </div>
        <!-- Repeat similar blocks for "No. empleados," "Estado," and "Ir a emitir" button -->
    </div>

    <!-- Payroll Emissions Section -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <p>Aún no tienes nóminas emitidas.</p>
                    <button class="btn btn-primary">+ Nueva emisión</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Indicators Section -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p>Auxilio de transporte</p>
                    <h5>$162.000 COP</h5>
                </div>
            </div>
            <!-- Add additional cards for other indicators -->
        </div>
        <!-- Event Section -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p>Próximos eventos</p>
                    <p>Emisión de Nómina: 1 al 18 de noviembre</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
