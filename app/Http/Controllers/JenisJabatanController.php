<?php

namespace App\Http\Controllers;

use DB;
use App\JenisJabatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class JenisJabatanController extends Controller
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
      $jenisjabatan = JenisJabatan::all();
      return view('jenisjabatan/index', ['label'=> 'JenisJabatan', 'jenisjabatan' => $jenisjabatan]);

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
        'jenis_jabatan' => $request['jenis_jabatan']
      ];

      $jenisjabatan = JenisJabatan::create($data);

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
      $jenisjabatan  = JenisJabatan::find($id);
      return $jenisjabatan;
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
      $jenisjabatan = JenisJabatan::find($id);
      $jenisjabatan->jenis_jabatan = $request['jenis_jabatan'];
      $jenisjabatan->update();

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
        JenisJabatan::destroy($id);
    }

    public function apiJenisJabatan(Request $request)
    {
        $jenisjabatan = JenisJabatan::all();

        $datatables = Datatables::of($jenisjabatan);

        $datatables->addColumn('action', function($jenisjabatan){
          return '<a onclick="editForm('. $jenisjabatan->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $jenisjabatan->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }
}
