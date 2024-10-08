@extends('adminlte::page')

@section('title', 'Исполнители')

@section('content_header')
    <h1>Добавление Исполнителя</h1>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('style.css')}}">
@endpush


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                    <form method="post" action="{{ route('admin.performers.store') }}">
                        @csrf
                        <div class="card-body">
                            <!-- Поле Имя -->
                            <div class="form-group">
                                <label for="name">Имя и Фамилия</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       id="name" name="name" placeholder="Введите имя">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">

                                <label for="categories">Выберите категорию:</label>
                                <select id="categories" name="category" class="multiSelect">
                                    <option value="" disabled selected>Выберите категорию</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <label for="subcategories">Выберите подкатегории:</label>
                                <select id="subcategories" name="subcategories[]" class="multiSelect" multiple>

                                </select>

                                <div class="tags" id="selectedTags">

                                </div>
                            </div>

                            <!-- Поле Роль -->
                            <div class="form-group">
                                <label for="role_id">Статус</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        name="status" id="role_id">
                                    <option value="{{\App\Enum\ModerationStatuses::Moderation}}">{{\App\Enum\ModerationStatuses::Moderation}}</option>
                                    <option value="{{\App\Enum\ModerationStatuses::Published}}">{{\App\Enum\ModerationStatuses::Published}}</option>
                                    <option value="{{\App\Enum\ModerationStatuses::UnPublished}}">{{\App\Enum\ModerationStatuses::UnPublished}}</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Телефон</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}"
                                       id="name" name="phone" placeholder="Введите Телефон ">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Минимальная цена</label>
                                <input type="number" class="form-control @error('min_service_cost') is-invalid @enderror"
                                       value="{{ old('min_service_cost') }}"
                                      name="min_service_cost" placeholder="Введите минимальную цену">
                                @error('min_service_cost')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Описание услуги</label>
                                <textarea class="form-control" name="service_description">{{old('service_description')}}</textarea>
                                @error('service_description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Оптравить</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
@endsection
@push('js')
<script>

    const categories = document.getElementById('categories');
    const subcategories = document.getElementById('subcategories');
    const selectedTagsContainer = document.getElementById('selectedTags');

    // Для хранения выбранных подкатегорий
    let selectedSubcategories = [];

    categories.addEventListener('change', function() {
        const selectedCategoryId = categories.value;

        // Очищаем подкатегории
        subcategories.innerHTML = '';

        if (selectedCategoryId) {
            fetch(`/admin/subcategories/${selectedCategoryId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    data.subcategories.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.text = subcategory.name;
                        subcategories.add(option);
                    });
                })
                .catch(error => console.error('Ошибка загрузки подкатегорий:',));
        }
    });

    subcategories.addEventListener('change', function() {
        const selectedOptions = Array.from(subcategories.selectedOptions).map(option => option.value);

        selectedOptions.forEach(option => {
            if (!selectedSubcategories.includes(option)) {
                selectedSubcategories.push(option);
                addTag(option);
            }
        });
    });

    function addTag(subcategoryId) {
        const subcategoryOption = Array.from(subcategories.options).find(opt => opt.value == subcategoryId);
        if (!subcategoryOption) return;

        const subcategoryName = subcategoryOption.text;
        const tag = document.createElement('span');
        tag.classList.add('tag');
        tag.textContent = subcategoryName;

        const removeButton = document.createElement('button');
        removeButton.textContent = '×';
        removeButton.addEventListener('click', () => {
            selectedSubcategories = selectedSubcategories.filter(item => item !== subcategoryId);
            tag.remove();
        });

        tag.appendChild(removeButton);
        selectedTagsContainer.appendChild(tag);
    }

</script>
@endpush

