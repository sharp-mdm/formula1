<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laps', function (Blueprint $table) {
            $table->index('driver_number');
            $table->index('lap_number');
            $table->index(['driver_number','lap_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laps', function (Blueprint $table) {
            $table->dropIndex('laps_driver_number_index');
            $table->dropIndex('laps_lap_number_index');
            $table->dropIndex('laps_driver_number_lap_number_index');
        });
    }
};
