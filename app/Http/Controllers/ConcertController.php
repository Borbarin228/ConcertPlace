<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Concert;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    public function index()
    {
        $concerts = Concert::all();
        return view('concerts.index', compact('concerts'));
    }

    public function show($id)
    {
        $concert = Concert::with('tickets.category')->findOrFail($id);
        return view('concerts.show', compact('concert'));
    }

    public function categories($id)
    {
        $concert = Concert::with('ticketCategories')->findOrFail($id);
        return view('concerts.categories', compact('concert'));
    }
}
