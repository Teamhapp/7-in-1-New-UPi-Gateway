<?php
// Include the database connection
include "config.php";

// Fetch site settings from the database
$query = "SELECT * FROM site_settings LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $site_settings = mysqli_fetch_assoc($result);
} else {
    // You can either handle the case when no settings are found or leave it empty
    $site_settings = []; // Leave it empty or handle the error as needed
    // Optionally, you might want to display an error message
     echo "Error: No site settings found.";
}



// Fetch API settings from the database
$query = "SELECT * FROM api_settings LIMIT 1";
$result = mysqli_query($conn, $query);

// Check if settings are found
if ($result && mysqli_num_rows($result) > 0) {
    $api_settings = mysqli_fetch_assoc($result);

    // Set variables from the fetched settings
    $whatsapp_api_url = $api_settings['whatsapp_api_url'];
    $sender_id = $api_settings['sender_id'];
    $apikey = $api_settings['api_key'];
    $sender_email = $api_settings['sender_email'];

} else {
    die("Error: No API settings found."); // Terminate if no settings found
}

?>
