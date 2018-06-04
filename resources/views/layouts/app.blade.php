<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/'.Request::path().'.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-fixed-top">
        <div class="container">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/" class="navbar-brand d-flex align-items-center">
                        <strong>{{ config('app.name') }}</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class=" d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesion
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div role="container">

    @yield('content')

    </div>

    <footer class="text-muted">
        <div class="container">
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
