<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_achievement_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('achievement_tier_id')->constrained()->cascadeOnDelete();

            $table->timestamp('unlocked_at')->nullable();
            $table->boolean('is_claimed')->default(false);
            $table->timestamp('claimed_at')->nullable();

            $table->json('context')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'achievement_tier_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_achievement_tiers');
    }
};