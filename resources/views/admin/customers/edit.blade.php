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
                    <form method="post" action="{{ route('admin.customers.update', $customer->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <!-- Поле Имя -->
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


                            <!-- Поле Роль -->
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

                            <div class="form-group">
                                <label for="name">Telegram Id</label>
                                <input type="text" disabled class="form-control @error('phone') is-invalid @enderror"
                                       value="{{  $customer->tg_id}}"
                                       id="name" name="telegram id" placeholder="Telegram Id">

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
