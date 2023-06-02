<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Dashboard extends REST_Controller
{
  public function __construct() {
    parent::__construct();
    header('Access-Control-Allow-Origin: *');
  }

  // get dashboard
  public function index_get()
  {
    // -- get data paging
    $start =  $this->get('startPage') !== null ? $this->get('startPage') : 1;
    $limit =  $this->get('limitPage') !== null ? $this->get('limitPage') : 10;
    $start_date = $this->get('startDate') ? $this->get('startDate') : date('Y-m-d');
    $end_date = $this->get('endDate') ? $this->get('endDate') : date('Y-m-d');
    $type = $this->get('type') !== 'All' ? $this->get('type') : 'All';
    $order = $this->get('order') !== 'All' ? $this->get('order') : 'All';

    if($start != 1) {
      $start = ($start - 1) * $limit;
    }

    // pagging
    $paging = [
      'start' => $start,
      'limit' => $limit
    ];

    $date_range = [
      'column' => 'sale_date',
      'start_date' => date('Y-m-d', strtotime($start_date)),
      'end_date' => date('Y-m-d', strtotime($end_date))
    ];

    // multi where
    if ($type !== 'All')
    {
      $multi_where = [
        'type_id' => $type,
      ];
    } else {
      $multi_where = 0;
    }

    // order
    if ($order !== 'All')
    {
      if ($order === '1') {
        $sorting = (object) [
          'field' => 'sold',
          'order' => 'DESC'
        ];
      } else {
        $sorting = (object) [
          'field' => 'sold',
          'order' => 'ASC'
        ];
      }
    } else {
      $sorting = 0;
    }


    // multi keyword
    $total_row = $this->global_model->get_row_where('vw_sale', $multi_where, $date_range, $sorting);

    $config = [
      'use_page_numbers' => TRUE,
      'total_rows' => $total_row,
      'per_page' => $limit,
      'base_url' => base_url() . 'v1/sale/page/',
      'num_links' => 4,
      'uri_segment' => 3,
    ];

    $this->pagination->initialize($config);

    $data = $this->global_model->get_data_page_where('vw_sale', $multi_where, $paging, $date_range, $sorting);

    $result = [
      'sale_list' => $data,
      'pagination' => $this->pagination->create_links(),
      'row' => $start,
    ];

    if ($result) {
      $this->response([
        'message' => 'Get data successfully',
        'status' => true,
        'data' => $result
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'message' => 'Key is not found',
        'status' => false,
        'data' => (object) []
      ], REST_Controller::HTTP_OK);
    }
  }
}
