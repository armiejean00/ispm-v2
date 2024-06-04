<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IssueReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $issue;
    public $details;
    public $photoPath;
    public $username;
    public $role;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($issue, $details, $photoPath,$username,$role)
    {
        $this->issue = $issue;
        $this->details = $details;
        $this->photoPath = $photoPath;
         $this->username = $username;
        $this->role = $role;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject('New Hot Desking Issue Report')
                      ->view('emails.issue_report')
                      ->with([
                          'issue' => $this->issue,
                          'details' => $this->details,
                          'username' => $this->username,
                          'role' => $this->role,
                      ]);

        if ($this->photoPath) {
            $email->attach(storage_path('app/' . $this->photoPath));
        }

        return $email;
    }
}