@extends('layouts.admin.master')

@section('custom_css')

  <style media="screen">
    .no{ width: 55px !important; }
    .nip{ width: 155px !important; }
    .nama{ width: 300px !important; }
    .nama_unit{ width: 320px !important; }
    .action{ width: 120px !important; }
  </style>

@endsection

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
          <div id="content" class="box-body table">

              <table id="unit-table" class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>NIP</th>
                          <th>Nama</th>
                          <th>Unit</th>
                          <th style="text-align: center;">Action</th>
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

    var id_unit = $('#unit_id option:selected').val();
    table(id_unit);
    console.log(id_unit);

    function table(id_unit) {
      var table = $('#unit-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('api.pegawai')  }}/" + id_unit,
          columns: [
            { className: "no", data: 'id', name: 'id'},
            { className: "nip", data: 'nip', name: 'nip'},
            { className: "nama", data: 'nama', name: 'nama'},
            { className: "nama_unit", data: 'nama_unit', name: 'nama_unit'},
            { className: "action", data: 'action', name: 'action', orderable: false, searchable: false}
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

    $('#unit_id').change(function(){
      var id_unit = $('#unit_id option:selected').val();

      $.ajax({
        dataType : "json",
          url : "{{ route('api.pegawai') }}" + '/' + id_unit,
          type : "GET",
          success : function(data) {
            $('#unit-table').dataTable().fnDestroy();
            table(id_unit);
            // window.location.reload();
            console.log(id_unit);
          },
          error : function () {
            alert("Oops! Terjadi kesalahan!");
          }
        })

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
          $('#tanggal_lahir').val(data.tanggal_lahir);
          $('#tempat_lahir').val(data.tempat_lahir);
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
      var id_unit = $('#unit_id option:selected').val();
      if(popup == true){
        $.ajax({
            url : "{{ url('pegawai') }}" + '/' + id,
            type : "POST",
            data : {'_method' : 'DELETE', '_token' : csrf_token},
            success : function(data) {
                $('#unit-table').dataTable().fnDestroy();
                table(id_unit);
                console.log(id_unit);
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
                          $('#unit-table').dataTable().fnDestroy();
                          // table.ajax.reload();

                          var link = "{{ url('view') . '/' }}" + data.pegawai.id;
                          console.log(link);
                          window.location.href = link;

                          // var html = '';
                          // html += '<div class="alert alert-success" style="background-color:#dff0d8 !important; color:#00a65a !important">';
                          // html += '<strong>'+data.message+'</strong>'
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
</script>
@endpush
