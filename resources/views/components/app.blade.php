<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$title ?? 'App de notas'}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="wrap">
    <header class="head">
        <a href="#" class="logo"></a>
        <nav class="main-nav">
            <ul class="main-nav-list">
                <li class="main-nav-item">
                    <a href="{{route('notes.index')}}" class="main-nav-link">
                        <i class="icon icon-th-list"></i>
                        <span>Ver notas</span>
                    </a>
                </li>
                <li class="main-nav-item active">
                    <a href="{{route('notes.create')}}" class="main-nav-link">
                        <i class="icon icon-pen"></i>
                        <span>Nueva nota</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
     {{--@yield('content')--}}
    {{$slot}}
    <footer class="foot">
        <div class="ad">
            <p>
                Esta aplicación fue desarrollada por <a>Roman Ballesteros</a>
            </p>
        </div>
        <div class="license">
            <p>{{ $currentYear }} Derechos Reservados - Seti Consultyn S.L.</p>
        </div>
    </footer>
</div>
</body>
</html>
