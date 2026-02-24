<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public Admin $admin;
    public string $verificationCode;

    public function __construct(Admin $admin, string $verificationCode)
    {
        $this->admin = $admin;
        $this->verificationCode = $verificationCode;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Email Verification Code',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-verification-code',
        );
    }
}