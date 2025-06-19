@extends('layouts.app')

@section('content')
<h1>Список пользователей</h1>
<a href="{{ route('users.create') }}" style="display:inline-block;margin-bottom:10px;">Создать пользователя</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>id</th>
        <th>Имя</th>
        <th>Логин</th>
        <th>Описание</th>
        <th>Админ</th>
        <th>Аватар</th>
        <th>Действия</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->login }}</td>
            <td>{{ $user->description }}</td>
            <td>{{ $user->is_admin ? 'Да' : 'Нет' }}</td>
            <td>
                @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" alt="avatar" width="40">
                @else
                    -
                @endif
            </td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}">Редактировать</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Удалить пользователя?')">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div>
    {{ $users->links() }}
</div>
@endsection 