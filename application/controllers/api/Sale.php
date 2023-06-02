<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Sale extends REST_Controller
{
  public function __construct() {
    parent::__construct();
    header('Access-Control-Allow-Origin: *');
  }

  // get sale
  public function index_get()
  {
    $sale_id = $this->get('sale_id');

    if ($sale_id !== null)
    {
      //-- get single data
      $result = $this->global_model->get_single_data('tb_sale', 'sale_id', $sale_id);
    } else if ($this->get('startPage') !== null || $this->get('limitPage') !== null || $this->get('keyword') !== null) {
      // -- get data paging
      $start =  $this->get('startPage') !== null ? $this->get('startPage') : 1;
      $limit =  $this->get('limitPage') !== null ? $this->get('limitPage') : 10;
      $start_date = $this->get('startDate') ? $this->get('startDate') : date('Y-m-d');
      $end_date = $this->get('endDate') ? $this->get('endDate') : date('Y-m-d');
      $keyword = $this->get('keyword') !== '0' ? $this->get('keyword') : 0;

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

      // multi keyword
      $total_row = $this->global_model->get_row_keyword('vw_sale', $multi_keyword, $date_range);

      $config = [
        'use_page_numbers' => TRUE,
        'total_rows' => $total_row,
        'per_page' => $limit,
        'base_url' => base_url() . 'v1/sale/page/',
        'num_links' => 4,
        'uri_segment' => 3,
      ];

      $this->pagination->initialize($config);

      $data = $this->global_model->get_data_page('vw_sale', $multi_keyword, $paging, $date_range);

      $result = [
        'sale_list' => $data,
        'pagination' => $this->pagination->create_links(),
        'row' => $start,
      ];
    } else {
      //-- get data
      $result = $this->global_model->get_data('vw_sale', 'ASC');
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

  // add sale
  public function index_post()
  {
    $product_id = $this->post('product_id');
    $sold = $this->post('sold');

    // field name on db and value name on input form must be same
    $data_collection = ['product_id', 'sold', 'stock'];

    $data = data_collection_add($data_collection);
    $data += [
      'sale_date' => date('y-m-d')
    ];

    // update min stock data product
    $result = $this->global_model->update_stock_min($sold, $product_id);

    // add data sale
    $result = $this->global_model->add('tb_sale', $data);


    data_message($result, 'add');
  }

  // update sale
  public function index_put()
  {
    $sale_id = $this->put('sale_id');
    $product_id = $this->put('product_id');
    $sold = $this->put('sold');
    $sale = $this->global_model->get_single_data('tb_sale', 'sale_id', $sale_id);
    if ($sale_id) {
      // field name on db and value name on input form must be same
      $data_collection = ['product_id', 'sold'];

      $data = data_collection_update($data_collection, true);

      if ($sale->sold !== $sold) {
        if ($sale->sold < $sold) {
          $total = $sold - $sale->sold;
          // update min stock data product
          $result = $this->global_model->update_stock_min($total, $product_id);
        } else {
          $total = $sale->sold - $sold;
          // update plus stock data product
          $result = $this->global_model->update_stock_plus($total, $product_id);
        }
      }

      $result = $this->global_model->update('tb_sale', $data, 'sale_id', $this->put('sale_id'));

      data_message($result, 'change');
    } else {
      $this->response([
        'status' => false,
        'message' => 'Key not found'
      ], REST_Controller::HTTP_OK);
    }
  }

  // delete sale
  public function index_delete()
  {
    $sale_id = $this->delete('sale_id');
    $sale = $this->global_model->get_single_data('tb_sale', 'sale_id', $sale_id);
    if ($sale_id) {
      // update plus stock data product
      $result = $this->global_model->update_stock_plus($sale->sold, $sale->product_id);

      // delte data sale
      $result = $this->global_model->delete('tb_sale', 'sale_id', $this->delete('sale_id'));
      data_message($result, 'delete');
    } else {
      $this->response([
        'status' => false,
        'message' => 'Key not found'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }
}
