$(function(){

  

  $('#image-box').on('change', '.image-file', function(e) {

    const file = e.target.files[0];
    const userId = $('.id-file').data('uid');

    const fd = new FormData();
    fd.append('file', file);
    fd.append('user_id', userId);

    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    $.ajax({	
      url:"/my_image/upload",
      method: 'post',
      data: fd,
      contentType: false,
      processData: false,
    }).done(function($check_image_exist) {
          //通信成功
          console.log($check_image_exist);
    }).fail(function(){
          //通信失敗
          console.log('失敗');
    }).always(function(){
          //通信完了
          console.log('終了');
    });
  });
});