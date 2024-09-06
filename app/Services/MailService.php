<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendMail($data)
    {
        try {
            $emailData = [
                'email' => $data['email'],
                'messageContent' => $data['message'], 
                'imageUrl' => public_path('logo.png')
            ];
    
            Mail::send('mail.template', $emailData, function ($message) use ($data) {
                $message->to($data['email'])
                        ->subject('New Message')
                        ->embed(public_path('logo.png'));
            });
            return ['status' => 'success', 'message' => 'Email sent successfully!'];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to send email.'];
        }
    }
}
