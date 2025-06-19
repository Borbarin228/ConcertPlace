@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Ticket Category: {{ $category->name }}</h1>
    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="owner_id" class="form-label">Owner (User)</label>
            <select class="form-select" id="owner_id" name="owner_id" required>
                <option value="">Select a User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('owner_id', $category->owner_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('owner_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $category->price) }}" required>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection 