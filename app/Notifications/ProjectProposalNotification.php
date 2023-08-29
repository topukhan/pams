<?php

namespace App\Notifications;

use App\Models\ProjectProposal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectProposalNotification extends Notification
{
    use Queueable;
    protected $group_id;
    protected $proposal_id;
    protected $proposal;
    protected $supervisor_name;
    protected $feedback;
    protected $proposed_by;
    

    /**
     * Create a new notification instance.
     */
    public function __construct($group_id, ProjectProposal $proposal)
    {
        
        $this->group_id = $group_id;
        $this->proposal_id = $proposal->id;
        $this->proposal = $proposal;
        $supervisor = User::where('id', $proposal->supervisor_id)->first();
        $this->supervisor_name = $supervisor->first_name. ' '. $supervisor->last_name;
        $this->feedback = $proposal->supervisor_feedback;
        $student = User::where('id', $proposal->created_by)->first();
        $this->proposed_by = $student->first_name. ' '. $student->last_name;

        
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
            'group_id' => $this->group_id,
            'proposal_id' => $this->proposal_id,
            'title' => $this->proposal->title,
            'supervisor_name' => $this->supervisor_name,
            'feedback' => $this->feedback,
            'proposed_by' =>  $this->proposed_by,

        ];
    }
}
