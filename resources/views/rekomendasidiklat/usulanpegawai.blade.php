@extends('layouts.admin.master')

@section('custom_css')

  <style media="screen">
    .no{ width: 30px !important; }
  </style>

@endsection

@push('links')
<link rel="stylesheet" href="/css/app.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pilih Pegawai
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="{{ route('rekomendasidiklat.index') }}"> Usulan Diklat Pegawai</a></li>
      <li class="active"> Pilih Pegawai</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header header" id="myHeader" style="padding-bottom: 0px;">
            <h3 class="box-title" style="font-size: 16px;">Usulan nama pegawai yang didapatkan untuk  <b>{{ $usulandiklat[0]->nama_diklat }}</b></h3>
            {{-- <div class="pull-right">
              {{ $data->links() }}
            </div> --}}
            <h3 class="box-title pull-right" style="display: inline-block;">
              <a class="btn btn-success"><i class="fa fa-external-link"></i> Simpan Usulan Diklat Pegawai</a>
            </h3>
          </div>
          <!-- /.box-header -->
          <div id="content" class="box-body table">

              {{-- {{ dd($usulandiklat) }} --}}
              <h4 id="unit_id" hidden>{{ $usulandiklat[0]->unit_id }}</h4>
              <h4 id="jenjang_id" hidden>{{ $usulandiklat[0]->jenjang_id }}</h4>
              <h4 id="pangkat_id" hidden>{{ $usulandiklat[0]->pangkat_id }}</h4>
              <h4 id="jenis_jabatan_id" hidden>{{ $usulandiklat[0]->jenis_jabatan_id }}</h4>

              <table id="unit-table" class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                      <tr>
                          {{-- <th>NIP</th> --}}
                          {{-- <th>No.</th> --}}
                          <th width="200px;">Nama</th>
                          <th>Unit</th>
                          <th>Pendidikan</th>
                          <th>Prodi</th>
                          <th>Pangkat</th>
                          <th width="130px;">Jenis Jabatan</th>
                          <th>Jabatan</th>
                          {{-- <th style="text-align: center;">Diklat</th> --}}
                          <th width="30px;"><input type="checkbox" class="selectall"></th>
                          {{-- <th>TMT Jabatan</th> --}}
                          {{-- <th width="140px" style="text-align: center;">Action</th> --}}
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>

          </div>
        </div>
      </div>
    </div>

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
<script src="/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

{{-- script untuk select2 --}}
{{-- <script>
    $(document).ready(function(){
        $("#pegawai_id").select2();
    });
</script> --}}

<script>
    var id_pangkat = document.getElementById("pangkat_id").innerHTML;
    var id_jenis_jabatan = document.getElementById("jenis_jabatan_id").innerHTML;
    var id_unit = document.getElementById("unit_id").innerHTML;
    var id_jenjang = document.getElementById("jenjang_id").innerHTML;

    var table = $('#unit-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('api.pilihpegawai')  }}/" + id_pangkat + "/" + id_jenis_jabatan + "/" + id_unit + "/" + id_jenjang,
        columns: [
          // {className: "no", data: 'id', name: 'id'},
          // {data: 'nip', name: 'nip'},
          {className: "nama", data: 'nama', name: 'nama'},
          {className: "kode_unit", data: 'kode_unit', name: 'kode_unit'},
          {className: "nama_jenjang", data: 'nama_jenjang', name: 'nama_jenjang'},
          {className: "prodi", data: 'prodi', name: 'prodi'},
          {className: "nama_pangkat", data: 'nama_pangkat', name: 'nama_pangkat'},
          {className: "jenis_jabatan", data: 'jenis_jabatan', name: 'jenis_jabatan'},
          {className: "jabatan", data: 'jabatan', name: 'jabatan'},
          // {data: 'tmt_jabatan', name: 'tmt_jabatan'},
          //{data: 'action', name: 'action', orderable: false, searchable: false}
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        // rowCallback: function( row, data, index ) {
        //   var info = table.page.info();
        //   var page = info.page;
        //   var length = info.length;
        //   var num = page * length + (index + 1);
        //   $('td:eq(0)', row).html( num );
        // }
    });

    $('.selectall').click(function(){
        $('.selectbox').prop('checked', $(this).prop('checked'));
    })
    $('.selectbox').click(function(){
        var total = $('.selectbox').length;
        var number = $('.selectboxchecked').length;
        if(total == number){
            $('.selectall').prop('checked', true);
        } else{
            $('.selectall').prop('checked', false);
        }
    })

</script>
@endpush
