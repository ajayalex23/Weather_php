<?php
// OpenWeatherMap API details
$apiKey = "4225dfc4544718426b698d52ec0578e1"; // Replace with your actual API key
$defaultCity = "Sheffield";
$units = "metric"; // Use 'metric' for Celsius, 'imperial' for Fahrenheit

// Get city from the user input or use the default city
$city = isset($_GET['city']) ? $_GET['city'] : $defaultCity;

// OpenWeatherMap API URL
$apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&units={$units}&appid={$apiKey}";

// Fetch data from OpenWeatherMap API
$weatherData = file_get_contents($apiUrl);
if ($weatherData) {
    $weatherArray = json_decode($weatherData, true);
} else {
    $weatherArray = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Weather Information Dashboard</h1>
        <form method="GET" action="">
            <input type="text" name="city" placeholder="Enter city" value="<?php echo htmlspecialchars($city); ?>" required>
            <button type="submit">Get Weather</button>
        </form>
        <?php if ($weatherArray && $weatherArray['cod'] == 200): ?>
            <div class="weather-info">
                <h2><?php echo $weatherArray['name']; ?>, <?php echo $weatherArray['sys']['country']; ?></h2>
                <p>Temperature: <?php echo $weatherArray['main']['temp']; ?>°C</p>
                <p>Weather: <?php echo $weatherArray['weather'][0]['description']; ?></p>
                <p>Humidity: <?php echo $weatherArray['main']['humidity']; ?>%</p>
                <p>Wind Speed: <?php echo $weatherArray['wind']['speed']; ?> m/s</p>
            </div>
        <?php else: ?>
            <p>Unable to fetch weather data. Please try again.</p>
        <?php endif; ?>
    </div>
</body>
</html>
