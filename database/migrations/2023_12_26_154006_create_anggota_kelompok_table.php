<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaKelompokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_kelompok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_kelompok_id');
            $table->foreign('jenis_kelompok_id')->references('id')->on('jenis_kelompok');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->char('no_ktp', 16)->unique();
            $table->string('nama_kelompok', 100);
            $table->text('alamat');
            $table->char('telepon', 12);

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
        Schema::dropIfExists('kelompok');
    }
}
