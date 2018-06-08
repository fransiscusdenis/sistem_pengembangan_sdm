<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
  protected $fillable = ['pegawai_id', 'jenjang_id', 'nama_sekolah', 'prodi', 'tahun_lulus'];
  
}
