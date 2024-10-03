@extends('adminlte::page')

@section('title', 'Администраторы')

@section('content_header')
    <h1>Добавление заказчика</h1>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('style.css')}}">
@endpush


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-primary">
                    <form method="post" action="{{ route('admin.customers.store') }}">
                        @csrf
                        <div class="card-body">
                            <!-- Поле Имя -->
                            <div class="form-group">
                                <label for="name">Имя</label>
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


                            <!-- Поле Роль -->
                            <div class="form-group">
                                <label for="role_id">Статус</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        name="status" id="role_id">
                                    <option value="{{\App\Enum\UserStatus::Active}}">Активный</option>
                                    <option value="{{\App\Enum\UserStatus::InActive}}">Не активный</option>
                                       </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Отправить</button>
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

