<?php function csnkform_admin_setting_menu(){
        add_submenu_page( 'csnkform_admin_page', '設定', '設定', 'manage_options', 'csnkform_admin_setting_page', 'csnkform_admin_setting_func' );
      }
      add_action('admin_menu', 'csnkform_admin_setting_menu');



      function csnkform_admin_setting_func() {

        # Data Name Array
        $input_name_array = array(
          'csnkform_site_name',
          'csnkform_company_name',
          'csnkform_privacy_policy',
          'csnkform_from_mail',
          'csnkform_from_name',
          'csnkform_to_mail',
          'csnkform_to_mail2',
          'csnkform_to_mail3',
          'csnkform_to_mail4',
          'csnkform_to_mail5',
          'csnkform_to_mail6',
          'csnkform_to_mail7',
          'csnkform_to_mail8',
          'csnkform_return_mail_subject',
          'csnkform_return_mail_body',
          'csnkform_from_mail_application',
          'csnkform_from_name_application',
          'csnkform_to_mail_application',
          'csnkform_to_mail2_application',
          'csnkform_to_mail3_application',
          'csnkform_to_mail4_application',
          'csnkform_to_mail5_application',
          'csnkform_to_mail6_application',
          'csnkform_to_mail7_application',
          'csnkform_to_mail8_application',
          'csnkform_return_mail_subject_application',
          'csnkform_return_mail_body_application',
          'csnkform_conversion_tag',
          'csnkform_google_recaptcha_site_key',
          'csnkform_google_recaptcha_secret_key',
        );

/*
          'csnkform_site_name',
          'csnkform_company_name',
          'csnkform_privacy_policy',
          'csnkform_from_mail',
          'csnkform_from_name',
          'csnkform_to_mail',
          'csnkform_to_mail2',
          'csnkform_to_mail3',
          'csnkform_to_mail4',
          'csnkform_to_mail5',
          'csnkform_to_mail6',
          'csnkform_to_mail7',
          'csnkform_to_mail8',
          'csnkform_return_mail_subject',
          'csnkform_return_mail_body',
          'csnkform_from_mail_application',
          'csnkform_from_name_application',
          'csnkform_to_mail_application',
          'csnkform_to_mail2_application',
          'csnkform_to_mail3_application',
          'csnkform_to_mail4_application',
          'csnkform_to_mail5_application',
          'csnkform_to_mail6_application',
          'csnkform_to_mail7_application',
          'csnkform_to_mail8_application',
          'csnkform_return_mail_subject_application',
          'csnkform_return_mail_body_application',
          'csnkform_conversion_tag',
          'csnkform_google_recaptcha_site_key',
          'csnkform_google_recaptcha_secret_key',
*/


        // Set Initial
        if(!get_option('csnkform_from_mail')) add_option('csnkform_from_mail',get_option('admin_email'));
        if(!get_option('csnkform_to_mail')) add_option('csnkform_to_mail',get_option('admin_email'));

        if(!get_option('csnkform_return_mail_subject')) add_option('csnkform_return_mail_subject','お問い合わせありがとうございました');
        $csnkform_return_mail_body = 'この度はお問い合わせいただき、
誠にありがとうございます。

後程、担当者よりご連絡いたします。
お電話にてご連絡差し上げる場合がございますので、ご了承いただきますようお願い申し上げます。

なお、1週間しても連絡がない場合は、
応募メールが届いていない可能性がございますので
お手数をかけいたしますが、
弊社までお電話をいただきますようお願い申し上げます。

＝ 入力内容 ＝
#INPUT_CONT#
';
        if(!get_option('csnkform_return_mail_body')) add_option('csnkform_return_mail_body', $csnkform_return_mail_body);

        if(!get_option('csnkform_from_mail_application')) add_option('csnkform_from_mail_application',get_option('admin_email'));
        if(!get_option('csnkform_to_mail_application')) add_option('csnkform_to_mail_application',get_option('admin_email'));
        if(!get_option('csnkform_return_mail_subject_application')) add_option('csnkform_return_mail_subject_application','ご応募ありがとうございました');
        $csnkform_return_mail_body_application = 'この度はご応募いただき、
誠にありがとうございます。

後程、担当者よりご連絡いたします。
お電話にてご連絡差し上げる場合がございますので、ご了承いただきますようお願い申し上げます。

なお、1週間しても連絡がない場合は、
応募メールが届いていない可能性がございますので
お手数をかけいたしますが、
弊社までお電話をいただきますようお願い申し上げます。

＝ 入力内容 ＝
#INPUT_CONT#
';
        if(!get_option('csnkform_return_mail_body_application')) add_option('csnkform_return_mail_body_application', $csnkform_return_mail_body_application);



        # Post
        $action = 'csnkform_admin_setting';
        $nonce = wp_create_nonce($action);
        if(isset($_POST[$nonce]) and wp_verify_nonce($_POST[$nonce], $action)):

          foreach($input_name_array as $name_one):
            if(isset($_POST[$name_one])):
              $_POST[$name_one] = wp_unslash($_POST[$name_one]);
            endif;
          endforeach;


          # Validation 1
          $_POST['csnkform_site_name'] = (isset($_POST['csnkform_site_name'])) ? trim(mb_convert_kana($_POST['csnkform_site_name'],'KVs','utf-8')) : '';
          $_POST['csnkform_company_name'] = (isset($_POST['csnkform_company_name'])) ? trim(mb_convert_kana($_POST['csnkform_company_name'],'KVs','utf-8')) : '';
          //$_POST['csnkform_privacy_policy'] = (isset($_POST['csnkform_privacy_policy'])) ? trim(mb_convert_kana($_POST['csnkform_privacy_policy'],'KVs','utf-8')) : '';

          $_POST['csnkform_from_name'] = (isset($_POST['csnkform_from_name'])) ? trim(mb_convert_kana($_POST['csnkform_from_name'],'KVs','utf-8')) : '';
          $_POST['csnkform_from_mail'] = (isset($_POST['csnkform_from_mail'])) ? trim(mb_convert_kana($_POST['csnkform_from_mail'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail'] = (isset($_POST['csnkform_to_mail'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail2'] = (isset($_POST['csnkform_to_mail2'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail2'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail3'] = (isset($_POST['csnkform_to_mail3'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail3'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail4'] = (isset($_POST['csnkform_to_mail4'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail4'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail5'] = (isset($_POST['csnkform_to_mail5'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail5'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail6'] = (isset($_POST['csnkform_to_mail6'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail6'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail7'] = (isset($_POST['csnkform_to_mail7'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail7'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail8'] = (isset($_POST['csnkform_to_mail8'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail8'],'as','utf-8')) : '';

          $_POST['csnkform_return_mail_subject'] = (isset($_POST['csnkform_return_mail_subject'])) ? trim(mb_convert_kana($_POST['csnkform_return_mail_subject'],'KVs','utf-8')) : '';
          $_POST['csnkform_return_mail_body'] = (isset($_POST['csnkform_return_mail_body'])) ? trim(mb_convert_kana($_POST['csnkform_return_mail_body'],'KVs','utf-8')) : '';

          $_POST['csnkform_from_name_application'] = (isset($_POST['csnkform_from_name_application'])) ? trim(mb_convert_kana($_POST['csnkform_from_name_application'],'KVs','utf-8')) : '';
          $_POST['csnkform_from_mail_application'] = (isset($_POST['csnkform_from_mail_application'])) ? trim(mb_convert_kana($_POST['csnkform_from_mail_application'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail_application'] = (isset($_POST['csnkform_to_mail_application'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail_application'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail2_application'] = (isset($_POST['csnkform_to_mail2_application'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail2_application'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail3_application'] = (isset($_POST['csnkform_to_mail3_application'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail3_application'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail4_application'] = (isset($_POST['csnkform_to_mail4_application'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail4_application'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail5_application'] = (isset($_POST['csnkform_to_mail5_application'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail5_application'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail6_application'] = (isset($_POST['csnkform_to_mail6_application'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail6_application'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail7_application'] = (isset($_POST['csnkform_to_mail7_application'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail7_application'],'as','utf-8')) : '';
          $_POST['csnkform_to_mail8_application'] = (isset($_POST['csnkform_to_mail8_application'])) ? trim(mb_convert_kana($_POST['csnkform_to_mail8_application'],'as','utf-8')) : '';

          $_POST['csnkform_return_mail_subject_application'] = (isset($_POST['csnkform_return_mail_subject_application'])) ? trim(mb_convert_kana($_POST['csnkform_return_mail_subject_application'],'KVs','utf-8')) : '';
          $_POST['csnkform_return_mail_body_application'] = (isset($_POST['csnkform_return_mail_body_application'])) ? trim(mb_convert_kana($_POST['csnkform_return_mail_body_application'],'KVs','utf-8')) : '';

          //$_POST['csnkform_conversion_tag'] = trim(mb_convert_kana($_POST['csnkform_conversion_tag'],'KVs','utf-8'));

          $_POST['csnkform_google_recaptcha_site_key'] = (isset($_POST['csnkform_google_recaptcha_site_key'])) ? trim(mb_convert_kana($_POST['csnkform_google_recaptcha_site_key'],'as','utf-8')) : '';
          $_POST['csnkform_google_recaptcha_secret_key'] = (isset($_POST['csnkform_google_recaptcha_secret_key'])) ? trim(mb_convert_kana($_POST['csnkform_google_recaptcha_secret_key'],'as','utf-8')) : '';


          # Validation 2
          $errmsg = array();
          foreach($input_name_array as $name_one):
            if(isset($_POST[$name_one])):

              if($name_one == 'csnkform_from_mail'):
                if($_POST[$name_one] == '') $errmsg[$name_one] = '送信元メールアドレス(From)を入力してください。';
                elseif(!preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信元(From)メールアドレスの入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_from_name'):
                //if($_POST[$name_one] == '') $errmsg[$name_one] = '送信元名(From)を入力してください。';
              endif;
              if($name_one == 'csnkform_to_mail'):
                if($_POST[$name_one] == '') $errmsg[$name_one] = '送信先メールアドレス(To)を入力してください。';
                elseif(!preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレスの入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail2'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス2の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail3'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス3の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail4'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス4の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail5'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス5の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail6'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス6の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail7'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス7の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail8'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス8の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;

              if($name_one == 'csnkform_from_mail_application'):
                if($_POST[$name_one] == '') $errmsg[$name_one] = '【応募形式用】送信元メールアドレス(From)を入力してください。';
                elseif(!preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '【応募形式用】送信元(From)メールアドレスの入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_from_name_application'):
                //if($_POST[$name_one] == '') $errmsg[$name_one] = '【応募形式用】送信元名(From)を入力してください。';
              endif;
              if($name_one == 'csnkform_to_mail_application'):
                if($_POST[$name_one] == '') $errmsg[$name_one] = '【応募形式用】送信先メールアドレス(To)を入力してください。';
                elseif(!preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '【応募形式用】送信先(To)メールアドレスの入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail2_application'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '【応募形式用】送信先(To)メールアドレス2の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail3_application'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '【応募形式用】送信先(To)メールアドレス3の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail4_application'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '【応募形式用】送信先(To)メールアドレス4の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail5_application'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '【応募形式用】送信先(To)メールアドレス5の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail6_application'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '【応募形式用】送信先(To)メールアドレス6の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail7_application'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '【応募形式用】送信先(To)メールアドレス7の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;
              if($name_one == 'csnkform_to_mail8_application'):
                if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '【応募形式用】送信先(To)メールアドレス8の入力値が不正です。メールアドレスが正しいか確認してください。';
              endif;

            endif;
          endforeach;

          # Update
          if(!$errmsg):
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
          for( $i = 0; $i < count($input_name_array); $i++ ):
            if(get_option($input_name_array[$i]) != '') $_POST[$input_name_array[$i]] = get_option($input_name_array[$i]);
          endfor;
        endif;
?>
<h2>お問い合わせ設定</h2>

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

<?php $input_name = 'csnkform_site_name'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">サイト名</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_company_name'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">会社名(組織名)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_privacy_policy'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">プライバシーポリシー</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_from_name'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信元名(From)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_from_mail'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信元メールアドレス(From)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail2'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス2(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail3'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス3(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail4'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス4(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail5'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス5(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail6'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス6(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail7'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス7(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail8'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス8(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_return_mail_subject'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 件名</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_return_mail_body'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 本文</label></th>
      <td>
        <span class="txtMyReturnMailBodyTop">〇〇 〇〇 様<br></span><br>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
        <p class="pCaution"><span class="cBaseRed">#INPUT_CONT#</span> タグを挿入することによって、このタグが入力内容に置換されます。</p>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'csnkform_from_name_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr class="trApplicationAreaTop">
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>送信元名(From)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_from_mail_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>送信元メールアドレス(From)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>送信先メールアドレス(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail2_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>送信先メールアドレス2(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail3_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>送信先メールアドレス3(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail4_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>送信先メールアドレス4(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail5_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>送信先メールアドレス5(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail6_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>送信先メールアドレス6(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail7_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>送信先メールアドレス7(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_to_mail8_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>送信先メールアドレス8(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_return_mail_subject_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>自動返信メール 件名</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_return_mail_body_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">【応募形式用】<br>自動返信メール 本文</label></th>
      <td>
        <span class="txtMyReturnMailBodyTop">〇〇 〇〇 様<br></span><br>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
        <p class="pCaution"><span class="cBaseRed">#INPUT_CONT#</span> タグを挿入することによって、このタグが入力内容に置換されます。</p>
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_conversion_tag'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">サンクスページ設置タグ</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_google_recaptcha_site_key'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Google reCaptcha v3 <br>サイトキー</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'csnkform_google_recaptcha_secret_key'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Google reCaptcha v3 <br>シークレットキー</label></th>
      <td>
        <input type="password" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

  </table>


  <input type="hidden" name="submit" value="1">
  <?php
  wp_nonce_field($action, $nonce);
  submit_button();
  ?>

</form>


<?php }#func csnkform_admin_setting_func ?>