<?php
// API endpoint URL
$url = "https://kenzpay.com/api/check-order-status";

$order_id = $_GET['order_id'];
// POST data
$postData = array(
    "user_token" => "d5b7959f586da59460c1a7b693910724",
    "order_id" => $order_id
);

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

// Execute cURL session and get the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    exit;
}

// Close cURL session
curl_close($ch);

// Decode the JSON response
$responseData = json_decode($response, true);
print_r($responseData); 
// Check if the API call was successful
if ($responseData["status"] === "1") {
    // API call was successful
    // Access the response data as needed
    $txnStatus = $responseData["result"]["txnStatus"];
    $orderId = $responseData["result"]["orderId"];
    $status = $responseData["result"]["status"];
    $amount = $responseData["result"]["amount"];
    $date = $responseData["result"]["date"];
    $utr = $responseData["result"]["utr"];

    echo "Transaction Status: $txnStatus<br>";
    echo "Order ID: $orderId<br>";
    echo "Status: $status<br>";
    echo "Amount: $amount<br>";
    echo "Date: $date<br>";
    echo "UTR: $utr<br>";
} else {
    // API call failed
    $errorMessage = $responseData["message"];
    echo "API Error: $errorMessage";
}
?>
