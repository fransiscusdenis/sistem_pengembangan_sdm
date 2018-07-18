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
use App\Eselon;
use App\Jabatan;
use App\JenisJabatan;
use App\RiwayatJabatan;
use App\RiwayatDiklat;
use App\RiwayatPangkat;
use App\RiwayatEselon;
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
      //$ambil_unit = $request->get('unit_id');
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

    public function apiPegawai(Request $request, $id = 0)
    {
        //$pegawai = Pegawai::all();
        $data = DB::table('pegawais')
                          ->join('jenis_kelamins', 'pegawais.jenis_kelamin_id', '=', 'jenis_kelamins.id')
                          ->join('agamas', 'pegawais.agama_id', '=', 'agamas.id')
                          ->join('status_perkawinans', 'pegawais.status_perkawinan_id', '=', 'status_perkawinans.id')
                          ->join('status_pegawais', 'pegawais.status_pegawai_id', '=', 'status_pegawais.id')
                          ->join('status_hukums', 'pegawais.status_hukum_id', '=', 'status_hukums.id')
                          ->join('units', 'pegawais.unit_id', '=', 'units.id')
                          ->select('pegawais.*', 'jenis_kelamins.jenis_kelamin',
                                   'agamas.nama_agama', 'status_perkawinans.status_perkawinan',
                                   'status_pegawais.status_pegawai', 'status_hukums.status_hukum',
                                   'units.nama_unit');

        if ($id != 0) {
          $pegawai = $data->where(['pegawais.unit_id' => $id,
                          ])->get();
        }else{
          $pegawai = $data->get();
        }

        $datatables = Datatables::of($pegawai);

        $datatables->addColumn('action', function($pegawai){
          $view = route('pegawai.view', ['id'=>$pegawai->id]);

          return '<a href="'.$view.'" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Profil</a> ' .
          // '<a onclick="editForm('. $pegawai->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $pegawai->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }

    public function apiDataPegawai(Request $request, $id)
    {
      $pegawai = DB::table('pegawais')
                        ->select('pegawais.*')
                        ->where('id', '=', $id)
                        ->get();

      $datatables = Datatables::of($pegawai);

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
                          ->select('riwayat_pangkats.*',  DB::raw('DATE_FORMAT(tmt_pangkat, "%m/%d/%Y") as tmt_pangkat'), 'pangkats.nama_pangkat', 'pegawais.nip', 'pegawais.nama')
                          ->where('pegawai_id', '=', $id)
                          ->get();

        $datatables = Datatables::of($riwayatpangkat);

        $datatables->addColumn('action', function($riwayatpangkat){
          return '<a onclick="editFormRiwayatPangkat('. $riwayatpangkat->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteDataRiwayatPangkat('. $riwayatpangkat->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }

    public function apiRiwayatEselon(Request $request, $id)
    {
        //$riwayatpangkat = RiwayatPangkat::all();
        $riwayateselon = DB::table('riwayat_eselons')
                          ->join('eselons', 'riwayat_eselons.eselon_id', '=', 'eselons.id')
                          ->join('pegawais', 'riwayat_eselons.pegawai_id', '=', 'pegawais.id')
                          ->select('riwayat_eselons.*', 'eselons.eselon', 'pegawais.nip', 'pegawais.nama')
                          ->where('pegawai_id', '=', $id)
                          ->get();

        $datatables = Datatables::of($riwayateselon);

        $datatables->addColumn('action', function($riwayateselon){
          return '<a onclick="editFormRiwayatEselon('. $riwayateselon->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteDataRiwayatEselon('. $riwayateselon->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
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
      ->select('riwayat_jabatans.*', DB::raw('DATE_FORMAT(tmt_jabatan, "%m/%d/%Y") as tmt_jabatan'), 'pangkats.nama_pangkat', 'jenis_jabatans.jenis_jabatan', 'pegawais.nip', 'pegawais.nama')
      ->where('pegawai_id', '=', $id)
      ->get();

      $datatables = Datatables::of($riwayatjabatan);

      $datatables->addColumn('action', function($riwayatjabatan){
        return '<a onclick="editFormRiwayatJabatan('. $riwayatjabatan->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
        '<a onclick="deleteDataRiwayatJabatan('. $riwayatjabatan->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
      });
      return $datatables->make(true);
    }

    public function apiRiwayatDiklat(Request $request, $id)
    {
      //$riwayatjabatan = RiwayatJabatan::all();
      $riwayatdiklat = DB::table('riwayat_diklats')
      ->join('pegawais', 'riwayat_diklats.pegawai_id', '=', 'pegawais.id')
      ->select('riwayat_diklats.*', DB::raw('DATE_FORMAT(tgl_sertifikat, "%m/%d/%Y") as tgl_sertifikat'), 'pegawais.nip', 'pegawais.nama')
      ->where('pegawai_id', '=', $id)
      ->get();

      $datatables = Datatables::of($riwayatdiklat);

      $datatables->addColumn('action', function($riwayatdiklat){
        return '<a onclick="editFormRiwayatDiklat('. $riwayatdiklat->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
        '<a onclick="deleteDataRiwayatDiklat('. $riwayatdiklat->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
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
      $eselon = Eselon::all();
      $pegawaifind = Pegawai::find($id);

      $pegawai = DB::select(DB::raw(
        "SELECT *, DATE_FORMAT(tanggal_lahir, '%m/%d/%Y') as tanggal_lahir, DATE_FORMAT(tmt_pensiun, '%m/%d/%Y') as tmt_pensiun FROM pegawais p, jenis_kelamins jk, agamas a, status_pegawais speg,
         status_hukums sh, status_perkawinans sp, units u
         WHERE p.id=$id
         AND jk.id = p.jenis_kelamin_id
         AND a.id = p.agama_id
         AND speg.id = p.status_pegawai_id
         AND sh.id = p.status_hukum_id
         AND sp.id = p.status_perkawinan_id
         AND u.id = p.unit_id"
      ));

      // dd($pegawai);

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
        'eselon' => $eselon,
        'pegawai'=> $pegawai,
        'pegawaifind' => $pegawaifind,
        'id' => $id,
      ]);

    }

    public function apiDiklatPIM2(Request $request)
    {
        //$riwayatdiklat = RiwayatDiklat::all();
        $riwayatdiklat = DB::table('pegawais')
                          ->join('pegawais', 'riwayat_diklats.pegawai_id', '=', 'pegawais.id')
                          ->select('riwayat_diklats.*', DB::raw('DATE_FORMAT(tgl_sertifikat, "%m/%d/%Y") as tgl_sertifikat'), 'pegawais.nip', 'pegawais.nama')
                          // ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat II ('.'%')
                          // ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat III'.'%')
                          // ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat IV'.'%')
                          ->get();

        $datatables = Datatables::of($riwayatdiklat);

        $datatables->addColumn('action', function($riwayatdiklat){
          return '<a onclick="editForm('. $riwayatdiklat->id .')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
          '<a onclick="deleteData('. $riwayatdiklat->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
        });
        return $datatables->make(true);
    }

    public function apiUsulanDiklatPim4(Request $request)
    {
        //$riwayatdiklat = RiwayatDiklat::all();
        $pegawai_exclude = DB::table('pegawais')
                          ->join('riwayat_diklats', 'pegawais.id', '=', 'riwayat_diklats.pegawai_id')
                          // ->join('riwayat_pendidikans', 'pegawais.id', '=', 'riwayat_pendidikans.pegawai_id')
                          // ->join('riwayat_jabatans', 'pegawais.id', '=', 'riwayat_jabatans.pegawai_id')
                          // ->join('jenis_jabatans', 'riwayat_jabatans.jenis_jabatan_id', '=', 'jenis_jabatans.id')
                          // ->join('pangkats', 'riwayat_jabatans.pangkat_id', '=', 'pangkats.id')
                          // ->join('jenjangs', 'riwayat_pendidikans.jenjang_id', '=', 'jenjangs.id')
                          ->select('pegawais.id')
                          // ->where('riwayat_pendidikans.jenjang_id', '<', 6)
                          // ->where('riwayat_jabatans.pangkat_id', '<', 9)
                          // ->where('riwayat_jabatans.jenis_jabatan_id', '=', 1)
                          // ->orWhere('riwayat_jabatans.jenis_jabatan_id', '=', 3)
                          ->where('riwayat_diklats.nama_diklat', 'like', '%'.'PIM Tingkat II'.'%')
                          ->orWhere('riwayat_diklats.nama_diklat', 'like', '%'.'PIM Tingkat III'.'%')
                          ->orWhere('riwayat_diklats.nama_diklat', 'like', '%'.'PIM Tingkat IV'.'%')
                          ->distinct()
                          ->get();

        $index_p = [];
        foreach ($pegawai_exclude as $value) {
          array_push($index_p, $value->id);
        }

        // dd($index_p);
        // die();

        $a = DB::table('pegawais')
                          ->select('pegawais.id')
                          ->whereNotIn('pegawais.id', $index_p)
                          ->get();

        $index_p1 = [];
        foreach ($a as $value) {
          array_push($index_p1, $value->id);
        }

        // dd($index_p1);
        // die();

        $pegawai = DB::table('pegawais')
                          // ->join('riwayat_diklats', 'pegawais.id', '=', 'riwayat_diklats.pegawai_id')
                          ->join('riwayat_jabatans', 'pegawais.id', '=', 'riwayat_jabatans.pegawai_id')
                          ->join('riwayat_pendidikans', 'pegawais.id', '=', 'riwayat_pendidikans.pegawai_id')
                          ->join('jenis_jabatans', 'riwayat_jabatans.jenis_jabatan_id', '=', 'jenis_jabatans.id')
                          ->join('pangkats', 'riwayat_jabatans.pangkat_id', '=', 'pangkats.id')
                          ->join('jenjangs', 'riwayat_pendidikans.jenjang_id', '=', 'jenjangs.id')
                          // ->join('riwayat_eselons', 'pegawais.id', '=', 'riwayat_eselons.pegawai_id')
                          // ->join('eselons', 'riwayat_eselons.eselon_id', '=', 'eselons.id')
                          // ->select('pegawais.*', 'pangkats.nama_pangkat', 'jenjangs.nama_jenjang', 'jenis_jabatans.jenis_jabatan', 'riwayat_jabatans.jabatan')
                          // ->select('pegawais.*', 'pangkats.nama_pangkat', 'jenjangs.nama_jenjang')
                          ->select('pegawais.id')
                          // ->select('pegawais.nama', 'riwayat_jabatans.jabatan', 'pangkats.pangkat', 'jenjangs.nama_jenjang')
                          ->whereIn('pegawais.id', $index_p1)
                          // ->where(function($query){
                            //$query
                                  ->where('riwayat_jabatans.jenis_jabatan_id', '=', 1)
                                  //->where('riwayat_jabatans.pangkat_id', '<', 9)
                                  //->where('riwayat_pendidikans.jenjang_id', '<', 6)
                                  ->orWhere('riwayat_jabatans.jenis_jabatan_id', '=', 3)
                                  // ->where('riwayat_jabatans.pangkat_id', '<', 9)
                          // })
                          ->distinct()
                          ->get();

        $index_p2 = [];
        foreach ($pegawai as $value) {
          array_push($index_p2, $value->id);
        }

        // dd($index_p2);
        // die();

        $pegawaii = DB::table('pegawais')
                          // ->join('riwayat_diklats', 'pegawais.id', '=', 'riwayat_diklats.pegawai_id')
                          ->join('riwayat_jabatans', 'pegawais.id', '=', 'riwayat_jabatans.pegawai_id')
                          ->join('riwayat_pendidikans', 'pegawais.id', '=', 'riwayat_pendidikans.pegawai_id')
                          ->join('jenis_jabatans', 'riwayat_jabatans.jenis_jabatan_id', '=', 'jenis_jabatans.id')
                          ->join('pangkats', 'riwayat_jabatans.pangkat_id', '=', 'pangkats.id')
                          ->join('jenjangs', 'riwayat_pendidikans.jenjang_id', '=', 'jenjangs.id')
                          // ->join('riwayat_eselons', 'pegawais.id', '=', 'riwayat_eselons.pegawai_id')
                          // ->join('eselons', 'riwayat_eselons.eselon_id', '=', 'eselons.id')
                          ->join('units', 'pegawais.unit_id', '=', 'units.id')
                          ->select('pegawais.*', 'units.kode_unit', 'pangkats.nama_pangkat', 'jenjangs.nama_jenjang', 'jenis_jabatans.jenis_jabatan', 'riwayat_jabatans.jabatan')
                          // ->select('pegawais.*', 'pangkats.nama_pangkat', 'jenjangs.nama_jenjang')
                          // ->select('pegawais.nama', 'riwayat_jabatans.jabatan', 'pangkats.pangkat', 'jenjangs.nama_jenjang')
                          ->whereIn('pegawais.id', $index_p2)
                          // ->where(function($query){
                            //$query
                                  // ->where('riwayat_jabatans.jenis_jabatan_id', '=', 1)
                                  ->where('riwayat_jabatans.pangkat_id', '<', 9)
                                  ->where('riwayat_pendidikans.jenjang_id', '<', 6)
                                  // ->orWhere('riwayat_jabatans.jenis_jabatan_id', '=', 3)
                                  // ->where('riwayat_jabatans.pangkat_id', '<', 9)
                          // })
                          ->distinct()
                          ->get();

        // dd($index_p1);
        // die();

        $datatables = Datatables::of($pegawaii);

        return $datatables->make(true);
    }

    public function apiUsulanDiklatPim2(Request $request)
    {
        //$riwayatdiklat = RiwayatDiklat::all();
        $pegawai = DB::table('pegawais')
                          ->join('riwayat_diklats', 'pegawais.id', '=', 'riwayat_diklats.pegawai_id')
                          ->join('riwayat_pendidikans', 'pegawais.id', '=', 'riwayat_pendidikans.pegawai_id')
                          ->join('riwayat_jabatans', 'pegawais.id', '=', 'riwayat_jabatans.pegawai_id')
                          ->join('jenis_jabatans', 'riwayat_jabatans.jenis_jabatan_id', '=', 'jenis_jabatans.id')
                          ->join('pangkats', 'riwayat_jabatans.pangkat_id', '=', 'pangkats.id')
                          ->join('jenjangs', 'riwayat_pendidikans.jenjang_id', '=', 'jenjangs.id')
                          ->select('pegawais.*', 'pangkats.nama_pangkat', 'jenjangs.nama_jenjang', 'jenis_jabatans.jenis_jabatan')
                          ->where('riwayat_pendidikans.jenjang_id', '<', 6)
                          ->where('riwayat_jabatans.pangkat_id', '<', 9)
                          ->where('riwayat_jabatans.jenis_jabatan_id', '=', 1)
                          ->orWhere('riwayat_jabatans.jenis_jabatan_id', '=', 3)
                          ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat II ('.'%')
                          ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat III'.'%')
                          ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat IV'.'%')
                          ->get();

        $datatables = Datatables::of($pegawai);

        return $datatables->make(true);
    }

    public function apiUsulanDiklatPim3(Request $request)
    {
        //$riwayatdiklat = RiwayatDiklat::all();
        $pegawai = DB::table('pegawais')
                          ->join('riwayat_diklats', 'pegawais.id', '=', 'riwayat_diklats.pegawai_id')
                          ->join('riwayat_pendidikans', 'pegawais.id', '=', 'riwayat_pendidikans.pegawai_id')
                          ->join('riwayat_jabatans', 'pegawais.id', '=', 'riwayat_jabatans.pegawai_id')
                          ->join('jenis_jabatans', 'riwayat_jabatans.jenis_jabatan_id', '=', 'jenis_jabatans.id')
                          ->join('pangkats', 'riwayat_jabatans.pangkat_id', '=', 'pangkats.id')
                          ->join('jenjangs', 'riwayat_pendidikans.jenjang_id', '=', 'jenjangs.id')
                          ->select('pegawais.*', 'pangkats.nama_pangkat', 'jenjangs.nama_jenjang', 'jenis_jabatans.jenis_jabatan')
                          ->where('riwayat_pendidikans.jenjang_id', '<', 6)
                          ->where('riwayat_jabatans.pangkat_id', '<', 9)
                          ->where('riwayat_jabatans.jenis_jabatan_id', '=', 1)
                          ->orWhere('riwayat_jabatans.jenis_jabatan_id', '=', 3)
                          ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat II ('.'%')
                          ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat III'.'%')
                          ->where('riwayat_diklats.nama_diklat', 'not like', '%'.'PIM Tingkat IV'.'%')
                          ->get();

        $datatables = Datatables::of($pegawai);

        return $datatables->make(true);
    }
}
