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
        $subject = sprintf('%s: Entry %s in %s', config('app.name'), ucfirst($this->data['action']), $this->data['model_name']);
        $greeting = 'Hello,';
        $infoLine = sprintf('We would like to inform you that an entry has been %s in %s.', $this->data['action'], $this->data['model_name']);
        $newValues = "New Values:";
        $oldValues = "Old Values:";
        $changeBlock = "```" . PHP_EOL . $this->data['change'] . PHP_EOL . "```";
        $originalBlock = "```" . PHP_EOL . $this->data['original'] . PHP_EOL . "```";
        $vendorNameLine = isset($this->data['vendor']) ? 'Vendor: ' . $this->data['vendor'] : ''; // Add vendor if it exists
        $UserNameLine = isset($this->data['changed_by']) ? 'User: ' . $this->data['changed_by'] : ''; // Add user if it exists
        $thankYouLine = 'Thank you';
        $teamLine = config('app.name') . ' Team';
        $websiteLine = 'www.mdvendorlist.com';

        return (new MailMessage())
            ->subject($subject)
            ->greeting($greeting)
            ->line($infoLine)
            ->line($newValues)
            ->line($changeBlock)
            ->line($oldValues)
            ->line($originalBlock)
            ->line($vendorNameLine) // Include the vendor name line
            ->line($UserNameLine) // Include the User name line
            ->line($thankYouLine)
            ->line($teamLine)
            ->line($websiteLine)
            ->salutation(' ');
    }

}
