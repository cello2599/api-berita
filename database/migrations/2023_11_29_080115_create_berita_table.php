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
        Schema::create('berita', function (Blueprint $table) {
            $table->id("id_berita")->unique()->autoIncrement();
            $table->string('judul');
            $table->text('content');
            $table->string('gambar');
            $table->unsignedBigInteger('penulis');
            $table->unsignedBigInteger('kategori');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('penulis')->references('id')->on('users');
            $table->foreign('kategori')->references('id_kategori')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
