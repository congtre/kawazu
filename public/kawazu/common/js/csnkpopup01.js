jQuery(function($){


  var wp_theme_url = $('link#style-css').attr('href').replace(/\/style\.css.*$/,'/');
  //console.log('This:'+wp_theme_url);


  var defW = $(window).width();
  $(window).on('resize',function(){
    var nowW = $(window).width();
    if(nowW != defW){
      defW = nowW;
      if($('.boxCsNkPopup01Bg').css('display') == 'block'){
        $('.boxCsNkPopup01Bg').css({
        'width': $(window).width(),
        'height': document.documentElement.scrollHeight
        });
      }
    }
  });


  $(document).on('click','.btnCsNkPopup01', function(){
    if($('.boxCsNkPopup01Bg').length > 0){
      $('.boxCsNkPopup01Bg').remove();
    }
    $('.boxCsNkPopup01').css('display', 'none');
    csnkpopup01($(this));
    return false;
  });


  function csnkpopup01(mythis1){

    var myThis = mythis1;
    var popupType;

    if(myThis.hasClass('typeImg')){
      popupType = 'image';
    }
    else if(myThis.hasClass('typeBox')){
      popupType = 'box';
    }

    if(!popupType) return false;

    $('body').append('<div class="boxCsNkPopup01Bg"></div>');


    if(popupType == 'image'){

      var imgsrc = myThis.next('img').attr('src');
      if(myThis.hasClass('typeIn')){
        imgsrc = myThis.find('img').attr('src');
        console.log('test:'+imgsrc);
      }
      else if(myThis.hasClass('typeThis')){
        if(myThis.attr('data-image-max')){
          imgsrc = myThis.attr('data-image-max');
        }else{
          imgsrc = myThis.attr('src');
        }
      }
      else if(myThis.hasClass('typeId')){
        var imgId = myThis.attr('data-popup-id');
        imgsrc = $('#'+imgId).attr('src');
      }

      //$('body').append('<div class="boxCsNkPopup01"><img src="" class="imgCsNkPopup01"><span class="btnCsNkPopup01Close"><i class="fa fa-window-close" aria-hidden="true"></i></span></div>');
      //$('body').append('<div class="boxCsNkPopup01"><img src="" class="imgCsNkPopup01"></div>');
      $('body').append('<img src="" class="imgCsNkPopup01">');
      $('.imgCsNkPopup01').attr('src',imgsrc);

    }//Type image


    var target_id;
    if(popupType == 'box'){
      if(myThis.attr('data-popup-id')){
        target_id = myThis.attr('data-popup-id');
      }
      else{
        return false;
      }
    }//Type box


    $('.boxCsNkPopup01Bg').css({
      'width': $(window).width(),
      'height': document.documentElement.scrollHeight
    });

    $('.boxCsNkPopup01Bg').show();

    if(popupType == 'image'){
      $('.imgCsNkPopup01').fadeIn();
    }

    if(popupType == 'box'){
      myThis.parent().find('.btnCsNkPopup01').removeClass('current');
      myThis.addClass('current');

      if(myThis.hasClass('typeFlex')){
        $('#'+target_id).fadeIn().css('display', 'flex');
      }else{
        $('#'+target_id).fadeIn();
      }

      $('#'+target_id).find('img.chkImg').each(function(){
        $(this).removeClass('horizontalImg');
        $(this).removeClass('verticalImg');
        //var src = $(this).attr('src');
        var imgW = $(this).width();
        var imgH = $(this).height();
        var imgSize = (imgH*100)/imgW;
        //console.log('Click:IMG:'+src+'/'+imgW+'/'+imgH+'/'+imgSize);
        var boxW = $(this).parents('.boxChkImg').width();
        var boxH = $(this).parents('.boxChkImg').outerHeight();
        var boxSize = (boxH*100)/boxW;
        //console.log('Click:BOX:'+boxW+'/'+boxH+'/'+boxSize);
        if(imgSize < boxSize){
          $(this).addClass('horizontalImg').css('opacity','1');
        }
        else{
          $(this).addClass('verticalImg').css('opacity','1');
        }
      });


      if(myThis.hasClass('typeSlide') && $('.icnCsNkPopup01Arrow01L').length == 0 && $('.icnCsNkPopup01Arrow01R').length == 0){
        //console.log('slideNo:'+myThis.attr('data-popup-slide-no'));
        if(!myThis.attr('data-popup-slide-no')){
          console.log('step: Add Popup Slide No.');
          var slideCnt = 0;
          myThis.parent().find('.btnCsNkPopup01').each(function(){
            ++slideCnt;
            //console.log('ok11:'+slideCnt);
            $(this).attr('data-popup-slide-no', slideCnt);
          });
        }
        //$('body').append('<img src="'+wp_theme_url+'images/csnk-popup01/csnk-popup01-icn-arrow01-l.png" class="icnCsNkPopup01Arrow01L"><img src="'+wp_theme_url+'images/csnk-popup01/csnk-popup01-icn-arrow01-r.png" class="icnCsNkPopup01Arrow01R">');
        myThis.parent().append('<img src="'+wp_theme_url+'images/csnk-popup01/csnk-popup01-icn-arrow01-l.png" class="icnCsNkPopup01Arrow01L"><img src="'+wp_theme_url+'images/csnk-popup01/csnk-popup01-icn-arrow01-r.png" class="icnCsNkPopup01Arrow01R">');
        //console.log('aaa:'+myThis.attr('data-popup-slide-no'));
        console.log('step: Add Popup Slide Arrow.');
      }
    }

    $(document).off('click','.icnCsNkPopup01Arrow01L');
    $(document).on('click','.icnCsNkPopup01Arrow01L', function(){
      var slideAllNum = myThis.parent().find('.btnCsNkPopup01').length;
      var slideNo = myThis.parent().find('.btnCsNkPopup01.current').attr('data-popup-slide-no');
      var slideId = myThis.parent().find('.btnCsNkPopup01[data-popup-slide-no="'+slideNo+'"]').attr('data-popup-id');
      //console.log('sNo:'+slideNo);

      var prevSlideNo = parseInt(slideNo) - 1;
      if(prevSlideNo < 1){
        prevSlideNo = slideAllNum;
      }
      //console.log('NextNo:'+prevSlideNo);

      var prevSlideId;
      if(myThis.parent().find('.btnCsNkPopup01[data-popup-slide-no="'+prevSlideNo+'"]').length > 0){
        //console.log('NextId:'+$('.btnCsNkPopup01[data-popup-slide-no="'+prevSlideNo+'"]').attr('data-popup-id'));
        prevSlideId = myThis.parent().find('.btnCsNkPopup01[data-popup-slide-no="'+prevSlideNo+'"]').attr('data-popup-id');
      }

      myThis.parent().find('.btnCsNkPopup01').removeClass('current');
      myThis.parent().find('.btnCsNkPopup01[data-popup-slide-no="'+prevSlideNo+'"]').addClass('current');

      $('#'+slideId).fadeOut('slow');
      $('#'+prevSlideId).fadeIn();
    });


    $(document).off('click','.icnCsNkPopup01Arrow01R');
    $(document).on('click','.icnCsNkPopup01Arrow01R', function(){
      var slideAllNum = myThis.parent().find('.btnCsNkPopup01').length;
      var slideNo = myThis.parent().find('.btnCsNkPopup01.current').attr('data-popup-slide-no');
      var slideId = myThis.parent().find('.btnCsNkPopup01[data-popup-slide-no="'+slideNo+'"]').attr('data-popup-id');
      //console.log('sNo:'+slideNo);

      var nextSlideNo = parseInt(slideNo) + 1;
      if(nextSlideNo > slideAllNum){
        nextSlideNo = 1;
      }
      //console.log('NextNo:'+prevSlideNo);

      var nextSlideId;
      if(myThis.parent().find('.btnCsNkPopup01[data-popup-slide-no="'+nextSlideNo+'"]').length > 0){
        //console.log('NextId:'+$('.btnCsNkPopup01[data-popup-slide-no="'+prevSlideNo+'"]').attr('data-popup-id'));
        nextSlideId = myThis.parent().find('.btnCsNkPopup01[data-popup-slide-no="'+nextSlideNo+'"]').attr('data-popup-id');
      }

      myThis.parent().find('.btnCsNkPopup01').removeClass('current');
      myThis.parent().find('.btnCsNkPopup01[data-popup-slide-no="'+nextSlideNo+'"]').addClass('current');

      $('#'+slideId).fadeOut('slow');
      $('#'+nextSlideId).fadeIn();
    });


    $('.boxCsNkPopup01Bg, .btnCsNkPopup01Close, .btnCsNkPopupClose').click(function(){
      if(popupType == 'image'){
        $('.imgCsNkPopup01').fadeOut('slow', function(){ $('.boxCsNkPopup01Bg').fadeOut( function(){ $('.imgCsNkPopup01').remove(); $('.boxCsNkPopup01').remove(); $('.boxCsNkPopup01Bg').remove(); } ); });
      }
      if(popupType == 'box'){
        if(myThis.hasClass('typeSlide') && myThis.parent().find('.btnCsNkPopup01').hasClass('current')){
          var slideId = myThis.parent().find('.btnCsNkPopup01.current').attr('data-popup-id');
          $('#'+slideId).fadeOut('slow', function(){ $('.boxCsNkPopup01Bg').fadeOut( function(){ $('.boxCsNkPopup01Bg').remove(); } ); });
          myThis.parent().find('.btnCsNkPopup01').removeClass('current');
        }else{
          $('#'+target_id).fadeOut('slow', function(){ $('.boxCsNkPopup01Bg').fadeOut( function(){ $('.boxCsNkPopup01Bg').remove(); } ); });
        }
      }
      if($('.icnCsNkPopup01Arrow01L').length > 0){
        $('.icnCsNkPopup01Arrow01L').remove();
      }
      if($('.icnCsNkPopup01Arrow01R').length > 0){
        $('.icnCsNkPopup01Arrow01R').remove();
      }
    });

    return false;

  }//func csnkpopup01



});