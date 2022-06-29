/**
 * @var wwSettings
 */

jQuery(function( $ ) {

    console.log(wwSettings);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getWeather, errorHandler);
    }

    function getWeather(position) {
        for (let widgetsKey in wwSettings.widgets) {
            $.ajax({
                url: 'https://api.openweathermap.org/data/2.5/weather',
                method: 'GET',
                data: {
                    lat: position.coords.latitude,
                    lon: position.coords.longitude,
                    units: wwSettings.widgets[widgetsKey].atts.units,
                    appid: wwSettings.apiKey
                }
            }).done(function (response) {
                if (response.cod !== 200) {
                    console.log(response);
                    return;
                }
                printWeather(response, wwSettings.widgets[widgetsKey]);
            });
        }
    }

    function errorHandler(error) {
        console.log(error);
    }

    function printWeather(weather, widget) {
        $.ajax({
            url: wwSettings.ajaxUrl,
            method: 'POST',
            data: {
                action: 'ww_show_weather',
                place: weather.name,
                temp: weather.main.temp,
                wind: weather.wind,
                weather: weather.weather[0],
                atts: widget.atts
            }
        }).done(function (response) {
            if (response.success === false) {
                console.log(response.message);
            }
            $('#' + widget.id).append(response.data.html);
        });
    }

});