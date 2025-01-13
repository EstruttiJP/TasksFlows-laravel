<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        $this->details['task_launch_date'] = Carbon::parse($this->details['task_launch_date'])->format('d/m/Y');
        $this->details['task_deadline'] = Carbon::parse($this->details['task_deadline'])->format('d/m/Y');
        return $this->subject('Task Update: ' . $this->details['task_name'])
            ->markdown('emails.taskupdate');
    }
}
