<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AbsenceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $class;

    private $recordingUser;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $class, $recordingUser)
    {
        $this->user = $user;
        $this->class = $class;
        $this->recordingUser = $recordingUser;
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

        $mail->subject(__('teacher.absenceRecorded'))
            ->line(__('teacher.absenceRecordedLine', ['name' => $this->user->name]))
            ->line(__('teacher.subject').': '.$this->class->Course->Subject->name)
            ->line(__('teacher.course').': '.$this->class->Course->course_id)
            ->line(__('general.startTime').': '.$this->class->start_time)
            ->line(__('general.endTime').': '.$this->class->end_time)
            ->line(__('teacher.recordedBy', ['name' => $this->recordingUser->name]));

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
