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
        Schema::create('mapels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dosens');
            // $table->unsignedBigInteger('id_kelass');
            // $table->unsignedBigInteger('id_prodis');
            $table->string('nama_mapel');
            $table->foreign('id_dosens')->references('id')->on('dosens');
            // $table->foreign('id_kelass')->references ('id')->on('kelass');
            // $table->foreign('id_prodis')->references ('id')->on('prodis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapels');
    }
};
