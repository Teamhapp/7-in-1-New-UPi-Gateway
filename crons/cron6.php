<?php
// Define the base directory constant
define('PROJECT_ROOT', realpath(dirname(__FILE__)) . '/../');

// Securely include files using the PROJECT_ROOT constant
include PROJECT_ROOT . 'pages/dbFunctions.php';  // Assumes dbFunctions contains $conn
include PROJECT_ROOT . 'auth/config.php';  // Database configuration

date_default_timezone_set("Asia/Kolkata");

function get_rand_ip() {
    $z = rand(1, 240);
    $x = rand(1, 240);
    $c = rand(1, 240);
    $v = rand(1, 240);
    return "$z.$x.$c.$v";
}

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

// Function to fetch MID and GUID from the database
function get_active_merchant($conn) {
    $sql = "SELECT merchant_username, merchant_session FROM sbi_token WHERE status = 'Active' LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to update the last updated date of the merchant
function update_merchant_last_updated($conn, $mid) {
    $current_date = date('Y-m-d H:i:s'); // Current date and time
    $sql = "UPDATE sbi_token SET date = ? WHERE merchant_username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $current_date, $mid);
    return $stmt->execute();
}

// Function to deactivate the merchant
function deactivate_merchant($conn, $mid) {
    $sql = "UPDATE sbi_token SET status = 'Deactive' WHERE merchant_username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $mid);
    return $stmt->execute();
}

function get_sbimerchant_profile($mid, $guid) {
    $ip = get_rand_ip();

    $postData = array(
        'MID' => $mid,
        'GUID' => $guid,
        'UserName' => $mid
    );
    $postData = json_encode($postData);
    $length = strlen($postData);

    $url = "https://merchantapp.hitachi-payments.com/YMAVOLBP/MercMobAppResAPI/RestService.svc/GetProfileDetails";
    $headers = array(
        "Content-Length: $length",
        "Content-Type: application/json",
        "user-agent: okhttp/3.12.13",
        "X-Forwarded-For: $ip"
    );

    $response = curl_request("POST", $url, $postData, $headers, false, false, false, 0, true);
    $response = json_decode($response, true);

    if (isset($response['Result'])) {
        return $response['Result'];
    } else {
        return null; // Error handling in case there's no 'Result' key in the response
    }
}

// Assuming $conn is a valid MySQLi connection object
$merchant = get_active_merchant($conn);

if ($merchant) {
    $mid = $merchant['merchant_username'];
    $guid = $merchant['merchant_session'];

    $response = get_sbimerchant_profile($mid, $guid);
    print_r($response);
    
    if ($response && count($response) > 0) { 
        // Update last updated date if the profile data is found
        if (update_merchant_last_updated($conn, $mid)) {
            echo "Merchant last updated date successfully updated.";
        } else {
            echo "Failed to update merchant last updated date.";
        }
    } else {
        // Deactivate merchant if no profile data found
        if (deactivate_merchant($conn, $mid)) {
            echo "Merchant deactivated.";
        } else {
            echo "Failed to deactivate merchant.";
        }
    }
} else {
    echo "No active merchant found.";
}

?>
