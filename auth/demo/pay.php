<?php
// Set the API endpoint URL
$api_url = 'https://kenzpay.com/api/create-order';
$order_id = rand(1,99999999);
// Define the payload data
$data = array(
    'customer_mobile' => '8145344963',
    'user_token' => 'd5b7959f586da59460c1a7b693910724',
    'amount' => 1,
    'order_id' => $order_id,   //use unique order id
    'redirect_url' => 'https://kenzpay.com/auth/demo/redirect.php?order_id='.$order_id,
    'remark1' => 'testremark',
    'remark2' => 'testremark2',
);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Encode the data as form-urlencoded

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Parse the JSON response
    $result = json_decode($response, true);

    // Check if the status is true or false
    if ($result && isset($result['status'])) {
        if ($result['status'] === true) {
            // Order was created successfully
            /*echo 'Order Created Successfully<br>';
            echo 'Order ID: ' . $result['result']['orderId'] . '<br>';
            echo 'Payment URL: ' . $result['result']['payment_url'];*/
			$url = $result['result']['payment_url'];
			echo '<script type="text/javascript">
			   window.location = "'.$url.'"
		  </script>';
        } else {
            // Plan expired
            echo 'Status: ' . $result['status'] . '<br>';
            echo 'Message: ' . $result['message'];
        }
    } else {
        // Invalid response
        echo 'Invalid API response';
    }
}

// Close cURL session
curl_close($ch);
?>
