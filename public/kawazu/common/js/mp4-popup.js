jQuery(function($){


  $(window).on('resize', function(){
    if($('.boxVideoPopupBg').css('display') == 'block'){
      $('.boxVideoPopupBg').css({
      'width': $(window).width(),
      'height': document.documentElement.scrollHeight
      });
      var videoPer = 57.751;
      var winPer = ($(window).height()*100)/$(window).width();
      //console.log('WinPer:'+winPer+'/VideoPer:'+videoPer);
      if(videoPer >= winPer) {
        var videoH = parseInt($(window).height()*0.9);
        var videoW = parseInt((videoH*100)/videoPer);
        //console.log('1W:'+videoW+'/1H:'+videoH);
        $('.boxVideoPopup > .boxVideo').css({
          'width': videoW+'px',
          'height': videoH+'px'
        });
      }else{
        var videoW = parseInt($(window).width()*0.9);
        var videoH = parseInt((videoW*videoPer)/100);
        //console.log('2W:'+videoW+'/2H:'+videoH);
        $('.boxVideoPopup > .boxVideo').css({
          'width': videoW+'px',
          'height': videoH+'px'
        });
      }
    }
  });


  $('.btnVideoPlay').on('click', function(){

    $('body').append('<div class="boxVideoPopupBg"></div>');
    $('body').append('<div class="boxVideoPopup"><span class="btnVideoClose">x</span><div class="boxVideo"><video src="" poster="" controls autoplay></video></div></div>');

    var videoSrc = '';
    videoSrc = $(this).attr('data-video-src');
    if(!videoSrc){
      return false;
    }

    //console.log('W:'+$(window).width()+'/H:'+$(window).height());
    var videoPer = 57.751;
    var winPer = ($(window).height()*100)/$(window).width();
    //console.log('WinPer:'+winPer+'/VideoPer:'+videoPer);
    if(videoPer >= winPer) {
      var videoH = parseInt($(window).height()*0.9);
      var videoW = parseInt((videoH*100)/videoPer);
      //console.log('1W:'+videoW+'/1H:'+videoH);
      $('.boxVideoPopup > .boxVideo').css({
        'width': videoW+'px',
        'height': videoH+'px'
      });
    }else{
      var videoW = parseInt($(window).width()*0.9);
      var videoH = parseInt((videoW*videoPer)/100);
      //console.log('2W:'+videoW+'/2H:'+videoH);
      $('.boxVideoPopup > .boxVideo').css({
        'width': videoW+'px',
        'height': videoH+'px'
      });
    }

    $('.boxVideoPopup > .boxVideo > video').attr('src',videoSrc);

    $('.boxVideoPopupBg').css({
      'width': $(window).width(),
      'height': document.documentElement.scrollHeight
    });

    $('.boxVideoPopupBg').show();
    $('.box_video_popup').fadeIn();
    $('.box_video_popup').css('display','inline-block');

    $('.boxVideoPopup video').on('click', function(e){
      e.stopPropagation();
    });

    $('.boxVideoPopupBg, .boxVideoPopup').click(function(){
      $('.boxVideoPopup').fadeOut('slow', function(){ $('.boxVideoPopupBg').fadeOut( function(){ $('.boxVideoPopup').remove(); $('.boxVideoPopupBg').remove(); } ); });
    });

    return false;

  });


});