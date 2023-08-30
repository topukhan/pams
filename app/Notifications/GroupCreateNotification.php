<?php

namespace App\Notifications;

use App\Models\GroupInvitation;
use App\Models\PendingGroup;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GroupCreateNotification extends Notification
{
    use Queueable;
    protected $request_from;
    protected $feedbacks;
    protected $status;

    public function __construct(PendingGroup $pending_group, GroupInvitation $invitation)
    {
        $student = User::where('id', $pending_group->created_by)->first();
        $this->request_from = $student->first_name . ' ' . $student->last_name;
        $this->feedbacks = $pending_group->member_feedback;
        $this->status = $invitation->staus;
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
            'request_from' =>  $this->request_from,
            'feedbacks' => $this->feedbacks,
            'status' => $this->status
        ];
    }
}
