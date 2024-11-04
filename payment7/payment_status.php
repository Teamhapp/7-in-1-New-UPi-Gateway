<?php
error_reporting(0);

// Define the base directory constant
define('ROOT_DIR', realpath(dirname(__FILE__)) . '/../');

// Securely include files using the ROOT_DIR constant
include ROOT_DIR . 'pages/dbFunctions.php';
include ROOT_DIR . 'auth/config.php';
include ROOT_DIR . 'pages/dbInfo.php';



///
// Function to generate a random IP address
function get_rand_ip(){
    $z = rand(1,240);
    $x = rand(1,240);
    $c = rand(1,240);
    $v = rand(1,240);
    $ip = $z.".".$x.".".$c.".".$v;    
    return $ip;
}

// Function to make a cURL request
function curl_request($method = null, $url, $postData, $header = array(), $hreturn = 0, $cookie = false, $cookieType = 'w', $timeout = 0, $ssl = false) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => $timeout,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => $header,
    ));

    if (!empty($postData)) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    }

    if ($hreturn == true) {
        curl_setopt($curl, CURLOPT_HEADER, $hreturn);
    }

    if (!empty($method)) {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    }

    if (!empty($cookie) && $cookieType == "w") {
        unlink("components/tmp/$cookie.txt");    
        curl_setopt($curl, CURLOPT_COOKIEJAR, "components/tmp/$cookie.txt");
        curl_setopt($curl, CURLOPT_COOKIEFILE, "components/tmp/$cookie.txt");
    }

    if (!empty($cookie) && $cookieType == "r") {
        curl_setopt($curl, CURLOPT_COOKIEFILE, "components/tmp/$cookie.txt");
    }

    if ($ssl == true) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
    }

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// Function to get transactions from the merchant system
function get_sbimerchant_transaction($mid, $tid, $guid) {
    $ip = get_rand_ip();

    $postData = array();
    $postData['MerchantID'] = $mid;
    $postData['TID'] = $tid;
    $postData['GUID'] = $guid;
    $postData['UserName'] = $mid;
    $postData['lang'] = "en";
    $postData = json_encode($postData);
    $length = strlen($postData);

    $url = "https://merchantapp.hitachi-payments.com/YMAVOLBP/MercMobAppResAPI/RestService.svc/GetLast7Transaction";
    $headers = array(
        "Content-Length: $length",
        "Content-Type: application/json",
        "user-agent: okhttp/3.12.13",
        "X-Forwarded-For: $ip"
    );

    $response = curl_request("POST", $url, $postData, $headers, false, false, false, 0, true);
    
    return json_decode($response, true);
}



// Sanitize input
$link_token = ($_POST['PAYID']); // 

// Fetch order_id based on the token from the payment_links table
$sql_fetch_order_id = "SELECT order_id, created_at FROM payment_links WHERE link_token = '$link_token'";
$result = getXbyY($sql_fetch_order_id);

if (!$result || !isset($result[0]['order_id'])) {
    die("Order ID not found");
}

$order_id = $result[0]['order_id'];

// Validate $order_id to prevent SQL injection
if (!ctype_alnum($order_id)) {
    die("Invalid order_id");
}

// Fetch order details
$slq_p = "SELECT * FROM orders WHERE order_id='$order_id'";
$res_p = getXbyY($slq_p);

if (!$res_p || !isset($res_p[0])) {
    die("Order details not found");
}

$user_token = $res_p[0]['user_token'];
$db_description = $res_p[0]['description'];
$hdfc_txn = $res_p[0]['HDFC_TXNID'];
$db_byte_status = $res_p[0]['status'];
$bbbyteremark1 = $res_p[0]['remark1'];
$cxrbytectxnref = $res_p[0]['paytm_txn_ref'];
$userid = $res_p[0]['user_id'];
$amount = $res_p[0]['amount'];



// Fetch app_fc from sbi_token table
$sql_fetch_fc = "SELECT merchant_username,merchant_csrftoken,merchant_session FROM sbi_token WHERE user_token='$user_token' AND user_id='$userid'";
$res_fc = getXbyY($sql_fetch_fc);

if (!$res_fc) {
    die("Freecharge token not found");
}

$mid = $res_fc[0]['merchant_username'];
$tid= $res_fc[0]['merchant_csrftoken'];
$guid= $res_fc[0]['merchant_session'];

$txnrefnote = $cxrbytectxnref; // PAYID == txn ref


$txn_response = get_sbimerchant_transaction($mid, $tid, $guid);

// Initialize $found as false
$found = false;

// Check if the API returned the correct structure
if (isset($txn_response['Result'][0]['Values']) && is_array($txn_response['Result'][0]['Values'])) {
    
    // Loop through the transaction records
    foreach ($txn_response['Result'][0]['Values'] as $transaction) {
        
        // Fetch relevant values from the transaction
        $transaction_invoice = $transaction['Invoice_Number'];
        $transaction_status = $transaction['Transaction_Status'];
        
        // Check if the invoice number matches and amount is equal, and the status is 'Paid'
        if ($transaction_invoice === $txnrefnote  && $transaction_status === "Paid") {
            $found = true;
            break;  // Exit the loop as we found the matching transaction
        }
    }
}

// If a match was found, update the order status to SUCCESS
if ($found) {
    $update_query = "UPDATE orders SET status='SUCCESS' WHERE order_id='$order_id' AND user_id='$userid'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo 'success';
    } else {
        echo 'Failed to update order status';
    }
} else {
    echo 'PENDING';
}

    

?>
