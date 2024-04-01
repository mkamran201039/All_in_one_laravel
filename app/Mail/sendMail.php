<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class sendMail extends Mailable
{
    use Queueable, SerializesModels;

  

    public $name='';
    public $phone='';
    public $address='';
    public $attachmentPath;



    public function __construct($name, $phone , $address, $attachmentPath = null)
    {   
        $this->name=$name;
        $this->phone=$phone;
        $this->address=$address;
        $this->attachmentPath = $attachmentPath;
       

        
    }


    public function build()
    {
        $mail = $this->subject("This is a test mail")->view('send');

    
        if ($this->attachmentPath) {
            $mail->attach($this->attachmentPath);
        }

        return $mail;
    }
   

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'This is a test mail',
        );
    }

    /**
     * Get the message content definition.
     */
  
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
