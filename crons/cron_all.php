<?php
// List of URLs to access
$urls = [
    "https://{$cxrurl}/crons/cron.php",
    "https://{$cxrurl}/crons/cron2.php",
    "https://{$cxrurl}/crons/cron3.php",
    "https://{$cxrurl}/crons/cron4.php",
    "https://{$cxrurl}/crons/cron5.php",
    "https://{$cxrurl}/crons/cron6.php",
    "https://{$cxrurl}/crons/phonpecron.php",
];

// Function to access a URL
function accessUrl($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($response === false || $http_code != 200) {
        echo "<div style='margin-bottom: 20px;'>";
        echo "<strong>Failed to access $url.</strong><br>";
        echo "HTTP code: $http_code.<br>";
        echo "Error: " . curl_error($ch) . "<br>";
        echo "</div>";
    } else {
        echo "<div style='margin-bottom: 20px;'>";
        echo "<strong>Successfully accessed $url.</strong><br>";
        echo "HTTP code: $http_code.<br>";
        echo "Response:<br><pre>" . json_encode(json_decode($response), JSON_PRETTY_PRINT) . "</pre><br>";
        echo "</div>";
    }

    curl_close($ch);
}

// Access each URL
foreach ($urls as $url) {
    accessUrl($url);
}
?>
