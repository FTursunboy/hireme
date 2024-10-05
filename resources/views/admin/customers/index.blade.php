@extends('adminlte::page')

@section('title', 'Заказчики')

@section('content_header')
    <h1>Заказчики</h1>
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
                <div class="card-header d-flex justify-content-between align-items-center">

                    <div class="d-flex w-100">
                        <form id="filtersForm" class="form-inline">
                            <input type="text" name="search" id="searchInput" class="form-control" placeholder="Поиск..." style="margin-right: 10px;" value="{{ request()->get('search') }}">

                            <select name="status" id="statusFilter" class="form-control" style="margin-right: 20px;">
                                <option value="">Все статусы</option>
                                <option value="{{ \App\Enum\UserStatus::Active }}">Активный</option>
                                <option value="{{ \App\Enum\UserStatus::InActive }}">Не активный</option>
                            </select>
                        </form>

                        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary ml-auto">
                            <i class="fas fa-plus"></i> Добавить
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive p-0" id="table">
                    @include('admin.customers.table', ['users' => $users])
                </div>

            </div>
        </div>
    </div>
    {{$users->links()}}
@endsection
@push('js')
    <script>
        function fetchPerformers() {
            let search = $('#searchInput').val();
            let status = $('#statusFilter').val();

            $.ajax({
                url: '{{ route('admin.customers.index') }}',
                method: 'GET',
                data: {
                    search: search,
                    status: status,
                },
                success: function(response) {
                    $('#table').html(response);
                }
            });
        }

        $(document).ready(function() {
            $('#searchInput').on('input', fetchPerformers);
            $('#statusFilter').on('change', fetchPerformers);
        });
    </script>
@endpush

