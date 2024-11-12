<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'webRoster')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms/empleado-form.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Koulen&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Doto:wght@100..900&family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Koulen&family=Tiny5&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</head>

<body>
    <div class="main-container">
        {{-- Bontón para ocultar la barra de navegación en móviles --}}
        <button class="sidebar-toggle" onclick="toggleSidebar()"><i class="bi bi-list-nested"></i></button>

        {{-- div sidebar --}}
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo.svg') }}" alt="webRoster Logo">
                <h2>webRoster</h2>
            </div>
            {{-- lista de vainos --}}
            <ul class="nav-list">
                @foreach ($menuItems as $item)
                    <li>
                        <a href="{{ $item['url'] }}">
                            <i class="{{ $item['icon'] }}"></i> {{ $item['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
            {{-- botón de modo oscuro --}}
            <button id="modeToggle" class="mode-toggle" onclick="toggleMode()">🌙 Modo Oscuro</button>
        </div>
        

        <div class="content">
            @yield('content')
        </div>
    </div>

</body>

</html>
