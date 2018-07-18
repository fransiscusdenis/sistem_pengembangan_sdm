<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekomendasiDiklatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekomendasi_diklats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_diklat');
            $table->date('tgl_diklat');
            $table->integer('unit_id');
            $table->integer('jenjang_id');
            $table->integer('pangkat_id');
            $table->integer('jenis_jabatan_id');
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
        Schema::dropIfExists('rekomendasi_diklats');
    }
}
