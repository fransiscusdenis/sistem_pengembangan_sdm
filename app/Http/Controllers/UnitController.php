<?php

namespace App\Http\Controllers;

use DB;
use App\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;



class UnitController extends Controller
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
        $unit = Unit::all();
        return view('unit/index', ['label'=> 'Unit', 'unit' => $unit]);
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
          'kode_unit' => $request['kode_unit'],
          'nama_unit' => $request['nama_unit']
        ];

        $unit = Unit::create($data);

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
        $unit  = Unit::find($id);
        return $unit;
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
        $unit = Unit::find($id);
        $unit->kode_unit = $request['kode_unit'];
        $unit->nama_unit = $request['nama_unit'];
        $unit->update();

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
        Unit::destroy($id);
    }

    public function apiUnit(Request $request)
    {
        $unit = Unit::all();
        // DB::statement(DB::raw('set @rownum=0'));
        // $unit = Unit::select([
        //     DB::raw('@rownum  := @rownum  + 1 AS rownum'),
        //     'id',
        //     'kode_unit',
        //     'nama_unit']);

        $datatables = Datatables::of($unit);

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        $datatables->addColumn('action', function($unit){
          return '<a onclick="editForm('. $unit->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $unit->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }

}
