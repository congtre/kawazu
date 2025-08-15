<?php
$my_meta_array = get_header_meta_v20();
$description = $my_meta_array['description'];
$keywords = $my_meta_array['keywords'];

$og_site_name = (get_option('my_site_title') != '') ? get_option('my_site_title') : get_bloginfo('name');

if(is_front_page()):
  $og_title = (get_option('my_site_title') != '') ? get_option('my_site_title') : get_bloginfo('name');
else:
  //$og_title = wp_title('|', false, 'right').my_title_plus();
  //$og_title = preg_replace('/ \| $/','',$og_title);
  $og_title = wp_get_document_title();
endif;

//$og_app_id = 'xxxxxxx';

$og_type = 'website';
if(is_single()) $og_type = 'article';

$og_url = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$og_url = esc_url($og_url.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
$og_url = preg_replace('/\?.+$/','',$og_url);

$og_image = get_eyecatch_image();
if($og_image != ''):
  $root_path = esc_html($_SERVER['DOCUMENT_ROOT']);
  $og_image_path = preg_replace('/http(s|)\:\/\/[^\/]+\//', $root_path.'/', $og_image);
  $fp = @fopen($og_image_path, 'r');
  if(!$fp):
    $og_image = '';
    if(get_option('my_default_ogp_image') != ''):
      $og_image = esc_url(get_option('my_default_ogp_image'));
      $og_image_path = preg_replace('/http(s|)\:\/\/[^\/]+\//', $root_path.'/', $og_image);
      $og_image_size = getimagesize($og_image_path);
    endif;
  else:
    fclose($fp);
    $og_image_size = getimagesize($og_image_path);
  endif;
endif;
//if(!$og_image) $og_image = esc_url(get_stylesheet_directory_uri()).'/images/ogp/og-image-top.jpg';
?>
  <meta property="og:title" content="<?php echo esc_html($og_title); ?>">
  <meta property="og:type" content="<?php echo esc_html($og_type); ?>">
  <meta property="og:url" content="<?php echo esc_url($og_url); ?>">
<?php if($og_image): ?>
  <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
  <meta name="twitter:card" content="summary_large_image">
<?php   if($og_image_size and is_array($og_image_size)): ?>
  <meta property="og:image:width" content="<?php echo esc_attr($og_image_size[0]); ?>">
  <meta property="og:image:height" content="<?php echo esc_attr($og_image_size[1]); ?>">
<?php   endif; ?>
<?php endif; ?>
  <meta property="og:site_name" content="<?php echo esc_attr($og_site_name); ?>">
  <meta property="og:description" content="<?php echo esc_attr($description); ?>">
<?php if(isset($og_app_id) and $og_app_id != ''): ?>
  <meta property="fb:app_id" content="<?php echo esc_attr($og_app_id); ?>">
<?php endif; ?>