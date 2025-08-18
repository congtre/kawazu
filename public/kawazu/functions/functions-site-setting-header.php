<?php
function add_my_site_setting_header() {
  add_submenu_page( 'my_site_setting_menu', 'ヘッダー・MV設定', 'ヘッダー・MV設定', 'manage_options', 'my_site_setting_header', 'my_site_setting_header' );
}
add_action('admin_menu', 'add_my_site_setting_header');

function my_site_setting_header() {

# Data Name Array
  $input_name_array0 = array(
    'my_site_title',
    'my_site_description',
    'my_site_keywords',
    'my_top_ogp_image',
    'my_default_ogp_image',
  );
  $input_name_array = array();
  $input_name_label_array = array();
  $args = array('public'=>true,'show_ui'=>true);
  $post_types = get_post_types($args, 'objects');
  if($post_types != '' and is_array($post_types)):
    foreach($post_types as $post_type):
      if($post_type->name == 'post' or $post_type->name == 'page' or $post_type->name == 'attachment') continue;
      //echo $post_type->name."<br>";
      //print_r($post_type);
      $input_name_array[] = 'my_archive_title_'.$post_type->name;
      $input_name_array[] = 'my_archive_description_'.$post_type->name;
      $input_name_array[] = 'my_archive_keywords_'.$post_type->name;
      //$input_name_array[] = 'my_archive_mv_title_ja_'.$post_type->name;
      $input_name_array[] = 'my_archive_mv_title_en_'.$post_type->name;
      $input_name_array[] = 'my_archive_mv_img_'.$post_type->name;
      //$input_name_array[] = 'my_archive_mv_img_sp_'.$post_type->name;

      $input_name_label_array['my_archive_title_'.$post_type->name] = '【'.$post_type->label.'】<br>Title';
      $input_name_label_array['my_archive_description_'.$post_type->name] = '【'.$post_type->label.'】<br>Description';
      $input_name_label_array['my_archive_keywords_'.$post_type->name] = '【'.$post_type->label.'】<br>Keywords';
      //$input_name_label_array['my_archive_mv_title_ja_'.$post_type->name] = '【'.$post_type->label.'】<br>Mv Title Ja';
      $input_name_label_array['my_archive_mv_title_en_'.$post_type->name] = '【'.$post_type->label.'】<br>Mv Title En';
      $input_name_label_array['my_archive_mv_img_'.$post_type->name] = '【'.$post_type->label.'】<br>Mv Image';
      //$input_name_label_array['my_archive_mv_img_sp_'.$post_type->name] = '【'.$post_type->label.'】<br>Mv Image (Sp)';
    endforeach;
  endif;

# Set Initial

# Post
  $action = 'my_site_setting';
  $nonce = wp_create_nonce($action);
  if(isset($_POST[$nonce]) and wp_verify_nonce($_POST[$nonce], $action)):

    foreach($input_name_array0 as $name_one):
      if(isset($_POST[$name_one])):
        $_POST[$name_one] = wp_unslash($_POST[$name_one]);
      endif;
    endforeach;

    foreach($input_name_array as $name_one):
      if(isset($_POST[$name_one])):
        $_POST[$name_one] = wp_unslash($_POST[$name_one]);
      endif;
    endforeach;


# Validation 1
    $_POST['my_site_title'] = (isset($_POST['my_site_title'])) ? trim(mb_convert_kana($_POST['my_site_title'],'KVs','utf-8')) : '';
    $_POST['my_site_description'] = (isset($_POST['my_site_description'])) ? trim(mb_convert_kana($_POST['my_site_description'],'KVs','utf-8')) : '';
    $_POST['my_site_keywords'] = (isset($_POST['my_site_keywords'])) ? trim(mb_convert_kana($_POST['my_site_keywords'],'KVs','utf-8')) : '';

    $_POST['my_top_ogp_image'] = (isset($_POST['my_top_ogp_image'])) ? trim(mb_convert_kana($_POST['my_top_ogp_image'],'as','utf-8')) : '';
    $_POST['my_default_ogp_image'] = (isset($_POST['my_default_ogp_image'])) ? trim(mb_convert_kana($_POST['my_default_ogp_image'],'as','utf-8')) : '';

    if($input_name_array != '' and is_array($input_name_array)):
      foreach($input_name_array as $input_name):
        if(isset($_POST[$input_name])):
          if(preg_match('/^my\_archive\_mv\_img\_/', $input_name)):
            $_POST[$input_name] = trim(mb_convert_kana($_POST[$input_name],'as','utf-8'));
          else:
            $_POST[$input_name] = trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8'));
          endif;
        endif;
      endforeach;
    endif;


# Validation 2
      $errmsg = array();
      foreach($input_name_array as $name_one):
        if(isset($_POST[$name_one])):

        endif;
      endforeach;

      # Update
      if(!$errmsg):
        foreach($input_name_array0 as $name_one):
          if(isset($_POST[$name_one])):
            update_option( $name_one, $_POST[$name_one] );
          endif;
        endforeach;

        foreach($input_name_array as $name_one):
          if(isset($_POST[$name_one])):
            update_option( $name_one, $_POST[$name_one] );
          endif;
        endforeach;
      endif;

      $errmsg_all = '';
      if($errmsg and is_array($errmsg)):
        foreach($errmsg as $value):
          $errmsg_all .= $value."#br#\n";
        endforeach;
      endif;


  endif;# wp_verify_nonce


  if(!$_POST):
    for( $i = 0; $i < count($input_name_array0); $i++ ):
      if(get_option($input_name_array0[$i]) != '') $_POST[$input_name_array0[$i]] = get_option($input_name_array0[$i]);
    endfor;

    for( $i = 0; $i < count($input_name_array); $i++ ):
      if(get_option($input_name_array[$i]) != '') $_POST[$input_name_array[$i]] = get_option($input_name_array[$i]);
    endfor;
  endif;
?>
<h2>ヘッダー設定</h2>

<form method="post" action="" enctype="multipart/form-data">

<?php if(isset($_POST['submit']) and $errmsg_all): ?>
  <div class="boxError">
    <p><strong>一部エラーがあります、設定はまだ保存されていません。</strong></p>
<?php echo preg_replace('/\#br\#/','<br>',esc_html($errmsg_all)); ?>
  </div><!--/.boxError-->
<?php elseif(isset($_POST['submit']) and !$errmsg_all): ?>
  <div class="boxSuccess">
    <p><strong>設定を保存しました。</strong></p>
  </div><!--/.boxSuccess-->
<?php endif; ?>


  <table class="form-table">


<?php $input_name = 'my_site_title'; ?>
<?php if(in_array($input_name, $input_name_array0)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Site Title</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_site_description'; ?>
<?php if(in_array($input_name, $input_name_array0)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Site Description</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_site_keywords'; ?>
<?php if(in_array($input_name, $input_name_array0)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Site Keywords</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>


    <tr>
      <th>TOPページOGP用画像</th>
      <td>
        <?php $my_input_name = 'my_top_ogp_image'; ?>
        <?php if(isset($_POST[$my_input_name]) and $_POST[$my_input_name]): ?>
          <img src="<?php echo esc_url($_POST[$my_input_name]); ?>" alt="" class="<?php echo $my_input_name; ?>">
          <input type="hidden" name="<?php echo $my_input_name; ?>" value="<?php echo esc_url($_POST[$my_input_name]); ?>">
          <button class="btnImgRemove" id="remove_<?php echo $my_input_name; ?>">画像削除</button>
        <?php else: ?>
          <div id="selectImg_<?php echo $my_input_name; ?>"></div>
          <button class="btnImgUp" id="<?php echo $my_input_name; ?>">画像選択</button>
        <?php endif; ?>
      </td>
    </tr>


    <tr>
      <th>デフォルトOGP用画像</th>
      <td>
        <?php $my_input_name = 'my_default_ogp_image'; ?>
        <?php if(isset($_POST[$my_input_name]) and $_POST[$my_input_name]): ?>
          <img src="<?php echo esc_url($_POST[$my_input_name]); ?>" alt="" class="<?php echo $my_input_name; ?>">
          <input type="hidden" name="<?php echo $my_input_name; ?>" value="<?php echo esc_url($_POST[$my_input_name]); ?>">
          <button class="btnImgRemove" id="remove_<?php echo $my_input_name; ?>">画像削除</button>
        <?php else: ?>
          <div id="selectImg_<?php echo $my_input_name; ?>"></div>
          <button class="btnImgUp" id="<?php echo $my_input_name; ?>">画像選択</button>
        <?php endif; ?>
      </td>
    </tr>


<?php if($input_name_array != '' and is_array($input_name_array)):
      foreach($input_name_array as $input_name): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>"><?php echo $input_name_label_array[$input_name]; ?></label></th>
      <td>
<?php   if(preg_match('/^my\_archive\_mv\_img\_/', $input_name)):
          if(isset($_POST[$input_name]) and $_POST[$input_name]): ?>
        <img src="<?php echo esc_url($_POST[$input_name]); ?>" alt="" class="upImage <?php echo esc_attr($input_name); ?>">
        <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_url($_POST[$input_name]); ?>">
        <button class="btnImgRemove" id="remove_<?php echo esc_attr($input_name); ?>">画像削除</button>
<?php     else: ?>
        <div id="selectImg_<?php echo esc_attr($input_name); ?>"></div>
        <button class="btnImgUp" id="<?php echo esc_attr($input_name); ?>">画像選択</button>
<?php     endif; ?>
<?php    else: ?>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" class="w700px">
<?php    endif; ?>
      </td>
    </tr>
<?php endforeach;
    endif; ?>


  </table>
  <input type="hidden" name="submit" value="1">
  <?php
  wp_nonce_field($action, $nonce);
  submit_button();
  ?>
</form>
<?php

}# /my_site_setting_header

?>