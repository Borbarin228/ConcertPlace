<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5); // по умолчанию 5
        $comments = Comment::with('user')->paginate($perPage)->appends(['per_page' => $perPage]);
        return view('comments.index', compact('comments', 'perPage'));
    }

    public function show($id)
    {
        $comment = Comment::with('user')->findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    public function create()
    {
        $users = User::all();
        return view('comments.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'number' => 'required|integer|min:1|unique:comment,number',
            'text' => 'required|string|max:1000',
        ]);
        Comment::create($validated);
        return redirect()->route('comments.index')->with('success', 'Comment created successfully.');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $users = User::all();
        return view('comments.edit', compact('comment', 'users'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'number' => 'required|integer|min:1|unique:comment,number,' . $id,
            'text' => 'required|string|max:1000',
        ]);
        $comment->update($validated);
        return redirect()->route('comments.show', $comment->id)->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.');
    }
}
