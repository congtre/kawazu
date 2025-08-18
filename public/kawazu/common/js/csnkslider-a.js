jQuery(function($){


  $('.csnkSliderA').each(function(){

    var id = $(this).attr('id');
    //console.log('id:'+id);

    const csnkSliderAElement = document.querySelector('#'+id);
    const cssStyles = getComputedStyle(csnkSliderAElement);
    //console.log('cssStyles:'+csnkSliderAElement);

    //const cssVal = String(cssStyles.getPropertyValue('--slideOneW')).trim();
    //console.log('slideOneW:'+cssVal);

    var slideNum = $('#'+id+' .csnkSliderAOne').length;
    //console.log('slideNum:'+slideNum);

    var oneSlideSpeed = 100 / 10;

    var setSlideSpeed = oneSlideSpeed * slideNum;
    var setSlideWait = setSlideSpeed / 2;

    csnkSliderAElement.style.setProperty('--slideSpeed', setSlideSpeed + 's');
    csnkSliderAElement.style.setProperty('--slideWait', '-' + setSlideWait + 's');

  });


});