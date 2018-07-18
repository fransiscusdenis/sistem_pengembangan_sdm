<?php

namespace App\Http\Controllers;

use DB;
use App\Eselon;
use App\Pegawai;
use App\RiwayatEselon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class RiwayatEselonController extends Controller
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
      $riwayateselon = RiwayatEselon::all();
      $pegawai = Pegawai::all();
      $eselon = Eselon::all();

      return view('riwayateselon/index', [
        'label'=> 'Riwayat Eselon',
        'riwayatpangkat' => $riwayateselon,
        'pegawai' => $pegawai,
        'eselon' => $eselon,
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
        'eselon_id' => $request['eselon_id'],
        'jabatan' => $request['jabatan']
      ];

      $riwayateselon = RiwayatEselon::create($data);

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
      $riwayateselon  = RiwayatEselon::find($id);
      return $riwayateselon;
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
      $riwayateselon = RiwayatEselon::find($id);
      $riwayateselon->pegawai_id = $request['pegawai_id'];
      $riwayateselon->eselon_id = $request['eselon_id'];
      $riwayateselon->jabatan = $request['jabatan'];
      $riwayateselon->update();

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
        RiwayatEselon::destroy($id);
    }

    public function apiRiwayatEselon(Request $request)
    {
        //$riwayatpangkat = RiwayatEselon::all();
        $riwayatdiklat = DB::table('riwayat_eselons')
                          ->join('eselons', 'riwayat_eselons.eselon_id', '=', 'eselons.id')
                          ->join('pegawais', 'riwayat_eselons.pegawai_id', '=', 'pegawais.id')
                          ->select('riwayat_eselons.*', 'eselons.eselon', 'pegawais.nip', 'pegawais.nama')
                          ->get();

        $datatables = Datatables::of($riwayatdiklat);

        $datatables->addColumn('action', function($riwayatdiklat){
          return '<a onclick="editForm('. $riwayatdiklat->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $riwayatdiklat->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }
}
