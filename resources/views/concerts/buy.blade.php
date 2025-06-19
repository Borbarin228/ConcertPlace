@extends('layouts.app')

@section('content')
<style>
.buy-wrap {
    max-width: 700px;
    margin: 40px auto 0 auto;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 2px 16px #0001;
    padding: 36px 32px 48px 32px;
}
.buy-header {
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 8px;
}
.buy-place {
    text-align: center;
    font-size: 1.2rem;
    font-weight: 500;
    margin-bottom: 24px;
}
.buy-row {
    display: flex;
    gap: 36px;
    align-items: flex-start;
    margin-bottom: 32px;
}
.buy-photo {
    width: 140px;
    height: 140px;
    border-radius: 24px;
    object-fit: cover;
    background: #eee;
    border: 2px solid #bbb;
}
.buy-categories {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.buy-category {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #ededed;
    border-radius: 30px;
    padding: 14px 32px;
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 0;
}
.buy-comment-block {
    margin-top: 18px;
    display: flex;
    align-items: center;
    gap: 18px;
}
.buy-comment-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    background: #eee;
    border: 1.5px solid #bbb;
}
.buy-comment-form {
    flex: 1 1 auto;
    display: flex;
    align-items: center;
    background: #fff;
    border: 2px solid #bbb;
    border-radius: 30px;
    padding: 0 18px;
}
.buy-comment-input {
    border: none;
    outline: none;
    font-size: 1.1rem;
    flex: 1 1 auto;
    background: transparent;
    padding: 14px 0;
}
.buy-comment-btn {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #222;
    cursor: pointer;
    margin-left: 8px;
}
.buy-comment-list {
    margin-top: 18px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.buy-comment-item {
    display: flex;
    align-items: center;
    gap: 14px;
    background: #fff;
    border: 2px solid #bbb;
    border-radius: 30px;
    padding: 10px 22px;
    font-size: 1.1rem;
}
@media (max-width: 700px) {
    .buy-wrap { padding: 10px 2vw; }
    .buy-row { flex-direction: column; gap: 18px; align-items: center; }
    .buy-photo { width: 90px; height: 90px; }
}
</style>
<div class="buy-wrap">
    <div class="buy-header">{{ $concert->user->name ?? 'Без имени' }}</div>
    <div class="buy-place">{{ $concert->city }} – {{ $concert->place }}</div>
    <div class="buy-row">
        <img src="{{ $concert->user->avatar_url ?? asset('images/user-placeholder.png') }}" class="buy-photo" alt="Фото создателя">
        <div class="buy-categories">
            @foreach($concert->ticketCategories as $cat)
                <div class="buy-category" style="cursor:pointer;" onclick="openModal('{{ $cat->name }}', '{{ $cat->pivot->price ?? $cat->price }}', '{{ $cat->id }}')">
                    <span>{{ $cat->name }}</span>
                    <span>{{ $cat->pivot->price ?? $cat->price }}Р</span>
                </div>
            @endforeach
        </div>
    </div>
    <form class="buy-comment-block buy-comment-form" method="POST" action="{{ route('concerts.buy.comment', $concert->id) }}">
        @csrf
        <img src="{{ auth()->user()->avatar_url ?? asset('images/user-placeholder.png') }}" class="buy-comment-avatar" alt="Ваш аватар">
        <input type="text" class="buy-comment-input" name="comment" placeholder="Оставить комментарий">
        <button type="submit" class="buy-comment-btn">&#8594;</button>
    </form>
    <div class="buy-comment-list">
        @forelse($comments as $comment)
            <div class="buy-comment-item">
                <img src="{{ $comment->user->avatar_url ?? asset('images/user-placeholder.png') }}" class="buy-comment-avatar" alt="Аватар">
                <span><b>{{ $comment->user->name ?? 'Гость' }}</b> {{ $comment->text }}</span>
            </div>
        @empty
            <div style="color:#888; font-size:1.1rem; text-align:center;">Комментариев пока нет.</div>
        @endforelse
            <div style="margin-top:10px; display:flex; justify-content:center;margin-bottom:30px;">
                @if ($comments->onFirstPage())
                    <span style="font-size:1.3rem; color:#bbb; margin:0 8px;">&#8592;</span>
                @else
                    <a href="{{ $comments->previousPageUrl() }}" style="font-size:1.3rem; color:#1259c3; text-decoration:none; margin:0 8px;">&#8592;</a>
                @endif
                @if ($comments->hasMorePages())
                    <a href="{{ $comments->nextPageUrl() }}" style="font-size:1.3rem; color:#1259c3; text-decoration:none; margin:0 8px;">&#8594;</a>
                @else
                    <span style="font-size:1.3rem; color:#bbb; margin:0 8px;">&#8594;</span>
                @endif
            </div>
    </div>

</div>
<!-- Модальное окно оплаты -->
<div id="payModal" class="modal" style="display:none; position:fixed; z-index:2000; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.45); align-items:center; justify-content:center;">
    <div class="modal-content" style="background:#fff; border-radius:24px; padding:36px 32px 32px 32px; max-width:340px; width:95vw; box-shadow:0 2px 24px #0003; position:relative;">
        <span onclick="closeModal()" style="position:absolute; right:18px; top:12px; font-size:2rem; color:#222; cursor:pointer;">&times;</span>
        <div style="font-size:2rem; font-weight:bold; text-align:center; margin-bottom:18px;">ОПЛАТА</div>
        <div style="font-size:1.2rem; margin-bottom:18px; display:flex; justify-content:space-between;">
            <span>Сумма: <span id="modalPrice">0Р</span></span>
            <span>Количество: <span style="display:inline-flex; align-items:center; gap:8px;">
                <button type="button" onclick="changeQty(-1)" style="border:none; background:none; font-size:1.5rem; font-weight:bold;">−</button>
                <span id="modalQty">1</span>
                <button type="button" onclick="changeQty(1)" style="border:none; background:none; font-size:1.5rem; font-weight:bold;">+</button>
            </span></span>
        </div>
        <div style="margin-bottom:18px;">
            <div style="font-size:1rem; margin-bottom:6px;">Номер карты</div>
            <input type="text" maxlength="19" style="width:100%; border-radius:22px; border:none; background:#ededed; font-size:1.2rem; padding:12px 18px; text-align:center; margin-bottom:10px;" placeholder="0000 - 0000 - 0000 - 0000" readonly>
            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <div style="font-size:1rem; margin-bottom:6px;">дата</div>
                    <input type="text" maxlength="5" style="width:100%; border-radius:22px; border:none; background:#ededed; font-size:1.2rem; padding:12px 18px; text-align:center;" placeholder="MM/YY" readonly>
                </div>
                <div style="flex:1;">
                    <div style="font-size:1rem; margin-bottom:6px;">CVV</div>
                    <input type="text" maxlength="3" style="width:100%; border-radius:22px; border:none; background:#ededed; font-size:1.2rem; padding:12px 18px; text-align:center;" placeholder="CVV" readonly>
                </div>
            </div>
        </div>
        <button id="buyBtn" style="width:100%; background:#000; color:#fff; border:none; border-radius:16px; font-size:1.3rem; font-weight:bold; padding:14px 0; margin-top:10px;">КУПИТЬ</button>
    </div>
</div>
<script>
let modalPrice = 0;
let modalCategoryId = null;
function openModal(name, price, categoryId) {
    document.getElementById('payModal').style.display = 'flex';
    document.getElementById('modalPrice').innerText = price + 'Р';
    document.getElementById('modalQty').innerText = 1;
    modalPrice = parseInt(price);
    modalCategoryId = categoryId;
    updateSum();
}
function closeModal() {
    document.getElementById('payModal').style.display = 'none';
}
function changeQty(delta) {
    let qty = parseInt(document.getElementById('modalQty').innerText);
    qty = Math.max(1, qty + delta);
    document.getElementById('modalQty').innerText = qty;
    updateSum();
}
function updateSum() {
    let qty = parseInt(document.getElementById('modalQty').innerText);
    document.getElementById('modalPrice').innerText = (modalPrice * qty) + 'Р';
}
window.onclick = function(event) {
    let modal = document.getElementById('payModal');
    if (event.target === modal) closeModal();
}
document.getElementById('buyBtn').onclick = function(e) {
    e.preventDefault();
    let qty = parseInt(document.getElementById('modalQty').innerText);
    fetch(`{{ route('concerts.buy.ticket', $concert->id) }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
            category_id: modalCategoryId,
            qty: qty,
            number: qty
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Билет(ы) успешно добавлены!');
            closeModal();
        }
    });
};
</script>
@endsection
