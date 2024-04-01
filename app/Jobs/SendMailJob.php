<?php

namespace App\Jobs;

use App\Mail\sendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $phone;
    protected $address;
    protected $attachmentPath;
    protected $mails;

    public function __construct($name, $phone, $address, $attachmentPath = null, $mails)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->attachmentPath = $attachmentPath;
        $this->mails = $mails;
    }

    public function handle()
    {
        $mail = new sendMail($this->name, $this->phone, $this->address, $this->attachmentPath);
        
        // Send the email to multiple recipients
        Mail::to($this->mails)->send($mail);
    }
}
