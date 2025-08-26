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
        Schema::create('lap_sectors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lap_id');
            $table->foreign('lap_id')
                ->references('id')->on('laps')
                ->onDelete('cascade');
            $table->integer('sector_number');
            $table->decimal('duration', 6, 3)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_sectors');
    }
};
