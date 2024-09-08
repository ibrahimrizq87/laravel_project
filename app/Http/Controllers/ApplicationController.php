<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::paginate(5);
        $applications = Application::all();
        return view('application.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('application.add_application');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'job_id' => 'required|exists:job_posts,id',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'location' => 'required|string|max:255',
            'additional_information' => 'nullable|string',
        ]);

        // Handle file upload
        $resumePath = $request->file('resume') ? $request->file('resume')->store('resumes') : null;

        Application::create([
            'date' => $request->input('date'),
            'user_id' => $request->input('user_id'),
            'job_id' => $request->input('job_id'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'resume' => $resumePath,
            'location' => $request->input('location'),
            'additional_information' => $request->input('additional_information'),
        ]);

        return redirect()->route('applications.index')->with('success', 'Application added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        return view('application.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        // Fetch resumes if needed
        $resumes = []; // Adjust according to your actual data source if necessary

        return view('application.update_application', compact('application', 'resumes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'additional_information' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        // Handle file upload if a new file is provided
        if ($request->hasFile('resume')) {
            // Delete the old file if it exists
            if ($application->resume) {
                Storage::delete($application->resume);
            }

            // Store the new file
            $validatedData['resume'] = $request->file('resume')->store('resumes');
        }

        $application->update($validatedData);

        return redirect()->route('applications.index')->with('success', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        // Delete the resume file from storage if it exists
        if ($application->resume) {
            Storage::delete($application->resume);
        }

        // Delete the application record from the database
        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Application deleted successfully.');
    }
}
