<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::paginate(5);

        return view('application.index', compact('applications'));
    }

    public function createApplication($job_id)
    {
        $user = Auth::user();
        $resumes = Resume::where('user_id', $user->id)->get();

        return view('application.add_application', compact('resumes', 'user', 'job_id'));
    }

    public function store(StoreApplicationRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::user()->id;

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('CVs', 'uploaded_files');
            $resume = Resume::create([
                'user_id' => $validatedData['user_id'],
                'resume' => $resumePath,
            ]);
            $validatedData['resume_id'] = $resume->id;
        } elseif ($request->resume_option) {
            $validatedData['resume_id'] = $request->resume_option;
        }

        Application::create($validatedData);

        return redirect()->route('home')->with('success', 'Application added successfully.');
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

   

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('CVs', 'uploaded_files');

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

    public function show(Application $application)
    {

        $resume = Resume::findOrFail($application->resume_id);
 
        return view('application.view_application',['application'=> $application , 'resume'=> $resume] );
    }
}
