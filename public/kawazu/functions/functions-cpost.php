<?php
function child_create_post_type(){

  register_post_type('news',
    array(
      'labels' => array(
        'name' => __('新着情報'),
        'menu_name' => __('新着情報'),
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('with_front' => false),
      'menu_position' => 5,
      'show_ui' => true,
      'publicly_queryable' => true,
      'query_var' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'supports' => array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'revisions'
      )
    )
  );
//'show_in_rest' => true,

  register_taxonomy(
    'news-cat',
    'news',
    array(
      'labels' => array(
        'name' => __('カテゴリ'),
        'menu_name' => __('カテゴリ'),
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'query_var' => true,
      'rewrite' => true,
      'with_front' => false
    )
  );

/*
  register_post_type('recruit-event',
    array(
      'labels' => array(
        'name' => __('採用イベント'),
        'menu_name' => __('採用イベント'),
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('with_front' => false),
      'menu_position' => 5,
      'show_ui' => true,
      'publicly_queryable' => true,
      'query_var' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'supports' => array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'revisions'
      )
    )
  );

  register_taxonomy(
    'recruit-event-cat',
    'recruit-event',
    array(
      'labels' => array(
        'name' => __('カテゴリ'),
        'menu_name' => __('カテゴリ'),
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'query_var' => true,
      'rewrite' => true,
      'with_front' => false
    )
  );
*/


}# func child_create_post_type
add_action('init','child_create_post_type');
?>