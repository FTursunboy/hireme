<table class="table table-hover text-nowrap">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Категория</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($performers as $performer)
        <tr>
            <td>{{ $performer->id }}</td>
            <td>{{ $performer->name }}</td>
            <td>{{$performer->categories->pluck('name')->implode(', ')}}</td>

            <td>{{ $performer->status }}</td>
            <td>
                <a href="{{ route('admin.performers.edit', $performer->id) }}" class="icon-button" title="Изменить">
                    <i class="fas fa-pen"></i>
                </a>

                <form action="{{ route('admin.performers.destroy', $performer->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-button" title="Удалить" onclick="return confirm('Вы уверены?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $performers->links() }}
