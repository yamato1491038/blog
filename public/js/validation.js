$(function(){

  $('#form').validate({
    rules: {
      zip_code: {
        required: true,
        minlength: 7,
        maxlength: 7
      }
    },
    messages: {
      zip_code: {
        required: '●郵便番号を入力してください',
        minlength: '●桁数が少ないです',
        maxlength: '●7桁以上です'
      }
    },
    errorPlacement: function(error, element){
      error.insertBefore(element);
    }
  })
})