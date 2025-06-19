@extends('layouts.app')

@section('content')
<style>
.create-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 24px;
}
.create-form {
    max-width: 520px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.create-row {
    display: flex;
    gap: 18px;
}
.create-input, .create-date {
    border: 2px solid #bbb;
    border-radius: 30px;
    padding: 12px 28px;
    font-size: 1.15rem;
    background: #ededed;
    outline: none;
    width: 100%;
    margin-bottom: 0;
    font-weight: 400;
}
.create-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 12px 18px;
    margin-bottom: 0;
}
.category-btn {
    border: 2px solid #222;
    background: #ededed;
    color: #222;
    border-radius: 20px;
    padding: 8px 22px;
    font-size: 1.1rem;
    font-weight: 500;
    cursor: pointer;
    margin-bottom: 6px;
    transition: border 0.2s, color 0.2s;
}
.category-btn.selected {
    border: 2px solid #1a53ff;
    color: #1a53ff;
    background: #fff;
}
.category-price {
    border: 2px solid #bbb;
    border-radius: 20px;
    padding: 7px 18px;
    font-size: 1rem;
    background: #ededed;
    outline: none;
    width: 120px;
    margin-bottom: 0;
    margin-right: 10px;
}
.publish-btn {
    margin: 30px 0 0 auto;
    background: #000;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 1.2rem;
    font-weight: bold;
    padding: 14px 38px;
    cursor: pointer;
    transition: background 0.2s;
    display: block;
}
.publish-btn:hover {
    background: #333;
}
.add-category-btn {
    margin-top: 16px;
    background: #1a53ff;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 1.05rem;
    font-weight: bold;
    padding: 8px 28px;
    cursor: pointer;
    transition: background 0.2s;
    display: block;
}
.add-category-btn:hover {
    background: #003bb3;
}
.save-category-btn {
    background: #27ae60;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 1.05rem;
    font-weight: bold;
    padding: 8px 18px;
    cursor: pointer;
    margin-left: 8px;
    transition: background 0.2s;
}
.save-category-btn:hover {
    background: #1e8449;
}
@media (max-width: 600px) {
    .create-form { max-width: 100%; }
    .create-row { flex-direction: column; gap: 10px; }
}
</style>
<div class="create-title">Создание Концерта</div>
<form class="create-form" method="POST" action="{{ route('concerts.store') }}">
    @csrf
    <div class="create-row">
        <input type="text" name="city" class="create-input" placeholder="Город" value="{{ old('city') }}" required>
        <input type="text" name="place" class="create-input" placeholder="Площадка" value="{{ old('place') }}" required>
    </div>
    <div class="create-categories" id="categories-list">
        @foreach($categories as $category)
            <label style="display:flex; flex-direction:column; align-items:center;">
                <input type="checkbox" name="categories[]" value="{{ $category->id }}" style="display:none;" onchange="this.nextElementSibling.classList.toggle('selected', this.checked)">
                <span class="category-btn">{{ $category->name }}</span>
                <input type="number" name="prices[{{ $category->id }}]" class="category-price" placeholder="Цена" min="0" step="1" {{ !old('categories') || !in_array($category->id, old('categories', [])) ? 'disabled' : '' }} value="{{ old('prices.'.$category->id) }}">
            </label>
        @endforeach
    </div>
    <input type="date" name="start_at" class="create-date" placeholder="Дата" value="{{ old('start_at') }}" required>
    <button type="submit" class="publish-btn">Опубликовать</button>
</form>
<script>
document.querySelectorAll('.create-categories input[type=checkbox]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        const priceInput = this.parentElement.querySelector('.category-price');
        priceInput.disabled = !this.checked;
    });
});

const addBtn = document.getElementById('add-category-btn');
const newForm = document.getElementById('new-category-form');
const saveBtn = newForm.querySelector('.save-category-btn');
addBtn.addEventListener('click', function() {
    newForm.style.display = 'flex';
});
saveBtn.addEventListener('click', function() {
    const name = document.getElementById('new-category-name').value.trim();
    const price = document.getElementById('new-category-price').value.trim();
    if (!name) return alert('Введите название категории');
    const id = 'new_' + Date.now();
    const label = document.createElement('label');
    label.style.display = 'flex';
    label.style.flexDirection = 'column';
    label.style.alignItems = 'center';
    label.innerHTML = `
        <input type="checkbox" name="categories[]" value="${id}" style="display:none;" checked>
        <span class="category-btn selected">${name}</span>
        <input type="number" name="prices[${id}]" class="category-price" placeholder="Цена" min="0" step="1" value="${price}">
    `;
    document.getElementById('categories-list').appendChild(label);
    newForm.style.display = 'none';
    document.getElementById('new-category-name').value = '';
    document.getElementById('new-category-price').value = '';
});
</script>
@endsection 