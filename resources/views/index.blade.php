<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireMe</title>
    <!-- Подключение Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Подключение шрифта Open Sans -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap">
    <!-- Пользовательские стили -->
    <style>
        /* Общий стиль для страницы */
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Header */
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            color: #333;
        }

        .btn-primary {
            background-color: #000;
            border: none;
        }

        .btn-primary:hover {
            background-color: #333;
        }

        /* Main Section */
        .main-section {
            background-image: url('https://source.unsplash.com/1600x900/?city,work'); /* Ссылка на изображение с Unsplash */
            background-size: cover;
            background-position: center;
            height:60vh; /* Высота на весь экран */
            position: relative;
        }

        .main-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Полупрозрачный тёмный слой для читаемости текста */
        }

        .main-section .container {
            z-index: 2;
            position: relative;
        }

        .main-section h1, .main-section p, .main-section a {
            color: #fff;
        }

        .input-group .form-control {
            font-size: 1.25rem;
            padding: 15px 20px;
        }

        .btn-lg {
            padding: 15px 30px;
            font-size: 1.25rem;
        }

        /* Категории услуг */
        h2 {
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        p {
            font-weight: 400;
            font-size: 1rem;
        }

        .category-title {
            font-weight: 600;
            font-size: 1rem;
            color: #333;
        }

        .category-count {
            font-weight: 400;
            color: #8c8c8c;
            font-size: 0.9rem;
        }

        .category-item {
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .btn-outline-primary {
            border-color: #000;
            color: #000;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .btn-outline-primary:hover {
            background-color: #000;
            color: #fff;
        }


        /* Статистика */
        section.bg-light .fw-bold {
            font-size: 1.75rem;
            color: #333;
        }

        section.bg-light p {
            font-size: 1rem;
            color: #666;
        }

        /* Как это работает */
        section h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        section .fw-bold {
            font-size: 1.25rem;
            color: #333;
        }

        section p {
            font-size: 1rem;
            color: #666;
        }

        .p-4 {
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }


        /* Footer */
        footer {
            background-color: #000;
            color: #fff;
            padding: 40px 0;
        }

        footer h5 {
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 1.2rem;
        }

        footer p {
            margin-bottom: 5px;
            font-size: 1rem;
        }

        footer a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }


    </style>
</head>
<body>

<!-- Header -->
<header class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container">
        <a href="#" class="navbar-brand">hireme</a>
        <div class="ms-auto">
            <a href="#" class="btn btn-primary btn-rounded">Стать исполнителем</a>
        </div>
    </div>
</header>

<!-- Main Section -->
<section class="main-section text-center d-flex align-items-center justify-content-center">
    <div class="container">
        <h1 class="fw-bold text-white">Освободим вас от забот</h1>
        <p class="lead text-white">Поможем найти надёжного исполнителя для любых задач</p>
        <div class="input-group mt-4 mx-auto" style="max-width: 700px;">
            <input type="text" class="form-control form-control-lg" placeholder="Услуга или специалист">
            <button class="btn btn-primary btn-lg">Найти</button>
        </div>
        <a href="#" class="text-white mt-3 d-block">Узнать больше о работе с приложением</a>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center">Категории услуг</h2>
        <div class="row">
            @foreach($categories->chunk(ceil($categories->count() / 3)) as $chunk)
                <div class="col-md-4">
                    @foreach($chunk as $category)

                        <div class="category-item d-flex justify-content-between">
                            <span class="category-title">{{ $category->name}}</span>
                            <span class="category-count">0</span>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>


        <!-- Ссылка "Все категории услуг" по центру -->
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-primary">Все категории услуг</a>
        </div>
    </div>
</section>


<!-- Статистика -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-3">
                <h4 class="fw-bold">12 000+</h4>
                <p>услуг от ремонта до копирайтинга</p>
            </div>
            <div class="col-md-3">
                <h4 class="fw-bold">2 500 000+</h4>
                <p>заказчиков доверили свои задачи</p>
            </div>
            <div class="col-md-3">
                <h4 class="fw-bold">12 лет</h4>
                <p>мы помогаем решать задачи</p>
            </div>
            <div class="col-md-3">
                <h4 class="fw-bold">100%</h4>
                <p>безопасная оплата</p>
            </div>
        </div>
    </div>
</section>

<!-- Как это работает -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Как это работает?</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="p-4">
                    <h5 class="fw-bold">Опишите</h5>
                    <p>свою задачу и условия. Это бесплатно и займёт 3-4 минуты</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4">
                    <h5 class="fw-bold">Получите отклики</h5>
                    <p>с ценами от исполнителей. Обычно они приходят в течение 30 минут</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4">
                    <h5 class="fw-bold">Выберите</h5>
                    <p>подходящего исполнителя и обсудите сроки выполнения</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <!-- Левая часть: название проекта и контакты -->
            <div class="col-md-6 text-start">
                <h5>HireMe</h5>
                <p>Служба поддержки: +7 123 456 78 90</p>
            </div>
            <!-- Правая часть: социальные сети -->
            <div class="col-md-6 text-end">
                <h5>Социальные сети</h5>
                <a href="#" class="text-white me-3">Facebook</a>
                <a href="#" class="text-white me-3">Twitter</a>
                <a href="#" class="text-white">Instagram</a>
            </div>
        </div>
    </div>
</footer>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
