@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      List Pegawai
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">List Pegawai</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">
              <a class="btn btn-success" onclick="addForm()"><i class="fa fa-plus"></i> Tambah Data Pegawai</a>
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

              <table id="unit-table" class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                      <tr>
                          <th width="25px">No</th>
                          <th>NIP</th>
                          <th>Nama</th>
                          <th>Tempat Lahir</th>
                          <th>Tanggal Lahir</th>
                          <th>Jenis Kelamin</th>
                          <th>Alamat</th>
                          <th>Kabupaten</th>
                          <th>Provinsi</th>
                          <th>Agama</th>
                          <th>Status Perkawinan</th>
                          <th>Status Pegawai</th>
                          <th>Status Hukum</th>
                          <th>Unit</th>
                          <th>Unit Kerja</th>
                          <th>SKPD</th>
                          <th>TMT Pensiun</th>
                          <th width="140px" style="text-align: center;">Action</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>
          </div>
        </div>
      </div>
    </div>

    @include('pegawai.form')
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
    var table = $('#unit-table').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('api.pegawai') }}",
                  columns: [
                    {data: 'id', name: 'id'},
                    {data: 'nip', name: 'nip'},
                    {data: 'nama', name: 'nama'},
                    {data: 'tempat_lahir', name: 'tempat_lahir'},
                    {data: 'tanggal_lahir', name: 'tanggal_lahir'},
                    {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                    {data: 'alamat', name: 'alamat'},
                    {data: 'kabupaten', name: 'kabupaten'},
                    {data: 'provinsi', name: 'provinsi'},
                    {data: 'nama_agama', name: 'nama_agama'},
                    {data: 'status_perkawinan', name: 'status_perkawinan'},
                    {data: 'status_pegawai', name: 'status_pegawai'},
                    {data: 'status_hukum', name: 'status_hukum'},
                    {data: 'nama_unit', name: 'nama_unit'},
                    {data: 'unit_kerja', name: 'unit_kerja'},
                    {data: 'skpd', name: 'skpd'},
                    {data: 'tmt_pensiun', name: 'tmt_pensiun'},
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

    function addForm() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modal-form').modal('show');
      $('#modal-form form')[0].reset();
      $('.modal-title').text('Tambah Pegawai');
    }

    function editForm(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modal-form form')[0].reset();
      $.ajax({
        url: "{{ url('pegawai') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#modal-form').modal('show');
          $('.modal-title').text('Edit Pegawai');

          $('#id').val(data.id);
          $('#nip').val(data.nip);
          $('#nama').val(data.nama);
          $('#tempat_lahir').val(data.tempat_lahir);
          $('#tanggal_lahir').val(data.tanggal_lahir);
          $('#jenis_kelamin_id').val(data.jenis_kelamin_id);
          $('#alamat').val(data.alamat);
          $('#kabupaten').val(data.kabupaten);
          $('#provinsi').val(data.provinsi);
          $('#agama_id').val(data.agama_id);
          $('#status_perkawinan_id').val(data.status_perkawinan_id);
          $('#status_pegawai_id').val(data.status_pegawai_id);
          $('#status_hukum_id').val(data.status_hukum_id);
          $('#unit_id').val(data.unit_id);
          $('#unit_kerja').val(data.unit_kerja);
          $('#skpd').val(data.skpd);
          $('#tmt_pensiun').val(data.tmt_pensiun);
        },
        error : function() {
            alert("Data tidak ditemukan!");
        }
      });
    }

    function deleteData(id){
      var popup = confirm("Anda yakin ingin mengahpus data ini?");
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      if(popup == true){
        $.ajax({
            url : "{{ url('pegawai') }}" + '/' + id,
            type : "POST",
            data : {'_method' : 'DELETE', '_token' : csrf_token},
            success : function(data) {
                table.ajax.reload();
                console.log(data);
              },
              error : function () {
                alert("Oops! Terjadi kesalahan!");
              }
          })
      }
    }

    $(function(){
          $('#modal-form form').validator().on('submit', function (e) {
              if (!e.isDefaultPrevented()){
                  var id = $('#id').val();
                  if (save_method == 'add') url = "{{ url('pegawai') }}";
                  else url = "{{ url('pegawai') . '/' }}" + id;
                  console.log($('#modal-form form').serialize());
                  $.ajax({
                      url : url,
                      type : "POST",
                      data : $('#modal-form form').serialize(),
                      success : function(data) {
                        console.log(data);
                          $('#modal-form').modal('hide');
                          table.ajax.reload();

                          var html = '';
                          html += '<div class="alert alert-success" style="background-color:#dff0d8 !important; color:#00a65a !important">';
                          html += '<strong>'+data+'</strong>'
                          html += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
                          html += '</div>'

                          $('#content').prepend(html);

                      },
                      error : function(){
                          alert('Oops! something error!');
                      }
                  });
                  return false;
              }
          });
      });
</script>
@endpush
