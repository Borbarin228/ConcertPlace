<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket_Category;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index(){
        return view('ticketCategories', ['ticketCategories'=>Ticket_Category::all()]);
    }

    public function show($id)
    {
        $category = Ticket_Category::with('tickets')->findOrFail($id);
        return view('ticketCategories.show', compact('category'));
    }
}
