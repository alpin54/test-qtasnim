<div class="modal fade" id="modal-type" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Form Data Jenis</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal js-form-type">
          <input type="hidden" name="type_id"/>
          <div class="form-group row">
            <label for="typeName" class="col-sm-3 col-form-label">Nama Jenis</label>
            <div class="col-sm-8">
              <input id="typeName" type="text" name="type_name" placeholder="Masukan nama jenis" required="required" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <div class="offset-sm-3 col-sm-8">
              <button type="submit" class="btn btn-primary waves-effect waves-light">
                <i class="mdi mdi-content-save-outline"></i> Simpan
              </button>
              <button type="button" class="btn btn-danger btn-trans waves-effect waves-light m-l-5" data-dismiss="modal">
                <i class="mdi mdi-cancel"></i> Batal
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
