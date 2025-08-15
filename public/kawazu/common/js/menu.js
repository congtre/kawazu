jQuery(function($){

  var fixedMenuObj = $('.boxHmbMenu');

  $(window).on('load', function(){
  });

  var defW = $(window).width();
  $(window).on('resize',function(){
    var nowW = $(window).width();
    if(nowW != defW){
      defW = nowW;
      //get_fixed_menu_h();
    }
  });


  function hmb_menu_ini(){
    fixedMenuObj.css('display','');
    if($('.btnHmbMenu').length == 0){
      return false;
    }
    let imgPath = $('.btnHmbMenu').attr('src').replace(/\-btn\-close\.(jpg|png|gif)$/, '-btn.$1');
    $('.btnHmbMenu').attr('src', imgPath);
    $('.btnHmbMenu').removeClass('statusOpen');
  }


  $('.btnHmbMenu').on('click', function(){
    if(fixedMenuObj.css('display') == 'none'){
      fixedMenuObj.slideDown();
      if($(this).prop("tagName") == 'IMG'){
        var imgPath = $(this).attr('src').replace(/\-btn\.(jpg|png|gif)$/, '-btn-close.$1');
        $(this).attr('src', imgPath);
      }
      $(this).addClass('statusOpen');
    }
    else{
      fixedMenuObj.slideUp();
      if($(this).prop("tagName") == 'IMG'){
      var imgPath = $(this).attr('src').replace(/\-btn\-close\.(jpg|png|gif)$/, '-btn.$1');
        $(this).attr('src', imgPath);
      }
      $(this).removeClass('statusOpen');
    }
  });


  $('.btnHmbMenuClose').on('click', function(){
    fixedMenuObj.slideUp();
    var imgPath = $('.btnHmbMenu').attr('src').replace(/\-btn\-close\.(jpg|png|gif)$/, '-btn.$1');
    $('.btnHmbMenu').attr('src', imgPath);
    $('.btnHmbMenu').removeClass('statusOpen');
  });


  fixedMenuObj.find('a[href*="#"]').on('click', function(){
    if(fixedMenuObj.css('display') != 'none'){
      fixedMenuObj.slideUp();
      var imgPath = $('.btnHmbMenu').attr('src').replace(/\-btn\-close\.(jpg|png|gif)$/, '-btn.$1');
      $('.btnHmbMenu').attr('src', imgPath);
      $('.btnHmbMenu').removeClass('statusOpen');
    }
  });



  $('select[name="select_archive"]').change(function(){
    var url = $(this).val();
    if(url.match(/^http(s|)\:\/\//)){
      window.location.href = url;
    }
  });

  set_archive_ym_selected();
  function set_archive_ym_selected(){
    if($('.archive .ttlMv .txtYM').length > 0){
      var txtYM = $('.archive .ttlMv .txtYM').text();
      $('select[name="select_archive"] option').each(function(){
        if(jQuery.trim($(this).text()) == txtYM){
          $(this).prop('selected',true);
          return false;
        }
      });
    }
  }


/*
  let fixedMenuH = $('.boxHeader').height();
  function get_fixed_menu_h(){
    fixedMenuH = $('.boxHeader').height();
  }

  $(window).on("scroll", function(){

    if($('.isPc').css('width') == '1px'){
      //$('.boxHmbMenu').css("left", -$(window).scrollLeft());
      $('.boxHeader').css("left", -$(window).scrollLeft());
    }// isPc

    if($(window).scrollTop() > fixedMenuH){
      $('.boxHeader').addClass('scroll');
    }else{
        $('.boxHeader').removeClass('scroll');
    }

  });
*/



});