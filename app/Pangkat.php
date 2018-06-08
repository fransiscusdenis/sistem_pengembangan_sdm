<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
  protected $fillable = ['nama_pangkat', 'jenis_pangkat', 'pangkat', 'golongan', 'ruang', 'prioritas'];

}
