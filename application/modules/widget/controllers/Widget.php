<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Widget extends MX_Controller {

  // - filter
  public function filter($data = 0)
  {
    $sort = (object) [
      'field' => 'type_id',
      'order' => 'ASC'
    ];

    $data = [
      'sort' => isset($data['sort']) ? $data['sort'] : false,
      'date' => isset($data['date']) ? $data['date'] : false,
      'type' => isset($data['type']) ? $data['type'] : false,
      'order' => isset($data['order']) ? $data['order'] : false,
      'search' => isset($data['search']) ? $data['search'] : false,
      'type_list' => $this->global_model->get_data('tb_type', $sort),
    ];

    $this->load->view('filter', $data);
  }

  // - tab
  public function tab()
  {
    $this->load->view('tab');
  }

}
