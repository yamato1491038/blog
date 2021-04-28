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
    console.log(nameInput);

    if (nameInput){
    
      $.ajax({
        type: "GET",
        url: '/address/search',
        data: {keyword: nameInput},
        dataType: 'json'
      })
      .done(function(json) {

        if(json.result) {
          console.log(json.result);
          $('.green-text, .notice-text').remove();
          if(!($('.red-text').length)){
            appendRegistered();
          }
          
        } else {
          console.log("結果なし");
          $('.red-text, .notice-text').remove();
          if(!($('.green-text').length)){
            appendRegistrable();
          }
          
        
        }
      //   $("#UserSearchResult").empty();
      //   if (users.length !== 0) {
      //     users.forEach(function(user){
      //       addUser(user);
      //     });
      //   } else if (input.length == 0) {
      //     return false;
      //   } else {
      //     addNoUser();
      //   }
      })
      .fail(function() {
        alert("ユーザー検索に失敗しました");
      });
    } else {
      $('.red-text, .green-text').remove();
      appendInput();
    }
  });

});