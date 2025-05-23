$(document).foundation({
  orbit: {
      next_on_click: false, // Advance to next slide on click
      slide_number: false,
      slide_number_text: 'off',
      bullets: false, // Does the slider have bullets visible?
      timer: false, // Does the slider have a timer active? Setting to false disables the timer.
  }
});

$('#get-search-input').on('click', function(e){
   e.preventDefault();
   $('.search-field-topbar').toggleClass('is-open');
});

String.prototype.capitalize = function() {
   return this.charAt(0).toUpperCase() + this.slice(1);
}

var iconPath = "http://" + window.location.hostname + "/wp-content/themes/telebruxelles/img/weather_icons/";

$.getJSON( "http://api.openweathermap.org/data/2.5/find?q=Brussels,be&units=metric&lang=fr&appid=c3b0da7b201baf04ae2b7474a91f2ec1", function( data ) {

   var currentTemp = (data.list[0].main.temp).toFixed(0);
   var currentDesc = (data.list[0].weather[0].description).capitalize();
   var currentIcon = data.list[0].weather[0].icon;

   var weatherImg = $('<img class="weather__icon" src="'+ iconPath + currentIcon + '.png' + '"/>');
   var weatherTemp = $('<span class="weather__temp">'+ currentTemp +'°C</span>');
   var weatherDesc = $('<span class="weather__desc">'+ currentDesc +'</span>');

   $('.weather-day').append(weatherImg, weatherTemp, weatherDesc);
});


$.getJSON( "http://api.openweathermap.org/data/2.5/forecast/daily?q=Brussels,be&units=metric&cnt=4&appid=c3b0da7b201baf04ae2b7474a91f2ec1", function( data ) {
   var forecastList = $('<ul class="weather-forecast-list"></ul>');
   for(var i = 0, l = data.list.length; i < l; i++) {
      var obj = data.list[i];
      var unix_timestamp = obj.dt;
      var date = new Date(unix_timestamp*1000);
      var days = ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'];

      var forecastDays = days[ date.getDay() ];
      var forecastTemps = (obj.temp.day).toFixed(0);
      var forecastIcons = obj.weather[0].icon;

      var forecastListItems = $('<li><span class="weather-forecast__day">'+ forecastDays +'</span><img class="weather-forecast__icon" src="'+ iconPath + forecastIcons + '.png' + '"/><span class="weather-forecast__temp">'+ forecastTemps +'°</span></li>');

      forecastListItems.appendTo(forecastList);
      $('.weather-forecast').append(forecastList);
   }
});
