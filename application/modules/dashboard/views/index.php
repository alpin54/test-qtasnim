<div class="row">
  <div class="col-12">
    <div class="card-box">
      <h4 class="header-title mb-4">Data Penjualan</h4>
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
                  <th>Jumlah Terjual</th>
                  <th>Tanggal Transaksi</th>
                  <th class="text-center" width="80">Stok</th>
                </tr>
              </thead>
              <tbody class="js-dashboard-result">
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
