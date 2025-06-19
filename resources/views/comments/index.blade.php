@extends('layouts.app')

@section('content')
<h1>Список комментариев</h1>
<a href="{{ route('comments.create') }}" style="display:inline-block;margin-bottom:10px;">Создать комментарий</a>

<form method="GET" action="{{ route('comments.index') }}" style="margin-bottom: 10px;">
    <label for="per_page">Показать на странице:</label>
    <select name="per_page" id="per_page" onchange="this.form.submit()">
        @foreach([5, 10, 20, 50] as $size)
            <option value="{{ $size }}" {{ (isset($perPage) && $perPage == $size) ? 'selected' : '' }}>{{ $size }}</option>
        @endforeach
    </select>
</form>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>id</th>
        <th>Пользователь</th>
        <th>Текст</th>
        <th>Дата</th>
        <th>Действия</th>
    </tr>
    @foreach($comments as $comment)
        <tr>
            <td>{{ $comment->id }}</td>
            <td>{{ $comment->user->name ?? '-' }}</td>
            <td>{{ $comment->content }}</td>
            <td>{{ $comment->created_at }}</td>
            <td>
                <a href="{{ route('comments.edit', $comment->id) }}">Редактировать</a>
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Удалить комментарий?')">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div>
    {{ $comments->appends(['per_page' => $perPage])->links() }}
</div>
@endsection 