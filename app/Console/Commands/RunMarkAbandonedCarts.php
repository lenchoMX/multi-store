<?php

namespace App\Console\Commands;

use App\Jobs\MarkAbandonedCarts;
use Illuminate\Console\Command;

class RunMarkAbandonedCarts extends Command
{
    protected $signature = 'carts:mark-abandoned';
    protected $description = 'Marca los carritos pendientes como abandonados después de un día';

    public function handle(): void
    {
        $this->info('Ejecutando tarea para marcar carritos abandonados...');
        MarkAbandonedCarts::dispatch();
        $this->info('Tarea completada.');
    }
}