@extends('layouts.app')

@section('content')
<style>
.concerts-title {
    text-align: center;
    font-size: 2.2rem;
    font-weight: bold;
    margin: 40px 0 30px 0;
}
.concerts-filters {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 40px;
}
.concerts-filters input {
    border: 2px solid #222;
    border-radius: 30px;
    padding: 12px 30px;
    font-size: 1.2rem;
    outline: none;
    width: 220px;
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
.concert-buy {
    background: #000;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 1.3rem;
    font-weight: bold;
    padding: 16px 38px;
    cursor: pointer;
    transition: background 0.2s;
}
.concert-buy:hover {
    background: #333;
}
</style>
<div class="concerts-title">Список Концертов</div>
<div class="concerts-filters">
    <form method="GET" action="{{ route('concerts.index') }}" style="margin-bottom: 0;">
        <label for="per_page">Показать на странице:</label>
        <select name="per_page" id="per_page" onchange="this.form.submit()">
            @foreach([5, 6, 7, 8] as $size)
                <option value="{{ $size }}" {{ (isset($perPage) && $perPage == $size) ? 'selected' : '' }}>{{ $size }}</option>
            @endforeach
        </select>
    </form>
</div>
<div class="concert-list">
    @forelse($concerts as $concert)
        <div class="concert-card">
            <img src="{{ $concert->user->avatar_url ?? asset('images/user-placeholder.png') }}" class="concert-photo" alt="Фото пользователя">
            <div class="concert-info">
                <div class="concert-title">{{ $concert->user->name ?? 'Без имени' }}</div>
                <div class="concert-place">{{ $concert->city }} – {{ $concert->place }}</div>
                <div class="concert-date">{{ \Carbon\Carbon::parse($concert->start_at)->translatedFormat('d F Y') }}</div>
            </div>
            <a href="{{ route('concerts.buy', $concert->id) }}" class="concert-buy">КУПИТЬ</a>
        </div>
    @empty
        <div style="color:#888; font-size:1.1rem; text-align:center;">Пока концертов нет.</div>
    @endforelse
</div>
<div style="display: flex; justify-content: center; align-items: center; margin: 30px 0; margin-bottom: 70px">
    @php $query = request()->query(); $query['per_page'] = $perPage; @endphp
    @if ($concerts->onFirstPage())
        <span style="font-size:2rem; color:#bbb; margin:0 18px;">&#8592;</span>
    @else
        <a href="{{ $concerts->previousPageUrl() . '&' . http_build_query(['per_page' => $perPage]) }}" style="font-size:2rem; color:#1259c3; text-decoration:none; margin:0 18px;">&#8592;</a>
    @endif

    <span style="margin:0 10px; font-size:1.1rem; color:#444;">
        Страница {{ $concerts->currentPage() }} из {{ $concerts->lastPage() }}
    </span>

    @if ($concerts->hasMorePages())
        <a href="{{ $concerts->nextPageUrl() . '&' . http_build_query(['per_page' => $perPage]) }}" style="font-size:2rem; color:#1259c3; text-decoration:none; margin:0 18px;">&#8594;</a>
    @else
        <span style="font-size:2rem; color:#bbb; margin:0 18px;">&#8594;</span>
    @endif
</div>
@endsection
