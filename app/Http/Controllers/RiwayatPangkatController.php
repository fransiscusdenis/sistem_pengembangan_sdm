<?php

namespace App\Http\Controllers;

use DB;
use App\Pangkat;
use App\Pegawai;
use App\RiwayatPangkat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class RiwayatPangkatController extends Controller
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
      $riwayatpangkat = RiwayatPangkat::all();
      $pegawai = Pegawai::all();
      $pangkat = Pangkat::all();

      return view('riwayatpangkat/index', [
        'label'=> 'RiwayatPangkat',
        'riwayatpangkat' => $riwayatpangkat,
        'pegawai' => $pegawai,
        'pangkat' => $pangkat,
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
        'tmt_pangkat' => $request['tmt_pangkat']
      ];

      $riwayatpangkat = RiwayatPangkat::create($data);

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
      $riwayatpangkat  = RiwayatPangkat::find($id);
      return $riwayatpangkat;
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
      $riwayatpangkat = RiwayatPangkat::find($id);
      $riwayatpangkat->pegawai_id = $request['pegawai_id'];
      $riwayatpangkat->pangkat_id = $request['pangkat_id'];
      $riwayatpangkat->tmt_pangkat = $request['tmt_pangkat'];
      $riwayatpangkat->update();

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
        RiwayatPangkat::destroy($id);
    }

    public function apiRiwayatPangkat(Request $request)
    {
        //$riwayatpangkat = RiwayatPangkat::all();
        $riwayatpangkat = DB::table('riwayat_pangkats')
                          ->join('pangkats', 'riwayat_pangkats.pangkat_id', '=', 'pangkats.id')
                          ->join('pegawais', 'riwayat_pangkats.pegawai_id', '=', 'pegawais.id')
                          ->select('riwayat_pangkats.*', DB::raw('DATE_FORMAT(tmt_pangkat, "%m/%d/%Y") as tmt_pangkat'), 'pangkats.nama_pangkat', 'pegawais.nip', 'pegawais.nama')
                          ->get();

        $datatables = Datatables::of($riwayatpangkat);

        $datatables->addColumn('action', function($riwayatpangkat){
          return '<a onclick="editForm('. $riwayatpangkat->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $riwayatpangkat->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }
}
