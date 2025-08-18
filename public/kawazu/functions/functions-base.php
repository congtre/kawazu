<?php
define('WP_AUTO_UPDATE_CORE', 'minor');

if(!current_user_can('administrator')):
  // 本体バージョンの更新非通知
  add_filter('pre_site_transient_update_core', '__return_null');

  // プラグインの更新非通知
  add_filter('pre_site_transient_update_plugins', '__return_null');

  // テーマファイルの更新非通知
  add_filter( 'pre_site_transient_update_themes', '__return_null');
endif;


//HTML5では不要なtype属性を削除
function custom_theme_setup(){
  add_theme_support('html5', array('style', 'script'));
}
add_action('after_setup_theme', 'custom_theme_setup');


// Disp Admin Favicon
function admin_favicon(){
 echo '<link rel="icon" href="'.esc_url(get_stylesheet_directory_uri()).'/images/common/favicon.ico" type="image/vnd.microsoft.icon">';
 echo '<link rel="apple-touch-icon" sizes="192x192" href="'.esc_url(get_stylesheet_directory_uri()).'/images/common/touch-icon.png">';
 echo '<link rel="shortcut icon" href="'.esc_url(get_stylesheet_directory_uri()).'/images/common/touch-icon.png">';
}
add_action('admin_head', 'admin_favicon');


function my_session(){
  if(session_status() !== PHP_SESSION_ACTIVE):
    session_start();
  endif;
}
//add_action('send_headers', 'my_session');
add_action('template_redirect', 'my_session');

function my_feed_request($vars){

  $args = array('public'=>true, 'show_ui'=>true);
  $post_types = get_post_types($args, 'objects');
  $post_type_array = array();
  if($post_types != '' and is_array($post_types)):
    foreach($post_types as $post_type):
      if($post_type->name == 'post' or $post_type->name == 'page' or $post_type->name == 'attachment') continue;
      //echo $post_type->name."<br>";
      //print_r($post_type);
      $post_type_array[] = $post_type->name;
    endforeach;
  endif;

  if(isset($vars['feed']) && !isset($vars['post_type'])){
    $vars['post_type'] = $post_type_array;
  }
  return $vars;
}
add_filter('request', 'my_feed_request');


// Authorページ非表示
add_filter('author_rewrite_rules', '__return_empty_array');
function disable_author_archive() {
  if(preg_match('#/author/.+#', $_SERVER['REQUEST_URI'])):
    header('HTTP/1.0 404 Not Found'); //ステータスコードを404に変更
    //wp_redirect(home_url('/404.php')); //404.phpにリダイレクト
    wp_redirect(home_url('/404/'));
    exit;
  endif;
}
add_action('init', 'disable_author_archive');


add_theme_support('title-tag');


//Title Separator
function wp_document_title_separator($separator){
  $separator = '｜';//|
  return $separator;
}
add_filter('document_title_separator', 'wp_document_title_separator');


function wp_document_title_parts($title) {
  $site_title = (get_option('my_site_title') != '') ? get_option('my_site_title') : get_bloginfo('name');
  $acf_id = '';
  //$check = '';

  if(is_front_page()):
    //$title['site'] = '';
    unset($title['site']);// デフォルトtitleリセット
    unset($title['tagline']);// キャッチフレーズを出力しない
    $title['title'] = $site_title;

  elseif(is_home()):
    unset($title['site']);
    $title['title'] = (!empty(get_option('my_archive_title_post'))) ? get_option('my_archive_title_post') : $title['title'];

  elseif(is_category() or is_tax()):
    unset($title['site']);
    $term_obj = get_queried_object();
    $acf_id = $term_obj->taxonomy.'_'.$term_obj->term_id;
    if($acf_id and get_field('my_title', $acf_id)):
      $title['title'] = get_field('my_title', $acf_id);
    else:
      $title['title'] = '「'.$title['title'].'」カテゴリーの記事一覧';
    endif;

  elseif(is_tag()):
    unset($title['site']);
    $title['title'] = '「'.$title['title'].'」タグの記事一覧';

  elseif(is_post_type_archive()):
    unset($title['site']);
    $post_type_slug = get_query_var('post_type');
    if($post_type_slug != '' and get_option('my_archive_title_'.$post_type_slug) != ''):
      $title['title'] = get_option('my_archive_title_'.$post_type_slug);
    else:
      $title['title'] = $title['title'].'の記事一覧';
    endif;

  elseif(is_archive()):
    unset($title['site']);
    $post_type_slug = get_query_var('post_type');
    if($post_type_slug != '' and get_option('my_archive_title_'.$post_type_slug) != ''):
      $title['title'] = get_option('my_archive_title_'.$post_type_slug);
    else:
      $title['title'] = $title['title'].'の記事一覧';
    endif;

  elseif(is_singular('post')):
    unset($title['site']);
    if(get_field('my_title')):
      $title['title'] = get_field('my_title');
    else:
      $title['title'] = $title['title'].'｜'.$site_title;
    endif;

  elseif(is_single()):
    unset($title['site']);
    if(get_field('my_title')):
      $title['title'] = get_field('my_title');
    else:
      $post_type_slug = get_query_var('post_type');
      $post_type_name = get_post_type_object($post_type_slug)->label;
      $title['title'] = $title['title'].'｜'.$post_type_name.'｜'.$site_title;
    endif;

  elseif(is_page()):
    unset($title['site']);
    $title['title'] = $title['title'].'｜'.$site_title;

  elseif(is_404()):
    unset($title['site']);
    $title['title'] = 'ページが見つかりませんでした｜'.$site_title;

  elseif(is_page()):
    unset($title['site']);
    if(get_field('my_title')):
      $title['title'] = get_field('my_title');
    else:
      $title['title'] = $title['title'].' | '.$site_title;
    endif;

  endif;
  //$title['title'] = $title['title'].$check;
  return $title;
}
add_filter('document_title_parts', 'wp_document_title_parts', 10, 1);



function news_paginate_number($format){
  $number = intval($format);
  if(is_post_type_archive('news')):
    if(intval($number / 10) > 0):
      return $format;
    else:
      return '0'.$format;
    endif;
  else:
    return $format;
  endif;
}
//add_filter('number_format_i18n', 'news_paginate_number');



add_theme_support('post-thumbnails');


//add_editor_style(get_stylesheet_directory_uri().'/admin/css/my-editor-style.css?t='.time());


function my_admin_style(){
  $param = '?t='.time();
  wp_enqueue_style('my_admin_style', get_stylesheet_directory_uri().'/admin/css/my-admin-style.css'.$param);
  wp_enqueue_style('my_editor_style', get_stylesheet_directory_uri().'/admin/css/my-editor-style.css'.$param);
  wp_enqueue_style('my_admin_base_content2', get_stylesheet_directory_uri().'/common/css/base-content2.css'.$param);
}
add_action('admin_enqueue_scripts','my_admin_style');


function my_admin_script(){
  $param = '?t='.time();
  wp_enqueue_script('my_admin_script', get_stylesheet_directory_uri().'/admin/js/my-admin-script.js'.$param);
  wp_enqueue_script('call-media-uploader-v3', get_stylesheet_directory_uri().'/admin/js/call_media_uploader_v3.js', array(), false, true);
  wp_enqueue_script('call-media-uploader-v4', get_stylesheet_directory_uri().'/admin/js/call_media_uploader_v4.js', array(), false, true);
  wp_enqueue_media();
}
add_action('admin_enqueue_scripts','my_admin_script');


function add_post_id_to_admin_body_class($classes){
  global $post;
  if(is_object($post)):
    $classes .= ' post-id-' . $post->ID;
  endif;
  return $classes;
}
add_filter('admin_body_class', 'add_post_id_to_admin_body_class');


function my_wp_kses_allowed_html($tags, $context){
  $tags['source']['srcset'] = true;
  return $tags;
}
add_filter('wp_kses_allowed_html', 'my_wp_kses_allowed_html', 10, 2);


add_action('restrict_manage_posts', function() {
  global $post_type;
  if (!in_array($post_type, ['shop'])) return;
  $taxonomy = 'shop-area';
  $terms = get_terms($taxonomy);
  if(empty($terms)) return;
  $selected = get_query_var($taxonomy);
  $options = '';
  foreach($terms as $term){
    $options .= sprintf('<option value="%s" %s>%s</option>'
      ,$term->slug
      ,($selected==$term->slug) ? 'selected="selected"' : ''
      ,$term->name
    );
  }
  $select = '<select name="%s"><option value="">すべてのエリア</option>%s</select>';
  printf($select, $taxonomy, $options);
});


// ADMIN NEWS ARCHIVE
function add_news_columns($columns){
  //$columns['thumbnail'] = 'アイキャッチ';
  $columns = array(
    'cb' => '<input type="checkbox">',
    'title' => 'タイトル',
    'taxonomy' => 'カテゴリ',
    'thumbnail' => 'アイキャッチ',
    'date' => '日付',
    'author' => '作成者',
  );
  return $columns;
}
add_filter('manage_edit-news_columns', 'add_news_columns');

function add_news_columns_list($column_name, $post_id){
  if($column_name == 'taxonomy'):
    $terms = get_the_terms($post_id, 'news-cat');
    if($terms):
      $cnt = 0;
      foreach($terms as $term):
        if($cnt !== 0) echo '&nbsp;&nbsp;';
        echo '<a href="'.admin_url().'edit.php?post_type=news&taxonomy=news-cat&term='.esc_attr($term->slug).'">'.esc_attr($term->name).'</a>';
        $cnt++;
      endforeach;
    endif;
  elseif($column_name == 'thumbnail'):
    $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
    //if($thumbnail) echo $thumbnail;
    if($thumbnail){
      echo $thumbnail;
    }else{
      echo '---';
    }
  endif;
}# add_news_columns_list
add_action('manage_news_posts_custom_column', 'add_news_columns_list', 10, 2);


// ADMIN RECRUIT EVENT ARCHIVE
function add_recruit_event_columns($columns){
  //$columns['thumbnail'] = 'アイキャッチ';
  $columns = array(
    'cb' => '<input type="checkbox">',
    'title' => 'タイトル',
    'taxonomy' => 'カテゴリ',
    'thumbnail' => 'アイキャッチ',
    'date' => '日付',
    'author' => '作成者',
  );
  return $columns;
}
add_filter('manage_edit-recruit-event_columns', 'add_recruit_event_columns');

function add_recruit_event_columns_list($column_name, $post_id){
  if($column_name == 'taxonomy'):
    $terms = get_the_terms($post_id, 'recruit-event-cat');
    if($terms):
      $cnt = 0;
      foreach($terms as $term):
        if($cnt !== 0) echo '&nbsp;&nbsp;';
        echo '<a href="'.admin_url().'edit.php?post_type=recruit-event&taxonomy=recruit-event-cat&term='.esc_attr($term->slug).'">'.esc_attr($term->name).'</a>';
        $cnt++;
      endforeach;
    endif;
  elseif($column_name == 'thumbnail'):
    $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
    //if($thumbnail) echo $thumbnail;
    if($thumbnail){
      echo $thumbnail;
    }else{
      echo '---';
    }
  endif;
}# add_recruit_event_columns_list
add_action('manage_recruit-event_posts_custom_column', 'add_recruit_event_columns_list', 10, 2);


// ADMIN PORTFOLIO ARCHIVE
function add_portfolio_columns($columns){
  //$columns['thumbnail'] = 'アイキャッチ';
  $columns = array(
    'cb' => '<input type="checkbox">',
    'title' => 'タイトル',
    'taxonomy' => 'カテゴリ',
    'disp_top' => 'TOP表示',
    'thumbnail' => 'アイキャッチ',
    'date' => '日付',
    'author' => '作成者',
  );
  return $columns;
}
add_filter('manage_edit-portfolio_columns', 'add_portfolio_columns');

function add_portfolio_columns_list($column_name, $post_id){
  if($column_name == 'taxonomy'):
    $terms = get_the_terms($post_id, 'portfolio-cat');
    if($terms):
      $cnt = 0;
      foreach($terms as $term):
        if($cnt !== 0) echo '&nbsp;&nbsp;';
        echo '<a href="'.admin_url().'edit.php?post_type=portfolio&taxonomy=portfolio-cat&term='.esc_attr($term->slug).'">'.esc_attr($term->name).'</a>';
        $cnt++;
      endforeach;
    endif;
  elseif($column_name == 'disp_top'):
    $disp_top = get_field('portfolio_disp_top', $post_id);
    if(is_array($disp_top) and in_array('表示する', $disp_top)):
      echo '表示する';
    endif;
  elseif($column_name == 'thumbnail'):
    $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
    //if($thumbnail) echo $thumbnail;
    if($thumbnail){
      echo $thumbnail;
    }else{
      echo '---';
    }
  endif;
}# add_portfolio_columns_list
add_action('manage_portfolio_posts_custom_column', 'add_portfolio_columns_list', 10, 2);


// ADMIN VISIT ARCHIVE
function add_visit_columns($columns){
  //'thumbnail' => 'アイキャッチ',
  $columns = array(
    'cb' => '<input type="checkbox">',
    'title' => 'タイトル',
    'taxonomy' => 'カテゴリ',
    'date' => '日付',
    'author' => '作成者',
  );
  return $columns;
}
add_filter('manage_edit-visit_columns', 'add_visit_columns');

function add_visit_columns_list($column_name, $post_id){
  if($column_name == 'taxonomy'):
    $terms = get_the_terms($post_id, 'visit-cat');
    if($terms):
      $cnt = 0;
      foreach($terms as $term):
        if($cnt !== 0) echo '&nbsp;&nbsp;';
        echo '<a href="'.admin_url().'edit.php?post_type=visit&taxonomy=visit-cat&term='.esc_attr($term->slug).'">'.esc_attr($term->name).'</a>';
        $cnt++;
      endforeach;
    endif;
  elseif($column_name == 'thumbnail'):
    $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
    //if($thumbnail) echo $thumbnail;
    if($thumbnail){
      echo $thumbnail;
    }else{
      echo '---';
    }
  endif;
}# add_visit_columns_list
add_action('manage_visit_posts_custom_column', 'add_visit_columns_list', 10, 2);



// ADMIN RESULT ARCHIVE
function add_result_columns($columns){
  //$columns['thumbnail'] = 'アイキャッチ';
  $columns = array(
    'cb' => '<input type="checkbox">',
    'title' => 'タイトル',
    'taxonomy' => 'カテゴリ',
    'thumbnail' => 'アイキャッチ',
    'date' => '日付',
    'author' => '作成者',
  );
  return $columns;
}
add_filter('manage_edit-result_columns','add_result_columns');

function add_result_columns_list($column_name, $post_id){
  if($column_name == 'taxonomy'):
    $terms = get_the_terms($post_id,'result-cat');
    if($terms):
      $cnt = 0;
      foreach($terms as $term):
        if($cnt !== 0) echo '&nbsp;&nbsp;';
        echo '<a href="'.admin_url().'edit.php?post_type=result&taxonomy=result-cat&term='.esc_attr($term->slug).'">'.esc_attr($term->name).'</a>';
        $cnt++;
      endforeach;
    endif;
  elseif($column_name == 'thumbnail'):
    $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
    //if($thumbnail) echo $thumbnail;
    if($thumbnail){
      echo $thumbnail;
    }else{
      echo '---';
    }
  endif;
}# add_result_columns_list
add_action('manage_result_posts_custom_column', 'add_result_columns_list', 10, 2);


// ADMIN VOICE ARCHIVE
function add_voice_columns($columns){
  //$columns['thumbnail'] = 'アイキャッチ';
  $columns = array(
    'cb' => '<input type="checkbox">',
    'title' => 'タイトル',
    'taxonomy' => 'カテゴリ',
    'date' => '日付',
    'author' => '作成者',
  );
  return $columns;
}
add_filter('manage_edit-voice_columns','add_voice_columns');

function add_voice_columns_list($column_name, $post_id){
  if($column_name == 'taxonomy'):
    $terms = get_the_terms($post_id,'voice-cat');
    if($terms):
      $cnt = 0;
      foreach($terms as $term):
        if($cnt !== 0) echo '&nbsp;/&nbsp;';
        echo '<a href="'.admin_url().'edit.php?post_type=voice&taxonomy=voice-cat&term='.esc_attr($term->slug).'">'.esc_attr($term->name).'</a>';
        $cnt++;
      endforeach;
    endif;
  elseif($column_name == 'thumbnail'):
    $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
    //if($thumbnail) echo $thumbnail;
    if($thumbnail){
      echo $thumbnail;
    }else{
      echo '---';
    }
  endif;
}# add_voice_columns_list
add_action('manage_voice_posts_custom_column', 'add_voice_columns_list', 10, 2);


// ADMIN RECRUIT ARCHIVE
function add_recruit_columns($columns){
  //$columns['thumbnail'] = 'アイキャッチ';
  $columns = array(
    'cb' => '<input type="checkbox">',
    'title' => 'タイトル',
    'thumbnail' => 'アイキャッチ',
    'date' => '日付',
    'author' => '作成者',
  );
  return $columns;
}
add_filter('manage_edit-recruit_columns','add_recruit_columns');

function add_recruit_columns_list($column_name, $post_id){
  if($column_name == 'taxonomy'):
    $terms = get_the_terms($post_id,'recruit-cat');
    if($terms):
      $cnt = 0;
      foreach($terms as $term):
        if($cnt !== 0) echo '&nbsp;/&nbsp;';
        echo '<a href="'.admin_url().'edit.php?post_type=recruit&taxonomy=recruit-cat&term='.esc_attr($term->slug).'">'.esc_attr($term->name).'</a>';
        $cnt++;
      endforeach;
    endif;
  elseif($column_name == 'thumbnail'):
    $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
    //if($thumbnail) echo $thumbnail;
    if($thumbnail){
      echo $thumbnail;
    }else{
      echo '---';
    }
  endif;
}# add_recruit_columns_list
add_action('manage_recruit_posts_custom_column', 'add_recruit_columns_list', 10, 2);



// ADMIN GALLERY ARCHIVE
function add_gallery_columns($columns){
  //$columns['thumbnail'] = 'アイキャッチ';
  $columns = array(
    'cb' => '<input type="checkbox">',
    'title' => 'タイトル',
    'image1' => 'フォト',
    'date' => '日付',
    'author' => '作成者',
  );
  return $columns;
}
add_filter('manage_edit-gallery_columns','add_gallery_columns');

function add_gallery_columns_list($column_name, $post_id){
  if($column_name == 'taxonomy'):
    $terms = get_the_terms($post_id,'gallery-cat');
    if($terms):
      $cnt = 0;
      foreach($terms as $term):
        if($cnt !== 0) echo '&nbsp;/&nbsp;';
        echo '<a href="'.admin_url().'edit.php?post_type=gallery&taxonomy=gallery-cat&term='.esc_attr($term->slug).'">'.esc_attr($term->name).'</a>';
        $cnt++;
      endforeach;
    endif;
  elseif($column_name == 'image1'):
    $image1 = wp_get_attachment_image(get_field('gallery_image1',$post_id), array(80,80), 'thumbnail');
    $image1 = ($image1) ? $image1 : '---';
    echo $image1;
  elseif($column_name == 'thumbnail'):
    $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
    //if($thumbnail) echo $thumbnail;
    if($thumbnail){
      echo $thumbnail;
    }else{
      echo '---';
    }
  endif;
}# add_gallery_columns_list
add_action('manage_gallery_posts_custom_column', 'add_gallery_columns_list', 10, 2);



// ADMIN PROGRAM ARCHIVE
function add_program_columns($columns){
  //$columns['thumbnail'] = 'アイキャッチ';
  $columns = array(
    'cb' => '<input type="checkbox">',
    'title' => 'タイトル',
    'slug' => 'スラッグ',
    'thumbnail' => 'アイキャッチ',
    'taxonomy' => 'カテゴリ',
    'date' => '日付',
    'author' => '作成者',
  );
  return $columns;
}
add_filter('manage_edit-program_columns','add_program_columns');

function add_program_columns_list($column_name, $post_id){
  if($column_name == 'slug'):
    $post = get_post($post_id);
    $slug = $post->post_name;
    echo esc_attr($slug);
  elseif($column_name == 'taxonomy'):
    $terms = get_the_terms($post_id,'program-cat');
    if($terms):
      $cnt = 0;
      foreach($terms as $term):
        if($cnt !== 0) echo '&nbsp;&nbsp;';
        echo '<a href="'.admin_url().'edit.php?post_type=program&taxonomy=program-cat&term='.esc_attr($term->slug).'">'.esc_attr($term->name).'</a>';
        $cnt++;
      endforeach;
    endif;
  elseif($column_name == 'thumbnail'):
    $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
    //if($thumbnail) echo $thumbnail;
    if($thumbnail){
      echo $thumbnail;
    }else{
      echo '---';
    }
  endif;
}# add_program_columns_list
add_action('manage_program_posts_custom_column', 'add_program_columns_list', 10, 2);




function add_shop_columns($columns){
  //$columns['eventdate'] = 'イベント日';
  //$columns['shoparea'] = 'エリア';
  //$columns['thumbnail'] = 'アイキャッチ';
  $cnt = 0;
  $columns0 = array();
  foreach($columns as $key => $value):
    $cnt++;
    if($cnt == '3'):
      $columns0['shoparea'] = 'エリア';
      $columns0[$key] = $value;
    else:
      $columns0[$key] = $value;
    endif;
  endforeach;
  return $columns0;
}
add_filter('manage_edit-shop_columns','add_shop_columns');

function add_shop_columns_list($column_name, $post_id){
  /*if($column_name == 'eventdate'):
    echo esc_html(get_field('event-cal'));*/
  if($column_name == 'shoparea'):
    $terms = get_the_terms($post_id,'shop-area');
    if($terms):
      $cnt = 0;
      foreach($terms as $term):
        if($cnt !== 0) echo '&nbsp;&nbsp;';
        //echo '<a href="/wp-admin/edit.php?post_type=shop&taxonomy=shop-area&term='.$term->slug.'">'.$term->name.'</a>';
        echo esc_html($term->name);
        $cnt++;
      endforeach;
    endif;
  endif;
  /*
  elseif($column_name == 'thumbnail'):
    $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
    //if($thumbnail) echo $thumbnail;
    if($thumbnail){
      echo $thumbnail;
    }else{
      echo '---';
    }
  endif;
  */

}# add_shop_columns_list
add_action('manage_shop_posts_custom_column', 'add_shop_columns_list', 10, 2);




# Visual Editor
function custom_tiny_mce_body_class($settings){
  $settings['body_class'] = 'my-editor';
  return $settings;
}
add_filter('tiny_mce_before_init','custom_tiny_mce_body_class');

function custom_editor_settings($init_array){
  $init_array['block_formats'] = "見出し2=h2; 見出し3=h3; 見出し4=h4; 見出し5=h5; 段落=p; グループ=div;";
  return $init_array;
}
add_filter('tiny_mce_before_init','custom_editor_settings');

function add_mce_buttons_2($buttons){
  $add = array('fontsizeselect','backcolor');//,'button_eek', 'button_green'
  return array_merge($buttons,$add);
}
add_filter('mce_buttons_2','add_mce_buttons_2');

function custom_tiny_mce_fontsize_formats($settings){
  $settings['fontsize_formats'] = '0.7rem 0.75rem 0.8rem 0.85rem 0.9rem 0.95rem 1.0rem 1.1rem 1.2rem 1.3rem 1.4rem 1.5rem 1.6rem 1.7rem 1.8rem 1.9rem 2.0rem 2.1rem 2.2rem 2.3rem';
  return $settings;
}
add_filter('tiny_mce_before_init','custom_tiny_mce_fontsize_formats');

# 'fontselect','wp_page','fontsizeselect','backcolor','cut','copy','paste','superscript','subscript'
# 'formatselect', // フォーマット
# 'bold',         // 太字
# 'italic',       // イタリック
# 'bullist',      // 番号なしリスト
# 'numlist',      // 番号付きリスト
# 'blockquote',   // 引用
# 'alignleft',    // 左寄せ
# 'aligncenter',  // 中央揃え
# 'alignright',   // 右寄せ
# 'link',         // リンクの挿入/編集
# 'unlink',       // リンクの削除
# 'wp_more',      // 「続きを読む」タグを挿入
# 'wp_adv',       // ツールバー切り替え
# 'dfw'           // 集中執筆モード
# 'strikethrough', // 打ち消し
# 'hr',            // 横ライン
# 'forecolor',     // テキスト色
# 'pastetext',     // テキストとしてペースト
# 'removeformat',  // 書式設定をクリア
# 'charmap',       // 特殊文字
# 'outdent',       // インデントを減らす
# 'indent',        // インデントを増やす
# 'undo',          // 取り消し
# 'redo',          // やり直し
# 'wp_help'        // キーボードショートカット
# /Visual Editor



function change_default_enter_title($title){

  $screen = get_current_screen();

/*  if($screen->post_type == 'post'):
    $title = 'ここにタイトルを入力。タイトルは一覧では35文字まで表示されます。';

  elseif($screen->post_type == 'page'):
    $title = '固定ページのタイトルを入力';
  endif;
*/
  return $title;

}# func change_default_enter_title
//add_filter('enter_title_here','change_default_enter_title');


function my_title_fix($title, $sep, $seplocation){
  if(!$sep || $sep == '｜'):
    $title = preg_replace('/ '.$sep.' /', $sep, $title);
  endif;
  if(is_tax('news-cat')):
    $title = preg_replace('/NEWSカテゴリ｜/', '', $title);
  endif;
  return $title;
}
//add_filter('wp_title', 'my_title_fix', 10, 3);



function the_content_replace($text){
  $access_map = '<div class="boxMap">'.get_field('access_googlemap_tag').'</div>
<div class="boxAccess01">
  <div class="boxAddress">住所: '.esc_html(get_option('my_address')).'</div>
  <div class="boxTelno">TEL: '.esc_html(get_option('my_telno')).'</div>
</div>
';
  $replace = array(
  '<p>%GOOGLEMAP%</p>' => $access_map,
  );
  $text = str_replace(array_keys($replace), $replace, $text);
  return $text;
}
//add_filter('the_content', 'the_content_replace');


function add_page_columns_name($columns){
  $columns['slug'] = "スラッグ";
  return $columns;
}
function add_page_column($column_name, $post_id){
  if($column_name == 'slug'):
    $post = get_post($post_id);
    $slug = $post->post_name;
    echo esc_attr($slug);
  endif;
}
add_filter('manage_pages_columns', 'add_page_columns_name');
add_action('manage_pages_custom_column', 'add_page_column', 10, 2);


function override_mce_options( $init_array ) {
  global $allowedposttags;

  $init_array['valid_elements']          = '*[*]';
  $init_array['extended_valid_elements'] = '*[*]';
  $init_array['valid_children']          = '+a[' . implode( '|', array_keys( $allowedposttags ) ) . ']';
  $init_array['indent']                  = true;
  $init_array['wpautop']                 = false;

  return $init_array;
}
add_filter( 'tiny_mce_before_init', 'override_mce_options' );


function my_excerpt_mblength($length){
  //default: 110
  if(is_post_type_archive('news') or is_tax('news-cat')):
    return 100;
  elseif(is_post_type_archive('recruit') or is_tax('recruit-cat')):
    return 100;
  elseif(is_post_type_archive('event') or is_tax('event-cat')):
    return 100;
  elseif(is_post_type_archive('voice') or is_tax('voice-cat')):
    return 70;
  else:
    return 26;
  endif;
}
add_filter('excerpt_mblength','my_excerpt_mblength');

function my_excerpt_more($post){
  //return '…<div class="boxMore"><a href="'.esc_url(get_permalink($post->ID)).'" class="linkMore">続きを読む</a></div>';
  return '…';
}
add_filter('excerpt_more','my_excerpt_more');


//カテゴリーツリーを維持させる
function category_tree_retention( $args, $post_id ){
  if( !isset( $args['checked_ontop'] ) || $args['checked_ontop'] !== false){
    $args['checked_ontop'] = false;
  }
  return $args;
}
add_filter( 'wp_terms_checklist_args', 'category_tree_retention', 10 , 2 );


// 記事内、固定ページ内にPHPファイル(任意のファイル)を読み込ませる方法 - ショートコード
function Include_my_php($params = array()){
    extract(shortcode_atts(array(
        'file' => 'default'
        ),
        $params)
    );
    ob_start();
    //include(get_theme_root().'/'.get_template()."/$file.php");
    get_template_part($file);
    return ob_get_clean();
}
add_shortcode('myphp', 'Include_my_php');
// 投稿・固定ページ内に記述するタグ(popo.phpを読み込ませる場合)
// [myphp file='popo']


function remove_admin_menus(){

  //$userinfo = wp_get_current_user();
  //if($userinfo->roles[0] != 'administrator'):
  //if($userinfo->user_login == 'opendesign2'):

    global $menu;
    // unsetで非表示にするメニューを指定
    //unset($menu[2]);        // ダッシュボード
    unset($menu[5]);        // 投稿
    $menu[19] = $menu[10];//メディアの位置を19(固定ページ上)に移動
    unset($menu[10]);       // メディア
    //unset($menu[20]);       // 固定ページ
    unset($menu[25]);       // コメント
    //unset($menu[60]);       // 外観
    //unset($menu[65]);       // プラグイン
    //unset($menu[70]);       // ユーザー
    //unset($menu[75]);       // ツール
    //unset($menu[80]);       // 設定

    //remove_menu_page('edit.php?post_type=course');
    //remove_menu_page('edit.php?post_type=faq');
  //endif;
}
add_action('admin_menu', 'remove_admin_menus');


function change_posts_per_page($query){

  if(is_admin() || ! $query->is_main_query()) return;

/*
  if($query->is_page_template('archive-seminar.php')):
    $query->set('posts_per_page','2');
  endif;
*/

  if($query->is_search()):
    //$query->set('post_type', array('post', 'page', 'event'));
  endif;

  if($query->is_archive()):
    $query->set('post_status', 'publish');
    $query->set('posts_per_page','10');
    $query->set('orderby', array('menu_order'=>'ASC', 'date'=>'DESC'));
  endif;

  if($query->is_category()):
    $query->set('post_status', 'publish');
    $query->set('posts_per_page','10');
    $query->set('orderby', array('menu_order'=>'ASC', 'date'=>'DESC'));
  endif;

  if($query->is_month()):
    $query->set('post_status', 'publish');
    $query->set('posts_per_page','10');
    $query->set('orderby', array('menu_order'=>'ASC', 'date'=>'DESC'));
  endif;

  if($query->is_author()):
    $query->set('post_status', 'publish');
    $query->set('posts_per_page','10');
    $query->set('orderby', array('menu_order'=>'ASC', 'date'=>'DESC'));
  endif;

  if($query->is_post_type_archive()):
    $query->set('post_status', 'publish');
    $query->set('posts_per_page','10');
    $query->set('orderby', array('menu_order'=>'ASC', 'date'=>'DESC'));
  endif;

  if($query->is_tax()):
    $query->set('post_status', 'publish');
    $query->set('posts_per_page','10');
    $query->set('orderby', array('menu_order'=>'ASC', 'date'=>'DESC'));
  endif;

  if($query->is_post_type_archive('news')):
    $query->set('post_status', 'publish');
    $query->set('posts_per_page','15');
    $query->set('orderby', array('menu_order'=>'ASC', 'date'=>'DESC'));
  endif;

  if($query->is_tax('news-cat')):
    $query->set('post_status', 'publish');
    $query->set('posts_per_page','15');
    $query->set('orderby', array('menu_order'=>'ASC', 'date'=>'DESC'));
  endif;

  if($query->is_post_type_archive('faq')):
    $query->set('post_status', 'publish');
    $query->set('posts_per_page','10');
    $query->set('orderby', array('menu_order'=>'ASC', 'date'=>'DESC'));
  endif;

  if($query->is_tax('faq-cat')):
    $query->set('post_status', 'publish');
    $query->set('posts_per_page','10');
    $query->set('orderby', array('menu_order'=>'ASC', 'date'=>'DESC'));
  endif;

}
add_action('pre_get_posts','change_posts_per_page');



?>