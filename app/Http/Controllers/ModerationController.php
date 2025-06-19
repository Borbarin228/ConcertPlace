<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModerationController extends Controller
{
    public function index()
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            abort(403, 'Доступ запрещён');
        }
        return view('moderation.index');
    }

    public function concerts()
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            abort(403, 'Доступ запрещён');
        }
        $concerts = \App\Models\Concert::orderByDesc('created_at')->get();
        return view('moderation.concerts', compact('concerts'));
    }

    public function showConcert($id)
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            abort(403, 'Доступ запрещён');
        }
        $concert = \App\Models\Concert::with(['user', 'ticketCategories'])->findOrFail($id);
        return view('moderation.concert_show', compact('concert'));
    }

    public function acceptConcert($id)
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            abort(403, 'Доступ запрещён');
        }
        $concert = \App\Models\Concert::findOrFail($id);
        $concert->is_accepted = true;
        $concert->save();
        return redirect()->route('moderation.concerts')->with('success', 'Концерт подтверждён!');
    }
} 