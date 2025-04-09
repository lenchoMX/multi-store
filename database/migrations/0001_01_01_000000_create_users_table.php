<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->string('given_name');
            $table->string('family_name');
            $table->string('additional_name')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('password');
            $table->enum('risk_level', ["low","medium","high"])->default('low');
            $table->integer('trust_score')->default(50);
            $table->timestamp('last_risk_update')->nullable();
            # $table->timestamp('email_verified_at')->nullable(); // Para verificación de email
            $table->rememberToken(); // Para "recordarme" en sesiones
            $table->timestamps();
            $table->unique(['store_id', 'email']);
        });
    
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};