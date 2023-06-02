<?php
use Restserver\Libraries\REST_Controller;

if (!function_exists('data_collection')) {
  function data_collection($data_collection) {
    $data = [];
    foreach ($data_collection as $v) {
      $data += [ $v => $_POST[$v]];
    };

    return $data;
  }
}

if (!function_exists('data_collection_add')) {
  function data_collection_add($data_collection) {
    $ci =& get_instance();
    $data = data_collection($data_collection);

    return $data;
  }
}

if (!function_exists('data_collection_put')) {
  function data_collection_put($data_collection_put) {
    $ci =& get_instance();
    $data = [];
    foreach ($data_collection_put as $v) {
      if (!empty($ci->put($v))) {
        $data += [ $v => $ci->put($v)];
      } else {
        $data += [ $v => ''];
      }
    };
    return $data;
  }
}

if (!function_exists('data_collection_update')) {
  function data_collection_update($data_collection) {
    $ci =& get_instance();
    $data = data_collection_put($data_collection);

    return $data;
  }
}

if (!function_exists('data_message')) {
  function data_message($result, $state='add') {
    $ci =& get_instance();
    $text = 'ditambahkan!';
    if ($state == 'change') {
      $text = 'diubah!';
    } else if ($state == 'delete') {
      $text = 'dihapus!';
    }

    if ($result)
    {
      $ci->response([
        'message' => 'Data berhasil ' . $text,
        'status' => true
      ], REST_Controller::HTTP_OK);
    }
    else
    {
      $ci->response([
        'message' => 'Data gagal ' . $text,
        'status' => false
      ], REST_Controller::HTTP_OK);
    }
  }
}
