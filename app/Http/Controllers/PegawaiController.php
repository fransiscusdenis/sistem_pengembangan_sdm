<?php

namespace App\Http\Controllers;

use DB;
use App\JenisKelamin;
use App\Agama;
use App\StatusPerkawinan;
use App\StatusPegawai;
use App\StatusHukum;
use App\Unit;
use App\RiwayatPendidikan;
use App\Jenjang;
use App\Pangkat;
use App\Jabatan;
use App\JenisJabatan;
use App\RiwayatJabatan;
use App\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PegawaiController extends Controller
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
      $pegawai = Pegawai::all();
      $jeniskelamin = JenisKelamin::all();
      $agama = Agama::all();
      $statusperkawinan = StatusPerkawinan::all();
      $statuspegawai = StatusPegawai::all();
      $statushukum = StatusHukum::all();
      $unit = Unit::all();

      return view('pegawai/index', [
        'label'=> 'Pegawai',
        'pegawai' => $pegawai,
        'jeniskelamin' => $jeniskelamin,
        'agama' => $agama,
        'statusperkawinan' => $statusperkawinan,
        'statuspegawai' => $statuspegawai,
        'statushukum' => $statushukum,
        'unit' => $unit,
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
        'nip' => $request['nip'],
        'nama' => $request['nama'],
        'tempat_lahir' => $request['tempat_lahir'],
        'tanggal_lahir' => $request['tanggal_lahir'],
        'jenis_kelamin_id' => $request['jenis_kelamin_id'],
        'alamat' => $request['alamat'],
        'kabupaten' => $request['kabupaten'],
        'provinsi' => $request['provinsi'],
        'agama_id' => $request['agama_id'],
        'status_perkawinan_id' => $request['status_perkawinan_id'],
        'status_pegawai_id' => $request['status_pegawai_id'],
        'status_hukum_id' => $request['status_hukum_id'],
        'unit_id' => $request['unit_id'],
        'unit_kerja' => $request['unit_kerja'],
        'skpd' => $request['skpd'],
        'tmt_pensiun' => $request['tmt_pensiun']
      ];

      $pegawai = Pegawai::create($data);

      return response()->json(['pegawai' => $pegawai, 'message' => 'Berhasil Menambahkan Data!']);
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
      $pegawai  = Pegawai::find($id);
      return $pegawai;
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
      $pegawai = Pegawai::find($id);
      $pegawai->nip = $request['nip'];
      $pegawai->nama = $request['nama'];
      $pegawai->tempat_lahir = $request['tempat_lahir'];
      $pegawai->tanggal_lahir = $request['tanggal_lahir'];
      $pegawai->alamat = $request['alamat'];
      $pegawai->kabupaten = $request['kabupaten'];
      $pegawai->provinsi = $request['provinsi'];
      $pegawai->jenis_kelamin_id = $request['jenis_kelamin_id'];
      $pegawai->agama_id = $request['agama_id'];
      $pegawai->status_perkawinan_id = $request['status_perkawinan_id'];
      $pegawai->status_pegawai_id = $request['status_pegawai_id'];
      $pegawai->status_hukum_id = $request['status_hukum_id'];
      $pegawai->unit_id = $request['unit_id'];
      $pegawai->unit_kerja = $request['unit_kerja'];
      $pegawai->skpd = $request['skpd'];
      $pegawai->tmt_pensiun = $request['tmt_pensiun'];
      $pegawai->update();

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
        Pegawai::destroy($id);
    }

    public function apiPegawai(Request $request)
    {
        //$pegawai = Pegawai::all();
        $pegawai = DB::table('pegawais')
                          ->join('jenis_kelamins', 'pegawais.jenis_kelamin_id', '=', 'jenis_kelamins.id')
                          ->join('agamas', 'pegawais.agama_id', '=', 'agamas.id')
                          ->join('status_perkawinans', 'pegawais.status_perkawinan_id', '=', 'status_perkawinans.id')
                          ->join('status_pegawais', 'pegawais.status_pegawai_id', '=', 'status_pegawais.id')
                          ->join('status_hukums', 'pegawais.status_hukum_id', '=', 'status_hukums.id')
                          ->join('units', 'pegawais.unit_id', '=', 'units.id')
                          ->select('pegawais.*', 'jenis_kelamins.jenis_kelamin',
                                   'agamas.nama_agama', 'status_perkawinans.status_perkawinan',
                                   'status_pegawais.status_pegawai', 'status_hukums.status_hukum',
                                   'units.nama_unit')
                          ->get();

        $datatables = Datatables::of($pegawai);

        $datatables->addColumn('action', function($pegawai){
          $view = route('pegawai.view', ['id'=>$pegawai->id]);

          return '<a href="'.$view.'" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-eye-open"></i> View</a> ' .
          // '<a onclick="editForm('. $pegawai->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $pegawai->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }

    public function apiRiwayatPendidikan(Request $request, $id)
    {
      //$riwayatpendidikan = RiwayatPendidikan::all();
      $riwayatpendidikan = DB::table('riwayat_pendidikans')
      ->join('jenjangs', 'riwayat_pendidikans.jenjang_id', '=', 'jenjangs.id')
      ->join('pegawais', 'riwayat_pendidikans.pegawai_id', '=', 'pegawais.id')
      ->select('riwayat_pendidikans.*', 'jenjangs.nama_jenjang', 'pegawais.nip', 'pegawais.nama')
      ->where('pegawai_id', '=', $id)
      ->get();

      $datatables = Datatables::of($riwayatpendidikan);

      $datatables->addColumn('action', function($riwayatpendidikan){
        return '<a onclick="editFormRiwayatPendidikan('. $riwayatpendidikan->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
        '<a onclick="deleteDataRiwayatPendidikan('. $riwayatpendidikan->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
      });
      return $datatables->make(true);
    }

    public function apiRiwayatPangkat(Request $request, $id)
    {
        //$riwayatpangkat = RiwayatPangkat::all();
        $riwayatpangkat = DB::table('riwayat_pangkats')
                          ->join('pangkats', 'riwayat_pangkats.pangkat_id', '=', 'pangkats.id')
                          ->join('pegawais', 'riwayat_pangkats.pegawai_id', '=', 'pegawais.id')
                          ->select('riwayat_pangkats.*', 'pangkats.nama_pangkat', 'pegawais.nip', 'pegawais.nama')
                          ->where('pegawai_id', '=', $id)
                          ->get();

        $datatables = Datatables::of($riwayatpangkat);

        $datatables->addColumn('action', function($riwayatpangkat){
          return '<a onclick="editFormRiwayatPangkat('. $riwayatpangkat->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteDataRiwayatPangkat('. $riwayatpangkat->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }

    public function apiRiwayatJabatan(Request $request, $id)
    {
      //$riwayatjabatan = RiwayatJabatan::all();
      $riwayatjabatan = DB::table('riwayat_jabatans')
      ->join('pangkats', 'riwayat_jabatans.pangkat_id', '=', 'pangkats.id')
      // ->join('jabatans', 'riwayat_jabatans.jabatan_id', '=', 'jabatans.id')
      ->join('jenis_jabatans', 'riwayat_jabatans.jenis_jabatan_id', '=', 'jenis_jabatans.id')
      ->join('pegawais', 'riwayat_jabatans.pegawai_id', '=', 'pegawais.id')
      ->select('riwayat_jabatans.*', 'pangkats.nama_pangkat', 'jenis_jabatans.jenis_jabatan', 'pegawais.nip', 'pegawais.nama')
      ->where('pegawai_id', '=', $id)
      ->get();

      $datatables = Datatables::of($riwayatjabatan);

      $datatables->addColumn('action', function($riwayatjabatan){
        return '<a onclick="editFormRiwayatJabatan('. $riwayatjabatan->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
        '<a onclick="deleteDataRiwayatJabatan('. $riwayatjabatan->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
      });
      return $datatables->make(true);
    }

    public function viewPegawai($id)
    {
      $jeniskelamin = JenisKelamin::all();
      $agama = Agama::all();
      $statusperkawinan = StatusPerkawinan::all();
      $statushukum = StatusHukum::all();
      $statuspegawai = StatusPegawai::all();
      $unit = Unit::all();
      $riwayatpendidikan = RiwayatPendidikan::all();
      $jenjang = Jenjang::all();
      $riwayatjabatan = RiwayatJabatan::all();
      $jabatan = Jabatan::all();
      $jenisjabatan = JenisJabatan::all();
      $pangkat = Pangkat::all();
      $pegawaifind = Pegawai::find($id);

      $pegawai = DB::select(DB::raw(
        "SELECT * FROM pegawais p, jenis_kelamins jk, agamas a, status_pegawais speg,
         status_hukums sh, status_perkawinans sp, units u
         WHERE p.id=$id
         AND jk.id = p.jenis_kelamin_id
         AND a.id = p.agama_id
         AND speg.id = p.status_pegawai_id
         AND sh.id = p.status_hukum_id
         AND sp.id = p.status_perkawinan_id
         AND u.id = p.unit_id"
      ));

      return view('pegawai.view', [
        'label'=> 'DataPegawai',
        'riwayatpendidikan' => $riwayatpendidikan,
        'jenjang' => $jenjang,
        'agama' => $agama,
        'statuspegawai' => $statuspegawai,
        'statusperkawinan' => $statusperkawinan,
        'statushukum' => $statushukum,
        'unit' => $unit,
        'riwayatjabatan' => $riwayatjabatan,
        'jabatan' => $jabatan,
        'jeniskelamin' => $jeniskelamin,
        'jenisjabatan' => $jenisjabatan,
        'pangkat' => $pangkat,
        'pegawai'=> $pegawai,
        'pegawaifind' => $pegawaifind,
        'id' => $id,
      ]);


    }
}
