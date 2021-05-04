$(function(){



  $('#prefecture-select').on('change', function(){
    
    const selectedPref = document.getElementById('prefecture-select').value;

    const url = "https://www.land.mlit.go.jp/webland/api/CitySearch?area=" + selectedPref;
    console.log(url);

    $.getJSON(url, function(json){
      console.log(json.data);
    })
  });

});