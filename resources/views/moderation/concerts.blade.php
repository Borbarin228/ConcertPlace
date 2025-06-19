@extends('layouts.app')

@section('content')
<style>
.moder-concerts-title {
    text-align: center;
    font-size: 2.2rem;
    font-weight: bold;
    margin: 40px 0 30px 0;
}
.concert-list {
    max-width: 900px;
    margin: 0 auto;
}
.concert-card {
    display: flex;
    align-items: center;
    background: #ededed;
    border: 2px solid #222;
    border-radius: 30px;
    margin-bottom: 24px;
    padding: 18px 32px;
    gap: 28px;
    box-shadow: none;
    transition: transform 0.18s;
}
.concert-card:hover {
    transform: scale(1.055);
    z-index: 2;
}
.concert-photo {
    width: 80px;
    height: 80px;
    border-radius: 18px;
    object-fit: cover;
    background: #fff;
    border: 1.5px solid #bbb;
}
.concert-info {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.concert-title {
    font-size: 1.35rem;
    font-weight: bold;
    margin-bottom: 2px;
}
.concert-place {
    font-size: 1.1rem;
    color: #222;
}
.concert-date {
    font-size: 1rem;
    color: #444;
}
.delete-concert-btn {
    background: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 1.3rem;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 10px;
    transition: background 0.2s;
}
.delete-concert-btn:hover {
    background: #c0392b;
}
.accept-concert-btn {
    background: #27ae60;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 1.05rem;
    font-weight: bold;
    padding: 10px 22px;
    cursor: pointer;
    margin-right: 8px;
    transition: background 0.2s;
}
.accept-concert-btn:hover {
    background: #1e8449;
}
</style>
<div class="moder-concerts-title">Концерты (Модерация)</div>
<div class="concert-list">
    @forelse($concerts as $concert)
        <a href="{{ route('moderation.concerts.show', $concert->id) }}" style="text-decoration:none; color:inherit;">
        <div class="concert-card">
            <img src="{{ $concert->user->avatar_url ?? asset('images/user-placeholder.png') }}" class="concert-photo" alt="Фото пользователя">
            <div class="concert-info">
                <div class="concert-title">{{ $concert->user->name ?? 'Без имени' }}</div>
                <div class="concert-place">{{ $concert->city }} – {{ $concert->place }}</div>
                <div class="concert-date">{{ \Carbon\Carbon::parse($concert->start_at)->translatedFormat('d F Y') }}</div>
            </div>
            @if(!$concert->is_accepted)
            <form method="POST" action="{{ route('moderation.concerts.accept', $concert->id) }}" style="margin-left:10px;">
                @csrf
                @method('PATCH')
                <button type="submit" class="accept-concert-btn">Подтвердить</button>
            </form>
            @endif
            <form method="POST" action="{{ route('concerts.destroy', $concert->id) }}" style="margin-left:10px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-concert-btn" onclick="return confirm('Удалить концерт?')">&#10006;</button>
            </form>
        </div>
        </a>
    @empty
        <div style="color:#888; font-size:1.1rem; text-align:center">Пока концертов нет.</div>
    @endforelse
</div>
@endsection
