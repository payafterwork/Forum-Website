<?php

namespace App\Notifications;
use App\Question;
use App\Answer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionWasUpdated extends Notification
{
    use Queueable;
      
     protected $question;
     protected $answer; 
    /**
     * Create a new notification instance.
     *@param $question
     *@param $answer
     * 
     */
    public function __construct($question, $answer)
    {
        $this->question = $question;
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
            'message'=>'Temporary placeholder'
        ];
    }
}
