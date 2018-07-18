<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatEselon extends Model
{
    protected $fillable = ['pegawai_id', 'eselon_id', 'jabatan'];
}
