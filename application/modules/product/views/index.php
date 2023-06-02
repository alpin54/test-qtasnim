<div class="row">
  <div class="col-12">
    <div class="mb-4">
      <button type="button" class="btn btn-custom js-add-product" data-toggle="modal" data-target="#modal-product"><i class="mdi mdi-plus"></i> Tambah Produk</button>
    </div>
    <?= $tab_widget; ?>

    <div class="card-box">
      <h4 class="header-title mb-4">Data Product</h4>
      <div class="row">
        <div class="col-sm-12">
          <?= $filter_widget; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="table-responsive js-table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr role="row">
                  <th class="text-center" width="20">No</th>
                  <th>Nama Produk</th>
                  <th>Jenis Produk</th>
                  <th class="text-center" width="80">Stok</th>
                  <th class="text-center" width="100">Aksi</th>
                </tr>
              </thead>
              <tbody class="js-product-result">
              </tbody>
            </table>
          </div>
          <!-- Pagination -->
          <div class="float-right mt-2 js-pagination">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<? include('modal-product.php'); ?>
