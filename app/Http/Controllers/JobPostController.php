<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JobPostValidate;
use App\Http\Requests\UpdateJobPostValidate;
use App\Models\JobPost;
class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobPosts = JobPost::all();
        
        return view('job_post.view_post', compact('jobPosts'));
    }
    

    public function create()
    {
        return view('job_post.add_job_post'); 
    }
    /**
     * Store a newly created resource in storage.
     */
    
     public function store(JobPostValidate $request)
     {
         $validatedData = $request->validated();
         $validatedData['user_id'] = auth()->id();
         JobPost::create($validatedData);
         return redirect()->route('job_posts.index')->with('success', 'Job post created successfully.');
     }
     
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($id)
    {
        $job_post = JobPost::findOrFail($id);
        return view('job_post.update_job_post', compact('job_post')); 
    }
    
    public function update(UpdateJobPostValidate $request, $id)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
        
        $jobPost = JobPost::findOrFail($id);
        $jobPost->update($validatedData);
        
        return redirect()->route('job_posts.index')->with('success', 'Job post updated successfully.');
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
