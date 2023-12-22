<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simpanan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anggota_id');
            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');

            $table->foreignId('jenis_simpanan_id');
            $table->foreign('jenis_simpanan_id')->references('id')->on('jenis_simpanan')->onDelete('cascade');

            $table->integer('nominal');
            $table->text('keterangan')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simpanan');
    }
}
