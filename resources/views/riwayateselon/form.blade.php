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
                    {{-- <div class="form-group">
                      <label for="pegawai_id" class="col-md-3 control-label">NIP</label>
                      <div class="col-md-6">
                          <input type="text" id="pegawai_id" name="pegawai_id" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div> --}}

                    <div class="form-group">
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
                    </div>

                    <div class="form-group">
                      <label for="eselon_id" class="col-md-3 control-label">Eselon</label>
                      <div class="col-md-6">
                          <select class="form-control" id="eselon_id" name="eselon_id" required>
                            <option value=""></option>
                            @if ($eselon)
                              @foreach ($eselon as $val)
                                <option value="{{ $val->id }}">{{ $val->eselon }}</option>
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
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
