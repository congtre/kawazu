jQuery(function($){

  $('.boxCsnkImgSwitch01 .boxImgMain .imgMain').css('opacity','0');
  $('.boxCsnkImgSwitch01 .boxImgSubOne .imgSub').css('opacity','0');


  csnkImgSwitch01_ini();
  csnkImgSwitch01_main_ini();
  csnkImgSwitch01_sub_ini();



  var interval = {};
  var slideNo = 0;
  var slideId = '';
  $('.boxCsnkImgSwitch01').each(function(){
    ++slideNo;
    //console.log('No'+slideNo);
    slideId = 'imgSwitch01Id'+slideNo;
    $(this).attr('id', slideId);
    //var slider_code = $(this).attr('data-nkslider-fadein-code');
    var slide_num = $(this).find('.boxImgSub .boxImgSubOne').length;
    //console.log('Scode:'+slider_code);
    //console.log('Length:'+slide_num);
    if(slide_num > 1){
      //autoSlide(slider_code);
      autoSlide(slideId);
    }
  });

  function autoSlide(id){
    if(id == '') return false;
    clearInterval(interval[id]);
    interval[id] = setInterval(function(){
      fadein_slide(id);
    }, 5000);
  }

  function autoSlideStop(id){
    if(id == '') return false;
    clearInterval(interval[id]);
  }

  $('.boxCsnkImgSwitch01').on('mouseenter', function(){
    autoSlideStop($(this).attr('id'));
  });
  $('.boxCsnkImgSwitch01').on('mouseleave', function(){
    autoSlide($(this).attr('id'));
  });


  function csnkImgSwitch01_ini(){
    $('.boxCsnkImgSwitch01').each(function(){
      $(this).find('.boxImgSub .boxImgSubOne:first-child').addClass('current');
    });
  }


  function csnkImgSwitch01_main_ini(id){
    //console.log('id:'+ id);
    var target_obj = '.boxCsnkImgSwitch01';
    var target_obj_blur = '.boxCsnkImgSwitch01.typeBlurBg';
    if(id){
      var add_id = '#'+id;
      target_obj = '.boxCsnkImgSwitch01#'+id;
    }

    $(target_obj+' .boxImgMain .imgMain').removeClass('verticalImg');
    $(target_obj+' .boxImgMain .imgMain').removeClass('horizontalImg');

    var image = new Image();
    image.src = $(target_obj+' .boxImgMain .imgMain').attr('src');
    //console.log('src:'+image.src);
    image.onload = function(){
      var imageWidth = image.naturalWidth;
      var imageHeight = image.naturalHeight;
      var imgSize = (imageHeight*100)/imageWidth;
      //console.log('src:'+image.src+'/width:'+imageWidth+'/Height:'+imageHeight+'/'+imgSize);
      var boxW = $(target_obj+' .boxImgMain').width();
      var boxH = $(target_obj+' .boxImgMain').outerHeight();
      var boxSize = (boxH*100)/boxW;
      console.log(target_obj+'/boxW:'+boxW+'/boxH:'+boxH+'/boxSize:'+boxSize);
      if(imgSize < boxSize){
        $(target_obj+' .boxImgMain .imgMain').addClass('verticalImg').css('opacity','1');
      }
      else{
        $(target_obj+' .boxImgMain .imgMain').addClass('horizontalImg').css('opacity','1');
      }
      if($(target_obj_blur).length > 0){
        $(target_obj+' .boxImgMain').css('background-image', 'url('+image.src+')');
      }
    }
  }


  function csnkImgSwitch01_sub_ini(){
    $('.boxCsnkImgSwitch01 .boxImgSubOne').each(function(){

      $(this).find('.imgSub').removeClass('verticalImg');
      $(this).find('.imgSub').removeClass('horizontalImg');

      var this1 = $(this);
      var image = new Image();
      image.src = $(this).find('.imgSub').attr('src');
      image.onload = function(){
        var imageWidth = image.naturalWidth;
        var imageHeight = image.naturalHeight;
        var imgSize = (imageHeight*100)/imageWidth;
        //console.log('src:'+image.src+'/width:'+imageWidth+'/Height:'+imageHeight+'/'+imgSize);
        var boxW = this1.width();
        var boxH = this1.outerHeight();
        var boxSize = (boxH*100)/boxW;
        //console.log('boxW:'+boxW+'/boxH:'+boxH+'/boxSize:'+boxSize);
        if(imgSize < boxSize){
          this1.find('.imgSub').addClass('verticalImg').css('opacity','1');
        }
        else{
          this1.find('.imgSub').addClass('horizontalImg').css('opacity','1');
        }
        if($('.boxCsnkImgSwitch01.typeBlurBg').length > 0){
          this1.css('background-image', 'url('+image.src+')');
        }
      }
    });
  }


  $('.boxCsnkImgSwitch01 .boxImgSubOne').on('click', function(){
    var myThis = $(this);
    var id = $(this).parents('.boxCsnkImgSwitch01').attr('id');

    $(this).parents('.boxCsnkImgSwitch01').find('.boxImgSub .boxImgSubOne').removeClass('current');
    $(this).addClass('current');

    var chk_img_url = $(this).find('.imgSub').attr('src');

    $(this).parents('.boxCsnkImgSwitch01').find('.boxImgMain .imgMain').css('transition', 'opacity 0.3s linear');
    $(this).parents('.boxCsnkImgSwitch01').find('.boxImgMain .imgMain').css('opacity', '0');
    setTimeout( function() {
      myThis.parents('.boxCsnkImgSwitch01').find('.boxImgMain .imgMain').attr('src', chk_img_url);
    }, 200 );
    if($(this).parents('.boxCsnkImgSwitch01.typeBlurBg').length > 0){
      $(this).parents('.boxCsnkImgSwitch01').find('.boxImgMain').css('background-image', 'url('+chk_img_url+')');
    }
    var caption;
    if($(this).find('.pCaption').length > 0){
      caption =  $(this).find('.pCaption').text();
      $(this).parents('.boxCsnkImgSwitch01').find('.boxImgMain .boxCaption p').text(caption);
    }

    setTimeout( function() {
      csnkImgSwitch01_main_ini(id);
    }, 180 );

  });


  function fadein_slide(id){
    if(id == '') return false;
    //console.log('ID:' + id);
    var slideObj = $('.boxCsnkImgSwitch01#'+id);
    var slideBlurObj = $('.boxCsnkImgSwitch01.typeBlurBg#'+id);
    var slideOneCurrentObj = $('.boxCsnkImgSwitch01#'+id+' .boxImgSubOne.current');

    var allSlideNum = slideObj.find('.boxImgSub .boxImgSubOne').length;
    //console.log('allSlideNum:' + allSlideNum);
    var currentIndex = slideOneCurrentObj.index();
    var currentSlideNum = currentIndex + 1;
    //console.log('currentSlideNum:' + currentSlideNum);
    var nextSlideNum = currentSlideNum + 1;
    if(currentSlideNum == allSlideNum){
      nextSlideNum = 1;
    }

    slideObj.find('.boxImgSub .boxImgSubOne').removeClass('current');
    var slideNextObj = slideObj.find('.boxImgSub .boxImgSubOne:nth-child('+nextSlideNum+')');
    slideNextObj.addClass('current');

    var chk_img_url = slideNextObj.find('.imgSub').attr('src');

    slideObj.find('.boxImgMain .imgMain').css('transition', 'opacity 0.3s linear');
    slideObj.find('.boxImgMain .imgMain').css('opacity', '0');
    setTimeout( function() {
      slideObj.find('.boxImgMain .imgMain').attr('src', chk_img_url);
    }, 200 );

    if(slideBlurObj.length > 0){
      slideObj.find('.boxImgMain').css('background-image', 'url('+chk_img_url+')');
    }

    var caption;
    if(slideNextObj.find('.pCaption').length > 0){
      caption =  slideNextObj.find('.pCaption').text();
      slideObj.find('.boxImgMain .boxCaption p').text(caption);
    }

    setTimeout( function() {
      csnkImgSwitch01_main_ini(id);
    }, 180 );

  }


  function fadein_slide_prev(id){
    if(id == '') return false;
    //console.log('ID:' + id);
    var slideObj = $('.boxCsnkImgSwitch01#'+id);
    var slideBlurObj = $('.boxCsnkImgSwitch01.typeBlurBg#'+id);
    var slideOneCurrentObj = $('.boxCsnkImgSwitch01#'+id+' .boxImgSubOne.current');

    var allSlideNum = slideObj.find('.boxImgSub .boxImgSubOne').length;
    //console.log('allSlideNum:' + allSlideNum);
    var currentIndex = slideOneCurrentObj.index();
    var currentSlideNum = currentIndex + 1;
    //console.log('currentSlideNum:' + currentSlideNum);
    var nextSlideNum = currentSlideNum - 1;
    if(currentSlideNum == 1){
      nextSlideNum = allSlideNum;
    }

    slideObj.find('.boxImgSub .boxImgSubOne').removeClass('current');
    var slideNextObj = slideObj.find('.boxImgSub .boxImgSubOne:nth-child('+nextSlideNum+')');
    slideNextObj.addClass('current');

    var chk_img_url = slideNextObj.find('.imgSub').attr('src');

    slideObj.find('.boxImgMain .imgMain').css('transition', 'opacity 0.3s linear');
    slideObj.find('.boxImgMain .imgMain').css('opacity', '0');
    setTimeout( function() {
      slideObj.find('.boxImgMain .imgMain').attr('src', chk_img_url);
    }, 200 );

    if(slideBlurObj.length > 0){
      slideObj.find('.boxImgMain').css('background-image', 'url('+chk_img_url+')');
    }

    var caption;
    if(slideNextObj.find('.pCaption').length > 0){
      caption =  slideNextObj.find('.pCaption').text();
      slideObj.find('.boxImgMain .boxCaption p').text(caption);
    }

    setTimeout( function() {
      csnkImgSwitch01_main_ini(id);
    }, 180 );

  }



  if($('.isSp').css('width') == '2px'){

    $('.boxCsnkImgSwitch01 .boxImgMain .imgMain').on('touchstart', onTouchStart);
    $('.boxCsnkImgSwitch01 .boxImgMain .imgMain').on('touchmove', onTouchMove);
    $('.boxCsnkImgSwitch01 .boxImgMain .imgMain').on('touchend', onTouchEnd);

    var direction_x, position;

    function onTouchStart(event){
      position = getPosition(event);
      direction_x = '';
    }

    function onTouchMove(event){
      if(position - getPosition(event) > 70){
        direction_x = 'left';
      }
      else if(position - getPosition(event) < -70){
        direction_x = 'right';
      }
    }

    function onTouchEnd(event){
      var id = $(this).parents('.boxCsnkImgSwitch01').attr('id');
      if(direction_x == 'right'){
        fadein_slide_prev(id);
        }// right
      else if(direction_x == 'left'){
        fadein_slide(id);
      }// left
    }// onTouchEnd

    function getPosition(event){
      return event.originalEvent.touches[0].pageX;
    }

  }// isSp



});