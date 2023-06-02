<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Header extends MX_Controller {

  // - top
  public function top($header_data = [], $header_view)
  {
    $data = [
      'page' => $header_data['page'],
      'title' => $header_data['title'],
      'title_module' => $header_data['title_module'],
      'description' => $header_data['description'],
      'keywords' => $header_data['keywords'],
      'navigation_menu' => $header_data['navigation_menu']
    ];

    $this->load->view('header-dashboard', $data);
  }
}
