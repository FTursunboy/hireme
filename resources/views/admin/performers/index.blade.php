@extends('adminlte::page')

@section('title', 'Администраторы')

@section('content_header')
    <h1>ИсполнителиF</h1>
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

                            <select name="category" id="categoryFilter" class="form-control" style="margin-right: 10px;">
                                <option value="">Все категории</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="status" id="statusFilter" class="form-control" style="margin-right: 20px;">
                                <option value="">Все статусы</option>
                                <option value="{{ \App\Enum\ModerationStatuses::Moderation }}">{{ \App\Enum\ModerationStatuses::Moderation }}</option>
                                <option value="{{ \App\Enum\ModerationStatuses::Published }}">{{ \App\Enum\ModerationStatuses::Published }}</option>
                                <option value="{{ \App\Enum\ModerationStatuses::UnPublished }}">{{ \App\Enum\ModerationStatuses::UnPublished }}</option>
                            </select>
                        </form>

                        <a href="{{ route('admin.performers.create') }}" class="btn btn-primary ml-auto">
                            <i class="fas fa-plus"></i> Добавить
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive p-0" id="performersTable">
                    @include('admin.performers.table', ['performers' => $performers])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function fetchPerformers() {
            let search = $('#searchInput').val();
            let category = $('#categoryFilter').val();
            let status = $('#statusFilter').val();

            $.ajax({
                url: '{{ route('admin.performers.index') }}',
                method: 'GET',
                data: {
                    search: search,
                    category: category,
                    status: status,
                },
                success: function(response) {
                    $('#performersTable').html(response);
                }
            });
        }

        $(document).ready(function() {
            $('#searchInput').on('input', fetchPerformers);
            $('#categoryFilter').on('change', fetchPerformers);
            $('#statusFilter').on('change', fetchPerformers);
        });
    </script>
@endpush
