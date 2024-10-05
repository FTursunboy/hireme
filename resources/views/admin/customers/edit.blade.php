@extends('adminlte::page')

@section('title', 'Заказчики')

@section('content_header')
    <h1> </h1>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('style.css')}}">
@endpush

@section('content')

    <form method="post" action="{{ route('admin.customers.update', $customer->id) }}">
        <div class="row align-items-center">
            <div class="col-md-9">
                <h4>Редактирование заказчика</h4>
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
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $customer->name) }}"
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
                                       value="{{ old('phone', $customer->phone_number) }}"
                                       id="name" name="phone" placeholder="Введите Телефон ">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Telegram Id</label>
                                <input type="text" disabled class="form-control @error('phone') is-invalid @enderror"
                                       value="{{  $customer->tg_id}}"
                                       id="name" name="telegram id" placeholder="Telegram Id">

                            </div>


                        </div>


                </div>

            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">

                        <!-- Статус -->
                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                <option value="1" {{ $customer->status ? 'selected' : '' }}>Активный</option>
                                <option value="0" {{ !$customer->status ? 'selected' : '' }}>Не активный</option>
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
                            <p>{{ $customer->id }}</p>
                        </div>

                        <!-- Дата создания -->
                        <div class="form-group">
                            <label for="created_at">Дата создания</label>
                            <p>{{ $customer->created_at->format('d-m-Y') }}</p>
                        </div>

                        <!-- Кем создан -->
                        <div class="form-group">
                            <label for="created_by">Кем создан</label>
                            <p>{{ $customer->author->name }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection
