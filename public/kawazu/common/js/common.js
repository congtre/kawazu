jQuery(function($){

  pagination_add_class();

  function pagination_add_class(){
    if($('ul.page-numbers li > .page-numbers.next').length > 0 && !$('ul.page-numbers li > .page-numbers.next').parent('li').hasClass('liNext')){
      $('ul.page-numbers li > .page-numbers.next').parent('li').addClass('liNext');
    }
    if($('ul.page-numbers li > .page-numbers.prev').length > 0 && !$('ul.page-numbers li > .page-numbers.prev').parent('li').hasClass('liPrev')){
      $('ul.page-numbers li > .page-numbers.prev').parent('li').addClass('liPrev');
    }
  }//pagination_add_class

});