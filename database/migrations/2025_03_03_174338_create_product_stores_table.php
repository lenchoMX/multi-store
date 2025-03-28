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

        Schema::create('product_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('image_id')->constrained();
            $table->foreignId('description_id')->nullable()->constrained();
            $table->foreignId('short_description_id')->nullable()->constrained();
            $table->set('status', ["available","out"])->default('available');
            $table->decimal('price', 8, 2);
            $table->foreignId('currency_id')->constrained();
            $table->unsignedInteger('stock')->default(999);
            $table->unsignedInteger('view')->default(0);
            $table->unsignedInteger('rating_value')->default(0);
            $table->unsignedInteger('review_count')->default(0);
            $table->unsignedInteger('comment_count')->default(0);
            $table->foreignId('primary_category_store_id')->nullable()->constrained('category_stores');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stores');
    }
};
