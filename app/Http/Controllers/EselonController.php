<?php

namespace App\Http\Controllers;

use DB;
use App\Pangkat;
use App\Eselon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class EselonController extends Controller
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
      $eselon = Eselon::all();
      $pangkat = Pangkat::all();

      return view('eselon/index', [
        'label'=> 'Eselon',
        'eselon' => $eselon,
        'pangkat' => $pangkat]);
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
        'eselon' => $request['eselon'],
        'pangkat_tertinggi' => $request['pangkat_tertinggi'],
        'pangkat_terendah' => $request['pangkat_terendah']
      ];

      $eselon = Eselon::create($data);

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
      $eselon  = Eselon::find($id);
      return $eselon;
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
      $eselon = Eselon::find($id);
      $eselon->eselon = $request['eselon'];
      $eselon->pangkat_tertinggi = $request['pangkat_tertinggi'];
      $eselon->pangkat_terendah = $request['pangkat_terendah'];
      $eselon->update();

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
        Eselon::destroy($id);
    }

    public function apiEselon(Request $request)
    {
        //$eselon = Eselon::all();
        $eselon = DB::table('eselons')
                          //->join('pangkats', 'eselons.pangkat_tertinggi', '=', 'pangkats.id')
                          ->select('eselons.*')
                          ->get();

        $datatables = Datatables::of($eselon);

        $datatables->addColumn('action', function($eselon){
          return '<a onclick="editForm('. $eselon->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $eselon->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }

}
