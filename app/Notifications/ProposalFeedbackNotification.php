<?php

namespace App\Notifications;

use App\Models\ProposalFeedback;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProposalFeedbackNotification extends Notification
{
    use Queueable;

    protected $user_id;
    protected $denied_by;
    

    public function __construct(ProposalFeedback $proposal_feedback)
    {
       
        $this->user_id = $proposal_feedback->denied_by;
        $user = User::where('id', $this->user_id)->first();
        $this->denied_by = $user->first_name. ' '. $user->last_name;
        
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
            'denied_by' => $this->denied_by
            
        ];
    }
}
