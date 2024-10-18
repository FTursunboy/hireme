<!DOCTYPE html>
<html lang="ru">
@include('layouts.header')
@yield('css')
<body>

<header class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container">
        <a href="{{route('home')}}" class="navbar-brand">hireme</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto d-lg-none">
                <li class="nav-item">
                    <a href="{{route('login')}}" class="nav-link">Войти</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Стать исполнителем</a>
                </li>
            </ul>
        </div>

        <div class="d-none d-lg-flex ms-auto">
            <a href="{{route('login')}}" class="btn btn-secondary me-2">Войти</a>
            <a href="#" class="btn btn-primary btn-rounded">Стать исполнителем</a>
        </div>
    </div>
</header>
@yield('content')

@include('layouts.footer')


@yield('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
