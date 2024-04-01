<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;







class testController extends Controller
{
    public function send_mail_data(Request $request)
    {
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentName = $attachment->getClientOriginalName();
            $attachment->storeAs('attachments', $attachmentName);
            $attachmentPath = storage_path('app/attachments/' . $attachmentName);
        }

        $mails = [
            "kamran.job.cse@gmail.com",
            "mkamran201039@bscse.uiu.ac.bd" 
        ];

        // Dispatch the SendMailJob with parameters
        SendMailJob::dispatch($name, $phone, $address, $attachmentPath, $mails);

        return "Mail sent (queued)";
    }
}
