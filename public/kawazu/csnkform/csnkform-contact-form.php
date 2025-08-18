<div class="boxCsnkFormWrap" id="posiCsnkForm">
  <div class="boxCsnkForm">

<?php if($form_mode != 'complete'): ?>
<?php /*
    <div class="boxCsnkFormTop">
      <ul class="ulCsnkFormTop">
        <li>下欄に入力後「入力内容を確認する」をクリックしてください。</li>
        <li>「<span class="cBaseRed">必須</span>」マークが付いているものは、必ず入力をお願いいたします。また、半角カタカナは使用しないでください。</li>
        <li>メールアドレス・電話番号等は、お間違えの無いようお願いいたします。</li>
        <li>フォームからのお問い合わせは、お返事にお時間を頂戴することがございます、ご了承ください。</li>
      </ul>
    </div><!--/.boxCsnkFormTop-->
*/ ?>
<?php endif; ?>


<?php if($form_mode != 'complete'): ?>

<?php   $add_param = (isset($_GET['pcode']) && $_GET['pcode'] == '123') ? '?pcode=123' : ''; ?>
    <form method="post" action="<?php echo $add_param; ?>#posiCsnkForm" enctype="multipart/form-data" class="csnkForm<?php echo $form_add_class; ?>" id="csnkForm">
      <span class="p-country-name" style="display:none;">Japan</span>

<?php   if($google_recaptcha_site_key = get_option('csnkform_google_recaptcha_site_key') and get_option('csnkform_google_recaptcha_secret_key')): ?>
      <div class="boxCsnkFormGoogleRCT" style="display: none;">
        <span class="txtSiteKey"><?php echo esc_html($google_recaptcha_site_key); ?></span>
      </div><!--/.boxCsnkFormGoogleRCT-->
<?php   endif; ?>

<?php //print_r($errmsg_array); ?>



<?php   $input_name = 'my_name'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = '例) 山田 太郎'; ?>
<?php     $caution = '<span class="txtCaution"></span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm dlMyName">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
            <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'my_name_kana'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = '例) やまだ たろう'; ?>
<?php     //$caution = '<span class="txtCaution"></span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'company_name'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = '例) 株式会社サンプル'; ?>
<?php     //$caution = '<span class="txtCaution">(全角)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'company_name_kana'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = '例) カブシキガイシャ サンプル'; ?>
<?php     //$caution = '<span class="txtCaution"></span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'gender'; ?>
<?php   $radio_array = $gender_array; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = '<span class="txtCaution"></span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <div class="boxRadioWrap">
<?php       if(is_array($radio_array)): ?>
                <ul class="ulRadio">
<?php         foreach($radio_array as $key => $value): ?>
<?php           $checked = (isset($_POST[$input_name]) and $_POST[$input_name] != '' and $_POST[$input_name] == $key) ? ' checked' : ''; ?>
                  <li><label><input type="radio" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($key); ?>"<?php echo esc_html($checked); ?>><span><?php echo esc_html($value); ?></span></label></li>
<?php         endforeach; ?>
                </ul>
<?php       endif; ?>
              </div><!--/.boxRadioWrap-->
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($radio_array[$_POST[$input_name]]); ?></span>
            <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'email'; ?>
<?php   $input_name2 = 'email2'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = '例) sample@sample.jp'; ?>
<?php     //$caution = '<span class="txtCaution">(半角英数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="email" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
<?php       if(array_key_exists($input_name2, $input_name_array)): ?>
<?php         $place_holder2 = '確認用'; ?>
              <input type="email" name="<?php echo esc_attr($input_name2); ?>" value="<?php if(isset($_POST[$input_name2])) echo esc_attr($_POST[$input_name2]); ?>" placeholder="<?php echo esc_attr($place_holder2); ?>">
<?php       endif; ?>
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php       if(array_key_exists($input_name2, $input_name_array)): ?>
          <input type="hidden" name="<?php echo esc_attr($input_name2); ?>" value="<?php echo esc_attr($_POST[$input_name2]); ?>">
<?php       endif; ?>
<?php     endif; ?>
<?php     if((isset($errmsg_array[$input_name]) and $errmsg_array[$input_name]) or (isset($errmsg_array[$input_name2]) and $errmsg_array[$input_name2])): ?>
          <div class="boxError">
<?php       if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name]): ?>
            <span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span>
<?php       endif; ?>
<?php       if(isset($errmsg_array[$input_name2]) and $errmsg_array[$input_name2]): ?>
            <span class="txtError"><?php echo esc_html($errmsg_array[$input_name2]); ?></span>
<?php       endif; ?>
          </div>
<?php     endif; ?>
        </dd>
      </dl>
<?php   endif; ?>



<div class="boxCsnkFormAddress<?php echo $add_class_h_adr; ?>">
      <span class="p-country-name" style="display:none;">Japan</span>
<?php   if(isset($csnkform_setting_array['address_mode']) and $csnkform_setting_array['address_mode'] == 'one'): ?>
<?php     $input_name = 'zipcode';
          $input_name2 = 'pref';
          $input_name3 = 'address';
          $select_array = $pref_array;
          if(array_key_exists($input_name, $input_name_array) and array_key_exists($input_name2, $input_name_array) and array_key_exists($input_name3, $input_name_array)):
            $place_holder = (get_option('my_company_zipcode') != '') ? '例) '.get_option('my_company_zipcode') : '';
            $place_holder2 = '';
            $place_holder3 = (get_option('my_company_address') != '') ? '例) '.get_option('my_company_address') : '';
            //$caution = '<span class="txtCaution">(半角数字)</span>';
            //$caution2 = '<span class="txtCaution">(半角数字)</span>';
            //$caution3 = '<span class="txtCaution">(半角数字)</span>';
            $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required;
            $required2 = (in_array($input_name2, $required_name_array)) ? $mark_required : $mark_not_required;
            $required3 = (in_array($input_name3, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm dlZipcode">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name3])); ?><?php echo $required3; ?></span></dt>
        <dd>
<?php       if($form_mode == 'input'): ?>
          <div class="boxInputWrap typeAddressOne addMb">
            <span class="txtZipcodeMark">〒 </span>
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>" class="p-postal-code">
            </div><!--/.boxInput-->
<?php         echo $caution; ?>
          </div><!--/.boxInputWrap-->
<?php         if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError typeAddressOne"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
          <div class="boxInputWrap typeAddressOne addMb">
            <div class="boxInput">
              <select name="pref" class="p-region-id">
                <option value="">選択してください</option>
<?php         if($select_array and is_array($select_array)):
                foreach($select_array as $key => $value): ?>
<?php             $selected = (isset($_POST[$input_name2]) and $_POST[$input_name2] == $key) ? ' selected' : ''; ?>
                <option value="<?php echo esc_attr($key); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($value); ?></option>
<?php           endforeach;
              endif; ?>
              </select>
            </div><!--/.boxInput-->
<?php         echo $caution2; ?>
          </div><!--/.boxInputWrap-->
<?php         if($errmsg_array[$input_name2] != ''): ?><div class="boxError"><span class="txtError typeAddressOne"><?php echo esc_html($errmsg_array[$input_name2]); ?></span></div><?php endif; ?>
          <div class="boxInputWrap typeAddressOne">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name3); ?>" value="<?php echo esc_attr($_POST[$input_name3]); ?>" placeholder="<?php echo esc_attr($place_holder3); ?>" class="p-locality p-street-address p-extended-address">
              <?php /*<input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>" class="p-region p-locality p-street-address p-extended-address">*/ ?>
            </div><!--/.boxInput-->
<?php         echo $caution3; ?>
          </div><!--/.boxInputWrap-->
<?php       elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if($_POST[$input_name] != ''): ?>〒<?php endif; ?><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
          <span class="txtFormInput"><?php echo esc_html($select_array[$_POST[$input_name2]]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name2); ?>" value="<?php echo esc_attr($_POST[$input_name2]); ?>">
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name3]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name3); ?>" value="<?php echo esc_attr($_POST[$input_name3]); ?>">
<?php       endif; ?>
<?php       if($errmsg_array[$input_name3] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name3]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php     endif; ?>
<?php   endif;//addres_mode one ?>


<?php   if(isset($csnkform_setting_array['address_mode']) and $csnkform_setting_array['address_mode'] != 'one'): ?>
<?php     $input_name = 'zipcode'; ?>
<?php     if(array_key_exists($input_name, $input_name_array)): ?>
<?php       $place_holder = (get_option('my_company_zipcode') != '') ? '例) '.get_option('my_company_zipcode') : ''; ?>
<?php       //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php       $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm dlZipcode">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php       if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <span class="txtZipcodeMark">〒 </span>
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>" class="p-postal-code">
            </div><!--/.boxInput-->
<?php         echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php       elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if($_POST[$input_name] != ''): ?>〒<?php endif; ?><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php       endif; ?>
<?php       if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php     endif; ?>
<?php   endif;//addres_mode not one ?>


<?php   if(isset($csnkform_setting_array['address_mode']) and $csnkform_setting_array['address_mode'] != 'one'): ?>
<?php     $input_name = 'pref'; ?>
<?php     $select_array = $pref_array; ?>
<?php     if(array_key_exists($input_name, $input_name_array)): ?>
<?php       $place_holder = ''; ?>
<?php       //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php       $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm dlPref">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php       if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <select name="pref" class="p-region-id">
                <option value="">選択してください</option>
<?php         if($select_array and is_array($select_array)):
                foreach($select_array as $key => $value): ?>
<?php         $selected = (isset($_POST[$input_name]) and $_POST[$input_name] == $key) ? ' selected' : ''; ?>
                <option value="<?php echo esc_attr($key); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_html($value); ?></option>
<?php           endforeach;
              endif; ?>
              </select>
            </div><!--/.boxInput-->
<?php         echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php       elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($_POST[$input_name]) and isset($select_array[$_POST[$input_name]])) echo esc_html($select_array[$_POST[$input_name]]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php       endif; ?>
<?php       if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php     endif; ?>
<?php   endif;//addres_mode not one ?>


<?php   if(isset($csnkform_setting_array['address_mode']) and $csnkform_setting_array['address_mode'] != 'one'): ?>
<?php     $input_name = 'address'; ?>
<?php     if(array_key_exists($input_name, $input_name_array)): ?>
<?php       $place_holder = (get_option('my_company_address') != '') ? '例) '.get_option('my_company_address') : ''; ?>
<?php       //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php       $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm dlAddress">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php       if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>" class="p-locality p-street-address p-extended-address">
              <?php /*<input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>" class="p-region p-locality p-street-address p-extended-address">*/ ?>
            </div><!--/.boxInput-->
<?php         echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php       elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php       endif; ?>
<?php       if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php     endif; ?>
<?php   endif;//addres_mode not one ?>
</div><!--/.boxCsnkFormAddress-->



<?php   $input_name = 'telno'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = (get_option('my_company_telno') != '') ? '例) '.get_option('my_company_telno') : ''; ?>
<?php     //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'faxno'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = (get_option('my_company_faxno') != '') ? '例) '.get_option('my_company_faxno') : ''; ?>
<?php     //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'birth_year'; ?>
<?php   $input_name2 = 'birth_month'; ?>
<?php   $input_name3 = 'birth_day'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = '';
          $place_holder2 = '';
          $place_holder3 = ''; ?>
<?php     //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span>生年月日<?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput typeBirthday">
              <span class="txtBeforeBirthYear">西暦 </span>
              <span class="txtBirthYear"><input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>"><span class="txtYear">年</span></span>
              <span class="txtBirthMonth"><input type="text" name="<?php echo esc_attr($input_name2); ?>" value="<?php if(isset($_POST[$input_name2])) echo esc_attr($_POST[$input_name2]); ?>" placeholder="<?php echo esc_attr($place_holder2); ?>"><span class="txtMonth">月</span></span>
              <span class="txtBirthDay"><input type="text" name="<?php echo esc_attr($input_name3); ?>" value="<?php if(isset($_POST[$input_name3])) echo esc_attr($_POST[$input_name3]); ?>" placeholder="<?php echo esc_attr($place_holder3); ?>"><span class="txtDay">日</span></span>
            </div><!--/.boxInput boxBirthDay-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?><?php if(!empty($_POST[$input_name])): ?>年<?php endif; ?><?php echo esc_html($_POST[$input_name2]); ?><?php if(!empty($_POST[$input_name2])): ?>月<?php endif; ?><?php echo esc_html($_POST[$input_name3]); ?><?php if(!empty($_POST[$input_name3])): ?>日<?php endif; ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
          <input type="hidden" name="<?php echo esc_attr($input_name2); ?>" value="<?php if(isset($_POST[$input_name2])) echo esc_attr($_POST[$input_name2]); ?>">
          <input type="hidden" name="<?php echo esc_attr($input_name3); ?>" value="<?php if(isset($_POST[$input_name3])) echo esc_attr($_POST[$input_name3]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
<?php     if(isset($errmsg_array[$input_name2]) and $errmsg_array[$input_name2] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name2]); ?></span></div><?php endif; ?>
<?php     if(isset($errmsg_array[$input_name3]) and $errmsg_array[$input_name3] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name3]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'age'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm dlAge">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
            <span class="txtInputAfter">歳</span>
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?><?php if($_POST[$input_name] != ''): ?>歳<?php endif; ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'contact_method'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_text'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_text2'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_text3'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     //$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="text" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_textarea';
        if(array_key_exists($input_name, $input_name_array)):
          $place_holder = '';
          $caution = '';
          $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <textarea name="<?php echo esc_attr($input_name); ?>" placeholder="<?php echo esc_attr($place_holder); ?>"><?php if(isset($_POST[$input_name])) echo esc_html($_POST[$input_name]); ?></textarea>
            </div><!--/.boxInput-->
<?php echo $caution; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($_POST[$input_name])) echo nl2br(esc_html($_POST[$input_name])); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_textarea2';
        if(array_key_exists($input_name, $input_name_array)):
          $place_holder = '';
          $caution = '';
          $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <textarea name="<?php echo esc_attr($input_name); ?>" placeholder="<?php echo esc_attr($place_holder); ?>"><?php if(isset($_POST[$input_name])) echo esc_html($_POST[$input_name]); ?></textarea>
            </div><!--/.boxInput-->
<?php echo $caution; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($_POST[$input_name])) echo nl2br(esc_html($_POST[$input_name])); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_textarea3';
        if(array_key_exists($input_name, $input_name_array)):
          $place_holder = '';
          $caution = '';
          $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <textarea name="<?php echo esc_attr($input_name); ?>" placeholder="<?php echo esc_attr($place_holder); ?>"><?php if(isset($_POST[$input_name])) echo esc_html($_POST[$input_name]); ?></textarea>
            </div><!--/.boxInput-->
<?php echo $caution; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($_POST[$input_name])) echo nl2br(esc_html($_POST[$input_name])); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_date'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = '';//$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="date" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_date2'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = '';//$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="date" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_date3'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = '';//$caution = '<span class="txtCaution">(半角数字)</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <input type="date" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>" placeholder="<?php echo esc_attr($place_holder); ?>">
            </div><!--/.boxInput-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php echo esc_html($_POST[$input_name]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_select'; ?>
<?php   $select_array = $cont_select_array; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = ''; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <select name="<?php echo esc_attr($input_name); ?>">
                <option value="">選択してください</option>
<?php       foreach($select_array as $key => $value): ?>
<?php         $selected = (isset($_POST[$input_name]) and $_POST[$input_name] == $key) ? ' selected' : ''; ?>
                <option value="<?php echo esc_attr($key); ?>"<?php echo $selected; ?>><?php echo esc_html($value); ?></option>
<?php       endforeach; ?>
              </select>
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($select_array[$_POST[$input_name]])) echo esc_html($select_array[$_POST[$input_name]]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_select2'; ?>
<?php   $select_array = $cont_select2_array; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = ''; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <select name="<?php echo esc_attr($input_name); ?>">
                <option value="">選択してください</option>
<?php       foreach($select_array as $key => $value): ?>
<?php         $selected = (isset($_POST[$input_name]) and $_POST[$input_name] == $key) ? ' selected' : ''; ?>
                <option value="<?php echo esc_attr($key); ?>"<?php echo $selected; ?>><?php echo esc_html($value); ?></option>
<?php       endforeach; ?>
              </select>
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($select_array[$_POST[$input_name]])) echo esc_html($select_array[$_POST[$input_name]]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_select3'; ?>
<?php   $select_array = $cont_select3_array; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = ''; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <select name="<?php echo esc_attr($input_name); ?>">
                <option value="">選択してください</option>
<?php       foreach($select_array as $key => $value): ?>
<?php         $selected = (isset($_POST[$input_name]) and $_POST[$input_name] == $key) ? ' selected' : ''; ?>
                <option value="<?php echo esc_attr($key); ?>"<?php echo $selected; ?>><?php echo esc_html($value); ?></option>
<?php       endforeach; ?>
              </select>
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($select_array[$_POST[$input_name]])) echo esc_html($select_array[$_POST[$input_name]]); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_radio'; ?>
<?php   $radio_array = $cont_radio_array; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = '';//$caution = '<span class="txtCaution"></span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm typeColumn">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <div class="boxRadioWrap">
<?php     if(is_array($radio_array)): ?>
                <ul class="ulRadio">
<?php       foreach($radio_array as $key => $value): ?>
<?php         $checked = (isset($_POST[$input_name]) and $_POST[$input_name] != '' and $_POST[$input_name] == $key) ? ' checked' : ''; ?>
                  <li><label><input type="radio" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($key); ?>"<?php echo esc_html($checked); ?>><span><?php echo esc_html($value); ?></span></label></li>
<?php       endforeach; ?>
                </ul>
<?php     endif; ?>
              </div><!--/.boxRadioWrap-->
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($_POST[$input_name]) and isset($radio_array[$_POST[$input_name]])) echo esc_html($radio_array[$_POST[$input_name]]); ?></span>
            <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_radio2'; ?>
<?php   $radio_array = $cont_radio2_array; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = '';//$caution = '<span class="txtCaution"></span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm typeColumn">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <div class="boxRadioWrap">
<?php     if(is_array($radio_array)): ?>
                <ul class="ulRadio">
<?php       foreach($radio_array as $key => $value): ?>
<?php         $checked = (isset($_POST[$input_name]) and $_POST[$input_name] != '' and $_POST[$input_name] == $key) ? ' checked' : ''; ?>
                  <li><label><input type="radio" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($key); ?>"<?php echo esc_html($checked); ?>><span><?php echo esc_html($value); ?></span></label></li>
<?php       endforeach; ?>
                </ul>
<?php     endif; ?>
              </div><!--/.boxRadioWrap-->
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($_POST[$input_name]) and isset($radio_array[$_POST[$input_name]])) echo esc_html($radio_array[$_POST[$input_name]]); ?></span>
            <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_radio3'; ?>
<?php   $radio_array = $cont_radio3_array; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = '';//$caution = '<span class="txtCaution"></span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm typeColumn">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <div class="boxRadioWrap">
<?php     if(is_array($radio_array)): ?>
                <ul class="ulRadio">
<?php       foreach($radio_array as $key => $value): ?>
<?php         $checked = (isset($_POST[$input_name]) and $_POST[$input_name] != '' and $_POST[$input_name] == $key) ? ' checked' : ''; ?>
                  <li><label><input type="radio" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($key); ?>"<?php echo esc_html($checked); ?>><span><?php echo esc_html($value); ?></span></label></li>
<?php       endforeach; ?>
                </ul>
<?php     endif; ?>
              </div><!--/.boxRadioWrap-->
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($_POST[$input_name]) and isset($radio_array[$_POST[$input_name]])) echo esc_html($radio_array[$_POST[$input_name]]); ?></span>
            <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_checkbox'; ?>
<?php   $checkbox_array = $cont_checkbox_array; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = ''; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <ul class="ulCheckbox">
<?php       foreach($checkbox_array as $key => $value): ?>
<?php         (isset($_POST[$input_name]) and is_array($_POST[$input_name]) and in_array($key,$_POST[$input_name])) ? $checked = ' checked' : $checked = ''; ?>
                <li><label for="<?php echo esc_attr($input_name); ?>_<?php echo esc_attr($key); ?>"><input type="checkbox" name="<?php echo esc_attr($input_name); ?>[]" value="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($input_name); ?>_<?php echo esc_attr($key); ?>"<?php echo $checked; ?>><span><?php echo esc_html($value); ?></span></label></li>
<?php       endforeach; ?>
              </ul>
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput">
<?php       $checkbox_confirm = '';
            if(isset($_POST[$input_name]) and $_POST[$input_name] and is_array($_POST[$input_name])):
              foreach($_POST[$input_name] as $value):
                if($checkbox_confirm) $checkbox_confirm .= '、';
                $checkbox_confirm .= $checkbox_array[$value]; ?>
            <input type="hidden" name="<?php echo esc_attr($input_name); ?>[]" value="<?php echo esc_attr($value); ?>">
<?php         endforeach;
            endif;
            echo esc_html($checkbox_confirm); ?>
          </span>
          <?php /*<input type="hidden" name="<?php echo esc_attr($input_name); ?>_serial" value="<?php echo esc_attr(rawurlencode($_POST[$input_name.'_serial'])); ?>">*/ ?>
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_checkbox2'; ?>
<?php   $checkbox_array = $cont_checkbox2_array; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = ''; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <ul class="ulCheckbox">
<?php       foreach($checkbox_array as $key => $value): ?>
<?php         (isset($_POST[$input_name]) and is_array($_POST[$input_name]) and in_array($key,$_POST[$input_name])) ? $checked = ' checked' : $checked = ''; ?>
                <li><label for="<?php echo esc_attr($input_name); ?>_<?php echo esc_attr($key); ?>"><input type="checkbox" name="<?php echo esc_attr($input_name); ?>[]" value="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($input_name); ?>_<?php echo esc_attr($key); ?>"<?php echo $checked; ?>><span><?php echo esc_html($value); ?></span></label></li>
<?php       endforeach; ?>
              </ul>
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput">
<?php       $checkbox_confirm = '';
            if(isset($_POST[$input_name]) and $_POST[$input_name] and is_array($_POST[$input_name])):
              foreach($_POST[$input_name] as $value):
                if($checkbox_confirm) $checkbox_confirm .= '、';
                $checkbox_confirm .= $checkbox_array[$value]; ?>
            <input type="hidden" name="<?php echo esc_attr($input_name); ?>[]" value="<?php echo esc_attr($value); ?>">
<?php         endforeach;
            endif;
            echo esc_html($checkbox_confirm); ?>
          </span>
          <?php /*<input type="hidden" name="<?php echo esc_attr($input_name); ?>_serial" value="<?php echo esc_attr(rawurlencode($_POST[$input_name.'_serial'])); ?>">*/ ?>
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont_checkbox3'; ?>
<?php   $checkbox_array = $cont_checkbox3_array; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = ''; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <ul class="ulCheckbox">
<?php       foreach($checkbox_array as $key => $value): ?>
<?php         (isset($_POST[$input_name]) and is_array($_POST[$input_name]) and in_array($key,$_POST[$input_name])) ? $checked = ' checked' : $checked = ''; ?>
                <li><label for="<?php echo esc_attr($input_name); ?>_<?php echo esc_attr($key); ?>"><input type="checkbox" name="<?php echo esc_attr($input_name); ?>[]" value="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($input_name); ?>_<?php echo esc_attr($key); ?>"<?php echo $checked; ?>><span><?php echo esc_html($value); ?></span></label></li>
<?php       endforeach; ?>
              </ul>
            </div><!--/.boxInput-->
<?php       echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput">
<?php       $checkbox_confirm = '';
            if(isset($_POST[$input_name]) and $_POST[$input_name] and is_array($_POST[$input_name])):
              foreach($_POST[$input_name] as $value):
                if($checkbox_confirm) $checkbox_confirm .= '、';
                $checkbox_confirm .= $checkbox_array[$value]; ?>
            <input type="hidden" name="<?php echo esc_attr($input_name); ?>[]" value="<?php echo esc_attr($value); ?>">
<?php         endforeach;
            endif;
            echo esc_html($checkbox_confirm); ?>
          </span>
          <?php /*<input type="hidden" name="<?php echo esc_attr($input_name); ?>_serial" value="<?php echo esc_attr(rawurlencode($_POST[$input_name.'_serial'])); ?>">*/ ?>
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'file1'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = '<span class="txtCaution">添付可能ファイル形式：jpg、png、gif、pdf、xlsx、docx</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm dlFile1 typeColumn">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <div class="boxFileWrap">
<?php       if(isset($_POST['attach_name0']) and $_POST['attach_name0']): ?>
<?php         if(isset($_SESSION['attach_extension0']) and $_SESSION['attach_extension0'] == 'pdf'): ?>
              <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-pdf01.png" alt="pdf" class="icnAttachPdf">
<?php         elseif(isset($_SESSION['attach_extension0']) and $_SESSION['attach_extension0'] == 'xlsx'): ?>
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-excel01.png" alt="excel" class="icnAttachExcel">
<?php         elseif(isset($_SESSION['attach_extension0']) and $_SESSION['attach_extension0'] == 'docx'): ?>
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-word01.png" alt="word" class="icnAttachWord">
<?php         else: ?>
              <img src="<?php echo esc_url(site_url()); ?>/disp_image.php?img=<?php if(isset($_POST['attach_name0'])) echo esc_html($_POST['attach_name0']) ?>&s=100&t=<?php echo time(); ?>" alt="">
<?php         endif; ?>
              <input type="submit" name="del_attach0" value="x">
              <input type="hidden" name="attach_name0" value="<?php if(isset($_POST['attach_name0'])) echo esc_html($_POST['attach_name0']); ?>">
<?php       else: ?>
              <input type="file" name="attach[0]">
<?php       endif; ?>
<?php       if(!isset($_SESSION['attach_name0']) or $_SESSION['attach_name0'] == ''): echo $caution; endif; ?>
              </div><!--/.boxFileWrap-->
            </div><!--/.boxInput-->
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
<?php       //if(isset($_POST['attach_name0']) and $_POST['attach_name0']): ?>
          <span class="txtFormInput">
<?php       if(isset($_SESSION['attach_extension0']) and $_SESSION['attach_extension0'] == 'pdf'): ?>
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-pdf01.png" alt="pdf" class="icnAttachPdf">
<?php       elseif(isset($_SESSION['attach_extension0']) and $_SESSION['attach_extension0'] == 'xlsx'): ?>
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-excel01.png" alt="excel" class="icnAttachExcel">
<?php       elseif(isset($_SESSION['attach_extension0']) and $_SESSION['attach_extension0'] == 'docx'): ?>
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-word01.png" alt="word" class="icnAttachWord">
<?php       else: ?>
            <img src="<?php echo esc_url(site_url()); ?>/disp_image.php?img=<?php if(isset($_POST['attach_name0'])) echo esc_html($_POST['attach_name0']) ?>&s=100&t=<?php echo time(); ?>" alt="">
<?php       endif; ?>
          </span>
          <input type="hidden" name="attach_name0" value="<?php if(isset($_POST['attach_name0'])) echo esc_html($_POST['attach_name0']); ?>">
<?php       //endif; ?>
<?php     endif; ?>
<?php     if(isset($errmsg_array['attach_name0']) and $errmsg_array['attach_name0'] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array['attach_name0']); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'file2'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = '<span class="txtCaution">添付可能ファイル形式：jpg、png、gif、pdf、xlsx、docx</span>'; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm dlFile2 typeColumn">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <div class="boxFileWrap">
<?php       if(isset($_POST['attach_name1']) and $_POST['attach_name1']): ?>
<?php         if(isset($_SESSION['attach_extension1']) and $_SESSION['attach_extension1'] == 'pdf'): ?>
              <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-pdf01.png" alt="pdf" class="icnAttachPdf">
<?php         elseif(isset($_SESSION['attach_extension1']) and $_SESSION['attach_extension1'] == 'xlsx'): ?>
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-excel01.png" alt="excel" class="icnAttachExcel">
<?php         elseif(isset($_SESSION['attach_extension1']) and $_SESSION['attach_extension1'] == 'docx'): ?>
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-word01.png" alt="word" class="icnAttachWord">
<?php         else: ?>
              <img src="<?php echo esc_url(site_url()); ?>/disp_image.php?img=<?php if(isset($_POST['attach_name1'])) echo esc_html($_POST['attach_name1']) ?>&s=100&t=<?php echo time(); ?>" alt="">
<?php         endif; ?>
              <input type="submit" name="del_attach1" value="x">
              <input type="hidden" name="attach_name1" value="<?php if(isset($_POST['attach_name1'])) echo esc_html($_POST['attach_name1']); ?>">
<?php       else: ?>
              <input type="file" name="attach[1]">
<?php       endif; ?>
<?php       if(!isset($_SESSION['attach_name1']) or $_SESSION['attach_name1'] == ''): echo $caution; endif; ?>
              </div><!--/.boxFileWrap-->
            </div><!--/.boxInput-->
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>

<?php       if(isset($_POST['attach_name1']) and $_POST['attach_name1']): ?>
          <span class="txtFormInput">
<?php         if(isset($_SESSION['attach_extension1']) and $_SESSION['attach_extension1'] == 'pdf'): ?>
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-pdf01.png" alt="pdf" class="icnAttachPdf">
<?php         elseif(isset($_SESSION['attach_extension1']) and $_SESSION['attach_extension1'] == 'xlsx'): ?>
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-excel01.png" alt="excel" class="icnAttachExcel">
<?php         elseif(isset($_SESSION['attach_extension1']) and $_SESSION['attach_extension1'] == 'docx'): ?>
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/base/base-icn-word01.png" alt="word" class="icnAttachWord">
<?php         else: ?>
            <img src="<?php echo esc_url(site_url()); ?>/disp_image.php?img=<?php if(isset($_POST['attach_name1'])) echo esc_html($_POST['attach_name1']) ?>&s=100&t=<?php echo time(); ?>" alt="">
<?php         endif; ?>
          </span>
          <input type="hidden" name="attach_name1" value="<?php if(isset($_POST['attach_name1'])) echo esc_html($_POST['attach_name1']); ?>">
<?php       endif; ?>
<?php     endif; ?>
<?php     if(isset($errmsg_array['attach_name1']) and $errmsg_array['attach_name1'] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array['attach_name1']); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'cont'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $place_holder = ''; ?>
<?php     $caution = ''; ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
      <dl class="dlForm dlCont">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
<?php     if($form_mode == 'input'): ?>
<?php     /*<p class="pRemarks">テキスト</p>*/ ?>
          <div class="boxInputWrap">
            <div class="boxInput">
              <textarea name="<?php echo esc_attr($input_name); ?>" placeholder="<?php echo esc_attr($place_holder); ?>"><?php if(isset($_POST[$input_name])) echo esc_html($_POST[$input_name]); ?></textarea>
            </div><!--/.boxInput-->
<?php echo $caution; $caution = ''; ?>
          </div><!--/.boxInputWrap-->
<?php     elseif($form_mode == 'confirm'): ?>
          <span class="txtFormInput"><?php if(isset($_POST[$input_name])) echo nl2br(esc_html($_POST[$input_name])); ?></span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
<?php     endif; ?>
<?php     if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
        </dd>
      </dl>
<?php   endif; ?>


<?php   $input_name = 'check_privacy_p'; ?>
<?php   if(array_key_exists($input_name, $input_name_array)): ?>
<?php     $required = (in_array($input_name, $required_name_array)) ? $mark_required : $mark_not_required; ?>
<?php     if($form_mode == 'input'): ?>
      <div class="boxFormPrivacy">
        <div class="boxFormPrivacyIn">
<?php $add_str = '';
      if(get_option('csnkform_company_name')):
        $add_str = esc_html(get_option('csnkform_company_name')).'の<br class="dSpInline">';
      elseif(get_option('my_company_name')):
        $add_str = esc_html(get_option('my_company_name')).'の<br class="dSpInline">';
      endif; ?>
          <input type="checkbox" name="<?php echo esc_attr($input_name); ?>" value="1" id="checkPrivacyP"<?php if(isset($s_check_privacy_p[1])) echo esc_attr($s_check_privacy_p[1]); ?>> <label for="checkPrivacyP"><?php echo $add_str; ?><span class="dOneLine">「<a href="<?php echo esc_url(home_url('/')); ?>privacy-policy/" class="csnkformUnderline fontB linkBaseExternal btnCsnkFormPopup" target="_blank" rel="noopener"><?php echo csnkform_strip_code(esc_html($input_name_array[$input_name])); ?></a>」<?php /*<span class="txtExternalLink">(別ウインドウで開きます)</span>*/ ?>に</span><span class="dOneLine">同意する</span></label>
        </div><!--/.boxFormPrivacyIn-->
<?php /**/ ?>
        <div class="boxCsnkFormPopupCont">
          <h2 class="ttlCsnkFormPopupCont"><?php echo esc_html($input_name_array[$input_name]); ?></h2>
<?php if(get_option('csnkform_privacy_policy')):
        echo nl2br(get_option('csnkform_privacy_policy'));
      else:
        echo nl2br(get_option('my_privacy_policy'));
      endif; ?>
          <span class="btnCsnkFormPopupClose">×</span>
        </div><!--/.boxCsnkFormPopupCont-->

<?php /*
        <div class="boxCsnkFormPrivacyPopup">
          <div class="boxCsnkFormPrivacyPopupIn">
            <h2 class="ttl01"><?php echo esc_html($input_name_array[$input_name]); ?></h2>
<?php       echo nl2br(get_option('my_privacy_policy')); ?>
          </div><!--/.boxCsnkFormPrivacyPopupIn-->
          <span class="btnCsnkFormPrivacyPopupClose">×</span>
        </div><!--/.boxCsnkFormPrivacyPopup-->
    */ ?>
<?php       if(isset($errmsg_array[$input_name]) and $errmsg_array[$input_name] != ''): ?><div class="boxError"><span class="txtError"><?php echo esc_html($errmsg_array[$input_name]); ?></span></div><?php endif; ?>
      </div><!--/.boxFormPrivacy-->
<?php     elseif($form_mode == 'confirm'): ?>
      <dl class="dlForm dlPrivacy">
        <dt><span><?php echo csnkform_code_to_tag(esc_html($input_name_array[$input_name])); ?><?php echo $required; ?></span></dt>
        <dd>
          <span class="txtFormInput">同意する</span>
          <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php if(isset($_POST[$input_name])) echo esc_attr($_POST[$input_name]); ?>">
        </dd>
      </dl>
<?php     endif; ?>
<?php   endif; ?>


      <div class="boxFormSubmit">
<?php   if($form_mode == 'input'): ?>
        <input type="submit" name="submit1" value="入力内容を確認する" class="btnSubmit btnSubmitConfirm">
<?php   elseif($form_mode == 'confirm'): ?>
        <input type="hidden" name="token" value="<?php echo esc_attr($token); ?>">
        <input type="submit" name="back" value="入力画面に戻る" class="btnSubmit btnSubmitBack">
        <input type="submit" name="submit2" value="この内容で送信する" class="btnSubmit btnSubmitSend">
<?php   endif; ?>
      </div><!--/.boxFormSubmit-->

<?php   wp_nonce_field($action, $nonce); ?>

    </form>


<?php /*
    <div class="boxCsnkFormBottom">
      <ul class="ulCsnkFormBottom">
        <li>下欄に入力後「入力内容を確認する」をクリックしてください。</li>
        <li>「<span class="cBaseRed">必須</span>」マークが付いているものは、必ず入力をお願いいたします。また、半角カタカナは使用しないでください。</li>
        <li>メールアドレス・電話番号等は、お間違えの無いようお願いいたします。</li>
        <li>フォームからのお問い合わせは、お返事にお時間を頂戴することがございます、ご了承ください。</li>
      </ul>
    </div><!--/.boxCsnkFormBottom-->
*/ ?>


<?php endif;//mode not complete ?>


<?php if($form_mode == 'complete'): ?>
    <div class="boxCsnkFormThanks">
      <h2 class="ttlCsnkFormThanks">お問い合わせ<br class="dSpInline">ありがとうございます</h2>
      <div class="boxCsnkFormThanksIn">
        <p>この度はお問い合わせ、誠にありがとうございます。<br class="dPcInline">必要に応じまして担当者よりメールまたはお電話でご連絡をさせていただきますので、<br class="dPcInline">今しばらくお待ちくださいますようよろしくお願い申し上げます。</p>
        <p>弊社より返信、返答がない場合は、ご入力いただいた<span class="cBaseRed">メールアドレスに誤り</span>がある場合がございます。<br class="dPcInline">その際は、お手数ですが<span class="cBaseRed">再度送信</span>いただくか、<span class="cBaseRed">お電話でご連絡</span>いただけますと幸いです。</p>
      </div><!--/.boxCsnkFormThanksIn-->
    </div><!--/.boxCsnkFormThanks-->
<?php   //get_template_part('template/tmp-contact-telno01'); ?>
<?php if(get_option('csnkform_conversion_tag')):
        echo get_option('csnkform_conversion_tag');
      else:
        echo get_option('my_contact_conversion_tag');
      endif; ?>
<?php endif;#modeComplete ?>


  </div><!--/.boxCsnkForm-->
</div><!--/.boxCsnkFormWrap-->
