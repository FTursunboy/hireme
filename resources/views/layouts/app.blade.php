<!DOCTYPE html>
<html lang="ru">
@include('layouts.header')
@yield('css')
<body>

<!-- Header -->
<header class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container">
        <a href="#" class="navbar-brand">hireme</a>

        <div class="ms-auto">
            <a href="{{route('login')}}" class="btn btn-secondary me-2">Логин</a>
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
