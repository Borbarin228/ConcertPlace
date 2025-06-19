@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Ticket</h1>
    <form method="POST" action="{{ route('ticket.store') }}">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select class="form-select" id="user_id" name="user_id" required>
                <option value="">Select a User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="number" class="form-label">Ticket Number</label>
            <input type="number" class="form-control" id="number" name="number" value="{{ old('number') }}" required>
            @error('number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="concert_id" class="form-label">Concert</label>
            <select class="form-select" id="concert_id" name="concert_id" required>
                <option value="">Select a Concert</option>
                @foreach($concerts as $concert)
                    <option value="{{ $concert->id }}" {{ old('concert_id') == $concert->id ? 'selected' : '' }}>{{ $concert->city }} - {{ $concert->place }} ({{ $concert->start_at }})</option>
                @endforeach
            </select>
            @error('concert_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Ticket Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }} (${{ $category->price }})</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Ticket</button>
        <a href="{{ route('ticket.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection 