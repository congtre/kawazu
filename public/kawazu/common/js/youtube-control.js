jQuery(function($){

  $('.boxYoutube .imgYoutubePoster').on('click',function(){

    var playerId = $(this).attr('data-player-id');
    //console.log('playerId:'+playerId);

    //$(this).fadeOut();
    $(this).parent().find('.imgYoutubePoster').fadeOut();
    $('iframe#'+playerId).fadeIn();

    videoControl("playVideo"); 

    function videoControl(action){ 
      var $playerWindow = $('#'+playerId)[0].contentWindow;
      $playerWindow.postMessage('{"event":"command","func":"'+action+'","args":""}', '*');
    }

    //※ iframe の src にパラメータ ?enablejsapi=1 の付加が必須

  });


  
  $(window).on('load',function(){
    youtube_auto_play();
  });

  function youtube_auto_play() {
    if($('#youtubeAutoPlay').length > 0){
      var playerId = 'youtubeAutoPlay';

      videoControl("playVideo"); 

      function videoControl(action){ 
        var $playerWindow = $('#'+playerId)[0].contentWindow;
        $playerWindow.postMessage('{"event":"command","func":"'+action+'","args":""}', '*');
      }
    }
  }



});