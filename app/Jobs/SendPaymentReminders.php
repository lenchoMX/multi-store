<?php

namespace App\Jobs;

use App\Models\Order;
use App\Notifications\PaymentReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPaymentReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $orders = Order::where('status', 'payment_pending')
            ->where('updated_at', '<', now()->subHours(24)) // Solo órdenes pendientes por más de 24 horas
            ->get();

        foreach ($orders as $order) {
            if ($order->email) {
                $order->notify(new PaymentReminderNotification($order));
            }
            // Aquí podrías agregar lógica para WhatsApp si tienes el número y una API
        }
    }
}