<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-unit" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                      <label for="nip" class="col-md-3 control-label">NIP</label>
                      <div class="col-md-6">
                          <input type="text" id="nip" name="nip" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="nama" class="col-md-3 control-label">Nama</label>
                      <div class="col-md-6">
                          <input type="text" id="nama" name="nama" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tanggal_lahir" class="col-md-3 control-label">Tanggal Lahir</label>
                      <div class="col-md-6">
                          <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tempat_lahir" class="col-md-3 control-label">Tempat Lahir</label>
                      <div class="col-md-6">
                          <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="jenis_kelamin_id" class="col-md-3 control-label">Jenis Kelamin</label>
                      <div class="col-md-6">
                          <select class="form-control" id="jenis_kelamin_id" name="jenis_kelamin_id" required>
                            <option value=""></option>
                            @if ($jeniskelamin)
                              @foreach ($jeniskelamin as $val)
                                <option value="{{ $val->id }}">{{ $val->jenis_kelamin }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="alamat" class="col-md-3 control-label">Alamat</label>
                      <div class="col-md-6">
                          <input type="text" id="alamat" name="alamat" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="kabupaten" class="col-md-3 control-label">Kabupaten</label>
                      <div class="col-md-6">
                          <input type="text" id="kabupaten" name="kabupaten" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="provinsi" class="col-md-3 control-label">Provinsi</label>
                      <div class="col-md-6">
                          <input type="text" id="provinsi" name="provinsi" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="agama_id" class="col-md-3 control-label">Agama</label>
                      <div class="col-md-6">
                          <select class="form-control" id="agama_id" name="agama_id" required>
                            <option value=""></option>
                            @if ($agama)
                              @foreach ($agama as $val)
                                <option value="{{ $val->id }}">{{ $val->nama_agama }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="status_perkawinan_id" class="col-md-3 control-label">Status Perkawinan</label>
                      <div class="col-md-6">
                          <select class="form-control" id="status_perkawinan_id" name="status_perkawinan_id" required>
                            <option value=""></option>
                            @if ($statusperkawinan)
                              @foreach ($statusperkawinan as $val)
                                <option value="{{ $val->id }}">{{ $val->status_perkawinan }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="status_pegawai_id" class="col-md-3 control-label">Status Pegawai</label>
                      <div class="col-md-6">
                          <select class="form-control" id="status_pegawai_id" name="status_pegawai_id" required>
                            <option value=""></option>
                            @if ($statuspegawai)
                              @foreach ($statuspegawai as $val)
                                <option value="{{ $val->id }}">{{ $val->status_pegawai }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="status_hukum_id" class="col-md-3 control-label">Status Hukum</label>
                      <div class="col-md-6">
                          <select class="form-control" id="status_hukum_id" name="status_hukum_id" required>
                            <option value=""></option>
                            @if ($statushukum)
                              @foreach ($statushukum as $val)
                                <option value="{{ $val->id }}">{{ $val->status_hukum }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="unit_id" class="col-md-3 control-label">Unit</label>
                      <div class="col-md-6">
                          <select class="form-control" id="unit_id" name="unit_id" required>
                            <option value=""></option>
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
                      <label for="unit_kerja" class="col-md-3 control-label">Unit Kerja</label>
                      <div class="col-md-6">
                          <input type="text" id="unit_kerja" name="unit_kerja" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="skpd" class="col-md-3 control-label">SKPD</label>
                      <div class="col-md-6">
                          <input type="text" id="skpd" name="skpd" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tmt_pensiun" class="col-md-3 control-label">TMT Pensiun</label>
                      <div class="col-md-6">
                          <input type="date" id="tmt_pensiun" name="tmt_pensiun" class="form-control" required>
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
