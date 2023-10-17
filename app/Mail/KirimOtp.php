<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KirimOtp extends Mailable
{
    use Queueable, SerializesModels;

    public $send_otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($send_otp)
    {
        $this->send_otp = $send_otp;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
     public function build()
    {
         return $this->subject('Kode OTP Anda')
        ->markdown('emails.otp_shipped');
       
    }
}
