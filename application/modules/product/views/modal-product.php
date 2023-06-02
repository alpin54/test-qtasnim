<div class="modal fade" id="modal-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Form Data Produk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal js-form-product">
          <input type="hidden" name="product_id"/>
          <div class="form-group row">
            <label for="product_name" class="col-sm-3 col-form-label">Nama Produk</label>
            <div class="col-sm-8">
              <input id="product_name" type="text" name="product_name" placeholder="Masukkan nama produk" required="required" class="form-control" data-target="alertName" />
              <p class="form-alert" id="alertName" data-req="Nama harus di isi!"></p>
            </div>
          </div>
          <div class="form-group row">
            <label for="product_type" class="col-sm-3 col-form-label">Jenis Produk</label>
            <div class="col-sm-8">
              <select class="form-control" id="product_type" name="product_type" data-target="alertType">
                <option value="0">Pilih Jenis Produk</option>
                <? foreach ($type_list as $val) { ?>
                  <option value="<?= $val['type_id'] ?>"><?= $val['type_name']; ?></option>
                <? } ?>
              </select>
              <p class="form-alert" id="alertType" data-req="Jenis harus di isi!"></p>
            </div>
          </div>
          <div class="form-group row">
            <label for="stock" class="col-sm-3 col-form-label">Stok</label>
            <div class="col-sm-8">
              <input id="stock" type="text" name="stock" placeholder="Masukkan stok" required="required" class="form-control" data-target="alertStock" />
              <p class="form-alert" id="alertStock" data-req="Stok harus di isi!"></p>
            </div>
          </div>
          <div class="form-group">
            <div class="offset-sm-3 col-sm-8">
              <button type="submit" class="btn btn-custom waves-effect waves-light">
                <i class="mdi mdi-content-save-outline"></i> Simpan
              </button>
              <button type="button" class="btn btn-custom btn-trans waves-effect waves-light m-l-5" data-dismiss="modal">
                <i class="mdi mdi-cancel"></i> Batal
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
