<?php $page_data = get_page_data(); ?>
          <div class="boxBaseCatMenu01">
            <ul class="ulBaseCatMenu01">
<?php $add_class = ((is_post_type_archive() or is_home()) and !is_month()) ? ' class="current"' : ''; ?>
              <li<?php echo $add_class; ?>><a href="<?php echo esc_url(home_url('/')); ?><?php echo esc_attr($page_data['post_type']); ?><?php if(isset($page_data['post_type']) and $page_data['post_type']): ?>/<?php endif; ?>"><span>すべて</span></a></li>
<?php $args = array('hide_empty'=>false, 'parent'=>false, 'exclude'=>'1');
      if($page_data['post_type'] == 'news' or is_category())://Uncategorized
        $taxonomy_slug = 'category';
      else:
        $taxonomy_slug = $page_data['post_type'].'-cat';
      endif;
      $terms = get_terms($taxonomy_slug, $args);
      if($terms and is_array($terms)):
        foreach($terms as $term):
          $add_class = (get_my_term_slug() == $term->slug) ? ' class="current"' : ''; ?>
              <li<?php echo $add_class; ?>><a href="<?php echo esc_url(home_url('/')); ?><?php echo esc_attr($taxonomy_slug); ?>/<?php echo esc_attr($term->slug); ?>/"><span><?php echo esc_html($term->name); ?></span></a></li>
<?php   endforeach;
      endif; ?>
            </ul>
          </div><!--/.boxBaseCatMenu01-->
