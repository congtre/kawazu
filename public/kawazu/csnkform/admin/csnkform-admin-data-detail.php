<?php if(preg_match('/^[0-9]+$/', $_GET['my_id'])): ?>
<div class="boxPopupCont">
  <span class="btnCloseWin">X Close</span>
  <div class="boxBreadcrumb">
    <span><a href="<?php echo esc_url(site_url('/')); ?>wp-admin/admin.php?page=<?php echo esc_attr($page_slug); ?>">お問い合わせデータ</a></span>
    &gt;
    <span class="ttl">お問い合わせデータ 詳細</span>
  </div><!--/.boxBreadcrumb-->

<?php   $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        mysqli_set_charset($con, 'utf8');
        $sql = 'select * from csnkform_data where id = '.mysqli_real_escape_string($con, $_GET['my_id']);
        $rst = mysqli_query($con, $sql);
        $num = mysqli_num_rows($rst);
        $col = @mysqli_fetch_assoc($rst);
        @mysqli_free_result($rst);
        @mysqli_close($con);
?>

  <div class="boxDl01">
    <dl class="dl01">
      <dt>PageTitle</dt>
      <dd><?php echo esc_html($col['mail_page_slug']); ?></dd>
    </dl>
    <dl class="dl01">
      <dt>DateTime</dt>
      <dd><?php echo esc_html($col['date_time']); ?></dd>
    </dl>
    <dl class="dl01">
      <dt>Subject</dt>
      <dd><?php echo esc_html($col['mail_subject']); ?></dd>
    </dl>
    <dl class="dl01">
      <dt>Content</dt>
      <dd><?php echo nl2br(esc_html($col['mail_body'])); ?></dd>
    </dl>
    <dl class="dl01">
      <dt>ReturnTo</dt>
      <dd><?php echo nl2br(esc_html($col['mail_to'])); ?></dd>
    </dl>
    <dl class="dl01">
      <dt>ReturnFrom</dt>
      <dd><?php echo nl2br(esc_html($col['mail_from'])); ?> (<?php echo nl2br(esc_html($col['mail_from_name'])); ?>)</dd>
    </dl>
    <dl class="dl01">
      <dt>IP</dt>
      <dd><?php echo nl2br(esc_html($col['ip'])); ?></dd>
    </dl>
    <dl class="dl01">
      <dt>UA</dt>
      <dd><?php echo nl2br(esc_html($col['user_agent'])); ?></dd>
    </dl>
  </div><!--/.boxDl01-->

</div><!--/.boxPopupCont-->
<?php endif;// isId ?>