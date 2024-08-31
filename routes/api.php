<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Api\JobPostController;
use \App\Http\Controllers\Api\UserController;
use \App\Http\Controllers\Api\ApplicationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiresource('job_posts', JobPostController::class);
Route::apiresource('applications', ApplicationController::class);
Route::apiresource('users', UserController::class);


// / .......................................................................................................... 
// GET|HEAD        api/applications ...................................... applications.index › Api\ApplicationController@index
// POST            api/applications ...................................... applications.store › Api\ApplicationController@store
// GET|HEAD        api/applications/{application} .......................... applications.show › Api\ApplicationController@show
// PUT|PATCH       api/applications/{application} ...................... applications.update › Api\ApplicationController@update
// DELETE          api/applications/{application} .................... applications.destroy › Api\ApplicationController@destroy
// GET|HEAD        api/job_posts ................................................ job_posts.index › Api\JobPostController@index
// POST            api/job_posts ................................................ job_posts.store › Api\JobPostController@store
// GET|HEAD        api/job_posts/{job_post} ....................................... job_posts.show › Api\JobPostController@show
// PUT|PATCH       api/job_posts/{job_post} ................................... job_posts.update › Api\JobPostController@update
// DELETE          api/job_posts/{job_post} ................................. job_posts.destroy › Api\JobPostController@destroy
// GET|HEAD        api/user ................................................................................................... 
// GET|HEAD        api/users ........................................................... users.index › Api\UserController@index
// POST            api/users ........................................................... users.store › Api\UserController@store
// GET|HEAD        api/users/{user} ...................................................... users.show › Api\UserController@show
// PUT|PATCH       api/users/{user} .................................................. users.update › Api\UserController@update
// DELETE          api/users/{user} ................................................ users.destroy › Api\UserController@destroy