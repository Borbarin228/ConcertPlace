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
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Available Ticket Categories</h3>
            @foreach($concert->ticketCategories as $category)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">
                            Description: {{ $category->description }}<br>
                            Price: ${{ $category->price }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 