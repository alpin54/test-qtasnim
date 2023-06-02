<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Type extends REST_Controller
{
  public function __construct() {
    parent::__construct();
    header('Access-Control-Allow-Origin: *');
  }

  // get type
  public function index_get()
  {
    $type_id = $this->get('type_id');

    if ($type_id !== null)
    {
      //-- get single data
      $result = $this->global_model->get_single_data('tb_type', 'type_id', $type_id);
    } else if ($this->get('startPage') !== null || $this->get('limitPage') !== null || $this->get('keyword') !== null) {
      //-- get data paging
      $start =  $this->get('startPage') !== null ? $this->get('startPage') : 1;
      $limit =  $this->get('limitPage') !== null ? $this->get('limitPage') : 10;
      $keyword = $this->get('keyword') !== '0' ? $this->get('keyword') : 0;

      if($start != 1) {
        $start = ($start - 1) * $limit;
      }

      // pagging
      $paging = [
        'start' => $start,
        'limit' => $limit
      ];

      // multi keyword
      if ($keyword !== 0)
      {
        $multi_keyword = [
          'type_name' => $keyword,
        ];
      } else {
        $multi_keyword = 0;
      }

      // total row
      $total_row = $this->global_model->get_row_keyword('tb_type', $multi_keyword);

      // config pagination
      $config = [
        'use_page_numbers' => TRUE,
        'total_rows' => $total_row,
        'per_page' => $limit,
        'base_url' => base_url() . 'v1/type/page/',
        'num_links' => 4,
        'uri_segment' => 3,
      ];

      $this->pagination->initialize($config);

      $data = $this->global_model->get_data_page('tb_type', $multi_keyword, $paging);

      $result = [
        'type_list' => $data,
        'pagination' => $this->pagination->create_links(),
        'row' => $start,
      ];
    } else {
      //-- get data
      $result = $this->global_model->get_data('tb_type', 'ASC');
    }

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

  // add type
  public function index_post()
  {
    // field name on db and value name on input form must be same
    $data_collection = ['type_name'];

    $data = data_collection_add($data_collection);
    $result = $this->global_model->add('tb_type', $data);
    data_message($result, 'add');
  }

  // update type
  public function index_put()
  {
    $type_id = $this->put('type_id');
    if ($type_id) {
      // field name on db and value name on input form must be same
      $data_collection = ['type_name'];

      $data = data_collection_update($data_collection, true);
      $result = $this->global_model->update('tb_type', $data, 'type_id', $this->put('type_id'));
      data_message($result, 'change');
    } else {
      $this->response([
        'status' => false,
        'message' => 'Key not found'
      ], REST_Controller::HTTP_OK);
    }
  }

  // delete type
  public function index_delete()
  {
    if ($this->delete('type_id')) {
      $result = $this->global_model->delete('tb_type', 'type_id', $this->delete('type_id'));
      data_message($result, 'delete');
    } else {
      $this->response([
        'status' => false,
        'message' => 'Key not found'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }
}
