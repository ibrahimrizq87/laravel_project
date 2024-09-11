<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin'|| $user->role === 'employer' ;

    }

    public function viewMyPostsApplications(User $user ,User $model ): bool
    {
        return $user->id === $model->id ;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Application $application): bool
    {
        return $user->id === $application->user_id || $user->role === 'admin'|| $user->id === $application->jobPost->user_id ;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,JobPost $jobPost): bool
    {

    //     here is an application create policy function and i want to tell it to allow adding only if the user have not made an application on this post befor  public function create(User $user,JobPost $jobPost): bool
    // {
    //     return 
    // }
        $can =true;
        dd($jobPost->applications);
        foreach($jobPost->applications as $application ){
            if ($application->user_id == $user->id){
                $can =false;
            }
        }
        return $can;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Application $application): bool
    {
        return $user->id === $application->user_id || $user->role === 'admin';

    }

    public function approveOrCancel(User $user, Application $application): bool
    {
        return $user->id === $application->jobPost->user_id ;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Application $application): bool
    {
        return $user->id === $application->user_id || $user->role === 'admin'||
        ($user->id === $application->jobPost->user_id );

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Application $application): bool
    {

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Application $application): bool
    {
        return  $user->role === 'admin';

    }
}
