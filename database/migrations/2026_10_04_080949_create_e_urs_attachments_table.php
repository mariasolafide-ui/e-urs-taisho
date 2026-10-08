<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_urs_attachments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('e_urs_id')
                ->constrained('e_urs')
                ->cascadeOnDelete();

            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();

            $table->enum('attachment_type', [
                'technical_reference',
                'supplier_reference',
                'ehs_document',
                'capex_document',
                'other'
            ])->default('other');

            $table->foreignId('uploaded_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_urs_attachments');
    }
};