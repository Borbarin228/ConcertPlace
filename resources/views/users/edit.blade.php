@extends('layouts.app')

@section('content')
<style>
.profile-container {
    max-width: 900px;
    margin: 40px auto 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.profile-row {
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: flex-start;
    gap: 48px;
    margin-bottom: 18px;
}
.profile-avatar {
    width: 180px;
    height: 180px;
    border-radius: 30px;
    object-fit: cover;
    background: #eee;
    box-shadow: 0 2px 8px #0001;
}
.profile-fields {
    display: flex;
    flex-direction: column;
    gap: 22px;
    margin-top: 18px;
}
.profile-field-label {
    font-size: 0.95rem;
    color: #222;
    margin-bottom: 2px;
    margin-left: 8px;
}
.profile-field-box {
    display: flex;
    align-items: center;
    background: #fff;
    border: 2px solid #222;
    border-radius: 30px;
    padding: 10px 28px;
    font-size: 1.25rem;
    min-width: 320px;
    font-weight: 400;
    margin-bottom: 0;
}
.profile-input {
    border: none;
    outline: none;
    font-size: 1.25rem;
    background: transparent;
    width: 100%;
}
.profile-edit-icon {
    margin-left: 10px;
    font-size: 1.2rem;
    cursor: pointer;
}
.profile-avatar-upload {
    margin-top: 12px;
    font-size: 1rem;
}
.save-btn {
    margin: 30px auto 0 auto;
    display: block;
    background: #000;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 1.2rem;
    font-weight: bold;
    padding: 12px 38px;
    cursor: pointer;
    transition: background 0.2s;
}
.save-btn:hover {
    background: #333;
}
@media (max-width: 700px) {
    .profile-row { flex-direction: column; align-items: center; gap: 18px; }
    .profile-fields { min-width: 0; }
    .profile-field-box { min-width: 0; width: 100%; }
}
</style>
<div class="profile-container">
    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="profile-row">
            <div style="display:flex; flex-direction:column; align-items:center;">
                <img src="{{ $user->avatar_url ?? asset('images/user-placeholder.png') }}" class="profile-avatar" alt="Аватар пользователя">
                <input type="file" name="avatar" class="profile-avatar-upload" accept="image/*">
                @if ($user->avatar)
                    <div style="margin-top:8px;">
                        <label><input type="checkbox" name="remove_avatar" value="1"> Удалить аватар</label>
                    </div>
                @endif
                @error('avatar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="profile-fields">
                <div>
                    <div class="profile-field-label">Имя Профиля</div>
                    <div class="profile-field-box">
                        <input type="text" name="name" class="profile-input" value="{{ old('name', $user->name) }}" required>
                    </div>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <div class="profile-field-label">Почта</div>
                    <div class="profile-field-box">
                        <input type="email" name="email" class="profile-input" value="{{ old('email', $user->email) }}" required>
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="save-btn">Сохранить</button>
        <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary" style="margin-left:20px;">Отмена</a>
    </form>
</div>
@endsection 