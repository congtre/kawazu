<?php $page_data = get_page_data(); ?>
            <div class="boxBaseList02">
<?php if(have_posts()): while(have_posts()): the_post();
        $term_cont = get_the_term_cont($page_data['post_type'].'-cat', $disp_type='typeBg');
        $eye_catch_img = '';
        if(get_the_post_thumbnail()):
          $eye_catch_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'large');
          $eye_catch_img = $eye_catch_data[0];
        else:
          $eye_catch_img = get_stylesheet_directory_uri().'/images/base/base-no-image01.png';
        endif;
        $cont = (mb_strlen(strip_tags(get_the_content()),'utf-8') > 50) ? mb_substr(strip_tags(get_the_content()),0,50,'utf-8').'…' : strip_tags(get_the_content()); ?>
                <div class="boxListOne">
                  <a href="<?php the_permalink(); ?>">
                    <div class="boxListOneIn">
                      <div class="boxListImg">
                        <img src="<?php echo esc_url($eye_catch_img); ?>" alt="" class="imgMain">
                      </div><!--/.boxListImg-->
                      <div class="boxListTxt">
                        <div class="boxListMeta">
                          <div class="boxListDate"><?php the_time('Y.m.d'); ?></div>
                          <?php echo $term_cont; ?>
                        </div><!--/.boxListMeta-->
                        <h3 class="ttlList"><?php the_title(); ?></h3>
<?php /*
                        <div class="boxListCont">
                          <p><?php echo esc_html($cont); ?></p>
                        </div><!--/.boxListCont-->
*/ ?>
                      </div><!--/.boxListTxt-->
                    </div><!--/.boxListOneIn-->
                  </a>
                </div><!--/.boxListOne-->
<?php endwhile; endif; ?>
            </div><!--/.boxBaseList02-->

<?php $args = array(
        'prev_text' => '<span>Back</span>',
        'next_text' => '<span>Next</span>',
        'type' => 'list',
        'mid_size' => 1,
      );
      $pagination = paginate_links($args);
      if($pagination):
        echo '          <div class="boxPagination">'."\n";
        echo $pagination;
        echo '          </div><!--/.boxPagination-->'."\n";
      endif; ?>

<?php if(!have_posts()): ?>
            <div class="boxBaseNoPost">
              <p>現在、投稿はありません。</p>
            </div><!--/.boxBaseNoPost-->
<?php endif; ?>