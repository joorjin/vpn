<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class infoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($emailData)
    {
        $this->emailData=$emailData;
    }

    public function build()
    {

        return $this->view('mail')->to($this->emailData[0])->from('info@timovpn.com')->subject('Confirmation email')->with([
            'code' => $this->emailData[1],
        ]);
    }
}
