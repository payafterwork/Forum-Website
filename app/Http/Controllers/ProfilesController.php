<?php
namespace App\Http\Controllers;
use App\User;
use App\Question;
class ProfilesController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @param  User $user
     * @return \Response
     */
    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser' => $user,
            'questions' => $user->questions()->paginate(30)
        ]);
    }
}