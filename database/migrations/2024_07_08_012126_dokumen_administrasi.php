<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DokumenAdministrasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_administrasi', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->integer('user_id');
            $table->enum('status_persetujuan',array('menunggu','ditolak','disetujui'))->default('menunggu');
            $table->string('alasan_persetujuan', 255);
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
        Schema::dropIfExists('dokumen_administrasi');
    }
}
