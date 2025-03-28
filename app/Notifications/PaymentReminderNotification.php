<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentReminderNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable): array
    {
        return ['mail']; // Puedes agregar 'whatsapp' si implementas una integración
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Recordatorio de Pago Pendiente')
            ->greeting('Hola ' . ($this->order->name ?? 'Cliente'))
            ->line('Hemos notado que tu orden #' . $this->order->id . ' aún está pendiente de pago.')
            ->line('Total: $' . $this->order->total)
            ->action('Completar Pago', url(route('payment.process', $this->order->id)))
            ->line('Gracias por comprar con nosotros.');
    }

    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'total' => $this->order->total,
        ];
    }
}