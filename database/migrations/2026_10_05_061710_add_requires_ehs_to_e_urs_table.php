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
        Schema::table('e_urs', function (Blueprint $table) {

            $table->boolean('requires_ehs')
                ->default(false)
                ->after('department');

            $table->string('ehs_status')
                ->nullable()
                ->after('requires_ehs');

            $table->text('ehs_notes')
                ->nullable()
                ->after('ehs_status');

            $table->timestamp('ehs_reviewed_at')
                ->nullable()
                ->after('ehs_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('e_urs', function (Blueprint $table) {

            $table->dropColumn([
                'requires_ehs',
                'ehs_status',
                'ehs_notes',
                'ehs_reviewed_at',
            ]);

        });
    }
};