<?php
session_start();
require_once('../config.php');
require_once('config.php');

$orderid=$_COOKIE['order_id_cookie'];

// API endpoint URL
$url = "https://" . $_SERVER["SERVER_NAME"] . "/api/check-order-status";


// POST data
$postData = array(
    "user_token" => $token,
    "order_id" => $orderid
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

// Check if the API call was successful
if ($responseData["status"] === "COMPLETED") {
    // API call was successful
    // Access the response data as needed
    $txnStatus = $responseData["result"]["txnStatus"];
    $orderId = $responseData["result"]["orderId"];
    $status = $responseData["result"]["status"];
    $amount = $responseData["result"]["amount"];
    $date = $responseData["result"]["date"];
    $utr = $responseData["result"]["utr"];

 //   echo "Transaction Status: $txnStatus<br>";
 //   echo "Order ID: $orderId<br>";
 ///   echo "Status: $status<br>";
 ///   echo "Amount: $amount<br>";
 ///   echo "Date: $date<br>";
  //  echo "UTR: $utr<br>";
  
  $planid=$_COOKIE['planid_cookie'];
  $email=$_SESSION['username'];
  
 
  
   if ($planid == 1) {
    $monthsToAdd = 1;

} elseif ($planid == 2) {
    $monthsToAdd = 3;
    
} elseif ($planid == 3) {
    $monthsToAdd = 6;
} elseif ($planid == 4) {
    $monthsToAdd = 12;
    
} else {
    $monthsToAdd = 0;
}


 $sql = "UPDATE users SET expiry = DATE_ADD(expiry, INTERVAL $monthsToAdd MONTH) WHERE mobile = '$email'";
        $rrrr = mysqli_query($conn, $sql);

        if ($rrrr) {
            
           header("Location: https://" . $_SERVER["SERVER_NAME"] . "/Merchant/dashboard");
exit;

            
            

          
        }
        
        else{
            //echo "SQL Error: " . mysqli_error($conn);
            
             // Show SweetAlert2 error message
                           header("Location: https://" . $_SERVER["SERVER_NAME"] . "/Merchant/subscription");
exit;

}

  
  
} else {
    // API call failed
    $errorMessage = $responseData["message"];
    echo "API Error: $errorMessage";
}