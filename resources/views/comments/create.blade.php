@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Comment</h1>
    <form method="POST" action="{{ route('comments.store') }}">
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
            <label for="number" class="form-label">Number</label>
            <input type="number" class="form-control" id="number" name="number" value="{{ old('number') }}" required>
            @error('number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Comment Text</label>
            <textarea class="form-control" id="text" name="text" rows="3" required>{{ old('text') }}</textarea>
            @error('text')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Comment</button>
        <a href="{{ route('comments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection 