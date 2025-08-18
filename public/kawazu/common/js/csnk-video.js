jQuery(function($){

  set_video_src();
  //fit_video();

  var defW = $(window).width();
  $(window).on('resize',function(){
    var nowW = $(window).width();
    if(nowW != defW){
      defW = nowW;
      set_video_src();
      //fit_video();
    }
  });

  function set_video_src(){
    $('video').each(function(){
      if($(this).attr('data-src-sp')){
        if($(window).width() < 767){
          $(this).attr('src', $(this).attr('data-src-sp'));
        }else{
          $(this).attr('src', $(this).attr('data-src-pc'));
        }
      }
    });
  }

});