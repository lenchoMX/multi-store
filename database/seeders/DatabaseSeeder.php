<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $this->command->info('Iniciando seeding...');

        $sql = database_path('product.sql');
        DB::unprepared(file_get_contents($sql));

        $this->command->info('Seeding completado.');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
