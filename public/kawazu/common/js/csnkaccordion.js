jQuery(function($){

  $(window).on('load',function(){
    accordion_pc();
    accordion_sp();
  });


  var defW = $(window).width();
  $(window).on('resize',function(){
    var nowW = $(window).width();
    if(nowW != defW){
      defW = nowW;
      accordion_ini();
      accordion_pc();
      accordion_sp();
    }
  });


  function accordion_ini(){
    $('.boxAccordionWrap').removeClass('statusOpen');
    if($('.btnAccordionTxt').text() == 'Close') $('.btnAccordionTxt').text('More');
    $('.boxAccordion').css('display','');
    $('.boxAccordionPc').css('display','');
    $('.boxAccordionSp').css('display','');

    if($('.icnAccordion').length > 0){
      $('.icnAccordion').each(function(){
        if($(this).attr('src') && $(this).attr('src').match(/\-minus(|[0-9]+)\.png/)){
          var imgSrc = $(this).attr('src').replace(/\-minus(|[0-9]+)\.png/,'-plus$1.png');
          $(this).attr('src', imgSrc);
          $(this).attr('alt', '+');
        }
      });
    }
    if($('.icnAccordionPc').length > 0){
      $('.icnAccordionPc').each(function(){
        if($(this).attr('src') && $(this).attr('src').match(/\-minus(|[0-9]+)\.png/)){
          var imgSrc = $(this).attr('src').replace(/\-minus(|[0-9]+)\.png/,'-plus$1.png');
          $(this).attr('src', imgSrc);
          $(this).attr('alt', '+');
        }
      });
    }
    if($('.icnAccordionSp').length > 0){
      $('.icnAccordionSp').each(function(){
        if($(this).attr('src') && $(this).attr('src').match(/\-minus(|[0-9]+)\.png/)){
          var imgSrc = $(this).attr('src').replace(/\-minus(|[0-9]+)\.png/,'-plus$1.png');
          $(this).attr('src', imgSrc);
          $(this).attr('alt', '+');
        }
      });
    }
  }


  //$('.icnAccordion, .btnAccordion').on('click',function(){
  $('.btnAccordion').on('click',function(){
    if($(this).parents('.boxAccordionWrap').length == 0) return false;
    var chkIcn = ($(this).parents('.boxAccordionWrap').find('.icnAccordion').length > 0) ? 'ok' : '';
    var boxObj = $(this).parents('.boxAccordionWrap').find('.boxAccordion');
    var btnTxtObj = $(this).parents('.boxAccordionWrap').find('.btnAccordionTxt');
    var icnObj = $(this).parents('.boxAccordionWrap').find('.icnAccordion');
    if(boxObj.css('display') == 'none'){
      boxObj.slideDown();
      if(btnTxtObj.text() == '詳しく見る') btnTxtObj.text('閉じる');
      $(this).parents('.boxAccordionWrap').addClass('statusOpen');
      if(chkIcn == 'ok'){
        if(icnObj.attr('src') && icnObj.attr('src').match(/\-plus(|[0-9]+)\.png/)){
          var imgSrc = icnObj.attr('src').replace(/\-plus(|[0-9]+)\.png/,'-minus$1.png');
          icnObj.attr('src',imgSrc);
          icnObj.attr('alt','-');
        }else if(icnObj.attr('src') && icnObj.attr('src').match(/\-arrow(|[0-9]+)\-down\.png/)){
          var imgSrc = icnObj.attr('src').replace(/\-arrow(|[0-9]+)\-down\.png/,'-arrow$1-up.png');
          icnObj.attr('src',imgSrc);
          icnObj.attr('alt','↑');
        }
      }
    }
    else{
      boxObj.slideUp();
      if(btnTxtObj.text() == '閉じる') btnTxtObj.text('詳しく見る');
      $(this).parents('.boxAccordionWrap').removeClass('statusOpen');
      if(chkIcn == 'ok'){
        if(icnObj.attr('src') && icnObj.attr('src').match(/\-minus(|[0-9]+)\.png/)){
          var imgSrc = icnObj.attr('src').replace(/\-minus(|[0-9]+)\.png/,'-plus$1.png');
          icnObj.attr('src',imgSrc);
          icnObj.attr('alt','+');
        }else if(icnObj.attr('src') && icnObj.attr('src').match(/\-arrow(|[0-9]+)\-up\.png/)){
          var imgSrc = icnObj.attr('src').replace(/\-arrow(|[0-9]+)\-up\.png/,'-arrow$1-down.png');
          icnObj.attr('src',imgSrc);
          icnObj.attr('alt','↓');
        }
      }
    }
    return false;
  });


  function accordion_pc(){
    if($('.isPc').css('width') == '1px'){
      $('.icnAccordionPc, .btnAccordionPc').on('click',function(){
        if($(this).parents('.boxAccordionWrap').length == 0) return false;
        var chkIcn = ($(this).parents('.boxAccordionWrap').find('.icnAccordionPc').length > 0) ? 'ok' : '';
        var boxObj = $(this).parents('.boxAccordionWrap').find('.boxAccordionPc');
        var btnTxtObj = $(this).parents('.boxAccordionWrap').find('.btnAccordionTxtPc');
        var icnObj = $(this).parents('.boxAccordionWrap').find('.icnAccordionPc');
        if(boxObj.css('display') == 'none'){
          boxObj.slideDown();
          if(btnTxtObj.text() == 'More') btnTxtObj.text('Close');
          $(this).parents('.boxAccordionWrap').addClass('statusOpen');
          if(chkIcn == 'ok'){
            if(icnObj.attr('src') && icnObj.attr('src').match(/\-plus(|[0-9]+)\.png/)){
              var imgSrc = icnObj.attr('src').replace(/\-plus(|[0-9]+)\.png/,'-minus$1.png');
              icnObj.attr('src',imgSrc);
              icnObj.attr('alt','-');
            }else if(icnObj.attr('src') && icnObj.attr('src').match(/\-arrow(|[0-9]+)\-down\.png/)){
              var imgSrc = icnObj.attr('src').replace(/\-arrow(|[0-9]+)\-down\.png/,'-arrow$1-up.png');
              icnObj.attr('src',imgSrc);
              icnObj.attr('alt','↑');
            }
          }
        }
        else{
          boxObj.slideUp();
          if(btnTxtObj.text() == 'Close') btnTxtObj.text('More');
          $(this).parents('.boxAccordionWrap').removeClass('statusOpen');
          if(chkIcn == 'ok'){
            if(icnObj.attr('src') && icnObj.attr('src').match(/\-minus(|[0-9]+)\.png/)){
              var imgSrc = icnObj.attr('src').replace(/\-minus(|[0-9]+)\.png/,'-plus$1.png');
              icnObj.attr('src',imgSrc);
              icnObj.attr('alt','+');
            }else if(icnObj.attr('src') && icnObj.attr('src').match(/\-arrow(|[0-9]+)\-up\.png/)){
              var imgSrc = icnObj.attr('src').replace(/\-arrow(|[0-9]+)\-up\.png/,'-arrow$1-down.png');
              icnObj.attr('src',imgSrc);
              icnObj.attr('alt','↓');
            }
          }
        }
        return false;
      });
    }//Pc
    else{
      $('.icnAccordionPc, .btnAccordionPc').off();
    }
  }//func


  function accordion_sp(){
    if($('.isSp').css('width') == '2px'){
      $('.icnAccordionSp, .btnAccordionSp').off();
      $('.icnAccordionSp, .btnAccordionSp').on('click', function(){
        if($(this).parents('.boxAccordionWrap').length == 0) return false;
        var chkIcn = ($(this).parents('.boxAccordionWrap').find('.icnAccordionSp').length > 0) ? 'ok' : '';
        var boxObj = $(this).parents('.boxAccordionWrap').find('.boxAccordionSp');
        var btnTxtObj = $(this).parents('.boxAccordionWrap').find('.btnAccordionTxtSp');
        var icnObj = $(this).parents('.boxAccordionWrap').find('.icnAccordionSp');
        if(boxObj.css('display') == 'none'){
          boxObj.slideDown();
          if(btnTxtObj.text() == 'More') btnTxtObj.text('Close');
          $(this).parents('.boxAccordionWrap').addClass('statusOpen');
          if(chkIcn == 'ok'){
            if(icnObj.attr('src') && icnObj.attr('src').match(/\-plus(|[0-9]+)\.png/)){
              var imgSrc = icnObj.attr('src').replace(/\-plus(|[0-9]+)\.png/,'-minus$1.png');
              icnObj.attr('src',imgSrc);
              icnObj.attr('alt','-');
            }else if(icnObj.attr('src') && icnObj.attr('src').match(/\-arrow(|[0-9]+)\-down\.png/)){
              var imgSrc = icnObj.attr('src').replace(/\-arrow(|[0-9]+)\-down\.png/,'-arrow$1-up.png');
              icnObj.attr('src',imgSrc);
              icnObj.attr('alt','↑');
            }
          }
        }
        else{
          boxObj.slideUp();
          if(btnTxtObj.text() == 'Close') btnTxtObj.text('More');
          $(this).parents('.boxAccordionWrap').removeClass('statusOpen');
          if(chkIcn == 'ok'){
            if(icnObj.attr('src') && icnObj.attr('src').match(/\-minus(|[0-9]+)\.png/)){
              var imgSrc = icnObj.attr('src').replace(/\-minus(|[0-9]+)\.png/,'-plus$1.png');
              icnObj.attr('src',imgSrc);
              icnObj.attr('alt','+');
            }else if(icnObj.attr('src') && icnObj.attr('src').match(/\-arrow(|[0-9]+)\-up\.png/)){
              var imgSrc = icnObj.attr('src').replace(/\-arrow(|[0-9]+)\-up\.png/,'-arrow$1-down.png');
              icnObj.attr('src',imgSrc);
              icnObj.attr('alt','↓');
            }
          }
        }
        return false;
      });
    }//Sp
    else {
      $('.icnAccordionSp, .btnAccordionSp').off();
    }
  }//func


  //$('.icnAccordionSp, .btnAccordionSp').on('click',function(){
  $('.btnAccordionSp').on('click',function(){
    if($(this).parents('.boxAccordionWrap').length == 0) return false;
    var chkIcn = ($(this).parents('.boxAccordionWrap').find('.icnAccordionSp').length > 0) ? 'ok' : '';
    var boxObj = $(this).parents('.boxAccordionWrap').find('.boxAccordionSp');
    var btnTxtObj = $(this).parents('.boxAccordionWrap').find('.btnAccordionTxtSp');
    var icnObj = $(this).parents('.boxAccordionWrap').find('.icnAccordionSp');
    if(boxObj.css('display') == 'none'){
      boxObj.slideDown();
      if(btnTxtObj.text() == '詳しく見る') btnTxtObj.text('閉じる');
      $(this).parents('.boxAccordionWrap').addClass('statusOpen');
      if(chkIcn == 'ok'){
        if(icnObj.attr('src') && icnObj.attr('src').match(/\-plus(|[0-9]+)\.png/)){
          var imgSrc = icnObj.attr('src').replace(/\-plus(|[0-9]+)\.png/,'-minus$1.png');
          icnObj.attr('src',imgSrc);
          icnObj.attr('alt','-');
        }else if(icnObj.attr('src') && icnObj.attr('src').match(/\-arrow(|[0-9]+)\-down\.png/)){
          var imgSrc = icnObj.attr('src').replace(/\-arrow(|[0-9]+)\-down\.png/,'-arrow$1-up.png');
          icnObj.attr('src',imgSrc);
          icnObj.attr('alt','↑');
        }
      }
    }
    else{
      boxObj.slideUp();
      if(btnTxtObj.text() == '閉じる') btnTxtObj.text('詳しく見る');
      $(this).parents('.boxAccordionWrap').removeClass('statusOpen');
      if(chkIcn == 'ok'){
        if(icnObj.attr('src') && icnObj.attr('src').match(/\-minus(|[0-9]+)\.png/)){
          var imgSrc = icnObj.attr('src').replace(/\-minus(|[0-9]+)\.png/,'-plus$1.png');
          icnObj.attr('src',imgSrc);
          icnObj.attr('alt','+');
        }else if(icnObj.attr('src') && icnObj.attr('src').match(/\-arrow(|[0-9]+)\-up\.png/)){
          var imgSrc = icnObj.attr('src').replace(/\-arrow(|[0-9]+)\-up\.png/,'-arrow$1-down.png');
          icnObj.attr('src',imgSrc);
          icnObj.attr('alt','↓');
        }
      }
    }
    return false;
  });





});