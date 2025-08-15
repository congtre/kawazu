jQuery(function($){


  $(window).on('load',function(){
    setTimeout(function(){
      position_scroll();
      click_position_scroll();
    },100);
  });


  function click_position_scroll(){

    //$('.scroll').on('click',function(){
    $(document).on('click', '.scroll', function(){

      if($('.btnHmbMenu.statusOpen').length > 0){
        $('.btnHmbMenu').removeClass('statusOpen');
      }

      var headerHeight = parseInt($('.boxHeader01').outerHeight());
      if($('.isPc').css('width') == '1px'){
        //headerHeight = 0;
      }

      var toPosi = $(this).attr('href');
      toPosi = toPosi.replace(/\#/,'');

      if(toPosi){
        var target = $('#'+toPosi);
        if(target.hasClass('inView')){
          target = $('#'+toPosi).prev('.inViewHead');
        }
        var position = parseInt(target.offset().top)-headerHeight;
        //console.log('click:'+toPosi+'/target:'+target+'/posi:'+position);
        $("html, body").animate({scrollTop:position},1000,"swing");
      }

      return false;

    });

  }//func click_position_scroll



  function position_scroll(){

    var headerHeight = parseInt($('.boxHeader01').outerHeight());
    if($('.isPc').css('width') == '1px'){
      //headerHeight = 0;
    }
    //console.log('headerH:'+headerHeight);

    var url = location.href;

    var toPosi = '';
    var speed = 1000;
    var param0 = url.split("#");

    if(param0[1]){
      toPosi = param0[1];
    }

    if(!toPosi){
      var param1 = url.split("?posi=");
      if(!param1[1]){
        param1 = url.split("&posi=");
      }
      if(param1[1]){
        var param2 = param1[1].split("&");
        toPosi = param2[0];
      }
      var speed0 = url.split("?posi_spd=");
      if(!speed0[1]){
        speed0 = url.split("&posi_spd=");
      }
      if(speed0[1]){
        speed1 = speed0[1].split("&");
        speed = speed1[0];
      }
    }

    if(toPosi){
      toPosi = toPosi.replace(/\#/,'');
      if(toPosi){
        var target = $('#'+toPosi);
        //console.log('link:'+toPosi);
        var position = parseInt(target.offset().top)-headerHeight;
        $("html, body").animate({scrollTop:position},speed,"swing");
      }
    }

  }// func position_scroll


/*##### Page Top #####*/
  $('#fixPageTop,#pageToTop').on('click', function(){
    $("html, body").stop().animate({scrollTop:0},1000,"swing");
    return false;
  });

  $(window).on("scroll", function(){
    var dispPosi = 800;
    if($('.isSp').css('width') == '2px'){
      dispPosi = 1000;
    }
    if($(this).scrollTop() > dispPosi){
      $('#fixPageTop').slideDown();
    }else{
      $('#fixPageTop').slideUp();
    }
    $('#fixPageTop').click(function(){
      $('body,html').stop().animate({scrollTop:0},1000,"swing");
    });
    return false;
  });


});
