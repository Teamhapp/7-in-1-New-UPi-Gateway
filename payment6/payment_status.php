<?php
error_reporting(0);

// Define the base directory constant
define('ROOT_DIR', realpath(dirname(__FILE__)) . '/../');

// Securely include files using the ROOT_DIR constant
include ROOT_DIR . 'pages/dbFunctions.php';
include ROOT_DIR . 'auth/config.php';
include ROOT_DIR . 'pages/dbInfo.php';

// Sanitize input
$link_token = filter_input(INPUT_POST, 'LINKID', FILTER_SANITIZE_STRING);

// Fetch order_id based on the token from the payment_links table
$sql_fetch_order_id = "SELECT order_id, created_at FROM payment_links WHERE link_token = ?";
$stmt = $conn->prepare($sql_fetch_order_id);
$stmt->bind_param('s', $link_token);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row || !isset($row['order_id'])) {
    die("Order ID not found");
}

$order_id = $row['order_id'];

// Validate $order_id to prevent SQL injection
if (!ctype_alnum($order_id)) {
    die("Invalid order_id");
}

// Fetch order details
$slq_p = "SELECT * FROM orders WHERE order_id = ?";
$stmt = $conn->prepare($slq_p);
$stmt->bind_param('s', $order_id);
$stmt->execute();
$res_p = $stmt->get_result();
$order_details = $res_p->fetch_assoc();

if (!$order_details) {
    die("Order details not found");
}

$user_token = $order_details['user_token'];
$db_amount = $order_details['amount'];
$cxrbytectxnref = $order_details['paytm_txn_ref'];
$userid = $order_details['user_id'];

// Fetch app_fc from freecharge_token table
$sql_fetch_fc = "SELECT app_fc FROM freecharge_token WHERE user_token = ? AND user_id = ?";
$stmt = $conn->prepare($sql_fetch_fc);
$stmt->bind_param('ss', $user_token, $userid);
$stmt->execute();
$res_fc = $stmt->get_result();
$fc_row = $res_fc->fetch_assoc();

if (!$fc_row || !isset($fc_row['app_fc'])) {
    die("Freecharge token not found");
}

$app_fc = $fc_row['app_fc'];

// The URL to send the POST request to
$url = "https://miniapi.in/api/fc/trans";

// The data to send in the POST request
$data = [
    'cookie' => $app_fc,
    'amount' => $db_amount,
    'OrderID' => $cxrbytectxnref
];

// Initialize cURL session
$ch = curl_init($url);

// Set the options for cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
curl_setopt($ch, CURLOPT_POST, true); // Set method to POST
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Attach the data

// Execute the POST request
$response = curl_exec($ch);
if (curl_errno($ch)) {
    die("cURL error: " . curl_error($ch));
}
curl_close($ch);

// Decode JSON response
$response_data = json_decode($response, true);

if (isset($response_data['status']) && $response_data['status'] === true && isset($response_data['respcode']) && $response_data['respcode'] == 200) {
    // Update order status in the database
    $update_query = "UPDATE orders SET status = 'SUCCESS' WHERE order_id = ? AND user_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('ss', $order_id, $userid);
    $stmt->execute();
    
    echo 'success';
} elseif (isset($response_data['status']) && $response_data['status'] === false) {
    echo 'PENDING';
} else {
    echo 'error';
}
?>
