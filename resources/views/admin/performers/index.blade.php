@extends('adminlte::page')

@section('title', 'Исполнители')

@section('content_header')
    <h1>Исполнители</h1>
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
                                    <option value="{{ $category->id }}" {{ request()->get('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Пустой селект для подкатегорий -->
                            <select name="subcategory" id="subcategoryFilter" class="form-control" style="margin-right: 10px;" disabled>
                                <option value="">Все подкатегории</option>
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
            let subcategory = $('#subcategoryFilter').val();
            let status = $('#statusFilter').val();

            $.ajax({
                url: '{{ route('admin.performers.index') }}',
                method: 'GET',
                data: {
                    search: search,
                    category: subcategory,
                    status: status,
                },
                success: function(response) {
                    $('#performersTable').html(response);
                }
            });
        }

        function fetchSubcategories(categoryId) {
            if (!categoryId) {
                $('#subcategoryFilter').html('<option value="">Все подкатегории</option>').prop('disabled', true);
                return;
            }

            $.ajax({
                url: '/admin/subcategories/' + categoryId,
                method: 'GET',
                success: function(response) {
                    let options = '<option value="">Все подкатегории</option>';
                    response.subcategories.forEach(function(subcategory) {
                        options += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                    });

                    $('#subcategoryFilter').html(options).prop('disabled', false);
                }
            });
        }

        $(document).ready(function() {
            $('#searchInput').on('input', fetchPerformers);
            $('#categoryFilter').on('change', function() {
                let categoryId = $(this).val();
                fetchSubcategories(categoryId);
                fetchPerformers();
            });
            $('#subcategoryFilter').on('change', fetchPerformers);
            $('#statusFilter').on('change', fetchPerformers);
        });
    </script>
@endpush
