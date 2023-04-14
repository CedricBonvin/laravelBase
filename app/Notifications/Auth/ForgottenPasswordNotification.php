<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgottenPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private string $redirectUrl;

    public function __construct(string $signedUrl)
    {
        $this->redirectUrl = config('jeu-alcool.url.front') . '/reset?redirect=' . urlencode($signedUrl);
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Mot de passe oublié')
            ->greeting('Bonjour')
            ->line('Vous avez demandé une réinitialisation de votre mot de passe')
            ->line('Cliquer sur le lien ci-dessous pour le modifier')
            ->action('Modifier mon mot de passe', $this->redirectUrl);
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
