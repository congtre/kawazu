<?php function my_acf_init_block_types(){
        if(function_exists('acf_register_block_type')):
          acf_register_block_type(
            array(
              'name' => 'dlbase01',
              'title' => __('項目+内容(DL)'),
              'description' => __('項目+内容(DLタグリスト形式)'),
              'render_template' => 'acf-block/acf-block-dl-base01.php',
              'category' => 'csnk-custom',
              'icon' => array(
                'background' => '#28b8fc',
                'foreground' => '#fff',
                'src' => 'book-alt'
                ),
              'keywords' => array('dl','dt','dd'),
              'mode' => 'auto',
            )
          );
/*
          acf_register_block_type(
            array(
              'name' => 'abcdf',
              'title' => __('ブロック名'),
              'description' => __('ブロック概要'),
              'render_template' => 'block/acf-block-recruit-middle.php',
              'category' => 'formatting',
              'icon' => array(
                'background' => '#7e70af',
                'foreground' => '#fff',
                'src' => 'book-alt'
                ),
              'keywords' => array('recruit','middle'),
              'mode' => 'auto',
            ),
          );
*/
        endif;
/*
        'icon' => 'wordpress',
        'render_callback'  => 'acf_column_2_info',
        'post_types' => array('post', 'page'),
        'align' => 'full',
        'align_text' => 'center',
        'align_content' => 'center',
        'enqueue_assets' => function () {
          wp_enqueue_style('original-block', get_template_directory_uri() . '/block/wordpress_admin.css');//このCSSを設定することにより管理画面でも実際の表示の見え方になる
        },
        'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
        'enqueue_script' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.js',
*/

      }
      add_action('acf/init', 'my_acf_init_block_types');




      function filter_block_categories_when_post_provided($block_categories, $editor_context){
        if(!empty($editor_context->post)){
          //array_push(
          array_unshift(
            $block_categories,
            array(
              'slug'  => 'csnk-custom',
              'title' => 'カスタムブロック',
              'icon'  => null,
            )
          );
        }
        return $block_categories;
      }
      add_filter('block_categories_all', 'filter_block_categories_when_post_provided', 10, 2);

?>