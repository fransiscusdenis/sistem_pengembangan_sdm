<?php

namespace App\Http\Controllers;

use DB;
use App\Unit;
use App\Pangkat;
use App\Jabatan;
use App\Jenjang;
use App\Pegawai;
use App\JenisJabatan;
use App\RekomendasiDiklat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class RekomendasiDiklatController extends Controller
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
      $rekomendasidiklat = RekomendasiDiklat::all();
      $pegawai = Pegawai::all();
      $jenjang = Jenjang::all();
      $jabatan = Jabatan::all();
      $jenisjabatan = JenisJabatan::all();
      $pangkat = Pangkat::all();
      $unit = Unit::all();

      return view('rekomendasidiklat/index', [
        'label'=> 'RekomenDiklat',
        'rekomendasidiklat' => $rekomendasidiklat,
        'jenjang' => $jenjang,
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
        'nama_diklat' => $request['nama_diklat'],
        'tgl_diklat' => $request['tgl_diklat'],
        'unit_id' => $request['unit_id'],
        'jenjang_id' => $request['jenjang_id'],
        'pangkat_id' => $request['pangkat_id'],
        'jenis_jabatan_id' => $request['jenis_jabatan_id']
      ];

      $rekomendasidiklat = RekomendasiDiklat::create($data);

      return response()->json(['rekomendasidiklat' => $rekomendasidiklat, 'message' => 'Berhasil Menambahkan Data!']);
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
      $riwayatdiklat  = RekomendasiDiklat::find($id);
      return $riwayatdiklat;
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
      $rekomendasidiklat = RekomendasiDiklat::find($id);
      $rekomendasidiklat->nama_diklat = $request['nama_diklat'];
      $rekomendasidiklat->tgl_diklat = $request['tgl_diklat'];
      $rekomendasidiklat->unit_id = $request['unit_id'];
      $rekomendasidiklat->jenjang_id = $request['jenjang_id'];
      $rekomendasidiklat->pangkat_id = $request['pangkat_id'];
      $rekomendasidiklat->jenis_jabatan_id = $request['jenis_jabatan_id'];
      $rekomendasidiklat->update();

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
        RekomendasiDiklat::destroy($id);
    }

    public function apiRekomendasiDiklat(Request $request)
    {
        //$riwayatdiklat = RekomendasiDiklat::all();
        $rekomendasidiklat = DB::table('rekomendasi_diklats')
                          // ->join('pangkats', 'rekomendasi_diklats.pangkat_id', '=', 'pangkats.id')
                          // ->join('jenis_jabatans', 'rekomendasi_diklats.jenis_jabatan_id', '=', 'jenis_jabatans.id')
                          // ->join('pegawais', 'rekomendasi_diklats.pegawai_id', '=', 'pegawais.id')
                          // ->join('units', 'pegawais.unit_id', '=', 'units.id')
                          ->select('rekomendasi_diklats.*', DB::raw('DATE_FORMAT(tgl_diklat, "%d - %M - %Y") as tgl_diklat'))
                          ->get();
        // dd($rekomendasidiklat);

        $datatables = Datatables::of($rekomendasidiklat);

        $datatables->addColumn('action', function($rekomendasidiklat){
          return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Lihat Peserta</a> ' .
          '<a onclick="deleteData('. $rekomendasidiklat->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });

        return $datatables->make(true);
    }

    public function viewPilihPegawai()
    {
        $rekomendasidiklat = RekomendasiDiklat::all();
        $pegawai = Pegawai::all();
        $jenjang = Jenjang::all();
        $jabatan = Jabatan::all();
        $jenisjabatan = JenisJabatan::all();
        $pangkat = Pangkat::all();
        $unit = Unit::all();

        // $table = DB::table('pegawais')
        //               ->join('units', 'pegawais.unit_id', '=', 'units.id')
        //               ->select('pegawais.*', 'units.kode_unit')
        //               ->where('unit_id', '=', '1')
        //               ->paginate(10);

        $data = DB::table('riwayat_jabatans')
                          ->join('pangkats', 'riwayat_jabatans.pangkat_id', '=', 'pangkats.id')
                          ->join('jenis_jabatans', 'riwayat_jabatans.jenis_jabatan_id', '=', 'jenis_jabatans.id')
                          ->join('pegawais', 'riwayat_jabatans.pegawai_id', '=', 'pegawais.id')
                          ->join('units', 'pegawais.unit_id', '=', 'units.id')
                          ->join('riwayat_pendidikans', 'riwayat_pendidikans.pegawai_id', '=', 'riwayat_jabatans.pegawai_id')
                          ->join('jenjangs', 'riwayat_pendidikans.jenjang_id', '=', 'jenjangs.id')
                          ->select('riwayat_jabatans.*', 'pangkats.nama_pangkat', 'jenis_jabatans.jenis_jabatan', 'pegawais.nama',
                                   'units.kode_unit', 'jenjangs.nama_jenjang', 'riwayat_pendidikans.prodi')

                          ->where(['riwayat_jabatans.pangkat_id' => '7',
                                   'riwayat_jabatans.jenis_jabatan_id' => '3',
                                   'pegawais.unit_id' => '1'
                          ])->get();
        // dd($data);

        return view('rekomendasidiklat/pilihpegawai', [
          'label'=> 'RekomenDiklat',
          'rekomendasidiklat' => $rekomendasidiklat,
          'jenjang' => $jenjang,
          'jabatan' => $jabatan,
          'jenisjabatan' => $jenisjabatan,
          'pangkat' => $pangkat,
          'unit' => $unit,
          'pegawai' => $pegawai,
          'data' => $data
        ]);
    }

    public function viewUsulanPegawai($id)
    {
        $rekomendasidiklat = RekomendasiDiklat::all();
        $pegawai = Pegawai::all();
        $jenjang = Jenjang::all();
        $jabatan = Jabatan::all();
        $jenisjabatan = JenisJabatan::all();
        $pangkat = Pangkat::all();
        $unit = Unit::all();

        $usulandiklat = DB::table('rekomendasi_diklats')
                          ->select('rekomendasi_diklats.*')
                          ->where('id', '=', $id)
                          ->get();

        return view('rekomendasidiklat/usulanpegawai', [
          'label'=> 'RekomenDiklat',
          'rekomendasidiklat' => $rekomendasidiklat,
          'jenjang' => $jenjang,
          'jabatan' => $jabatan,
          'jenisjabatan' => $jenisjabatan,
          'pangkat' => $pangkat,
          'unit' => $unit,
          'pegawai' => $pegawai,
          'usulandiklat' => $usulandiklat
        ]);
    }

    public function apiUsulanDiklat(Request $request, $id)
    {
      $rekomendasidiklat = DB::table('rekomendasi_diklats')
                        ->select('rekomendasi_diklats.*')
                        ->where('id', '=', $id)
                        ->get();

      $datatables = Datatables::of($rekomendasidiklat);

      return $datatables->make(true);
    }

    public function apiPilihPegawai(Request $request, $id_pangkat = 0, $id_jenis_jabatan = 0, $id_unit = 0, $id_jenjang = 0)
    {
        //$riwayatjabatan = RiwayatJabatan::all();
        $data = DB::table('riwayat_jabatans')
                          ->join('pangkats', 'riwayat_jabatans.pangkat_id', '=', 'pangkats.id')
                          ->join('jenis_jabatans', 'riwayat_jabatans.jenis_jabatan_id', '=', 'jenis_jabatans.id')
                          ->join('pegawais', 'riwayat_jabatans.pegawai_id', '=', 'pegawais.id')
                          ->join('units', 'pegawais.unit_id', '=', 'units.id')
                          ->join('riwayat_pendidikans', 'riwayat_pendidikans.pegawai_id', '=', 'riwayat_jabatans.pegawai_id')
                          ->join('jenjangs', 'riwayat_pendidikans.jenjang_id', '=', 'jenjangs.id')
                          ->select('riwayat_jabatans.*', 'pangkats.nama_pangkat', 'jenis_jabatans.jenis_jabatan', 'pegawais.nama',
                                   'units.kode_unit', 'jenjangs.nama_jenjang', 'riwayat_pendidikans.prodi');


        if ($id_pangkat != 0 && $id_jenis_jabatan != 0 && $id_unit != 0 && $id_jenjang != 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat,
                                         'riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan,
                                         'pegawais.unit_id' => $id_unit,
                                         'riwayat_pendidikans.jenjang_id' => $id_jenjang
                          ])->get();
        }elseif ($id_pangkat != 0 && $id_jenis_jabatan != 0 && $id_unit != 0 && $id_jenjang == 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat,
                                         'riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan,
                                         'pegawais.unit_id' => $id_unit
                          ])->get();
        }elseif ($id_pangkat != 0 && $id_jenis_jabatan != 0 && $id_unit == 0 && $id_jenjang == 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat,
                                         'riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan
                          ])->get();
        }elseif ($id_pangkat != 0 && $id_jenis_jabatan == 0 && $id_unit == 0 && $id_jenjang == 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat
                          ])->get();
        }elseif ($id_pangkat != 0 && $id_jenis_jabatan != 0 && $id_unit == 0 && $id_jenjang != 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat,
                                         'riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan,
                                         'riwayat_pendidikans.jenjang_id' => $id_jenjang
                                        ])->get();
        }elseif ($id_pangkat != 0 && $id_jenis_jabatan == 0 && $id_unit == 0 && $id_jenjang != 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat,
                                         'riwayat_pendidikans.jenjang_id' => $id_jenjang
                                        ])->get();
        }elseif ($id_pangkat == 0 && $id_jenis_jabatan == 0 && $id_unit == 0 && $id_jenjang != 0) {
          $filterpegawai = $data->where(['riwayat_pendidikans.jenjang_id' => $id_jenjang
                                        ])->get();
        }elseif ($id_pangkat != 0 && $id_jenis_jabatan == 0 && $id_unit != 0 && $id_jenjang != 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.pangkat_id' => $id_pangkat,
                                         'pegawais.unit_id' => $id_unit,
                                         'riwayat_pendidikans.jenjang_id' => $id_jenjang
                                        ])->get();
        }elseif ($id_pangkat == 0 && $id_jenis_jabatan == 0 && $id_unit != 0 && $id_jenjang != 0) {
          $filterpegawai = $data->where(['pegawais.unit_id' => $id_unit,
                                         'riwayat_pendidikans.jenjang_id' => $id_jenjang
                                        ])->get();
        }elseif ($id_pangkat == 0 && $id_jenis_jabatan == 0 && $id_unit != 0 && $id_jenjang == 0) {
          $filterpegawai = $data->where(['pegawais.unit_id' => $id_unit
                                        ])->get();
        }elseif ($id_pangkat == 0 && $id_jenis_jabatan != 0 && $id_unit != 0 && $id_jenjang != 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan,
                                         'pegawais.unit_id' => $id_unit,
                                         'riwayat_pendidikans.jenjang_id' => $id_jenjang
                                        ])->get();
        }elseif ($id_pangkat == 0 && $id_jenis_jabatan != 0 && $id_unit != 0 && $id_jenjang == 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan,
                                         'pegawais.unit_id' => $id_unit
                                        ])->get();
        }elseif ($id_pangkat == 0 && $id_jenis_jabatan != 0 && $id_unit == 0 && $id_jenjang == 0) {
          $filterpegawai = $data->where(['riwayat_jabatans.jenis_jabatan_id' => $id_jenis_jabatan
                                        ])->get();
        }else{
          $filterpegawai = $data->get();
        }

        $datatables = Datatables::of($filterpegawai);

        // $datatables->addColumn('action', function($filterpegawai){
        //   return '<a onclick="viewRiwayatDiklat('. $filterpegawai->pegawai_id .')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Lihat Diklat</a> ';
        // });

        $datatables->addColumn('action', function($filterpegawai){
          return '<td width="30px;"><input type="checkbox" name="ids[]" class="selectbox" value="'. $filterpegawai->pegawai_id .'"></td>';
        });
        return $datatables->make(true);
    }
}
