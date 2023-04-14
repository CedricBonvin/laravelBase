<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private User $user;
    private string $name;
    private string $url;

    public function __construct(User $user, string $url)
    {
        $this->name = $user->firstname;
        $this->url = $url;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'JeuAlcool - Inscription',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.users.new-user',
            with: [
                'name' => $this->name,
                'url' => $this->url,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
