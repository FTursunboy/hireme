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


                            <!-- Поле Роль -->
                            <div class="form-group">
                                <label for="role_id">Выберите категорию</label>
                                <select id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                        >
                                    <option value="">Выберите родительскую категорию</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role_id">Выберите подктегорию</label>
                                <select  class="form-control @error('category_id') is-invalid @enderror"
                                        name="category_id" id="subcategory_id">
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
    document.getElementById('category_id').addEventListener('change', function() {
        var categoryId = this.value;

        if (categoryId) {

            fetch(`/admin/subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    var subcategoryDropdown = document.getElementById('subcategory_id');

                    subcategoryDropdown.innerHTML = '<option value="">Выберите подкатегорию</option>';


                    data.subcategories.forEach(function(subcategory) {
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
@endpush

