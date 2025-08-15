jQuery(function($){

  let winH = $(window).height();
  let currentScrollY = window.scrollY;
  animation_ini();

  var defW = $(window).width();
  $(window).on('resize',function(){
    var nowW = $(window).width();
    if(nowW != defW){
      defW = nowW;
      winH = $(window).height();
      currentScrollY = window.scrollY;
      animation_ini();
    }
  });

  $(window).on("scroll", function(){
    $('.aniWait:not(.active)').each(function(){
      let targetPosi = $(this).offset().top;
      if($(window).scrollTop() > targetPosi - winH * 0.7){
        $(this).addClass('active');
      }
      else{
        //$(this).removeClass('active');
      }
    });
  });

  function animation_ini(){
    $('.aniWait:not(.active)').each(function(element){
      let targetPosi = $(this).offset().top;
      if(winH > targetPosi || currentScrollY > targetPosi){
        $(this).addClass('active');
      }
    });
  }


/*
  setAnimationActive();

  var defW = $(window).width();
  $(window).on('resize',function(){
    var nowW = $(window).width();
    if(nowW != defW){
      defW = nowW;
      setAnimationActive();
    }
  });


  function setAnimationActive(){
    const winH = $(window).height();
    $(window).on("scroll", function(){
      $('.aniWait:not(.active)').each(function(){
        let targetPosi = $(this).offset().top;
        if($(window).scrollTop() > targetPosi - winH * 0.7){
          $(this).addClass('active');
        }
        else{
          //$(this).removeClass('active');
        }
      });
    });
  }
*/


// aniBaseGrayOff01
  if($('.aniBaseGrayOff01:not(.active)').length > 0){
    $(window).on("scroll", function(){
      $('.aniBaseGrayOff01').each(function(){
        if(!$(this).hasClass('active')){
          var ani01Posi = $(this).offset().top;
          var scroll = $(window).scrollTop();
          var windowH = $(window).height();
          if(scroll > ani01Posi - windowH + windowH / 2){
            $(this).addClass('active');
          }
        }
      });
      //return false;
    });
  }


});