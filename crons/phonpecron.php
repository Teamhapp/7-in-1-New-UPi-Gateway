<?php

require "../auth/config.php";

$cxrurl=$_SERVER["SERVER_NAME"];

// Assuming $conn is defined in the auth config

// Fetch users with phonepe_connected == "Yes" and upi_id is null
$query = "SELECT * FROM users WHERE phonepe_connected = 'Yes' AND (upi_id IS NULL OR upi_id = '')";
$result = mysqli_query($conn, $query);


if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    // Fetch the user_token for each user
    $user_token = $row['user_token'];
    
    
    // The URL you want to request using the user_token
    $url = "https://{$cxrurl}/phnpe/user_txn.php?no=$user_token";

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and fetch response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo "cURL Error: " . curl_error($ch);
    } else {
        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $decodedResponse = json_decode($response, true);

        if ($decodedResponse !== null && isset($decodedResponse['data']['results'][0]['merchantDetails']['qrCodeId'])) {
            // Extract and echo the 'qrCodeId' with @ybl suffix
            $qrCodeId = $decodedResponse['data']['results'][0]['merchantDetails']['qrCodeId'];
            $qrCodeIdWithSuffix = $qrCodeId . '@ybl';
            echo "qrCodeId: " . $qrCodeIdWithSuffix;

            // Update upi_id for the current user with the qrCodeId with @ybl suffix
            $updateQuery = "UPDATE users SET upi_id = '$qrCodeIdWithSuffix' WHERE user_token = '$user_token'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if (!$updateResult) {
                echo "Error updating upi_id: " . mysqli_error($conn);
            } else {
                echo "Updated upi id : ";
            }
        } else {
            echo "Failed to decode JSON response or 'qrCodeId' not found.";
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
