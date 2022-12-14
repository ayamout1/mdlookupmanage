<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DataCreateEmailNotification extends Notification
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
            ->subject(config('app.name') . ': entry has been Created in ' . $this->data['model_name'])
            ->greeting('Hi,')
            ->line('we would like to inform you that entry has been ' . $this->data['action'] . '  in ' . $this->data['model_name'])
            ->line('Created '. $this->data['model_name'].' = '.$this->data['name'])
            ->line('Thank you')
            ->line(config('app.name') . ' Team')
            ->line('www.mdvendorlist.com')
            ->salutation(' ');
    }
}
