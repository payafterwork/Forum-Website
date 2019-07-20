<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Auth;
class UserPolicy
{
    use HandlesAuthorization;
 /**
     * Determine whether the user can update the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
     public function update(User $signedInUser, User $user)
    {
        return $signedInUser->id === $user->id;
    }
}