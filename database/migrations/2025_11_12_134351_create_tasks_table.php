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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->string('title');
        $table->text('description')->nullable();
        $table->enum('priority', ['low', 'medium', 'high']);
        $table->enum('category', ['chores', 'exercise', 'study', 'assignment']);
        $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
        $table->string('assignee')->nullable();
        $table->date('due_date')->nullable();
        $table->integer('points')->default(0);
        $table->timestamps();
        $table->time('start_time')->nullable();
        $table->time('end_time')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
