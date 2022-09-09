<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DataChangeEmailNotification extends Notification
{
    use Queueable;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return $this->getMessage();
    }

    public function getMessage()
    {
        return (new MailMessage())
            ->subject(config('app.name') . ': entry ' . $this->data['action'] . ' in ' . $this->data['model_name'])
            ->greeting('Hi,')
            ->line('we would like to inform you that entry has been ' . $this->data['action'] . '  in ' . $this->data['model_name'])
            ->line('New Value = '.$this->data['0']['name'])
            ->line('Old Value = '.$this->data['1']['name'])
            ->line('Thank you')
            ->line(config('app.name') . ' Team')
            ->salutation(' ');
    }
}
