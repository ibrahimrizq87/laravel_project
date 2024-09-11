<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\JobPost;
use App\Models\Comment;
use App\Models\User;
use App\Models\Application;
use App\Policies\JobPostPolicy;
use App\Policies\CommentPolicy;
use App\Policies\UserPolicy;
use App\Policies\ApplicationPolicy;

use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::policy(JobPost::class, JobPostPolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Application::class, ApplicationPolicy::class);



    }
}
