@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-address-card-o"></i> Data Pegawai
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="{{ route('pegawai.index') }}"> List Pegawai</a></li>
      <li class="active">Data Pegawai</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            {{-- <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div> --}}



            <dl class="dl-horizontal">
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">NIP</dt>
              <dd>{{ $pegawai[0]->nip }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Nama</dt>
              <dd>{{ $pegawai[0]->nama }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Tempat Lahir</dt>
              <dd>{{ $pegawai[0]->tempat_lahir }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Tanggal Lahir</dt>
              <dd>{{ $pegawai[0]->tanggal_lahir }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Jenis Kelamin</dt>
              <dd>{{ $pegawai[0]->jenis_kelamin }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Alamat</dt>
              <dd>{{ $pegawai[0]->alamat }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Kabupaten</dt>
              <dd>{{ $pegawai[0]->kabupaten }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Provinsi</dt>
              <dd>{{ $pegawai[0]->provinsi }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Agama</dt>
              <dd>{{ $pegawai[0]->nama_agama }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Status Perkawinan</dt>
              <dd>{{ $pegawai[0]->status_perkawinan }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Status Pegawai</dt>
              <dd>{{ $pegawai[0]->status_pegawai }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Status Hukum</dt>
              <dd>{{ $pegawai[0]->status_hukum }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Unit</dt>
              <dd>{{ $pegawai[0]->nama_unit }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Unit Kerja</dt>
              <dd>{{ $pegawai[0]->unit_kerja }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">SKPD</dt>
              <dd>{{ $pegawai[0]->skpd }}</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">TMT Pensiun</dt>
              <dd>{{ $pegawai[0]->tmt_pensiun }}</dd>
            </dl>

            <h3 class="box-title" style="margin-left: 1.3%; margin-bottom: 0.5%; margin-top: 0.7%;">
              <a onclick="editForm('. $pegawai->id .')" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit Data Pegawai</a>
            </h3>
          </div>

        </div>
      </div>
    </div>

  </section>

  <section class="content-header">
    <h1>
      <i class="fa fa-graduation-cap"></i> Data Pendidikan Pegawai
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">
              <a class="btn btn-success" onclick="addFormRiwayatPendidikan()"><i class="fa fa-plus"></i> Tambah Data</a>
            </h3>
            {{-- <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div> --}}
          </div>
          <!-- /.box-header -->
          <div id="content" class="box-body table-responsive">

              <table id="unit-table-riwayatpendidikan" class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                      <tr>
                          <th width="25px">No</th>
                          <th>Jenjang</th>
                          <th>Nama Sekolah</th>
                          <th>Prodi</th>
                          <th>Tahun Lulus</th>
                          <th width="140px" style="text-align: center;">Action</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>
          </div>
        </div>
      </div>
    </div>

  </section>

  <section class="content-header">
    <h1>
      <i class="fa fa-certificate"></i> Data Pangkat Pegawai
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">
              <a class="btn btn-success" href="#"><i class="fa fa-plus"></i> Tambah Data</a>
            </h3>
            {{-- <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div> --}}
          </div>
          <!-- /.box-header -->
          <div id="content" class="box-body table-responsive">

              <table id="unit-table-riwayatpangkat" class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                      <tr>
                          <th width="25px">No</th>
                          <th>Pangkat</th>
                          <th>TMT Pangkat</th>
                          <th width="140px" style="text-align: center;">Action</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>
          </div>
        </div>
      </div>
    </div>


  </section>

  <section class="content-header">
    <h1>
      <i class="fa fa-sitemap"></i> Data Jabatan Pegawai
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">
              <a class="btn btn-success" href="#"><i class="fa fa-plus"></i> Tambah Data</a>
            </h3>
            {{-- <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div> --}}
          </div>
          <!-- /.box-header -->
          <div id="content" class="box-body table-responsive">

              <table id="unit-table-riwayatjabatan" class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                      <tr>
                          <th width="25px">No</th>
                          <th>Pangkat</th>
                          <th>Jabatan</th>
                          <th>Jenis Jabatan</th>
                          <th>TMT Jabatan</th>
                          <th width="140px" style="text-align: center;">Action</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content-header">
    <h1>
      <i class="fa fa-book"></i> Data Diklat Pegawai
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">

            <dl class="dl-horizontal">
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">NIP</dt>
              <dd>19620303 199101 1 001</dd>
              <dt style="text-align: left; padding-left: 1%; margin: 0.5%;">Nama</dt>
              <dd>ABDUL HALIM, S.H.</dd>
            </dl>

          </div>

        </div>
      </div>
    </div>


    @include('pegawai.formpendidikan')
  </section>
</div>

@endsection

@push('scripts')

<script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
{{-- Validator --}}
<script src="{{ asset('assets/validator/validator.min.js') }}"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('assets/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>

<script>
    // Riwayat Pendidikan
    var tablePendidikan = $('#unit-table-riwayatpendidikan').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('api.riwayatpendidikanpegawai', ['id' => $id]) }}",
                  columns: [
                    {data: 'id', name: 'id'},
                    {data: 'nama_jenjang', name: 'nama_jenjang'},
                    {data: 'nama_sekolah', name: 'nama_sekolah'},
                    {data: 'prodi', name: 'prodi'},
                    {data: 'tahun_lulus', name: 'tahun_lulus'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                  ],
                  rowCallback: function( row, data, index ) {
                    var info = table.page.info();
                    var page = info.page;
                    var length = info.length;
                    var num = page * length + (index + 1);
                    $('td:eq(0)', row).html( num );
                  }
                });

    function addFormRiwayatPendidikan() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modal-form-pendidikan').modal('show');
      $('#modal-form-pendidikan form')[0].reset();
      $('.modal-title').text('Tambah Data Pendidikan Pegawai');
    }

    function editFormRiwayatPendidikan(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modal-form-pendidikan form')[0].reset();
      $.ajax({
        url: "{{ url('riwayatpendidikan') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#modal-form-pendidikan').modal('show');
          $('.modal-title').text('Edit Data Pendidikan Pegawai');

          $('#id').val(data.id);
          $('#pegawai_id').val(data.pegawai_id);
          $('#jenjang_id').val(data.jenjang_id);
          $('#nama_sekolah').val(data.nama_sekolah);
          $('#prodi').val(data.prodi);
          $('#tahun_lulus').val(data.tahun_lulus);
        },
        error : function() {
            alert("Data tidak ditemukan!");
        }
      });
    }

    $(function(){
          $('#modal-form-pendidikan form').validator().on('submit', function (e) {
              if (!e.isDefaultPrevented()){
                  var id = $('#id').val();
                  if (save_method == 'add') url = "{{ url('riwayatpendidikan') }}";
                  else url = "{{ url('riwayatpendidikan') . '/' }}" + id;
                  console.log($('#modal-form-pendidikan form').serialize());
                  $.ajax({
                      url : url,
                      type : "POST",
                      data : $('#modal-form-pendidikan form').serialize(),
                      success : function(data) {
                        console.log(data);
                          $('#modal-form-pendidikan').modal('hide');
                          tablePendidikan.ajax.reload();

                          // var html = '';
                          // html += '<div class="alert alert-success" style="background-color:#dff0d8 !important; color:#00a65a !important">';
                          // html += '<strong>'+data+'</strong>'
                          // html += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
                          // html += '</div>'
                          //
                          // $('#content').prepend(html);

                      },
                      error : function(){
                          alert('Oops! something error!');
                      }
                  });
                  return false;
              }
          });
      });

    function deleteDataRiwayatPendidikan(id){
      var popup = confirm("Anda yakin ingin mengahpus data ini?");
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      if(popup == true){
        $.ajax({
            url : "{{ url('riwayatpendidikan') }}" + '/' + id,
            type : "POST",
            data : {'_method' : 'DELETE', '_token' : csrf_token},
            success : function(data) {
                tablePendidikan.ajax.reload();
                console.log(data);
              },
              error : function () {
                alert("Oops! Terjadi kesalahan!");
              }
          })
      }
    }

    // Riwayat Pangkat
    var table = $('#unit-table-riwayatpangkat').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('api.riwayatpangkatpegawai', ['id' => $id]) }}",
                  columns: [
                    {data: 'id', name: 'id'},
                    {data: 'nama_pangkat', name: 'nama_pangkat'},
                    {data: 'tmt_pangkat', name: 'tmt_pangkat'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                  ],
                  rowCallback: function( row, data, index ) {
                    var info = table.page.info();
                    var page = info.page;
                    var length = info.length;
                    var num = page * length + (index + 1);
                    $('td:eq(0)', row).html( num );
                  }
                });

    // Riwayat Jabatan
    var table = $('#unit-table-riwayatjabatan').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('api.riwayatjabatanpegawai', ['id' => $id]) }}",
                  columns: [
                    {data: 'id', name: 'id'},
                    {data: 'nama_pangkat', name: 'nama_pangkat'},
                    {data: 'jabatan', name: 'jabatan'},
                    {data: 'jenis_jabatan', name: 'jenis_jabatan'},
                    {data: 'tmt_jabatan', name: 'tmt_jabatan'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                  ],
                  rowCallback: function( row, data, index ) {
                    var info = table.page.info();
                    var page = info.page;
                    var length = info.length;
                    var num = page * length + (index + 1);
                    $('td:eq(0)', row).html( num );
                  }
                });



</script>
@endpush