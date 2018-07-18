@extends('layouts.admin.master')

@section('custom_css')

  <style media="screen">
    .no{ width: 55px !important; }
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
            <h3 class="box-title">Usulan nama-nama pegawai yang didapatkan :</h3>
            {{-- <div class="pull-right">
              {{ $data->links() }}
            </div> --}}
            <h3 class="box-title pull-right" style="display: inline-block;">
              <a class="btn btn-success"><i class="fa fa-external-link"></i> Simpan Usulan Diklat Pegawai</a>
            </h3>
          </div>
          <!-- /.box-header -->
          <div id="content" class="box-body table">
            
              <form action="/selectall" method="post">
                @csrf
              <table id="unit-table" class="table table-striped table-bordered table-hover table-responsive" style="width:100%">
                  <thead>
                      <tr>
                          <th width="25px;"><input type="checkbox" class="selectall"></th>
                          <th>Nama</th>
                          <th>Unit</th>
                          <th>Pendidikan</th>
                          <th>Prodi</th>
                          <th>Pangkat</th>
                          <th>Jenis Jabatan</th>
                          <th>Jabatan</th>
                          <th style="text-align: center;">Diklat</th>
                          {{-- <th>TMT Jabatan</th> --}}
                          {{-- <th width="140px" style="text-align: center;">Action</th> --}}
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $val)
                      <tr>
                        <td width="25px;"><input type="checkbox" name="ids[]" class="selectbox" value="{{$val->pegawai_id}}"></td>
                        <td>{{ $val->nama }}</td>
                        <td>{{ $val->kode_unit }}</td>
                        <td>{{ $val->nama_jenjang }}</td>
                        <td>{{ $val->prodi }}</td>
                        <td>{{ $val->nama_pangkat }}</td>
                        <td>{{ $val->jenis_jabatan }}</td>
                        <td>{{ $val->jabatan }}</td>
                        <td>
                            <a onclick="viewRiwayatDiklat({{$val->pegawai_id}})" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Lihat Diklat</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              </form>
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
