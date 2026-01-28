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
        Schema::create('store_items', function (Blueprint $table) {
        $table->id();
        $table->string('name');                // Starbucks RM10
        $table->string('brand');               // Starbucks, Zeus
        $table->integer('points_cost');        // cost in points
        $table->integer('stock')->nullable();  // null = unlimited
        $table->boolean('is_active')->default(true);
        $table->text('description')->nullable();
        $table->timestamps();
        $table->string('image_path')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_items');
    }
};
