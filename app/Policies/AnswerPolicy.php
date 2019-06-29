<?php
namespace App\Policies;
use App\User;
use App\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;
class AnswerPolicy
{
    use HandlesAuthorization;
    
       /**
     * Determine whether the user can update the Answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $Answer
     * @return mixed
     */
    public function update(User $user, Answer $answer)
    {
        return $answer->user_id == $user->id;
    }

}