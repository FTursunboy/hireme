@extends('adminlte::page')

@section('title', 'Администраторы')

@section('content_header')
    <h1>Добавление администратора</h1>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('style.css')}}">
@endpush


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                    <form method="post" action="{{ route('admin.administrator.post') }}">
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

                            <!-- Поле Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       id="email" name="email" placeholder="Введите email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Пароль</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       value="{{ old('password') }}"
                                       id="email" name="password" placeholder="Введите пароль">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Поле Роль -->
                            <div class="form-group">
                                <label for="role_id">Роль</label>
                                <select class="form-control @error('role_id') is-invalid @enderror"
                                        name="role_id" id="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Поле Статус -->

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
@endsection
