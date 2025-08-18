jQuery(function($){

  $('.boxCsnkAdmin .popup').on('click',function(){
    var winW = 820;
    var winH = 900;
    //var winL = (screen.availWidth - winW) / 2;
    var winL = 300;
    var winT = (screen.availHeight - winH) / 2;
    window.open(this.href,'Window','width='+winW+',height='+winH+',left='+winL+',top='+winT+',resizable=yes,scrollbars=yes,menubar=no,toolbar=no,location=no,status=no');
    return false;
  });

  if($('.boxCsnkAdmin .boxPopupCont').length != 0){
    $('body').addClass('modePopupCont');
  }

  $('.boxCsnkAdmin .btnCloseWin').on('click',function(){
    window.opener.location.reload();
    window.close();
  });

});