<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-unit" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('PATCH') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body" style="padding-bottom: 0px;">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                      <label for="nama_diklat" class="col-md-3 control-label">Nama Diklat</label>
                      <div class="col-md-6">
                          <input type="text" id="nama_diklat" name="nama_diklat" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tgl_diklat" class="col-md-3 control-label">Tanggal Diklat</label>
                      <div class="col-md-6">
                          <input type="date" id="tgl_diklat" name="tgl_diklat" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>
                </div>

                <div class="modal-header" style="padding: 0px 15px;">
                    <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-3" style="padding-left: 40px;"><h4>*Pilih Kriteria</h4></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                      <label for="unit_id" class="col-md-3 control-label">Unit</label>
                      <div class="col-md-6">
                          <select class="form-control" id="unit_id" name="unit_id" required>
                            <option disabled>Pilih Unit</option>
                            <option value="0" selected>Semua Unit</option>
                            @if ($unit)
                              @foreach ($unit as $val)
                                <option value="{{ $val->id }}">{{ $val->nama_unit }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="jenjang_id" class="col-md-3 control-label">Pendidikan</label>
                      <div class="col-md-6">
                          <select class="form-control" id="jenjang_id" name="jenjang_id" required>
                            <option disabled>Pilih Pendidikan</option>
                            <option value="0">Semua Pendidikan</option>
                            @if ($jenjang)
                              @foreach ($jenjang as $val)
                                <option value="{{ $val->id }}">{{ $val->nama_jenjang }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="pangkat_id" class="col-md-3 control-label">Pangkat</label>
                      <div class="col-md-6">
                          <select class="form-control" id="pangkat_id" name="pangkat_id" required>
                            <option disabled>Pilih Pangkat</option>
                            <option value="0" selected>Semua Pangkat</option>
                            @if ($pangkat)
                              @foreach ($pangkat as $val)
                                <option value="{{ $val->id }}">{{ $val->nama_pangkat }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="jenis_jabatan_id" class="col-md-3 control-label">Jenis Jabatan</label>
                      <div class="col-md-6">
                          <select class="form-control" id="jenis_jabatan_id" name="jenis_jabatan_id" required>
                            <option disabled>Pilih Jenis Jabatan</option>
                            <option value="0" selected>Semua Jenis Jabatan</option>
                            @if ($jenisjabatan)
                              @foreach ($jenisjabatan as $val)
                                <option value="{{ $val->id }}">{{ $val->jenis_jabatan }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
