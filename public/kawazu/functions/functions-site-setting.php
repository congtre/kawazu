<?php
function my_site_setting_menu() {
  add_menu_page('サイト設定', 'サイト設定', 'manage_options', 'my_site_setting_menu', 'my_site_setting', '', '4.0');
}# func my_site_setting_menu
add_action('admin_menu', 'my_site_setting_menu');



function my_site_setting() {

  $errmsg_all = '';

# Data Name Array
  $input_name_array = array(
    'my_site_name',
    'my_company_name',
    'my_company_name_en',
    'my_company_president',
    'my_company_president_title',
    'my_personal_info_protection_manager',
    'my_company_zipcode',
    'my_company_address',
    'my_company_telno',
    'my_company_faxno',
    'my_company_email',
    'my_contact_telno',
    'my_contact_reception_time',
    'my_contact_staff',
    'my_business_time',
    'my_company_holiday',
    'my_company_founding',
    'my_company_established',
    'my_company_capital',
    'my_company_sales',
    'my_company_employees',
    'my_company_business',
    'my_company_licensing',
    'my_company_belong_group',
    'my_company_major_tradings',
    'my_company_financial_institutions',
    'my_company_general_counsel',
    'my_company_access',
    'my_company_map_url',
    'my_company_map_embed_tag',
    'my_company_hp_url',
    'my_online_shop_url',
    'my_online_reservation_url',
    'my_mynavi_url',
    'my_facebook_url',
    'my_twitter_url',
    'my_instagram_url',
    'my_youtube_url',
    'my_pinterest_url',
    'my_line_url',
    'my_note_url',
    'my_google_api_key',
    'my_analytics_tag',
    'my_tag_head_top',
    'my_tag_body_top',
    'my_copyright',
  );

/*
    'my_return_mail_subject_campaign',
    'my_return_mail_body_campaign',
    'my_return_mail_subject_business',
    'my_return_mail_body_business',
    'my_return_mail_subject_prize',
    'my_return_mail_body_prize',

    'my_personal_info_protection_manager',

    'my_line_url',
    'my_feedly_url',
    'my_site_name',
    'my_site_name_en',
    'my_site_name_ch',
    'my_privacy_policy',
    'my_company_name',
    'my_company_name_short',
    'my_company_name_en',
    'my_contact_telno',
    'my_contact_reception_time',
    'my_shop_name',
    'my_shop_name_kana',
    'my_shop_name2',
    'my_ceo_name',
    'my_company_zipcode',
    'my_company_address',
    'my_company_telno',
    'my_company_faxno',
    'my_company_main_telno',
    'my_company_founding',
    'my_company_established',
    'my_company_capital',
    'my_company_sales',
    'my_company_employees',
    'my_company_business',
    'my_company_licensing',
    'my_company_belong_group',
    'my_company_major_tradings',
    'my_group_company',
    'my_company_map_url',
    'my_company_map_embed_tag',
    'my_company_hp_url',

    'my_top_com',
    'my_recruit_telno',
    'my_recruit_faxno',
    'my_recruit_mail',
    'my_recruit_staff',
    'my_recruit_reception_time_weekday',
    'my_recruit_reception_time_weekend',
    'my_contact_from_name_en',
    'my_contact_from_name_ch',
    'my_return_mail_subject_en',
    'my_return_mail_subject_ch',
    'my_return_mail_body_en',
    'my_return_mail_body_ch',
    'my_email_signature_en',
    'my_email_signature_ch',
    'my_form_return_subject_entry',
    'my_form_return_body_entry',
    'my_contact_conversion_tag',
    'my_company_business_time',
    'my_entry_disp',
    'my_interview_disp',
    'my_company_disp',
    'my_welfare_disp',
    'my_career_disp',
    'my_copyright_en',
    'my_copyright_ch',
    'my_email_signature',
*/

// Set Initial
  if(!get_option('my_copyright')) add_option('my_copyright', 'Copyright #c# #year# Exsample All rights reserved.');

  if(!get_option('my_contact_from_mail')) add_option('my_contact_from_mail',get_option('admin_email'));
  if(!get_option('my_contact_to_mail')) add_option('my_contact_to_mail',get_option('admin_email'));


  if(!get_option('my_return_mail_subject')) add_option('my_return_mail_subject','お問い合わせありがとうございました');
  $my_return_mail_body = 'この度はお問い合わせいただき、
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
  if(!get_option('my_return_mail_body')) add_option('my_return_mail_body',$my_return_mail_body);


  if(!get_option('my_return_mail_subject_application')) add_option('my_return_mail_subject_application','ご応募ありがとうございました');
  $my_return_mail_body_application = 'この度はご応募いただき、
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
  if(!get_option('my_return_mail_body_application')) add_option('my_return_mail_body_application',$my_return_mail_body_application);


  if(!get_option('my_return_mail_subject_campaign')) add_option('my_return_mail_subject_campaign','ご応募ありがとうございました');
  $my_return_mail_body_campaign = 'この度はご応募いただき、
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
  if(!get_option('my_return_mail_body_campaign')) add_option('my_return_mail_body_campaign',$my_return_mail_body_campaign);


  if(!get_option('my_return_mail_subject_business')) add_option('my_return_mail_subject_business','お問い合わせありがとうございました');
  $my_return_mail_body_business = 'この度はお問い合わせいただき、
誠にありがとうございます。

後程、担当者よりご連絡いたします。
お電話にてご連絡差し上げる場合がございますので、ご了承いただきますようお願い申し上げます。

なお、1週間しても連絡がない場合は、
お問い合わせメールが届いていない可能性がございますので
お手数をかけいたしますが、
弊社までお電話をいただきますようお願い申し上げます。

＝ 入力内容 ＝
#INPUT_CONT#
';
  if(!get_option('my_return_mail_body_business')) add_option('my_return_mail_body_business',$my_return_mail_body_business);


  if(!get_option('my_return_mail_subject_prize')) add_option('my_return_mail_subject_prize','ご当選者様情報の送信ありがとうございました');
  $my_return_mail_body_prize = 'この度はご当選者様情報を送信いただき、
誠にありがとうございます。

後程、担当者よりご連絡いたします。
お電話にてご連絡差し上げる場合がございますので、ご了承いただきますようお願い申し上げます。

なお、1週間しても連絡がない場合は、
お問い合わせメールが届いていない可能性がございますので
お手数をかけいたしますが、
弊社までお電話をいただきますようお願い申し上げます。

＝ 入力内容 ＝
#INPUT_CONT#
';
  if(!get_option('my_return_mail_body_prize')) add_option('my_return_mail_body_prize',$my_return_mail_body_prize);


  if(!$_POST):
    for($i = 0; $i < count($input_name_array); $i++):
      if(get_option($input_name_array[$i]) != '') $_POST[$input_name_array[$i]] = get_option($input_name_array[$i]);
    endfor;
  endif;

  $post_keys = $input_name_array;
  foreach($post_keys as $key):
    $val = $_POST[$key] ?? '';
    //$_POST[$key] = stripslashes_deep_custom($val);
    $_POST[$key] = wp_unslash($val);
  endforeach;

  $get_keys = ['pcode'];
  foreach($get_keys as $key):
    $_GET[$key] = $_GET[$key] ?? '';
  endforeach;


# Post
  $action = 'my_site_setting';
  $nonce = wp_create_nonce($action);
  if(isset($_POST[$nonce]) and wp_verify_nonce($_POST[$nonce], $action)):

    foreach($input_name_array as $name_one):
      if(isset($_POST[$name_one])):
        //$_POST[$name_one] = wp_unslash($_POST[$name_one]);
      endif;
    endforeach;


# Validation 1
    /*
    if(!preg_match('/〒/',$_POST['my_company_zipcode'])):
      $_POST['my_company_zipcode'] = '〒'.$_POST['my_company_zipcode'];
    endif;*/
    $_POST['my_site_name'] = (isset($_POST['my_site_name'])) ? trim(mb_convert_kana($_POST['my_site_name'],'KVs','utf-8')) : '';
    $_POST['my_site_name_en'] = (isset($_POST['my_site_name_en'])) ? trim(mb_convert_kana($_POST['my_site_name_en'],'KVs','utf-8')) : '';
    $_POST['my_site_name_ch'] = (isset($_POST['my_site_name_ch'])) ? trim(mb_convert_kana($_POST['my_site_name_ch'],'KVs','utf-8')) : '';

    $_POST['my_company_name'] = (isset($_POST['my_company_name'])) ? trim(mb_convert_kana($_POST['my_company_name'],'KVs','utf-8')) : '';
    $_POST['my_company_name_en'] = (isset($_POST['my_company_name_en'])) ? trim(mb_convert_kana($_POST['my_company_name_en'],'as','utf-8')) : '';
    //$_POST['my_company_name_short'] = (isset($_POST['my_company_name_short'])) ? trim(mb_convert_kana($_POST['my_company_name_short'],'KVs','utf-8')) : '';
    $_POST['my_company_president'] = (isset($_POST['my_company_president'])) ? trim(mb_convert_kana($_POST['my_company_president'],'KVs','utf-8')) : '';
    $_POST['my_company_president_title'] = (isset($_POST['my_company_president_title'])) ? trim(mb_convert_kana($_POST['my_company_president_title'],'KVs','utf-8')) : '';

    $_POST['my_personal_info_protection_manager'] = (isset($_POST['my_personal_info_protection_manager'])) ? trim(mb_convert_kana($_POST['my_personal_info_protection_manager'],'KVs','utf-8')) : '';

    $_POST['my_company_zipcode'] = (isset($_POST['my_company_zipcode'])) ? trim(mb_convert_kana($_POST['my_company_zipcode'],'ns','utf-8')) : '';
    $_POST['my_company_address'] = (isset($_POST['my_company_address'])) ? trim(mb_convert_kana($_POST['my_company_address'],'KVs','utf-8')) : '';
    $_POST['my_company_telno'] = (isset($_POST['my_company_telno'])) ? trim(mb_convert_kana($_POST['my_company_telno'],'as','utf-8')) : '';
    $_POST['my_company_faxno'] = (isset($_POST['my_company_faxno'])) ? trim(mb_convert_kana($_POST['my_company_faxno'],'as','utf-8')) : '';
    $_POST['my_company_email'] = (isset($_POST['my_company_email'])) ? trim(mb_convert_kana($_POST['my_company_email'],'as','utf-8')) : '';
    $_POST['my_contact_telno'] = (isset($_POST['my_contact_telno'])) ? trim(mb_convert_kana($_POST['my_contact_telno'],'as','utf-8')) : '';
    $_POST['my_contact_reception_time'] = (isset($_POST['my_contact_reception_time'])) ? trim(mb_convert_kana($_POST['my_contact_reception_time'],'KVs','utf-8')) : '';
    $_POST['my_contact_staff'] = (isset($_POST['my_contact_staff'])) ? trim(mb_convert_kana($_POST['my_contact_staff'],'KVs','utf-8')) : '';

    $_POST['my_business_time'] = (isset($_POST['my_business_time'])) ? trim(mb_convert_kana($_POST['my_business_time'],'KVs','utf-8')) : '';
    $_POST['my_company_holiday'] = (isset($_POST['my_company_holiday'])) ? trim(mb_convert_kana($_POST['my_company_holiday'],'KVs','utf-8')) : '';

    $_POST['my_company_founding'] = (isset($_POST['my_company_founding'])) ? trim(mb_convert_kana($_POST['my_company_founding'],'KVs','utf-8')) : '';
    $_POST['my_company_established'] = (isset($_POST['my_company_established'])) ? trim(mb_convert_kana($_POST['my_company_established'],'KVs','utf-8')) : '';
    $_POST['my_company_capital'] = (isset($_POST['my_company_capital'])) ? trim(mb_convert_kana($_POST['my_company_capital'],'KVs','utf-8')) : '';
    $_POST['my_company_sales'] = (isset($_POST['my_company_sales'])) ? trim(mb_convert_kana($_POST['my_company_sales'],'KVs','utf-8')) : '';
    $_POST['my_company_employee'] = (isset($_POST['my_company_employee'])) ? trim(mb_convert_kana($_POST['my_company_employee'],'KVs','utf-8')) : '';
    $_POST['my_company_business'] = (isset($_POST['my_company_business'])) ? trim(mb_convert_kana($_POST['my_company_business'],'KVs','utf-8')) : '';
    $_POST['my_company_licensing'] = (isset($_POST['my_company_licensing'])) ? trim(mb_convert_kana($_POST['my_company_licensing'],'KVs','utf-8')) : '';
    $_POST['my_company_belong_group'] = (isset($_POST['my_company_belong_group'])) ? trim(mb_convert_kana($_POST['my_company_belong_group'],'KVs','utf-8')) : '';
    $_POST['my_company_major_tradings'] = (isset($_POST['my_company_major_tradings'])) ? trim(mb_convert_kana($_POST['my_company_major_tradings'],'KVs','utf-8')) : '';
    $_POST['my_company_financial_institutions'] = (isset($_POST['my_company_financial_institutions'])) ? trim(mb_convert_kana($_POST['my_company_financial_institutions'],'KVs','utf-8')) : '';
    $_POST['my_company_general_counsel'] = (isset($_POST['my_company_general_counsel'])) ? trim(mb_convert_kana($_POST['my_company_general_counsel'],'KVs','utf-8')) : '';
    $_POST['my_company_access'] = (isset($_POST['my_company_access'])) ? trim(mb_convert_kana($_POST['my_company_access'],'KVs','utf-8')) : '';

    $_POST['my_online_shop_url'] = (isset($_POST['my_online_shop_url'])) ? trim(mb_convert_kana($_POST['my_online_shop_url'],'as','utf-8')) : '';
    $_POST['my_online_reservation_url'] = (isset($_POST['my_online_reservation_url'])) ? trim(mb_convert_kana($_POST['my_online_reservation_url'],'as','utf-8')) : '';
    $_POST['my_company_map_url'] = (isset($_POST['my_company_map_url'])) ? trim(mb_convert_kana($_POST['my_company_map_url'],'as','utf-8')) : '';
    $_POST['my_company_hp_url'] = (isset($_POST['my_company_hp_url'])) ? trim(mb_convert_kana($_POST['my_company_hp_url'],'as','utf-8')) : '';

    $_POST['my_mynavi_url'] = (isset($_POST['my_mynavi_url'])) ? trim(mb_convert_kana($_POST['my_mynavi_url'],'as','utf-8')) : '';
    $_POST['my_line_url'] = (isset($_POST['my_line_url'])) ? trim(mb_convert_kana($_POST['my_line_url'],'as','utf-8')) : '';
    $_POST['my_facebook_url'] = (isset($_POST['my_facebook_url'])) ? trim(mb_convert_kana($_POST['my_facebook_url'],'as','utf-8')) : '';
    $_POST['my_twitter_url'] = (isset($_POST['my_twitter_url'])) ? trim(mb_convert_kana($_POST['my_twitter_url'],'as','utf-8')) : '';
    $_POST['my_instagram_url'] = (isset($_POST['my_instagram_url'])) ? trim(mb_convert_kana($_POST['my_instagram_url'],'as','utf-8')) : '';
    $_POST['my_youtube_url'] = (isset($_POST['my_youtube_url'])) ? trim(mb_convert_kana($_POST['my_youtube_url'],'as','utf-8')) : '';
    $_POST['my_pinterest_url'] = (isset($_POST['my_pinterest_url'])) ? trim(mb_convert_kana($_POST['my_pinterest_url'],'as','utf-8')) : '';
    $_POST['my_feedly_url'] = (isset($_POST['my_feedly_url'])) ? trim(mb_convert_kana($_POST['my_feedly_url'],'as','utf-8')) : '';
    $_POST['my_note_url'] = (isset($_POST['my_note_url'])) ? trim(mb_convert_kana($_POST['my_note_url'],'as','utf-8')) : '';

    $_POST['my_google_api_key'] = (isset($_POST['my_google_api_key'])) ? trim(mb_convert_kana($_POST['my_google_api_key'],'as','utf-8')) : '';
    //$_POST['my_privacy_policy'] = (isset($_POST['my_privacy_policy'])) ? trim(mb_convert_kana($_POST['my_privacy_policy'],'KVs','utf-8')) : '';

    $_POST['my_copyright'] = (isset($_POST['my_copyright'])) ? trim(mb_convert_kana($_POST['my_copyright'],'as','utf-8')) : '';
    $_POST['my_copyright_en'] = (isset($_POST['my_copyright_en'])) ? trim(mb_convert_kana($_POST['my_copyright_en'],'as','utf-8')) : '';
    $_POST['my_copyright_ch'] = (isset($_POST['my_copyright_ch'])) ? trim(mb_convert_kana($_POST['my_copyright_ch'],'as','utf-8')) : '';

    $_POST['my_contact_from_name'] = (isset($_POST['my_contact_from_name'])) ? trim(mb_convert_kana($_POST['my_contact_from_name'],'KVs','utf-8')) : '';
    $_POST['my_contact_from_name_en'] = (isset($_POST['my_contact_from_name_en'])) ? trim(mb_convert_kana($_POST['my_contact_from_name_en'],'KVs','utf-8')) : '';
    $_POST['my_contact_from_name_ch'] = (isset($_POST['my_contact_from_name_ch'])) ? trim(mb_convert_kana($_POST['my_contact_from_name_ch'],'KVs','utf-8')) : '';
    $_POST['my_contact_from_mail'] = (isset($_POST['my_contact_from_mail'])) ? trim(mb_convert_kana($_POST['my_contact_from_mail'],'as','utf-8')) : '';
    $_POST['my_contact_to_mail'] = (isset($_POST['my_contact_to_mail'])) ? trim(mb_convert_kana($_POST['my_contact_to_mail'],'as','utf-8')) : '';
    $_POST['my_contact_to_mail2'] = (isset($_POST['my_contact_to_mail2'])) ? trim(mb_convert_kana($_POST['my_contact_to_mail2'],'as','utf-8')) : '';
    $_POST['my_contact_to_mail3'] = (isset($_POST['my_contact_to_mail3'])) ? trim(mb_convert_kana($_POST['my_contact_to_mail3'],'as','utf-8')) : '';
    $_POST['my_contact_to_mail4'] = (isset($_POST['my_contact_to_mail4'])) ? trim(mb_convert_kana($_POST['my_contact_to_mail4'],'as','utf-8')) : '';
    $_POST['my_contact_to_mail5'] = (isset($_POST['my_contact_to_mail5'])) ? trim(mb_convert_kana($_POST['my_contact_to_mail5'],'as','utf-8')) : '';
    $_POST['my_contact_to_mail6'] = (isset($_POST['my_contact_to_mail6'])) ? trim(mb_convert_kana($_POST['my_contact_to_mail6'],'as','utf-8')) : '';
    $_POST['my_contact_to_mail7'] = (isset($_POST['my_contact_to_mail7'])) ? trim(mb_convert_kana($_POST['my_contact_to_mail7'],'as','utf-8')) : '';
    $_POST['my_contact_to_mail8'] = (isset($_POST['my_contact_to_mail8'])) ? rim(mb_convert_kana($_POST['my_contact_to_mail8'],'as','utf-8')) : '';

    $_POST['my_return_mail_subject'] = (isset($_POST['my_return_mail_subject'])) ? trim(mb_convert_kana($_POST['my_return_mail_subject'],'KVs','utf-8')) : '';
    $_POST['my_return_mail_body'] = (isset($_POST['my_return_mail_body'])) ? trim(mb_convert_kana($_POST['my_return_mail_body'],'KVs','utf-8')) : '';

    $_POST['my_return_mail_subject_application'] = (isset($_POST['my_return_mail_subject_application'])) ? trim(mb_convert_kana($_POST['my_return_mail_subject_application'],'KVs','utf-8')) : '';
    $_POST['my_return_mail_body_application'] = (isset($_POST['my_return_mail_body_application'])) ? trim(mb_convert_kana($_POST['my_return_mail_body_application'],'KVs','utf-8')) : '';

    $_POST['my_return_mail_subject_campaign'] = (isset($_POST['my_return_mail_subject_campaign'])) ? trim(mb_convert_kana($_POST['my_return_mail_subject_campaign'],'KVs','utf-8')) : '';
    $_POST['my_return_mail_body_campaign'] = (isset($_POST['my_return_mail_body_campaign'])) ? trim(mb_convert_kana($_POST['my_return_mail_body_campaign'],'KVs','utf-8')) : '';

    $_POST['my_return_mail_subject_business'] = (isset($_POST['my_return_mail_subject_business'])) ? trim(mb_convert_kana($_POST['my_return_mail_subject_business'],'KVs','utf-8')) : '';
    $_POST['my_return_mail_body_business'] = (isset($_POST['my_return_mail_body_business'])) ? trim(mb_convert_kana($_POST['my_return_mail_body_business'],'KVs','utf-8')) : '';

    $_POST['my_return_mail_subject_prize'] = (isset($_POST['my_return_mail_subject_prize'])) ? trim(mb_convert_kana($_POST['my_return_mail_subject_prize'],'KVs','utf-8')) : '';
    $_POST['my_return_mail_body_prize'] = (isset($_POST['my_return_mail_body_prize'])) ? trim(mb_convert_kana($_POST['my_return_mail_body_prize'],'KVs','utf-8')) : '';

    $_POST['my_email_signature'] = (isset($_POST['my_email_signature'])) ? trim(mb_convert_kana($_POST['my_email_signature'],'KVs','utf-8')) : '';
    $_POST['my_email_signature_en'] = (isset($_POST['my_email_signature_en'])) ? trim(mb_convert_kana($_POST['my_email_signature_en'],'KVs','utf-8')) : '';
    $_POST['my_email_signature_ch'] = (isset($_POST['my_email_signature_ch'])) ? trim(mb_convert_kana($_POST['my_email_signature_ch'],'KVs','utf-8')) : '';


# Validation 2
      $errmsg = array();
      foreach($input_name_array as $name_one):
        if(isset($_POST[$name_one])):

          if($name_one == 'my_contact_from_mail'):
            if($_POST[$name_one] == '') $errmsg[$name_one] = '送信元メールアドレス(From)を入力してください。';
            elseif(!preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信元(From)メールアドレスの入力値が不正です。メールアドレスが正しいか確認してください。';
          endif;
          if($name_one == 'my_contact_from_name'):
            //if($_POST[$name_one] == '') $errmsg[$name_one] = '送信元名(From)を入力してください。';
          endif;
          if($name_one == 'my_contact_to_mail'):
            if($_POST[$name_one] == '') $errmsg[$name_one] = '送信先メールアドレス(To)を入力してください。';
            elseif(!preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレスの入力値が不正です。メールアドレスが正しいか確認してください。';
          endif;
          if($name_one == 'my_contact_to_mail2'):
            if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス2の入力値が不正です。メールアドレスが正しいか確認してください。';
          endif;
          if($name_one == 'my_contact_to_mail3'):
            if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス3の入力値が不正です。メールアドレスが正しいか確認してください。';
          endif;
          if($name_one == 'my_contact_to_mail4'):
            if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス4の入力値が不正です。メールアドレスが正しいか確認してください。';
          endif;
          if($name_one == 'my_contact_to_mail5'):
            if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス5の入力値が不正です。メールアドレスが正しいか確認してください。';
          endif;
          if($name_one == 'my_contact_to_mail6'):
            if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス6の入力値が不正です。メールアドレスが正しいか確認してください。';
          endif;
          if($name_one == 'my_contact_to_mail7'):
            if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス7の入力値が不正です。メールアドレスが正しいか確認してください。';
          endif;
          if($name_one == 'my_contact_to_mail8'):
            if($_POST[$name_one] != '' and !preg_match('/^[^\@]+\@[^\@]+$/',$_POST[$name_one])) $errmsg[$name_one] = '送信先(To)メールアドレス8の入力値が不正です。メールアドレスが正しいか確認してください。';
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

      if($errmsg and is_array($errmsg)):
        foreach($errmsg as $value):
          $errmsg_all .= $value."#br#\n";
        endforeach;
      endif;


  endif;# wp_verify_nonce
?>
<h2>サイト設定</h2>

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

<?php $input_name = 'my_site_name'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">サイト名</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_site_name_en'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">サイト名(英語)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_site_name_ch'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">サイト名(中国語)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_name'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">会社名(組織名)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_name_en'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">会社名(組織名)英語</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_name_short'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">会社名(組織名)略称</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_president'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">代表者名</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_president_title'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">代表者 肩書</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_personal_info_protection_manager'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">個人情報保護管理者</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_zipcode'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">郵便番号</label></th>
      <td>
        〒<input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_address'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">住所</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_telno'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">電話番号</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_faxno'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">FAX番号</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_email'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">E-Mail</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(encode_entity(get_option('".$input_name."'))); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_contact_telno'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">お問い合わせ 電話番号</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_contact_reception_time'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">お問い合わせ 受付時間<br>(電話)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
<?php /*        <ul class="ulTag">
          <li>#small# ～ #/small# ---> &lt;span class="small"&gt; ～ &lt;/span&gt; 文字サイズ小</li>
        </ul>*/ ?>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_contact_staff'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">お問い合わせ 担当者</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_business_time'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">営業時間</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_holiday'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">定休日</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_founding'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">創業</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_established'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">設立</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_capital'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">資本金</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_sales'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">売上</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_employees'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">従業員数</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_business'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">事業内容</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo nl2br(esc_html(get_option('".$input_name."'))); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_licensing'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">許認可</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo nl2br(esc_html(get_option('".$input_name."'))); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_belong_group'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">所属団体</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo nl2br(esc_html(get_option('".$input_name."'))); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_major_tradings'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">主要取引先</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo nl2br(esc_html(get_option('".$input_name."'))); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_financial_institutions'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">取引金融機関</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo nl2br(esc_html(get_option('".$input_name."'))); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_general_counsel'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">顧問弁護士</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_access'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">アクセス</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo nl2br(esc_html(get_option('".$input_name."'))); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_map_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">MAP URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_map_embed_tag'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">MAP埋込タグ用 URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：&lt;iframe src="<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?>" width="600" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"&gt;&lt;/iframe&gt;</div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_company_hp_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">HP URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_online_shop_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Online Shop URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_online_reservation_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Online Reservation URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_mynavi_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">マイナビ URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_line_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Line URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_facebook_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Facebook URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_twitter_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Twitter URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_instagram_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Instagram URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_youtube_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Youtube URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_pinterest_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Pinterest URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_note_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">note URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_feedly_url'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Feedly URL</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_url(get_option('".$input_name."')); ?>"); ?></div>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_google_api_key'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">Google Api Key</label></th>
      <td>
        <input type="password" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <?php /*<div class="boxDispTag">表示タグ：<?php echo esc_html("<?php echo esc_html(get_option('".$input_name."')); ?>"); ?></div>*/ ?>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_privacy_policy'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">プライバシーポリシー</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_copyright'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">コピーライト表記</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <ul class="ulTag">
          <li>#c# ---> &copy;</li>
          <li>#year# ---> <?php echo esc_html(date('Y')); ?></li>
        </ul>
        <p class="pExample">Copyright <span class="markCopy">&copy;</span> <?php echo date('Y'); ?> Exsample All rights reserved.</p>
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_copyright_en'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">コピーライト表記(英語)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <ul class="ulTag">
          <li>#c# ---> &copy;</li>
          <li>#year# ---> <?php echo esc_html(date('Y')); ?></li>
        </ul>
        <p class="pExample">Copyright <span class="markCopy">&copy;</span> <?php echo date('Y'); ?> Exsample All rights reserved.</p>
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_copyright_ch'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">コピーライト表記(中国語)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        <ul class="ulTag">
          <li>#c# ---> &copy;</li>
          <li>#year# ---> <?php echo esc_html(date('Y')); ?></li>
        </ul>
        <p class="pExample">Copyright <span class="markCopy">&copy;</span> <?php echo date('Y'); ?> Exsample All rights reserved.</p>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_tag_head_top'; ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">タグ設置(head開始タグ直後)</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
      </td>
    </tr>


<?php $input_name = 'my_analytics_tag'; ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">タグ設置(head終了タグ直前)</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
      </td>
    </tr>


<?php $input_name = 'my_tag_body_top'; ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">タグ設置(body開始タグ直後)</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
      </td>
    </tr>

  </table>


<?php /*
  <h3>【 お問い合わせフォーム 】</h3>
  <table class="form-table">

<?php $input_name = 'my_contact_from_name'; ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信元名(From)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>

<?php $input_name = 'my_contact_from_name_en'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信元名(From)(英語)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_contact_from_name_ch'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信元名(From)(中国語)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_contact_from_mail'; ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信元メールアドレス(From)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>

<?php $input_name = 'my_contact_to_mail'; ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>

<?php $input_name = 'my_contact_to_mail2'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス2(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_contact_to_mail3'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス3(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_contact_to_mail4'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス4(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_contact_to_mail5'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス5(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_contact_to_mail6'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス6(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_contact_to_mail7'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス7(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_contact_to_mail8'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">送信先メールアドレス8(To)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_return_mail_subject'; ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 件名</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>

<?php $input_name = 'my_return_mail_subject_en'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 件名(英語)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_return_mail_subject_ch'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 件名(中国語)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_return_mail_body'; ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 本文</label></th>
      <td>
        <span class="txtMyReturnMailBodyTop">〇〇 〇〇 様<br></span><br>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
        <p class="pCaution"><span class="cBaseRed">#INPUT_CONT#</span> タグを挿入することによって、このタグが入力内容に置換されます。</p>
      </td>
    </tr>

<?php $input_name = 'my_return_mail_body_en'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 本文(英語)</label></th>
      <td>
        <span class="txtMyReturnMailBodyTop">〇〇 〇〇 様<br></span><br>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
        <p class="pCaution"><span class="cBaseRed">#INPUT_CONT#</span> タグを挿入することによって、このタグが入力内容に置換されます。</p>
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_return_mail_body_ch'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 本文(中国語)</label></th>
      <td>
        <span class="txtMyReturnMailBodyTop">〇〇 〇〇 様<br></span><br>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
        <p class="pCaution"><span class="cBaseRed">#INPUT_CONT#</span> タグを挿入することによって、このタグが入力内容に置換されます。</p>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_return_mail_subject_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 件名<br>(採用イベント)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_return_mail_body_application'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 本文<br>(採用イベント)</label></th>
      <td>
        <span class="txtMyReturnMailBodyTop">〇〇 〇〇 様<br></span><br>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
        <p class="pCaution"><span class="cBaseRed">#INPUT_CONT#</span> タグを挿入することによって、このタグが入力内容に置換されます。</p>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_return_mail_subject_campaign'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 件名<br>(キャンペーン)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_return_mail_body_campaign'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 本文<br>(キャンペーン)</label></th>
      <td>
        <span class="txtMyReturnMailBodyTop">〇〇 〇〇 様<br></span><br>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
        <p class="pCaution"><span class="cBaseRed">#INPUT_CONT#</span> タグを挿入することによって、このタグが入力内容に置換されます。</p>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_return_mail_subject_business'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 件名<br>(法人・お取引先)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_return_mail_body_business'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 本文<br>(法人・お取引先)</label></th>
      <td>
        <span class="txtMyReturnMailBodyTop">〇〇 〇〇 様<br></span><br>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
        <p class="pCaution"><span class="cBaseRed">#INPUT_CONT#</span> タグを挿入することによって、このタグが入力内容に置換されます。</p>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_return_mail_subject_prize'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 件名<br>(ご当選者入力フォーム)</label></th>
      <td>
        <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_return_mail_body_prize'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">自動返信メール 本文<br>(ご当選者入力フォーム)</label></th>
      <td>
        <span class="txtMyReturnMailBodyTop">〇〇 〇〇 様<br></span><br>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
        <p class="pCaution"><span class="cBaseRed">#INPUT_CONT#</span> タグを挿入することによって、このタグが入力内容に置換されます。</p>
      </td>
    </tr>
<?php endif; ?>


<?php $input_name = 'my_email_signature'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">メール署名</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_email_signature_en'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">メール署名(英語)</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_email_signature_ch'; ?>
<?php if(in_array($input_name, $input_name_array)): ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">メール署名(中国語)</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea><br>
      </td>
    </tr>
<?php endif; ?>

<?php $input_name = 'my_contact_conversion_tag'; ?>
    <tr>
      <th><label for="<?php echo esc_attr($input_name); ?>">サンクスページ設置タグ</label></th>
      <td>
        <textarea name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_name); ?>"><?php if(isset($_POST[$input_name])) echo esc_textarea($_POST[$input_name]); ?></textarea>
      </td>
    </tr>
  </table>
*/ ?>

  <input type="hidden" name="submit" value="1">
  <?php
  wp_nonce_field($action, $nonce);
  submit_button();
  ?>

</form>
<?php

}#func my_site_setting


?>