$(function(){

  // 画像入れ替え関数
  function appendImage(url){
    let childHtml = `<img src="${url}" style="height: 100%;"/>`;
    $('.image-container').append(childHtml);
  }

  // 画像選択されたら動く
  $('#image-box').on('change', '.image-file', function(e) {
    // 選択したファイル取得
    const file = e.target.files[0];
    // ログインユーザーID取得
    const userId = $('.id-file').data('uid');

    // フォームデータ作成し追加
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
      // jsonデータからurlを取得
      var src_url = image_url.url;
          //イメージタグのみ削除
          $('.image-container').children('img').remove();
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