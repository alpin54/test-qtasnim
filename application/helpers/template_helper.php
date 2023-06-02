<?php
if (!function_exists('template_page')) {
  function template_page($title, $navigation_menu='', $content_module, $slug='', $template='dashboard') {
    $ci =& get_instance();
    // - seo
    $seo = (object) [
      'header' => [
        'page' => str_replace(' ', '-', strtolower($title)),
        'title' => $title . WEB_TITLE,
        'title_module' => $title,
        'description' => $title . WEB_DESCRIPTION,
        'keywords' => strtolower($title) . WEB_KEYWORDS,
        'navigation_menu' => $navigation_menu
      ],
      'footer' => [
        'page' => str_replace(' ', '-', strtolower($title))
      ]
    ];

    // - template
    $data = [
      'header' => modules::run('global/header/top', $seo->header, $template),
      'content' => modules::run($content_module, $slug),
      'footer' => modules::run('global/footer/bottom', $seo->footer, $template)
    ];
    $ci->load->view('template', $data);
  }
}
