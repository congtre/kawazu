jQuery(function($){

//if($('body').hasClass('modeTest')){
  if($('#csnkForm .boxCsnkFormGoogleRCT .txtSiteKey').length > 0){
    //console.log('ok');
    var google_recaptcha_site_key = $('#csnkForm .boxCsnkFormGoogleRCT .txtSiteKey').text();
    //console.log('GoogleRecaptchaSiteKey:'+google_recaptcha_site_key);
    if(google_recaptcha_site_key){
      $('#csnkForm input[type="submit"]').on('click', function(event){
        event.preventDefault(); //デフォルトの動作（送信）を停止
        //console.log('SubmitName:'+$(this).attr('name'));
        var submit_name = $(this).attr('name');
        var action_name = 'send';
        grecaptcha.ready(function() {
          grecaptcha.execute(google_recaptcha_site_key, { action: action_name }).then(function(token){
            $('#csnkForm').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
            $('#csnkForm').prepend('<input type="hidden" name="action" value="' + action_name + '">');
            $('#csnkForm').prepend('<input type="hidden" name="' + submit_name + '" value="1">');
            $('#csnkForm').unbind('submit').submit();
          });
        });
      });
    }
  }
//}


// ファイル添付 - 条件分岐あり用
/*
  if($('body').hasClass('pageEntry')){

    form_ini();
    function form_ini(){
      if($('.csnkForm input[name="cont_radio"]:checked').val() == '0' || $('.csnkForm input[type="hidden"][name="cont_radio"]').val() == '0'){
        $('.csnkForm .dlFile1').css('display', 'none');
        $('.csnkForm .dlFile2').css('display', 'none');
      }else{
        $('.csnkForm .dlFile1').css('display', '');
        $('.csnkForm .dlFile2').css('display', '');
      }
    }

    $('.csnkForm input[name="cont_radio"]').on('click', function(){
      if($(this).prop('value') == '0'){
        $(this).parents('.csnkForm').find('.dlFile1').css('display', 'none');
        $(this).parents('.csnkForm').find('.dlFile2').css('display', 'none');
      }else{
        $(this).parents('.csnkForm').find('.dlFile1').css('display', '');
        $(this).parents('.csnkForm').find('.dlFile2').css('display', '');
      }
    });

  }//pageEntry

*/


});