$(function(){

  // 1桁の数字を二桁にする関数
  function getTwoDigitsNumber(number){
    return ("0" + number).slice(-2)
  }

  function appendOption(city){
    let html = `<option value="${city.name}" class="city-option">${city.name}</option>`;
    return html;
  }

  function appendCity(insertHTML){
    let html = `<option value="" class="city-option">選択してください</option>
                  ${insertHTML}`
    $('#city-select').append(html);
  }

  $(document).on('change', '#prefecture-select',function(){
    
    const selectedPref = document.getElementById('prefecture-select').value;
    const prefId = getTwoDigitsNumber(selectedPref)

    // 国土交通省の住所取得API
    const url = "https://www.land.mlit.go.jp/webland/api/CitySearch?area=" + prefId;

    $.getJSON(url, function(json){

      let cities = json.data;
      let insertHTML = '';
      cities.forEach(function(city){
          insertHTML += appendOption(city);
      });
      $('.city-option').remove();
      appendCity(insertHTML);
    })
  });
});