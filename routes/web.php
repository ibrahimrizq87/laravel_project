<?php
use \App\Http\Controllers\JobPostController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ApplicationController;
use \App\Http\Controllers\PDFResumeController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{key}/{criteria}', [App\Http\Controllers\HomeController::class, 'search'])->name('home.search');

Route::get('/resume/{resume}', [PDFResumeController::class, 'viewResumePDF'])->name('resume.view');
Route::get('/resume/download/{resume}', [PDFResumeController::class, 'downloadResumePDF'])->name('resume.download');
Route::get('/resume/delete/{resume}', [PDFResumeController::class, 'deleteResume'])->name('resume.delete');


Route::resource('users', UserController::class);
Route::resource('job_posts', JobPostController::class);
Route::resource('applications', ApplicationController::class);


use App\Http\Controllers\AdminController;
Route::get('/admin/posts', [AdminController::class, 'adminPosts'])->name('admin.posts');

Route::patch('/job_posts/{id}/approve', [AdminController::class, 'approve'])->name('job_posts.approve');
Route::patch('/job_posts/{id}/cancel', [AdminController::class, 'cancel'])->name('job_posts.cancel');





// / ............................................................................................................................................... 
// GET|HEAD        api/user ........................................................................................................................................ 
// GET|HEAD        applications ................................................................................... applications.index › ApplicationController@index
// POST            applications ................................................................................... applications.store › ApplicationController@store
// GET|HEAD        applications/create .......................................................................... applications.create › ApplicationController@create
// GET|HEAD        applications/{application} ....................................................................... applications.show › ApplicationController@show
// PUT|PATCH       applications/{application} ................................................................... applications.update › ApplicationController@update
// DELETE          applications/{application} ................................................................. applications.destroy › ApplicationController@destroy
// GET|HEAD        applications/{application}/edit .................................................................. applications.edit › ApplicationController@edit
// GET|HEAD        home ................................................................................................................ home › HomeController@index
// GET|HEAD        job_posts ............................................................................................. job_posts.index › JopPostController@index
// POST            job_posts ............................................................................................. job_posts.store › JopPostController@store
// GET|HEAD        job_posts/create .................................................................................... job_posts.create › JopPostController@create
// GET|HEAD        job_posts/{job_post} .................................................................................... job_posts.show › JopPostController@show
// PUT|PATCH       job_posts/{job_post} ................................................................................ job_posts.update › JopPostController@update
// DELETE          job_posts/{job_post} .............................................................................. job_posts.destroy › JopPostController@destroy
// GET|HEAD        job_posts/{job_post}/edit ............................................................................... job_posts.edit › JopPostController@edit
// GET|HEAD        login ................................................................................................ login › Auth\LoginController@showLoginForm
// POST            login ................................................................................................................ Auth\LoginController@login
// POST            logout ..................................................................................................... logout › Auth\LoginController@logout
// GET|HEAD        password/confirm .............................................................. password.confirm › Auth\ConfirmPasswordController@showConfirmForm
// POST            password/confirm ......................................................................................... Auth\ConfirmPasswordController@confirm
// POST            password/email ................................................................ password.email › Auth\ForgotPasswordController@sendResetLinkEmail
// GET|HEAD        password/reset ............................................................. password.request › Auth\ForgotPasswordController@showLinkRequestForm
// POST            password/reset ............................................................................. password.update › Auth\ResetPasswordController@reset
// GET|HEAD        password/reset/{token} .............................................................. password.reset › Auth\ResetPasswordController@showResetForm
// GET|HEAD        register ................................................................................ register › Auth\RegisterController@showRegistrationForm
// POST            register ....................................................................................................... Auth\RegisterController@register
// GET|HEAD        sanctum/csrf-cookie ........................................................... sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show
// GET|HEAD        up .............................................................................................................................................. 
// GET|HEAD        users ........................................................................................................ users.index › UserController@index
// POST            users ........................................................................................................ users.store › UserController@store
// GET|HEAD        users/create ............................................................................................... users.create › UserController@create
// GET|HEAD        users/{user} ................................................................................................... users.show › UserController@show
// PUT|PATCH       users/{user} ............................................................................................... users.update › UserController@update
// DELETE          users/{user} ............................................................................................. users.destroy › UserController@destroy
// GET|HEAD        users/{user}/edit .............................................................................................. users.edit › UserController@edit
