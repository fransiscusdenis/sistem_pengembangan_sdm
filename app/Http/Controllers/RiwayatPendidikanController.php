<?php

namespace App\Http\Controllers;

use DB;
use App\Jenjang;
use App\Pegawai;
use App\RiwayatPendidikan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class RiwayatPendidikanController extends Controller
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
      $riwayatpendidikan = RiwayatPendidikan::all();
      $jenjang = Jenjang::all();
      $pegawai = Pegawai::all();

      return view('riwayatpendidikan/index', [
        'label'=> 'RiwayatPendidikan',
        'riwayatpendidikan' => $riwayatpendidikan,
        'jenjang'=> $jenjang,
        'pegawai'=> $pegawai,
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
        'jenjang_id' => $request['jenjang_id'],
        'nama_sekolah' => $request['nama_sekolah'],
        'prodi' => $request['prodi'],
        'tahun_lulus' => $request['tahun_lulus']
      ];

      $riwayatpendidikan = RiwayatPendidikan::create($data);

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
      $riwayatpendidikan  = RiwayatPendidikan::find($id);
      return $riwayatpendidikan;
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
      $riwayatpendidikan = RiwayatPendidikan::find($id);
      $riwayatpendidikan->pegawai_id = $request['pegawai_id'];
      $riwayatpendidikan->jenjang_id = $request['jenjang_id'];
      $riwayatpendidikan->nama_sekolah = $request['nama_sekolah'];
      $riwayatpendidikan->prodi = $request['prodi'];
      $riwayatpendidikan->tahun_lulus = $request['tahun_lulus'];
      $riwayatpendidikan->update();

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
        RiwayatPendidikan::destroy($id);
    }

    public function apiRiwayatPendidikan(Request $request)
    {
        //$riwayatpendidikan = RiwayatPendidikan::all();
        $riwayatpendidikan = DB::table('riwayat_pendidikans')
                            ->join('jenjangs', 'riwayat_pendidikans.jenjang_id', '=', 'jenjangs.id')
                            ->join('pegawais', 'riwayat_pendidikans.pegawai_id', '=', 'pegawais.id')
                            ->select('riwayat_pendidikans.*', 'jenjangs.nama_jenjang', 'pegawais.nip', 'pegawais.nama')
                            ->get();

        $datatables = Datatables::of($riwayatpendidikan);

        $datatables->addColumn('action', function($riwayatpendidikan){
          return '<a onclick="editForm('. $riwayatpendidikan->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $riwayatpendidikan->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }
}
