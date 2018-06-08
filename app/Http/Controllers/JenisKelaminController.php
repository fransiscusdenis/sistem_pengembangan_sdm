<?php

namespace App\Http\Controllers;

use DB;
use App\JenisKelamin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class JenisKelaminController extends Controller
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
      $jeniskelamin = JenisKelamin::all();
      return view('jeniskelamin/index', ['label'=> 'JenisKelamin', 'jeniskelamin' => $jeniskelamin]);

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
        'jenis_kelamin' => $request['jenis_kelamin'],
        'kode' => $request['kode']
      ];

      $jeniskelamin = JenisKelamin::create($data);

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
      $jeniskelamin  = JenisKelamin::find($id);
      return $jeniskelamin;
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
      $jeniskelamin = JenisKelamin::find($id);
      $jeniskelamin->jenis_kelamin = $request['jenis_kelamin'];
      $jeniskelamin->kode = $request['kode'];
      $jeniskelamin->update();

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
        JenisKelamin::destroy($id);
    }

    public function apiJenisKelamin(Request $request)
    {
        $jeniskelamin = JenisKelamin::all();

        $datatables = Datatables::of($jeniskelamin);

        $datatables->addColumn('action', function($jeniskelamin){
          return '<a onclick="editForm('. $jeniskelamin->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $jeniskelamin->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }
}
