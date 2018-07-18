<div class="modal" id="modal-form-riwayatdiklat" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{ csrf_field() }} {{ method_field('POST') }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>
                <div class="row">
                  <div class="col-xs-4" style="padding-right: 15px; width: auto;"><h3 class="modal-title">Riwayat Diklat Pegawai - </h3></div>
                  <div class="col-xs-4 label label-info" style="padding: 0 10px 0 10px; margin-top: 5px; width: auto;"><h4 class="modal-title" id="nama_pegawai">Nama</h4></div>
                  <div class="col-xs-4"></div>
                </div>

            </div>


              <section class="content">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="modal-body">
                    <div class="box box-info">

                      <!-- /.box-header -->
                      <div id="content" class="box-body table">

                          <table id="unit-table-riwayatdiklatpegawai" class="table table-striped table-bordered table-hover" style="width:100%">
                              <thead>
                                  <tr>
                                      <th width="25px">No</th>
                                      <th>Nama Diklat</th>
                                      <th>Tanggal Sertifikat</th>
                                      <th>No. Sertifikat</th>
                                      <th>Peran</th>
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


            {{-- <div class="modal-footer">

            </div> --}}
        </div>
    </div>
</div>

@push('script')
  <script>
    var tableDiklat = $('#unit-table-riwayatdiklatpegawai').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('api.riwayatdiklat') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama_diklat', name: 'nama_diklat'},
            {data: 'tgl_sertifikat', name: 'tgl_sertifikat'},
            {data: 'no_sertifikat', name: 'no_sertifikat'},
            {data: 'peran', name: 'peran'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        rowCallback: function( row, data, index ) {
            var info = tableDiklat.page.info();
            var page = info.page;
            var length = info.length;
            var num = page * length + (index + 1);
            $('td:eq(0)', row).html( num );
        }
    });
  </script>
@endpush
