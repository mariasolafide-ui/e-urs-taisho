<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_urs_approvals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('e_urs_id')
                ->constrained('e_urs')
                ->cascadeOnDelete();

            // Approval type
            $table->enum('approval_type', [
                'ehs',
                'hod'
            ]);

            // Approver information
            $table->string('approver_name')->nullable();
            $table->string('approver_email')->nullable();

            // Approval status
            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            // Approval comments
            $table->text('comments')->nullable();

            // Secure approval token for email approval
            $table->string('approval_token', 100)->unique()->nullable();

            // Token expiration
            $table->timestamp('token_expires_at')->nullable();

            // Approval timestamp
            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_urs_approvals');
    }
};