<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Resume;
use App\Models\Candidate;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {


    $validator = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'string', 'in:employer,candidate'],
        'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        'gender' => ['required', 'string', 'in:male,female'],
        'birthdate' => ['required', 'date', 'before:today'],
    ]);

    $validator->sometimes('skills', 'required|string|max:255', function($input) {
        return $input->role === 'candidate';
    });

    $validator->sometimes('employed', 'required|string|in:employed,unemployed,student', function($input) {
        return $input->role === 'candidate';
    });

    $validator->sometimes('company', 'required|string|max:255', function($input) {
        return $input->role === 'candidate' && $input->employed === 'employed';
    });

    $validator->sometimes('job_description', 'required|string|max:255', function($input) {
        return $input->role === 'candidate' && $input->employed === 'employed';
    });

    $validator->sometimes('cv', 'required|file|mimes:pdf,doc,docx|max:2048', function($input) {
        return $input->role === 'candidate';
    });

    $validator->sometimes('phone', 'required|string|max:15', function($input) {
        return $input->role === 'candidate';
    });

    return $validator;


}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $my_path = '';

        if(isset($data['image'])){

            $image = $data["image"];
            $my_path=$image->store('users','uploaded_files');

        }
        $cv_path = '';

        if(isset($data['cv'])){

            $cv = $data["cv"];
            $cv_path=$cv->store('CVs','uploaded_files');

        }
       


      



         $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'image' => $my_path,
            'gender' => $data['gender'],
            'birthdate' => $data['birthdate'],
        ]);
// dd($user);
// dd($user->id);

        if ( $cv_path != ''){
            Resume::create([
              'user_id' =>   $user->id,
              'resume' =>   $cv_path ,
            ]);
        }
        
        if ($user->role =='candidate'){
            Candidate::create([
                'user_id' =>   $user->id,
                'skills'=> $data['skills']
                , 'employed'=>$data['employed']
                ,'company'=>$data['company']
                ,'job_description'=>$data['job_description']
                ,'phone'=>$data['phone']
            ]);
        }

        return $user ;
    }
}
