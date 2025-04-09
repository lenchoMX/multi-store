<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('image_id')->nullable()->constrained();
            $table->foreignId('description_id')->nullable()->constrained();
            $table->foreignId('short_description_id')->nullable()->constrained();
            $table->decimal('price', 8, 2);
            $table->foreignId('currency_id')->constrained();
            $table->integer('stock')->default(999);
            $table->boolean('is_active')->default(true);
            $table->integer('view')->default(0);
            $table->decimal('rating_value', 3, 1)->nullable();
            $table->integer('review_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->foreignId('primary_category_store_id')->nullable()->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_products');
    }
};
