jQuery(function(){

  var interval = {};

  $('div[data-nkslider-fadein-code]').each(function(){
    var slider_code = $(this).attr('data-nkslider-fadein-code');
    var slide_num = $(this).find('.ulFadeinSlide > li').length;
    if($(this).find('.ulFadeinSlideBtn').length > 0){
      $(this).find('.ulFadeinSlideBtn > li').remove();
      for(var i = 0; i < slide_num; ++i){
        $(this).find('.ulFadeinSlideBtn').append('<li></li>');
        if(i == 0){
          $(this).find('.ulFadeinSlide > li:first-child').addClass('current');
          $(this).find('.ulFadeinSlideBtn > li:first-child').addClass('current');
        }
      }
      if($(this).find('.sliderArrowL').length > 0){
        $(this).find('.sliderArrowL').css({'cssText': 'display: inline !important'});
      }
      if($(this).find('.sliderArrowR').length > 0){
        $(this).find('.sliderArrowR').css({'cssText': 'display: inline !important'});
      }
    }
    //console.log('Scode:'+slider_code);
    //console.log('Length:'+slide_num);
    if(slide_num > 1){
      autoSlide(slider_code);
    }
  });

  //autoSlide('slide1');
  //autoSlide('slide2');

  function autoSlide(id){
    if(id == '') return false;
    clearInterval(interval[id]);
    interval[id] = setInterval(function(){
      fadein_slide(id);
    },5000);
  }// func autoSlide

  function autoSlideStop(id){
    if(id == '') return false;
    clearInterval(interval[id]);
  }

  $('.boxFadeinSlide').on('mouseenter', function(){
    autoSlideStop($(this).attr('id'));
  });
  $('.boxFadeinSlide').on('mouseleave', function(){
    autoSlide($(this).attr('id'));
  });


  $('.ulFadeinSlideBtn > li').on('click', function(){
    var id = $(this).parents('.boxFadeinSlide').attr('id');
    var target_index = $(this).index();
    fadein_slide(id, target_index);
  });


  $('.boxFadeinSlide .sliderArrowL').on('click', function(){
    var id = $(this).parents('.boxFadeinSlide').attr('id');
    var all_num = $('#'+id+' .ulFadeinSlide > li').length;
    var current_index = $('#'+id+' .ulFadeinSlide > li.current').index();
    if(current_index == 0){
      var target_index = all_num - 1;
    }else{
      var target_index = current_index - 1;
    }
    fadein_slide_prev(id, target_index);
  });


  $('.boxFadeinSlide .sliderArrowR').on('click', function(){
    var id = $(this).parents('.boxFadeinSlide').attr('id');
    var all_num = $('#'+id+' .ulFadeinSlide > li').length;
    var current_index = $('#'+id+' .ulFadeinSlide > li.current').index();
    if(current_index == all_num - 1){
      var target_index = 0;
    }else{
      var target_index = current_index + 1;
    }
    fadein_slide(id, target_index);
  });


  function fadein_slide(id, target_index){

    if(id == '') return false;

    //console.log('ID:'+id+'/Target:'+target_index);

    if(target_index === '' || target_index == undefined){
      var all_num = $('#'+id+' .ulFadeinSlideBtn > li').length;
      var current_index = $('#'+id+' .ulFadeinSlideBtn > li.current').index();
      if(all_num == current_index + 1){
        target_index = 0;
      }
      else{
        target_index = current_index + 1;
      }
    }

    var targetObj = $('#'+id+' .ulFadeinSlide > li');
    var targetBtnObj = $('#'+id+' .ulFadeinSlideBtn > li');

    targetObj.removeClass('current');
    targetObj.eq(target_index).addClass('current');
    targetBtnObj.removeClass('current');
    targetBtnObj.eq(target_index).addClass('current');

  }// fadein_slide


  function fadein_slide_prev(id, target_index){

    if(id == '') return false;

    //console.log('ID:'+id+'/Target:'+target_index);

    if(target_index === '' || target_index == undefined){
      var all_num = $('#'+id+' .ulFadeinSlideBtn > li').length;
      var current_index = $('#'+id+' .ulFadeinSlideBtn > li.current').index();
      if(current_index == '0'){
        target_index = all_num-1;
      }
      else{
        target_index = current_index-1;
      }
    }

    var targetObj = $('#'+id+' .ulFadeinSlide > li');
    var targetBtnObj = $('#'+id+' .ulFadeinSlideBtn > li');

    targetObj.removeClass('current');
    targetObj.eq(target_index).addClass('current');
    targetBtnObj.removeClass('current');
    targetBtnObj.eq(target_index).addClass('current');

  }// fadein_slide_prev


});