<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_jabatans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pegawai_id');
            $table->integer('pangkat_id');
            $table->string('jabatan');
            $table->integer('jenis_jabatan_id');
            $table->date('tmt_jabatan');
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
        Schema::dropIfExists('riwayat_jabatans');
    }
}
