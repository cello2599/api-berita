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
        Schema::create('komentar', function (Blueprint $table) {
            $table->id("id_komentar")->unique()->autoIncrement();
            $table->unsignedBigInteger('id_berita');
            $table->unsignedBigInteger('id_user');
            $table->text('komentar');
            $table->foreign('id_berita')->references('id_berita')->on('berita');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komen');
    }
};
