<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resume;
use App\Models\Candidate;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\storeUserRequest;

use Illuminate\Http\Request;

class UserController extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        
    }

    public function store(storeUserRequest $request)
    {
        if (Auth::user()->cannot('create',User::class)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 
        $validatedData = $request->validated();
$user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->gender = $validatedData['gender'];
        $user->birthdate = $validatedData['birthdate'];
        $user->password = Hash::make($validatedData['password']);
        
            $imagePath = '';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'uploaded_files');
        }
        $user->image =$imagePath ;




        $user->save();

        return redirect()->route('home')->with('success', 'Admin User added Successfully.');

    }

    /**
     * Display the specified resource.
     */

    public function show(User $user)
    
{
    if (Auth::user()->cannot('view',$user)) {
        return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
    } 

    $applications = $user->applications()->with('jobPost')->paginate(5);

    return view('profile', compact('user', 'applications'));

}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (Auth::user()->cannot('update',$user)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 

        return view('edit_user', ['user'=>$user]);

    }


    public function addAdmin()
    {
        if (Auth::user()->cannot('create',User::class)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 
        return view('add_admin');

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (Auth::user()->cannot('update',$user)) {
            return redirect()->route('home')->with('error', 'sorry but you do not have the privilage to do this operation.');
        } 
        try {
        $validatedData = $request->validated();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        $user->birthdate = $validatedData['birthdate'];

        $imagePath = $user->image;


        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            // dd($user->image);
            $imagePath = $request->file('image')->store('users', 'uploaded_files');

        }
        $user->image =$imagePath ;

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
