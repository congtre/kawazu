<?php
function my_class_names($classes){

  if(is_404()) $classes[] = 'page404';

  if(is_page()):
    global $post;
    $page_slug = $post->post_name;
    if(preg_match('/^[0-9a-z\-\_]+$/', $page_slug)):
      $page_slug = preg_replace_callback('/\-(.)/', 'callback_ucfirst_str', $page_slug);
      $classes[] = 'page'.ucfirst($page_slug);
    endif;
  endif;

  if(is_home() or is_singular('post')):
    $classes[] = 'pagePost';
  endif;

  if(is_post_type_archive()):
    //$post_type = get_post_type();
    $post_type = get_query_var('post_type');
    $post_type = preg_replace_callback('/\-(.)/', 'callback_ucfirst_str', $post_type);
    $post_type = preg_replace_callback('/\_(.)/', 'callback_ucfirst_str', $post_type);
    if($post_type):
      $classes[] = 'page'.ucfirst($post_type);
    endif;
  endif;

  if(is_category()):
    $classes[] = 'pagePost';
  endif;

  if(is_tax() or is_category()):
    //$post_type = get_post_type();
    $post_type = get_taxonomy(get_queried_object()->taxonomy)->object_type[0];
    $post_type = preg_replace_callback('/\-(.)/', 'callback_ucfirst_str', $post_type);
    $post_type = preg_replace_callback('/\_(.)/', 'callback_ucfirst_str', $post_type);
    if($post_type):
      $classes[] = 'page'.ucfirst($post_type);
    endif;
  endif;

  if(is_singular() and !is_page()):
    //$post_type = get_post_type();
    $post_type = get_query_var('post_type');
    $post_type = preg_replace_callback('/\-(.)/', 'callback_ucfirst_str', $post_type);
    $post_type = preg_replace_callback('/\_(.)/', 'callback_ucfirst_str', $post_type);
    if($post_type):
      $classes[] = 'page'.ucfirst($post_type);
    endif;
  endif;

  if(isset($_GET['pcode']) and $_GET['pcode'] == '123') $classes[] = 'modeTest';

  return $classes;

}
add_filter('body_class', 'my_class_names');



function callback_ucfirst_str($matches){
  return ucfirst($matches[1]);
}



function get_page_data(){

  $page_data_array = array();
  $ttl_en_type = 'upper';//ucfirst

  if(is_home() or is_singular('post')):
    $post_page_title = '';
    $post_page_slug = '';
    if($post_page_id = get_option('page_for_posts')):
      $post_page_title = get_the_title($post_page_id);
      $post_page_slug = get_post($post_page_id)->post_name;
    endif;
    $page_data_array['mv_ttl'] = esc_html($post_page_title);
    $post_page_slug = (get_option('my_archive_mv_title_en_post')) ? get_option('my_archive_mv_title_en_post') : $post_page_slug;

    if(get_field('mv_ttl_en')):
      $page_data_array['mv_ttl_en'] = get_field('mv_ttl_en');
    elseif(get_option('my_archive_mv_title_en_post')):
      $page_data_array['mv_ttl_en'] = get_option('my_archive_mv_title_en_post');
    else:
      $page_data_array['mv_ttl_en'] = $post_page_slug;
    endif;
    if($ttl_en_type == 'upper'):
      $page_data_array['mv_ttl_en'] = esc_html(strtoupper(urldecode($page_data_array['mv_ttl_en'])));
    else:
      $page_data_array['mv_ttl_en'] = esc_html(ucfirst(urldecode($page_data_array['mv_ttl_en'])));
    endif;
    $page_data_array['post_type'] = esc_html($post_page_slug);
    $page_data_array['post_type_name'] = esc_html($post_page_title);

    if(get_field('mv_img')):
      $page_data_array['mv_img'] = get_field('mv_img');
    elseif(get_option('my_archive_mv_img_post')):
      $page_data_array['mv_img'] = get_option('my_archive_mv_img_post');
    else:
      $page_data_array['mv_img'] = get_stylesheet_directory_uri().'/images/base/base-mv.jpg';
    endif;

    if(get_field('mv_img_sp')):
      $page_data_array['mv_img_sp'] = get_field('mv_img_sp');
    elseif(get_option('my_archive_mv_img_sp_post')):
      $page_data_array['mv_img_sp'] = get_option('my_archive_mv_img_sp_post');
    else:
      $page_data_array['mv_img_sp'] = get_stylesheet_directory_uri().'/images/base/base-mv-sp.jpg';
    endif;


  elseif(is_category() or is_tag()):
    $post_page_title = '';
    $post_page_slug = '';
    if($post_page_id = get_option('page_for_posts')):
      $post_page_title = get_the_title($post_page_id);
      $post_page_slug = get_post($post_page_id)->post_name;
    endif;
    $page_data_array['post_type'] = esc_html($post_page_slug);
    $page_data_array['post_type_name'] = esc_html($post_page_title);

    global $wp_query;
    $post_obj = $wp_query->get_queried_object();
    $page_data_array['mv_ttl'] = esc_html($post_obj->name).' '.esc_html($post_page_title);

    //$page_data_array['mv_ttl_en'] = esc_html(urldecode(ucfirst($post_obj->slug))).' '.esc_html(urldecode(ucfirst($post_page_slug)));
    if(get_field('mv_ttl_en', $acf_id)):
      $page_data_array['mv_ttl_en'] = get_field('mv_ttl_en', $acf_id);
    elseif(get_option('my_archive_mv_title_en_post')):
      $page_data_array['mv_ttl_en'] = get_option('my_archive_mv_title_en_post');
    else:
      $page_data_array['mv_ttl_en'] = $post_obj->slug;
    endif;
    if($ttl_en_type == 'upper'):
      $page_data_array['mv_ttl_en'] = esc_html(strtoupper(urldecode($page_data_array['mv_ttl_en'])));
    else:
      $page_data_array['mv_ttl_en'] = esc_html(ucfirst(urldecode($page_data_array['mv_ttl_en'])));
    endif;

    $page_data_array['mv_ttl_parent'] = esc_html($post_page_title);

    $acf_id = get_queried_object()->taxonomy.'_'.get_queried_object()->term_id;
    if(get_queried_object()->taxonomy and get_field('mv_img', $acf_id)):
      $page_data_array['mv_img'] = get_field('mv_img', $acf_id);
    elseif(get_option('my_archive_mv_img_post')):
      $page_data_array['mv_img'] = get_option('my_archive_mv_img_post');
    else:
      $page_data_array['mv_img'] = get_stylesheet_directory_uri().'/images/base/base-mv.jpg';
    endif;

    if(get_queried_object()->taxonomy and get_field('mv_img_sp', $acf_id)):
      $page_data_array['mv_img_sp'] = get_field('mv_img_sp', $acf_id);
    elseif(get_option('my_archive_mv_img_sp_post')):
      $page_data_array['mv_img_sp'] = get_option('my_archive_mv_img_sp_post');
    else:
      $page_data_array['mv_img_sp'] = get_stylesheet_directory_uri().'/images/base/base-mv-sp.jpg';
    endif;


  elseif(is_single()):
    $page_data_array['post_type'] = esc_html(get_query_var('post_type'));
    $page_data_array['post_type_name'] = esc_html(get_post_type_object($page_data_array['post_type'])->label);
    $page_data_array['mv_ttl'] = esc_html($page_data_array['post_type_name']);

    if(get_field('mv_ttl_en')):
      $page_data_array['mv_ttl_en'] = get_field('mv_ttl_en');
    elseif(get_option('my_archive_mv_title_en_'.$page_data_array['post_type'])):
      $page_data_array['mv_ttl_en'] = get_option('my_archive_mv_title_en_'.$page_data_array['post_type']);
    else:
      $page_data_array['mv_ttl_en'] = $page_data_array['post_type'];
    endif;
    if($ttl_en_type == 'upper'):
      $page_data_array['mv_ttl_en'] = esc_html(strtoupper($page_data_array['mv_ttl_en']));
    else:
      $page_data_array['mv_ttl_en'] = esc_html(ucfirst($page_data_array['mv_ttl_en']));
    endif;

    //$page_data_array['mv_ttl_parent'] = esc_html($page_data_array['post_type_name']);

    if(get_field('mv_img')):
      $page_data_array['mv_img'] = get_field('mv_img');
    elseif(get_query_var('post_type') and get_option('my_archive_mv_img_'.get_query_var('post_type'))):
      $page_data_array['mv_img'] = get_option('my_archive_mv_img_'.get_query_var('post_type'));
    else:
      $page_data_array['mv_img'] = get_stylesheet_directory_uri().'/images/base/base-mv.jpg';
    endif;

    if(get_field('mv_img_sp')):
      $page_data_array['mv_img_sp'] = get_field('mv_img_sp');
    elseif(get_query_var('post_type') and get_option('my_archive_mv_img_sp_'.get_query_var('post_type'))):
      $page_data_array['mv_img_sp'] = get_option('my_archive_mv_img_sp_'.get_query_var('post_type'));
    else:
      $page_data_array['mv_img_sp'] = get_stylesheet_directory_uri().'/images/base/base-mv-sp.jpg';
    endif;


  elseif(is_post_type_archive() and !is_month()):
    $page_data_array['post_type'] = esc_html(get_query_var('post_type'));
    $page_data_array['post_type_name'] = esc_html(get_post_type_object($page_data_array['post_type'])->label);
    $page_data_array['mv_ttl'] = esc_html($page_data_array['post_type_name']);

    if(get_query_var('post_type') and get_option('my_archive_mv_title_en_'.$page_data_array['post_type'])):
      $page_data_array['mv_ttl_en'] = esc_html(get_option('my_archive_mv_title_en_'.$page_data_array['post_type']));
    else:
      $page_data_array['mv_ttl_en'] = $page_data_array['post_type'];
    endif;
    if($ttl_en_type == 'upper'):
      $page_data_array['mv_ttl_en'] = esc_html(strtoupper($page_data_array['mv_ttl_en']));
    else:
      $page_data_array['mv_ttl_en'] = esc_html(ucfirst($page_data_array['mv_ttl_en']));
    endif;

    if(get_query_var('post_type') and get_option('my_archive_mv_img_'.get_query_var('post_type'))):
      $page_data_array['mv_img'] = get_option('my_archive_mv_img_'.get_query_var('post_type'));
    else:
      $page_data_array['mv_img'] = get_stylesheet_directory_uri().'/images/base/base-mv.jpg';
    endif;

    if(get_query_var('post_type') and get_option('my_archive_mv_img_sp_'.get_query_var('post_type'))):
      $page_data_array['mv_img_sp'] = get_option('my_archive_mv_img_sp_'.get_query_var('post_type'));
    else:
      $page_data_array['mv_img_sp'] = get_stylesheet_directory_uri().'/images/base/base-mv-sp.jpg';
    endif;


  elseif(is_tax()):
    $page_data_array['post_type'] = esc_html(get_taxonomy(get_queried_object()->taxonomy)->object_type[0]);
    $page_data_array['post_type_name'] = esc_html(get_post_type_object($page_data_array['post_type'])->label);
    $ttl_term = get_queried_object()->name;
    $acf_id = get_queried_object()->taxonomy.'_'.get_queried_object()->term_id;
    //$page_data_array['mv_ttl'] = esc_html($ttl_term).' '.esc_html($page_data_array['post_type_name']);
    $page_data_array['mv_ttl'] = esc_html($ttl_term);

    if(get_field('mv_ttl_en', $acf_id)):
      $page_data_array['mv_ttl_en'] = get_field('mv_ttl_en', $acf_id);
    elseif(get_option('my_archive_mv_title_en_'.$page_data_array['post_type'])):
      $page_data_array['mv_ttl_en'] = get_option('my_archive_mv_title_en_'.$page_data_array['post_type']);
    else:
      $page_data_array['mv_ttl_en'] = $page_data_array['post_type'];
    endif;
    if($ttl_en_type == 'upper'):
      $page_data_array['mv_ttl_en'] = esc_html(strtoupper($page_data_array['mv_ttl_en']));
    else:
      $page_data_array['mv_ttl_en'] = esc_html(ucfirst($page_data_array['mv_ttl_en']));
    endif;

    $page_data_array['mv_ttl_parent'] = esc_html($page_data_array['post_type_name']);

    if(get_field('mv_img', $acf_id)):
      $page_data_array['mv_img'] = get_field('mv_img', $acf_id);
    elseif($page_data_array['post_type'] and get_option('my_archive_mv_img_'.$page_data_array['post_type'])):
      $page_data_array['mv_img'] = get_option('my_archive_mv_img_'.$page_data_array['post_type']);
    else:
      $page_data_array['mv_img'] = get_stylesheet_directory_uri().'/images/base/base-mv.jpg';
    endif;

    if(get_field('mv_img_sp', $acf_id)):
      $page_data_array['mv_img_sp'] = get_field('mv_img_sp', $acf_id);
    elseif($page_data_array['post_type'] and get_option('my_archive_mv_img_sp_'.$page_data_array['post_type'])):
      $page_data_array['mv_img_sp'] = get_option('my_archive_mv_img_sp_'.$page_data_array['post_type']);
    else:
      $page_data_array['mv_img_sp'] = get_stylesheet_directory_uri().'/images/base/base-mv-sp.jpg';
    endif;


  elseif(is_month() and is_post_type_archive()):
    $page_data_array['post_type'] = esc_html(get_query_var('post_type'));
    $page_data_array['post_type_name'] = esc_html(get_post_type_object($page_data_array['post_type'])->label);
    $ttl_ym = '<span class="txtYM" ymdata="'.esc_html(get_query_var('year')).'年　'.esc_html(get_query_var('monthnum')).'月">'.esc_html(get_query_var('year')).'年'.esc_html(get_query_var('monthnum')).'月</span>';
    //$page_data_array['mv_ttl'] = $ttl_ym.' '.esc_html($page_data_array['post_type_name']);
    $page_data_array['mv_ttl'] = $ttl_ym;
    if($ttl_en_type == 'upper'):
      $page_data_array['mv_ttl_en'] = esc_html(strtoupper($page_data_array['post_type']));
    else:
      $page_data_array['mv_ttl_en'] = esc_html(ucfirst($page_data_array['post_type']));
    endif;
    $page_data_array['mv_ttl_parent'] = esc_html($page_data_array['post_type_name']);
    $page_data_array['mv_img'] = get_stylesheet_directory_uri().'/images/base/base-mv.jpg';
    $page_data_array['mv_img_sp'] = get_stylesheet_directory_uri().'/images/base/base-mv-sp.jpg';


  elseif(is_page()):
    global $post;
    $page_data_array['mv_ttl'] = esc_html(get_the_title());

    $page_data_array['mv_ttl_en'] = (get_field('mv_ttl_en')) ? get_field('mv_ttl_en') : $post->post_name;
    if($ttl_en_type == 'upper'):
      $page_data_array['mv_ttl_en'] = esc_html(strtoupper($page_data_array['mv_ttl_en']));
    else:
      $page_data_array['mv_ttl_en'] = esc_html(ucfirst($page_data_array['mv_ttl_en']));
    endif;

    if($parent_id = $post->post_parent):
      $page_data_array['mv_ttl_parent'] = esc_html(get_post($parent_id)->post_title);
    endif;

    $page_data_array['mv_img'] = (get_field('mv_img')) ? get_field('mv_img') : get_stylesheet_directory_uri().'/images/base/base-mv.jpg';
    $page_data_array['mv_img_sp'] = (get_field('mv_img_sp')) ? get_field('mv_img_sp') : get_stylesheet_directory_uri().'/images/base/base-mv-sp.jpg';


  elseif(is_404()):
    $page_data_array['mv_ttl'] = 'ページが見つかりません';
    if($ttl_en_type == 'upper'):
      $page_data_array['mv_ttl_en'] = '404 NOT FOUND';
    else:
      $page_data_array['mv_ttl_en'] = '404 Not Found';
    endif;
    $page_data_array['mv_img'] = get_stylesheet_directory_uri().'/images/base/base-mv.jpg';
    $page_data_array['mv_img_sp'] = get_stylesheet_directory_uri().'/images/base/base-mv-sp.jpg';


  elseif(is_search()):
    $page_data_array['mv_ttl'] = '検索結果：'.esc_html(get_search_query());
    if($ttl_en_type == 'upper'):
      $page_data_array['mv_ttl_en'] = 'SEARCH';
    else:
      $page_data_array['mv_ttl_en'] = 'Search';
    endif;
    $page_data_array['mv_img'] = get_stylesheet_directory_uri().'/images/base/base-mv.jpg';
    $page_data_array['mv_img_sp'] = get_stylesheet_directory_uri().'/images/base/base-mv-sp.jpg';


  else:
    $page_data_array['mv_ttl'] = esc_html(get_the_title());
    global $post;
    if($ttl_en_type == 'upper'):
      $page_data_array['mv_ttl_en'] = esc_html(strtoupper($post->post_name));
    else:
      $page_data_array['mv_ttl_en'] = esc_html(ucfirst($post->post_name));
    endif;
    $page_data_array['mv_img'] = get_stylesheet_directory_uri().'/images/base/base-mv.jpg';
    $page_data_array['mv_img_sp'] = get_stylesheet_directory_uri().'/images/base/base-mv-sp.jpg';

  endif;

  $page_data_array['mv_ttl_en'] = preg_replace('/\-/', ' ', $page_data_array['mv_ttl_en']);

  return $page_data_array;

}


function stripslashes_deep_custom($value){
  if(is_array($value)):
    return array_map('stripslashes_deep_custom', $value);
  elseif(is_object($value)):
    foreach($value as $key => $val):
      $value->$key = stripslashes_deep_custom($val);
    endforeach;
    return $value;
  else:
    return is_string($value) ? stripslashes($value) : $value;
  endif;
}


function get_page_slug(){
  if(is_page()):
    global $post;
    $slug = $post->post_name;
    return $slug;
  endif;
}


function get_parent_slug(){
  global $post;
  if($post->post_parent):
    $post_data = get_post($post->post_parent);
    return $post_data->post_name;
  endif;
}


function get_the_term_cont($taxonomy, $disp_type){

  //disp_type: typeBg / typeBorder / typeTag / typeNormal

  if(!$taxonomy or !get_the_ID()):
    return false;
  endif;

  $add_class = ($disp_type == 'typeBg' or $disp_type == 'typeBorder') ? ' '.$disp_type : '';
  $add_tag_mark = ($disp_type == 'typeTag') ? '#' : '';

  $taxonomy_slug = $taxonomy;
  $terms = wp_get_post_terms(get_the_ID(), $taxonomy_slug, array('orderby'=>'term_id', 'parent'=>false));
  $term_cont = '';
  if($terms and is_array($terms)):
    $term_cont .= '<ul class="ulBaseListCat'.esc_attr($add_class).'">'."\n";
    foreach($terms as $term):
      $add_color = '';
      $cat_bgcolor = (get_field('cat_bgcolor', $taxonomy_slug.'_'.$term->term_id)) ? get_field('cat_bgcolor', $taxonomy_slug.'_'.$term->term_id) : '#000';
      $cat_color = (get_field('cat_color', $taxonomy_slug.'_'.$term->term_id)) ? get_field('cat_color', $taxonomy_slug.'_'.$term->term_id) : '#fff';
      if($disp_type == 'typeBg'):
        $add_color = ' style="background-color:'.esc_attr($cat_bgcolor).'; color:'.esc_attr($cat_color).';"';
      elseif($disp_type == 'typeBorder'):
        $add_color = ' style="border: 1px '.esc_attr($cat_bgcolor).' solid; color:'.esc_attr($cat_color).';"';
      endif;
      $term_cont .= '<li'.$add_color.'>'.$add_tag_mark.esc_html($term->name);
      $terms2 = wp_get_post_terms(get_the_ID(), $taxonomy_slug, array('orderby'=>'term_id', 'parent'=>$term->term_id));
      if($terms2 and is_array($terms2)):
        $term_cont .= "\n".'<ul class="ulBaseListCatChild'.esc_attr($add_class).'">'."\n";
        foreach($terms2 as $term2):
          $add_color_child = '';
          $cat_bgcolor_child = (get_field('cat_bgcolor', $taxonomy_slug.'_'.$term2->term_id)) ? get_field('cat_bgcolor', $taxonomy_slug.'_'.$term2->term_id) : '#000';
          $cat_color_child = (get_field('cat_color', $taxonomy_slug.'_'.$term2->term_id)) ? get_field('cat_color', $taxonomy_slug.'_'.$term2->term_id) : '#fff';
          if($disp_type == 'typeBg'):
            $add_color_child = ' style="background-color:'.esc_attr($cat_bgcolor_child).'; color:'.esc_attr($cat_color_child).';"';
          elseif($disp_type == 'typeBorder'):
            $add_color_child = ' style="border: 1px '.esc_attr($cat_bgcolor_child).' solid; color:'.esc_attr($cat_color_child).';"';
          endif;
          $term_cont .= '<li'.$add_color_child.'>'.$add_tag_mark.esc_html($term2->name).'</li>'."\n";
        endforeach;
        $term_cont .= '</ul>'."\n";
      endif;
      $term_cont .= '</li>'."\n";
    endforeach;
    $term_cont .= '</ul>'."\n";
  endif;

  return $term_cont;
}



function csnk_convert_file_size($bytes){

  $bytes = floatval($bytes);
  $size_data_array = array(
    array(
      'byte' => pow(1024, 4),
      'unit' => 'TB',
    ),
    array(
      'byte' => pow(1024, 3),
      'unit' => 'GB',
    ),
    array(
      'byte' => pow(1024, 2),
      'unit' => 'MB',
    ),
    array(
      'byte' => 1024,
      'unit' => 'KB',
    ),
    array(
      'byte' => 1,
      'unit' => 'B',
    ),
  );

  foreach($size_data_array as $size_data):
    if($bytes >= $size_data['byte']):
      $result = $bytes / $size_data['byte'];
      if($size_data['unit'] == 'B' or $size_data['unit'] == 'KB'):
        $result = floor($result).$size_data['unit'];
      else:
        $result = round($result, 2).$size_data['unit'];
      endif;
      break;
    endif;
  endforeach;

  return $result;

}//csnk_convert_file_size


function encode_entity($str){
  if($str == '') return false;
  $convmap = array(0, 0x10FFFF, 0, 0x10FFFF);
  $str = mb_encode_numericentity($str, $convmap, 'UTF-8');
  return $str;
}


function tag_to_code($str) {
  $str = preg_replace('/\<br \/\>/us', '#br#', $str);
  $str = preg_replace('/\<br\/\>/us', '#br#', $str);
  $str = preg_replace('/\<br\>/us', '#br#', $str);
  return $str;
}# replace_tag


function code_to_tag($str) {
  $str = preg_replace('/\#br\#/us', '<br>', $str);
  $str = preg_replace('/\#brSp\#/us', '<br class="dSpInline">', $str);
  $str = preg_replace('/\#brPc\#/us', '<br class="dPcInline">', $str);
  $str = preg_replace('/\#\/p\#/us', '</p>', $str);
  $str = preg_replace('/\#p\#/us', '<p>', $str);
  $str = preg_replace('/\#\/b\#/us', '</span>', $str);
  $str = preg_replace('/\#b\#/us', '<span class="fontB">', $str);
  $str = preg_replace('/\#\/small\#/us', '</span>', $str);
  $str = preg_replace('/\#small\#/us', '<span class="small">', $str);
  $str = preg_replace('/\#\/short\#/us', '</span>', $str);
  $str = preg_replace('/\#short\#/us', '<span class="short">', $str);
  $str = preg_replace('/\#sp\#/us', '&nbsp;', $str);
  $str = preg_replace('/\#c\#/us', '<span class="markCopy">&copy;</span>', $str);
  $str = preg_replace('/\#year\#/us', date('Y'), $str);

  $str = preg_replace('/\#\/cRed\#/us', '</span>', $str);
  $str = preg_replace('/\#cRed\#/us', '<span class="cRed">', $str);
  return $str;
}


function code_delete($str) {
  $str = preg_replace('/\#br\#/us', '', $str);
  $str = preg_replace('/\#brSp\#/us', '', $str);
  $str = preg_replace('/\#brPc\#/us', '', $str);
  $str = preg_replace('/\#\/p\#/us', '', $str);
  $str = preg_replace('/\#p\#/us', '', $str);
  $str = preg_replace('/\#\/b\#/us', '', $str);
  $str = preg_replace('/\#b\#/us', '', $str);
  $str = preg_replace('/\#\/small\#/us', '', $str);
  $str = preg_replace('/\#small\#/us', '', $str);
  $str = preg_replace('/\#\/short\#/us', '', $str);
  $str = preg_replace('/\#short\#/us', '', $str);
  $str = preg_replace('/\#sp\#/us', '', $str);
  $str = preg_replace('/\#c\#/us', '', $str);
  $str = preg_replace('/\#year\#/us', '', $str);
  return $str;
}


function replace_tag($str) {
  $str = preg_replace('/\<br \/\>/smu', '#br#', $str);
  $str = preg_replace('/\<br\/\>/smu', '#br#', $str);
  $str = preg_replace('/\<br\>/smu', '#br#', $str);
  $str = esc_html($str);
  $str = preg_replace('/\#\/Small\#/smu', '</span>', $str);
  $str = preg_replace('/\#Small\#/smu', '<span class="small">', $str);
  $str = preg_replace('/\※([0-9]+)/sm', '<span class="txtCaution">※$1</span>', $str);
  $str = preg_replace('/\#br\#/smu', '<br>', $str);
  return $str;
}# replace_tag


function re_replace_tag($str) {
  $str = preg_replace('/\#br\#/smu', '<br>', $str);
  $str = preg_replace('/\#brSp\#/smu', '<br class="dSpInline">', $str);
  $str = preg_replace('/\#brPc\#/smu', '<br class="dPcInline">', $str);
  $str = preg_replace('/\#\/p\#/smu', '</p>', $str);
  $str = preg_replace('/\#p\#/smu', '<p>', $str);
  $str = preg_replace('/\#\/small\#/smu', '</span>', $str);
  $str = preg_replace('/\#small\#/smu', '<span class="small">', $str);
  return $str;
}


function replace_base_tag($str) {
  $str = preg_replace('/\</smu', '#tag#', $str);
  $str = preg_replace('/\>/smu', '#/tag#', $str);
  return $str;
}# replace_base_tag


function re_replace_base_tag($str) {
  $str = preg_replace('/\#tag\#/smu', '<', $str);
  $str = preg_replace('/\#\/tag\#/smu', '>', $str);
  return $str;
}


function clear_replace_tag($str) {
  $str = preg_replace('/\#br\#/su', '', $str);
  $str = preg_replace('/\#brSp\#/su', '', $str);
  $str = preg_replace('/\#brPc\#/su', '', $str);
  $str = preg_replace('/\#\/p\#/su', '', $str);
  $str = preg_replace('/\#p\#/su', '', $str);
  $str = preg_replace('/\#\/small\#/su', '', $str);
  $str = preg_replace('/\#small\#/su', '', $str);
  return $str;
}


function get_youtube_code($youtube_url) {
  if(preg_match('/^https\:\/\/youtu\.be\//',$youtube_url)):
    $youtube_code = preg_replace('/^https\:\/\/youtu\.be\/([^\/\?\&]+).*$/','$1',$youtube_url);
  elseif(preg_match('/^https\:\/\/www\.youtube\.com\/watch\?v\=/',$youtube_url)):
    $youtube_code = preg_replace('/^https\:\/\/www\.youtube\.com\/watch\?v\=([^\/\?\&]+).*$/','$1',$youtube_url);
  elseif(preg_match('/^https\:\/\/www\.youtube\.com\/watch\?.+(\&|\&amp\;)v\=/',$youtube_url)):
    $youtube_code = preg_replace('/^https\:\/\/www\.youtube\.com\/watch\?.+(\&|\&amp\;)v\=([^\/\?\&]+).*$/','$2',$youtube_url);
  else:
    return false;
  endif;
  if(preg_match('/^http(s|)\:\/\//',$youtube_code)) return false;
  return $youtube_code;
}# get_youtube_code


function get_vimeo_code($vimeo_url){

  if(!$vimeo_url or (!preg_match('/^https\:\/\/vimeo\.com\//', $vimeo_url) and !preg_match('/^https\:\/\/player\.vimeo\.com\//', $vimeo_url))):
    return false;
  endif;

  $vimeo_url = preg_replace('/^https\:\/\/player\.vimeo\.com\/video\/([0-9]+)[^0-9]*$/', '$1', $vimeo_url);
  $vimeo_url = preg_replace('/^https\:\/\/vimeo\.com\/channels\/[^\/]+\/([0-9]+)[^0-9]*$/', '$1', $vimeo_url);
  $vimeo_code = preg_replace('/^https\:\/\/vimeo\.com\/([0-9]+)[^0-9]*$/', '$1', $vimeo_url);

  if($vimeo_code and preg_match('/^[0-9]+$/', $vimeo_code)):
    return $vimeo_code;
  else:
    return false;
  endif;

}// get_vimeo_code


function curl_get($url, $ref = ''){
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 30);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  if($ref):
  curl_setopt($curl, CURLOPT_REFERER, $ref);
  endif;
  $return = curl_exec($curl);
  curl_close($curl);
  return $return;
}# func curl_get


function chk_holiday_json(){
  create_holidays_json_from_gcalendar(wp_date('Y'));
  if(wp_date('n') > 9):
    create_holidays_json_from_gcalendar(wp_date('Y')+1);
  endif;
}// chk_holiday_json


function create_holidays_json_from_gcalendar($year){

  if(get_option('my_google_api_key') == '') return false;

  if(!preg_match('/^[0-9]{4}$/',$year)) return false;

  $chk_path = get_stylesheet_directory().'/chkdata/holiday_data_'.$year.'.json';
  //$chk_path = './../chkdata/holiday_data_'.$year.'.json';
  if(!file_exists($chk_path)):

    $apiKey = esc_html(get_option('my_google_api_key'));
    $holidays = array();

    #Calendar ID
    $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');
    $start = date($year.'-01-01\T00:00:00\Z');
    $finish = date($year.'-12-31\T23:59:59\Z');
    $url = 'https://www.googleapis.com/calendar/v3/calendars/'.$calendar_id.'/events?key='.$apiKey.'&timeMin='.$start.'&timeMax='.$finish.'&maxResults=100&orderBy=startTime&singleEvents=true';

    $results = curl_get($url, $ref=home_url('/'));

    if($results):
      $results = "[\n".$results."\n]";
      $fh = fopen($chk_path,'w');
      fwrite($fh,$results);
      fclose($fh);
    endif;

  endif;

}# cun get_holidays_from_gcalendar


function my_exists_page($slug){

  if(!$slug) return false;

  $args = array('post_type'=>'page','pagename'=>$slug);
  $query = new WP_Query($args);
  $count = $query->post_count;
  if($count > 0):
    return true;
  else:
    return false;
  endif;

}# exists_page



function my_excerpt($str){

  $str = trim(strip_tags($str));

  if(is_post_type_archive('voice') or is_tax('voice-cat')):
    $str_limit = 70;
  else:
    $str_limit = 26;
  endif;

  $str2 = '';
  $str_all_len = mb_strlen($str,'utf-8');
  if($str_limit < $str_all_len):
    $str2 = mb_substr($str,0,$str_limit,'utf-8').'…';
  else:
    $str2 = $str;
  endif;

  return $str2;

}# my_excerpt



function my_title_plus(){

global $post;
global $wp_query;

$add_title = '';
$post_type_obj = get_post_type_object(get_post_type());
$post_type_name = $post_type_obj->label;
$taxes = get_object_taxonomies(esc_html(get_post_type()));
$taxonomy_slug = $taxes[0];


if(is_tax()):

  $term_slug = get_query_var('term');
  $term_data = get_term_by('slug',$term_slug,$taxonomy_slug);

  if($term_data->parent):
    $parent_term_data = get_term_by('id',$term_data->parent,$taxonomy_slug);
    if($parent_term_data->name):
      $add_title .= esc_html($parent_term_data->name).'｜';
    endif;
  endif;

  $add_title .= esc_html($post_type_name).'｜';

endif;


if(is_page()):
  if($post->post_parent):
    $page_data = get_post($post->post_parent);
      $add_title .= esc_html($page_data->post_title).'｜';
  endif;
endif;


if(get_post_type() != 'page' and $post_type_name and is_single()):
/*
  if(is_singular('news')):
    $terms = wp_get_post_terms($post->ID,'news-cat',array('orderby'=>'term_id','parent'=>false));
    if($terms and is_array($terms) and $terms[0]->slug == 'recruit'):
      $add_title .= '求人・採用情報｜';
    else:
      $add_title .= esc_html($post_type_name).'｜';
    endif;
  else: */
    $add_title .= esc_html($post_type_name).'｜';
/*  endif;*/
endif;

  return $add_title;

}


function get_my_meta_title(){
  if(isset($_SESSION['lang']) and $_SESSION['lang'] == 'en'):
    $site_name = (get_option('my_site_name_en')) ? get_option('my_site_name_en') : get_bloginfo('name');
  elseif(isset($_SESSION['lang']) and $_SESSION['lang'] == 'ch'):
    $site_name = (get_option('my_site_name_ch')) ? get_option('my_site_name_ch') : get_bloginfo('name');
  else:
    $site_name = (get_option('my_site_name')) ? get_option('my_site_name') : get_bloginfo('name');
  endif;
  if(is_front_page() or is_page(array('en','ch'))):
    $meta_title = $site_name;
  elseif(preg_match('/\/option\-en\/(.+)/', $_SERVER["REQUEST_URI"], $matches)):
    if($matches and is_array($matches) and $matches[1]):
      $slug = preg_replace('/\//', '', strip_tags(trim($matches[1])));
      $args = array('post_type'=>'option','name'=>$slug);
      $post_obj = get_posts($args);
      $post_id = $post_obj[0]->ID;
      $meta_title = get_field('option_s_title_en', $post_id).'｜'.$site_name;
    endif;
  elseif(preg_match('/\/option\-ch\/(.+)/', $_SERVER["REQUEST_URI"], $matches)):
    if($matches and is_array($matches) and $matches[1]):
      $slug = preg_replace('/\//', '', strip_tags(trim($matches[1])));
      $args = array('post_type'=>'option','name'=>$slug);
      $post_obj = get_posts($args);
      $post_id = $post_obj[0]->ID;
      $meta_title = get_field('option_s_title_ch', $post_id).'｜'.$site_name;
    endif;
  elseif(preg_match('/\/program\-en\/(.+)/', $_SERVER["REQUEST_URI"], $matches)):
    if($matches and is_array($matches) and $matches[1]):
      $slug = preg_replace('/\//', '', strip_tags(trim($matches[1])));
      $args = array('post_type'=>'program','name'=>$slug);
      $post_obj = get_posts($args);
      $post_id = $post_obj[0]->ID;
      $meta_title = get_field('program_s_title_en', $post_id).'｜'.$site_name;
    endif;
  elseif(preg_match('/\/program\-ch\/(.+)/', $_SERVER["REQUEST_URI"], $matches)):
    if($matches and is_array($matches) and $matches[1]):
      $slug = preg_replace('/\//', '', strip_tags(trim($matches[1])));
      $args = array('post_type'=>'program','name'=>$slug);
      $post_obj = get_posts($args);
      $post_id = $post_obj[0]->ID;
      $meta_title = get_field('program_s_title_ch', $post_id).'｜'.$site_name;
    endif;
  else:
    $meta_title = get_the_title().'｜'.$site_name;
  endif;
  return $meta_title;
}// func get_my_meta_title



function get_header_meta(){

  $header_meta_array = array();

  if(is_front_page()):
    $header_meta_array['description'] =  get_bloginfo('description');
    $header_meta_array['keywords'] = '';
  elseif(is_tax()):
    $tax_slug = get_query_var('taxonomy');
    $term_slug = get_query_var('term');
    $term_id0 = get_term_by('slug',$term_slug,$tax_slug);
    $term_id = $term_id0->term_id;
    $cpf_id = $tax_slug.'_'.$term_id;
    $header_meta_array['description'] = get_field('my_description',$cpf_id);
    $header_meta_array['keywords'] = get_field('my_keywords',$cpf_id);
  elseif(is_category()):
    $my_cat_id = get_query_var('cat');
    $header_meta_array['description'] = get_field('my_description','category_'.$my_cat_id);
    $header_meta_array['keywords'] = get_field('my_keywords','category_'.$my_cat_id);
  else:
    global $post;
    $my_meta_array = my_description();
    if($post->my_description):
      $header_meta_array['description'] = $post->my_description;
    elseif($my_meta_array['description']):
      $header_meta_array['description'] = $my_meta_array['description'];
    endif;
    if($post->my_keywords):
      $header_meta_array['keywords'] = $post->my_keywords;
    elseif($my_meta_array['keywords']):
      $$header_meta_array['keywords'] = $my_meta_array['keywords'];
    endif;
  endif;

  return $header_meta_array;

}# func get_header_meta



function get_header_meta_v20(){
  $description = '';
  $keywords = '';
  if(is_front_page()):
    $description = (get_option('my_site_description') != '') ? get_option('my_site_description') : get_bloginfo('description');
    $keywords = get_option('my_site_keywords');
  elseif(is_tax()):
    $tax_slug = get_query_var('taxonomy');
    $term_slug = get_query_var('term');
    $term_id0 = get_term_by('slug',$term_slug,$tax_slug);
    $term_id = $term_id0->term_id;
    $cpf_id = $tax_slug.'_'.$term_id;
    $description = get_field('my_description',$cpf_id);
    $keywords = get_field('my_keywords',$cpf_id);
  elseif(is_category()):
    $my_cat_id = get_query_var('cat');
    $description = get_field('my_description','category_'.$my_cat_id);
    $keywords = get_field('my_keywords','category_'.$my_cat_id);
  elseif(is_home()):
    $description = get_option('my_archive_description_post');
    $keywords = get_option('my_archive_keywords_post');
  elseif(is_post_type_archive()):
    $post_type_slug = get_query_var('post_type');
    if($post_type_slug != ''):
      $description = get_option('my_archive_description_'.$post_type_slug);
      $keywords = get_option('my_archive_keywords_'.$post_type_slug);
    endif;
  else:
    global $post;
    $my_meta_array = my_description();
    if(isset($post->ID) and get_field('my_description', $post->ID)):
      $description = get_field('my_description', $post->ID);
    elseif($my_meta_array['description']):
      $description = $my_meta_array['description'];
    endif;
    if(isset($post->ID) and get_field('my_keywords', $post->ID)):
      $keywords = get_field('my_keywords', $post->ID);
    elseif($my_meta_array['keywords']):
      $keywords = $my_meta_array['keywords'];
    endif;
  endif;
  return array('description'=>$description, 'keywords'=>$keywords);
}#get_header_meta_v20



function my_description(){

  $description = '';
  $keywords = '';

  if(is_singular()):
    $description = preg_replace('/\r\n/us', '', trim(strip_tags(get_the_content())));
    $description = preg_replace('/\n/us', '', $description);
    $description1 = preg_replace('/^([^。！\!]+(。|！|\!)).*$/us', "$1", $description);
    $description2 = preg_replace('/^([^。！\!]+(。|！|\!))([^。！\!]+(。|！|\!)).*$/us', "$1$3", $description);
    $description3 = preg_replace('/^([^。！\!]+(。|！|\!))([^。！\!]+(。|！|\!))([^。！\!]+(。|！|\!)).*$/us', "$1$3$5", $description);

    $description = $description1;
    if(mb_strlen($description2) < 120):
      $description = $description2;
    endif;
    if(mb_strlen($description3) < 120):
      $description = $description3;
    endif;
    //$description = $description.'len:'.mb_strlen($description);
    //$keywords = '';
  endif;

  $meta_array = array(
    'description' => $description,
    'keywords' => $keywords
  );

  return $meta_array;

}# func my_description




function get_my_term_name(){
  $term_obj = get_queried_object();
  if(isset($term_obj->name)):
    return $term_obj->name;
  endif;
}# func get_my_term_name

function get_my_term_slug(){
  $term_obj = get_queried_object();
  if(isset($term_obj->slug)):
    return $term_obj->slug;
  endif;
}# func get_my_term_slug

function get_my_term_id(){
  $term_obj = get_queried_object();
  if(isset($term_obj->term_id)):
    return $term_obj->term_id;
  endif;
}# func get_my_term_slug

function get_my_term_description(){
  $term_obj = get_queried_object();
  if(isset($term_obj->description)):
    return $term_obj->description;
  endif;
}# func get_my_term_description


function get_this_url(){

  $this_url = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
  $this_url = esc_url($this_url.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);

  return $this_url;

}// func get_this_url


function send_mail_v30($to,$from,$subject,$body,$encoding){

  if(!preg_match('/^.+@.+$/',$to) or !preg_match('/^.+@.+$/',$from)):
    return false;
  endif;

  $from_name = mb_convert_encoding($from_name, 'ISO-2022-JP-ms', 'UTF-8');
  $subject = mb_convert_encoding($subject, 'ISO-2022-JP-ms', 'UTF-8');
  $body = mb_convert_encoding($body, 'ISO-2022-JP-ms', 'UTF-8');

  mb_language("Japanese");
  mb_internal_encoding("JIS");
  mb_detect_order("ASCII,JIS,UTF-8,EUC-JP,SJIS");

  ### サブジェクトを jis にして、MIME エンコード
  $subject = mb_encode_mimeheader( mb_convert_encoding($subject,"JIS",$encoding),"JIS" );

  ### 本文を jis に
  $body = mb_convert_encoding($body,"JIS",$encoding);

  ### メールの送信
  $mp = popen("/usr/sbin/sendmail -f $from $to", "w");
  ## メールヘッダ
  fputs($mp, "From: $from\n");
  fputs($mp, "To: $to\n");
  fputs($mp, "Subject: $subject\n");

  ## メール本文
  fputs($mp, "MIME-Version: 1.0\n");
  fputs($mp, "Content-Type: text/plain; charset=\"iso-2022-jp\"\n");
  fputs($mp, "Content-Transfer-Encoding: 7bit\n");
  fputs($mp, "\n");
  fputs($mp, "$body\n");
  fputs($mp, "\n");

  ## 終了
  pclose($mp);

  return 1;

}// func send_mail_v30



function send_mail_v40($to,$from,$from_name,$subject,$body,$encoding){

  if(!preg_match('/^.+@.+$/',$to) or !preg_match('/^.+@.+$/',$from)):
    return false;
  endif;

  $from_name = mb_convert_encoding($from_name, 'ISO-2022-JP-ms', 'UTF-8');
  $subject = mb_convert_encoding($subject, 'ISO-2022-JP-ms', 'UTF-8');
  $body = mb_convert_encoding($body, 'ISO-2022-JP-ms', 'UTF-8');

  mb_language("Japanese");
  mb_internal_encoding("JIS");
  mb_detect_order("ASCII,JIS,UTF-8,EUC-JP,SJIS");

  ### サブジェクトを jis にして、MIME エンコード
  $subject = mb_encode_mimeheader( mb_convert_encoding($subject,"JIS",$encoding),"JIS" );
  $from_name = mb_encode_mimeheader( mb_convert_encoding($from_name,"JIS",$encoding),"JIS" );

  ### 本文を jis に
  $body = mb_convert_encoding($body,"JIS",$encoding);

  ### メールの送信
  $mp = popen("/usr/sbin/sendmail -f $from $to", "w");
  ## メールヘッダ
  fputs($mp, "From: $from_name<$from>\n");
  fputs($mp, "To: $to\n");
  fputs($mp, "Subject: $subject\n");

  ## メール本文
  fputs($mp, "MIME-Version: 1.0\n");
  fputs($mp, "Content-Type: text/plain; charset=\"iso-2022-jp\"\n");
  fputs($mp, "Content-Transfer-Encoding: 7bit\n");
  fputs($mp, "\n");
  fputs($mp, "$body\n");
  fputs($mp, "\n");

  ## 終了
  pclose($mp);

  return 1;

}# func send_mail_v40



function send_mail_v50($to,$from,$from_name,$subject,$body,$encoding,$attach){

  if(!preg_match('/^.+@.+$/',$to) or !preg_match('/^.+@.+$/',$from)):
    return false;
  endif;

  $from_name = mb_convert_encoding($from_name, 'ISO-2022-JP-ms', 'UTF-8');
  $subject = mb_convert_encoding($subject, 'ISO-2022-JP-ms', 'UTF-8');
  $body = mb_convert_encoding($body, 'ISO-2022-JP-ms', 'UTF-8');

  mb_language("Japanese");
  mb_internal_encoding("JIS");
  mb_detect_order("ASCII,JIS,UTF-8,EUC-JP,SJIS");

  $boundary = '---=_'.uniqid('Boundary').'_'.uniqid('Next');

  ### サブジェクトを jis にして、MIME エンコード
  $subject = mb_encode_mimeheader( mb_convert_encoding($subject,"JIS",$encoding),"JIS" );
  $from_name = mb_encode_mimeheader( mb_convert_encoding($from_name,"JIS",$encoding),"JIS" );

  ### 本文を jis に
  $body = mb_convert_encoding($body,"JIS",$encoding);

  ### メールの送信
  $mp = popen("/usr/sbin/sendmail -f $from $to", "w");
  ## メールヘッダ
  fputs($mp, "MIME-Version: 1.0\n");
  //fputs($mp, "Comments: System sent this mail\n");
  ## 添付ファイルがある場合に追加するヘッダ(複数パートからなるメールを送信する)
  fputs($mp, "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\n");
  fputs($mp, "Content-Transfer-Encoding: Base64\n");
  fputs($mp, "From: $from_name<$from>\n");
  fputs($mp, "To: $to\n");
  fputs($mp, "Subject: $subject\n");

  ## メール本文
  fputs($mp, "--".$boundary."\n");
  fputs($mp, "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n");
  fputs($mp, "Content-Transfer-Encoding: 7bit\n");
  fputs($mp, "\n");
  fputs($mp, "$body\n");
  //fputs($mp, "\n");

  ## 添付
  $attach_body = NULL;
if($attach and is_array($attach)):
  //print_r($attach);
  //exit;
  for($i=0; $i<count($attach); $i++):
    if(file_exists($attach[$i]['path']) && is_readable($attach[$i]['path'])):
      $fp = fopen($attach[$i]['path'],'r');
      $buf = fread($fp,filesize($attach[$i]['path']));
      fclose($fp);
      ## 添付ファイルの中身をBASE64でエンコードし、適切に分割する
      $attach_bin = chunk_split(base64_encode($buf));
      ## 添付ファイルを本文に追加
      fputs($mp, "--".$boundary."\n");
      fputs($mp, "Content-Type: application/octet-stream;name=\"{$attach[$i]['name']}\"\n");
      fputs($mp, "Content-Transfer-Encoding: Base64\n");
      fputs($mp, "Content-Disposition: attachment; filename*=ISO-2922-JP'ja'{$attach[$i]['name']}\n");
      //fputs($mp, "Content-Disposition: attachment; filename=\"{$attach[$i]['name']}\"\n");
      fputs($mp, "\n");
      fputs($mp, $attach_bin."\n");
      fputs($mp, "\n");
    endif;
  endfor;
endif;

  fputs($mp, "--".$boundary."--\n");

  ## 終了
  pclose($mp);

  return 1;

}# func send_mail_v50



function image_resize_disp($default_image, $max_width, $max_height){

  if($default_image == '' or !preg_match("/\/[0-9a-zA-Z\-\_]+\.(gif|jpg|jpeg|png)$/", $default_image)):
    return FALSE;
  elseif($max_width == '' or !preg_match("/^[0-9]+$/", $max_width)):
    return FALSE;
  elseif($max_height == '' or !preg_match("/^[0-9]+$/", $max_height)):
    return FALSE;
  endif;

  $rst = '';
  $image_size = @getimagesize($default_image);
  //echo 'img:'.$default_image.'<br>';

  if($image_size and is_array($image_size)):

    @$check_w = $image_size[0] / $max_width;
    @$check_h = $image_size[1] / $max_height;

    if($check_w >= 1 and $check_h >= 1):
      if($image_size[0] > $image_size[1]):
        $resize_w = $max_width;
        $resize_h = ($image_size[1] * $max_width) / $image_size[0];
      else:
        $resize_w = ($image_size[0] * $max_height) / $image_size[1];
        $resize_h = $max_height;
      endif;
    elseif($check_w >= 1 and $check_h < 1):
      $resize_w = $max_width;
      $resize_h = ($image_size[1] * $max_width) / $image_size[0];
    elseif($check_w < 1 and $check_h >= 1):
      $resize_w = ($image_size[0] * $max_height) / $image_size[1];
      $resize_h = $max_height;
    elseif($check_w < 1 and $check_h < 1):
      $resize_w = $image_size[0];
      $resize_h = $image_size[1];
    endif;

    switch($image_size[2]){

      case "1"://GIF
        $new_image_id = imagecreatetruecolor(intval($resize_w),intval($resize_h));
        $default_image_id = imagecreatefromgif($default_image);
        @imagecopyresampled($new_image_id,$default_image_id,0,0,0,0,$resize_w,$resize_h,$image_size[0],$image_size[1]);
        header("Content-Type: image/gif");
        $rst = @imagegif($new_image_id);
        @imagedestroy($new_image_id);
        @imagedestroy($default_image_id);
        break;

      case "2"://JPEG
        $new_image_id = imagecreatetruecolor(intval($resize_w), intval($resize_h));
        $default_image_id = imagecreatefromjpeg($default_image);
        @imagecopyresampled($new_image_id,$default_image_id,0,0,0,0,$resize_w,$resize_h,$image_size[0],$image_size[1]);
        //imagefilter($new_image_id,IMG_FILTER_CONTRAST,-20);
        imagefilter($new_image_id,IMG_FILTER_SMOOTH,-100);
        header("Content-Type: image/jpeg");
        $rst = @imagejpeg($new_image_id,NULL,100);
        @imagedestroy($new_image_id);
        @imagedestroy($default_image_id);
        break;

      case "3"://PNG
        $new_image_id = imagecreatetruecolor(intval($resize_w),intval($resize_h));
        $default_image_id = imagecreatefrompng($default_image);
        @imagecopyresampled($new_image_id,$default_image_id,0,0,0,0,$resize_w,$resize_h,$image_size[0],$image_size[1]);
        header("Content-Type: image/png");
        $rst = @imagepng($new_image_id);
        @imagedestroy($new_image_id);
        @imagedestroy($default_image_id);
        break;

    }//switch

  endif;


  if($rst == '1'):
    return TRUE;
  else:
    return FALSE;
  endif;

}## func image_resize_disp



function pref_code_to_name($pref_code){

  if(!preg_match('/^[0-9]+$/',$pref_code)) return false;

  if($pref_code == '1'){ return '北海道'; }
  elseif($pref_code == '2'){ return '青森県'; }
  elseif($pref_code == '3'){ return '岩手県'; }
  elseif($pref_code == '4'){ return '宮城県'; }
  elseif($pref_code == '5'){ return '秋田県'; }
  elseif($pref_code == '6'){ return '山形県'; }
  elseif($pref_code == '7'){ return '福島県'; }
  elseif($pref_code == '8'){ return '茨城県'; }
  elseif($pref_code == '9'){ return '栃木県'; }
  elseif($pref_code == '10'){ return '群馬県'; }
  elseif($pref_code == '11'){ return '埼玉県'; }
  elseif($pref_code == '12'){ return '千葉県'; }
  elseif($pref_code == '13'){ return '東京都'; }
  elseif($pref_code == '14'){ return '神奈川県'; }
  elseif($pref_code == '15'){ return '新潟県'; }
  elseif($pref_code == '16'){ return '富山県'; }
  elseif($pref_code == '17'){ return '石川県'; }
  elseif($pref_code == '18'){ return '福井県'; }
  elseif($pref_code == '19'){ return '山梨県'; }
  elseif($pref_code == '20'){ return '長野県'; }
  elseif($pref_code == '21'){ return '岐阜県'; }
  elseif($pref_code == '22'){ return '静岡県'; }
  elseif($pref_code == '23'){ return '愛知県'; }
  elseif($pref_code == '24'){ return '三重県'; }
  elseif($pref_code == '25'){ return '滋賀県'; }
  elseif($pref_code == '26'){ return '京都府'; }
  elseif($pref_code == '27'){ return '大阪府'; }
  elseif($pref_code == '28'){ return '兵庫県'; }
  elseif($pref_code == '29'){ return '奈良県'; }
  elseif($pref_code == '30'){ return '和歌山県'; }
  elseif($pref_code == '31'){ return '鳥取県'; }
  elseif($pref_code == '32'){ return '島根県'; }
  elseif($pref_code == '33'){ return '岡山県'; }
  elseif($pref_code == '34'){ return '広島県'; }
  elseif($pref_code == '35'){ return '山口県'; }
  elseif($pref_code == '36'){ return '徳島県'; }
  elseif($pref_code == '37'){ return '香川県'; }
  elseif($pref_code == '38'){ return '愛媛県'; }
  elseif($pref_code == '39'){ return '高知県'; }
  elseif($pref_code == '40'){ return '福岡県'; }
  elseif($pref_code == '41'){ return '佐賀県'; }
  elseif($pref_code == '42'){ return '長崎県'; }
  elseif($pref_code == '43'){ return '熊本県'; }
  elseif($pref_code == '44'){ return '大分県'; }
  elseif($pref_code == '45'){ return '宮崎県'; }
  elseif($pref_code == '46'){ return '鹿児島県'; }
  elseif($pref_code == '47'){ return '沖縄県'; }
  else{
    return false;
  }

}// func pref_code_to_name




function pref_name_to_code($pref_name){

  if(!$pref_name) return false;

  if($pref_name == '北海道'){ return '1'; }
  elseif($pref_name == '青森県' or $pref_name == '青森'){ return '2'; }
  elseif($pref_name == '岩手県' or $pref_name == '岩手'){ return '3'; }
  elseif($pref_name == '宮城県' or $pref_name == '宮城'){ return '4'; }
  elseif($pref_name == '秋田県' or $pref_name == '秋田'){ return '5'; }
  elseif($pref_name == '山形県' or $pref_name == '山形'){ return '6'; }
  elseif($pref_name == '福島県' or $pref_name == '福島'){ return '7'; }
  elseif($pref_name == '茨城県' or $pref_name == '茨城'){ return '8'; }
  elseif($pref_name == '栃木県' or $pref_name == '栃木'){ return '9'; }
  elseif($pref_name == '群馬県' or $pref_name == '群馬'){ return '10'; }
  elseif($pref_name == '埼玉県' or $pref_name == '埼玉'){ return '11'; }
  elseif($pref_name == '千葉県' or $pref_name == '千葉'){ return '12'; }
  elseif($pref_name == '東京都' or $pref_name == '東京'){ return '13'; }
  elseif($pref_name == '神奈川県' or $pref_name == '神奈川'){ return '14'; }
  elseif($pref_name == '新潟県' or $pref_name == '新潟'){ return '15'; }
  elseif($pref_name == '富山県' or $pref_name == '富山'){ return '16'; }
  elseif($pref_name == '石川県' or $pref_name == '石川'){ return '17'; }
  elseif($pref_name == '福井県' or $pref_name == '福井'){ return '18'; }
  elseif($pref_name == '山梨県' or $pref_name == '山梨'){ return '19'; }
  elseif($pref_name == '長野県' or $pref_name == '長野'){ return '20'; }
  elseif($pref_name == '岐阜県' or $pref_name == '岐阜'){ return '21'; }
  elseif($pref_name == '静岡県' or $pref_name == '静岡'){ return '22'; }
  elseif($pref_name == '愛知県' or $pref_name == '愛知'){ return '23'; }
  elseif($pref_name == '三重県' or $pref_name == '三重'){ return '24'; }
  elseif($pref_name == '滋賀県' or $pref_name == '滋賀'){ return '25'; }
  elseif($pref_name == '京都府' or $pref_name == '京都'){ return '26'; }
  elseif($pref_name == '大阪府' or $pref_name == '大阪'){ return '27'; }
  elseif($pref_name == '兵庫県' or $pref_name == '兵庫'){ return '28'; }
  elseif($pref_name == '奈良県' or $pref_name == '奈良'){ return '29'; }
  elseif($pref_name == '和歌山県' or $pref_name == '和歌山'){ return '30'; }
  elseif($pref_name == '鳥取県' or $pref_name == '鳥取'){ return '31'; }
  elseif($pref_name == '島根県' or $pref_name == '島根'){ return '32'; }
  elseif($pref_name == '岡山県' or $pref_name == '岡山'){ return '33'; }
  elseif($pref_name == '広島県' or $pref_name == '広島'){ return '34'; }
  elseif($pref_name == '山口県' or $pref_name == '山口'){ return '35'; }
  elseif($pref_name == '徳島県' or $pref_name == '徳島'){ return '36'; }
  elseif($pref_name == '香川県' or $pref_name == '香川'){ return '37'; }
  elseif($pref_name == '愛媛県' or $pref_name == '愛媛'){ return '38'; }
  elseif($pref_name == '高知県' or $pref_name == '高知'){ return '39'; }
  elseif($pref_name == '福岡県' or $pref_name == '福岡'){ return '40'; }
  elseif($pref_name == '佐賀県' or $pref_name == '佐賀'){ return '41'; }
  elseif($pref_name == '長崎県' or $pref_name == '長崎'){ return '42'; }
  elseif($pref_name == '熊本県' or $pref_name == '熊本'){ return '43'; }
  elseif($pref_name == '大分県' or $pref_name == '大分'){ return '44'; }
  elseif($pref_name == '宮崎県' or $pref_name == '宮崎'){ return '45'; }
  elseif($pref_name == '鹿児島県' or $pref_name == '鹿児島'){ return '46'; }
  elseif($pref_name == '沖縄県' or $pref_name == '沖縄'){ return '47'; }
  else{
    return false;
  }

}// func pref_name_to_code



function pref_short_to_full($pref_name){

  if($pref_name == '北海道'){ return '北海道'; }
  elseif($pref_name == '青森'){ return '青森県'; }
  elseif($pref_name == '岩手'){ return '岩手県'; }
  elseif($pref_name == '宮城'){ return '宮城県'; }
  elseif($pref_name == '秋田'){ return '秋田県'; }
  elseif($pref_name == '山形'){ return '山形県'; }
  elseif($pref_name == '福島'){ return '福島県'; }
  elseif($pref_name == '茨城'){ return '茨城県'; }
  elseif($pref_name == '栃木'){ return '栃木県'; }
  elseif($pref_name == '群馬'){ return '群馬県'; }
  elseif($pref_name == '埼玉'){ return '埼玉県'; }
  elseif($pref_name == '千葉'){ return '千葉県'; }
  elseif($pref_name == '東京'){ return '東京都'; }
  elseif($pref_name == '神奈川'){ return '神奈川県'; }
  elseif($pref_name == '新潟'){ return '新潟県'; }
  elseif($pref_name == '富山'){ return '富山県'; }
  elseif($pref_name == '石川'){ return '石川県'; }
  elseif($pref_name == '福井'){ return '福井県'; }
  elseif($pref_name == '山梨'){ return '山梨県'; }
  elseif($pref_name == '長野'){ return '長野県'; }
  elseif($pref_name == '岐阜'){ return '岐阜県'; }
  elseif($pref_name == '静岡'){ return '静岡県'; }
  elseif($pref_name == '愛知'){ return '愛知県'; }
  elseif($pref_name == '三重'){ return '三重県'; }
  elseif($pref_name == '滋賀'){ return '滋賀県'; }
  elseif($pref_name == '京都'){ return '京都府'; }
  elseif($pref_name == '大阪'){ return '大阪府'; }
  elseif($pref_name == '兵庫'){ return '兵庫県'; }
  elseif($pref_name == '奈良'){ return '奈良県'; }
  elseif($pref_name == '和歌山'){ return '和歌山県'; }
  elseif($pref_name == '鳥取'){ return '鳥取県'; }
  elseif($pref_name == '島根'){ return '島根県'; }
  elseif($pref_name == '岡山'){ return '岡山県'; }
  elseif($pref_name == '広島'){ return '広島県'; }
  elseif($pref_name == '山口'){ return '山口県'; }
  elseif($pref_name == '徳島'){ return '徳島県'; }
  elseif($pref_name == '香川'){ return '香川県'; }
  elseif($pref_name == '愛媛'){ return '愛媛県'; }
  elseif($pref_name == '高知'){ return '高知県'; }
  elseif($pref_name == '福岡'){ return '福岡県'; }
  elseif($pref_name == '佐賀'){ return '佐賀県'; }
  elseif($pref_name == '長崎'){ return '長崎県'; }
  elseif($pref_name == '熊本'){ return '熊本県'; }
  elseif($pref_name == '大分'){ return '大分県'; }
  elseif($pref_name == '宮崎'){ return '宮崎県'; }
  elseif($pref_name == '鹿児島'){ return '鹿児島県'; }
  elseif($pref_name == '沖縄'){ return '沖縄県'; }
  else{
    return false;
  }

}// func pref_short_to_full



function get_eyecatch_image(){
  $icatch_img = '';
  if(is_front_page()):
    if(get_option('my_top_ogp_image')):
      $icatch_img = get_option('my_top_ogp_image');
    else:
      $args = array('post_type'=>'page','pagename'=>'top');
      $query = new WP_Query($args);
      if($query->have_posts()): while($query->have_posts()): $query->the_post();
        if(get_the_post_thumbnail()):
          //$eye_catch_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'post-thumbnail');
          $eye_catch_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'large');
          $icatch_img = $eye_catch_data[0];
        endif;
      endwhile; wp_reset_postdata(); endif;
    endif;
  endif;
  if(is_single() or is_page()):
    if(get_the_post_thumbnail()):
      //$eye_catch_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'post-thumbnail');
      $eye_catch_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'large');
      $icatch_img = $eye_catch_data[0];
    elseif(get_field('news_image1')):
      $icatch_img = get_field('news_image1');
    elseif(get_field('blog_image1')):
      $icatch_img = get_field('blog_image1');
    else:
      //$icatch_img = get_stylesheet_directory_uri().'/images/base/base-no-image.png';
      $icatch_img = get_first_image();
    endif;
  endif;
  if(is_tax()):
    $term_object = get_queried_object();
    $taxonomy = $term_object->taxonomy;
    $acf_id = $taxonomy.'_'.$term_object->term_id;
    $name_head = preg_replace('/\-/','_',$taxonomy);
    $icatch_img = get_field($name_head.'_image1',$acf_id);
    //if(!$icatch_img) $icatch_img = get_stylesheet_directory_uri().'/images/base/base-no-image.png';
  endif;
  return $icatch_img;
}



function get_first_image($mode = ''){

  global $post, $posts;

  $first_img = '';

  ob_start();
  ob_end_clean();

  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"][^\>]*?>/i', $post->post_content, $matches);
  if(isset($matches[1][0])):
    $first_img = $matches[1][0];
  endif;

  if(!$first_img){
    if($mode == 'y'):
      $first_img = get_stylesheet_directory_uri().'/images/common/common_img02.png';
    elseif($mode == 'x'):
      $first_img = get_stylesheet_directory_uri().'/images/common/common_img01.png';
    else:
      $first_img = get_stylesheet_directory_uri().'/images/common/common_img01.png';
    endif;
  }
  return $first_img;

}# func get_first_image



function get_first_image_type2(){

  global $post, $posts;

  $first_img = '';

  ob_start();
  ob_end_clean();

  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"][^\>]*?>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  return $first_img;

}# func get_first_image_type2



function breadcrumb(){
  //Update 2023.03.07
  global $post;
  global $author;

  $cnt_position = 1;

  //$sepalate = '<span class="sepaBreadcrumb">&gt;</span>';
  $sepalate = '<span class="sepaBreadcrumb">-</span>';
  // $sepalate = '<span class="sepaBreadcrumb">/</span>';
  //$sepalate = ' <img src="'.esc_url(get_stylesheet_directory_uri()).'/images/common/breadcrumb-arrow-icn.png" alt="/" class="sepaBreadcrumb"> ';

  /* PostTop */
  $post_top = '';

  $str = '';
  if(!is_front_page() && !is_admin()):
    $str .= '<div class="breadcrumb">'."\n";
    $str .= '  <div class="breadcrumbIn" vocab="https://schema.org/" typeof="BreadcrumbList">'."\n";
    $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
    if(isset($_SESSION['lang']) and $_SESSION['lang'] == 'en'):
      $str .= '      <a href="'.esc_url(home_url('/')).'en/" property="item" typeof="WebPage"><span property="name">HOME</span></a>'."\n";
    elseif(isset($_SESSION['lang']) and $_SESSION['lang'] == 'ch'):
      $str .= '      <a href="'.esc_url(home_url('/')).'ch/" property="item" typeof="WebPage"><span property="name">首頁</span></a>'."\n";
    else:
      $str .= '      <a href="'.esc_url(home_url('/')).'" property="item" typeof="WebPage"><span property="name">HOME</span></a>'."\n";
    endif;
    $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
    $str .= '    </span>'."\n";
    $str .= $sepalate."\n";

    if(is_user_logged_in()):
      //++$cnt_position;
      //$str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      //$str .= '      <a href="'.esc_url(home_url()).'/user_index/" property="item" typeof="WebPage"><span property="name">会員ページTOP</span></a>'."\n";
      //$str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      //$str .= '    </span>'."\n";
      //$str .= $sepalate."\n";
    endif;

    if(is_category()):

      $post_page_title = '';
      $post_page_slug = '';
      if($post_page_id = get_option('page_for_posts')):
        $post_page_title = get_the_title($post_page_id);
        $post_page_slug = get_post($post_page_id)->post_name;
      endif;

      if($post_page_title and $post_page_slug):
          ++$cnt_position;
          $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
          $str .= '      <a href="'.esc_url(home_url('/')).$post_page_slug.'/" property="item" typeof="WebPage"><span property="name">'.esc_html($post_page_title).'一覧</span></a>'."\n";
          $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
          $str .= '    </span>'."\n";
          $str .= $sepalate."\n";
      endif;

      $cat = get_queried_object();
      if($cat->parent != 0):
        $ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category'));
        foreach($ancestors as $ancestor):
          ++$cnt_position;
          $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
          $str .= '      <a href="'.esc_url(get_category_link($ancestor)).'" property="item" typeof="WebPage"><span property="name">'.esc_html(get_cat_name($ancestor)).'</span></a>'."\n";
          $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
          $str .= '    </span>'."\n";
          $str .= $sepalate."\n";
        endforeach;
      endif;

      ++$cnt_position;
      $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      $str .= '      <span property="name">'.esc_html($cat->cat_name).'</span>'."\n";
      $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      $str .= '    </span>'."\n";

      //++$cnt_position;
      //$str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      //$str .= '      <a href="'.esc_url(get_category_link($ancestor)).'" property="item" typeof="WebPage"><span property="name">'.esc_html($cat->cat_name).'</span></a>'."\n";
      //$str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      //$str .= '    </span>'."\n";
      //$str .= $sepalate."\n";

    elseif(is_tag()):

      $post_page_title = '';
      $post_page_slug = '';
      if($post_page_id = get_option('page_for_posts')):
        $post_page_title = get_the_title($post_page_id);
        $post_page_slug = get_post($post_page_id)->post_name;
      endif;

      if($post_page_title and $post_page_slug):
          ++$cnt_position;
          $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
          $str .= '      <a href="'.esc_url(home_url('/')).$post_page_slug.'/" property="item" typeof="WebPage"><span property="name">'.esc_html($post_page_title).'一覧</span></a>'."\n";
          $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
          $str .= '    </span>'."\n";
          $str .= $sepalate."\n";
      endif;

      $tag = get_queried_object();

      ++$cnt_position;
      $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      $str .= '      <span property="name">'.esc_html($tag->name).'</span>'."\n";
      $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      $str .= '    </span>'."\n";

    elseif(is_page()):

      $en_top_page_data = get_page_by_path('en');
      if(isset($en_top_page_data->ID)):
        $en_top_page_id = $en_top_page_data->ID;
      endif;

      $ch_top_page_data = get_page_by_path('ch');
      if(isset($ch_top_page_data->ID)):
        $ch_top_page_id = $ch_top_page_data->ID;
      endif;

      if($post->post_parent != 0):
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        foreach($ancestors as $ancestor):
          if((isset($_SESSION['lang']) and $_SESSION['lang'] == 'en' and $ancestor == $en_top_page_id) or (isset($_SESSION['lang']) and $_SESSION['lang'] == 'ch' and $ancestor == $ch_top_page_id)):
            continue;
          endif;
          ++$cnt_position;
          $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
          $str .= '      <a href="'.esc_url(get_permalink($ancestor)).'" property="item" typeof="WebPage"><span property="name" class="title">'.esc_html(get_the_title($ancestor)).'</span></a>'."\n";
          $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
          $str .= '    </span>'."\n";
          $str .= $sepalate."\n";
        endforeach;
      endif;

      ++$cnt_position;
      $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      $str .= '      <span property="name">'.esc_html($post->post_title).'</span>';
      //$str .= '      <span property="name">'.esc_html(wp_title('', false)).'</span>';
      $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      $str .= '    </span>'."\n";

    elseif(is_single()):

      if(is_singular('post')):
        $post_page_title = '';
        $post_page_slug = '';
        if($post_page_id = get_option('page_for_posts')):
          $post_page_title = get_the_title($post_page_id);
          $post_page_slug = get_post($post_page_id)->post_name;
        endif;

        if($post_page_title and $post_page_slug):
          ++$cnt_position;
          $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
          $str .= '      <a href="'.esc_url(home_url('/')).$post_page_slug.'/" property="item" typeof="WebPage"><span property="name">'.esc_html($post_page_title).'一覧</span></a>'."\n";
          $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
          $str .= '    </span>'."\n";
          $str .= $sepalate."\n";
        endif;
      endif;

      $categories = get_the_category($post->ID);

      if($categories):
        if($categories[0]->parent != 0):
          $parent_cat = get_the_category_by_ID($categories[0]->parent);
          ++$cnt_position;
          $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
          $str .= '      <a href="'.esc_url(get_category_link($categories[0]->parent)).'" property="item" typeof="WebPage"><span property="name">'.esc_html($parent_cat).'</span></a>'."\n";
          $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
          $str .= '    </span>'."\n";
          $str .= $sepalate."\n";
        else:
          ++$cnt_position;
          $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
          $str .= '      <a href="'.esc_url(get_category_link($categories[0]->cat_ID)).'" property="item" typeof="WebPage"><span property="name">'.esc_html($categories[0]->name).'</span></a>'."\n";
          $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
          $str .= '    </span>'."\n";
          $str .= $sepalate."\n";
        endif;
      endif;

      $post_type = get_query_var('post_type');
      if($post_type):

        $archive_name = get_post_type_object($post_type)->label;

        ++$cnt_position;
        $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
        $str .= '      <a href="'.esc_url(get_post_type_archive_link($post_type)).'" property="item" typeof="WebPage"><span property="name">'.esc_html($archive_name).'</span></a>'."\n";
        $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
        $str .= '    </span>'."\n";
        $str .= $sepalate."\n";
      endif;

      $terms_vehical = get_the_terms($post->ID, 'vehicle_introduction_cate');

    if ($terms_vehical && !is_wp_error($terms_vehical)) :
        $term_vehical = reset($terms_vehical);

        if ($term_vehical->parent != 0) :
            $parent_term_vehical = get_term($term_vehical->parent, 'vehicle_introduction_cate');

            ++$cnt_position;
            $str .= '    <span property="itemListElement" typeof="ListItem">' . "\n";
            $str .= '      <a href="' . esc_url(get_term_link($parent_term_vehical)) . '" property="item" typeof="WebPage"><span property="name">' . esc_html($parent_term_vehical->name) . '</span></a>' . "\n";
            $str .= '      <meta property="position" content="' . esc_attr($cnt_position) . '">' . "\n";
            $str .= '    </span>' . "\n";
            $str .= $sepalate . "\n";
        else :
            ++$cnt_position;
            $str .= '    <span property="itemListElement" typeof="ListItem">' . "\n";
            $str .= '      <a href="' . esc_url(get_term_link($term_vehical)) . '" property="item" typeof="WebPage"><span property="name">' . esc_html($term_vehical->name) . '</span></a>' . "\n";
            $str .= '      <meta property="position" content="' . esc_attr($cnt_position) . '">' . "\n";
            $str .= '    </span>' . "\n";
            $str .= $sepalate . "\n";
        endif;
    endif;

      ++$cnt_position;
      $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      $str .= '      <span property="name">'.esc_html(wp_title('', false)).'</span>';
      $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      $str .= '    </span>'."\n";

    elseif(is_tax()):
      $my_taxonomy = get_query_var('taxonomy');
      $cpt = get_query_var('post_type');

      if($my_taxonomy):
        $my_tax = get_queried_object();
        $post_types = get_taxonomy($my_taxonomy)->object_type;
        //$cpt = $post_types[0];
        $cpt = get_query_var('post_type');
        if(!$cpt):
          $cpt = $post_types[0];
        endif;

        $post_type_name = get_post_type_object($cpt)->label;

        ++$cnt_position;
        $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
        $str .= '      <a href="'.esc_url(get_post_type_archive_link($cpt)).'" property="item" typeof="WebPage"><span property="name">'.esc_html($post_type_name).'</span></a>'."\n";
        $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
        $str .= '    </span>'."\n";
        $str .= $sepalate."\n";

        if($my_tax -> parent != 0):
          $ancestors = array_reverse(get_ancestors($my_tax->term_id, $my_tax->taxonomy));
          foreach($ancestors as $ancestor):
            ++$cnt_position;
            $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
            $str .= '      <a href="'.esc_url(get_term_link($ancestor, $my_tax->taxonomy)).'" property="item" typeof="WebPage"><span property="name">'.esc_html(get_term($ancestor, $my_tax->taxonomy)->name).'</span></a>'."\n";
            $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
            $str .= '    </span>'."\n";
            $str .= $sepalate."\n";
          endforeach;
        endif;

        ++$cnt_position;
        $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
        $str .= '      <span property="name">'.esc_html($my_tax->name).'</span>';
        $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
        $str .= '    </span>'."\n";
      endif;

    elseif(is_archive()):

      if(is_year()):
        $str .= $post_top;
      endif;

      if(is_month()):
        if(get_query_var('post_type') and get_query_var('post_type') != 'post'):
          $post_type_obj = get_post_type_object(get_query_var('post_type'));
          ++$cnt_position;
          $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
          $str .= '      <a href="'.esc_url(home_url('/')).esc_html(get_query_var('post_type')).'/" property="item" typeof="WebPage"><span property="name">'.esc_html($post_type_obj->labels->name).'</span></a>'."\n";
          $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
          $str .= '    </span>'."\n";
          $str .= $sepalate."\n";
        endif;
      endif;

      if(is_author()):
        $page_type_name = '';
        if($_GET['page_type'] == 'blog'):
          $page_type_name = ' BLOG';
        elseif($_GET['page_type'] == 'coupon'):
          $page_type_name = ' COUPON';
        elseif($_GET['page_type'] == 'recruit'):
          $page_type_name = ' RECRUIT';
        endif;

        ++$cnt_position;
        $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
        $str .= '      <span property="name">'.esc_html(author_to_shopname($author)).$page_type_name.'</span>';
        $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
        $str .= '    </span>'."\n";
      else:

        if(is_month()):
          ++$cnt_position;
          $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
          $str .= '      <span property="name">'.esc_html(get_query_var('year')).'年'.esc_html(get_query_var('monthnum')).'月</span>';
          $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
          $str .= '    </span>'."\n";
        else:
          ++$cnt_position;
          $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
          $str .= '      <span property="name">'.esc_html(wp_title('', false)).'</span>';
          $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
          $str .= '    </span>'."\n";
        endif;

      endif;

    elseif(is_author()):

      ++$cnt_position;
      $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      $str .= '      <a href="'.esc_url(home_url('/')).'user/" property="item" typeof="WebPage"><span property="name">User</span></a>'."\n";
      $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      $str .= '    </span>'."\n";
      $str .= $sepalate."\n";

      ++$cnt_position;
      $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      $str .= '      <span property="name">'.esc_html(wp_title('', false)).'</span>';
      $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      $str .= '    </span>'."\n";

    elseif(is_404()):

      ++$cnt_position;
      $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      //$str .= '      <span property="name">現在利用されておりません</span>';
      //$str .= '      <span property="name">404 NOT FOUND</span>';
      $str .= '      <span property="name">ページが見つかりません</span>';
      $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      $str .= '    </span>'."\n";

    elseif(is_home()):

      ++$cnt_position;
      $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      $str .= '      <span property="name">'.esc_html(wp_title('', false)).'一覧</span>';
      $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      $str .= '    </span>'."\n";

    else:

      ++$cnt_position;
      $str .= '    <span property="itemListElement" typeof="ListItem">'."\n";
      $str .= '      <span property="name">'.esc_html(wp_title('', false)).'</span>';
      $str .= '      <meta property="position" content="'.esc_attr($cnt_position).'">'."\n";
      $str .= '    </span>'."\n";

    endif;

    $str .= '  </div><!--/.breadcrumbIn-->'."\n";
    $str .= '</div><!--/.breadcrumb-->'."\n";

  endif;

  echo $str;

}# func breadcrumb






?>