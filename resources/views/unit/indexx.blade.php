@extends('layouts.admin.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Unit
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Unit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Unit List
                <a onclick="#" class="btn btn-primary pull-right" style="margin top: -8px;">Tambah Unit</a>
              </h4>
              <div class="panel-body">
                  <table id="unit-table" class="table table-striped">
                      <thead>
                          <tr>
                              <th width="30">No</th>
                              <th>Kode Unit</th>
                              <th>Nama Unit</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Main content -->
  </div>

  <script type="text/javascript">
    $('#unit-table').DataTables({
      processing: true,
      serverSide: true,
      ajax: "{{ route('api.unit') }}",
      columns: [
        {data: 'id', name: 'id'},
        {data: 'kode_unit', name: 'kode_unit'},
        {data: 'nama_unit', name: 'nama_unit'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ]
    });
  </script>
@endsection




{{-- Ajax View Yang Bener dr Index.blade.php --}}

{{-- @extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      List Unit
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">List Unit</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              <a class="btn btn-success" href="#"><i class="fa fa-plus"></i> Tambah Unit Baru</a>
            </h3>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
              <table id="unit-table" class="table table-stripped table-hover">
                  <thead>
                      <tr>
                          <th width="30">No</th>
                          <th>Kode Unit</th>
                          <th>Nama Unit</th>
                          <th>Action</th>
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

@endsection --}}

{{-- @push('scripts')
<script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dataTables/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/validator/validator.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>
<script>
    $('#unit-table').DataTables({
      processing: true,
      serverSide: true,
      ajax: "{{ route('api.unit') }}",
      columns: [
        {data: 'id', name: 'id'},
        {data: 'kode_unit', name: 'kode_unit'},
        {data: 'nama_unit', name: 'nama_unit'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ]
    });
</script>
@endpush --}}






{{-- Berhasil --}}

{{-- @extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      List Unit
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">List Unit</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              <a class="btn btn-success" href="#"><i class="fa fa-plus"></i> Tambah Unit Baru</a>
            </h3>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
              <table id="unit-table" class="table table-stripped table-hover">
                  <thead>
                      <tr>
                          <th width="30">No</th>
                          <th>Kode Unit</th>
                          <th>Nama Unit</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php $no = 1; @endphp
                    @foreach ($unit as $units)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $units->kode_unit }}</td>
                      <td>{{ $units->nama_unit }}</td>
                      <td>
                        <form action="#" method="post">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <a class="btn btn-sm btn-info" href="#"><i class="glyphicon glyphicon-eye-open"></i></a>
                          <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')"><i class="glyphicon glyphicon-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection --}}

{{-- @push('scripts')
<script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dataTables/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/validator/validator.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>
<script>
    $('#unit-table').DataTables({
      processing: true,
      serverSide: true,
      ajax: "{{ route('api.unit') }}",
      columns: [
        {data: 'id', name: 'id'},
        {data: 'kode_unit', name: 'kode_unit'},
        {data: 'nama_unit', name: 'nama_unit'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ]
    });
</script>
@endpush --}}
