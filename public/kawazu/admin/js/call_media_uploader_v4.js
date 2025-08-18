jQuery(function($){

  var custom_uploader;
  var myInputName;
  var myInputId;

  $('.btnImgUpV4').on('click', function(e){
    console.log('OK1');
    if($(this).attr('data-name')){
      myInputName = $(this).attr('data-name');
    }else{
      myInputName = $(this).attr('id');
    }
    myInputId = $(this).attr('id');
    myIdBase = myInputId.replace(/\-bn\_url$/,'');
    myIdBase = myIdBase.replace(/\-bn\_pc\_url$/,'');
    myIdBase = myIdBase.replace(/\-bn\_sp\_url$/,'');

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
      if($('#selectImg_'+myInputId+' input').length > 0){
        $('#selectImg_'+myInputId+' img').remove();
        $('#selectImg_'+myInputId+' input').remove();
      }
      $('img#preview_'+myInputId).remove();
      $('input#input_'+myInputId).remove();
      images.each(function(file){
        $('#selectImg_'+myInputId).append('<img src="'+file.toJSON().url+'" id="'+myInputId+'"><input type="hidden" name="'+myInputName+'" value="'+file.toJSON().url+'">');
      });
      $('#'+myIdBase+'-savewidget').prop('disabled', false);
      $('#'+myIdBase+'-savewidget').val('保存');
    });
    custom_uploader.open();
      //multiple: false //falseで画像を１つしか選択できなくなる
  });// click #btnImgUp


  $(document).on('click','.btnImgUpV4', function(e){
    console.log('OK2');
    if($(this).attr('data-name')){
      myInputName = $(this).attr('data-name');
    }else{
      myInputName = $(this).attr('id');
    }
    myInputId = $(this).attr('id');
    myIdBase = myInputId.replace(/\-bn\_url$/,'');
    myIdBase = myIdBase.replace(/\-bn\_pc\_url$/,'');
    myIdBase = myIdBase.replace(/\-bn\_sp\_url$/,'');

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
      if($('#selectImg_'+myInputId+' input').length > 0){
        $('#selectImg_'+myInputId+' img').remove();
        $('#selectImg_'+myInputId+' input').remove();
      }
      $('img#preview_'+myInputId).remove();
      $('input#input_'+myInputId).remove();
      images.each(function(file){
        $('#selectImg_'+myInputId).append('<img src="'+file.toJSON().url+'" id="'+myInputId+'" class="imgWidget"><input type="hidden" name="'+myInputName+'" value="'+file.toJSON().url+'">');
      });
      $('#'+myIdBase+'-savewidget').prop('disabled', false);
      $('#'+myIdBase+'-savewidget').val('保存');
    });
    custom_uploader.open();
      //multiple: false //falseで画像を１つしか選択できなくなる
  });





  $('.btnImgRemoveV4').on('click', function(e){
    console.log('Del1');
    //myInputName = $(this).attr('name').replace(/^btn\_/,'');
    //myInputName = $(this).attr('name');
    myInputName = $(this).attr('data-name');
    myInputId = $(this).attr('id').replace(/^remove\_/,'');
    myIdBase = myInputId.replace(/\-bn\_url$/,'');

    console.log('Name:'+myInputName+'/ID:'+myInputId);
    e.preventDefault();
    e.stopPropagation();
    //$('input[name="'+myInputName+'"]').val('');
    //$('input#input_'+myInputId).val('');
    $('input#input_'+myInputId).val('');
    $('button#remove_'+myInputId).remove();
    $('img#preview_'+myInputId).remove();
    $('input#input_'+myInputId).after('<button type="button" data-name="'+myInputName+'" class="btnImgUpV4" id="'+myInputId+'">画像選択</button>');
    $('#'+myIdBase+'-savewidget').prop('disabled', false);
    $('#'+myIdBase+'-savewidget').val('保存');
    //return false;
  });// click #btnImgRemove


  $(document).on('click','.btnImgRemoveV4', function(e){
    console.log('Del2');

    myInputName = $(this).attr('data-name');
    myInputId = $(this).attr('id').replace(/^remove\_/,'');
    myIdBase = myInputId.replace(/\-bn\_url$/,'');

    console.log('Name:'+myInputName+'/ID:'+myInputId);

    e.preventDefault();
    e.stopPropagation();
    //$('input[name="'+myInputName+'"]').val('');
    //$('input#input_'+myInputId).val('');
    $('input#input_'+myInputId).val('');
    $('button#remove_'+myInputId).remove();
    $('img#preview_'+myInputId).remove();
    $('input#input_'+myInputId).after('<button type="button" data-name="'+myInputName+'" class="btnImgUpV4" id="'+myInputId+'">画像選択</button>');
    $('#'+myIdBase+'-savewidget').prop('disabled', false);
    $('#'+myIdBase+'-savewidget').val('保存');

  });// click #btnImgRemove




});