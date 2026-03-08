<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievement_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('achievement_id')->constrained()->cascadeOnDelete();

            $table->enum('tier', ['bronze', 'silver', 'gold']);
            $table->unsignedTinyInteger('tier_order'); // bronze=1 silver=2 gold=3

            $table->string('metric_key'); // tasks_completed_total, tasks_completed_study
            $table->string('operator')->default('>=');
            $table->unsignedInteger('target_value');

            $table->unsignedInteger('reward_points')->default(0);
            $table->string('reward_title')->nullable();

            $table->timestamps();

            $table->unique(['achievement_id', 'tier']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievement_tiers');
    }
};