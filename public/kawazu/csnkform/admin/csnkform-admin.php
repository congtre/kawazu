<?php
function csnkform_admin_style(){
  $param = '?t='.time();
  wp_enqueue_style('style-csnkform-admin', get_stylesheet_directory_uri().'/csnkform/admin/css/csnkform-admin.css'.$param);
}
add_action('admin_enqueue_scripts','csnkform_admin_style');



function csnkform_admin_script(){
  $param = '?t='.time();
  wp_enqueue_script('script-csnkform-admin', get_stylesheet_directory_uri().'/csnkform/admin/js/csnkform-admin.js'.$param);
}
add_action('admin_enqueue_scripts','csnkform_admin_script');



function csnkform_admin_menu(){
  add_menu_page('お問い合わせ', 'お問い合わせ', 'manage_options', 'csnkform_admin_page', 'csnkform_admin_func', '', '4.1');
}// func csnkform_admin_menu
add_action('admin_menu', 'csnkform_admin_menu');



function csnkform_admin_func(){
  csnkform_admin_setting_func();
}// csnkform_admin_func



require_once('csnkform-admin-setting.php');
require_once('csnkform-admin-data.php');