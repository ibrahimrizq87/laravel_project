<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\JobPostValidate;
use App\Http\Requests\UpdateJobPostValidate;
use App\Models\JobPost;



class JobPostController extends Controller
{ // app/Http/Controllers/EmployerController.php


    function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {

       
        if (Auth::user()->cannot('approveOrReject',JobPost::class)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 


    $user = Auth::User();

    $jobPosts = JobPost::where('status', '!=', 'approved')->paginate(6);
    // $jobPosts = JobPost::all();
    return view('job_post.approve_post' , ['jobPosts'=> $jobPosts ,'user'=>$user]);
  
    // return view('job_post.approve_post', ['posts' => $posts]);
}

    
public function show(JobPost $jobPost)
{
    $user = Auth::User();
    return view('job_post.view_post', ['jobPost'=>$jobPost , 'user'=> $user ]);
    
}
    
    

    public function create()
    {
        if (Auth::user()->cannot('create',JobPost::class)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 
        return view('job_post.add_job_post');
    }

    public function store(JobPostValidate $request)
    {
        if (Auth::user()->cannot('create',JobPost::class)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        $my_path = '';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $my_path = $image->store('posts', 'uploaded_files');
        }

        $validatedData['image'] = $my_path;
        JobPost::create($validatedData);

        return redirect()->route('home')->with('success', 'Job post created successfully.');
    }

    public function edit($id)
    {
        $job_post = JobPost::findOrFail($id);

        if (Auth::user()->cannot('update', $job_post)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the right to do this operation.');

        } 
        return view('job_post.update_job_post', compact('job_post'));
    }

    public function update(UpdateJobPostValidate $request, $id)
    {
        $jobPost = JobPost::findOrFail($id);

        if (Auth::user()->cannot('update', $job_post)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the right to do this operation.');

        } 
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();


        if ($request->hasFile('image')) {
            if ($jobPost->image) {
                Storage::disk('public')->delete($jobPost->image);
            }

            $image = $request->file('image');
            $my_path = $image->store('uploads/posts', 'public');
            $validatedData['image'] = $my_path;
        }

        $jobPost->update($validatedData);

        return redirect()->route('home')->with('success', 'Job post updated successfully.');
    }



    public function destroy(JobPost $jobPost){
        if (Auth::user()->cannot('delete', $job_post)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the right to do this operation.');

        } 
        $jobPost->delete();
        return redirect()->route('home')->with('success', 'job post deleted successfully Deleted successfully!');

    }
}