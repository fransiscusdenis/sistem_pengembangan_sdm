<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\JenisKelamin;
use App\Agama;
use App\StatusPerkawinan;
use App\StatusPegawai;
use App\StatusHukum;
use App\Unit;
use App\RiwayatPendidikan;
use App\Jenjang;
use App\Pangkat;
use App\Eselon;
use App\Jabatan;
use App\JenisJabatan;
use App\RiwayatJabatan;
use App\RiwayatDiklat;
use App\RiwayatPangkat;
use App\RiwayatEselon;
use App\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $pegawai = Pegawai::count();
      $unit = Unit::count();
      $struktural = RiwayatJabatan::where('jenis_jabatan_id', 1)
                    ->count();
      $fungsional = RiwayatJabatan::where('jenis_jabatan_id', 2)
                    ->count();
      $pelaksana = RiwayatJabatan::where('jenis_jabatan_id', 3)
                    ->count();

      return view('admin/index', [
        'pegawai' => $pegawai,
        'unit' => $unit,
        'struktural' => $struktural,
        'fungsional' => $fungsional,
        'pelaksana' => $pelaksana
      ]);
    }
}
