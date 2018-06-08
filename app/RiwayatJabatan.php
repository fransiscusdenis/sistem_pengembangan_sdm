<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
  protected $fillable = ['pegawai_id', 'pangkat_id', 'jabatan', 'jenis_jabatan_id', 'tmt_jabatan'];

}
