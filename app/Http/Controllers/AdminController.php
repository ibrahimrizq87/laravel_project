<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\JobPost;

class AdminController extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }



    public function adminPosts()
    {
      
        $pendingJobPosts = JobPost::where('status', 'pended')->get();
    
        return view('job_post.admin', compact('pendingJobPosts'));
    }

    public function approve($id)
    {
        if (Auth::user()->cannot('approveOrReject',JobPost::class)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 

        $jobPost = JobPost::findOrFail($id);
        $jobPost->status = 'approved';
        $jobPost->save();

        return redirect()->route('job_posts.index')->with('success', 'Job post approved successfully.');
        // return redirect()->route('admin.posts')->with('success', 'Job post approved successfully.');
    }

    public function cancel($id)
    {
        if (Auth::user()->cannot('approveOrReject',JobPost::class)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 
        $jobPost = JobPost::findOrFail($id);
        $jobPost->status = 'canceled';
        $jobPost->save();

        return redirect()->route('job_posts.index')->with('success', 'Job post canceled successfully.');
        // return redirect()->route('admin.posts')->with('success', 'Job post canceled successfully.');
    }
}
