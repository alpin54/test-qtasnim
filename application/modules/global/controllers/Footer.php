<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer extends MX_Controller {

  // - bottom
  public function bottom($footer_data = [], $footer_view)
  {
    $data = [
      'page' => $footer_data['page']
    ];
    $this->load->view('footer-dashboard', $data);
  }

}
