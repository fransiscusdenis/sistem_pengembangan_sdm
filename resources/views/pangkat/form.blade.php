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
                      <label for="nama_pangkat" class="col-md-3 control-label">Nama Pangkat</label>
                      <div class="col-md-6">
                          <input type="text" id="nama_pangkat" name="nama_pangkat" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="jenis_pangkat" class="col-md-3 control-label">Jenis Pangkat</label>
                      <div class="col-md-6">
                          <input type="text" id="jenis_pangkat" name="jenis_pangkat" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="pangkat" class="col-md-3 control-label">Pangkat</label>
                      <div class="col-md-6">
                          <input type="text" id="pangkat" name="pangkat" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="golongan" class="col-md-3 control-label">Golongan</label>
                      <div class="col-md-6">
                          <input type="text" id="golongan" name="golongan" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="ruang" class="col-md-3 control-label">Ruang</label>
                      <div class="col-md-6">
                          <input type="text" id="ruang" name="ruang" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="prioritas" class="col-md-3 control-label">Prioritas</label>
                      <div class="col-md-6">
                          <input type="text" id="prioritas" name="prioritas" class="form-control" required>
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
