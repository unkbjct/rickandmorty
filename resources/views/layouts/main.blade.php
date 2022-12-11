<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('public/storage/img/icons/morty.png') }}" type="image/icon type">
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link class="css" rel="stylesheet" href="{{ asset('public/css/main.css') }}">
    <title>@yield('title')</title>

    <script src="{{ asset('public/js/jquery-3.6.1.slim.min.js') }}"></script>

    @yield('css')
    @yield('scripts')

    <script src="{{ asset('public/js/main.js') }}"></script>
</head>

<body>
    <div class="wrapper">
        <header class="shadow-sm">
            <div class="switch-theme rounded-circle">
                <div class="form-check form-switch d-flex align-items-center">
                    <input class="form-check-input" type="checkbox" class="dark-theme" id="dark-theme">
                    <label class="form-check-label mx-3" for="dark-theme"><img
                            src="{{ asset('public/storage/img/icons/dark-theme.png') }}" alt=""></label>
                </div>
            </div>
            <nav class="navbar navbar-light bg-light">
                <div class="container justify-content-center ">
                    <a class="navbar-brand" href="{{ route('welcome') }}">
                        <img src="{{ asset('public/storage/img/Rick_and_Morty_logo.png') }}" height="60"
                            alt="">
                    </a>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container justify-content-center collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('welcome') }}">Смотреть</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news') }}">Новости</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news.timetable') }}">Расписание</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">О проекте</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('donations') }}">От разработчика</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin') }}">Админ панель</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </header>

        @yield('main-content')
        <footer class="footer border-top p-3 mt-4">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-center ">
                    <p class="col-md-4 mb-0 text-muted">© 2021 "igor25030", Inc</p>
                    <ul class="nav col-md-4 justify-content-end">
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
