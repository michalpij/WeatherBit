function getWeather() {
    var location = document.getElementById("location").value;
    if (location !== "") {
      $.ajax({
        url: "weather.php",
        type: "POST",
        data: { location: location },
        success: function (response) {
          $("#weather-results").html(response);
        },
      });
    }
  }
  