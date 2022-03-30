<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('archive');
        Schema::create('archive', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_arsip');
            $table->string('nomor_surat');
            $table->string('nama_pencipta');
            $table->string('petugas_registrasi');
            $table->string('kode_klasifikasi');
            $table->string('jumlah_arsip');
            $table->string('keterangan');
            $table->string('file');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archive');
    }
}
