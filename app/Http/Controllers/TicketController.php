<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Comment;
use App\Models\Ticket;
use App\Models\Concert;
use App\Models\Ticket_Category;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user', 'concert', 'category')->paginate(5);
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $users = User::all();
        $concerts = Concert::all();
        $categories = Ticket_Category::all();
        return view('tickets.create', compact('users', 'concerts', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'number' => 'required|integer|min:1|unique:ticket,number',
            'concert_id' => 'required|integer|exists:concerts,id',
            'category_id' => 'required|integer|exists:ticket_categories,id',
        ]);
        Ticket::create($validated);
        return redirect()->route('ticket.index')->with('success', 'Ticket created successfully.');
    }

    public function show($id)
    {
        $ticket = Ticket::with('user', 'concert.ticketCategories', 'category')->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $users = User::all();
        $concerts = Concert::all();
        $categories = Ticket_Category::all();
        return view('tickets.edit', compact('ticket', 'users', 'concerts', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'number' => 'required|integer|min:1|unique:ticket,number,' . $id,
            'concert_id' => 'required|integer|exists:concerts,id',
            'category_id' => 'required|integer|exists:ticket_categories,id',
        ]);
        $ticket->update($validated);
        return redirect()->route('ticket.show', $ticket->id)->with('success', 'Ticket updated successfully.');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $userId = $ticket->user_id;
        $ticket->delete();
        return redirect()->route('users.show', $userId)->with('success', 'Ticket deleted successfully.');
    }
}
