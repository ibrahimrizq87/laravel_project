<?php

namespace App\Http\Controllers;

use App\Models\User;  
use App\Models\Resume;  
use App\Models\Candidate;  
use App\Http\Requests\UpdateUserRequest;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(User $user)
{
    $applications = $user->applications()->with('jobPost')->paginate(5);
        
    return view('profile', compact('user', 'applications'));
    
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) 
    {
        return view('edit_user', ['user'=>$user]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user) 
    {

        try {
        $validatedData = $request->validated();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->gender = $validatedData['gender'];
        $user->birthdate = $validatedData['birthdate'];
        $imagePath = $user->image;
        $user->role = $validatedData['role'] ?? 'admin' ;

    
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'uploaded_files');
            
        }

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('CVs', 'uploaded_files');
            if ( $cvPath != ''){
                Resume::create([
                  'user_id' =>   $user->id,
                  'resume' =>   $cvPath ,
                ]);
            }
            
        }

    
    
        if ($user->role === 'candidate') {
            $user->candidate()->update([
                'skills' => $validatedData['skills'],
                'employed' => $validatedData['employed'] ,
                'company' => $validatedData['company'] ?? '',
                'job_description' => $validatedData['job_description'] ?? '',
                'phone' => $validatedData['phone'] ,
            ]);
            
        } 

        $user->save();
    
        // return view('edit_user', ['user'=>$user])
        return to_route("users.edit" ,$user )->with('success', 'Profile updated successfully.');


    } catch (\Exception $e) {

        return redirect()->back()->with('error', 'An error occurred while updating the profile. Please try again.');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) 
    {
        //
    }
}
