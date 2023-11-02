<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $user)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $this->user->email,
        ], false));
        $mail = new MailMessage();
        $mail->subject(__('general.newUserCreated'))
            ->line(__('general.accountCreated', ['name' => $this->user->name]))
            ->line(__('general.neptunCode').': '.$this->user->neptun)
            ->line(__('general.name').': '.$this->user->name)
            ->line(__('general.email').': '.$this->user->email)
            ->line(__('general.toLogin'))
            ->action(__('auth.changePassword'), $url);

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
