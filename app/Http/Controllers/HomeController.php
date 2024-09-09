<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\JobPost;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::User();
        if ($user->role == "admin"){
            // $jobPosts = JobPost::where('status', 'approved')->get();
            $jobPosts = JobPost::all();
        }
        elseif ($user->role== "employer" ){
            $jobPosts = JobPost::where('user_id', $user->id)->get();
        }
        else {
            $jobPosts = JobPost::where('status', 'approved')->get();
            // $jobPosts = JobPost::all();

        }

        $jobPosts = JobPost::all();
            // $jobPosts = JobPost::where('user_id', $user->id)->get();
        
        // dd($jobPosts);
        // return view('home' , ['user'=> $user ]);
        
        return view('home' , ['jobPosts'=> $jobPosts ,'user'=>$user]);
    }

    public function search(Request $request) 
    {
        // dd($request);
        $user = Auth::User();

        $key = $request->input('key');
        $criteria = $request->input('criteria');
        
        $jobPosts = JobPost::where("{$criteria}", 'like', "{$key}")->get();
        // $jobPosts = JobPost::search($key)->get();

        // $jobPosts = JobPost::all();
        // dd($jobPosts);
        // echo $key;
        // echo $criteria;
        return view('home', ['jobPosts'=> $jobPosts ,'user'=>$user]);

        // return view('home' , ['jobPosts'=> $jobPosts ]);
        // return view('home' , ['user'=> $user ]);
        // return view('home');
    }
}
