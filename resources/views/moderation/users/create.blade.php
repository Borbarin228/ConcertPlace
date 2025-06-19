@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Создать пользователя (Модератор)</h2>
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="mb-3">
            <label for="avatar" class="form-label">Аватар (необязательно)</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1">
            <label class="form-check-label" for="is_admin">Сделать администратором</label>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>
@endsection 