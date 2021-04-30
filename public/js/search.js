$(function(){

  function appendRegistered() {
    let html = `<label class="red-text">●すでに登録済の名前のため登録不可</label>`;
    $(".name-label").append(html);
  }

  function appendRegistrable() {
    let html = `<label class="green-text">●登録可能です</label>`;
    $(".name-label").append(html);
  }

  function appendInput() {
    let html = `<label class="notice-text">●入力してください</label>`;
    $(".name-label").append(html);
  }


  $("#name-input").on("keyup", function() {
    let nameInput = $("#name-input").val();

    if (nameInput){
    // 入力あれば
      $.ajax({
        type: "GET",
        url: '/address/search',
        data: {keyword: nameInput},
        dataType: 'json'
      })
      .done(function(json) {

        if(json.result) {
          // 一個でもあれば
          $('.green-text, .notice-text').remove();
          if(!($('.red-text').length)){
            // 入力不可テキストなければ
            appendRegistered();
            $('#submit_btn').prop("disabled", true);
          }
          
        } else {
          $('.red-text, .notice-text').remove();
          if(!($('.green-text').length)){
            appendRegistrable();
            $('#submit_btn').prop("disabled", false);
          }
        }
      })
      .fail(function() {
        alert("ユーザー検索に失敗しました");
      });
    } else {
      // インプット無ければ
      $('.red-text, .green-text').remove();
      appendInput();
    }
  });

});