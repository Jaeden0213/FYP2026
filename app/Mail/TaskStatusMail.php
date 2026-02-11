<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TaskStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Task $task,
        public string $subjectText,
        public string $bodyText
    ) {}

    public function build()
    {
        return $this->subject($this->subjectText)
            ->view('emails.taskStatus')
            ->with([
                'task' => $this->task,
                'bodyText' => $this->bodyText,
                'subjectText' => $this->subjectText,
            ]);
    }
}
