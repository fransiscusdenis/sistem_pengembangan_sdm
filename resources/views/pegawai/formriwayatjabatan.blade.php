<div class="modal" id="modal-form-jabatan" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
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
                    {{-- <div class="form-group">
                      <label for="pegawai_id" class="col-md-3 control-label">NIP</label>
                      <div class="col-md-6">
                          <input type="text" id="pegawai_id" name="pegawai_id" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div> --}}

                    {{-- <div class="form-group">
                      <label for="pegawai_id" class="col-md-3 control-label">NIP/Nama</label>
                      <div class="col-md-6">
                          <select class="form-control" id="pegawai_id" name="pegawai_id" required>
                            <option value=""></option>
                            @if ($pegawai)
                              @foreach ($pegawai as $val)
                                <option value="{{ $val->id }}">{{ $val->nip }} - {{ $val->nama }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div> --}}

                    <div class="form-group">
                      {{-- <label for="jabatan" class="col-md-3 control-label">NIP/Nama</label> --}}
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                          <input type="hidden" id="pegawai_id" name="pegawai_id" class="form-control" value="{{ $pegawaifind->id }}" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="pangkat_id" class="col-md-3 control-label">Pangkat</label>
                      <div class="col-md-6">
                          <select class="form-control" id="pangkat_id" name="pangkat_id" required>
                            <option value=""></option>
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
                      <label for="jabatan" class="col-md-3 control-label">Jabatan</label>
                      <div class="col-md-6">
                          <input type="text" id="jabatan" name="jabatan" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="jenis_jabatan_id" class="col-md-3 control-label">Jenis Jabatan</label>
                      <div class="col-md-6">
                          <select class="form-control" id="jenis_jabatan_id" name="jenis_jabatan_id" required>
                            <option value=""></option>
                            @if ($jenisjabatan)
                              @foreach ($jenisjabatan as $val)
                                <option value="{{ $val->id }}">{{ $val->jenis_jabatan }}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tmt_jabatan" class="col-md-3 control-label">TMT Jabatan</label>
                      <div class="col-md-6">
                          <input type="date" id="tmt_jabatan" name="tmt_jabatan" class="form-control" required>
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
