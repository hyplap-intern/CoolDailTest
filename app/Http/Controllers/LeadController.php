<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller{
    public function index()
    {
        // Fetch all leads from the database
        $leads = Lead::all();
        
        // Return the leads view and pass the leads data
        return view('lead.lead', compact('leads'));
    }
    public function create()
    {
        // Return the form to create a new lead
        return view('lead.create');
    }
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'vendor_uid' => 'required',
            'cp_uid' => 'required',
            'assigned_to' => 'required',
            'status' => 'required|string',
            'next_followup_date' => 'nullable|date',
            'trx_uid' => 'nullable',
        ]);

        // Create a new lead using mass assignment
        Lead::create($request->all());

        // Redirect to the index with success message
        return redirect()->route('lead.index')->with('success', 'Lead created successfully!');
    }
    // public function show(Request $request)
    // {
    //     // Find the lead by its ID
    //     $lead = Lead::findOrFail($request->id);

    //     // Return a view to show a single lead
    //     return view('lead.show', compact('lead'));
    // }

    /**
     * Show the form for editing the specified lead.*/
     
    public function edit($id)
    {
        // Find the lead by its ID
        $lead = Lead::findOrFail($id);

        // Return the edit view and pass the lead data
        return view('lead.edit', compact('lead'));
    }
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'vendor_uid' => 'required',
            'cp_uid' => 'required',
            'assigned_to' => 'required',
            'status' => 'required|string',
            'next_followup_date' => 'nullable|date',
            'trx_uid' => 'nullable',
        ]);

        // Find the lead and update its data
        $lead = Lead::findOrFail($id);
        $lead->update($request->all());

        // Redirect to the index with success message
        return redirect()->route('lead.index')->with('success', 'Lead updated successfully!');
    }
    public function destroy($id)
    {
        // Find the lead by its ID and delete it
        $lead = Lead::findOrFail($id);
        $lead->delete();

        // Redirect to the index with success message
        return redirect()->route('lead.index')->with('success', 'Lead deleted successfully!');
    }
}

// A comment added after pushing on github

//changes made the second time