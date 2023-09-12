<?php

namespace App\Notifications;

use App\Models\OldTitle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupervisorReallocationNotification extends Notification
{
    use Queueable;
    protected $title;

    /**
     * Create a new notification instance.
     */
    public function __construct(OldTitle $old_title)
    {
        $this->title = $old_title->old_title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'message' => "
            We wanted to inform you that the project previously under your supervision has been reallocated to a new supervisor based on the student's request. The student(s) felt the need for a change in project direction or supervision, and after due consideration, the coordinator has approved this change.<br><br>
            
            We appreciate your involvement in the project up to this point and your valuable contributions. While this project has moved to a new supervisor, we hope to continue working with you on future projects.<br><br>
            
            Thank you for your understanding and cooperation."
        ];
    }
}
