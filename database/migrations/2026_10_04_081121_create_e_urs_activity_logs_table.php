<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_urs_activity_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('e_urs_id')
                ->constrained('e_urs')
                ->cascadeOnDelete();

            // User who performed the activity
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Activity information
            $table->string('activity');
            $table->text('description')->nullable();

            // Optional previous and new status
            $table->string('old_status')->nullable();
            $table->string('new_status')->nullable();

            // Additional information
            $table->string('ip_address', 45)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_urs_activity_logs');
    }
};