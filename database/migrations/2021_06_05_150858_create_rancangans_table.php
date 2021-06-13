<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRancangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rancangans', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi');
            $table->date('tgl_input');
            $table->date('tgl_rancangan');
            $table->string('no_surat');
            $table->unsignedBigInteger('kabupaten_id');
            $table->string('perihal');
            $table->string('keterangan');
            $table->enum('status', ['proses', 'selesai']);
            $table->string('file_rancangan')->nullable();
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
        Schema::dropIfExists('rancangans');
    }
}