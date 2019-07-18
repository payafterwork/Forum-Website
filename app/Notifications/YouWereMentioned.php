<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class YouWereMentioned extends Notification
{
    use Queueable;

   protected $answer; 
    /**
     * Create a new notification instance.
     *@param $answer
     * 
     */
    public function __construct($answer)
    {
        $this->answer = $answer;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
             'message'=>$this->answer->owner->name. ' mentioned you in '.$this->answer->question->qtitle,
            'link'=>$this->answer->path()
        ];
    }
}
