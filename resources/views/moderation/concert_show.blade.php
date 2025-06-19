@extends('layouts.app')

@section('content')
<div style="max-width:700px;margin:60px auto 0 auto;">
    <h1 style="font-size:2.2rem;font-weight:bold;text-align:center;">Информация о концерте</h1>
    <div style="margin:36px auto 0 auto;display:flex;gap:36px;align-items:flex-start;">
        <img src="{{ $concert->user->avatar_url ?? asset('images/user-placeholder.png') }}" style="width:120px;height:120px;border-radius:24px;object-fit:cover;border:2px solid #bbb;">
        <div style="flex:1;">
            <div style="font-size:1.3rem;font-weight:bold;">{{ $concert->user->name ?? 'Без имени' }}</div>
            <div style="margin:10px 0 0 0;">Город: <b>{{ $concert->city }}</b></div>
            <div>Площадка: <b>{{ $concert->place }}</b></div>
            <div>Дата: <b>{{ \Carbon\Carbon::parse($concert->start_at)->translatedFormat('d F Y') }}</b></div>
            <div>ID концерта: <b>{{ $concert->id }}</b></div>
            <div>Статус: <b>{{ $concert->is_accepted ? 'Подтверждён' : 'Не подтверждён' }}</b></div>
            <div>Создан: <b>{{ $concert->created_at }}</b></div>
            <div>Обновлён: <b>{{ $concert->updated_at }}</b></div>
            <div style="margin-top:18px;">
                <b>Категории билетов:</b>
                <ul style="margin:8px 0 0 18px;">
                    @forelse($concert->ticketCategories as $cat)
                        <li>{{ $cat->name }} @if(isset($cat->pivot->price)) — {{ $cat->pivot->price }}₽ @endif</li>
                    @empty
                        <li>Нет категорий</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    <a href="{{ route('moderation.concerts') }}" style="display:block;margin:40px auto 0 auto;text-align:center;text-decoration:underline;color:#1a53ff;font-size:1.1rem;">← Назад к списку концертов</a>
</div>
@endsection 