<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable{

    use Queueable, SerializesModels;
    public $details;


    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        if (isset($this->details['mailpage']) && $this->details['mailpage'] == 'UserMail'){
            return $this->subject($this->details['title'])
                ->view('emails._user_email_pass_mail_template');
        }
    }

}
