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
            $jobPosts = JobPost::where('status', 'approved')->paginate(5);
      
            
        }
        elseif ($user->role== "employer" ){
            $jobPosts = JobPost::where('user_id', $user->id)->paginate(5);
        }
        else {
            $jobPosts = JobPost::where('status', 'approved')->paginate(5);
      
        }


        return view('home' , ['jobPosts'=> $jobPosts ,'user'=>$user]);
    }

    public function search(Request $request) 
    {
        $user = Auth::User();

        $key = $request->input('key');
        $criteria = $request->input('criteria');
        
        $jobPosts = JobPost::where("{$criteria}", 'like', "%{$key}%")->paginate(5);
      
        return view('home', ['jobPosts'=> $jobPosts ,'user'=>$user]);
    }
}
