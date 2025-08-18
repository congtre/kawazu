<?php $page_data = get_page_data(); ?>
          <div class="boxBaseCatYmMenu01 baseW baseSpW">
            <dl class="dlBaseCatMenu01">
              <dt>Category</dt>
              <dd>
                <ul class="ul01">
<?php $add_class = (is_post_type_archive() and !is_month()) ? ' class="current"' : ''; ?>
                  <li<?php echo $add_class; ?>><a href="<?php echo esc_url(home_url('/')); ?><?php echo esc_attr($page_data['post_type']); ?>/">ALL</a></li>
<?php $args = array('hide_empty'=>false, 'parent'=>false);
      $taxonomy_slug = $page_data['post_type'].'-cat';
      $terms = get_terms($taxonomy_slug, $args);
      if($terms and is_array($terms)):
        foreach($terms as $term):
          $add_class = (get_my_term_slug() == $term->slug) ? ' class="current"' : ''; ?>
                  <li<?php echo $add_class; ?>><a href="<?php echo esc_url(home_url('/')); ?><?php echo esc_attr($taxonomy_slug); ?>/<?php echo esc_attr($term->slug); ?>/"><?php echo esc_html($term->name); ?></a></li>
<?php   endforeach;
      endif; ?>
                </ul>
              </dd>
            </dl>
            <dl class="dlBaseYmMenu01">
              <dt>Archive</dt>
              <dd>
                <select name="select_archive">
                  <option value="<?php echo esc_url(home_url('/')); ?><?php echo esc_attr($page_data['post_type']); ?>/">ALL</option>
<?php   $args = array(
          'type' => 'monthly',
          'format' => 'option',
          'limit' => '',
          'post_type' => $page_data['post_type'],
          'show_post_count' => false,
          'echo' => 0
        );
        $monthly_archive = wp_get_archives($args);
        $monthly_archive = preg_replace('/年/','年　',$monthly_archive);
        echo $monthly_archive; ?>
                </select>
              </dd>
            </dl>
          </div><!--/.boxBaseCatYmMenu01-->