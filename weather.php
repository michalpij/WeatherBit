<?php
if (isset($_POST["location"])) {
  $location = $_POST["location"];
  $api_key = "875af4f9152f4b2ba33b32dd02b2fc60";
  $api_url = "https://api.weatherbit.io/v2.0/forecast/daily?key=$api_key&city=" . urlencode($location);

  $response = file_get_contents($api_url);
  $weather_data = json_decode($response, true);

  if ($weather_data && isset($weather_data["data"])) {
    $current_weather = $weather_data["data"][0];
    $forecast = array_slice($weather_data["data"], 1, 3); // Get forecasts for the next 3 days

    echo "<h2>Current Weather:</h2>";
    if (isset($current_weather["city_name"])) {
      echo "Location: " . $current_weather["city_name"] . "<br>";
    }
    if (isset($current_weather["temp"])) {
      echo "Temperature: " . $current_weather["temp"] . "°C<br>";
    }
    if (isset($current_weather["weather"]["description"])) {
      echo "Description: " . $current_weather["weather"]["description"] . "<br><br>";
    }

    echo "<h2>Forecast:</h2>";
    foreach ($forecast as $day) {
      echo "Date: " . $day["datetime"] . "<br>";
      echo "Temperature: " . $day["temp"] . "°C<br>";
      echo "Description: " . $day["weather"]["description"] . "<br><br>";
    }
  } else {
    echo "No weather data found.";
  }
}
?>