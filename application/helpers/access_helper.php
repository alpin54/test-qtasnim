<?php
if (!function_exists('access_block')) {
  function access_block($category) {
    $ci =& get_instance();
    $status = false;
    if ($category === 'all' && ($ci->session->userdata('role') !== '1' && $ci->session->userdata('role') !== '2')) {
      $status = true;
    } else if ($category === 'admin' && $ci->session->userdata('role') !== '1') {
      $status = true;
    } else if ($category === 'user' && $ci->session->userdata('role') !== '2') {
      $status = true;
    }
    return $status;
  }
}
