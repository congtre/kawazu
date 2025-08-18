jQuery(function($){

  var containerWidth;
  var contentWidth;
  var sliderPadding;


  var interval = {};

  $(window).on('load', function(){
    //csnkslider_horizontal();
  });

  setTimeout(function(){
    csnkslider_horizontal();
  },200);

  var timer = false;
  $(window).on('resize',function(){
    if(timer !== false){
      clearTimeout(timer);
    }
    timer = setTimeout(function(){
      csnkslider_horizontal();
    },200);
  });



  function csnkslider_horizontal(){

    $('div[data-csnkslider-horizontal-code]').each(function(){

      code = $(this).attr('data-csnkslider-horizontal-code');
      code = '.'+code;
      //console.log('code:'+code);

      $('.boxCsnksliderHorizontal'+code).css('height', '');
      $('.boxCsnksliderHorizontal'+code+' .slider').css('width', '');
      $('.boxCsnksliderHorizontal'+code+' .slider').css('padding', '');
      $('.boxCsnksliderHorizontal'+code+' .slider').css('left', '');
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').css('width', '');
      $('.boxCsnksliderHorizontal'+code+' .slider .slides').css('margin-left', '');
      $('.boxCsnksliderHorizontal'+code+' .slider .slides').css('width', '');
      $('.boxCsnksliderHorizontal'+code+' .slider .slides').css('left', '');

      contentWidth = $('.boxCsnksliderHorizontal'+code).width();
      //console.log('contentWidth:'+contentWidth);
      containerWidth = $('#container').width();
      //console.log('windowWidth:'+containerWidth);

      var addTag = '';
      if($('.boxCsnksliderHorizontal'+code+' .slider .slides > li .imgMain.dPcInline').length > 0 && $('.isPc').css('width') == '1px'){
        addTag = '.dPcInline';
      }
      else if($('.boxCsnksliderHorizontal'+code+' .slider .slides > li .imgMain.dSpInline').length > 0 && $('.isSp').css('width') == '2px'){
        addTag = '.dSpInline';
      }

      var minImgH;
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li .imgMain'+addTag).each(function(){
        var imgHeight = $(this).height();
        if(!minImgH || minImgH > imgHeight){
          minImgH = imgHeight;
        }
      });
      $('.boxCsnksliderHorizontal'+code).css('height', minImgH+'px');


      if($('.boxCsnksliderHorizontal'+code+' .slider .slides > li.clone').length == 0){
        var cnt = 0;
        $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').each(function(){
          ++cnt;
          $(this).attr('slidenum', cnt);
        });

        var clone = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').clone(true).addClass('clone');
        clone.clone(true).insertAfter($('.boxCsnksliderHorizontal'+code+' .slider .slides > li:last'));
      }

      var slideNum = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').length;
      var marginLeftNum = slideNum / 2;

      sliderPadding = Math.ceil((parseInt(containerWidth)-contentWidth) / 2);
      var leftValue = '-'+sliderPadding;

      $('.boxCsnksliderHorizontal'+code+' .slider').css('width', containerWidth+'px');
      $('.boxCsnksliderHorizontal'+code+' .slider').css('padding', '0 '+sliderPadding+'px');
      $('.boxCsnksliderHorizontal'+code+' .slider').css('left', leftValue+'px');
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').css('width', contentWidth+'px');
      $('.boxCsnksliderHorizontal'+code+' .slider .slides').css('margin-left', '-'+parseInt(contentWidth)*parseInt(marginLeftNum)+'px');

      var currentPosi = marginLeftNum + 1;
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').removeClass('current');
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li:nth-child('+currentPosi+')').addClass('current');

      slidesWidth = contentWidth * slideNum;
      $('.boxCsnksliderHorizontal'+code+' .slider .slides').css('width', slidesWidth+'px');


      if($(this).find('.ulSlideNavi').length > 0){
        $(this).find('.ulSlideNavi > li').remove();
        for(var i = 0; i < slideNum / 2; ++i){
          var disp_i = i + 1;
          $(this).find('.ulSlideNavi').append('<li>'+disp_i+'</li>');
          if(i == 0){
            //$(this).find('.slides > li:first-child').addClass('current');
            $(this).find('.ulSlideNavi > li:first-child').addClass('current');
          }
        }
        if($(this).find('.sliderNaviPrev').length > 0){
          $(this).find('.sliderNaviPrev').css({'cssText': 'display: inline !important'});
        }
        if($(this).find('.sliderNaviNext').length > 0){
          $(this).find('.sliderNaviNext').css({'cssText': 'display: inline !important'});
        }
      }


      if(slideNum > 1){
        //autoSlide(code);
      }


    });//each slider

  }// csnkslider_horizontal



  function autoSlide(code){
    if(code == '') return false;
    clearInterval(interval[code]);
    interval[code] = setInterval(function(){
      slider_slide(code);
    },5000);
  }// func autoSlide



  function autoSlideStop(code){
    if(code == '') return false;
    clearInterval(interval[code]);
  }



  $('.boxCsnksliderHorizontal').on('mouseenter', function(){
    var code = $(this).attr('data-csnkslider-horizontal-code');
    code = '.'+code;
    autoSlideStop(code);
  });

  $('.boxCsnksliderHorizontal').on('mouseleave', function(){
    var code = $(this).attr('data-csnkslider-horizontal-code');
    code = '.'+code;
    autoSlide(code);
  });



  $('.boxCsnksliderHorizontal .sliderNaviNext').on('click', function(){
    var code = $(this).parents('.boxCsnksliderHorizontal').attr('data-csnkslider-horizontal-code');
    code = '.'+code;
    slider_slide(code);
  });

  $('.boxCsnksliderHorizontal .sliderNaviPrev').on('click', function(){
    var code = $(this).parents('.boxCsnksliderHorizontal').attr('data-csnkslider-horizontal-code');
    code = '.'+code;
    slider_slide_prev(code);
  });



  function slider_slide(code){
    var slideWidthPx = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').outerWidth();
    $('.boxCsnksliderHorizontal'+code+' .slider .slides > li:last-child').after($('.boxCsnksliderHorizontal'+code+' .slider .slides > li:first-child'));
    $('.boxCsnksliderHorizontal'+code+' .slider .slides').css('left', (parseInt(contentWidth)+parseInt(sliderPadding))+'px');

    var slideNum = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').length;
    var currentPosi = slideNum / 2 + 1;
    $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').removeClass('current');
    $('.boxCsnksliderHorizontal'+code+' .slider .slides > li:nth-child('+currentPosi+')').addClass('current');

    var slideNo = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li.current').attr('slidenum');
    $('.boxCsnksliderHorizontal'+code+' .ulSlideNavi > li').removeClass('current');
    $('.boxCsnksliderHorizontal'+code+' .ulSlideNavi > li:nth-child('+slideNo+')').addClass('current');

    $('.boxCsnksliderHorizontal'+code+' .slider .slides').stop().animate(
    {
      left: '-='+(slideWidthPx)
    },
    {
      duration: 1500,
    });// animate
  }// slider_slide

  function slider_slide_prev(code){
    var slideWidthPx = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').outerWidth();
    $('.boxCsnksliderHorizontal'+code+' .slider .slides > li:first-child').before($('.boxCsnksliderHorizontal'+code+' .slider .slides > li:last-child'));
    //$('.boxCsnksliderHorizontal'+code+' .slider .slides').css('left','-'+(parseInt(contentWidth)-parseInt(sliderPadding))+'px');
    $('.boxCsnkSliderHorizontal'+code+' .slider .slides').css('left',((parseInt(contentWidth)-parseInt(sliderPadding))*-1)+'px');

    var slideNum = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').length;
    var currentPosi = slideNum / 2 + 1;
    $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').removeClass('current');
    $('.boxCsnksliderHorizontal'+code+' .slider .slides > li:nth-child('+currentPosi+')').addClass('current');

    var slideNo = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li.current').attr('slidenum');
    $('.boxCsnksliderHorizontal'+code+' .ulSlideNavi > li').removeClass('current');
    $('.boxCsnksliderHorizontal'+code+' .ulSlideNavi > li:nth-child('+slideNo+')').addClass('current');

    $('.boxCsnksliderHorizontal'+code+' .slider .slides').stop().animate(
    {
      left: '+='+(slideWidthPx)
    },
    {
      duration: 1500,
    });// animate
  }// slider_slide_prev




  $(document).on('click', '.boxCsnksliderHorizontal .ulSlideNavi > li', function(){
    var code = $(this).parents('.boxCsnksliderHorizontal').attr('data-csnkslider-horizontal-code');
    code = '.'+code;
    var jumpNum = $(this).index() + 1;
    var currentSlide = $('.boxCsnksliderHorizontal'+code+' .ulSlideNavi > li.current').index() + 1;
    if(jumpNum > currentSlide){
      slider_slide_jump(code, jumpNum);
      //console.log('over');
    }
    else if(jumpNum <= currentSlide){
      slider_slide_prev_jump(code, jumpNum);
      //console.log('under');
    }
  });


  function slider_slide_jump(code, jumpNum){
    var slideWidthPx = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').outerWidth();
    var slideNum = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').length;

    for(i=0; i<slideNum; i++){
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li:last-child').after($('.boxCsnksliderHorizontal'+code+' .slider .slides > li:first-child'));
      $('.boxCsnksliderHorizontal'+code+' .slider .slides').css('left', (parseInt(contentWidth)+parseInt(sliderPadding))+'px');

      var currentPosi = slideNum / 2 + 1;
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').removeClass('current');
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li:nth-child('+currentPosi+')').addClass('current');

      var slideNo = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li.current').attr('slidenum');
      $('.boxCsnksliderHorizontal'+code+' .ulSlideNavi > li').removeClass('current');
      $('.boxCsnksliderHorizontal'+code+' .ulSlideNavi > li:nth-child('+slideNo+')').addClass('current');

      $('.boxCsnksliderHorizontal'+code+' .slider .slides').stop().animate(
      {
        left: '-='+(slideWidthPx)
      },
      {
        duration: 500,
      });// animate

      if(slideNo == jumpNum){
        return false;
      }
    }//for
  }// slider_slide_jump


  function slider_slide_prev_jump(code, jumpNum){
    var slideWidthPx = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').outerWidth();
    var slideNum = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').length;

    for(i=0; i<slideNum; i++){
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li:first-child').before($('.boxCsnksliderHorizontal'+code+' .slider .slides > li:last-child'));
      //$('.boxCsnksliderHorizontal'+code+' .slider .slides').css('left','-'+(parseInt(contentWidth)-parseInt(sliderPadding))+'px');
      $('.boxCsnkSliderHorizontal'+code+' .slider .slides').css('left',((parseInt(contentWidth)-parseInt(sliderPadding))*-1)+'px');

      var currentPosi = slideNum / 2 + 1;
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li').removeClass('current');
      $('.boxCsnksliderHorizontal'+code+' .slider .slides > li:nth-child('+currentPosi+')').addClass('current');

      var slideNo = $('.boxCsnksliderHorizontal'+code+' .slider .slides > li.current').attr('slidenum');
      $('.boxCsnksliderHorizontal'+code+' .ulSlideNavi > li').removeClass('current');
      $('.boxCsnksliderHorizontal'+code+' .ulSlideNavi > li:nth-child('+slideNo+')').addClass('current');

      $('.boxCsnksliderHorizontal'+code+' .slider .slides').stop().animate(
      {
        left: '+='+(slideWidthPx)
      },
      {
        duration: 500,
      });// animate

      if(slideNo == jumpNum){
        return false;
      }
    }//for
  }// slider_slide_prev_jump



});
