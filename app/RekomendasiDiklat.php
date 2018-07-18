<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekomendasiDiklat extends Model
{
  protected $fillable = ['nama_diklat', 'tgl_diklat', 'unit_id', 'jenjang_id', 'pangkat_id', 'jenis_jabatan_id'];
}
