<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('e_urs', function (Blueprint $table) {

            // Supplier information
            $table->string('supplier_contact_person')
                ->nullable()
                ->after('reference_supplier');

            $table->string('supplier_contact')
                ->nullable()
                ->after('supplier_contact_person');

            // IT specification
            $table->string('it_ram')
                ->nullable()
                ->after('it_recommendation');

            $table->string('it_internal_memory')
                ->nullable()
                ->after('it_ram');

            $table->string('it_connectivity')
                ->nullable()
                ->after('it_internal_memory');

            $table->string('it_os')
                ->nullable()
                ->after('it_connectivity');

        });
    }

    public function down(): void
    {
        Schema::table('e_urs', function (Blueprint $table) {

            $table->dropColumn([
                'supplier_contact_person',
                'supplier_contact',
                'it_ram',
                'it_internal_memory',
                'it_connectivity',
                'it_os',
            ]);

        });
    }
};