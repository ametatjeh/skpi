<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Aktivasi Akun SKPI')
            ->view('emails.activation') // nama view email Anda
            ->with([
                'name' => $this->user->name,
                'email' => $this->user->email,
                'activationUrl' => url('/activate/' . $this->user->activation_token),
            ]);
    }
}
