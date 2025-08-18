  <h2>お問い合わせデータ</h2>

<?php   $con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        @mysqli_set_charset($con, 'utf8');
        if(mysqli_connect_errno()):
          printf('Connect failed: %s', mysqli_connect_error());
        endif;

        (isset($_GET['mypage']) and $_GET['mypage']) ? $page_num = $_GET['mypage'] : $page_num = 1;
        $page_disp_num = 50;
        $page_start_posi = ($page_num - 1) * $page_disp_num;

        $sql = 'select * from csnkform_data';
        $rst = @mysqli_query($con, $sql);
        if($errstr = mysqli_error($con)):
          echo $errstr;
        endif;
        $all_num = @mysqli_num_rows($rst);
        @mysqli_free_result($rst);

        $sql = 'select * from csnkform_data order by date_time desc limit '.$page_start_posi.','.$page_disp_num;
        $rst = @mysqli_query($con, $sql);
        if($errstr = mysqli_error($con)):
          echo $errstr;
        endif;
        $num = @mysqli_num_rows($rst);
?>

  <div class="boxCsnkformDataNum">お問い合わせデータ件数：<?php echo esc_html($num); ?>件</div>

<?php   if($num > 0): ?>
  <table class="tb01">
    <tr>
      <th class="thId">ID</th>
      <th class="thPageSlug">PageTitle</th>
      <th class="thDateTime">DateTime</th>
      <th class="thSubject">Subject</th>
      <th class="thDetail">Detail</th>
      <?php /*<th class="thStatus">Status</th>*/ ?>
    </tr>
<?php     while($col = @mysqli_fetch_assoc($rst)): ?>
    <tr class="id<?php echo esc_attr($col['id']); ?>">
      <td class="typeCenter"><?php echo esc_html($col['id']); ?></td>
      <td class="tdPageTitle"><span><?php echo esc_html($col['mail_page_slug']); ?></span></td>
      <td class="typeCenter"><?php echo esc_html($col['date_time']); ?></td>
      <td><?php echo esc_html($col['mail_subject']); ?></td>
      <td class="typeCenter"><a href="<?php echo esc_url(site_url('/')); ?>wp-admin/admin.php?page=<?php echo esc_attr($page_slug); ?>&my_action=detail&my_id=<?php echo esc_html($col['id']); ?>" class="popup popupStyle">詳細</a></td>
      <?php /*<td class="typeCenter" style="color: <?php echo esc_attr($status_color_array[$col['status']]); ?>;"><?php echo esc_html($status_array[$col['status']]); ?></td>*/ ?>
    </tr>
<?php     endwhile; ?>
  </table>

<?php     ## PageNation ##
          $all_page_num = floor($all_num / $page_disp_num) + 1;
          if($all_num % $page_disp_num == 0) $all_page_num = $all_num / $page_disp_num;
          if($all_page_num > 1):
            echo '<div class="boxPageNation">'."\n";
            echo '  <ul>'."\n";
            if($page_num > 1):
              $prev_page_num = $page_num - 1;
              echo '    <li class="prev"><a href="'.esc_url(site_url('/')).'wp-admin/admin.php?page='.esc_attr($page_slug).'&mypage='.$prev_page_num.'">&lt;&lt; Prev</a></li>'."\n";
            endif;
            for($i = 1; $i <= $all_page_num; $i++):
              if($page_num == $i):
                echo '    <li class="current">'.$i.'</li>'."\n";
              else:
                if($i <= $page_num + 5 and $i >= $page_num - 5):
                  echo '    <li><a href="'.esc_url(site_url('/')).'wp-admin/admin.php?page='.esc_attr($page_slug).'&mypage='.$i.'">'.$i.'</a></li>'."\n";
                endif;
              endif;
            endfor;
            if($page_num < $all_page_num):
              $next_page_num = $page_num + 1;
              echo '    <li class="next"><a href="'.esc_url(site_url('/')).'wp-admin/admin.php?page='.esc_attr($page_slug).'&mypage='.$next_page_num.'">Next &gt;&gt;</a></li>'."\n";
            endif;
            echo '  </ul>'."\n";
            echo '</div><!--/.boxPageNation-->'."\n";
          endif;# isPage
        ## /PageNation ##
?>

<?php   endif; ?>

<?php   @mysqli_free_result($rst);
        @mysqli_close($con);
?>