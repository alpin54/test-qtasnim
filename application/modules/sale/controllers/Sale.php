<?php
defined('BASEPATH') or exit('No direct script access allowed');

class sale extends MX_Controller
{

  // -- __construct
  public function __construct()
  {
    parent::__construct();
  }

  // -- index
  public function index()
  {
    // - template
    template_page('Penjualan', 'sale', 'sale/view');
  }

  // -- view
  public function view()
  {
    $widget = [
      'sort' => true,
      'date' => true,
      'search' => true
    ];

    $sort = (object) [
      'field' => 'product_id',
      'order' => 'ASC'
    ];

    $data = [
      'filter_widget' => modules::run('widget/widget/filter', $widget),
      'product_list' => $this->global_model->get_data('tb_product', $sort),
    ];

    $this->load->view('index', $data);
  }
}
