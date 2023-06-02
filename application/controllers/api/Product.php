<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Product extends REST_Controller
{
  public function __construct() {
    parent::__construct();
    header('Access-Control-Allow-Origin: *');
  }

  // get product
  public function index_get()
  {
    $product_id = $this->get('product_id');

    if ($product_id !== null)
    {
      //-- get single data
      $result = $this->global_model->get_single_data('tb_product', 'product_id', $product_id);
    } else if ($this->get('startPage') !== null || $this->get('limitPage') !== null || $this->get('keyword') !== null) {
      //-- get data paging
      $start =  $this->get('startPage') !== null ? $this->get('startPage') : 1;
      $limit =  $this->get('limitPage') !== null ? $this->get('limitPage') : 10;
      $keyword = $this->get('keyword') !== '0' ? $this->get('keyword') : 0;

      // pagging
      if($start != 1) {
        $start = ($start - 1) * $limit;
      }

      $paging = [
        'start' => $start,
        'limit' => $limit
      ];

      // multi keyword
      if ($keyword !== 0)
      {
        $multi_keyword = [
          'product_name' => $keyword,
          'type_name' => $keyword,
        ];
      } else {
        $multi_keyword = 0;
      }

      // total row
      $total_row = $this->global_model->get_row_keyword('vw_product', $multi_keyword);

      // config pagination
      $config = [
        'use_page_numbers' => TRUE,
        'total_rows' => $total_row,
        'per_page' => $limit,
        'base_url' => base_url() . 'v1/product/page/',
        'num_links' => 4,
        'uri_segment' => 3,
      ];

      $this->pagination->initialize($config);

      $data = $this->global_model->get_data_page('vw_product', $multi_keyword, $paging);

      $result = [
        'product_list' => $data,
        'pagination' => $this->pagination->create_links(),
        'row' => $start,
      ];
    } else {
      //-- get data
      $result = $this->global_model->get_data('vw_product', 'ASC');
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

  // add product
  public function index_post()
  {
    // field name on db and value name on input form must be same
    $data_collection = ['product_name', 'product_type', 'stock'];

    $data = data_collection_add($data_collection);
    $result = $this->global_model->add('tb_product', $data);
    data_message($result, 'add');
  }

  // update product
  public function index_put()
  {
    $product_id = $this->put('product_id');
    if ($product_id) {
      // field name on db and value name on input form must be same
      $data_collection = ['product_name', 'product_type', 'stock'];

      $data = data_collection_update($data_collection, true);
      $result = $this->global_model->update('tb_product', $data, 'product_id', $this->put('product_id'));
      data_message($result, 'change');
    } else {
      $this->response([
        'status' => false,
        'message' => 'Key not found'
      ], REST_Controller::HTTP_OK);
    }
  }

  // delete product
  public function index_delete()
  {
    if ($this->delete('product_id')) {
      $result = $this->global_model->delete('tb_product', 'product_id', $this->delete('product_id'));
      data_message($result, 'delete');
    } else {
      $this->response([
        'status' => false,
        'message' => 'Key not found'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }
}
