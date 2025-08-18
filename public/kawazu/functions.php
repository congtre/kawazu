<?php
require_once('functions/functions-base.php');
require_once('functions/functions-wp-head.php');
require_once('functions/functions-widget.php');
require_once('functions/functions-lib-array.php');
require_once('functions/functions-lib.php');
require_once('functions/functions-cpost.php');
require_once('functions/functions-site-setting.php');
require_once('functions/functions-site-setting-header.php');
//require_once('functions/functions-acf-block.php');
//require_once('functions/functions-acf-option-page.php');
require_once('functions/functions-custom.php');
require_once('functions/functions-editor-block-theme.php');

require_once('csnkform/admin/csnkform-admin.php');
require_once('csnkform/csnkform-lib-array.php');
require_once('csnkform/csnkform-lib.php');

/*
if(file_exists(get_stylesheet_directory().'/functions/xxxxxx.php')):
  require_once(get_stylesheet_directory().'/functions/xxxxxx.php');
endif;

$user = wp_get_current_user();
if($user->user_login == 'xxxxx'):
  require_once('functions/functions-xxxxx.php');
endif;
*/
?>