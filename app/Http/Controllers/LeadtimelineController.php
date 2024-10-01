<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Leadtimeline;
use Illuminate\Http\Request;

class LeadtimelineController extends Controller
{
    /**
 * Display a listing of the leads.
 */
public function index()
{
    // Fetch all leads from the database
    $leadstimeline = Leadtimeline::all();
    
    // Return the leads view and pass the leads data
    return view('LeadTimeline.leadtimeline', compact('leadstimeline'));
}

/**
 * Show the form for creating a new lead.
 */
public function create()
{
    // Return the form to create a new lead
    return view('leadtimeline.create');
}

/**
 * Store a newly created lead in the database.
 */
public function store(Request $request)
{
    // Validate incoming request data
    $request->validate([

        'lead_id' => 'required',
        'title' => 'required',
        'status' => 'required',
        'message' => 'required',
        'note' => 'nullable',
        'badge_color' => 'required|string',
        'message_color' => 'nullable|date',
    ]);

    // Create a new lead using mass assignment
    Leadtimeline::create($request->all());

    // Redirect to the index with success message
    return redirect()->route('leadtimeline.index')->with('success', 'Lead Timeline created successfully!');
}

/**
 * Display the specified lead.
 */
// public function show($id)
// {
//     // Find the lead by its ID
//     $lead = Lead::findOrFail($id);

//     // Return a view to show a single lead
//     return view('lead.show', compact('lead'));
// }

/**
 * Show the form for editing the specified lead.
 */
public function edit($id)
{
    // Find the lead by its ID
    $leadstimeline = Leadtimeline::findOrFail($id);

    // Return the edit view and pass the lead data
    return view('leadtimeline.edit', compact('leadstimeline'));
}

/**
 * Update the specified lead in the database.
 */
public function update(Request $request, $id)
{
    // Validate incoming request data
    $request->validate([
        'lead_id' => 'required',
        'title' => 'required',
        'status' => 'required',
        'message' => 'required',
        'note' => 'nullable',
        'badge_color' => 'required|string',
        'message_color' => 'nullable|date',
    ]);

    // Find the lead and update its data
    $leadstimeline = Leadtimeline::findOrFail($id);
    $leadstimeline->update($request->all());

    // Redirect to the index with success message
    return redirect()->route('leadtimeline.index')->with('success', 'Lead Timeline updated successfully!');
}

/**
 * Remove the specified lead from the database.
 */
public function destroy($id)
{
    // Find the lead by its ID and delete it
    $leadstimeline = Leadtimeline::findOrFail($id);
    $leadstimeline->delete();

    // Redirect to the index with success message
    return redirect()->route('leadtimeline.index')->with('success', 'Lead Timeline deleted successfully!');
}
}
