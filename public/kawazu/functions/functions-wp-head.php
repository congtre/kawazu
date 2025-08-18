<?php
/* Delete Header Parts */
remove_action('wp_head','wp_generator');
remove_action('wp_head','wlwmanifest_link');
remove_action('wp_head','rsd_link');
remove_action('wp_head','wp_shortlink_wp_head');
remove_action('wp_head','adjacent_posts_rel_link_wp_head');
remove_action('wp_head','index_rel_link');
remove_action('wp_head','start_post_rel_link');
remove_action('wp_head','feed_links_extra', 3);
remove_action('wp_head','print_emoji_detection_script', 7);
remove_action('wp_print_styles','print_emoji_styles');
/* /Delete Header Parts */



function my_import_files(){

  global $post;
  $add_param = '?'.time();
  /* CSS */
  wp_enqueue_style('style', get_stylesheet_uri());
  //wp_enqueue_style('style-google-fonts1', '//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap');
  //wp_enqueue_style('style-google-fonts2', '//fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;500;600;700&display=swap');
  //wp_enqueue_style('style-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css');
  //wp_enqueue_style('style-jquery-ui', esc_url(get_stylesheet_directory_uri()).'/common/jquery-ui-1.12.1/jquery-ui.min.css');

  wp_enqueue_style('style-base', esc_url(get_stylesheet_directory_uri()).'/common/css/base.css'.$add_param);
  wp_enqueue_style('style-module', esc_url(get_stylesheet_directory_uri()).'/common/css/module.css'.$add_param);

  wp_enqueue_style('style-base-layout', esc_url(get_stylesheet_directory_uri()).'/common/css/base-layout.css'.$add_param);
  wp_enqueue_style('style-base-content', esc_url(get_stylesheet_directory_uri()).'/common/css/base-content.css'.$add_param);
  wp_enqueue_style('style-common', esc_url(get_stylesheet_directory_uri()).'/common/css/common.css'.$add_param);
  wp_enqueue_style('style-content', esc_url(get_stylesheet_directory_uri()).'/common/css/content.css'.$add_param);
  wp_enqueue_style('style-animation', esc_url(get_stylesheet_directory_uri()).'/common/css/animation.css'.$add_param);

  if(is_front_page()):
    wp_enqueue_style('style-nkslider-fadein-v2', esc_url(get_stylesheet_directory_uri()).'/common/css/nkslider-fadein-v2.css'.$add_param);
    //wp_enqueue_style('style-nkslider-for-archive', esc_url(get_stylesheet_directory_uri()).'/common/css/nkslider-for-archive.css'.$add_param);
  endif;


  /* JS */
  wp_enqueue_script('js-jquery', esc_url(get_stylesheet_directory_uri()).'/common/js/jquery-1.12.1.min.js');
  //wp_enqueue_script('js-jquery-cookies', esc_url(get_stylesheet_directory_uri()).'/common/js/jquery.cookie.js');
  //wp_enqueue_script('js-jquery-ui', esc_url(get_stylesheet_directory_uri()).'/common/jquery-ui-1.12.1/jquery-ui.min.js');
  wp_enqueue_script('js-base', esc_url(get_stylesheet_directory_uri()).'/common/js/base.js'.$add_param, array(), '1.0', true);
  wp_enqueue_script('js-common', esc_url(get_stylesheet_directory_uri()).'/common/js/common.js'.$add_param, array(), '1.0', true);
  wp_enqueue_script('js-menu', esc_url(get_stylesheet_directory_uri()).'/common/js/menu.js'.$add_param, array(), '1.0', true);
  wp_enqueue_script('js-scroll-posi', esc_url(get_stylesheet_directory_uri()).'/common/js/scroll-posi.js'.$add_param, array(), '1.0', true);
  wp_enqueue_script('js-animation', esc_url(get_stylesheet_directory_uri()).'/common/js/animation.js'.$add_param, array(), '1.0', true);

  if(is_front_page()):
    //wp_enqueue_script('js-loading', esc_url(get_stylesheet_directory_uri()).'/common/js/loading.js');
    wp_enqueue_script('js-nkslider-fadein-v2', esc_url(get_stylesheet_directory_uri()).'/common/js/nkslider-fadein-v2.js'.$add_param, array(), '1.0', true);
    //wp_enqueue_script('js-nkslider-for-archive', esc_url(get_stylesheet_directory_uri()).'/common/js/nkslider-for-archive.js'.$add_param, array(), '1.0', true);
  endif;

  if(is_page('base-design-code')):
    wp_enqueue_script('js-csnkslider-a', esc_url(get_stylesheet_directory_uri()).'/common/js/csnkslider-a.js'.$add_param, array(), '1.0', true);
  endif;

}
// add_action('wp_enqueue_scripts','my_import_files');



function add_meta_to_head(){
  get_template_part('tmp/tmp-meta');
  get_template_part('tmp/tmp-ogp');
  //get_template_part('tmp/tmp-google-for-jobs');
  echo '  <meta name="format-detection" content="telephone=no">'."\n";
  echo '  <link rel="alternate" type="application/rss+xml" title="'.esc_attr(get_option('my_site_name')).' Feed" href="'.esc_url(home_url('/')).'feed/">'."\n";
  echo '  <link rel="icon" href="'.esc_url(get_stylesheet_directory_uri()).'/images/common/favicon.ico">'."\n";
  echo '  <link rel="apple-touch-icon" sizes="192x192" href="'.esc_url(get_stylesheet_directory_uri()).'/images/common/touch-icon.png">'."\n";
  //echo '  <link rel="preconnect" href="https://fonts.googleapis.com">'."\n";
  //echo '  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>'."\n";
}
add_action('wp_head', 'add_meta_to_head', 1);

function theme_sources() {
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_stylesheet_directory_uri().'/assets/js/jquery-3.5.1.min.js', array(), '', 1);

    wp_enqueue_style('aos-css', get_stylesheet_directory_uri().'/assets/vender/aos/aos.css', array(), time());
    wp_enqueue_script('aos-js', get_stylesheet_directory_uri().'/assets/vender/aos/aos.js', array(), '', 1);

    wp_enqueue_style('common-css', get_stylesheet_directory_uri().'/assets/css/common.css', array(), time());

    if (is_front_page()) {
        wp_enqueue_style('swiper-css', get_stylesheet_directory_uri().'/assets/vender/swiper/swiper.css', array(), time());
        wp_enqueue_script('swiper-js', get_stylesheet_directory_uri().'/assets/vender/swiper/swiper.js', array(), '', 1);

        wp_enqueue_style('top-css', get_stylesheet_directory_uri().'/assets/css/top.css', array(), time());
        wp_enqueue_script('backface_fixed-js', get_stylesheet_directory_uri().'/assets/js/backface_fixed.js', array(), time(), 1);
    }

    if (is_archive('vehicle_introduction')) {
        wp_enqueue_style('vehicle-css', get_stylesheet_directory_uri().'/assets/css/vehicle.css', array(), time());
    }

    if (is_singular('vehicle_introduction')) {
        wp_enqueue_style('swiper-css', get_stylesheet_directory_uri().'/assets/vender/swiper/swiper.css', array(), time());
        wp_enqueue_script('swiper-js', get_stylesheet_directory_uri().'/assets/vender/swiper/swiper.js', array(), '', 1);
        wp_enqueue_style('vehicle_detail-css', get_stylesheet_directory_uri().'/assets/css/vehicle_detail.css', array(), time());
        wp_enqueue_script('vehicle_detail-js', get_stylesheet_directory_uri().'/assets/js/vehicle_detail.js', array(), time(), 1);
    }

    if (is_404()) {
        wp_enqueue_style('p404-css', get_stylesheet_directory_uri().'/assets/css/p404.css', array(), time());
    }

    wp_enqueue_script('common-m', get_stylesheet_directory_uri().'/assets/js/common.js', array(), time(), 1);
}
add_action('wp_enqueue_scripts', 'theme_sources');

function custom_gutenberg_max_width() {
    $custom_css = "
        .editor-styles-wrapper .wp-block {
            max-width: 1200px !important;
        }
    ";
    wp_add_inline_style( 'wp-block-library', $custom_css );
}
add_action( 'enqueue_block_editor_assets', 'custom_gutenberg_max_width' );

function get_post_order_number( $post_id = null, $args = [] ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $defaults = [
        'post_type'      => 'vehicle_introduction',
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'ASC',
        'fields'         => 'ids',
        'posts_per_page' => -1,
    ];

    $query_args = wp_parse_args( $args, $defaults );

    $all_posts = get_posts( $query_args );

    $position = array_search( $post_id, $all_posts );

    return $position !== false ? str_pad($position + 1, 2, '0', STR_PAD_LEFT) : false;
}
