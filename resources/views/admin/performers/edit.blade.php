@extends('adminlte::page')

@section('title', 'Администраторы')

@section('content_header')
    <h1>Изменение администратора</h1>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('style.css')}}">
@endpush


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-primary">
                    <form method="post" action="{{ route('admin.performers.update', $performer->id) }}">
                        @csrf
                        @method('PUT') <!-- Use PUT for update -->
                        <div class="card-body">
                            <!-- Поле Имя -->
                            <div class="form-group">
                                <label for="name">Имя</label>
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
                                        name="category_id">
                                    <option value="">Выберите родительскую категорию</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $performer->category?->parentCategory?->id) == $category->id ? 'selected' : '' }}>
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

                            <!-- Поле Подкатегория -->
                            <div class="form-group">
                                <label for="subcategory_id">Выберите подкатегорию</label>
                                <select class="form-control @error('subcategory_id') is-invalid @enderror"
                                        name="subcategory_id" id="subcategory_id">
                                   @foreach($childCategories as $childCategory)
                                        <option {{$childCategory->id === $performer->category_id ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                   @endforeach
                                </select>
                                @error('subcategory_id')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="role_id">Статус</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="{{\App\Enum\ModerationStatuses::Moderation}}"
                                        {{ old('status', $performer->status) == \App\Enum\ModerationStatuses::Moderation ? 'selected' : '' }}>
                                        {{\App\Enum\ModerationStatuses::Moderation}}
                                    </option>
                                    <option value="{{\App\Enum\ModerationStatuses::Published}}"
                                        {{ old('status', $performer->status) == \App\Enum\ModerationStatuses::Published ? 'selected' : '' }}>
                                        {{\App\Enum\ModerationStatuses::Published}}
                                    </option>
                                    <option value="{{\App\Enum\ModerationStatuses::UnPublished}}"
                                        {{ old('status', $performer->status) == \App\Enum\ModerationStatuses::UnPublished ? 'selected' : '' }}>
                                        {{\App\Enum\ModerationStatuses::UnPublished}}
                                    </option>
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
                                       value="{{ old('name', $performer->phone) }}"
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
                                       value="{{ old('min_service_cost', $performer->min_service_cost) }}"
                                       name="min_service_cost" placeholder="Введите минимальную цену">
                                @error('min_service_cost')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Описание услуги</label>
                                <textarea class="form-control" name="service_description">{{ old('service_description', $performer->service_description) }}</textarea>
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

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Обновить</button>
                        </div>
                    </form>
                </div>
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
