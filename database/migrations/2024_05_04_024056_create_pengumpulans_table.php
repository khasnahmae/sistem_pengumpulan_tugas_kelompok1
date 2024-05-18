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
        Schema::create('pengumpulans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tugass');
            $table->unsignedBigInteger('id_mahasiswas');
            $table->string('link_tugas');
            $table->integer('nilai')->nullable();
            $table->dateTime('tgl_pengumpulan');
            $table->string('komentar')->nullable();
            $table->foreign('id_tugass')->references('id')->on('tugass')->onDelete('cascade');
            $table->foreign('id_mahasiswas')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulans');
    }
};
