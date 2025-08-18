jQuery(function($){

  const csnkLinkBase08Element = document.querySelectorAll('.linkBase08');

  for(var i = 0; i < csnkLinkBase08Element.length; ++i){
    //console.log('data-bg:'+csnkLinkBase08Element.item(i).getAttribute('data-bg'));
    var bg = csnkLinkBase08Element.item(i).getAttribute('data-bg');
    if(bg){
      //console.log('data-bg:'+bg);
      csnkLinkBase08Element.item(i).style.setProperty('--linkBase08Bg', 'url('+bg+')');
    }
  }

});