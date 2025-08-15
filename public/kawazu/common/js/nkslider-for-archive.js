jQuery(function($){

  nkslider_for_archive_v2('nkslider');
  nkslider_for_archive_v2('nksliderAbout02');
  nkslider_for_archive_v2('nkslider02');
  nkslider_for_archive_v2('nksliderRecipe');
  nkslider_for_archive_v2('nksliderVoice');

  var defW = $(window).width();
  $(window).on('resize',function(){
    var nowW = $(window).width();
    if(nowW != defW){
      defW = nowW;

      nkslider_for_archive_v2('nkslider');
      nkslider_for_archive_v2('nksliderAbout02');
      nkslider_for_archive_v2('nkslider02');
      nkslider_for_archive_v2('nksliderRecipe');
      nkslider_for_archive_v2('nksliderVoice');

    }
  });



  function nkslider_for_archive_v2(setSlideCode){

    //console.log('test:'+setSlideCode);
    var sliderCode = '.'+setSlideCode;

    if($('.boxSlide'+sliderCode).length == 0){
      return false;
    }

    // ini
    $(sliderCode).removeClass('noSlide');
    $(sliderCode+' .boxSlideOne.clone').remove();
    $(sliderCode+' .boxSlideOne').css('width','');
    $(sliderCode+' .boxSlideOne').css('height','');
    $(sliderCode+' .boxSlideOne').css('margin-right','');
    $(sliderCode+' .boxSlideLine').css('width','');
    $(sliderCode+' .boxSlideLine').css('left','');
    $(sliderCode+' .boxSlideList').css('height','');
    $('.boxSlide'+sliderCode).css('height','');
    $(sliderCode+' .slideNaviL').css('display','');
    $(sliderCode+' .slideNaviR').css('display','');
    // ini End

    // setting
    if($('.isPc').css('width') == '1px'){
      if(setSlideCode == 'nkslider'){
        var dispNum = 4;
      }
      else if(setSlideCode == 'nksliderAbout02'){
        var dispNum = 1;
      }
      else if(setSlideCode == 'nkslider02'){
        var dispNum = 3;
      }
      else if(setSlideCode == 'nksliderRecipe'){
        var dispNum = 4;
      }
      else if(setSlideCode == 'nksliderVoice'){
        var dispNum = 4;
      }
      else{
        var dispNum = 5;
      }
    }else{
      var dispNum = 1;
    }
    // setting End


    var oneW = $(sliderCode+' .boxSlideOne').outerWidth();
    var oneMaxH = $(sliderCode+' .boxSlideOne').outerHeight();
    var nowOneH = oneMaxH;
    var cnt = 0;
    $(sliderCode+' .boxSlideOne').each(function(){
      ++cnt;
      $(this).attr('slidenum', cnt);
      var nowOneH = $(this).outerHeight();
      //console.log('now:'+nowOneH);
      if(oneMaxH < nowOneH){
        oneMaxH = nowOneH;
      }
    });
    var oneH = oneMaxH;
    var oneMR = parseInt($(sliderCode+' .boxSlideOne').css('margin-right'));
    var oneAllW = oneW + oneMR;

    //console.log('oneW:'+oneW+'/oneH:'+oneH+'/oneMR:'+oneMR);

    var slideLine = $(sliderCode+' .boxSlideLine');
    var allNumChk = $(sliderCode+' .boxSlideOne').length;

    if($(sliderCode+'.boxSlide .boxSlideNavi .txtNumAll').length > 0){
      $(sliderCode+'.boxSlide .boxSlideNavi .txtNumAll').text(allNumChk);
    }

    if(allNumChk > dispNum){
      var slideLineClone;
      /*
      var slideLineClone = slideLine.children().clone();
      slideLineClone.addClass('clone');
      slideLine.append(slideLineClone);*/
      if(!$(sliderCode+' .boxSlideOne').hasClass('step1')){
        /*slideLineClone = slideLine.children().clone();
        slideLineClone.addClass('clone');
        slideLine.append(slideLineClone);*/

        $(sliderCode+' .boxSlideOne:first-child').addClass('step1').before($(sliderCode+' .boxSlideOne:last-child'));
      }
      slideLine.css('left','-'+oneAllW+'px');
    }
    if(allNumChk <= dispNum){
      $(sliderCode).addClass('noSlide');
      $(sliderCode+' .slideNaviL').css('display','none');
      $(sliderCode+' .slideNaviR').css('display','none');
    }

    var slideOne = $(sliderCode+' .boxSlideOne');
    var allNum = slideOne.length;

    slideOne.css('width',oneW+'px');
    slideOne.css('height',oneH+'px');
    slideOne.css('margin-right',oneMR+'px');

    var lineW = (oneW * allNum) + (oneMR * allNum);
    slideLine.css('width',lineW+'px');
    $(sliderCode+' .boxSlideList').css('height',oneH+'px');

    $(sliderCode+' .slideNaviL').off('click');
    $(sliderCode+' .slideNaviL').on('click',function(){
      slideLine.css('left','-'+(oneAllW*2)+'px');
      $(sliderCode+' .boxSlideOne:first-child').before($(sliderCode+' .boxSlideOne:last-child'));
      slideLine.animate({left:'-'+oneAllW+'px'},{duration:1000,queue:false});

      if($(sliderCode+'.boxSlide .boxSlideNavi .txtNumCurrent').length > 0){
        $(sliderCode+'.boxSlide .boxSlideNavi .txtNumCurrent').text($(sliderCode+' .boxSlideOne:nth-child(2)').attr('slidenum'));
      }

      console.log('left:'+oneAllW);
    });

    $(sliderCode+' .slideNaviR').off('click');
    $(sliderCode+' .slideNaviR').on('click',function(){
      slideLine.css('left','0');
      $(sliderCode+' .boxSlideOne:last-child').after($(sliderCode+' .boxSlideOne:first-child'));
      slideLine.animate({left:'-'+oneAllW+'px'},{duration:1000,queue:false});

      if($(sliderCode+'.boxSlide .boxSlideNavi .txtNumCurrent').length > 0){
        $(sliderCode+'.boxSlide .boxSlideNavi .txtNumCurrent').text($(sliderCode+' .boxSlideOne:nth-child(2)').attr('slidenum'));
      }

    });



    if($('.isSp').css('width') == '2px' && allNumChk > 1){

      $(sliderCode+' .boxSlideList').on('touchstart', onTouchStart);
      $(sliderCode+' .boxSlideList').on('touchmove', onTouchMove);
      $(sliderCode+' .boxSlideList').on('touchend', onTouchEnd);
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

        if(direction_x == 'right'){

          slideLine.css('left','-'+(oneAllW*2)+'px');
          $(sliderCode+' .boxSlideOne:first-child').before($(sliderCode+' .boxSlideOne:last-child'));
          slideLine.animate({left:'-'+oneAllW+'px'},{duration:1000,queue:false});

          if($(sliderCode+'.boxSlide .boxSlideNavi .txtNumCurrent').length > 0){
            $(sliderCode+'.boxSlide .boxSlideNavi .txtNumCurrent').text($(sliderCode+' .boxSlideOne:nth-child(2)').attr('slidenum'));
          }

        }// right
        else if(direction_x == 'left'){

          slideLine.css('left','0');
          $(sliderCode+' .boxSlideOne:last-child').after($(sliderCode+' .boxSlideOne:first-child'));
          slideLine.animate({left:'-'+oneAllW+'px'},{duration:1000,queue:false});

          if($(sliderCode+'.boxSlide .boxSlideNavi .txtNumCurrent').length > 0){
            $(sliderCode+'.boxSlide .boxSlideNavi .txtNumCurrent').text($(sliderCode+' .boxSlideOne:nth-child(2)').attr('slidenum'));
          }

        }// left

      }// onTouchEnd

      function getPosition(event){
        return event.originalEvent.touches[0].pageX;
      }

    }// isSp


  }// func nkslider_for_archive



});