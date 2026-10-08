<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('e_urs', function (Blueprint $table) {

            // Supplier Quotation
            $table->string('supplier_quotation_file')
                ->nullable()
                ->after('reference_supplier');

            // Approval
            $table->string('approver_email')
                ->nullable()
                ->after('current_stage');

            $table->text('approval_note')
                ->nullable()
                ->after('approver_email');

            $table->text('rejection_reason')
                ->nullable()
                ->after('approval_note');

            $table->string('approval_token')
                ->nullable()
                ->unique()
                ->after('rejection_reason');

            $table->timestamp('approved_at')
                ->nullable()
                ->after('submitted_at');

            $table->timestamp('rejected_at')
                ->nullable()
                ->after('approved_at');
        });

        DB::statement("
            ALTER TABLE e_urs
            MODIFY status ENUM(
                'draft',
                'submitted',
                'pending_approval',
                'approved',
                'approved_with_note',
                'rejected',
                'pending_procurement',
                'processing',
                'completed',
                'cancelled'
            ) NOT NULL DEFAULT 'draft'
        ");
    }

    public function down(): void
    {
        Schema::table('e_urs', function (Blueprint $table) {
            $table->dropColumn([
                'supplier_quotation_file',
                'approver_email',
                'approval_note',
                'rejection_reason',
                'approval_token',
                'approved_at',
                'rejected_at',
            ]);
        });

        DB::statement("
            ALTER TABLE e_urs
            MODIFY status ENUM(
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
            ) NOT NULL DEFAULT 'draft'
        ");
    }
};