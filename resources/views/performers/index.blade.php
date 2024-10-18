@extends('layouts.app')

<style>
    @media (max-width: 767px) {
        .profile-card {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            text-align: left;
            padding: 15px 0;
        }

        .profile-info {
            flex: 1;
        }


        .profile-info p {
            font-size: 14px;
            margin-bottom: 3px;
        }
    }

    @media (min-width: 768px) {
        .main-container {
            flex-direction: row;
            justify-content: space-between;
        }

        .category-sidebar {
            width: 27%;
        }

        .main-content {
            width: 70%;
        }
    }

    .main-container {
        display: flex;
        flex-direction: column;
        background-color: white;
    }
    .breadcrumb {
        background-color: #f8f9fa;

        margin-bottom: 15px;
        list-style: none;
        border-radius: 4px;
        margin-left: 13px;
    }

    .breadcrumb li {
        display: inline;
        font-size: 14px;
        color: #007bff;
    }

    .breadcrumb li a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb li+li:before {
        content: " / ";
        padding: 0 5px;
        color: #6c757d;
    }

    .breadcrumb li.active {
        color: #6c757d;
    }

    .list-group-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 16px;
        padding: 10px;

    }
    .list-group {
        border: none !important;
    }


    /* Стилизуем категории и кнопки */
    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }



    .subcategory-list {
        padding-top: 5px;
        padding-left: 20px;
        margin-top: 5px;
        list-style-type: none;
    }

    .subcategory-list li {
        position: relative;
        border: none;
        padding-right: 50px; /* Отступ справа для счетчика */
    }

    .subcategory-count {
        position: absolute;
        right: 0; /* Закрепляем счетчик справа */
        top: 0; /* Размещаем счетчик на первой строке */
        padding: 1px 8px;
        border-radius: 3px;
        font-size: 10px;
        background-color: grey;;
        color: white;
        font-weight: bold;
        white-space: nowrap; /* Запрещаем перенос для числа */
    }
    .link {

        text-decoration: none;
        font-size: 14px;
        color: #545454;
    }

    /* Кнопка раскрытия подкатегорий */
    .toggle-btn {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    .toggle-btn:focus {
        outline: none;
    }

    .link:hover {
        text-decoration: none;
    }




    .profile-card {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding: 15px 0;
    }

    .profile-image {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-right: 20px;
    }

    .profile-info a {
        font-size: 23px;

        color: #007bff;
        text-decoration: none;
    }

    .profile-info p {
        margin: 0;
        color: #6c757d;
    }

    .profile-info strong {
        color: #000;
    }

    form {
        display: block;
        margin-top: 0em;
        unicode-bidi: isolate;
    }
    .text-center {
        text-align: center;
    }
</style>
@section('content')
    <div style="margin-top: 50px" class="container">
        <ul class="breadcrumb" >
            <li><a href="/">Главная</a></li>
            <li><a href="/performers">Каталог исполнителей</a></li>
        </ul>
        <div class="card-body">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-4 category-sidebar">
                    <ul class="list-group">
                        @foreach($categories as $category)
                            <li style="border: none; font-size: 15px; color: #545454; font-family: 'PT Sans',sans-serif" class="list-group-item">
                                <div class="category-header">
                                        <span>{{ $category->name }}</span>
                                        <button class="toggle-btn" onclick="toggleSubcategories(this)">+</button>
                                    </div>

                                    <ul class="subcategory-list" style="display: none;">
                                        @foreach($category->subcategories as $subcategory)
                                            <li >
                                                <a class="link" href="#">{{ $subcategory->name }}</a>
                                                <span  class="subcategory-count">{{ rand(1,1000) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                <div class="col-md-8 main-content">
                    <div class="text-center">
                        <form>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input name="q" id="q" class="form-control query" style="font-size: 15px; margin-bottom: 5px" placeholder="Поисковая фраза">
                                </div>
                                <div class="form-group col-md-8">
                                    <select name="country" id="country" class="form-control country select2-hidden-accessible" data-select2-id="country" tabindex="-1" aria-hidden="true">
                                        <option value="" data-select2-id="2">Все районы</option>
                                        <option value="" data-select2-id="2">Центр</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    @foreach($profiles as $profile)
                        <div class="profile-card">

                                <img src="{{ asset('burger.jpg') }}" class="profile-image" alt="Профиль">
                                <div class="profile-info">
                                    <a href="{{route('performers.show', $profile->id)}}">{{ $profile->name }}</a>
                                    <p>{{ $profile->address }}</p>
                                    <p>{{ implode(' · ', $profile->categories->pluck('name')->toArray()) }}</p>
                                    <p>Минимальная стоимость услуг: <strong>от {{ $profile->min_service_cost }} сум</strong></p>
                                </div>
                            </div>

                        @endforeach
                        {{$profiles->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        function toggleSubcategories(button) {
            // Найдем список подкатегорий рядом с нажатой кнопкой
            var subcategories = $(button).closest('li').find('.subcategory-list');

            // Переключаем видимость подкатегорий
            subcategories.slideToggle();

            // Меняем знак "+" на "-" и обратно
            if ($(button).text() === "+") {
                $(button).text("-");
            } else {
                $(button).text("+");
            }
        }

    </script>
@endsection
