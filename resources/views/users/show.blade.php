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
.confirm-btn {
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
.confirm-btn:hover {
    background: #333;
}
.profile-edit-icon {
    margin-left: 10px;
    font-size: 1.2rem;
    cursor: pointer;
}
.profile-title {
    font-size: 2rem;
    font-weight: 500;
    margin: 30px 0 18px 0;
    display: flex;
    align-items: center;
    gap: 12px;
}
.tickets-list {
    width: 100%;
    max-width: 800px;
    margin: 0 auto 30px auto;
}
.ticket-card {
    position: relative;
    display: flex;
    align-items: center;
    background: #ededed;
    border: 2px solid #222;
    border-radius: 30px;
    margin-bottom: 24px;
    padding: 18px 32px;
    gap: 28px;
}
.ticket-artist-photo {
    width: 80px;
    height: 80px;
    border-radius: 18px;
    object-fit: cover;
    background: #fff;
    border: 1.5px solid #bbb;
}
.ticket-info {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.ticket-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 2px;
}
.ticket-place {
    font-size: 1.1rem;
    color: #222;
}
.ticket-date {
    font-size: 1rem;
    color: #444;
}
.ticket-category {
    background: #000;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 1.1rem;
    font-weight: bold;
    padding: 10px 28px;
    margin-right: 18px;
    min-width: 90px;
    text-align: center;
}
.ticket-cut {
    position: absolute;
    right: 70px;
    top: 18px;
    bottom: 18px;
    width: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ticket-cut:after {
    content: '';
    display: block;
    width: 2px;
    height: 100%;
    border-right: 2px dashed #222;
}
.ticket-qty {
    font-weight: bold;
    font-size: 1.25rem;
    color: #222;
    margin-left: 18px;
    margin-right: 18px;
    position: relative;
    z-index: 1;
}
.delete-ticket-btn {
    position: absolute;
    right: -52px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0);
    color: rgb(0, 42, 255);
    border: none;
    border-radius: 50%;
    width: 44px;
    height: 44px;
    font-size: 2rem;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px #0002;
    transition: background 0.2s;
    z-index: 2;
}
.delete-ticket-btn:hover {
    background: #e74c3c;
    color: #fff;
}
.create-event-btn {
    display: block;
    margin: 0 auto 30px auto;
    background: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 1.2rem;
    font-weight: bold;
    padding: 14px 44px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: background 0.2s;
    box-shadow: 0 2px 8px #0001;
}
.create-event-btn:hover {
    background: #c0392b;
}
.my-events-title {
    text-align: center;
    font-size: 1.7rem;
    font-weight: bold;
    margin: 30px 0 18px 0;
    letter-spacing: 1px;
}
@media (max-width: 700px) {
    .profile-row { flex-direction: column; align-items: center; gap: 18px; }
    .profile-fields { min-width: 0; }
    .profile-field-box { min-width: 0; width: 100%; }
    .tickets-list { max-width: 100%; }
    .delete-ticket-btn { right: -28px; width: 36px; height: 36px; font-size: 1.3rem; }
    .ticket-qty { margin-left: 8px; margin-right: 8px; }
}
.avatar-hover:hover {
    box-shadow: 0 0 0 4px #e74c3c44;
    transition: box-shadow 0.2s;
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
.delete-concert-btn {
    background: rgba(231, 76, 60, 0);
    color: #ff0000;
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
</style>
<div class="profile-container">
    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="profile-row">
            <div style="display:flex; flex-direction:column; align-items:center;">
                <label for="avatar-input" style="cursor:pointer;">
                    <img id="avatar-preview" src="{{ $user->avatar_url ?? asset('images/user-placeholder.png') }}" class="profile-avatar avatar-hover" alt="Аватар пользователя">
                </label>
                <input id="avatar-input" type="file" name="avatar" class="profile-avatar-upload" accept="image/*" style="display:none;">
                <div id="unsaved-warning" style="display:none; color:#e74c3c; font-size:1.05rem; margin-top:8px;">Вы не сохранили изменения</div>
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
        <button type="submit" class="confirm-btn">Подтвердить изменения</button>
    </form>
    <div class="profile-title">Мои Билеты</div>
    <div class="tickets-list">
        @forelse($user->tickets as $ticket)
            <div class="ticket-card">
                <img src="{{ $ticket->concert->user->avatar_url ?? asset('images/user-placeholder.png') }}" class="ticket-artist-photo" alt="Фото артиста">
                <div class="ticket-info">
                    <div class="ticket-title">{{ $ticket->concert->user->name ?? 'Артист' }}</div>
                    <div class="ticket-place">{{ $ticket->concert->city }} – {{ $ticket->concert->place }}</div>
                    <div class="ticket-date">{{ \Carbon\Carbon::parse($ticket->concert->start_at)->translatedFormat('d F Y') }}</div>
                </div>
                <span class="ticket-category">{{ $ticket->category->name ?? '' }}</span>
                <span class="ticket-cut"></span>
                <span class="ticket-qty">X{{ $ticket->number ?? 1 }}</span>
                <form method="POST" action="{{ route('ticket.destroy', $ticket->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-ticket-btn" onclick="return confirm('Удалить билет?')">&#10006;</button>
                </form>
            </div>
        @empty
            <div style="color:#888; font-size:1.1rem; text-align:center;">У вас пока нет билетов.</div>
        @endforelse
    </div>
    <a href="{{ route('concerts.create') }}" class="create-event-btn">Создать мероприятие</a>
    <div class="my-events-title">Мои мероприятия</div>
    <div class="concert-list">
        @forelse($concerts as $concert)
            <div class="concert-card" style="margin-bottom: 80px">
                <img src="{{ $concert->user->avatar_url ?? asset('images/user-placeholder.png') }}" class="concert-photo" alt="Фото пользователя">
                <div class="concert-info">
                    <div class="concert-title">{{ $concert->user->name ?? 'Без имени' }}</div>
                    <div class="concert-place">{{ $concert->city }} – {{ $concert->place }}</div>
                    <div class="concert-date">{{ \Carbon\Carbon::parse($concert->start_at)->translatedFormat('d F Y') }}</div>
                </div>
                <form method="POST" action="{{ route('concerts.destroy', $concert->id) }}" style="margin-left:18px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-concert-btn" onclick="return confirm('Удалить мероприятие?')">&#10006;</button>
                </form>
            </div>
        @empty
            <div style="color:#888; font-size:1.1rem; text-align:center;">Вы ещё не создавали мероприятий.</div>
        @endforelse
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('avatar-input');
    const preview = document.getElementById('avatar-preview');
    const warning = document.getElementById('unsaved-warning');
    if (fileInput && preview && warning) {
        fileInput.addEventListener('change', function(e) {
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    preview.src = ev.target.result;
                };
                reader.readAsDataURL(fileInput.files[0]);
                warning.style.display = 'block';
            } else {
                warning.style.display = 'none';
            }
        });
    }
});
</script>
@endsection
