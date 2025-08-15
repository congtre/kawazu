<?php if(have_rows('acf-block_dl_base01')): ?>
  <div class="boxDlBase01">
<?php   while(have_rows('acf-block_dl_base01')): the_row('acf-block_dl_base01'); ?>
    <dl class="dlBase01">
      <dt><span><?php echo nl2br(esc_html(get_sub_field('dt'))); ?></span></dt>
      <dd><?php the_sub_field('dd'); ?></dd>
    </dl>
<?php   endwhile; ?>
  </div><!--/.boxDlBase01-->
<?php endif; ?>