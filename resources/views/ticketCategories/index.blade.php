@extends('layouts.app')

@section('content')
<h1>Список категорий билетов</h1>
<a href="{{ route('categories.create') }}" style="display:inline-block;margin-bottom:10px;">Создать категорию</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>id</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Действия</th>
    </tr>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}">Редактировать</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Удалить категорию?')">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div>
    {{ $categories->links() }}
</div>
@endsection 