<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="nofollow, noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include SweetAlert2 and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Khilaadi Payments</title>
    <style>
        body {
            background: #667eea;
            background: -webkit-linear-gradient(to right, #764ba2, #667eea);
            background: linear-gradient(to right, #764ba2, #667eea);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        
        .qr-wrapper {
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
        }
        
        .qr-container {
            background: #fff;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
            border-radius: 8px;
        }
        
        .qr-title {
            background: #343a40;
            color: #fff;
            padding: 10px;
            font-size: 18px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        
        .qr-code {
            padding: 10px;
            margin: 20px auto;
            display: inline-block;
            border: 4px solid;
            border-image-slice: 1;
            border-width: 4px;
            border-image-source: linear-gradient(45deg, #f3ec78, #af4261);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .amount {
            font-size: 16px;
            margin: 20px 0;
            color: #343a40;
        }
        
        .validity {
            font-size: 12px;
            color: #000000;
        }

        .pay-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>

<?php

date_default_timezone_set("Asia/Kolkata");

define('ROOT_DIR', realpath(dirname(__FILE__)) . '/../');
include ROOT_DIR . 'pages/dbFunctions.php';
include ROOT_DIR . 'pages/dbInfo.php';
include ROOT_DIR . 'auth/config.php';

$link_token = ($_GET["token"]);

// Fetch order_id based on the token from the payment_links table
$sql_fetch_order_id = "SELECT order_id, created_at FROM payment_links WHERE link_token = '$link_token'";
$result = getXbyY($sql_fetch_order_id);

if (count($result) === 0) {
    echo "Token not found or expired";
    exit;
}

$order_id = $result[0]['order_id'];
$created_at = strtotime($result[0]['created_at']);
$current_time = time();

if (($current_time - $created_at) > (5 * 60)) {
    echo "Token has expired";
    exit;
}

$slq_p = "SELECT * FROM orders where order_id='$order_id'";
$res_p = getXbyY($slq_p);    
$amount = $res_p[0]['amount'];
$user_token = $res_p[0]['user_token'];
$redirect_url = $res_p[0]['redirect_url'];
$cxrkalwaremark = $res_p[0]['byteTransactionId'];
$cxrbytectxnref = $res_p[0]['paytm_txn_ref'];
$cxruser_id = $res_p[0]['user_id'];

if ($redirect_url == '') {
    $redirect_url = 'https://kenzpay.com/';
}

$slq_p = "SELECT * FROM mobikwik_token where user_token='$user_token'";
$res_p = getXbyY($slq_p);
$upi_id = $res_p[0]['merchant_upi'];

$slq_p = "SELECT * FROM users where user_token='$user_token'";
$res_p = getXbyY($slq_p);
$unitId = $res_p[0]['name'];

$asdasd23 = "ARC" . rand(111, 999) . time() . rand(1, 100);

$orders = "upi://pay?pa=$upi_id&am=$amount&pn=$unitId&tn=$cxrbytectxnref&tr=$cxrkalwaremark";
$encoded_orders = urlencode($orders);

// Redirect URL for payment confirmation
$payment_verification_url = "https://kenzpay.com/payment8/verify/" . ($link_token);

$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . $encoded_orders;
?>

<body>
    <div class="qr-wrapper">
        <div class="qr-container">
            <div class="qr-title"><?php echo $unitId; ?></div>
            <div class="qr-code">
                <img src="<?php echo $qr_code_url; ?>" alt="QR Code" style="max-width: 100%;">
            </div>
            <div class="amount">Scan to pay ₹ <?php echo number_format($amount, 2); ?></div>
            <button class="pay-button" onclick="payViaUPI()">Confirm Payment</button>
            <div class="validity">Valid until: <span id="timeout"></span></div>
        </div>
    </div>

    <script>
        function payViaUPI() {
            window.location.href = "<?php echo $payment_verification_url; ?>";
        }

        window.onload = function () {
            var fiveMinutes = 60 * 5,
                display = document.querySelector('#timeout');
            startTimer(fiveMinutes, display);
        };

        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(this);
                }
            }, 1000);
        }
    </script>
</body>
</html>
