<?php
if(isset($_GET['mode']) and $_GET['mode'] == 'test'):
  $system_check = '';
  if(!get_option('my_contact_from_name') and !get_option('csnkform_from_name')) $system_check .= '送信元名(From)が設定されていません。<br>'."\n";
  if(!get_option('my_contact_from_mail') and !get_option('csnkform_from_mail')) $system_check .= '送信元メールアドレス(From)が設定されていません。<br>'."\n";
  if(!get_option('my_contact_to_mail') and !get_option('csnkform_to_mail')) $system_check .= '送信先メールアドレス(To)が設定されていません。<br>'."\n";
  if(!get_option('my_return_mail_subject') and !get_option('csnkform_return_mail_subject')) $system_check .= '自動返信の件名が設定されていません。<br>'."\n";
  if(!get_option('my_return_mail_body') and !get_option('csnkform_return_mail_body')) $system_check .= '自動返信の本文が設定されていません。<br>'."\n";
  echo '<div class="boxCsnkFormSystemMessage">'."\n";
  if($system_check == ''):
    echo 'System OK.<br>'."\n";
  else:
    echo 'System NG.<br>'."\n".$system_check;
  endif;
  echo '</div>'."\n";
endif;// System Test


if(isset($_POST)):
  foreach($_POST as $key => $value):
    if(is_array($value)):
      foreach($value as $key2 => $value2):
        $_POST[$key][$key2] = htmlspecialchars_decode(stripslashes($_POST[$key][$key2]), ENT_QUOTES);
      endforeach;
    else:
      $_POST[$key] = htmlspecialchars_decode(stripslashes($_POST[$key]), ENT_QUOTES);
    endif;
  endforeach;
endif;


$post_token = isset($_POST['token']) ? $_POST['token'] : '';
$session_token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
if(isset($_SESSION['token'])) unset($_SESSION['token']);
$token = uniqid('', true);
$_SESSION['token'] = $token;


foreach(glob(ABSPATH.'tmp/data/*') as $filename):
  (filemtime($filename) < time()-60*60*2) ? $check = 'del' : $check = '';
  if($check == 'del'):
    unlink($filename);
  endif;
endforeach;

if(!isset($_POST) or !$_POST):
  $_SESSION['attach_name0'] = '';
  $_SESSION['attach_extension0'] = '';
  $_SESSION['attach_name1'] = '';
  $_SESSION['attach_extension1'] = '';
endif;

if(isset($_SESSION['attach_name0']) and $_SESSION['attach_name0']) $_POST['attach_name0'] = $_SESSION['attach_name0'];
if(isset($_SESSION['attach_name1']) and $_SESSION['attach_name1']) $_POST['attach_name1'] = $_SESSION['attach_name1'];

$csnkform_setting_array = array(
  'address_mode' => 'notOne',//one / notOne
);

$input_name_array = array(
  'my_name' => 'お名前',
  'my_name_kana' => 'ふりがな',
  'email' => 'メールアドレス',
  'email2' => 'メールアドレス確認',
  'telno' => '電話番号',
  'faxno' => 'FAX番号',
  'zipcode' => '郵便番号',
  'pref' => '都道府県',
  'address' => 'ご住所',
  'birth_year' => '生年月日(年)',
  'birth_month' => '生年月日(月)',
  'birth_day' => '生年月日(日)',
  'cont_text' => 'テキスト項目',
  'cont_text2' => 'テキスト項目2',
  'cont_text3' => 'テキスト項目3',
  'cont_textarea' => 'テキストエリア',
  'cont_textarea2' => 'テキストエリア2',
  'cont_textarea3' => 'テキストエリア3',
  'cont_date' => '日付1',
  'cont_date2' => '日付2',
  'cont_date3' => '日付3',
  'cont_select' => 'お問い合わせ項目',
  'cont_select2' => 'お問い合わせ項目2',
  'cont_select3' => 'お問い合わせ項目3',
  'cont_radio' => 'お問い合わせ項目',
  'cont_radio2' => 'お問い合わせ項目2',
  'cont_radio3' => 'お問い合わせ項目3',
  'cont_checkbox' => 'お問い合わせ項目2',
  'cont_checkbox2' => 'お問い合わせ項目3',
  'cont_checkbox3' => 'お問い合わせ項目',
  'file1' => '添付ファイル',
  'file2' => '添付ファイル2',
  'cont' => 'メッセージ',
  'check_privacy_p' => '個人情報保護方針',
);

$required_name_array = array(
  'my_name',
  'my_name_kana',
  'email',
  'email2',

  'telno',
  'faxno',
  'zipcode',
  'pref',
  'address',
  'birth_year',
  'birth_month',
  'birth_day',
  'cont_text',
  'cont_text2',
  'cont_text3',
  'cont_textarea',
  'cont_textarea2',
  'cont_textarea3',
  'cont_date',
  'cont_date2',
  'cont_date3',
  'cont_select',
  'cont_select2',
  'cont_select3',
  'cont_radio',
  'cont_radio2',
  'cont_radio3',
  'cont_checkbox',
  'cont_checkbox2',
  'cont_checkbox3',
  'file1',
  'file2',

  'cont',
  'check_privacy_p',
);

$input_name_before_array = array(
  'zipcode' => '〒',
  'zipcode1' => '〒',
);

$input_name_after_array = array(
  'reservation_num' => '名',
  'age' => '歳',
  'participation_parent_num' => '人',
);

/*
  'my_name' => 'お名前',
  'my_name_kana' => 'フリガナ',
  'company_name' => '会社名',
  'company_name_kana' => 'フリガナ',
  'email' => 'メールアドレス',
  'email2' => 'メールアドレス(確認用)',
  'telno' => '電話番号',
  'age' => '年齢',
  'zipcode' => '郵便番号',
  'zipcode1' => '郵便番号(前3桁)',
  'zipcode2' => '郵便番号(後4桁)',
  'pref' => '都道府県',
  'address' => '住所',
  'gender' => '性別',
  'birth_year' => '生年月日(年)',
  'birth_month' => '生年月日(月)',
  'birth_day' => '生年月日(日)',
  'cont_text' => 'テキスト項目',
  'cont_text2' => 'テキスト項目2',
  'cont_text3' => 'テキスト項目3',
  'cont_textarea' => 'テキストエリア',
  'cont_textarea2' => 'テキストエリア2',
  'cont_textarea3' => 'テキストエリア3',
  'cont_date' => '日付1',
  'cont_date2' => '日付2',
  'cont_date3' => '日付3',
  'cont_select' => 'お問い合わせ項目',
  'cont_select2' => 'お問い合わせ項目2',
  'cont_select3' => 'お問い合わせ項目3',
  'cont_radio' => 'お問い合わせ項目',
  'cont_radio2' => 'お問い合わせ項目2',
  'cont_radio3' => 'お問い合わせ項目3',
  'cont_checkbox' => 'お問い合わせ項目',
  'cont_checkbox2' => 'お問い合わせ項目2',
  'cont_checkbox3' => 'お問い合わせ項目3',
  'file1' => '添付ファイル',
  'file2' => '添付ファイル2',
  'cont' => '自由記入欄',
  'check_privacy_p' => 'プライバシーポリシー',
  'desired_date' => '参加希望日',
  'participation_cont1' => '参加項目',
  'club_name' => '部活名',
  'school_name' => '学校名',
  'school_name_else' => '学校名',
  'school_grade' => '学年',
*/

$pref_array = csnkform_get_pref_array();
$gender_array = csnkform_get_gender_array();

$cont_select_array = array(
  '内容1',
  '内容2',
  '内容3',
  );
$cont_select2_array = array(
  '内容1',
  '内容2',
  '内容3',
  );
$cont_select3_array = array(
  '内容1',
  '内容2',
  '内容3',
  );

$cont_radio_array = array(
  '内容1',
  '内容2',
  '内容3',
  );
$cont_radio2_array = array(
  '内容1',
  '内容2',
  '内容3',
  );
$cont_radio3_array = array(
  '内容1',
  '内容2',
  '内容3',
  );

$cont_checkbox_array = array(
  '内容1',
  '内容2',
  '内容3',
  );
$cont_checkbox2_array = array(
  '内容1',
  '内容2',
  '内容3',
  );
$cont_checkbox3_array = array(
  '内容1',
  '内容2',
  '内容3',
  );


$google_recaptcha_chk = 1;
if(get_option('csnkform_google_recaptcha_site_key') and get_option('csnkform_google_recaptcha_secret_key')):
  $google_recaptcha_chk = 0;
  $secretKey = get_option('csnkform_google_recaptcha_secret_key');
  $captchaResponse = '';
  if(isset($_POST['g-recaptcha-response'])):
    $captchaResponse = $_POST['g-recaptcha-response'];
  endif;
  /* if(isset($_GET['pcode']) and $_GET['pcode'] == '123'):
    echo 'Res:'.$captchaResponse."<br>";
  endif; */
  $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$captchaResponse);
  $responseData = json_decode($verifyResponse);
  if($responseData->success):
    $google_recaptcha_chk = 1;
  endif;
endif;


$action = 'contact_'.strtotime(wp_date('d')).strtotime(wp_date('Y')).strtotime(wp_date('m'));
$nonce = wp_create_nonce($action);
$errmsg_array = array();
if(isset($_POST[$nonce]) and wp_verify_nonce($_POST[$nonce], $action) and $google_recaptcha_chk):

  if((isset($_POST['submit1']) and $_POST['submit1']) or (isset($_POST['submit2']) and $_POST['submit2']) or (isset($_POST['back']) and $_POST['back']) or (isset($_POST['del_attach0']) and $_POST['del_attach0']) or (isset($_POST['del_attach1']) and $_POST['del_attach1'])):


    if(isset($_POST['del_attach0']) and $_POST['del_attach0']):
      if(isset($_POST['attach_name0']) and $_POST['attach_name0'] and preg_match('/\.(jpg|jpeg|gif|png|pdf|xlsx|docx)$/',$_POST['attach_name0'])):
        if(file_exists(ABSPATH.'tmp/data/'.$_POST['attach_name0'])):
          unlink(ABSPATH.'tmp/data/'.$_POST['attach_name0']);
        endif;
        $_POST['attach_name0'] = '';
        $_SESSION['attach_name0'] = '';
        $_SESSION['attach_extension0'] = '';
      endif;
    endif;

    if(isset($_POST['del_attach1']) and $_POST['del_attach1']):
      if(isset($_POST['attach_name1']) and $_POST['attach_name1'] and preg_match('/\.(jpg|jpeg|gif|png|pdf|xlsx|docx)$/',$_POST['attach_name1'])):
        if(file_exists(ABSPATH.'tmp/data/'.$_POST['attach_name1'])):
          unlink(ABSPATH.'tmp/data/'.$_POST['attach_name1']);
        endif;
        $_POST['attach_name1'] = '';
        $_SESSION['attach_name1'] = '';
        $_SESSION['attach_extension1'] = '';
      endif;
    endif;


    $allow_attach_extension = array('jpg','jpeg','gif','png','pdf','xlsx','docx');
    if(isset($_FILES['attach']['error']) and $_FILES['attach']['error'] and is_array($_FILES['attach']['error'])):
      foreach($_FILES['attach']['error'] as $key => $value):
        //if(isset($_SESSION['attach_name'.$key]) and !$_SESSION['attach_name'.$key]):
        if(!isset($_SESSION['attach_name'.$key]) or !$_SESSION['attach_name'.$key]):
          if(isset($_FILES['attach']['error'][$key]) and $_FILES['attach']['error'][$key] === 0):
            if(isset($_FILES['attach']['tmp_name'][$key]) and is_uploaded_file($_FILES['attach']['tmp_name'][$key])):
              $tmp_name = $_FILES['attach']['tmp_name'][$key];
              $attach_name = mb_strtolower(mb_convert_kana(basename($_FILES['attach']['name'][$key]), 'as', 'utf-8'), 'utf-8');
              $extension = pathinfo($attach_name, PATHINFO_EXTENSION);
              //echo "TEST:".$attach_name.':'.$extension."<br>";
              if(in_array($extension, $allow_attach_extension)):
                $attach_name = 'tmp'.$key.'-'.time().'.'.$extension;
                //echo "Aname:".$attach_name."<br>";
                if(move_uploaded_file($tmp_name, 'tmp/data/'.$attach_name)):
                  //echo "Up TEST OK<br>".$attach_name."<br>";
                  //chmod("data/$name", 0644);
                  $_POST['attach_name'.$key] = $attach_name;
                  $_SESSION['attach_name'.$key] = $attach_name;
                  $_SESSION['attach_extension'.$key] = $extension;
                endif;
              else:
                $errmsg_array['attach'.$key] = '添付できるファイルはjpg、png、gif、pdf、xlsx、docx 形式のみです。';
              endif;
            endif;
          endif;
        endif;
      endforeach;
    endif;


    // Validate
    // required / notRequired


    $input_name = 'my_name';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'my_name_kana';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      //$_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVsHc','utf-8')) : '';//ひらがな
      //$_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVsC','utf-8')) : '';//ヒラガナ
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      //$errmsg_array[$input_name] = csnkform_validate($input_name_array[$input_name], $input_name, 'required');
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
      /*
      if(empty($errmsg_array[$input_name]) and isset($_POST[$input_name]) and !preg_match('/^[ぁ-ゞ\s]+$/u', $_POST[$input_name])):
        $errmsg_array[$input_name] = 'ひらがなで入力してください。';
      endif;*/
      /*
      if(empty($errmsg_array[$input_name]) and isset($_POST[$input_name]) and !preg_match('/^[ァ-ヾ\s]+$/u', $_POST[$input_name])):
        $errmsg_array[$input_name] = 'ヒラガナで入力してください。';
      endif;*/
    endif;

    $input_name = 'company_name';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'company_name_kana';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate_text($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'gender';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'as','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
      $s_gender[$input_name] = ' checked';
    endif;

    $input_name = 'email';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'as','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'email2';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'as','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'telno';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'faxno';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'age';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      //if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'zipcode';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $_POST[$input_name] = preg_replace('/^([0-9]{3})[^0-9\-]([0-9]{4})/u', '$1-$2', $_POST[$input_name]);
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'zipcode1';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      //if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'zipcode2';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      //if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'pref';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
      $s_pref[$_POST[$input_name]] = ' selected';
    endif;

    $input_name = 'address';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'birth_year';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
      $s_birth_year[$_POST[$input_name]] = ' selected';
    endif;

    $input_name = 'birth_month';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
      $s_birth_month[$_POST[$input_name]] = ' selected';
    endif;

    $input_name = 'birth_day';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
      $s_birth_day[$_POST[$input_name]] = ' selected';
    endif;

    $input_name = 'cont_text';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate_text($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_text2';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate_text($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_text3';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate_text($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_textarea';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate_textarea($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_textarea2';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate_textarea($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_textarea3';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate_textarea($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_date';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'as','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_date2';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'as','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_date3';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'as','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_select';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_select2';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_select3';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_radio';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_radio2';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_radio3';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_checkbox';
    if(array_key_exists($input_name, $input_name_array)):
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_checkbox2';
    if(array_key_exists($input_name, $input_name_array)):
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'cont_checkbox3';
    if(array_key_exists($input_name, $input_name_array)):
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'file1';
    if(array_key_exists($input_name, $input_name_array)):
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($required == 'required'):
        //if($_POST['cont_radio'] == '1')://Option 条件分岐あり
        if(!isset($_SESSION['attach_name0']) or $_SESSION['attach_name0'] == ''):
          $errmsg_array['attach_name0'] = '添付するファイルをアップロードしてください。';
        endif;
        //endif;
      endif;
    endif;

    $input_name = 'file2';
    if(array_key_exists($input_name, $input_name_array)):
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($required == 'required'):
        //if($_POST['cont_radio'] == '1')://Option 条件分岐あり
        if(!isset($_SESSION['attach_name1']) or $_SESSION['attach_name1'] == ''):
          $errmsg_array['attach_name1'] = '添付するファイルをアップロードしてください。';
        endif;
        //endif;
      endif;
    endif;

    $input_name = 'cont';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'KVs','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
    endif;

    $input_name = 'check_privacy_p';
    if(array_key_exists($input_name, $input_name_array)):
      $_POST[$input_name] = (isset($_POST[$input_name])) ? trim(mb_convert_kana($_POST[$input_name],'ns','utf-8')) : '';
      $required = (in_array($input_name, $required_name_array)) ? 'required' : 'notRequired';
      if($errmsg = csnkform_validate($input_name_array[$input_name], $input_name, $required)) $errmsg_array[$input_name] = $errmsg;
      $s_check_privacy_p[$_POST[$input_name]] = ' checked';
    endif;


    if($errmsg_array):
      unset($_POST['submit1']);
      unset($_POST['submit2']);
    endif;


    if(!$errmsg_array and (isset($_POST['submit2']) and $_POST['submit2'])):
      $this_url = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
      $this_url = esc_url($this_url.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
      #delParam
      $this_url = preg_replace('/\?.+$/','',$this_url);


      if($post_token != $session_token):
        $add_param = (isset($_GET['pcode']) and $_GET['pcode']) ? '&pcode='.esc_html(strip_tags($_GET['pcode'])) : '';
        wp_redirect($this_url.'?rst=1&posi=posiCsnkForm'.$add_param);
        exit;
      endif;


      $data_for_mail_all = '';
      foreach($input_name_array as $input_name => $value):

        if($input_name == 'email2'):
          //処理なし

        elseif($input_name == 'zipcode1'):
          if($csnkform_setting_array['address_mode'] == 'one'):
            //処理なし
          else:
            $input_name2 = 'zipcode2';
            if(isset($_POST[$input_name]) and $_POST[$input_name] != '' and isset($_POST[$input_name2]) and $_POST[$input_name2] != ''):
              $zipcode = '〒'.$_POST[$input_name].'-'.$_POST[$input_name2]."\n";
              $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '.esc_html($zipcode)."\n\n";
            endif;
          endif;

        elseif($input_name == 'zipcode'):
          if(isset($csnkform_setting_array['address_mode']) and $csnkform_setting_array['address_mode'] == 'one'):
            //処理なし
          else:
            if(isset($_POST[$input_name]) and $_POST[$input_name] != ''):
              $before_str = (isset($input_name_before_array[$input_name]) and $input_name_before_array[$input_name]) ? esc_html($input_name_before_array[$input_name]) : '';
              $after_str = (isset($input_name_after_array[$input_name]) and $input_name_after_array[$input_name]) ? esc_html($input_name_after_array[$input_name]) : '';
              $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '.$before_str.esc_html($_POST[$input_name]).$after_str."\n\n";
            endif;
          endif;

        elseif($input_name == 'pref'):
          if(isset($csnkform_setting_array['address_mode']) and $csnkform_setting_array['address_mode'] == 'one'):
            //処理なし
          else:
            if(isset($_POST[$input_name]) and $_POST[$input_name] != ''):
              if(preg_match('/^[0-9]+$/', $_POST[$input_name]) and is_array($pref_array) and isset($pref_array[$_POST[$input_name]])):
                $pref = $pref_array[$_POST[$input_name]];
              else:
                $pref = $_POST[$input_name];
              endif;
              $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '.esc_html($pref)."\n\n";
            endif;
          endif;

        elseif($input_name == 'address'):
          if(isset($csnkform_setting_array['address_mode']) and $csnkform_setting_array['address_mode'] == 'one'):
            if(isset($_POST['zipcode1']) and $_POST['zipcode1']):
              if(isset($_POST['zipcode1']) and $_POST['zipcode1'] != '' and isset($_POST['zipcode2']) and $_POST['zipcode2'] != ''):
                //$zipcode = '〒'.$_POST['zipcode1'].'-'.$_POST['zipcode2']."\n";
                $zipcode = '〒'.$_POST['zipcode1'].'-'.$_POST['zipcode2']." ";
              endif;
            else:
              if(isset($_POST['zipcode']) and $_POST['zipcode'] != ''):
                //$zipcode = '〒'.$_POST['zipcode']."\n";
                $zipcode = '〒'.$_POST['zipcode']." ";
              endif;
            endif;
            if(isset($_POST['pref']) and $_POST['pref'] != ''):
              if(preg_match('/^[0-9]+$/', $_POST['pref']) and is_array($pref_array) and isset($pref_array[$_POST['pref']])):
                $pref = $pref_array[$_POST['pref']];
              else:
                $pref = $_POST['pref'];
              endif;
            endif;
            if(isset($_POST[$input_name]) and $_POST[$input_name] != ''):
              $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '.esc_html($zipcode).esc_html($pref).esc_html($_POST[$input_name])."\n\n";
            endif;
          else:
            if(isset($_POST[$input_name]) and $_POST[$input_name] != ''):
              $before_str = (isset($input_name_before_array[$input_name]) and $input_name_before_array[$input_name]) ? esc_html($input_name_before_array[$input_name]) : '';
              $after_str = (isset($input_name_after_array[$input_name]) and $input_name_after_array[$input_name]) ? esc_html($input_name_after_array[$input_name]) : '';
              $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '.$before_str.esc_html($_POST[$input_name]).$after_str."\n\n";
            endif;
          endif;

        elseif($input_name == 'birth_year'):
          $input_name2 = 'birth_month';
          $input_name3 = 'birth_day';
          if(isset($_POST[$input_name]) and $_POST[$input_name] != '' and isset($_POST[$input_name2]) and $_POST[$input_name2] != '' and isset($_POST[$input_name3]) and $_POST[$input_name3] != ''):
            $data_for_mail_all .= '【生年月日】 '.esc_html($_POST[$input_name]).'年 '.esc_html($_POST[$input_name2]).'月 '.esc_html($_POST[$input_name3]).'日'."\n\n";
          endif;

        elseif($input_name == 'birth_month' or $input_name == 'birth_day'):
          //処理なし

        elseif($input_name == 'gender'):
          if(isset($_POST[$input_name]) and $_POST[$input_name] != '' and isset($gender_array[$_POST[$input_name]])):
            $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '.esc_html($gender_array[$_POST[$input_name]])."\n\n";
          endif;

        elseif($input_name == 'cont_select' or $input_name == 'cont_select2' or $input_name == 'cont_select3'):
          if($input_name == 'cont_select'):
            $select_data_array = $cont_select_array;
          elseif($input_name == 'cont_select2'):
            $select_data_array = $cont_select2_array;
          elseif($input_name == 'cont_select3'):
            $select_data_array = $cont_select3_array;
          endif;
          if(isset($_POST[$input_name]) and $_POST[$input_name] != '' and isset($select_data_array[$_POST[$input_name]])):
            $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '.esc_html($select_data_array[$_POST[$input_name]])."\n\n";
          endif;

        elseif($input_name == 'cont_radio' or $input_name == 'cont_radio2' or $input_name == 'cont_radio3'):
          if($input_name == 'cont_radio'):
            $radio_data_array = $cont_radio_array;
          elseif($input_name == 'cont_radio2'):
            $radio_data_array = $cont_radio2_array;
          elseif($input_name == 'cont_radio3'):
            $radio_data_array = $cont_radio3_array;
          endif;
          if(isset($_POST[$input_name]) and $_POST[$input_name] != '' and isset($radio_data_array[$_POST[$input_name]])):
            $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '.esc_html($radio_data_array[$_POST[$input_name]])."\n\n";
          endif;

        elseif($input_name == 'cont_checkbox' or $input_name == 'cont_checkbox2' or $input_name == 'cont_checkbox3'):
          if($input_name == 'cont_checkbox'):
            $checkbox_data_array = $cont_checkbox_array;
          elseif($input_name == 'cont_checkbox2'):
            $checkbox_data_array = $cont_checkbox2_array;
          elseif($input_name == 'cont_checkbox3'):
            $checkbox_data_array = $cont_checkbox3_array;
          endif;
          if(isset($_POST[$input_name]) and $_POST[$input_name] != ''):
            $checkbox_data = '';
            if(isset($_POST[$input_name]) and $_POST[$input_name] and is_array($_POST[$input_name])):
              foreach($_POST[$input_name] as $data_value):
                if($checkbox_data) $checkbox_data .= '、';
                $checkbox_data .= $checkbox_data_array[$data_value];
              endforeach;
            endif;
            $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '.esc_html($checkbox_data)."\n\n";
          endif;

        elseif($input_name == 'file1'):
          if(!empty($_POST['attach_name0']) and preg_match('/\.(jpg|jpeg|gif|png|pdf|xlsx|docx)$/', $_POST['attach_name0'])):
            $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 添付あり'."\n\n";
          endif;

        elseif($input_name == 'file2'):
          if(!empty($_POST['attach_name1']) and preg_match('/\.(jpg|jpeg|gif|png|pdf|xlsx|docx)$/', $_POST['attach_name1'])):
            $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 添付あり'."\n\n";
          endif;

        elseif($input_name == 'cont' or $input_name == 'cont_textarea' or $input_name == 'cont_textarea2' or $input_name == 'cont_textarea3'):
          if(!empty($_POST[$input_name])):
            $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '."\n".esc_html($_POST[$input_name])."\n\n";
          endif;

        elseif($input_name == 'check_privacy_p'):
          if(!empty($_POST[$input_name])):
            $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 同意する'."\n\n";
          endif;

        else:
          if(isset($_POST[$input_name]) and $_POST[$input_name] != ''):
            $before_str = (isset($input_name_before_array[$input_name]) and $input_name_before_array[$input_name]) ? esc_html($input_name_before_array[$input_name]) : '';
            $after_str = (isset($input_name_after_array[$input_name]) and $input_name_after_array[$input_name]) ? esc_html($input_name_after_array[$input_name]) : '';

            $data_for_mail_all .= '【'.csnkform_strip_code($input_name_array[$input_name]).'】 '.$before_str.esc_html($_POST[$input_name]).$after_str."\n\n";

          endif;
        endif;

      endforeach;//input_name_array



      # 自動返信メール

      $datetimedb = wp_date('Y-m-d H:i:s');
      $datetimestamp = strtotime($datetimedb);
      $datetime = date('Y年m月d日 H:i', $datetimestamp);


      $my_to_email = esc_html($_POST['email']);

      $my_from_email = '';
      if(get_option('csnkform_from_mail')):
        $my_from_email = esc_html(get_option('csnkform_from_mail'));
      elseif(get_option('my_contact_from_mail')):
        $my_from_email = esc_html(get_option('my_contact_from_mail'));
      else:
        $my_from_email = esc_html(get_option('admin_email'));
      endif;

      $my_from_name = '';
      if(get_option('csnkform_from_name')):
        $my_from_name = esc_html(get_option('csnkform_from_name'));
      elseif(get_option('my_contact_from_name')):
        $my_from_name = esc_html(get_option('my_contact_from_name'));
      else:
        $my_from_name = $my_from_email;
      endif;

      $my_subject = '';
      if(get_option('csnkform_return_mail_subject')):
        $my_subject = esc_html(get_option('csnkform_return_mail_subject'));
      elseif(get_option('my_return_mail_subject')):
        $my_subject = esc_html(get_option('my_return_mail_subject'));
      endif;

      if(get_option('csnkform_company_name')):
        $my_subject = preg_replace('/\#COMPANY\_NAME\#/', esc_html(get_option('csnkform_company_name')), $my_subject);
      elseif(get_option('my_company_name')):
        $my_subject = preg_replace('/\#COMPANY\_NAME\#/', esc_html(get_option('my_company_name')), $my_subject);
      endif;

      $my_body0 = '';
      if(get_option('csnkform_return_mail_body')):
        $my_body0 = esc_html(get_option('csnkform_return_mail_body'));
      elseif(get_option('my_return_mail_body')):
        $my_body0 = esc_html(get_option('my_return_mail_body'));
      endif;

      $my_body = esc_html($_POST['my_name']).' 様'."\n\n".$my_body0;
      $my_body = preg_replace('/\#INPUT\_CONT\#/', $data_for_mail_all, $my_body);

      $my_reply_email = $my_from_email;
      if($my_to_email != ''):
        $mail_attach = '';
        //csnkform_send_mail_v50($my_to_email, $my_from_email, $my_from_name, $my_subject, $my_body, $encoding = 'utf-8', $mail_attach);
        csnkform_send_mail_v60($my_to_email, $my_from_email, $my_from_name, $my_reply_email, $my_subject, $my_body, $encoding = 'utf-8', $mail_attach);
      endif;


      # 管理者通知メール
      $my_to_email2 = '';
      if(get_option('csnkform_to_mail')):
        $my_to_email2 = esc_html(get_option('csnkform_to_mail'));
      elseif(get_option('my_contact_to_mail')):
        $my_to_email2 = esc_html(get_option('my_contact_to_mail'));
      else:
        $my_to_email2 = esc_html(get_option('admin_email'));
      endif;

      $page_title = trim(strip_tags(get_the_title()));

      $my_from_email2 = $my_from_email;
      $my_subject2 = esc_html($_POST['my_name']).' 様からお問い合わせがありました。';
      $my_body2 = 'お問い合わせがありました。

---------------------------------------------------------
＝ 入力内容 ＝

'.$data_for_mail_all.'
---------------------------------------------------------

送信日時：'.$datetime.'
送信ページ：'.esc_html($page_title).'
送信URL：'.esc_url($this_url).'
送信IP: '.esc_html($_SERVER['REMOTE_ADDR']).'
送信AGENT: '.esc_html($_SERVER['HTTP_USER_AGENT']).'

';

//送信ページSlug：'.esc_html(rawurldecode($post->post_name)).'


if(!isset($_GET['pcode']) or $_GET['pcode'] != '123'):
# DBin
      $con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
      mysqli_set_charset($con, 'utf8');
      $sql = 'insert into csnkform_data
        (
        mail_page_slug,
        mail_to,
        mail_from,
        mail_from_name,
        mail_subject,
        mail_body,
        date_time,
        user_agent,
        ip
      ) values (
        "'.mysqli_real_escape_string($con, esc_html($page_title)).'",
        "'.mysqli_real_escape_string($con, $my_to_email).'",
        "'.mysqli_real_escape_string($con, $my_from_email).'",
        "'.mysqli_real_escape_string($con, $my_from_name).'",
        "'.mysqli_real_escape_string($con, $my_subject2).'",
        "'.mysqli_real_escape_string($con, $my_body2).'",
        "'.mysqli_real_escape_string($con, $datetimedb).'",
        "'.mysqli_real_escape_string($con, $_SERVER['HTTP_USER_AGENT']).'",
        "'.mysqli_real_escape_string($con, $_SERVER['REMOTE_ADDR']).'"
      )';
//        "'.mysqli_real_escape_string($con, rawurldecode($post->post_name)).'",
      $rst = mysqli_query($con, $sql);
      $insert_id = mysqli_affected_rows($con);
      if($rst and is_object($rst)):
        mysqli_free_result($rst);
      endif;
      mysqli_close($con);
# DBin
endif;//not pcode 123


      $mail_attach = array();
      if(!empty($_POST['attach_name0'])):
        $i = count($mail_attach);
        $mail_attach[$i]['name'] = $_POST['attach_name0'];
        $mail_attach[$i]['path'] = ABSPATH.'tmp/data/'.$_POST['attach_name0'];
        /*$img_data0 = getimagesize($mail_attach[$i]['path']);
        $img_mime0 = $img_data0['mime'];*/
        /*
        $fp = fopen($mail_attach[$i]['path'], "rb");
        $img_binary0 = fread($fp, filesize($mail_attach[$i]['path']));
        fclose($fp);*/
        /*$img_binary0 = '';
        $dir_data_copy = ABSPATH.'tmp/data/'.$_POST['attach_name0'];*/
      endif;

      if(!empty($_POST['attach_name1'])):
        $i = count($mail_attach);
        $mail_attach[$i]['name'] = $_POST['attach_name1'];
        $mail_attach[$i]['path'] = ABSPATH.'tmp/data/'.$_POST['attach_name1'];
        /*$img_data1 = getimagesize($mail_attach[$i]['path']);
        $img_mime1 = $img_data1['mime'];*/
        /*
        $fp = fopen($mail_attach[$i]['path'], "rb");
        $img_binary1 = fread($fp, filesize($mail_attach[$i]['path']));
        fclose($fp);*/
        /*$img_binary1 = '';
        $dir_data_copy1 = ABSPATH.'tmp/data/'.$_POST['attach_name1'];*/
      endif;


$my_reply_email = ($my_to_email) ? $my_to_email : $my_from_email2;
if(!isset($_GET['pcode']) or $_GET['pcode'] != '123'):
      //csnkform_send_mail_v50($my_to_email2, $my_from_email2, $my_from_name, $my_subject2, $my_body2, $encoding = 'utf-8', $mail_attach);
      csnkform_send_mail_v60($my_to_email2, $my_from_email2, $my_from_name, $my_reply_email, $my_subject2, $my_body2, $encoding = 'utf-8', $mail_attach);
else:
      //csnkform_send_mail_v60('', $my_from_email2, $my_from_name, $my_reply_email, $my_subject2, $my_body2, $encoding = 'utf-8', $mail_attach);
endif;


if(!isset($_GET['pcode']) or $_GET['pcode'] != '123'):
      if(get_option('csnkform_to_mail2') or get_option('csnkform_to_mail3') or get_option('csnkform_to_mail4') or get_option('csnkform_to_mail5') or get_option('csnkform_to_mail6') or get_option('csnkform_to_mail7') or get_option('csnkform_to_mail8')):
        $to_mail_array = array(
          'csnkform_to_mail2',
          'csnkform_to_mail3',
          'csnkform_to_mail4',
          'csnkform_to_mail5',
          'csnkform_to_mail6',
          'csnkform_to_mail7',
          'csnkform_to_mail8',
        );
      else:
        $to_mail_array = array(
          'my_contact_to_mail2',
          'my_contact_to_mail3',
          'my_contact_to_mail4',
          'my_contact_to_mail5',
          'my_contact_to_mail6',
          'my_contact_to_mail7',
          'my_contact_to_mail8',
        );
      endif;

      foreach($to_mail_array as $to_mail_one):
        if(get_option($to_mail_one) != '' and preg_match('/^.+[@]{1}.+$/i', get_option($to_mail_one))):
          //csnkform_send_mail_v50(esc_html(get_option($to_mail_one)), $my_from_email2, $my_from_name, $my_subject2, $my_body2, $encoding = 'utf-8', $mail_attach);
          csnkform_send_mail_v60(esc_html(get_option($to_mail_one)), $my_from_email2, $my_from_name, $my_reply_email, $my_subject2, $my_body2, $encoding = 'utf-8', $mail_attach);
        endif;
      endforeach;
endif;//not pcode 123


      if(!empty($_POST['attach_name0']) and preg_match('/\.(jpg|jpeg|gif|png|pdf|xlsx|docx)$/', $_POST['attach_name0'])):
        $mail_attach_img = ABSPATH.'tmp/data/'.$_POST['attach_name0'];
        $path_info = pathinfo($mail_attach_img);
        $img_extension = ($path_info['extension'] == 'jpeg') ? 'jpg' : $path_info['extension'];
        $file_path_data_copy = ABSPATH.'tmp/data_xyz/tmp'.$insert_id.'_'.$datetimestamp.'_0.'.$img_extension;
        copy($mail_attach_img, $file_path_data_copy);
      endif;

      if(!empty($_POST['attach_name1']) and preg_match('/\.(jpg|jpeg|gif|png|pdf|xlsx|docx)$/', $_POST['attach_name1'])):
        $mail_attach_img1 = ABSPATH.'tmp/data/'.$_POST['attach_name1'];
        $path_info1 = pathinfo($mail_attach_img1);
        $img_extension1 = ($path_info1['extension'] == 'jpeg') ? 'jpg' : $path_info1['extension'];
        $file_path_data_copy1 = ABSPATH.'tmp/data_xyz/tmp'.$insert_id.'_'.$datetimestamp.'_1.'.$img_extension1;
        copy($mail_attach_img1, $file_path_data_copy1);
      endif;

      if(!empty($_POST['attach_name0']) and preg_match('/\.(jpg|jpeg|gif|png|pdf|xlsx|docx)$/', $_POST['attach_name0'])):
        if(file_exists(ABSPATH.'tmp/data/'.$_POST['attach_name0'])):
          unlink(ABSPATH.'tmp/data/'.$_POST['attach_name0']);
        endif;
        $_POST['attach_name0'] = '';
        $_SESSION['attach_name0'] = '';
      endif;

      if(!empty($_POST['attach_name1']) and preg_match('/\.(jpg|jpeg|gif|png|pdf|xlsx|docx)$/',$_POST['attach_name1'])):
        if(file_exists(ABSPATH.'tmp/data/'.$_POST['attach_name1'])):
          unlink(ABSPATH.'tmp/data/'.$_POST['attach_name1']);
        endif;
        $_POST['attach_name1'] = '';
        $_SESSION['attach_name1'] = '';
      endif;


      $add_param = (isset($_GET['pcode']) and $_GET['pcode']) ? '&pcode='.esc_html(strip_tags($_GET['pcode'])) : '';
      wp_redirect($this_url.'?rst=1&posi=posiCsnkForm'.$add_param);
      exit;

    endif;//noError Submit2
  endif;//is post

else:// verify
  unset($_POST['submit1']);
  unset($_POST['submit2']);
endif;


$form_mode = '';
$add_class_h_adr = '';
if(isset($_GET['rst']) and $_GET['rst'] === '1'):
  $form_mode = 'complete';
  $form_add_class = ' modeComplete';
elseif($errmsg_array or (!isset($_POST['submit1']) or empty($_POST['submit1']))):
  $form_mode = 'input';
  if(array_key_exists('zipcode', $input_name_array) or (array_key_exists('zipcode1', $input_name_array) and array_key_exists('zipcode2', $input_name_array))):
    //$form_add_class = ' h-adr modeInput';
    $form_add_class = ' modeInput';
    $add_class_h_adr = ' h-adr';
  else:
    $form_add_class = ' modeInput';
  endif;
elseif(!$errmsg_array and $_POST['submit1']):
  $form_mode = 'confirm';
  $form_add_class = ' modeConfirm';
endif;

$mark_required = '<span class="markRequired"><span class="str2">必</span>須</span>';
//$mark_required = '<span class="markRequired">※</span>';
$mark_not_required = '<span class="markNotRequired"><span class="str2">任</span>意</span>';
//$mark_not_required = '';


?>