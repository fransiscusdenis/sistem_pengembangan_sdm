<?php

namespace App\Http\Controllers;

use DB;
use App\StatusPegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class StatusPegawaiController extends Controller
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
      $statuspegawai = StatusPegawai::all();
      return view('statuspegawai/index', ['label'=> 'Status Pegawai', 'statuspegawai' => $statuspegawai]);
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
        'status_pegawai' => $request['status_pegawai']
      ];

      $statuspegawai = StatusPegawai::create($data);

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
      $statuspegawai  = StatusPegawai::find($id);
      return $statuspegawai;
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
      $statuspegawai = StatusPegawai::find($id);
      $statuspegawai->status_pegawai = $request['status_pegawai'];
      $statuspegawai->update();

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
      StatusPegawai::destroy($id);
    }

    public function apiStatusPegawai(Request $request)
    {
        $statuspegawai = StatusPegawai::all();

        $datatables = Datatables::of($statuspegawai);

        $datatables->addColumn('action', function($statuspegawai){
          return '<a onclick="editForm('. $statuspegawai->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $statuspegawai->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }
}
