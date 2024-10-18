
<table class="table table-hover text-nowrap">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Телефон</th>
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
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->status ? 'Активный' : 'Не активный' }}</td>
            <td>{{ $user->created_at->format('d.m.Y') }}</td>
            <td>
                <a href="{{ route('admin.customers.edit', $user->id) }}" class="icon-button" title="Изменить">
                    <i class="fas fa-pen"></i>
                </a>

                <form action="{{ route('admin.customers.destroy', $user->id) }}" method="POST" style="display:inline-block;">
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
