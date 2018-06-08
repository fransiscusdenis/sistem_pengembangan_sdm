<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
      'nip', 'nama', 'tempat_lahir', 'tanggal_lahir',
      'alamat', 'kabupaten', 'provinsi', 'jenis_kelamin_id',
      'agama_id', 'status_perkawinan_id', 'status_pegawai_id',
      'status_hukum_id', 'unit_id', 'unit_kerja', 'skpd', 'tmt_pensiun'
    ];
}
