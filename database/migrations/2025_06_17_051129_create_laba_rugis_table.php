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
        Schema::create('laba_rugis', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('ket');
            $table->integer('nominal');
            $table->date('tgl_catat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laba_rugis');
    }
};
