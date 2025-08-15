jQuery(function($){

  console.log('LoadingCookie', $.cookie('loading_cookie'));
  if($.cookie('loading_cookie') == 'ok') return false;

  $('#container').css('display','none');
  $('#loaderBg').css('display','block');

/*
  $(window).on('load', function(){
  timer = setTimeout(function(){
    $('#loader').delay(100).fadeOut(300);
    $('#loaderBg').delay(200).fadeOut(500);
    $('#container').css('display','block');
  },800);
  });

  timer = setTimeout(function(){
    $('#loader').delay(100).fadeOut(300);
    $('#loaderBg').delay(200).fadeOut(500);
    $('#container').css('display','block');
  },10000);
*/

  /********V2*******/
  if($('#loaderIn .loadingBarV2').length > 0){

    var loadCount = 0;
    var imgLength = $('img').size();

    $('img').each(function(){
      var src = $(this).attr('src');
      $('<img>').attr('src' , src).load(function(){
        loadCount++;
      });
    });

    var timeout_cnt = 0;
    var timerV2 = setInterval(function(){
      $('#loaderIn .loadingBarV2').css({'width': (loadCount / imgLength) * 100 + '%'});
      if((loadCount / imgLength) * 100 >= 100 || timeout_cnt / 5 > 10000){
        clearInterval(timerV2);
        $('#loaderIn .loadingBarV2').delay(200).animate({'opacity': 0}, 200);
        $('#loader').delay(100).fadeOut(300);
        $('#loaderBg').delay(200).fadeOut(500);
        $('#container').css('display','block');
        $.cookie('loading_cookie', 'ok', {path: '/'});
        if(timeout_cnt / 5 > 10000){
          console.log('loading TimeOut!');
        }else{
          console.log('loading Finish!');
        }
      }
      timeout_cnt++;
    }, 5);

  }//is loadingBarV2


});