<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatDiklat extends Model
{
    protected $fillable = ['pegawai_id', 'nama_diklat', 'no_sertifikat', 'tgl_sertifikat', 'peran'];
}
