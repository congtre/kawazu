jQuery(function($){


  csnkslider_archive('nkslider');


  var defW = $(window).width();
  $(window).on('resize',function(){
    var nowW = $(window).width();
    if(nowW != defW){
      defW = nowW;

      csnkslider_archive('nkslider');

    }
  });


  function csnkslider_archive(setSlideCode){

    var baseCode = '.boxCsnkSliderArchive';

    //console.log('test:'+setSlideCode);
    var sliderCode = '.'+setSlideCode;

    if($(baseCode+sliderCode).length == 0){
      return false;
    }

    // ini
    $(baseCode+sliderCode).removeClass('noSlide');
    $(baseCode+sliderCode+' .boxSlideOne.clone').remove();
    $(baseCode+sliderCode+' .boxSlideOne').css('width','');
    $(baseCode+sliderCode+' .boxSlideOne').css('height','');
    $(baseCode+sliderCode+' .boxSlideOne').css('margin-right','');
    $(baseCode+sliderCode+' .boxSlideLine').css('width','');
    $(baseCode+sliderCode+' .boxSlideLine').css('left','');
    $(baseCode+sliderCode+' .boxSlideList').css('height','');
    $(baseCode+sliderCode).css('height','');
    $(baseCode+sliderCode+' .slideNaviL').css('display','');
    $(baseCode+sliderCode+' .slideNaviR').css('display','');
    // ini End

    // setting
    if($('.isPc').css('width') == '1px'){
      if(setSlideCode == 'nkslider'){
        var dispNum = 3;
      }
      else{
        var dispNum = 5;
      }
    }else{
      if(setSlideCode == 'nkslider'){
        var dispNum = 2;
      }
      else{
        var dispNum = 1;
      }
    }
    // setting End


    var oneW = $(baseCode+sliderCode+' .boxSlideOne').outerWidth();
    var oneMaxH = $(baseCode+sliderCode+' .boxSlideOne').outerHeight();
    var nowOneH = oneMaxH;
    var cnt = 0;
    $(baseCode+sliderCode+' .boxSlideOne').each(function(){
      ++cnt;
      $(this).attr('slidenum', cnt);
      var nowOneH = $(this).outerHeight();
      //console.log('now:'+nowOneH);
      if(oneMaxH < nowOneH){
        oneMaxH = nowOneH;
      }
    });
    var oneH = oneMaxH;
    var oneMR = parseInt($(baseCode+sliderCode+' .boxSlideOne').css('margin-right'));
    var oneAllW = oneW + oneMR;

    //console.log('oneW:'+oneW+'/oneH:'+oneH+'/oneMR:'+oneMR);

    var slideLine = $(baseCode+sliderCode+' .boxSlideLine');
    var allNumChk = $(baseCode+sliderCode+' .boxSlideOne').length;

    if($(baseCode+sliderCode+' .boxSlideNavi .txtNumAll').length > 0){
      $(baseCode+sliderCode+' .boxSlideNavi .txtNumAll').text(allNumChk);
    }

    if($(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi').length > 0){
      $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li').remove();
      for(var i = 0; i < allNumChk; ++i){
        $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi').append('<li></li>');
        if(i == 0){
          $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li').addClass('current');
        }
      }
    }

    if($(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi').length > 0){
      $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li').remove();
      for(var i = 1; i <= allNumChk; ++i){
        $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi').append('<li>'+i+'</li>');
        if(i == 1){
          $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li').addClass('current');
        }
      }
    }

    if(allNumChk > dispNum){
      var slideLineClone;
      /*
      var slideLineClone = slideLine.children().clone();
      slideLineClone.addClass('clone');
      slideLine.append(slideLineClone);*/
      if(!$(baseCode+sliderCode+' .boxSlideOne').hasClass('step1')){
        /*slideLineClone = slideLine.children().clone();
        slideLineClone.addClass('clone');
        slideLine.append(slideLineClone);*/

        $(baseCode+sliderCode+' .boxSlideOne:first-child').addClass('step1').before($(baseCode+sliderCode+' .boxSlideOne:last-child'));
      }
      slideLine.css('left','-'+oneAllW+'px');
    }
    if(allNumChk <= dispNum){
      $(baseCode+sliderCode+' .boxSlideOne').removeClass('current');
      $(baseCode+sliderCode+' .boxSlideOne:nth-child(1)').addClass('current');
      $(baseCode+sliderCode).addClass('noSlide');
      $(baseCode+sliderCode+' .slideNaviL').css('display','none');
      $(baseCode+sliderCode+' .slideNaviR').css('display','none');
    }
    else{
      $(baseCode+sliderCode+' .boxSlideOne').removeClass('current');
      $(baseCode+sliderCode+' .boxSlideOne:nth-child(2)').addClass('current');
    }

    if($(baseCode+sliderCode+'.typeViewer').length > 0 && $(baseCode+sliderCode+'.typeViewer .boxSlideViewer').length > 0){
      $(baseCode+sliderCode+'.typeViewer .boxSlideViewer').empty();
      $(baseCode+sliderCode+'.typeViewer .boxSlideOne.current a').clone().appendTo($(baseCode+sliderCode+'.typeViewer .boxSlideViewer'));
    }


    var slideOne = $(baseCode+sliderCode+' .boxSlideOne');
    var allNum = slideOne.length;

    slideOne.css('width',oneW+'px');
    slideOne.css('height',oneH+'px');
    slideOne.css('margin-right',oneMR+'px');

    var lineW = (oneW * allNum) + (oneMR * allNum);
    slideLine.css('width',lineW+'px');
    $(baseCode+sliderCode+' .boxSlideList').css('height',oneH+'px');

    $(baseCode+sliderCode+' .slideNaviL').off('click');
    $(baseCode+sliderCode+' .slideNaviL').on('click',function(){
      //slideLine.css('left','-'+(oneAllW*2)+'px');
      //$(baseCode+sliderCode+' .boxSlideOne:first-child').before($(baseCode+sliderCode+' .boxSlideOne:last-child'));
      //slideLine.animate({left:'-'+oneAllW+'px'},{duration:1000,queue:false});
      
      slideLine.animate({
        left:0
      },{
        duration:1000,
        queue:false,
        complete:function(){
          slideLine.css('left','-'+oneAllW+'px');
          $(baseCode+sliderCode+' .boxSlideOne:first-child').before($(baseCode+sliderCode+' .boxSlideOne:last-child'));
        }
      });
      //$(baseCode+sliderCode+' .boxSlideOne:first-child').before($(baseCode+sliderCode+' .boxSlideOne:last-child'));

      $(baseCode+sliderCode+' .boxSlideOne').removeClass('current');
      $(baseCode+sliderCode+' .boxSlideOne:nth-child(1)').addClass('current');

      if($(baseCode+sliderCode+' .boxSlideNavi .txtNumCurrent').length > 0){
        $(baseCode+sliderCode+' .boxSlideNavi .txtNumCurrent').text($(baseCode+sliderCode+' .boxSlideOne:nth-child(2)').attr('slidenum'));
      }

      var currentSlideNo = $(baseCode+sliderCode+' .boxSlideOne:nth-child(1)').attr('slidenum');

      if($(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li').length > 0){
        $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li').removeClass('current');
        $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li:nth-child('+currentSlideNo+')').addClass('current');
      }

      if($(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li').length > 0){
        $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li').removeClass('current');
        $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li:nth-child('+currentSlideNo+')').addClass('current');
      }

      if($(baseCode+sliderCode+'.typeViewer').length > 0 && $(baseCode+sliderCode+'.typeViewer .boxSlideViewer').length > 0){
        $(baseCode+sliderCode+'.typeViewer .boxSlideViewer').empty();
        $(baseCode+sliderCode+'.typeViewer .boxSlideOne.current a').clone().appendTo($(baseCode+sliderCode+'.typeViewer .boxSlideViewer'));
      }

      //console.log('left:'+oneAllW);
    });

    $(baseCode+sliderCode+' .slideNaviR').off('click');
    $(baseCode+sliderCode+' .slideNaviR').on('click',function(){
      slideLine.css('left','0');
      $(baseCode+sliderCode+' .boxSlideOne:last-child').after($(baseCode+sliderCode+' .boxSlideOne:first-child'));
      slideLine.animate({left:'-'+oneAllW+'px'},{duration:1000,queue:false});

      $(baseCode+sliderCode+' .boxSlideOne').removeClass('current');
      $(baseCode+sliderCode+' .boxSlideOne:nth-child(2)').addClass('current');

      if($(baseCode+sliderCode+' .boxSlideNavi .txtNumCurrent').length > 0){
        $(baseCode+sliderCode+' .boxSlideNavi .txtNumCurrent').text($(baseCode+sliderCode+' .boxSlideOne:nth-child(2)').attr('slidenum'));
      }

      var currentSlideNo = $(baseCode+sliderCode+' .boxSlideOne:nth-child(2)').attr('slidenum');

      if($(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li').length > 0){
        $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li').removeClass('current');
        $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li:nth-child('+currentSlideNo+')').addClass('current');
      }

      if($(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li').length > 0){
        $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li').removeClass('current');
        $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li:nth-child('+currentSlideNo+')').addClass('current');
      }

      if($(baseCode+sliderCode+'.typeViewer').length > 0 && $(baseCode+sliderCode+'.typeViewer .boxSlideViewer').length > 0){
        $(baseCode+sliderCode+'.typeViewer .boxSlideViewer').empty();
        $(baseCode+sliderCode+'.typeViewer .boxSlideOne.current a').clone().appendTo($(baseCode+sliderCode+'.typeViewer .boxSlideViewer'));
      }

    });



    if($('.isSp').css('width') == '2px' && allNumChk > 1){

      $(baseCode+sliderCode+' .boxSlideOne').on('touchstart', onTouchStart);
      $(baseCode+sliderCode+' .boxSlideOne').on('touchmove', onTouchMove);
      $(baseCode+sliderCode+' .boxSlideOne').on('touchend', onTouchEnd);
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
/*
          slideLine.css('left','-'+(oneAllW*2)+'px');
          $(baseCode+sliderCode+' .boxSlideOne:first-child').before($(baseCode+sliderCode+' .boxSlideOne:last-child'));
          slideLine.animate({left:'-'+oneAllW+'px'},{duration:1000,queue:false});
*/
          slideLine.animate({
            left:0
          },{
            duration:1000,
            queue:false,
            complete:function(){
              slideLine.css('left','-'+oneAllW+'px');
              $(baseCode+sliderCode+' .boxSlideOne:first-child').before($(baseCode+sliderCode+' .boxSlideOne:last-child'));
            }
          });

          $(baseCode+sliderCode+' .boxSlideOne').removeClass('current');
          $(baseCode+sliderCode+' .boxSlideOne:nth-child(1)').addClass('current');

          if($(baseCode+sliderCode+' .boxSlideNavi .txtNumCurrent').length > 0){
            $(baseCode+sliderCode+' .boxSlideNavi .txtNumCurrent').text($(baseCode+sliderCode+' .boxSlideOne:nth-child(2)').attr('slidenum'));
          }

          var currentSlideNo = $(baseCode+sliderCode+' .boxSlideOne:nth-child(1)').attr('slidenum');

          if($(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li').length > 0){
            $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li').removeClass('current');
            $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li:nth-child('+currentSlideNo+')').addClass('current');
          }

          if($(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li').length > 0){
            $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li').removeClass('current');
            $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li:nth-child('+currentSlideNo+')').addClass('current');
          }

          if($(baseCode+sliderCode+'.typeViewer').length > 0 && $(baseCode+sliderCode+'.typeViewer .boxSlideViewer').length > 0){
            $(baseCode+sliderCode+'.typeViewer .boxSlideViewer').empty();
            $(baseCode+sliderCode+'.typeViewer .boxSlideOne.current a').clone().appendTo($(baseCode+sliderCode+'.typeViewer .boxSlideViewer'));
          }

        }// right
        else if(direction_x == 'left'){

          slideLine.css('left','0');
          $(baseCode+sliderCode+' .boxSlideOne:last-child').after($(baseCode+sliderCode+' .boxSlideOne:first-child'));
          slideLine.animate({left:'-'+oneAllW+'px'},{duration:1000,queue:false});

          $(baseCode+sliderCode+' .boxSlideOne').removeClass('current');
          $(baseCode+sliderCode+' .boxSlideOne:nth-child(2)').addClass('current');

          if($(baseCode+sliderCode+' .boxSlideNavi .txtNumCurrent').length > 0){
            $(baseCode+sliderCode+' .boxSlideNavi .txtNumCurrent').text($(baseCode+sliderCode+' .boxSlideOne:nth-child(2)').attr('slidenum'));
          }

          var currentSlideNo = $(baseCode+sliderCode+' .boxSlideOne:nth-child(2)').attr('slidenum');

          if($(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li').length > 0){
            $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li').removeClass('current');
            $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNavi > li:nth-child('+currentSlideNo+')').addClass('current');
          }

          if($(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li').length > 0){
            $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li').removeClass('current');
            $(baseCode+sliderCode+' .boxSlideNavi .ulSlideNumNavi > li:nth-child('+currentSlideNo+')').addClass('current');
          }

          if($(baseCode+sliderCode+'.typeViewer').length > 0 && $(baseCode+sliderCode+'.typeViewer .boxSlideViewer').length > 0){
            $(baseCode+sliderCode+'.typeViewer .boxSlideViewer').empty();
            $(baseCode+sliderCode+'.typeViewer .boxSlideOne.current a').clone().appendTo($(baseCode+sliderCode+'.typeViewer .boxSlideViewer'));
          }

        }// left

      }// onTouchEnd

      function getPosition(event){
        return event.originalEvent.touches[0].pageX;
      }

    }// isSp


  }// func nkslider_for_archive



});