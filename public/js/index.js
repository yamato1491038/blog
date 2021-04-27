$(function(){

  // like済へ入れ替え関数
  function appendCheckAlready(likeId, addressId){
    let html = `<svg data-like-id="${likeId}" data-address-id="${addressId}" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill address-like-already" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>`;
    $('.like-field-' + addressId).append(html);
  }

  // likeへ戻す関数
  function appendCheck(addressId){
    let html = `<svg data-address-id="${addressId}" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle address-like" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                </svg>`;
    $('.like-field-' + addressId).append(html);
  }

  // いいね登録
  $('.address-like').click(function(){

    const clickAddressId =  $(this).data('address-id');

    const fd = new FormData();
    fd.append('address_id', clickAddressId);

    console.log(fd);

    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    $.ajax({	
      url:"/like/store",
      method: 'post',
      data: fd,
      contentType: false,
      processData: false,
    }).done(function(new_like_json) {

      const newLikeId = new_like_json.new_like.id;
      console.log(newLikeId);
          
      $('.like-field-' + clickAddressId).children().remove();
      appendCheckAlready(newLikeId, clickAddressId);
    }).fail(function(){
          //通信失敗
          console.log('失敗');
    }).always(function(){
          //通信完了
          console.log('終了');
    });
  });

  // いいね取り消し（ウェブページ全体に対してイベントハンドラを登録する書き方）
  $(document).on('click', '.address-like-already', function(){

    const clickLikeId =  $(this).data('like-id');
    const clickAddressId =  $(this).data('address-id');

    const fd2 = new FormData();
    fd2.append('like_id', clickLikeId);
    fd2.append('_method', "DELETE");

    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    $.ajax({	
      url:"/like/destroy",
      method: 'post',
      data: fd2,
      contentType: false,
      processData: false,
    }).done(function() {

      $('.like-field-' + clickAddressId).children().remove();
      appendCheck(clickAddressId);
          
      // $('.like-field-' + clickAddressId).children().remove();
      // appendImage(newLikeId, clickAddressId);
    }).fail(function(){
          //通信失敗
          console.log('失敗');
    }).always(function(){
          //通信完了
          console.log('終了');
    });
  });


});