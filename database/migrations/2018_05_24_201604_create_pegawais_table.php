<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->integer('jenis_kelamin_id');
            $table->integer('agama_id');
            $table->integer('status_perkawinan_id');
            $table->integer('status_pegawai_id');
            $table->integer('status_hukum_id');
            $table->integer('unit_id');
            $table->string('unit_kerja');
            $table->string('skpd');
            $table->date('tmt_pensiun');
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
        Schema::dropIfExists('pegawais');
    }
}
