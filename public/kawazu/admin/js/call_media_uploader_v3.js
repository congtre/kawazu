jQuery(function($){

  var custom_uploader;
  var myInputName;
  $('.btnImgUp').on('click', function(e){

    myInputName = $(this).attr('id');
    //console.log('id:'+myInputName);

    e.preventDefault();
    if(custom_uploader){
      custom_uploader.open();
      return;
    }

    custom_uploader = wp.media({
      title: 'Choose Image',
      library: {
        type: 'image'
      },
      button: {
        text: 'Choose Image'
      },
      multiple: false
    });

    custom_uploader.on('select', function(){
      var images = custom_uploader.state().get('selection');
      if($('#selectImg_'+myInputName+' input').length > 0){
        $('#selectImg_'+myInputName+' img').remove();
        $('#selectImg_'+myInputName+' input').remove();
      }
      images.each(function(file){
        $('#selectImg_'+myInputName).append('<img src="'+file.toJSON().url+'" class="upImage '+myInputName+'"><input type="hidden" name="'+myInputName+'" value="'+file.toJSON().url+'">');
      });
    });
    custom_uploader.open();
      //multiple: false //falseで画像を１つしか選択できなくなる
  });// click #btnImgUp


  $('.btnImgRemove').on('click', function(){
    myInputName = $(this).attr('id').replace(/^remove\_/,'');
    //console.log('id2:'+myInputName);
    $('input[name='+myInputName+']').val('');
  });// click #btnImgRemove


});