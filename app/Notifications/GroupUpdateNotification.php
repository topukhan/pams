<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class GroupUpdateNotification extends Notification
{
    use Queueable;
    protected $added;
    protected $merged;
    protected $requester;
    protected $receiver;

    /**
     * Create a new notification instance.
     */
    public function __construct($added = false, $merged = false, $requester = false, $receiver = false )
    {
        $this->added = $added;
        $this->merged = $merged;
        $this->requester = $requester;
        $this->receiver = $receiver;
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
            'added' =>  $this->added,
            'merged' =>  $this->merged,
            'requester' => $this->requester,
            'receiver' => $this->receiver,

        ];
    }

}
