@extends('layouts.app')

@section('content')
<div style="max-width:700px;margin:60px auto 0 auto;text-align:center;">
    <h1 style="font-size:2.2rem;font-weight:bold;">Панель модерации</h1>
    <p style="font-size:1.2rem; color:#444; margin-top:18px;">Только для администраторов</p>
    <div class="moder-nav" style="display:flex;justify-content:center;gap:36px;margin:48px 0 40px 0;">
        <a href="{{ route('users.index') }}" class="moder-nav-btn">Пользователи</a>
        <a href="{{ route('moderation.concerts') }}" class="moder-nav-btn">Концерты</a>
    </div>
    <div style="margin-top:40px; color:#888;">Здесь будет функционал для модерации...</div>
</div>
<style>
.moder-nav-btn {
    display: inline-block;
    background: #1a53ff;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 1.25rem;
    font-weight: bold;
    padding: 18px 44px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: background 0.2s;
    box-shadow: 0 2px 8px #0001;
}
.moder-nav-btn:hover {
    background: #003bb3;
}
</style>
@endsection 