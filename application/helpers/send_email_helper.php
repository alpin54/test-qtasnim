<?php

if (!function_exists('send_email')) {
  function send_email($token, $type)
  {
    $ci =& get_instance();
    $config = [
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'erwanhermawan690@gmail.com',
      'smtp_pass' => 'fallcon98',
      'smtp_port' => 465,
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'newline'   => "\r\n"
    ];

    $ci->email->initialize($config);

    $ci->email->from('erwanhermawan690@gmail.com', 'Web Application');
    $ci->email->to($ci->input->post('email'));

    if ($type == 'verify') {
      $ci->email->subject('Account Verification');
      $ci->email->message('Click this link to verify you account : <a href="' . base_url() . 'auth/verify?email=' . $ci->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
    } else if ($type == 'forgot') {
      $ci->email->subject('Reset Password');
      $ci->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $ci->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
    }

    if ($ci->email->send()) {
      return true;
    } else {
      echo $ci->email->print_debugger();
      die;
    }
  }
}
