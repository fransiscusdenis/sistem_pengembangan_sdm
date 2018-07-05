@extends('layouts.admin.master')

@section('custom_css')

  <style media="screen">
    .no{ width: 55px !important; }
    .nama{ width: 280px !important; }
    .kode_unit{ width: 100px !important; }
    .nama_pangkat{ width: 115px !important; }
    .jenis_jabatan{ width: 115px !important; }
    .jabatan{ width: 350px !important; }
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
      Filter Pegawai
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Filter Pegawai</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            {{-- <h3 class="box-title">
              <a class="btn btn-success" onclick="addForm()"><i class="fa fa-plus"></i> Tambah Data Riwayat Jabatan</a>
            </h3> --}}
            {{-- <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div> --}}

            <div class="pull-right" style="display: inline-block;">
                <div style="display: inline-block;">
                    <select class="form-control" id="jenis_jabatan_id" name="jenis_jabatan_id">
                      <option disabled>Pilih Jenis Jabatan</option>
                      <option value="0" selected>Semua Jenis Jabatan</option>
                      @if ($jenisjabatan)
                        @foreach ($jenisjabatan as $val)
                          <option value="{{ $val->id }}">{{ $val->jenis_jabatan }}</option>
                        @endforeach
                      @endif
                    </select>
                </div>
            </div>

            <div class="pull-right" style="display: inline-block;">
                <div style="display: inline-block;">
                    <select class="form-control" id="pangkat_id" name="pangkat_id">
                      <option disabled>Pilih Pangkat</option>
                      <option value="0" selected>Semua Pangkat</option>
                      @if ($pangkat)
                        @foreach ($pangkat as $val)
                          <option value="{{ $val->id }}">{{ $val->nama_pangkat }}</option>
                        @endforeach
                      @endif
                    </select>
                </div>
            </div>

            <div class="pull-right" style="display: inline-block;">
                <div style="display: inline-block;">
                    <select class="form-control" id="unit_id" name="unit_id">
                      <option disabled>Pilih Unit</option>
                      <option value="0" selected>Semua Unit</option>
                      @if ($unit)
                        @foreach ($unit as $val)
                          <option value="{{ $val->id }}">{{ $val->nama_unit }}</option>
                        @endforeach
                      @endif
                    </select>
                </div>
            </div>

          </div>
          <!-- /.box-header -->
          <div id="content" class="box-body table-responsive">

              <table id="unit-table" class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                      <tr>
                          <th width="25px">No</th>
                          {{-- <th>NIP</th> --}}
                          <th>Nama</th>
                          <th>Unit</th>
                          <th>Pangkat</th>
                          <th>Jenis Jabatan</th>
                          <th>Jabatan</th>
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

    var id_pangkat = $('#pangkat_id option:selected').val();
    var id_jenis_jabatan = $('#jenis_jabatan_id option:selected').val();
    var id_unit = $('#unit_id option:selected').val();
    table(id_pangkat, id_jenis_jabatan, id_unit);
    console.log(id_unit);

    function table(id_pangkat, id_jenis_jabatan, id_unit) {
      var table = $('#unit-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('api.filterpegawai')  }}/" + id_pangkat + "/" + id_jenis_jabatan + "/" + id_unit,
          columns: [
            {className: "no", data: 'id', name: 'id'},
            // {data: 'nip', name: 'nip'},
            {className: "nama", data: 'nama', name: 'nama'},
            {className: "kode_unit", data: 'kode_unit', name: 'kode_unit'},
            {className: "nama_pangkat", data: 'nama_pangkat', name: 'nama_pangkat'},
            {className: "jenis_jabatan", data: 'jenis_jabatan', name: 'jenis_jabatan'},
            {className: "jabatan", data: 'jabatan', name: 'jabatan'},
            // {data: 'tmt_jabatan', name: 'tmt_jabatan'},
            // {data: 'action', name: 'action', orderable: false, searchable: false}
          ],
          rowCallback: function( row, data, index ) {
            var info = table.page.info();
            var page = info.page;
            var length = info.length;
            var num = page * length + (index + 1);
            $('td:eq(0)', row).html( num );
          }
      });
    }

    $('#pangkat_id').change(function(){
      var id_pangkat = $('#pangkat_id option:selected').val();
      var id_jenis_jabatan = $('#jenis_jabatan_id option:selected').val();
      var id_unit = $('#unit_id option:selected').val();

      $.ajax({
        dataType : "json",
          url : "{{ route('api.filterpegawai') }}" + '/' + id_pangkat + "/" + id_jenis_jabatan + "/" + id_unit,
          type : "GET",
          success : function(data) {
            $('#unit-table').dataTable().fnDestroy();
            table(id_pangkat, id_jenis_jabatan, id_unit);
            // window.location.reload();
            console.log(id_pangkat);
          },
          error : function () {
            alert("Oops! Terjadi kesalahan!");
          }
        })

    });

    $('#jenis_jabatan_id').change(function(){
      var id_jenis_jabatan = $('#jenis_jabatan_id option:selected').val();
      var id_pangkat = $('#pangkat_id option:selected').val();
      var id_unit = $('#unit_id option:selected').val();

      $.ajax({
        dataType : "json",
          url : "{{ route('api.filterpegawai') }}" + '/' + id_pangkat + "/" + id_jenis_jabatan + "/" + id_unit,
          type : "GET",
          success : function(data) {
            $('#unit-table').dataTable().fnDestroy();
            table(id_pangkat, id_jenis_jabatan, id_unit);
            // window.location.reload();
            console.log(id_jenis_jabatan);
          },
          error : function () {
            alert("Oops! Terjadi kesalahan!");
          }
        })

    });

    $('#unit_id').change(function(){
      var id_unit = $('#unit_id option:selected').val();
      var id_jenis_jabatan = $('#jenis_jabatan_id option:selected').val();
      var id_pangkat = $('#pangkat_id option:selected').val();

      $.ajax({
        dataType : "json",
          url : "{{ route('api.filterpegawai') }}" + '/' + id_pangkat + "/" + id_jenis_jabatan + "/" + id_unit,
          type : "GET",
          success : function(data) {
            $('#unit-table').dataTable().fnDestroy();
            table(id_pangkat, id_jenis_jabatan, id_unit);
            // window.location.reload();
            console.log(id_unit);
          },
          error : function () {
            alert("Oops! Terjadi kesalahan!");
          }
        })

    });

</script>
@endpush
