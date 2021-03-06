<?php

namespace App\Http\Controllers;

use DB;
use App\Pegawai;
use App\RiwayatDiklat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class RiwayatDiklatController extends Controller
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
      $riwayatdiklat = RiwayatDiklat::all();
      $pegawai = Pegawai::all();

      return view('riwayatdiklat/index', [
        'label'=> 'RiwayatDiklat',
        'riwayatdiklat' => $riwayatdiklat,
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
        'nama_diklat' => $request['nama_diklat'],
        'no_sertifikat' => $request['no_sertifikat'],
        'tgl_sertifikat' => $request['tgl_sertifikat'],
        'peran' => $request['peran']
      ];

      $riwayatdiklat = RiwayatDiklat::create($data);

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
      $riwayatdiklat  = RiwayatDiklat::find($id);
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
      $riwayatdiklat = RiwayatDiklat::find($id);
      $riwayatdiklat->pegawai_id = $request['pegawai_id'];
      $riwayatdiklat->nama_diklat = $request['nama_diklat'];
      $riwayatdiklat->no_sertifikat = $request['no_sertifikat'];
      $riwayatdiklat->tgl_sertifikat = $request['tgl_sertifikat'];
      $riwayatdiklat->peran = $request['peran'];
      $riwayatdiklat->update();

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
        RiwayatDiklat::destroy($id);
    }

    public function apiRiwayatDiklat(Request $request)
    {
        //$riwayatdiklat = RiwayatDiklat::all();
        $riwayatdiklat = DB::table('riwayat_diklats')
                          ->join('pegawais', 'riwayat_diklats.pegawai_id', '=', 'pegawais.id')
                          ->select('riwayat_diklats.*', DB::raw('DATE_FORMAT(tgl_sertifikat, "%m/%d/%Y") as tgl_sertifikat'), 'pegawais.nip', 'pegawais.nama')
                          // ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat II ('.'%')
                          // ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat III'.'%')
                          // ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat IV'.'%')
                          ->get();

        $datatables = Datatables::of($riwayatdiklat);

        $datatables->addColumn('action', function($riwayatdiklat){
          return '<a onclick="editForm('. $riwayatdiklat->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $riwayatdiklat->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }
}
