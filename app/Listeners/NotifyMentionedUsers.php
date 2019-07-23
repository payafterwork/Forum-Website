<?php

namespace App\Listeners;

use App\Events\QuestionRecievedNewAnswer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMentionedUsers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QuestionRecievedNewAnswer  $event
     * @return void
     */
    public function handle(QuestionRecievedNewAnswer $event)
    {
        //
    }
}
