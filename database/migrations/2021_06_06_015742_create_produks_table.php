<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('no_perda');
            $table->string('judul_peraturan');
            $table->string('tahun');
            $table->unsignedBigInteger('kabupaten_id');
            $table->enum('jenis_produk', ['daerah', 'gubernur']);
            $table->enum('status', ['berlaku', 'dicabut']);
            $table->string('file_produk');
            $table->timestamps();

            $table->foreign('kabupaten_id')->references('id')->on('kabupatens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}