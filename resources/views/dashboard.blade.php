@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #e3e9f3;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: left;
        }

        .header h1 {
            margin: 0;
            color: #333;
        }

        .header p {
            margin: 5px 0;
            color: #777;
        }

        .summary {
            display: flex;
            justify-content: space-between;
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .summary div {
            text-align: center;
        }

        .summary div p {
            margin: 5px 0;
            color: #888;
        }

        .summary div .status {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            font-size: 14px;
        }

        .cards {
            display: flex;
            gap: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin: 0 0 15px;
            font-size: 18px;
            color: #333;
        }

        .card p {
            color: #555;
            font-size: 14px;
        }

        .button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            display: block;
            text-align: center;
            margin: 20px 0;
            text-decoration: none;
        }

        .indicators, .events {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .indicator, .event {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-radius: 8px;
            background-color: #f8f9fa;
            font-size: 14px;
        }

        .indicator span, .event span {
            color: #333;
        }

        .chart {
            height: 200px;
            background-color: #f2f7ff;
            border-radius: 8px;
            text-align: center;
            line-height: 200px;
            color: #666;
            font-size: 16px;
        }
    </style>

<div class="container">
    <div class="header">
        <h1>¡Buenas tardes, Sarah!</h1>
        <p>Aquí puedes ver tus resúmenes y accesos rápidos.</p>
    </div>

    <div class="summary">
        <div>
            <p>Última nómina creada</p>
            <h2>0</h2>
        </div>
        <div>
            <p>No. empleados</p>
            <h2>0</h2>
        </div>
        <div>
            <p>Estado</p>
            <span class="status">Pendiente</span>
        </div>
        <div>
            <p>Progreso de emisión</p>
            <h2>-</h2>
        </div>
        <div>
            <a href="#" class="button">Ir a emitir</a>
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Emisiones de nómina</h3>
            <p>Aún no tienes nóminas emitidas.</p>
            <a href="#" class="button">+ Nueva emisión</a>
        </div>

        <div class="card indicators">
            <h3>Indicadores</h3>
            <div class="indicator">
                <span>Auxilio de transporte</span>
                <span>$162.000 COP</span>
            </div>
            <div class="indicator">
                <span>Salario mínimo</span>
                <span>$1.300.000 COP</span>
            </div>
            <div class="indicator">
                <span>Salario integral</span>
                <span>$16.900.000 COP</span>
            </div>
        </div>

        <div class="card events">
            <h3>Eventos</h3>
            <div class="event">
                <span>Emisión de Nómina</span>
                <span>Ir →</span>
            </div>
            <p>No tienes más eventos próximos.</p>
        </div>
    </div>

    <div class="card chart">
        <h3>Contratación por mes</h3>
        <p>Gráfica (Placeholder)</p>
    </div>
</div>
@endsection
