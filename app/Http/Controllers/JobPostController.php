<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\JobPostValidate;
use App\Http\Requests\UpdateJobPostValidate;
use App\Models\JobPost;

class JobPostController extends Controller
{// app/Http/Controllers/EmployerController.php

public function index() {

    $posts = JobPost::all();

  
    return view('job_post.view_post', ['posts' => $posts]);
}

    
public function show(JobPost $jobPost)
{
    return view('job_post.view_post', ['jobPost'=>$jobPost]);
    
}
    
    

    public function create()
    {
        return view('job_post.add_job_post'); 
    }

    public function store(JobPostValidate $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
        $my_path = '';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $my_path = $image->store('uploads/posts', 'public');
        }

        $validatedData['image'] = $my_path;
        JobPost::create($validatedData);

        return redirect()->route('job_posts.index')->with('success', 'Job post created successfully.');
    }

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

        if ($request->hasFile('image')) {
            if ($jobPost->image) {
                Storage::disk('public')->delete($jobPost->image);
            }
            
            $image = $request->file('image');
            $my_path = $image->store('uploads/posts', 'public');
            $validatedData['image'] = $my_path;
        }
    
        $jobPost->update($validatedData);
        
        return redirect()->route('job_posts.index')->with('success', 'Job post updated successfully.');
    }

}