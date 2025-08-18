jQuery(function($){


  $(window).on('load', function(){
    //mp4_auto_play();
  });

  function mp4_auto_play(){
    if($('.boxMp4Movie .mp4.autoplay').length > 0){
      var videoPlayerId = $('.boxMp4Movie .mp4.autoplay').attr('id');
      //console.log('videoPlayerId: '+videoPlayerId);
      var videoPlayer = $('video#'+videoPlayerId).get(0);
      if($('.boxMp4Movie .imgMp4Poster[data-player-id="'+videoPlayerId+'"]').length > 0){
        $('.boxMp4Movie .imgMp4Poster').css('display','none');
      }
      videoPlayer.play();
    }
  }



  $('.imgMp4Poster, .btnMp4Play').on('click', function() {

    var videoPlayerId = $(this).attr('data-player-id');
    //console.log('videoPlayerId: '+videoPlayerId);
    var videoPlayer = $('video#'+videoPlayerId).get(0);
    //$(this).css('display','none');
    $(this).parents('.boxMp4Movie').find('img').css('display','none');
    $('video#'+videoPlayerId).fadeIn();
    videoPlayer.play();


/** Memo
videoPlayer.pause() // 一時停止する
console.log(videoPlayer.currentTime) // 現在の再生時間を表示する
videoPlayer.currentTime = 10 // 10秒目に移動する
*/

/** 再生が終了したら次のビデオを再生
    $('video#'+videoPlayerId).on('ended', function() {
      var videoPlayer = $(this).get(0);
        videoPlayer.src = 'https://xxxxxx.jp/wp-content/themes/xxxxx/mp4/message01.mp4';
        videoPlayer.play();
    });
*/

  });





});