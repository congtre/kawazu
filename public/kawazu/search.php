<?php get_header(); ?>
<div class="boxContent">
  <div class="boxMain">
    <main>
      <div class="boxSearch">

<?php /*
        <div class="boxMvWrap">
          <div class="boxMv baseW baseSpW">
            <h1 class="ttlMv"><span class="ttlJa">検索</span> <span class="ttlEn">Search</span></h1>
          </div><!--/.boxMv-->
        </div><!--/.boxMvWrap-->
*/ ?>

<?php //get_template_part('tmp/tmp-breadcrumb'); ?>

        <div class="boxSearch01 baseW baseSpW">
<?php if(have_posts() && get_search_query()):
        $allsearch = new WP_Query("s=$s&showposts=-1");
        $key = wp_specialchars($s, 1);
        $count = $allsearch->post_count;
        //echo '<h2 class="ttl2">&#8216;'.$key.'&#8217; の検索結果：'.$count.' 件</h2>';
        echo '<h1 class="ttl01">'.$count.' search result for: '.esc_html($key).'</h1>';
      else:
        $allsearch = new WP_Query("s=$s&showposts=-1");
        $key = wp_specialchars($s, 1);
        $count = $allsearch->post_count;
        //echo '<h2 class="ttl2">&#8216;'.$key.'&#8217; の検索結果：0件</h2>';
        echo '<h1 class="ttl01">0 search result for: '.esc_html($key).'</h1>'; ?>
          <div class="boxBaseCom">
            <p>検索キーワードに該当するページが見つかりませんでした。<br>別のキーワードでもう一度おためしください。</p>
          </div><!--/.boxBaseCom-->
<?php endif; ?>


          <div class="boxSearch01In">
            <div class="boxList">
<?php if(have_posts() && get_search_query()): while(have_posts()): the_post();
        //$ttl = (mb_strlen(strip_tags(get_the_title()),'utf-8') > 40) ? mb_substr(strip_tags(get_the_title()),0,40,'utf-8').'…' : strip_tags(get_the_title());
        $cont = (mb_strlen(strip_tags(get_the_content()),'utf-8') > 100) ? mb_substr(strip_tags(get_the_content()),0,100,'utf-8').'…' : strip_tags(get_the_content()); ?>
              <div class="boxListOneWrap">
                <a href="<?php the_permalink(); ?>" class="addLinkAni01">
                  <div class="boxListOne">
                    <h2 class="ttlList"><?php the_title(); ?></h2>
                    <div class="boxListDate"><?php the_time('Y-m-d'); ?></div>
                    <div class="boxListCont"><?php echo esc_html($cont); ?></div>
                  </div><!--/.boxListOne-->
                </a>
              </div><!--/.boxListOneWrap-->
<?php endwhile; endif; ?>
            </div><!--/.boxList-->

<?php $args = array(
        'prev_text' => '<span>Back</span>',
        'next_text' => '<span>Next</span>',
        'type' => 'list',
        'mid_size' => 1,
      );
      $pagination = paginate_links($args);
      if($pagination):
        echo '          <div class="boxPagination addLinkAni01">'."\n";
        echo $pagination;
        echo '          </div><!--/.boxPagination-->'."\n";
      endif; ?>

          </div><!--/.boxSearch01In-->
        </div><!--/.boxSearch01-->


      </div><!--/.boxSearch-->
    </main>
  </div><!--/.boxMain-->
</div><!--/.boxContent-->
<?php get_footer(); ?>
