jQuery(function($){

  $('a[href="#search"]').on('click', function(){
    $('#search').addClass('open');
    $('#search input[type="text"]').focus();
    return false;
  });

  $('#search, #search .btnClose').on('click keyup', function(event){
    if(event.target == this || event.target.className == 'btnClose' || event.keyCode == 27){
      $(this).removeClass('open');
    }
  });

});