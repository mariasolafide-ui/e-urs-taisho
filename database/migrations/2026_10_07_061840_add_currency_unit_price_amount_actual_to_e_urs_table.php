<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('e_urs', function (Blueprint $table) {

            $table->string('currency', 3)
                ->nullable()
                ->after('unit');

            $table->decimal('unit_price', 18, 2)
                ->nullable()
                ->after('currency');

            $table->decimal('amount_actual', 20, 2)
                ->nullable()
                ->after('unit_price');

        });
    }

    public function down(): void
    {
        Schema::table('e_urs', function (Blueprint $table) {

            $table->dropColumn([
                'currency',
                'unit_price',
                'amount_actual',
            ]);

        });
    }
};