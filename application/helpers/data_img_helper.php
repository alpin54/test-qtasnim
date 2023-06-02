<?php

if (!function_exists('upload_img')) {
  function upload_img($value_name, $dir_file, $id_file=0, $max_size='2000', $max_width='5120') {
    $set_id_file = $id_file == 0 ? rand(00000000000, 99999999999) : $id_file;
    $file_name = $_FILES[$value_name]['name'];
    $file_tmp = explode(".", $file_name);
    $file_ext = end($file_tmp);
    $file_name = $set_id_file . '.' . $file_ext;
    $config = [
      'file_name' => $set_id_file,
      'upload_path' => 'files/' . $dir_file . '/',
      'allowed_types' => 'bmp|gif|jpg|jpeg|png',
      'max_size' => $max_size,
      'max_width' => $max_width
    ];

    $result = (object) [
      'file_ext' => $file_ext,
      'file_name' => $file_name,
      'config' => $config
    ];
    return $result;
  }
}

if (!function_exists('update_img')) {
  function update_img($dir_file, $tmp_file, $new_file, $width=512) {
    $config = [
      'image_library' => 'gd2',
      'source_image' => 'files/' . $dir_file . '/' . $tmp_file,
      'new_image' => 'files/' . $dir_file . '/' . $new_file,
      'maintain_ratio' => TRUE,
      'width' => $width
    ];

    return $config;
  }
}

if (!function_exists('delete_img')) {
  function delete_img($dir_file, $file_name) {
    $file_exist = 'files/' . $dir_file . '/' . $file_name;
    unlink($file_exist);
  }
}

if (!function_exists('upload_file')) {
  function upload_file($value_name, $dir_file, $id_file=0, $max_size='4096') {
    $file_name = $_FILES[$value_name]['name'];
    $file_tmp = explode(".", $file_name);
    $file_ext = end($file_tmp);
    $file_name = strtolower(str_replace(' ', '-', $file_name));
    $config = [
      'file_name' => $file_name,
      'upload_path' => 'files/' . $dir_file . '/',
      'allowed_types' => 'csv|CSV|xlsx|XLSX|xls|XLS',
      'max_size' => $max_size,
    ];

    $result = (object) [
      'file_ext' => $file_ext,
      'file_name' => $file_name,
      'file_path' => 'files/' . $dir_file . '/' . $file_name,
      'config' => $config
    ];
    return $result;
  }
}
