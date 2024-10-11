@extends('adminlte::page')

@section('title', 'Исполнители')

@section('content_header')
    <h1> </h1>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('style.css')}}">
@endpush


@section('content')

    <form method="post" action="{{ route('admin.performers.update', $performer->id) }}">
        <div class="row align-items-center">
            <div class="col-md-9">
                <h4>Редактирование исполнителя</h4>
            </div>
            <div class="col-md-3 mb-3 text-right">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
        <div class="row">

            @csrf
            @method('PUT')
            <div class="col-8">
                <div class="card">


                        <div class="card-body">
                            <!-- Поле Имя -->
                            <div class="form-group">
                                <label for="name">Имя и Фамилия</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $performer->name) }}"
                                       id="name" name="name" placeholder="Введите имя">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>

                            <!-- Поле Категория -->
                            <div class="form-group">
                                <label for="category_id">Выберите категорию</label>
                                <select id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                >
                                    <option value="">Выберите родительскую категорию</option>
                                    @foreach($categories as $PCategory)
                                        <option value="{{ $PCategory->id }}"
                                            {{ $category->id == $PCategory->id ? 'selected' : '' }}>
                                            {{ $PCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>

                            <!-- Поле Подкатегория -->
                            <div class="form-group">
                                <label for="subcategory_id">Выберите подкатегорию</label>
                                <select class="form-control @error('subcategory_id') is-invalid @enderror"
                                        name="category_id" id="subcategory_id">
                                    @foreach($childCategories as $childCategory)
                                        <option
                                            {{$childCategory->id === $performer->category_id ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Телефон</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', $performer->phone) }}"
                                       id="name" name="phone" placeholder="Введите Телефон ">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Минимальная цена</label>
                                <input type="text"
                                       class="form-control @error('min_service_cost') is-invalid @enderror"
                                       value="{{ old('min_service_cost', number_format($performer->min_service_cost, 0, '.', ',')) }}"
                                       id="min_service_cost"
                                       name="min_service_cost" placeholder="Введите минимальную цену">
                                @error('min_service_cost')
                                <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Описание услуги</label>
                                <textarea class="form-control"
                                          name="service_description">{{ old('service_description', $performer->service_description) }}</textarea>
                                @error('service_description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Телеграм Id</label>
                                <input disabled type="number" class="form-control"
                                       value="{{$performer->user->tg_id}}"
                                       name="min_service_cost" placeholder="Telegram ID">
                            </div>


                        </div>


                    </div>


            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">

                            <!-- Статус -->
                            <div class="form-group">
                                <label for="status">Статус*</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                        id="status">
                                    <option value="{{\App\Enum\ModerationStatuses::Moderation}}"
                                        {{ old('status', $performer->status) == \App\Enum\ModerationStatuses::Moderation->value ? 'selected' : '' }}>
                                        {{\App\Enum\ModerationStatuses::Moderation}}
                                    </option>
                                    <option value="{{\App\Enum\ModerationStatuses::Published}}"
                                        {{ old('status', $performer->status) == \App\Enum\ModerationStatuses::Published->value ? 'selected' : '' }}>
                                        {{\App\Enum\ModerationStatuses::Published}}
                                    </option>
                                    <option value="{{\App\Enum\ModerationStatuses::UnPublished}}"
                                        {{ old('status', $performer->status) == \App\Enum\ModerationStatuses::UnPublished->value ? 'selected' : '' }}>
                                        {{\App\Enum\ModerationStatuses::UnPublished}}
                                    </option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>

                            <!-- ID -->
                            <div class="form-group">
                                <label for="id">ID</label>
                                <p>{{ $performer->id }}</p>
                            </div>

                            <!-- Дата создания -->
                            <div class="form-group">
                                <label for="created_at">Дата создания</label>
                                <p>{{ $performer->created_at->format('d-m-Y') }}</p>
                            </div>

                            <!-- Кем создан -->
                            <div class="form-group">
                                <label for="created_by">Кем создан</label>
                                <p>{{ $performer->user->author->name }}</p>
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection
@push('js')
    <script>
        document.getElementById('category_id').addEventListener('change', function () {
            var categoryId = this.value;

            if (categoryId) {

                fetch(`/admin/subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        var subcategoryDropdown = document.getElementById('subcategory_id');

                        subcategoryDropdown.innerHTML = '<option value="">Выберите подкатегорию</option>';


                        data.subcategories.forEach(function (subcategory) {
                            var option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subcategoryDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            } else {
                document.getElementById('subcategory_id').innerHTML = '<option value="">Выберите подкатегорию</option>';
            }
        });
    </script>
    <script>
        const priceInput = document.getElementById('min_service_cost');

        // Функция для форматирования с запятыми
        function formatNumber(value) {
            return value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        // Убираем запятые и преобразуем в число перед отправкой формы
        function parseNumber(value) {
            return value.replace(/,/g, '');
        }

        // Обработчик события для ввода
        priceInput.addEventListener('input', function (e) {
            let value = e.target.value;
            e.target.value = formatNumber(value);
        });

        // Обработчик события для изменения значения
        priceInput.addEventListener('change', function (e) {
            let value = e.target.value;
            e.target.value = formatNumber(value);
        });

        // Если нужно сохранить в базу данных без запятых, перед отправкой формы:
        document.querySelector('form').addEventListener('submit', function() {
            priceInput.value = parseNumber(priceInput.value);
        });
    </script>
@endpush
