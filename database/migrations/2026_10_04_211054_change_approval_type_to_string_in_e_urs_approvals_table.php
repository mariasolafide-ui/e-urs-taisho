<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE e_urs
            MODIFY status VARCHAR(50) NOT NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE e_urs
            MODIFY status ENUM(
                'pending_approval',
                'approved',
                'approved_with_note',
                'rejected'
            ) NOT NULL
        ");
    }
};