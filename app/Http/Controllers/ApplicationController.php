<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\JobPost;


class ApplicationController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->cannot('viewAny',Application::class)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 
        $applications = Application::where('status', '!=', 'cancelled')->paginate(5);
        return view('application.index', compact('applications'));
        
    }
    
    public function getMyApplications(User $user)
    {
        if (Auth::user()->cannot('viewMyPostsApplications', $user)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 

        $applications = Application::where('status', '!=', 'cancelled' )->where('user_id', $user->id)->paginate(6);
        return view('application.index', compact('applications'));
        
    }
    public function createApplication($job_id)
    {
        $user = Auth::user();
        $resumes = Resume::where('user_id', $user->id)->get();
        $jobPost = JobPost::findOrFail($job_id);
        if (Application::where('user_id' , Auth::id())->where('job_id' , $job_id)->exists()) {
            
            $application = Application::where('user_id' , Auth::id())->where('job_id' , $job_id)->first();
            return redirect()->route('applications.edit' , $application->id)->with('error', 'you are already applied in this job you can not apply again but you can update the previous application.');
        } 


        return view('application.add_application', compact('resumes', 'user', 'job_id'));
    }

    public function store(StoreApplicationRequest $request)
    {
        $validatedData = $request->validated();

        // $jobPost = JobPost::findOrFail($validatedData['job_id']);

        // if (Auth::user()->cannot('create',$jobPost)) {
            
        //     $application = Application::where('user_id' , Auth::id())->first();
        //     // dd($application);
        //     return redirect()->route('applications.edit' , $application->id)->with('error', 'sorry but you do not have the privilage to do this operation.');
        // } 

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['status'] = 'pending'; 

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

        $application->update($validatedData);
        return redirect()->route('applications.index')->with('success', 'Application updated successfully.');
    }

    public function show(Application $application)
    {
        if (Auth::user()->cannot('view', $application)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the right to do this operation.');
        }
        $resume = Resume::findOrFail($application->resume_id);
 
        return view('application.view_application',['application'=> $application , 'resume'=> $resume] );
    }

    public function updateStatus(Request $request, Application $application)
    {

        if (Auth::user()->cannot('approveOrCancel', $application)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the right to do this operation.');
        }

        $validatedData = $request->validate([
            'status' => 'required|in:pending,approved,cancelled',
        ]);
        $application->status=$validatedData['status'];
        $application->save();
        $application->update($validatedData);

        return redirect()->route('applications.index')->with('success', 'Application status updated successfully.');
    }

    public function destroy(Application $application){
        if (Auth::user()->cannot('delete', $application)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the right to do this operation.');

        } 
        $application->delete();
        return back()->with('success', 'application deleted successfully Deleted successfully!');

    }

    
    public function cancel(Application $application){


 if (Auth::user()->cannot('approveOrCancel', $application)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the right to do this operation.');

        } 
        $application->status='cancelled';
        $application->save();

        return back()->with('success', 'application Cancelled successfully !');

    }
}
