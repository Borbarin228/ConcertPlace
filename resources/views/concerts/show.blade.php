@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Concert Details</h5>
                    <p class="card-text">
                        City: {{ $concert->city }}<br>
                        Place: {{ $concert->place }}<br>
                        Date: {{ $concert->start_at }}<br>
                        Status: {{ $concert->is_accepted ? 'Accepted' : 'Pending' }}
                    </p>
                    <a href="{{ route('concerts.edit', $concert->id) }}" class="btn btn-warning">Edit Concert</a>
                    <form action="{{ route('concerts.destroy', $concert->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this concert?')">Delete Concert</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Tickets</h3>


            @if($concert->tickets->count() > 0)
                <div class="table-responsive mb-4">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Ticket Number</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($concert->tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->number }}</td>
                                    <td>{{ $ticket->category->name }}</td>
                                    <td>${{ $ticket->category->price }}</td>
                                    <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    No tickets available for this concert.
                </div>
            @endif


            <h4>Ticket Cards</h4>
            @foreach($concert->tickets as $ticket)
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text">
                            Ticket Number: {{ $ticket->number }}<br>
                            Category: {{ $ticket->category->name }}<br>
                            Price: ${{ $ticket->category->price }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
