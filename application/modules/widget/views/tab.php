<div class="tabs">
  <ul class="tabs-control">
    <li class="tabs-control-item <?= ($navigation_menu == 'product' ? 'active' : ''); ?>">
      <a href="<?= base_url('product'); ?>" class="tabs-control-link"><i class="mdi mdi-briefcase-outline"></i>Produk</a>
    </li>
    <li class="tabs-control-item <?= ($navigation_menu == 'type' ? 'active' : ''); ?>">
      <a href="<?= base_url('type'); ?>" class="tabs-control-link"><i class="mdi mdi-tag-multiple"></i>Jenis Produk</a>
    </li>
  </ul>
</div>
