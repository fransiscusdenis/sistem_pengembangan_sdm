<?php

namespace App\Http\Controllers;

use DB;
use App\StatusPerkawinan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class StatusPerkawinanController extends Controller
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
      $statusperkawinan = StatusPerkawinan::all();
      return view('statusperkawinan/index', ['label'=> 'Status Perkawinan', 'statusperkawinan' => $statusperkawinan]);
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
        'status_perkawinan' => $request['status_perkawinan']
      ];

      $statusperkawinan = StatusPerkawinan::create($data);

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
      $statusperkawinan  = StatusPerkawinan::find($id);
      return $statusperkawinan;
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
      $statusperkawinan = StatusPerkawinan::find($id);
      $statusperkawinan->status_perkawinan = $request['status_perkawinan'];
      $statusperkawinan->update();

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
        StatusPerkawinan::destroy($id);
    }

    public function apiStatusPerkawinan(Request $request)
    {
        $statusperkawinan = StatusPerkawinan::all();

        $datatables = Datatables::of($statusperkawinan);

        $datatables->addColumn('action', function($statusperkawinan){
          return '<a onclick="editForm('. $statusperkawinan->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $statusperkawinan->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }
}
