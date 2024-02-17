<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JustificationResponse extends Notification implements ShouldQueue
{
    use Queueable;

    public $student;

    public $justification;

    public $reply;

    /**
     * Create a new notification instance.
     */
    public function __construct($student, $justification, $reply)
    {
        $this->student = $student;
        $this->justification = $justification;
        $this->reply = $reply;
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
        $mail = new MailMessage();

        $mail->subject(__('teacher.justification').' '.($this->reply->status == 'accepted' ? __('student.accepted') : __('student.rejected')))
            ->line(__('teacher.dearJustificationStatus', [
                'name' => $this->justification->User->name,
                'status' => $this->reply->status == 'accepted' ? __('student.accepted') : __('student.rejected'),
            ]))
            ->line(__('teacher.modifier').': '.$this->reply->Teacher->name)
            ->line(__('teacher.justification').':')
            ->line(__('general.startTime').': '.$this->justification->start_date)
            ->line(__('general.endTime').': '.$this->justification->end_time);

        if ($this->reply->status == 'denied') {
            $mail->line(__('teacher.reason').': '.$this->reply->comment);
        }

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
