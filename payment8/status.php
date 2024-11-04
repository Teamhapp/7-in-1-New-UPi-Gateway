<?php



date_default_timezone_set("Asia/Kolkata");

define('ROOT_DIR', realpath(dirname(__FILE__)) . '/../');
include ROOT_DIR . 'pages/dbFunctions.php';
include ROOT_DIR . 'pages/dbInfo.php';
include ROOT_DIR . 'auth/config.php';

$link_token = ($_POST["token"]);

// Fetch order_id based on the token from the payment_links table
$sql_fetch_order_id = "SELECT order_id, created_at FROM payment_links WHERE link_token = '$link_token'";
$result = getXbyY($sql_fetch_order_id);

if (count($result) === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Token not found or expired']);
    exit;
}

$order_id = $result[0]['order_id'];
$created_at = strtotime($result[0]['created_at']);
$current_time = time();

// Check if token is expired (5 minutes)
if (($current_time - $created_at) > (5 * 60)) {
    echo json_encode(['status' => 'error', 'message' => 'Token has expired']);
    exit;
}

// Fetch order details
$sql_order = "SELECT * FROM orders WHERE order_id='$order_id'";
$order_result = getXbyY($sql_order);

if (empty($order_result)) {
    echo json_encode(['status' => 'error', 'message' => 'Order not found']);
    exit;
}


$user_token = $order_result[0]['user_token'];
$redirect_url = $order_result[0]['redirect_url'] ?: 'https://'.$_SERVER["SERVER_NAME"].'/';  // If redirect URL is empty, set a default
$cxruser_id = $order_result[0]['user_id'];
$orderstatus = $order_result[0]['status'];

// If order is already successful, stop the process
if ($orderstatus == "SUCCESS") {
    echo json_encode(['status' => 'info', 'message' => 'Order is already successful']);
    exit;
}

// Fetch UPI and Authorization details for the user
$sql_mobikwik = "SELECT * FROM mobikwik_token WHERE user_token='$user_token'";
$mobikwik_result = getXbyY($sql_mobikwik);
$upi_id = $mobikwik_result[0]['merchant_upi'];
$Authorization = $mobikwik_result[0]['Authorization'];  // Removed double quotes

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['utrverify'])) { 
    $utr_number = ($_POST['utr_number']);
    $rrn = $utr_number;

    if (!empty($utr_number)) {
        // Check if UTR has already been used
        $utr_check_query = "SELECT * FROM orders WHERE utr='$utr_number'";
        $utr_check_result = mysqli_query($conn, $utr_check_query);

      
        // Initialize cURL session
        $ch = curl_init();

        // Set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, "https://webapi.mobikwik.com/p/wallet/history/v2");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        // Set headers
        $headers = [
            "accept: application/json, text/plain, */*",
            "accept-encoding: gzip, deflate, br, zstd",
            "accept-language: en-US,en;q=0.9",
            "authorization: $Authorization",  // Use the dynamic value of $Authorization
            "connection: keep-alive",
            "host: webapi.mobikwik.com",
            "origin: https://www.mobikwik.com",
            "referer: https://www.mobikwik.com/",
            'sec-ch-ua: "Chromium";v="128", "Not;A=Brand";v="24", "Google Chrome";v="128"',
            "sec-ch-ua-mobile: ?0",
            'sec-ch-ua-platform: "Windows"',
            "sec-fetch-dest: empty",
            "sec-fetch-mode: cors",
            "sec-fetch-site: same-site",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36",
            "x-mclient: 0"
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Tell cURL to automatically handle decoding of compressed responses
        curl_setopt($ch, CURLOPT_ENCODING, ""); // This allows cURL to handle gzip, deflate, br, and zstd

        // Execute the request
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); // Close cURL session
        
        

        if ($err) {
            echo json_encode(['status' => 'error', 'message' => "cURL Error: $err"]);
        } else {
            // Decode the JSON response
            $data = json_decode($response, true);

             if ($data && isset($data['data']['historyData'])) {
                $transactions = $data['data']['historyData'];

                // Loop through each transaction to match UTR, and other conditions
                $matchFound = false;
                foreach ($transactions as $transaction) {
                    if ( isset($transaction['rrn']) && $transaction['rrn'] == $rrn && $transaction['status'] == "success" && $transaction['mode'] == "credit") {
                        $matchFound = true;
                        break; // Exit the loop once a match is found
                    }
                }

                // If a match is found, update the order status
                if ($matchFound) {
                    // Update order status to SUCCESS and store the UTR number
                    $update_query = "UPDATE orders SET status='SUCCESS', utr='$utr_number' WHERE order_id='$order_id' AND user_id='$cxruser_id'";
                    $update_result = mysqli_query($conn, $update_query);

                    if ($update_result) {
                        echo json_encode(['status' => 'success', 'message' => 'Transaction successful', 'redirect_url' => $redirect_url]);
                        exit;
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Failed to update the order status']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Transaction not found or conditions did not match']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No transaction data found']);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'UTR number is missing']);
    }
}

?>
