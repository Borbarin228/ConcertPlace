@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Concert: {{ $concert->city }} - {{ $concert->place }}</h1>
    <form method="POST" action="{{ route('concerts.update', $concert->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $concert->city) }}" required>
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="place" class="form-label">Place</label>
            <input type="text" class="form-control" id="place" name="place" value="{{ old('place', $concert->place) }}" required>
            @error('place')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="start_at" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_at" name="start_at" value="{{ old('start_at', $concert->start_at) }}" required>
            @error('start_at')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_accepted" name="is_accepted" value="1" {{ old('is_accepted', $concert->is_accepted) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_accepted">Accepted</label>
            @error('is_accepted')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Concert</button>
        <a href="{{ route('concerts.show', $concert->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection 