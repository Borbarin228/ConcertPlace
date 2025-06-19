@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ticket Details #{{ $ticket->number }}</h5>
                    <p class="card-text">
                        <strong>User:</strong> {{ $ticket->user->name ?? 'N/A' }}<br>
                        <strong>Concert:</strong> 
                        @if($ticket->concert)
                            <a href="{{ route('concerts.show', $ticket->concert->id) }}">{{ $ticket->concert->city }} - {{ $ticket->concert->place }} ({{ $ticket->concert->start_at }})</a>
                        @else
                            N/A
                        @endif
                        <br>
                        <strong>Category:</strong> 
                        @if($ticket->category)
                            <a href="{{ route('categories.show', $ticket->category->id) }}">{{ $ticket->category->name }} (${{ $ticket->category->price }})</a>
                        @else
                            N/A
                        @endif
                        <br>
                        <strong>Created At:</strong> {{ $ticket->created_at->format('Y-m-d H:i') }}<br>
                        <strong>Last Updated:</strong> {{ $ticket->updated_at->format('Y-m-d H:i') }}
                    </p>
                    <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-warning me-2">Edit Ticket</a>
                    <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete Ticket</button>
                    </form>
                    <a href="{{ route('ticket.index') }}" class="btn btn-secondary mt-3">Back to Tickets</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 