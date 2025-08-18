jQuery(function($){


  $(window).resize(function(){
    if($('.boxCsnkFormPopupBg').css('display') == 'block'){
      $('.boxCsnkFormPopupBg').css({
      'width': $(window).width(),
      'height': document.documentElement.scrollHeight
      });
    }
  });


  $('.btnCsnkFormPopup').on('click', function(){

    $('body').append('<div class="boxCsnkFormPopupBg"></div>');

    $('.boxCsnkFormPopupBg').css({
      'width': $(window).width(),
      'height': document.documentElement.scrollHeight
    });

    $('.boxCsnkFormPopupBg').show();
    $('.boxCsnkFormPopupCont').fadeIn();

    $('.boxCsnkFormPopupBg, .btnCsnkFormPopupClose').click(function(){
      $('.boxCsnkFormPopupCont').fadeOut('slow', function(){ $('.boxCsnkFormPopupBg').fadeOut(); });
      $('.boxPopupBg').remove();
    });

    return false;

  });




});