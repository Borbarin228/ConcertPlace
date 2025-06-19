@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Comment #{{ $comment->number }}</h5>
                    <p class="card-text">
                        <strong>User:</strong> {{ $comment->user->name ?? 'N/A' }}<br>
                        <strong>Text:</strong> {{ $comment->text }}<br>
                        <strong>Created At:</strong> {{ $comment->created_at->format('Y-m-d H:i') }}<br>
                        <strong>Last Updated:</strong> {{ $comment->updated_at->format('Y-m-d H:i') }}
                    </p>
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning me-2">Edit Comment</a>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete Comment</button>
                    </form>
                    <a href="{{ route('comments.index') }}" class="btn btn-secondary mt-3">Back to Comments</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 