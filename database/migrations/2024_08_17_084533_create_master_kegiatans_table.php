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
        Schema::create('master_kegiatans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tipe')->enum(['frame_1'], ['frame_2']);
            $table->string('kegiatan');
            $table->text('keterangan');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_kegiatans');
    }
};
