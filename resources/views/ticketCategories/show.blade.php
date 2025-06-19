@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="card-text">
                        <strong>Description:</strong> {{ $category->description }}<br>
                        <strong>Price:</strong> ${{ number_format($category->price, 2) }}<br>
                        <strong>Owner:</strong> {{ $category->owner->name ?? 'N/A' }}<br>
                        <strong>Total Tickets:</strong> {{ $category->tickets->count() }}
                    </p>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit Category</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete Category</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Tickets in this category</h3>
            
            @if($category->tickets->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Ticket Number</th>
                                <th>Concert</th>
                                <th>Concert Date</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->number }}</td>
                                    <td>
                                        @if($ticket->concert)
                                            {{ $ticket->concert->city }} - {{ $ticket->concert->place }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($ticket->concert)
                                            {{ $ticket->concert->start_at }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    No tickets available in this category.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 