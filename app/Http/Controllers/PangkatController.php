<?php

namespace App\Http\Controllers;

use DB;
use App\Pangkat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PangkatController extends Controller
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
      $pangkat = Pangkat::all();
      return view('pangkat/index', ['label'=> 'Pangkat', 'pangkat' => $pangkat]);
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
        'nama_pangkat' => $request['nama_pangkat'],
        'jenis_pangkat' => $request['jenis_pangkat'],
        'pangkat' => $request['pangkat'],
        'golongan' => $request['golongan'],
        'ruang' => $request['ruang'],
        'prioritas' => $request['prioritas']
      ];

      $pangkat = Pangkat::create($data);

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
      $pangkat  = Pangkat::find($id);
      return $pangkat;
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
      $pangkat = Pangkat::find($id);
      $pangkat->nama_pangkat = $request['nama_pangkat'];
      $pangkat->jenis_pangkat = $request['jenis_pangkat'];
      $pangkat->pangkat = $request['pangkat'];
      $pangkat->golongan = $request['golongan'];
      $pangkat->ruang = $request['ruang'];
      $pangkat->prioritas = $request['prioritas'];
      $pangkat->update();

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
        Pangkat::destroy($id);
    }

    public function apiPangkat(Request $request)
    {
        $pangkat = Pangkat::all();

        $datatables = Datatables::of($pangkat);

        $datatables->addColumn('action', function($pangkat){
          return '<a onclick="editForm('. $pangkat->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $pangkat->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }
}
