<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;
    public $otp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$otp)
    {
        $this->email=$email;
        $this->otp=$otp;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Reset Password Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    public function build()
    {
        $resetUrl = url("/reset-password?token={$this->token}&email={$this->email}");
        return $this->subject('Reset Your Password',$resetUrl)
                    //->markdown('emails.reset_password')
                    ->view('emails.student.reset_password_otp')
                    ->with(['token' => $this->token, 'Url' => $resetUrl, 'otp' => $this->otp]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
