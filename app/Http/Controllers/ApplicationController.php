<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\UpdateApplicationRequest;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Resume;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function createApplication($job_id)
    {
        $user = Auth::user();
        $resumes = Resume::where('user_id', $user->id)->get();

        return view('application.add_application', compact('resumes', 'user', 'job_id'));
    }

    public function store(StoreApplicationRequest $request)
    {

        // $validated = $request->validate([
        //     'job_id' => 'required|integer|exists:job_posts,id',
        //     'email' => 'required|email|max:255',
        //     'phone_number' => 'required|string|max:255',
        //     'location' => 'required|string|max:255',
        //     'resume_option' => 'nullable|exists:resumes,id',
        //     'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        //     'additional_information' => 'nullable|string',

        // ]);

        // $validatedData  = request()->all();

// dd($validatedData);
$validatedData = $request->validated();

        $validatedData['user_id'] = Auth::user()->id;

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('CVs', 'public');
            $resume = Resume::create([
                'user_id' => $validatedData['user_id'],
                'resume' => $resumePath,
            ]);
            $validatedData['resume_id'] = $resume->id;
        } elseif ($request->resume_option) {
            $validatedData['resume_id'] = $request->resume_option;
        }

        Application::create($validatedData);

        return redirect()->route('applications.index')->with('success', 'Application added successfully.');
    }

    public function edit(Application $application)
    {
        $user = Auth::user();
        $resumes = Resume::where('user_id', $user->id)->get();
        return view('application.update_application', compact('application', 'resumes', 'user'));
    }

    public function update(UpdateApplicationRequest $request, Application $application)
    {
        $validatedData = $request->validated();
        // $validatedData  = request()->all();

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('CVs', 'public');

            $resume = Resume::create([
                'user_id' => $validatedData['user_id'],
                'resume' => $resumePath,
            ]);
            $validatedData['resume_id'] = $resume->id;
        } elseif ($request->resume_option) {
            $validatedData['resume_id'] = $request->resume_option;
        }

        $application->update($validatedData);
        return redirect()->route('home')->with('success', 'Application updated successfully.');
    }




}

