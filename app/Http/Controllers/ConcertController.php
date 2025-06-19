<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Concert;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5); // по умолчанию 5
        $concerts = Concert::where('is_accepted', true)->paginate($perPage)->appends(['per_page' => $perPage]);
        return view('concerts.index', compact('concerts', 'perPage'));
    }

    public function create()
    {
        $categories = \App\Models\Ticket_Category::all();
        return view('concerts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:30',
            'place' => 'required|string|max:30',
            'start_at' => 'required|date',
        ]);
        $concert = Concert::create($validated + [
            'is_accepted' => false,
            'user_id' => auth()->id(),
        ]);
        if ($request->has('categories')) {
            $attachData = [];
            foreach ($request->input('categories') as $catId) {
                $price = $request->input('prices')[$catId] ?? null;
                $attachData[$catId] = $price ? ['price' => $price] : [];
            }
            $concert->ticketCategories()->attach($attachData);
        }
        \Log::info('Создание концерта', [
            'auth_id' => auth()->id(),
            'user' => auth()->user(),
            'validated' => $validated
        ]);
        return redirect()->route('concerts.index')->with('success', 'Concert created successfully.');
    }

    public function show($id)
    {
        $concert = Concert::with('tickets.category')->findOrFail($id);
        return view('concerts.show', compact('concert'));
    }

    public function edit($id)
    {
        $concert = Concert::findOrFail($id);
        return view('concerts.edit', compact('concert'));
    }

    public function update(Request $request, $id)
    {
        $concert = Concert::findOrFail($id);
        $validated = $request->validate([
            'city' => 'required|string|max:30',
            'place' => 'required|string|max:30',
            'category_id' => 'nullable|integer',
            'start_at' => 'required|date',
            'is_accepted' => 'boolean',
        ]);
        $concert->update($validated);
        return redirect()->route('concerts.show', $concert->id)->with('success', 'Concert updated successfully.');
    }

    public function destroy($id)
    {
        $concert = Concert::findOrFail($id);
        $concert->delete();
        if (auth()->user() && auth()->user()->is_admin) {
            return redirect()->route('moderation.concerts')->with('success', 'Concert deleted successfully.');
        }
        return redirect()->route('concerts.index')->with('success', 'Concert deleted successfully.');
    }

    public function categories($id)
    {
        $concert = Concert::with('ticketCategories')->findOrFail($id);
        return view('concerts.categories', compact('concert'));
    }

    public function buy($id)
    {
        $concert = \App\Models\Concert::with(['user', 'ticketCategories'])->findOrFail($id);
        $comments = $concert->comments()->with('user')->orderBy('created_at', 'asc')->paginate(5);
        return view('concerts.buy', compact('concert', 'comments'));
    }

    public function buyComment(Request $request, $id)
    {
        $concert = \App\Models\Concert::findOrFail($id);
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
        \App\Models\Comment::create([
            'user_id' => auth()->id(),
            'concert_id' => $concert->id,
            'text' => $request->input('comment'),
        ]);
        return redirect()->route('concerts.buy', $concert->id);
    }

    public function buyTicket(Request $request, $id)
    {
        $concert = \App\Models\Concert::findOrFail($id);
        $request->validate([
            'category_id' => 'required|integer|exists:ticket_categories,id',
            'qty' => 'required|integer|min:1|max:10',
        ]);
        \App\Models\Ticket::create([
            'user_id' => auth()->id(),
            'concert_id' => $concert->id,
            'category_id' => $request->input('category_id'),
            'number' => $request->input('qty'),
        ]);
        return response()->json(['success' => true]);
    }
}
