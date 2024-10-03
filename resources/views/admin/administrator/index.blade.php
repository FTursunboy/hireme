@extends('adminlte::page')

@section('title', 'Администраторы')

@section('content_header')
    <h1>Администраторы</h1>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('style.css')}}">
@endpush


@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Администраторы</h3>
                    <div style="float: right">
                        @role('admin')
                        <a href="{{ route('admin.administrator.create') }}" class="btn btn-primary" style="margin-left: 20px">
                            <i class="fas fa-plus"></i> Добавить
                        </a>
                        @endrole
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Роль</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles?->first()?->name }}</td>
                                <td>{{ $user->status ? 'Активный' : 'Не активный' }}</td>
                                <td>{{ $user->created_at->format('d.m.Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.administrator.edit', $user->id) }}" class="icon-button" title="Изменить">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    @role('admin')
                                    <form action="{{ route('admin.administrator.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-button" title="Удалить" onclick="return confirm('Вы уверены?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.administrator.block', $user->id) }}" class="icon-button" title="Заблокировать">
                                        <i class="fas fa-lock"></i>
                                    </a>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
