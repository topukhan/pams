<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IndividualRequestToCoordinator extends Notification
{
    use Queueable;
    protected $user_id;
    protected $request_id;
    protected $student_name;

    /**
     * Create a new notification instance.
     */
    public function __construct($user_id, $request_id)
    {
        $student = User::where('id', $user_id)->first();
        $this->user_id = $user_id;
        $this->request_id = $request_id;
        $this->student_name = $student->first_name. ' '. $student->last_name;
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
            'user_id' => $this->user_id,
            'request_id' => $this->request_id,
            'student_name' => $this->student_name,
        ];
    }
}
