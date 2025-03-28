<?php

namespace App\Console\Commands;

use App\Jobs\SendPaymentReminders;
use Illuminate\Console\Command;

class SendPaymentRemindersCommand extends Command
{
    protected $signature = 'orders:send-payment-reminders';
    protected $description = 'Envía recordatorios de pago para órdenes pendientes';

    public function handle(): void
    {
        $this->info('Enviando recordatorios de pago...');
        SendPaymentReminders::dispatch();
        $this->info('Recordatorios enviados.');
    }
}