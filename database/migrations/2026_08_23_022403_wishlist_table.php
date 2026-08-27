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

        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->decimal('target_amount', 10, 0);
            $table->decimal('saved_amount', 10, 0)->default(0);
            $table->text('description')->nullable();
            $table->date('deadline')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('wishlist_deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wishlist_id')
                ->constrained('wishlists')
                ->cascadeOnDelete();

            $table->decimal('amount', 10, 0);
            $table->date('deposit_date');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('wishlist_deposits');
    }
};
