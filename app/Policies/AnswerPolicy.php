<?php

namespace App\Policies;

use App\User;
use App\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    
    /**
     * Determine whether the user can view any Answers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the Answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $Answer
     * @return mixed
     */
    public function view(User $user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can create Answers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the Answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $Answer
     * @return mixed
     */
    public function update(User $user, Answer $answer)
    {
        return $answer->user_id==$user->id;
    }

    /**
     * Determine whether the user can delete the Answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $Answer
     * @return mixed
     */
    public function delete(User $user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can restore the Answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $Answer
     * @return mixed
     */
    public function restore(User $user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the Answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $Answer
     * @return mixed
     */
    public function forceDelete(User $user, Answer $answer)
    {
        //
    }
}
