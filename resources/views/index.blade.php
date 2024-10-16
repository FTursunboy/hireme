@extends('layouts.app')

@section('content')
<section class="main-section text-center d-flex align-items-center justify-content-center">
    <div class="container">
        <h1 class="fw-bold text-white">Освободим вас от забот</h1>
        <p class="lead text-white">Поможем найти надёжного исполнителя для любых задач</p>
        <div class="input-group mt-4 mx-auto" style="max-width: 700px;">
            <input type="text" class="form-control form-control-lg" placeholder="Услуга или специалист">
            <a  href="{{route('performers')}}" class="btn btn-primary btn-lg">Найти</a>
        </div>
        <a href="#" class="text-white mt-3 d-block">Узнать больше о работе с приложением</a>
    </div>
</section>

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


        <div class="text-center mt-4">
            <a href="{{route('categories')}}" class="btn btn-outline-primary">Все категории услуг</a>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Как это работает?</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="p-4">
                    <h5 class="fw-bold">Найдите исполнителя</h5>
                    <p>Выберите категорию услуг и найдите подходящего специалиста.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4">
                    <h5 class="fw-bold">Зарегистрируйтесь</h5>
                    <p>Создайте аккаунт, чтобы получить доступ к контактным данным исполнителей.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4">
                    <h5 class="fw-bold">Получите доступ к контактам</h5>
                    <p>Свяжитесь напрямую с выбранным исполнителем и обсудите условия работы.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
