<?php
namespace App\Http\Controllers;

use App\Models\JobPost;

class AdminController extends Controller
{
    public function adminPosts()
    {
        $pendingJobPosts = JobPost::where('status', 'pended')->get();
    
        return view('job_post.admin', compact('pendingJobPosts'));
    }

    public function approve($id)
    {
        $jobPost = JobPost::findOrFail($id);
        $jobPost->status = 'approved';
        $jobPost->save();

        return redirect()->route('admin.posts')->with('success', 'Job post approved successfully.');
    }

    public function cancel($id)
    {
        $jobPost = JobPost::findOrFail($id);
        $jobPost->status = 'canceled';
        $jobPost->save();

        return redirect()->route('admin.posts')->with('success', 'Job post canceled successfully.');
    }
}
