<?php

namespace App\Notifications;

use App\Models\Stud;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HireRequestResponseNotification extends Notification
{
    use Queueable;

    protected $stud;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(Stud $stud, string $status)
    {
        $this->stud = $stud;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $statusText = $this->status === 'accepted' ? 'aceptado' : 'rechazado';
        $message = "El stud '{$this->stud->name}' ha {$statusText} tu solicitud de contrato.";

        return [
            'stud_id' => $this->stud->id,
            'stud_name' => $this->stud->name,
            'status' => $this->status,
            'message' => $message,
            'url' => route('studs.show', $this->stud->id),
        ];
    }
}