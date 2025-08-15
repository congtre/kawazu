<?php $page_data = get_page_data(); ?>
<?php if(have_posts()): while(have_posts()): the_post();
        if(is_singular('post')):
          $taxonomy_slug = 'category';
        else:
          $taxonomy_slug = $page_data['post_type'].'-cat';
        endif;
        $terms = wp_get_post_terms($post->ID, $taxonomy_slug, array('orderby'=>'term_id'));
        $term_cont = '';
        if($terms and is_array($terms)):
          $term_cont .= '<ul class="ulSingleCat">'."\n";
          foreach($terms as $term):
            $cat_bgcolor = (get_field('cat_bgcolor', $taxonomy_slug.'_'.$term->term_id)) ? get_field('cat_bgcolor', $taxonomy_slug.'_'.$term->term_id) : '#000';
            $cat_color = (get_field('cat_color', $taxonomy_slug.'_'.$term->term_id)) ? get_field('cat_color', $taxonomy_slug.'_'.$term->term_id) : '#fff';
            $add_color = ' style="background-color:'.esc_attr($cat_bgcolor).'; color:'.esc_attr($cat_color).';"';
            //$add_color = ' style="border: 2px '.esc_attr($cat_bgcolor).' solid; color:'.esc_attr($cat_color).';"';
            //$term_cont .= '<li'.$add_color.'>'.esc_html($term->name).'</li>'."\n";
            //$term_cont .= '<li>'.esc_html($term->name).'</li>'."\n";
            $terms2 = wp_get_post_terms($post->ID, $taxonomy_slug, array('orderby'=>'term_id','parent'=>$term->term_id));
            if($terms2 and is_array($terms2)):
              foreach($terms2 as $term2):
                $cat_bgcolor_child = (get_field('cat_bgcolor', $taxonomy_slug.'_'.$term2->term_id)) ? get_field('cat_bgcolor', $taxonomy_slug.'_'.$term2->term_id) : '#000';
                $cat_color_child = (get_field('cat_color', $taxonomy_slug.'_'.$term2->term_id)) ? get_field('cat_color', $taxonomy_slug.'_'.$term2->term_id) : '#fff';
                $add_color_child = ' style="background-color:'.esc_attr($cat_bgcolor_child).'; color:'.esc_attr($cat_color_child).';"';
                $term_cont .= '<li'.$add_color_child.'>'.esc_html($term2->name).'</li>'."\n";
              endforeach;
            else:
              $term_cont .= '<li'.$add_color.'>'.esc_html($term->name).'</li>'."\n";
            endif;
          endforeach;
          $term_cont .= '</ul>'."\n";
        endif;

        $eye_catch_img = '';
        $add_class = '';
        if(get_the_post_thumbnail()):
          //$eye_catch_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'post-thumbnail');
          $eye_catch_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'large');
          $eye_catch_img = $eye_catch_data[0];
        else:
          $eye_catch_img = get_stylesheet_directory_uri().'/images/base/base-no-image01.png';
          //$eye_catch_img = '';
          $add_class = ' typeCol1';
        endif;

        if(isset(get_field('single_disp_eyecatch')[0]) and get_field('single_disp_eyecatch')[0] == '表示しない'):
          $add_class = ' typeCol1';
        endif;
?>
              <div class="boxBaseSingle01">
                <h1 class="ttlSingle"><?php the_title(); ?></h1>
                <div class="boxSingleImgTxt clearfix<?php echo $add_class; ?>">
                  <div class="boxSingleImg">
                    <img src="<?php echo esc_url($eye_catch_img); ?>" alt="">
                  </div><!--/.boxSingleImg-->
                  <div class="boxSingleTxt">
                    <div class="boxSingleMeta">
                      <div class="boxSingleDate"><?php the_time('Y.m.d'); ?></div>
                      <?php echo $term_cont; ?>
                    </div><!--/.boxSingleMeta-->
                    <div class="boxSingleCont boxPostBody">
                      <?php the_content(); ?>
                    </div><!--/.boxSingleCont-->
                  </div><!--/.boxSingleTxt-->
                </div><!--/.boxSingleImgTxt-->
              </div><!--/.boxBaseSingle01-->

              <div class="boxSingleNavi">
              <?php previous_post_link('%link','前の記事へ'); ?>
              <span>&nbsp;</span>
              <?php next_post_link('%link','次の記事へ'); ?>
              </div><!--/.boxSingleNavi-->

<?php endwhile; endif; ?>

              <div class="boxBaseSingleBackLink01">
                <a href="<?php echo esc_url(home_url('/')); ?><?php echo esc_html($page_data['post_type']); ?>/">一覧に戻る</a>
              </div><!--/.boxBaseSingleBackLink01-->
