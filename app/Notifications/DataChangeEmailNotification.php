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
            ->line('New Values = '.$this->data['change'])
            ->line('Old Values = '.$this->data['original'])
            ->line('Vendor = '.$this->data['vendor'])
            ->line('Thank you')
            ->line(config('app.name') . ' Team')
            ->line('www.mdvendorlist.com')
            ->salutation(' ');
    }
}
