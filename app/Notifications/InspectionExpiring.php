<?php

namespace App\Notifications;

use App\Models\Inspection;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InspectionExpiring extends Notification
{
    use Queueable;

    public function __construct(public Inspection $inspection) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Vehicle Inspection Expiring Soon')
            ->greeting('Hi ' . ($notifiable->name ?? 'there') . ',')
            ->line("The inspection for vehicle **{$this->inspection->vehicle->plate_number}** expires on **{$this->inspection->expiry_date->format('M d, Y')}**.")
            ->action('View Inspection', route('inspections.show', $this->inspection))
            ->line('Please schedule a renewal before it expires.')
            ->salutation('Regards, KonzaMove Team');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Inspection expiring soon',
            'body'  => "{$this->inspection->vehicle->plate_number} expires on {$this->inspection->expiry_date->format('M d, Y')}.",
            'url'   => route('inspections.show', $this->inspection),
        ];
    }
}
