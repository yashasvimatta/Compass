<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Display a listing of the tickets.
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    // Show the form for creating a new ticket.
    public function create()
    {
        return view('tickets.create');
    }

    // Store a newly created ticket in storage.
    public function store(Request $request)
    {
        Ticket::create($request->all());

        return redirect()->route('contactUs')->with('success', 'Ticket created successfully');
    }

    // Display the specified ticket.
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    // Show the form for editing the specified ticket.
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.edit', compact('ticket'));
    }

    // Update the specified ticket in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'user_name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'response' => 'nullable',
            'resolved' => 'nullable',
            'comment' => 'nullable',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully');
    }

    // Remove the specified ticket from storage.
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully');
    }
}
