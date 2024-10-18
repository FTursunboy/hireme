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
                    <form method="post" action="{{ route('admin.administrator.update', $user->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <!-- Поле Имя -->
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $user->name) }}"
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
                                       value="{{ old('email', $user->email) }}"
                                       id="email" name="email" placeholder="Введите email">
                                @error('email')
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
                                        <option value="{{ $role->id }}"
                                            {{ $user->roles->first()->id === $role->id ? 'selected' : '' }}>
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
                            <div class="form-group">
                                <label for="status">Статус</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="1" {{ $user->status ? 'selected' : '' }}>Активный</option>
                                    <option value="0" {{ !$user->status ? 'selected' : '' }}>Не активный</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
