@extends('layouts.app')
z
@section('content')
    <div class="container text-center my-5">
        <h1>Выберите категорию задания</h1>
        <p class="mb-4">Мы готовы помочь вам в решении самых разнообразных задач</p>

        <!-- Categories Section -->
        <div id="categories" class="categories-section mb-4">
            @foreach($categories as $category)
                <button class="category-btn" data-id="{{ $category->id }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <!-- Subcategories Section -->
        <div id="subcategories" class="d-none subcategories-section">
            <h3>Выберите подкатегорию</h3>
            <div id="subcategories-list" class="subcategories-list"></div>
        </div>
    </div>
@endsection



@section('js')
    <script>
        document.querySelectorAll('.category-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const categoryId = this.dataset.id;

                // Убираем активный класс со всех кнопок и добавляем его на выбранную категорию
                document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                // Убираем все подкатегории, если нажата другая категория
                document.getElementById('subcategories-list').innerHTML = '';

                // Fetch подкатегорий для выбранной категории
                fetch(`/getSubcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(categories => {
                        const subcategoriesList = document.getElementById('subcategories-list');
                        subcategoriesList.innerHTML = ''; // Очистить предыдущие подкатегории

                        // Отображаем подкатегории как кнопки
                        categories.categories.forEach(sub => {
                            const subItem = document.createElement('button');
                            subItem.textContent = sub.name;
                            subItem.classList.add('subcategory-btn');
                            subItem.dataset.id = sub.id;

                            // Добавляем событие для клика на подкатегорию
                            subItem.addEventListener('click', function() {
                                document.querySelectorAll('.subcategory-btn').forEach(btn => btn.classList.remove('active'));
                                this.classList.add('active');
                            });

                            subcategoriesList.appendChild(subItem);
                        });

                        // Показываем секцию подкатегорий
                        document.getElementById('subcategories').classList.remove('d-none');
                    })
                    .catch(error => console.error('Ошибка при получении подкатегорий:', error));
            });
        });

    </script>
@endsection
