<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class TestReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data = [];
    public $url ;
    public function __construct($url)
    {
      $this->url = $url;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $sender= 'notifications@hodi.io';
        $name = 'HODI';
        $subject = 'Test Report';

        return $this->view('mails.mail_message')
            ->from($sender, $name)
            ->subject($subject)
            ->attach($this->url);
    }
}
