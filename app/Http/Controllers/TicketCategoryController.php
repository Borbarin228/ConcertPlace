<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket_Category;
use App\Models\User;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index()
    {
        $categories = Ticket_Category::paginate(5);
        return view('ticketCategories.index', compact('categories'));
    }

    public function create()
    {
        $users = User::all();
        return view('ticketCategories.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'owner_id' => 'required|integer|exists:users,id',
            'price' => 'required|numeric|min:0',
        ]);
        Ticket_Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Ticket category created successfully.');
    }

    public function show($id)
    {
        $category = Ticket_Category::with('tickets.concert', 'owner')->findOrFail($id);
        return view('ticketCategories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Ticket_Category::findOrFail($id);
        $users = User::all();
        return view('ticketCategories.edit', compact('category', 'users'));
    }

    public function update(Request $request, $id)
    {
        $category = Ticket_Category::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'owner_id' => 'required|integer|exists:users,id',
            'price' => 'required|numeric|min:0',
        ]);
        $category->update($validated);
        return redirect()->route('categories.show', $category->id)->with('success', 'Ticket category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Ticket_Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Ticket category deleted successfully.');
    }
}
