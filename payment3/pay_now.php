<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f3f4f7;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            width: 95%;
            max-width: 400px;
            margin: 15px auto;
            background-color: #ffffff;
            border-radius: 14px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            padding-bottom: 20px;
        }

        .header {
            background-color: #2C3E88;
            padding: 15px;
            color: #fff;
            display: flex;
            align-items: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .header img {
            width: 50px;
            border-radius: 20%;
            margin-right: 10px;
        }

        .header .company-info {
            display: flex;
            flex-direction: column;
        }

        .company-info h1 {
            font-size: 16px;
            font-weight: 700;
        }

        .trusted-business {
            display: flex;
            
            align-items: center;
            margin-top: 5px;
        }

        .trusted-business img {
            width: 20px;
            margin-left: 5px;
        }

        .price-summary {
            background-color: #f2f3f7;
            padding: 15px;
            font-size: 14px;
            text-align: center;
            font-weight: bold;
        }

        /* QR Code Section */
        .qr-section {
            background-color: #f7f9fc;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
           justify-content: space-around;
            margin-bottom: 15px;
        }

        .qr-section img {
            width: 125px;
            height: 125px;
            border-radius: 10px;
        }

        .qr-section .center {
            text-align: center;
        }

        .qr-section .center span {
            display: block;
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 10px;
        }

        .qr-section .center .upi-icons {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .qr-section .center .upi-icons img {
            width: 14px;
            height: 14px;
            border-radius: 50%; /* Make icons round */
        }

        .payment-options {
            padding: 15px;
        }

        .payment-options h2 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Updated Recommended Section */
        .recommended {
            background-color: #f9f9f9;
            padding: 0;
            border-radius: 10px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .payment-method {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
            cursor: pointer;
        }

        .payment-method img {
            width: 24px;
            margin-right: 10px;
        }

        .payment-method:last-child {
            border-bottom: none;
        }

        .payment-method span {
            margin-left: 10px;
        }

        /* UPI Grid for 2 options per row */
        .upi-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .upi-options {
            display: flex;
            align-items: center;
            width: 48%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            cursor: pointer;
            background-color: #fff;
        }

        .upi-options img {
            width: 24px;
            margin-right: 10px;
        }

        /* Timer Style */
        .timer {
            text-align: center;
            font-size: 16px;
            padding: 10px;
            color: red;
        }

        /* Footer layout: price and button side by side */
        .footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #f3f4f7;
            border-top: 1px solid #e0e0e0;
        }

        .footer .price {
            font-size: 18px;
            font-weight: bold;
        }

        .footer button {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            padding: 5px 10px;
            font-size: 16px;
            color: white;
            background-color: blue;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            border: none;
        }

        .btn:hover {
            background-color: green;
        }
             .paytm-button {
    display: flex; /* Use flex to align items */
    justify-content: space-between; /* Space between the images */
    width: 85%;
    background-color: #fff;
    color: black;
    padding: 10px 20px;
    margin: 10px 0;
    border: 2px solid #1e88e5;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    transition: background-color 0.3s, color 0.3s;
}

.paytm-button:hover {
    background-color: #1e88e5;
    color: white;
}

.paytm-logo, .another-logo {
    height: 15px;
    width: 20px;
}


        .paytm-button:hover {
            background-color: #1e88e5; /* Dark blue on hover */
            color: white;
        }

        @media screen and (max-width: 768px) {
            .pay-button {
                display: inline-block;
            }
        }   
        
    /* Hide method-box by default */
.paytm-button {
    display: none;
}

/* Show method-box on screens smaller than 768px */
@media screen and (max-width: 768px) {
    .paytm-button {
        display: block;
    }
}
       header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2b3e87;
            color: white;
            padding: 10px 20px;
        }
        .time, .amount {
            font-size: 18px;
        }
        .amount {
            text-align: right;
        }
    </style>
</head>

<?php
date_default_timezone_set("Asia/Kolkata");

// Define the base directory constant
define('ROOT_DIR', realpath(dirname(__FILE__)) . '/../');

// Securely include files using the ROOT_DIR constant
include ROOT_DIR . 'pages/dbFunctions.php';
include ROOT_DIR . 'pages/dbInfo.php';

$link_token = sanitizeInput($_GET["token"]);

// Fetch order_id based on the token from the payment_links table
$sql_fetch_order_id = "SELECT order_id, created_at FROM payment_links WHERE link_token = '$link_token'";
$result = getXbyY($sql_fetch_order_id);

if (count($result) === 0) {
    // Token not found or expired
    echo "Token not found or expired";
    exit;
}

$order_id = $result[0]['order_id'];
$created_at = strtotime($result[0]['created_at']);
$current_time = time();

// Check if the token has expired (more than 5 minutes)
if (($current_time - $created_at) > (5 * 60)) {
    echo "Token has expired";
    exit;
}

$slq_p = "SELECT * FROM orders where order_id='$order_id'";
$res_p = getXbyY($slq_p);    
$amount = $res_p[0]['amount'];
$user_token = $res_p[0]['user_token'];
$redirect_url = $res_p[0]['redirect_url'];
$cxrkalwaremark = $res_p[0]['byteTransactionId'];  //remark
$cxrbytectxnref = $res_p[0]['paytm_txn_ref'];

if ($redirect_url == '') {
    $redirect_url = 'https://' . $_SERVER["SERVER_NAME"] . '/';    
}

// Fetch UPI ID
$slq_p = "SELECT * FROM paytm_tokens where user_token='$user_token'";
$res_p = getXbyY($slq_p);    
$upi_id = $res_p[0]['Upiid']; // UPI ID from Paytm tokens

// Fetch user information
$slq_p = "SELECT * FROM users where user_token='$user_token'";
$res_p = getXbyY($slq_p);    
$unitId = $res_p[0]['name'];

// Generate a unique transaction remark
$asdasd23 = "TXN" . rand(111, 999) . time() . rand(1, 100);
$orders = "upi://pay?pa=$upi_id&am=$amount&pn=$unitId&tn=$asdasd23&tr=$cxrbytectxnref";
$paytm="paytmmp://cash_wallet?pa=$upi_id&am=$amount&pn=$unitId&tn=$asdasd23&tr=$cxrbytectxnref&amp;mc=5641&amp;cu=INR&amp;url=&amp;mode=02&amp;purpose=00&amp;orgid=159002&amp;sign=MEUCIHldtBS8sv53BbdI9jtTN4vRokbPT91Fm6wlPQCN/sVkAiEAs4p9TPwTvLvPsceQLjSOBL1lAKhrsHdHMnfiDFyu1Aw=&amp;featuretype=money_transfer";

// Your custom QR code API URL
$url = 'https://imbx.in/secret/create_qr.php';

// Data to be sent in the POST request
$data = [
    'data' => $orders, // The data to encode
    'ecc' => 'M', // Error correction level ('L', 'M', 'Q', 'H')
    'size' => 8  // Size of the QR code
];

// Convert the data array into a JSON string
$jsonData = json_encode($data);

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_POST, true);  // Set method to POST
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);  // Set content type to JSON
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);  // Send data as JSON

// Execute the cURL request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Decode the JSON response
    $result = json_decode($response, true);

    // Check if there is an error in the response
    if (isset($result['error'])) {
        echo 'Error: ' . $result['error'];
    } else {
        // Success! The QR code is in base64 format.
        $qrCodeBase64 = $result['qr_code'];

        // Display the QR code image in the browser
        // echo '<img src="' . $qrCodeBase64 . '" alt="QR Code" />';
    }
}

// Close the cURL session
curl_close($ch);
?>


<body>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <img src="data:image/png;base64,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" alt="Company Logo">
            <div class="company-info">
                <h1><?php echo $unitId?></h1>
                <div class="trusted-business">
                   
                    <img src="https://d6xcmfyh68wv8.cloudfront.net/assets/trusted-badge/1st-fold/top-illustration-mob.svg" alt="Trusted Badge">
                     <p>Verified</p>
                </div>
            </div>
        </div>
                      <header>
    <div class="time" id="time"><span id="timeout"></div>
    <div class="amount"> ₹ <?php echo number_format($amount, 2); ?></div>
</header>

        <!-- Price Summary Section -->
       

        <!-- QR Code Section -->
        <div class="qr-section">
            <img src="<?php echo $qrCodeBase64; ?>" alt="QR Code">
            <div class="center">
                <span>SCAN WITH ANY APP</span>
                <div class="upi-icons">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyVO9LUWF81Ov6LZR50eDNu5rNFCpkn0LwYQ&s" alt="Google Pay">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTo4x8kSTmPUq4PFzl4HNT0gObFuEhivHOFYg&s" alt="PhonePe">
                    <img src="https://w7.pngwing.com/pngs/305/719/png-transparent-paytm-ecommerce-shopping-social-icons-circular-color-icon-thumbnail.png" alt="PayTM">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSouM4icV33KEDtJakZiySZN3HH2LPfv3-BA&s" alt="BHIM">
                    <img src="https://yt3.googleusercontent.com/QI4nyLQV7enKT5hvyJfs7UPoY9PZf3HQYxT5GM56GWiuXo4us2huT7Hru2FNCrgxsPSIJuNzyA=s900-c-k-c0x00ffffff-no-rj" alt="BHIM">
                    
                </div><br>
                <a href="<?php echo htmlspecialchars($qrCodeBase64); ?>" download="<?php echo htmlspecialchars($unique_filename); ?>" class="btn">SAVE QR</a>
            </div>
            
        </div>
    
      
    <center><a href="<?php echo $paytm; ?>" class="paytm-button">
    <img src="/img/new_tu1.png" alt="Paytm Logo" class="paytm-logo" style="width: 80px; height: 25px; margin-right: 100px;">
    <img src="/img/finger.png" alt="Another Icon" class="another-logo" style="width: 30px; height: 25px; margin-left: 25px;"></a><center>

        <!-- Payment Options Section -->
        <div class="payment-options">
          <?php
// Generating a unique filename using the current timestamp
$timestamp = time();
$unique_filename = "qr_code_" . $timestamp . ".png";

// Echoing the download link with the unique filename
?>
 
      
    </div>

    
    
    <script>
        // Flag to track whether payment status has already been processed
        var paymentProcessed = false;

        function payViaUPI() {
            // This function will be called when the user clicks the button
            window.location.href = "<?php echo $orders; ?>";
        }

        function upiCountdown(elm, minute, second, url) {
            document.getElementById(elm).innerHTML = minute + ":" + second;
            startTimer();

            function startTimer() {
                var presentTime = document.getElementById(elm).innerHTML;
                var timeArray = presentTime.split(/[:]+/);
                var m = timeArray[0];
                var s = checkSecond((timeArray[1] - 1));
                if (s == 59) {
                    m = m - 1;
                }
                if (m < 0) {
                    Swal.fire({
                        title: 'Oops',
                        text: 'Transaction Timeout!',
                        icon: 'error'
                    });
                    window.location.href = "https://<?php echo $_SERVER["SERVER_NAME"] ?>";
                }
                document.getElementById(elm).innerHTML = m + ":" + s;
                setTimeout(startTimer, 1000);
            }

            function checkSecond(sec) {
                if (sec < 10 && sec >= 0) { 
                    sec = "0" + sec;
                }
                if (sec < 0) { 
                    sec = "59"; 
                }
                return sec;
            }
        }

        upiCountdown("timeout", 5, 0, location.href);

        function checkPaymentStatus() {
            $.ajax({
                type: 'post',
                url: 'https://<?php echo $_SERVER["SERVER_NAME"] ?>/order3/payment-status',
                data: 'byte_order_status=<?php echo $cxrkalwaremark?>',
                success: function (data) {
                    if (!paymentProcessed) {
                        if (data == 'success') {
                            paymentProcessed = true;
                            Swal.fire({
                                title: '',
                                text: 'Your Payment Received Successfully 👍 Please Wait',
                                icon: 'success'
                            });
                            window.location.href = "<?php echo $redirect_url?>";
                        } else if (data == 'FAILURE') {
                            paymentProcessed = true;
                            Swal.fire({
                                title: '',
                                text: 'Your Payment Was Failed',
                                icon: 'error'
                            });
                            window.location.href = "<?php echo $redirect_url?>";
                        }
                    }
                }
            });    
        }

        setInterval(checkPaymentStatus, 5000);
    </script>
<script disable-devtool-auto="" src="https://pay.imb.org.in/Qrcode/disable-devtool.js" data-url="https://www.google.com/"></script> 
</body>
</html>