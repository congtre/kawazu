<?php $page_data = get_page_data(); ?>
        <div class="boxMvWrap">
          <div class="boxMv">
<?php $ttl_tag = (is_single()) ? 'div' : 'h1'; ?>
            <<?php echo $ttl_tag; ?> class="ttlMv baseW baseSpW">
<?php if(!empty($page_data['mv_ttl_parent'])): ?>
              <span class="ttlParent"><?php echo $page_data['mv_ttl_parent']; ?></span>
<?php endif; ?>
              <span class="ttlJa"><?php echo $page_data['mv_ttl']; ?></span>
              <span class="ttlEn"><?php echo esc_html($page_data['mv_ttl_en']); ?></span>
            </<?php echo $ttl_tag; ?>>
          </div><!--/.boxMv-->
<?php if($page_data['mv_img']): ?>
<?php /*
          <div class="boxMvImg">
            <img src="<?php echo esc_url($page_data['mv_img']); ?>" alt="" class="imgMv">
          </div><!--/.boxMvImg-->
*/ ?>
<?php endif; ?>
        </div><!--/.boxMvWrap-->