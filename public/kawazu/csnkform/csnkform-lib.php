<?php
function csnk_session(){
  if(session_status() !== PHP_SESSION_ACTIVE):
    session_start();
  endif;
}
add_action('init', 'csnk_session');


function csnkform_import_files(){
  if(is_page(array('contact','entry'))):
    $add_param = '?t='.time();
    //CSS
    wp_enqueue_style('style-csnkform', get_stylesheet_directory_uri().'/csnkform/css/csnkform.css'.$add_param);
    wp_enqueue_style('style-csnkformpopup', get_stylesheet_directory_uri().'/csnkform/css/csnkform-popup.css'.$add_param);

    //JS
    wp_enqueue_script('js-yubinbango', '//yubinbango.github.io/yubinbango/yubinbango.js');
    if($google_recaptcha_site_key = get_option('csnkform_google_recaptcha_site_key') and get_option('csnkform_google_recaptcha_secret_key')):
      wp_enqueue_script('js-google-recaptcha', 'https://www.google.com/recaptcha/api.js?render='.$google_recaptcha_site_key);
    endif;
    wp_enqueue_script('js-csnkform', get_stylesheet_directory_uri().'/csnkform/js/csnkform.js'.$add_param);
    //wp_enqueue_script('js-input-check', esc_url(get_stylesheet_directory_uri()).'/csnkform/js/input-check.js'.$add_param);
    wp_enqueue_script('js-csnkformpopup', get_stylesheet_directory_uri().'/csnkform/js/csnkform-popup.js'.$add_param);
  endif;
}
add_action('wp_enqueue_scripts','csnkform_import_files');


function csnkform_validate($data_name, $input_name, $validate_mode){

  $errmsg = '';

  if($input_name == 'my_name'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'お名前';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'my_name_kana'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'ふりがな';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'company_name'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '会社名';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'company_name_kana'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '会社名ふりがな';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'email'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'メールアドレス';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      elseif(!preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = $disp_name.'の入力値が不正です、'.$disp_name.'が正しいか確認してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] and !preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = $disp_name.'の入力値が不正です、'.$disp_name.'が正しいか確認してください。';
      endif;
    endif;
  endif;

  if($input_name == 'email2'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'メールアドレス(確認用)';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      elseif(!preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = $disp_name.'の入力値が不正です、'.$disp_name.'が正しいか確認してください。';
      elseif($_POST['email'] and ($_POST['email'] != $_POST[$input_name])):
        $errmsg = $disp_name.'が一致しません、'.$disp_name.'が正しいか確認してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST['email'] and !$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      elseif($_POST[$input_name] and !preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = $disp_name.'の入力値が不正です、'.$disp_name.'が正しいか確認してください。';
      elseif(($_POST['email'] and $_POST[$input_name]) and ($_POST['email'] != $_POST[$input_name])):
        $errmsg = $disp_name.'が一致しません、'.$disp_name.'が正しいか確認してください。';
      endif;
    endif;
  endif;

  if($input_name == 'telno'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '電話番号';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を入力してください。';
      elseif(!preg_match('/^[0-9\-]{10,13}$/',$_POST[$input_name])):
        $errmsg = $disp_name.'の入力値が不正です、半角数字およびハイフン(-)で入力してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] != '' and !preg_match('/^[0-9\-]{10,13}$/',$_POST[$input_name])):
        $errmsg = $disp_name.'の入力値が不正です、半角数字およびハイフン(-)で入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'faxno'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'FAX番号';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を入力してください。';
      elseif(!preg_match('/^[0-9\-]{10,13}$/',$_POST[$input_name])):
        $errmsg = $disp_name.'の入力値が不正です、半角数字およびハイフン(-)で入力してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] != '' and !preg_match('/^[0-9\-]{10,13}$/',$_POST[$input_name])):
        $errmsg = $disp_name.'の入力値が不正です、半角数字およびハイフン(-)で入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'age'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '年齢';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'zipcode'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '郵便番号';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      elseif(!preg_match('/^[0-9]{3}(\-|)[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = $disp_name.'入力値が不正です、郵便番号が正しいか確認してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] and !preg_match('/^[0-9]{3}(\-|)[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = $disp_name.'入力値が不正です、郵便番号が正しいか確認してください。';
      endif;
    endif;
  endif;

  if($input_name == 'zipcode1'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '郵便番号';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      elseif(!preg_match('/^[0-9]{3}$/',$_POST[$input_name])):
        $errmsg = $disp_name.'入力値が不正です、郵便番号が正しいか確認してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST['zipcode2'] and !$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      elseif($_POST[$input_name] and !preg_match('/^[0-9]{3}$/',$_POST[$input_name])):
        $errmsg = $disp_name.'入力値が不正です、郵便番号が正しいか確認してください。';
      endif;
    endif;
  endif;

  if($input_name == 'zipcode2'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '郵便番号';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      elseif(!preg_match('/^[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = $disp_name.'入力値が不正です、郵便番号が正しいか確認してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST['zipcode1'] and !$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      elseif($_POST[$input_name] and !preg_match('/^[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = $disp_name.'入力値が不正です、郵便番号が正しいか確認してください。';
      endif;
    endif;
  endif;

  if($input_name == 'pref'):
    global $pref_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '都道府県';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を選択してください。';
      elseif(!array_key_exists($_POST[$input_name], $pref_array)):
        $errmsg = $disp_name.'を選択してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] != '' and !array_key_exists($_POST[$input_name], $pref_array)):
        $errmsg = $disp_name.'を選択してください。';
      endif;
    endif;
  endif;

  if($input_name == 'address'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '住所';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'gender'):
    global $gender_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '性別';
    if($validate_mode == 'required'):
      if(!isset($_POST[$input_name]) or $_POST[$input_name] == ''):
        $errmsg = $disp_name.'を選択してください。';
      elseif(isset($_POST[$input_name]) and !array_key_exists($_POST[$input_name], $gender_array)):
        $errmsg = $disp_name.'を選択してください。';
      endif;
    endif;
  endif;

  if($input_name == 'birth_year'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '生年月日(年)';
    if($validate_mode == 'required'):
      if(!isset($_POST[$input_name]) or $_POST[$input_name] == ''):
        $errmsg = $disp_name.'を入力してください。';
      elseif(isset($_POST[$input_name]) and !preg_match('/^[0-9]{4}$/', $_POST[$input_name])):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if(((isset($_POST['birth_month']) and $_POST['birth_month'] != '') or (isset($_POST['birth_day']) and $_POST['birth_day'] != '')) and (!isset($_POST[$input_name]) or $_POST[$input_name] == '')):
        $errmsg = $disp_name.'を入力してください。';
      elseif(isset($_POST[$input_name]) and $_POST[$input_name] != '' and !preg_match('/^[0-9]{4}$/', $_POST[$input_name])):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'birth_month'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '生年月日(月)';
    if($validate_mode == 'required'):
      if(!isset($_POST[$input_name]) or $_POST[$input_name] == ''):
        $errmsg = $disp_name.'を入力してください。';
      elseif(isset($_POST[$input_name]) and !preg_match('/^[0-9]{1,2}$/', $_POST[$input_name])):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if(((isset($_POST['birth_year']) and $_POST['birth_year'] != '') or (isset($_POST['birth_day']) and $_POST['birth_day'] != '')) and (!isset($_POST[$input_name]) or $_POST[$input_name] == '')):
        $errmsg = $disp_name.'を入力してください。';
      elseif(isset($_POST[$input_name]) and $_POST[$input_name] != '' and !preg_match('/^[0-9]{1,2}$/', $_POST[$input_name])):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'birth_day'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '生年月日(日)';
    if($validate_mode == 'required'):
      if(!isset($_POST[$input_name]) or $_POST[$input_name] == ''):
        $errmsg = $disp_name.'を入力してください。';
      elseif(isset($_POST[$input_name]) and !preg_match('/^[0-9]{1,2}$/', $_POST[$input_name])):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if(((isset($_POST['birth_year']) and $_POST['birth_year'] != '') or (isset($_POST['birth_month']) and $_POST['birth_month'] != '')) and $_POST[$input_name] == ''):
        $errmsg = $disp_name.'を入力してください。';
      elseif(isset($_POST[$input_name]) and $_POST[$input_name] != '' and !preg_match('/^[0-9]{1,2}$/', $_POST[$input_name])):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_text'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'テキスト入力項目';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_text2'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'テキスト入力項目2';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_text3'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'テキスト入力項目3';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_date'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '日付';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_date2'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '日付2';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_date3'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '日付3';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_select'):
    //global $cont_select_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '選択肢';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を選択してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_select2'):
    //global $cont_select2_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '選択肢2';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を選択してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_select3'):
    //global $cont_select3_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '選択肢3';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を選択してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_radio'):
    //global $cont_radio_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '選択肢';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を選択してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_radio2'):
    //global $cont_radio2_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '選択肢2';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を選択してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_radio3'):
    //global $cont_radio3_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : '選択肢3';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = $disp_name.'を選択してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_checkbox'):
    global $cont_checkbox_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'お問い合わせ項目';
    if($validate_mode == 'required'):
      if(!isset($_POST[$input_name]) or !$_POST[$input_name] or !is_array($_POST[$input_name])):
        $errmsg = $disp_name.'を選択してください。';
      elseif(isset($_POST[$input_name]) and $_POST[$input_name] and is_array($_POST[$input_name])):
        $value_check = 0;
        foreach($_POST[$input_name] as $value):
          if(!array_key_exists($value, $cont_checkbox_array)):
            $value_check = 1;
            break;
          endif;
        endforeach;
        if($value_check === 1):
          $errmsg = $disp_name.'を選択してください。 (ErrCode:0)';
        endif;
      endif;
    else:
      if(isset($_POST[$input_name]) and $_POST[$input_name] and is_array($_POST[$input_name])):
        $value_check = 0;
        foreach($_POST[$input_name] as $value):
          if(!array_key_exists($value, $cont_checkbox_array)):
            $value_check = 1;
            break;
          endif;
        endforeach;
        if($value_check === 1):
          $errmsg = $disp_name.'を選択してください。 (ErrCode:0)';
        endif;
      endif;
    endif;
  endif;

  if($input_name == 'cont_checkbox2'):
    global $cont_checkbox2_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'お問い合わせ項目2';
    if($validate_mode == 'required'):
      if(!isset($_POST[$input_name]) or !$_POST[$input_name] or !is_array($_POST[$input_name])):
        $errmsg = $disp_name.'を選択してください。';
      elseif(isset($_POST[$input_name]) and $_POST[$input_name] and is_array($_POST[$input_name])):
        $value_check = 0;
        foreach($_POST[$input_name] as $value):
          if(!array_key_exists($value, $cont_checkbox2_array)):
            $value_check = 1;
            break;
          endif;
        endforeach;
        if($value_check === 1):
          $errmsg = $disp_name.'を選択してください。 (ErrCode:0)';
        endif;
      endif;
    else:
      if(isset($_POST[$input_name]) and $_POST[$input_name] and is_array($_POST[$input_name])):
        $value_check = 0;
        foreach($_POST[$input_name] as $value):
          if(!array_key_exists($value, $cont_checkbox2_array)):
            $value_check = 1;
            break;
          endif;
        endforeach;
        if($value_check === 1):
          $errmsg = $disp_name.'を選択してください。 (ErrCode:0)';
        endif;
      endif;
    endif;
  endif;

  if($input_name == 'cont_checkbox3'):
    global $cont_checkbox3_array;
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'お問い合わせ項目3';
    if($validate_mode == 'required'):
      if(!isset($_POST[$input_name]) or !$_POST[$input_name] or !is_array($_POST[$input_name])):
        $errmsg = $disp_name.'を選択してください。';
      elseif(isset($_POST[$input_name]) and $_POST[$input_name] and is_array($_POST[$input_name])):
        $value_check = 0;
        foreach($_POST[$input_name] as $value):
          if(!array_key_exists($value, $cont_checkbox3_array)):
            $value_check = 1;
            break;
          endif;
        endforeach;
        if($value_check === 1):
          $errmsg = $disp_name.'を選択してください。 (ErrCode:0)';
        endif;
      endif;
    else:
      if(isset($_POST[$input_name]) and $_POST[$input_name] and is_array($_POST[$input_name])):
        $value_check = 0;
        foreach($_POST[$input_name] as $value):
          if(!array_key_exists($value, $cont_checkbox3_array)):
            $value_check = 1;
            break;
          endif;
        endforeach;
        if($value_check === 1):
          $errmsg = $disp_name.'を選択してください。 (ErrCode:0)';
        endif;
      endif;
    endif;
  endif;

  if($input_name == 'cont_select_date'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'ご予約日';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont_select_time'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'ご希望時間';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'cont'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'お問い合わせ内容';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = $disp_name.'を入力してください。';
      endif;
    endif;
  endif;

  if($input_name == 'check_privacy_p'):
    $disp_name = ($data_name != '') ? csnkform_strip_code($data_name) : 'プライバシーポリシー';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        //$errmsg = '「'.esc_html(get_option('my_company_name')).'の'.$disp_name.'に同意する。」にチェックを入れてください。';
        $errmsg = '「'.csnkform_strip_code($disp_name).'」に同意するにチェックを入れてください。';
      endif;
    endif;
  endif;


  if(isset($errmsg)):
    return $errmsg;
  endif;

}//form_validate


function csnkform_validate_text($data_name, $input_name, $validate_mode){

  $disp_name = csnkform_strip_code($data_name);

  $errmsg = '';

  if($validate_mode == 'required'):
    if(!isset($_POST[$input_name]) or $_POST[$input_name] == ''):
      $errmsg = $disp_name.'を入力してください。';
    endif;
  endif;

  if(isset($errmsg) and $errmsg):
    return $errmsg;
  endif;

}//csnkform_validate_text


function csnkform_validate_textarea($data_name, $input_name, $validate_mode){

  $disp_name = csnkform_strip_code($data_name);

  $errmsg = '';

  if($validate_mode == 'required'):
    if(!isset($_POST[$input_name]) or $_POST[$input_name] == ''):
      $errmsg = $disp_name.'を入力してください。';
    endif;
  endif;

  if(isset($errmsg) and $errmsg):
    return $errmsg;
  endif;

}//csnkform_validate_textarea



function csnkform_validate_en($data_name, $input_name, $validate_mode){

  $errmsg = '';

  if($input_name == 'my_name'):
    $disp_name = ($data_name != '') ? $data_name : 'name';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'my_name_kana'):
    $disp_name = ($data_name != '') ? $data_name : 'phonetic';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'email'):
    $disp_name = ($data_name != '') ? $data_name : 'email address';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = 'The address is not in the proper format.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] and !preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = 'The address is not in the proper format.';
      endif;
    endif;
  endif;

  if($input_name == 'email2'):
    $disp_name = ($data_name != '') ? $data_name : 'email address (Double-check for tyops)';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      elseif($_POST['email'] and ($_POST['email'] != $_POST[$input_name])):
        $errmsg = 'Double-check for tyops '.mb_strtolower($disp_name).' does not match.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST['email'] and !$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif($_POST[$input_name] and !preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      elseif(($_POST['email'] and $_POST[$input_name]) and ($_POST['email'] != $_POST[$input_name])):
        $errmsg = 'Double-check for tyops. '.mb_strtolower($disp_name).' does not match.';
      endif;
    endif;
  endif;

  if($input_name == 'telno'):
    $disp_name = ($data_name != '') ? $data_name : 'telephone number';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9\-]{10,13}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] and !preg_match('/^[0-9\-]{10,13}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'age'):
    $disp_name = ($data_name != '') ? $data_name : 'age';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'zipcode'):
    $disp_name = ($data_name != '') ? $data_name : 'postal code';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{3}(\-|)[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] and !preg_match('/^[0-9]{3}(\-|)[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'zipcode1'):
    $disp_name = ($data_name != '') ? $data_name : 'postal code';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{3}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST['zipcode2'] and !$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif($_POST[$input_name] and !preg_match('/^[0-9]{3}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'zipcode2'):
    $disp_name = ($data_name != '') ? $data_name : 'postal code';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST['zipcode1'] and !$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif($_POST[$input_name] and !preg_match('/^[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'pref'):
    global $pref_array;
    $disp_name = ($data_name != '') ? $data_name : 'prefectures';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!array_key_exists($_POST[$input_name], $pref_array)):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] != '' and !array_key_exists($_POST[$input_name], $pref_array)):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'address'):
    $disp_name = ($data_name != '') ? $data_name : 'address';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'gender'):
    global $gender_array;
    $disp_name = ($data_name != '') ? $data_name : 'gender';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!array_key_exists($_POST[$input_name], $gender_array)):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'birth_year'):
    $disp_name = ($data_name != '') ? $data_name : '生年月日(年)';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if(($_POST['birth_month'] != '' or $_POST['birth_day'] != '') and $_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'birth_month'):
    $disp_name = ($data_name != '') ? $data_name : '生年月日(月)';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{1,2}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if(($_POST['birth_year'] != '' or $_POST['birth_day'] != '') and $_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{1,2}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'birth_day'):
    $disp_name = ($data_name != '') ? $data_name : '生年月日(日)';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{1,2}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if(($_POST['birth_year'] != '' or $_POST['birth_month'] != '') and $_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{1,2}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'cont_select'):
    global $cont_select_array;
    if(!is_array($_POST[$input_name])):
      $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
    elseif($_POST[$input_name]):
      if(is_array($_POST[$input_name])):
        $value_check = 0;
        foreach($_POST[$input_name] as $value):
          if(!array_key_exists($value, $cont_select_array)):
            $value_check = 1;
            break;
          endif;
        endforeach;
        if($value_check === 1):
          $errmsg = 'Please select your '.mb_strtolower($disp_name).'. (ErrCode:0)';
        endif;
      endif;
    endif;
  endif;

  if($input_name == 'cont_select_date'):
    $disp_name = ($data_name != '') ? $data_name : 'ご予約日';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'cont_select_time'):
    $disp_name = ($data_name != '') ? $data_name : 'ご希望時間';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'cont'):
    $disp_name = ($data_name != '') ? $data_name : 'お問い合わせ内容';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      endif;
    endif;
  endif;

  if($input_name == 'check_privacy_p'):
    $disp_name = ($data_name != '') ? $data_name : 'privacy policy';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        //$errmsg = '「'.esc_html(get_option('my_company_name')).'の'.mb_strtolower($disp_name).'に同意する。」にチェックを入れてください。';
        $errmsg = 'Please check this box to accept our '.csnkform_strip_code($disp_name).'.';
      endif;
    endif;
  endif;



  return $errmsg;

}//form_validate_en



function csnkform_validate_en_simple($data_name, $input_name, $validate_mode){

  $errmsg = '';

  if($input_name == 'my_name'):
    $disp_name = ($data_name != '') ? $data_name : 'name';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      endif;
    endif;
  endif;

  if($input_name == 'my_name_kana'):
    $disp_name = ($data_name != '') ? $data_name : 'phonetic';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      endif;
    endif;
  endif;

  if($input_name == 'email'):
    $disp_name = ($data_name != '') ? $data_name : 'email address';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      elseif(!preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = 'The address is not in the proper format.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] and !preg_match('/^.+[@]{1}.+$/i',$_POST[$input_name])):
        $errmsg = 'The address is not in the proper format.';
      endif;
    endif;
  endif;

  if($input_name == 'email2'):
    $disp_name = ($data_name != '') ? $data_name : 'email address (Double-check for tyops)';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      elseif(!preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
        $errmsg = 'The Email Address is not in the proper format.';
      elseif($_POST['email'] and ($_POST['email'] != $_POST[$input_name])):
        $errmsg = 'Double-check for tyops '.mb_strtolower($disp_name).' does not match.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST['email'] and !$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      elseif($_POST[$input_name] and !preg_match('/^[^@]+[@]{1}[^@]+$/i',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
        $errmsg = 'The Email Address is not in the proper format.';
      elseif(($_POST['email'] and $_POST[$input_name]) and ($_POST['email'] != $_POST[$input_name])):
        $errmsg = 'Double-check for tyops. '.mb_strtolower($disp_name).' does not match.';
      endif;
    endif;
  endif;

  if($input_name == 'telno'):
    $disp_name = ($data_name != '') ? $data_name : 'telephone number';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      elseif(!preg_match('/^[0-9\-]{10,13}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
        $errmsg = 'The telephone number is not in the proper format.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] and !preg_match('/^[0-9\-]{10,13}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
        $errmsg = 'The telephone number is not in the proper format.';
      endif;
    endif;
  endif;

  if($input_name == 'age'):
    $disp_name = ($data_name != '') ? $data_name : 'age';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      endif;
    endif;
  endif;

  if($input_name == 'zipcode'):
    $disp_name = ($data_name != '') ? $data_name : 'postal code';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      elseif(!preg_match('/^[0-9]{3}(\-|)[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
        $errmsg = 'The postal code is not in the proper format.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] and !preg_match('/^[0-9]{3}(\-|)[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
        $errmsg = 'The postal code is not in the proper format.';
      endif;
    endif;
  endif;

  if($input_name == 'zipcode1'):
    $disp_name = ($data_name != '') ? $data_name : 'postal code';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{3}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST['zipcode2'] and !$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif($_POST[$input_name] and !preg_match('/^[0-9]{3}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'zipcode2'):
    $disp_name = ($data_name != '') ? $data_name : 'postal code';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST['zipcode1'] and !$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
      elseif($_POST[$input_name] and !preg_match('/^[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please enter a valid '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'pref'):
    global $pref_array;
    $disp_name = ($data_name != '') ? $data_name : 'prefectures';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!array_key_exists($_POST[$input_name], $pref_array)):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if($_POST[$input_name] != '' and !array_key_exists($_POST[$input_name], $pref_array)):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'address'):
    $disp_name = ($data_name != '') ? $data_name : 'address';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      endif;
    endif;
  endif;

  if($input_name == 'gender'):
    global $gender_array;
    $disp_name = ($data_name != '') ? $data_name : 'gender';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!array_key_exists($_POST[$input_name], $gender_array)):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'birth_year'):
    $disp_name = ($data_name != '') ? $data_name : '生年月日(年)';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if(($_POST['birth_month'] != '' or $_POST['birth_day'] != '') and $_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{4}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'birth_month'):
    $disp_name = ($data_name != '') ? $data_name : '生年月日(月)';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{1,2}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if(($_POST['birth_year'] != '' or $_POST['birth_day'] != '') and $_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{1,2}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'birth_day'):
    $disp_name = ($data_name != '') ? $data_name : '生年月日(日)';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{1,2}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
    if($validate_mode == 'notRequired'):
      if(($_POST['birth_year'] != '' or $_POST['birth_month'] != '') and $_POST[$input_name] == ''):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      elseif(!preg_match('/^[0-9]{1,2}$/',$_POST[$input_name])):
        $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
      endif;
    endif;
  endif;

  if($input_name == 'cont_select'):
    global $cont_select_array;
    if(!is_array($_POST[$input_name])):
      $errmsg = 'Please select your '.mb_strtolower($disp_name).'.';
    elseif($_POST[$input_name]):
      if(is_array($_POST[$input_name])):
        $value_check = 0;
        foreach($_POST[$input_name] as $value):
          if(!array_key_exists($value, $cont_select_array)):
            $value_check = 1;
            break;
          endif;
        endforeach;
        if($value_check === 1):
          $errmsg = 'Please select your '.mb_strtolower($disp_name).'. (ErrCode:0)';
        endif;
      endif;
    endif;
  endif;

  if($input_name == 'cont_select_date'):
    $disp_name = ($data_name != '') ? $data_name : 'ご予約日';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      endif;
    endif;
  endif;

  if($input_name == 'cont_select_time'):
    $disp_name = ($data_name != '') ? $data_name : 'ご希望時間';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      endif;
    endif;
  endif;

  if($input_name == 'cont'):
    $disp_name = ($data_name != '') ? $data_name : 'お問い合わせ内容';
    if($validate_mode == 'required'):
      if(!$_POST[$input_name]):
        $errmsg = 'Please enter your '.mb_strtolower($disp_name).'.';
        $errmsg = 'This field is required.';
      endif;
    endif;
  endif;

  if($input_name == 'check_privacy_p'):
    $disp_name = ($data_name != '') ? $data_name : 'privacy policy';
    if($validate_mode == 'required'):
      if($_POST[$input_name] == ''):
        //$errmsg = '「'.esc_html(get_option('my_company_name')).'の'.mb_strtolower($disp_name).'に同意する。」にチェックを入れてください。';
        $errmsg = 'Please check this box to accept our privacy policy.';
      endif;
    endif;
  endif;



  return $errmsg;

}//form_validate_en_simple




function csnkform_code_to_tag($str) {
  $str = preg_replace('/\#br\#/us', '<br>', $str);
  $str = preg_replace('/\#brSp\#/us', '<br class="dSpInline">', $str);
  $str = preg_replace('/\#brPc\#/us', '<br class="dPcInline">', $str);
  $str = preg_replace('/\#\/p\#/us', '</p>', $str);
  $str = preg_replace('/\#p\#/us', '<p>', $str);
  $str = preg_replace('/\#\/b\#/us', '</span>', $str);
  $str = preg_replace('/\#b\#/us', '<span class="fontB">', $str);
  $str = preg_replace('/\#\/small\#/us', '</span>', $str);
  $str = preg_replace('/\#small\#/us', '<span class="small">', $str);
  $str = preg_replace('/\#\/short\#/us', '</span>', $str);
  $str = preg_replace('/\#short\#/us', '<span class="short">', $str);
  $str = preg_replace('/\#sp\#/us', '&nbsp;', $str);
  $str = preg_replace('/\#c\#/us', '<span class="markCopy">&copy;</span>', $str);
  $str = preg_replace('/\#year\#/us', date('Y'), $str);
  return $str;
}



function csnkform_strip_code($str) {
  $str = preg_replace('/\#br\#/us', '', $str);
  $str = preg_replace('/\#brSp\#/us', '', $str);
  $str = preg_replace('/\#brPc\#/us', '', $str);
  $str = preg_replace('/\#\/p\#/us', '', $str);
  $str = preg_replace('/\#p\#/us', '', $str);
  $str = preg_replace('/\#\/b\#/us', '', $str);
  $str = preg_replace('/\#b\#/us', '', $str);
  $str = preg_replace('/\#\/small\#/us', '', $str);
  $str = preg_replace('/\#small\#/us', '', $str);
  $str = preg_replace('/\#\/short\#/us', '', $str);
  $str = preg_replace('/\#short\#/us', '', $str);
  $str = preg_replace('/\#sp\#/us', '', $str);
  $str = preg_replace('/\#c\#/us', '', $str);
  $str = preg_replace('/\#year\#/us', '', $str);
  return $str;
}


function csnkform_send_mail_v50($to,$from,$from_name,$subject,$body,$encoding,$attach){

  if(!preg_match('/^.+@.+$/',$to) or !preg_match('/^.+@.+$/',$from)):
    return false;
  endif;

  $from_name = mb_convert_encoding($from_name, 'ISO-2022-JP-ms', 'UTF-8');
  $subject = mb_convert_encoding($subject, 'ISO-2022-JP-ms', 'UTF-8');
  $body = mb_convert_encoding($body, 'ISO-2022-JP-ms', 'UTF-8');

  mb_language("Japanese");
  mb_internal_encoding("JIS");
  mb_detect_order("ASCII,JIS,UTF-8,EUC-JP,SJIS");

  $boundary = '---=_'.uniqid('Boundary').'_'.uniqid('Next');

  ### サブジェクトを jis にして、MIME エンコード
  $subject = mb_encode_mimeheader( mb_convert_encoding($subject,"JIS",$encoding),"JIS" );
  $from_name = mb_encode_mimeheader( mb_convert_encoding($from_name,"JIS",$encoding),"JIS" );

  ### 本文を jis に
  $body = mb_convert_encoding($body,"JIS",$encoding);

  ### メールの送信
  $mp = popen("/usr/sbin/sendmail -f $from $to", "w");
  ## メールヘッダ
  fputs($mp, "MIME-Version: 1.0\n");
  //fputs($mp, "Comments: System sent this mail\n");
  ## 添付ファイルがある場合に追加するヘッダ(複数パートからなるメールを送信する)
  fputs($mp, "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\n");
  fputs($mp, "Content-Transfer-Encoding: Base64\n");
  fputs($mp, "From: $from_name<$from>\n");
  fputs($mp, "To: $to\n");
  fputs($mp, "Subject: $subject\n");

  ## メール本文
  fputs($mp, "--".$boundary."\n");
  fputs($mp, "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n");
  fputs($mp, "Content-Transfer-Encoding: 7bit\n");
  fputs($mp, "\n");
  fputs($mp, "$body\n");
  //fputs($mp, "\n");

  ## 添付
  $attach_body = NULL;
if($attach and is_array($attach)):
  //print_r($attach);
  //exit;
  for($i=0; $i<count($attach); $i++):
    if(file_exists($attach[$i]['path']) && is_readable($attach[$i]['path'])):
      $fp = fopen($attach[$i]['path'],'r');
      $buf = fread($fp,filesize($attach[$i]['path']));
      fclose($fp);
      ## 添付ファイルの中身をBASE64でエンコードし、適切に分割する
      $attach_bin = chunk_split(base64_encode($buf));
      ## 添付ファイルを本文に追加
      fputs($mp, "--".$boundary."\n");
      fputs($mp, "Content-Type: application/octet-stream;name=\"{$attach[$i]['name']}\"\n");
      fputs($mp, "Content-Transfer-Encoding: Base64\n");
      fputs($mp, "Content-Disposition: attachment; filename*=ISO-2922-JP'ja'{$attach[$i]['name']}\n");
      //fputs($mp, "Content-Disposition: attachment; filename=\"{$attach[$i]['name']}\"\n");
      fputs($mp, "\n");
      fputs($mp, $attach_bin."\n");
      fputs($mp, "\n");
    endif;
  endfor;
endif;

  fputs($mp, "--".$boundary."--\n");

  ## 終了
  pclose($mp);

  return 1;

}// csnkform_send_mail_v50


function csnkform_send_mail_v60($to, $from, $from_name, $reply, $subject, $body, $encoding, $attach){

  if(!preg_match('/^.+@.+$/', $to) or !preg_match('/^.+@.+$/', $from) or !preg_match('/^.+@.+$/', $reply)):
    return false;
  endif;

  $from_name = mb_convert_encoding($from_name, 'ISO-2022-JP-ms', 'UTF-8');
  $subject = mb_convert_encoding($subject, 'ISO-2022-JP-ms', 'UTF-8');
  $body = mb_convert_encoding($body, 'ISO-2022-JP-ms', 'UTF-8');

  mb_language("Japanese");
  mb_internal_encoding("JIS");
  mb_detect_order("ASCII,JIS,UTF-8,EUC-JP,SJIS");

  $boundary = '---=_'.uniqid('Boundary').'_'.uniqid('Next');

  ### サブジェクトを jis にして、MIME エンコード
  $subject = mb_encode_mimeheader( mb_convert_encoding($subject, "JIS", $encoding), "JIS" );
  $from_name = mb_encode_mimeheader( mb_convert_encoding($from_name, "JIS", $encoding), "JIS" );

  ### 本文を jis に
  $body = mb_convert_encoding($body, "JIS", $encoding);

  ### メールの送信
  $mp = popen("/usr/sbin/sendmail -f $from $to", "w");
  ## メールヘッダ
  fputs($mp, "MIME-Version: 1.0\n");
  //fputs($mp, "Comments: System sent this mail\n");
  ## 添付ファイルがある場合に追加するヘッダ(複数パートからなるメールを送信する)
  fputs($mp, "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\n");
  fputs($mp, "Content-Transfer-Encoding: Base64\n");
  fputs($mp, "From: $from_name<$from>\n");
  fputs($mp, "To: $to\n");
  fputs($mp, "Reply-To: $reply\n");
  fputs($mp, "Subject: $subject\n");

  ## メール本文
  fputs($mp, "--".$boundary."\n");
  fputs($mp, "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n");
  fputs($mp, "Content-Transfer-Encoding: 7bit\n");
  fputs($mp, "\n");
  fputs($mp, "$body\n");
  //fputs($mp, "\n");

  ## 添付
  $attach_body = NULL;
if($attach and is_array($attach)):
  //print_r($attach);
  //exit;
  for($i=0; $i<count($attach); $i++):
    if(file_exists($attach[$i]['path']) && is_readable($attach[$i]['path'])):
      $fp = fopen($attach[$i]['path'],'r');
      $buf = fread($fp,filesize($attach[$i]['path']));
      fclose($fp);
      ## 添付ファイルの中身をBASE64でエンコードし、適切に分割する
      $attach_bin = chunk_split(base64_encode($buf));
      ## 添付ファイルを本文に追加
      fputs($mp, "--".$boundary."\n");
      fputs($mp, "Content-Type: application/octet-stream;name=\"{$attach[$i]['name']}\"\n");
      fputs($mp, "Content-Transfer-Encoding: Base64\n");
      fputs($mp, "Content-Disposition: attachment; filename*=ISO-2922-JP'ja'{$attach[$i]['name']}\n");
      //fputs($mp, "Content-Disposition: attachment; filename=\"{$attach[$i]['name']}\"\n");
      fputs($mp, "\n");
      fputs($mp, $attach_bin."\n");
      fputs($mp, "\n");
    endif;
  endfor;
endif;

  fputs($mp, "--".$boundary."--\n");

  ## 終了
  pclose($mp);

  return 1;

}// csnkform_send_mail_v60


function csnk_image_resize_disp($default_image,$max_width,$max_height){

  if($default_image == '' or !preg_match("/\/[0-9a-zA-Z\-\_]+\.(gif|jpg|png)$/",$default_image)):
    return FALSE;
  elseif($max_width == '' or !preg_match("/^[0-9]+$/",$max_width)):
    return FALSE;
  elseif($max_height == '' or !preg_match("/^[0-9]+$/",$max_height)):
    return FALSE;
  endif;

  $image_size = @getimagesize($default_image);

  @$check_w = $image_size[0] / $max_width;
  @$check_h = $image_size[1] / $max_height;

  if($check_w >= 1 and $check_h >= 1):
    if($image_size[0] > $image_size[1]):
      $resize_w = $max_width;
      $resize_h = ($image_size[1] * $max_width) / $image_size[0];
    else:
      $resize_w = ($image_size[0] * $max_height) / $image_size[1];
      $resize_h = $max_height;
    endif;
  elseif($check_w >= 1 and $check_h < 1):
    $resize_w = $max_width;
    $resize_h = ($image_size[1] * $max_width) / $image_size[0];
  elseif($check_w < 1 and $check_h >= 1):
    $resize_w = ($image_size[0] * $max_height) / $image_size[1];
    $resize_h = $max_height;
  elseif($check_w < 1 and $check_h < 1):
    $resize_w = $image_size[0];
    $resize_h = $image_size[1];
  endif;

  switch($image_size[2]){

    case "1"://GIF
      $new_image_id = imagecreatetruecolor($resize_w,$resize_h);
      $default_image_id = imagecreatefromgif($default_image);
      @imagecopyresampled($new_image_id,$default_image_id,0,0,0,0,$resize_w,$resize_h,$image_size[0],$image_size[1]);
      header("Content-Type: image/gif");
      $rst = @imagegif($new_image_id);
      @imagedestroy($new_image_id);
      @imagedestroy($default_image_id);
      break;

    case "2"://JPEG
      $new_image_id = imagecreatetruecolor($resize_w,$resize_h);
      $default_image_id = imagecreatefromjpeg($default_image);
      @imagecopyresampled($new_image_id,$default_image_id,0,0,0,0,$resize_w,$resize_h,$image_size[0],$image_size[1]);
      //imagefilter($new_image_id,IMG_FILTER_CONTRAST,-20);
      imagefilter($new_image_id,IMG_FILTER_SMOOTH,-100);
      header("Content-Type: image/jpeg");
      $rst = @imagejpeg($new_image_id,NULL,100);
      @imagedestroy($new_image_id);
      @imagedestroy($default_image_id);
      break;

    case "3"://PNG
      $new_image_id = imagecreatetruecolor($resize_w,$resize_h);
      $default_image_id = imagecreatefrompng($default_image);
      @imagecopyresampled($new_image_id,$default_image_id,0,0,0,0,$resize_w,$resize_h,$image_size[0],$image_size[1]);
      header("Content-Type: image/png");
      $rst = @imagepng($new_image_id);
      @imagedestroy($new_image_id);
      @imagedestroy($default_image_id);
      break;

  }//switch

  if($rst == '1'):
    return TRUE;
  else:
    return FALSE;
  endif;

}## func csnk_image_resize_disp
?>