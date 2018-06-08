<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatPangkat extends Model
{
    protected $fillable = ['pegawai_id', 'pangkat_id', 'tmt_pangkat'];
}
