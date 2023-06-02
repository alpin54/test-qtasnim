<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller {

  // -- __construct
  public function __construct()
  {
    parent::__construct();
  }

  // -- index
  public function index()
  {
    // - template
    template_page('Dashboard', 'dashboard', 'dashboard/view');
  }

  // -- view
  public function view()
  {
    $widget = [
      'sort' => true,
      'date' => true,
      'type' => true,
      'order' => true,
    ];

    $data = [
      'filter_widget' => modules::run('widget/widget/filter', $widget)
    ];

    $this->load->view('index', $data);
  }
}
