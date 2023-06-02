<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MX_Controller
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
    template_page('Produk', 'product', 'product/view');
  }

  // -- view
  public function view()
  {
    $widget = [
      'sort' => true,
      'search' => true
    ];

    $sort = (object) [
      'field' => 'type_id',
      'order' => 'ASC'
    ];

    $data = [
      'filter_widget' => modules::run('widget/widget/filter', $widget),
      'tab_widget' => modules::run('widget/widget/tab'),
      'type_list' => $this->global_model->get_data('tb_type', $sort),
    ];

    $this->load->view('index', $data);
  }

  // -- type
  public function type()
  {
    // - template
    template_page('Jenis Produk', 'type', 'product/view_type');
  }

  // -- view type
  public function view_type()
  {
    $widget = [
      'sort' => true,
      'search' => true
    ];

    $data = [
      'filter_widget' => modules::run('widget/widget/filter', $widget),
      'tab_widget' => modules::run('widget/widget/tab'),
    ];

    $this->load->view('type', $data);
  }
}
