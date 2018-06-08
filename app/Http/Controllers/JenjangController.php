<?php

namespace App\Http\Controllers;

use DB;
use App\Jenjang;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       $jenjang = Jenjang::all();
       return view('jenjang/index', ['label'=> 'Jenjang', 'jenjang' => $jenjang]);
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
         'nama_jenjang' => $request['nama_jenjang']
       ];

       $jenjang = Jenjang::create($data);

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
       $jenjang  = Jenjang::find($id);
       return $jenjang;
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
       $jenjang = Jenjang::find($id);
       $jenjang->nama_jenjang = $request['nama_jenjang'];
       $jenjang->update();

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
         Jenjang::destroy($id);
     }

     public function apiJenjang(Request $request)
     {
         $jenjang = Jenjang::all();

         $datatables = Datatables::of($jenjang);

         $datatables->addColumn('action', function($jenjang){
           return '<a onclick="editForm('. $jenjang->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
           '<a onclick="deleteData('. $jenjang->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
         });
         return $datatables->make(true);
     }
 }
