<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_urs', function (Blueprint $table) {
            $table->id();

            // Request Information
            $table->string('request_number')->unique();
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('department');

            // Procurement Requirement
            $table->string('supplier_recommendation')->nullable();
            $table->string('item_service_name');
            $table->text('special_requirements')->nullable();

            $table->decimal('quantity', 15, 2)->nullable();
            $table->string('unit')->nullable();

            $table->date('expected_arrival_date')->nullable();

            $table->text('brands')->nullable();
            $table->text('technical_description')->nullable();

            // Estimated Amount
            $table->decimal('estimated_amount', 15, 2)->nullable();

            $table->enum('amount_category', [
                'below_50m',
                'above_50m'
            ])->nullable();

            // CAPEX
            $table->boolean('capex_required')->default(false);
            $table->text('capex_description')->nullable();

            // IT Recommendation
            $table->boolean('it_recommendation')->default(false);

            // EHS Recommendation
            $table->boolean('ehs_recommendation')->default(false);

            // Workflow Status
            $table->enum('status', [
                'draft',
                'submitted',
                'pending_ehs',
                'pending_hod',
                'rejected_ehs',
                'rejected_hod',
                'pending_procurement',
                'processing',
                'completed',
                'cancelled'
            ])->default('draft');

            $table->string('current_stage')->nullable();

            // Submission
            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_urs');
    }
};