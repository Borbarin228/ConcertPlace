@extends('layouts.app')

@section('content')
<h1>Список билетов</h1>
<a href="{{ route('ticket.create') }}" style="display:inline-block;margin-bottom:10px;">Создать билет</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>id</th>
        <th>Пользователь</th>
        <th>Концерт</th>
        <th>Категория</th>
        <th>Цена</th>
        <th>Действия</th>
    </tr>
    @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->user->name ?? '-' }}</td>
            <td>{{ $ticket->concert->city ?? '-' }} - {{ $ticket->concert->place ?? '-' }}</td>
            <td>{{ $ticket->category->name ?? '-' }}</td>
            <td>{{ $ticket->category->price ?? '-' }}</td>
            <td>
                <a href="{{ route('ticket.edit', $ticket->id) }}">Редактировать</a>
                <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Удалить билет?')">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div>
    {{ $tickets->links() }}
</div>
@endsection 