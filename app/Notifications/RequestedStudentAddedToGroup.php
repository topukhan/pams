<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestedStudentAddedToGroup extends Notification
{
    use Queueable;
    protected $requested_student_id;
    protected $group_member_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($requested_student_id, $group_member_id = false)
    {
        $this->requested_student_id = $requested_student_id;
        $this->group_member_id = $group_member_id;
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
            'requested_student_id' => $this->requested_student_id,
            'group_member_id' => $this->group_member_id,
        ];
    }
}
