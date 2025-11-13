<?php

namespace App\Notifications;

use App\Models\Stud;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudHireRequestNotification extends Notification
{
    use Queueable;

    protected $boss;
    protected $stud;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $boss, Stud $stud)
    {
        $this->boss = $boss;
        $this->stud = $stud;
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
        return [
            'stud_id' => $this->stud->id,
            'stud_name' => $this->stud->name,
            'boss_name' => $this->boss->name,
            'message' => "El jefe {$this->boss->name} quiere contratar tu stud '{$this->stud->name}'.",
            'url' => route('studs.show', $this->stud->id),
        ];
    }
}