<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Restablece tu contraseña - DreamHorses ')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Recibiste este correo porque solicitaste restablecer tu contraseña en DreamHorses.')
            ->action('Restablecer Contraseña', $url)
            ->line('Este enlace expirará en 60 minutos.')
            ->line('Si no solicitaste un cambio de contraseña, ignora este mensaje.')
            ->salutation('Saludos, el equipo de DreamHorses');
    }
}
