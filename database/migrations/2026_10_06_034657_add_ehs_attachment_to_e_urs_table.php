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

            $table->string('ehs_attachment')
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

            $table->dropColumn('ehs_attachment');

        });
    }
};