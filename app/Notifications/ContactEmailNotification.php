<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactEmailNotification extends Notification
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
            ->subject(config('app.name') . ':Contact Page Form entry by ' . $this->data->firstname )
            ->greeting('Hi,')
            ->line('Name: '.$this->data->firstname.' '.$this->data->lastname.'')
            ->line('Email:'.$this->data->email)
            ->line('Message: ' . $this->data->message)
            ->line('Thank you')
            ->line(config('app.name') . ' Team')
            ->salutation(' ');
    }
}
