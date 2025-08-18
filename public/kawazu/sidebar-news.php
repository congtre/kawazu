<div class="boxNewsSide">
  <div class="boxNewsSideListCat">
    <h3 class="ttlLayoutBaseH3B">
      <span>カテゴリー</span>
    </h3>
    <div class="boxNewsSideListCatIn">
      <ul class="ulSideListCat">
<?php $args = array('hide_empty'=>false, 'parent'=>false);
      $terms = get_terms('news-cat', $args);
      if($terms and is_array($terms)):
        foreach($terms as $term):
          $dot_color = (get_field('cat_bgcolor', 'news-cat_'.$term->term_id)) ? get_field('cat_bgcolor', 'news-cat_'.$term->term_id) : '#000';
          $add_style = ' style="background-color: '.esc_attr($dot_color).';"'; ?>
        <li><span class="markDot01"<?php echo $add_style; ?>></span><a href="<?php echo esc_url(home_url('/')); ?>news-cat/<?php echo esc_attr($term->slug); ?>/"><?php echo esc_html($term->name); ?></a> (<?php echo esc_html($term->count); ?>)
<?php     $args2 = array('hide_empty'=>false, 'parent'=>$term->term_id);
          $terms2 = get_terms('news-cat', $args2);
          if($terms2 and is_array($terms2)): ?>
          <div class="boxSideListCatChild">
            <ul class="ulSideListCatChild">
<?php       foreach($terms2 as $term2):
              $dot_color_child = (get_field('cat_bgcolor', 'news-cat_'.$term2->term_id)) ? get_field('cat_bgcolor', 'news-cat_'.$term2->term_id) : '#000';
              $add_style_child = ' style="background-color: '.esc_attr($dot_color_child).';"'; ?>
              <li><span class="markDot01"<?php echo $add_style_child; ?>></span><a href="<?php echo esc_url(home_url('/')); ?>news-cat/<?php echo esc_attr($term2->slug); ?>/"><?php echo esc_html($term2->name); ?></a> (<?php echo esc_html($term2->count); ?>)</li>
<?php       endforeach; ?>
            </ul>
          </div><!--/.boxSideListCatChild-->
<?php     endif; ?>
        </li>
<?php   endforeach;
      endif; ?>
      </ul>
    </div><!--/.boxNewsSideListCatIn-->
  </div><!--/.boxNewsSideListCat-->


  <div class="boxNewsSideYM">
    <h3 class="ttlLayoutBaseH3B">
      <span>月別アーカイブ</span>
    </h3>
    <div class="boxNewsSideYMIn">
      <ul class="ulNewsSideYM">
<?php
$args = array(
  'type' => 'yearly',
  'limit' => '',
  'show_post_count' => true,
  'post_type' => 'news',
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
  'post_type' => 'news',
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
      $li = preg_replace('/([0-9]{4}年)/u','$1/',$li);
      //$li = preg_replace('/\(([0-9]+)\)/','( $1 件 )',$li);
      //$li = preg_replace('/\<\/a\>/','',$li);
      //$li = preg_replace('/\<\/li\>/','</a></li>',$li);
      $archive_news_array[$matches_li_y[1]][$matches_li_m[1]] = $li;
    endforeach;
  endif;

  $now_year = '';
  foreach($archive_news_array as $archive_y => $archive_m_array):
    echo '      <li><div><img src="'.esc_url(get_stylesheet_directory_uri()).'/images/common/common-icn-plus01.png" alt="+" class="btnNewsSideYMPlus">';
    echo '        <span class="txt01"><span class="underline">'.esc_html($archive_y).'年</span> ('.esc_html($archive_news_year_num_array[$archive_y]).')</span></div>'."\n";
    echo '        <ul class="ulNewsSideYM02">'."\n";
    //ksort($archive_m_array);
    foreach($archive_m_array as $archive_m => $li):
      echo $li;
    endforeach;
    echo '        </ul><!--/.ulNewsSideYM02-->'."\n";
    echo '      </li>'."\n";
  endforeach;
?>
      </ul><!--/.ulNewsSideYM-->
    </div><!--/.boxNewsSideYMIn-->
  </div><!--/.boxNewsSideYM-->

</div><!--/.boxNewsSide-->