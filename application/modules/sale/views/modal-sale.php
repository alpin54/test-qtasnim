<div class="modal fade" id="modal-sale" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Form Data Penjualan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal js-form-sale">
          <input type="hidden" name="sale_id"/>
          <div class="form-group row">
            <label for="product_id" class="col-sm-3 col-form-label">Nama Produk</label>
            <div class="col-sm-8">
              <select class="form-control js-select-product" id="product_id" name="product_id" data-target="alertProduct">
                <option value="0">Pilih Produk</option>
                <? foreach ($product_list as $val) { ?>
                  <option value="<?= $val['product_id'] ?>"><?= $val['product_name']; ?></option>
                <? } ?>
              </select>
              <p class="form-alert" id="alertProduct" data-req="Jenis harus di isi!"></p>
            </div>
          </div>
          <div class="form-group row">
            <label for="stock" class="col-sm-3 col-form-label">Stok</label>
            <div class="col-sm-8">
              <input id="stock" type="text" name="stock" placeholder="Masukkan stok" required="required" class="form-control" value="0" disabled="disabled"  />
            </div>
          </div>
          <div class="form-group row">
            <label for="sold" class="col-sm-3 col-form-label">Jumlah Terjual</label>
            <div class="col-sm-8">
              <input id="sold" type="text" name="sold" placeholder="Masukkan jumlah terjual" required="required" class="form-control" data-target="alertSold" />
              <p class="form-alert" id="alertSold" data-req="Jumlah terjual harus di isi!"></p>
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
