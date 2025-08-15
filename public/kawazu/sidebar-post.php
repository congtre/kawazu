<div class="boxPostSideIn">
  <div class="boxPostSideListCat addLinkAni01">
    <h2 class="ttlPostSide01">
      <span>Blog Category</span>
    </h2>
    <div class="boxPostSideListCatIn">
      <ul class="ulPostSideListCat">
<?php $args = array('hide_empty'=>false, 'parent'=>false);
      $terms = get_terms('category', $args);
      if($terms and is_array($terms)):
        foreach($terms as $term):
          if($term->slug != 'staff' and $term->slug != 'uncategorized'):
            $dot_color = (get_field('cat_bgcolor', 'category_'.$term->term_id)) ? get_field('cat_bgcolor', 'category_'.$term->term_id) : '#000';
            $add_style = ' style="background-color: '.esc_attr($dot_color).';"'; ?>
        <li><span class="markDot01"<?php echo $add_style; ?>></span><a href="<?php echo esc_url(home_url('/')); ?>category/<?php echo esc_attr($term->slug); ?>/"><?php echo esc_html($term->name); ?></a><?php /* (<?php echo esc_html($term->count); ?>) */ ?>
<?php       $args2 = array('hide_empty'=>false, 'parent'=>$term->term_id);
            $terms2 = get_terms('category', $args2);
            if($terms2 and is_array($terms2)): ?>
          <ul class="ulPostSideListCatChild">
<?php         foreach($terms2 as $term2):
                $dot_color_child = (get_field('cat_bgcolor', 'category_'.$term2->term_id)) ? get_field('cat_bgcolor', 'category_'.$term2->term_id) : '#000';
                $add_style_child = ' style="background-color: '.esc_attr($dot_color_child).';"'; ?>
            <li><span class="markDot01"<?php echo $add_style_child; ?>></span><a href="<?php echo esc_url(home_url('/')); ?>category/<?php echo esc_attr($term2->slug); ?>/"><?php echo esc_html($term2->name); ?></a><?php /* (<?php echo esc_html($term2->count); ?>) */ ?></li>
<?php         endforeach; ?>
          </ul>
<?php       endif; ?>
        </li>
<?php     endif;//Not Staff 未分類 ?>
<?php   endforeach;
      endif; ?>
      </ul>
    </div><!--/.boxPostSideListCatIn-->
  </div><!--/.boxPostSideListCat-->


  <div class="boxPostSideNew addLinkAni01">
    <h2 class="ttlPostSide01">
      <span>What's new & Event</span>
    </h2>
    <div class="boxPostSideList">
<?php $args = array('post_type'=>'post', 'posts_per_page'=>'5', 'post_status'=>'publish');
      $query = new WP_Query($args);
      if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
      <div class="boxPostSideListOne">
        <h3 class="ttlList"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="boxListDate"><?php the_time('Y-m-d'); ?></div>
      </div><!--/.boxPostSideListOne-->
<?php endwhile; wp_reset_postdata(); endif; ?>
    </div><!--/.boxPostSideList-->
  </div><!--/.boxPostSideNew-->


  <div class="boxPostSideYM">
    <h2 class="ttlPostSide01">
      <span>Monthly Archive</span>
    </h2>
    <div class="boxPostSideYMIn">
      <ul class="ulPostSideYM">
<?php
$args = array(
  'type' => 'yearly',
  'limit' => '',
  'show_post_count' => true,
  'post_type' => 'post',
  'echo' => 0
  );
$yearly_archive = wp_get_archives($args);
preg_match_all('/\<li\>(.+?)\<\/li\>/',$yearly_archive,$matches);
$archive_news_year_num_array = array();
if($matches[1] and is_array($matches[1])):
  foreach($matches[1] as $li):
    $li = strip_tags($li);
    preg_match('/^([0-9]{4})/u',$li,$matches_li_y);
    $li = preg_replace('/^.+\(([0-9]+)\)/','$1',$li);
    $archive_news_year_num_array[$matches_li_y[1]] = $li;
  endforeach;
endif;
//echo $yearly_archive;

$args = array(
  'type' => 'monthly',
  'limit' => '',
  'show_post_count' => true,
  'post_type' => 'post',
  'echo' => 0
  );
$monthly_archive = wp_get_archives($args);
//echo $monthly_archive;
  preg_match_all('/(\<li\>.+?\<\/li\>)/',$monthly_archive,$matches);
  $archive_news_array = array();
  if($matches[1] and is_array($matches[1])):
    foreach($matches[1] as $li):
      preg_match('/([0-9]{4})年/u',$li,$matches_li_y);
      preg_match('/([0-9]{1,2})月/u',$li,$matches_li_m);
      //$li = preg_replace('/([0-9]{4}年)/u','$1/',$li);
      $li = preg_replace('/([0-9]{4}年)/u','$1',$li);
      //$li = preg_replace('/\(([0-9]+)\)/','( $1 件 )',$li);
      //$li = preg_replace('/\<\/a\>/','',$li);
      //$li = preg_replace('/\<\/li\>/','</a></li>',$li);
      $archive_news_array[$matches_li_y[1]][$matches_li_m[1]] = $li;
    endforeach;
  endif;

  $now_year = '';
  foreach($archive_news_array as $archive_y => $archive_m_array):
    echo '      <li><div><img src="'.esc_url(get_stylesheet_directory_uri()).'/images/base/base-icn-plus02.png" alt="+" class="btnPostSideYMPlus">';
    //echo '        <span class="txt01"><span>'.esc_html($archive_y).'年</span> ('.esc_html($archive_news_year_num_array[$archive_y]).')</span></div>'."\n";
    echo '        <span class="txt01"><span>'.esc_html($archive_y).'年</span></span></div>'."\n";
    echo '        <ul class="ulPostSideYM02">'."\n";
    //ksort($archive_m_array);
    foreach($archive_m_array as $archive_m => $li):
      echo $li;
    endforeach;
    echo '        </ul><!--/.ulPostSideYM02-->'."\n";
    echo '      </li>'."\n";
  endforeach;
?>
      </ul><!--/.ulPostSideYM-->
    </div><!--/.boxPostSideYMIn-->
  </div><!--/.boxPostSideYM-->


  <div class="boxPostSideSearch">
    <h2 class="ttlPostSide01">
      <span>Search</span>
    </h2>
    <div class="boxPostSideSearchIn">
      <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="formSearch">
        <input type="text" name="s" value="<?php echo esc_attr($_GET['s']); ?>" placeholder="search site">
        <input type="submit" value="" class="btnSearch">
      </form>
    </div><!--/.boxPostSideSearchIn-->
  </div><!--/.boxPostSideSearch-->




</div><!--/.boxPostSideIn-->