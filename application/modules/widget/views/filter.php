<!-- filter widget -->
<div class="project-sort">
  <div class="project-sort-item custom-sort-item">
    <div class="form-inline">
      <? if ($sort) { ?>
        <div class="form-group">
          <label class="mr-2" for="sort">Sort :</label for="sort">
          <select class="form-control js-show-per-page" name="sort" id="sort">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>
      <? } ?>
      <? if ($date) { ?>
        <div class="form-group">
          <label class="mr-2" for="date">Date :</label>
          <input type="text" name="date" class="form-control js-date-range-picker" id="date">
        </div>
      <? } ?>
      <? if ($type) { ?>
        <div class="form-group">
          <label class="mr-2" for="type_id">Jenis Produk :</label for="type">
          <select class="form-control js-select-type" name="type_id" id="type_id">
            <option value="All">Semua Jenis Produk</option>
            <? foreach ($type_list as $val) { ?>
              <option value="<?= $val['type_id'] ?>"><?= $val['type_name']; ?></option>
            <? } ?>
          </select>
        </div>
      <? } ?>
      <? if ($order) { ?>
        <div class="form-group">
          <label class="mr-2" for="order">Urutkan :</label for="order">
          <select class="form-control js-select-order" name="order" id="order">
            <option value="All">Pilih Urutan</option>
            <option value="1">Transaksi Tertinggi</option>
            <option value="2">Transaksi Terendah</option>
          </select>
        </div>
      <? } ?>
      <? if ($search) { ?>
        <div class="form-group">
          <label class="mr-2" for="keyword">Pencarian :</label>
          <input type="text" name="keyword" class="form-control js-keyword" id="keyword" placeholder="Cari Disini..">
        </div>
      <? } ?>
      <div class="form-group">
        <button type="button" class="btn btn-custom waves-effect waves-light js-filter-data"><i class="mdi mdi-magnify"></i></button>
        <button type="button" class="btn btn-custom btn-trans waves-effect waves-light ml-2 js-reset-data"><i class="mdi mdi-restore"></i></button>
      </div>
    </div>
  </div>
</div>
