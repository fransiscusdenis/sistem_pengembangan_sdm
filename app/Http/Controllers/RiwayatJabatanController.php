<?php

namespace App\Http\Controllers;

use DB;
use App\Pangkat;
use App\Jabatan;
use App\Pegawai;
use App\Unit;
use App\JenisJabatan;
use App\RiwayatJabatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class RiwayatJabatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $riwayatjabatan = RiwayatJabatan::all();
      $jabatan = Jabatan::all();
      $jenisjabatan = JenisJabatan::all();
      $pangkat = Pangkat::all();
      $pegawai = Pegawai::all();
      $unit = Unit::all();

      return view('riwayatjabatan/index', [
        'label'=> 'RiwayatJabatan',
        'riwayatjabatan' => $riwayatjabatan,
        'jabatan' => $jabatan,
        'jenisjabatan' => $jenisjabatan,
        'pangkat' => $pangkat,
        'unit' => $unit,
        'pegawai' => $pegawai
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = [
        'pegawai_id' => $request['pegawai_id'],
        'pangkat_id' => $request['pangkat_id'],
        'jabatan' => $request['jabatan'],
        'jenis_jabatan_id' => $request['jenis_jabatan_id'],
        'tmt_jabatan' => $request['tmt_jabatan']
      ];

      $riwayatjabatan = RiwayatJabatan::create($data);

      return response()->json('Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $riwayatjabatan  = RiwayatJabatan::find($id);
      return $riwayatjabatan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $riwayatjabatan = RiwayatJabatan::find($id);
      $riwayatjabatan->pegawai_id = $request['pegawai_id'];
      $riwayatjabatan->pangkat_id = $request['pangkat_id'];
      $riwayatjabatan->jabatan = $request['jabatan'];
      $riwayatjabatan->jenis_jabatan_id = $request['jenis_jabatan_id'];
      $riwayatjabatan->tmt_jabatan = $request['tmt_jabatan'];
      $riwayatjabatan->update();

      return response()->json('Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RiwayatJabatan::destroy($id);
    }

    public function apiRiwayatJabatan(Request $request)
    {
        //$riwayatjabatan = RiwayatJabatan::all();
        $riwayatjabatan = DB::table('riwayat_jabatans')
                          ->join('pangkats', 'riwayat_jabatans.pangkat_id', '=', 'pangkats.id')
                          // ->join('jabatans', 'riwayat_jabatans.jabatan_id', '=', 'jabatans.id')
                          ->join('jenis_jabatans', 'riwayat_jabatans.jenis_jabatan_id', '=', 'jenis_jabatans.id')
                          ->join('pegawais', 'riwayat_jabatans.pegawai_id', '=', 'pegawais.id')
                          ->select('riwayat_jabatans.*', DB::raw('DATE_FORMAT(tmt_jabatan, "%m/%d/%Y") as tmt_jabatan'), 'pangkats.nama_pangkat', 'jenis_jabatans.jenis_jabatan', 'pegawais.nip', 'pegawais.nama')
                          ->get();

        $datatables = Datatables::of($riwayatjabatan);

        $datatables->addColumn('action', function($riwayatjabatan){
          return '<a onclick="editForm('. $riwayatjabatan->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $riwayatjabatan->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }

    public function filterpegawai()
    {
      $riwayatjabatan = RiwayatJabatan::all();
      $jabatan = Jabatan::all();
      $jenisjabatan = JenisJabatan::all();
      $pangkat = Pangkat::all();
      $pegawai = Pegawai::all();
      $unit = Unit::all();

      return view('filterpegawai/index', [
        'label'=> 'Filter Pegawai',
        'riwayatjabatan' => $riwayatjabatan,
        'jabatan' => $jabatan,
        'jenisjabatan' => $jenisjabatan,
        'pangkat' => $pangkat,
        'pegawai' => $pegawai,
        'unit' => $unit
      ]);
    }

    public function apiFilterPegawai(Request $request, $id_pangkat = 0, $id_jenis_jabatan = 0, $id_unit= 0)
    {
        //$riwayatjabatan = RiwayatJabatan::all();
        $data = DB::table('riwayat_jabatans')
                          ->join('pangkats', 'riwayat_jabatans.pangkat_id', '=', 'pangkats.id')
                          // ->join('jabatans', 'riwayat_jabatans.jabatan_id', '=', 'jabatans.id')
                          ->join('jenis_jabatans', 'riwayat_jabatans.jenis_jabatan_id', '=', 'jenis_jabatans.id')
                          ->join('pegawais', 'riwayat_jabatans.pegawai_id', '=', 'pegawais.id')
                          ->join('units', 'pegawais.unit_id', '=', 'units.id')
                          ->select('riwayat_jabatans.*', DB::raw('DATE_FORMAT(tmt_jabatan, "%m/%d/%Y") as tmt_jabatan'),
                                   'pangkats.nama_pangkat', 'jenis_jabatans.jenis_jabatan', 'pegawais.nip', 'pegawais.nama',
                                   'units.kode_unit');


        if ($id_pangkat != 0 && $id_jenis_jabatan != 0 && $id_unit != 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat,
                                         'riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan,
                                         'pegawais.unit_id' => $id_unit
                          ])->get();
        }elseif ($id_pangkat != 0 && $id_jenis_jabatan != 0 && $id_unit == 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat,
                                         'riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan
                          ])->get();
        }elseif ($id_pangkat != 0 && $id_jenis_jabatan == 0 && $id_unit == 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat
                          ])->get();
        }elseif ($id_pangkat == 0 && $id_jenis_jabatan != 0 && $id_unit != 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan,
                                         'pegawais.unit_id' => $id_unit
                          ])->get();
        }elseif ($id_pangkat == 0 && $id_jenis_jabatan != 0 && $id_unit == 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan
                          ])->get();
        }elseif ($id_pangkat != 0 && $id_jenis_jabatan == 0 && $id_unit != 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat,
                                         'pegawais.unit_id' => $id_unit
                          ])->get();
        }elseif ($id_pangkat == 0 && $id_jenis_jabatan == 0 && $id_unit != 0) {
          $filterpegawai = $data->where(['pegawais.unit_id' => $id_unit
                          ])->get();
        }else{
          $filterpegawai = $data->get();
        }

        $datatables = Datatables::of($filterpegawai);

        $datatables->addColumn('action', function($filterpegawai){
          return '<a onclick="editForm('. $filterpegawai->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $filterpegawai->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }
}
