$(function(){

  // 画像入れ替え関数
  function appendImage(url){
    let childHtml = `<img src="${url}" style="height: 100%;" class="rounded-circle"/>`;
    $('.image-container').append(childHtml);
  }

  // 画像選択されたら動く
  $('#image-box').on('change', '.image-file', function(e) {
    // 選択したファイル取得
    const file = e.target.files[0];
    // ログインユーザーID取得
    const userId = $('.id-file').data('uid');

    // フォームデータに追加
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
    }).done(function(image_url) {
      var src_url = image_url.url;
      console.log(src_url);
          //通信成功
          $('.image-container').children().remove();
          appendImage(src_url);
    }).fail(function(){
          //通信失敗
          console.log('失敗');
    }).always(function(){
          //通信完了
          console.log('終了');
    });
  });
});