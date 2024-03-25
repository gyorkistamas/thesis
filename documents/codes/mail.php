$mail = new MailMessage();

$mail->subject(__('teacher.absenceRecorded'))
    ->line(__('teacher.absenceRecordedLine', ['name' => $this->user->name]))
    ->line(__('teacher.subject').': '.$this->class->Course->Subject->name)
    ->line(__('teacher.course').': '.$this->class->Course->course_id)
    ->line(__('general.startTime').': '.$this->class->start_time)
    ->line(__('general.endTime').': '.$this->class->end_time)
    ->line(__('teacher.recordedBy', ['name' => $this->recordingUser->name]));

return $mail;