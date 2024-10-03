<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class TherapistApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $therapist;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $therapist)
    {
        $this->therapist = $therapist;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.therapist_approval')
                    ->with('therapist', $this->therapist);
    }
}
