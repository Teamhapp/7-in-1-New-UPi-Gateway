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

// Check if token is expired (5 minutes)
if (($current_time - $created_at) > (5 * 60)) {
     echo "Token has expired";
    exit;
}

// Fetch order details
$sql_order = "SELECT * FROM orders WHERE order_id='$order_id'";
$order_result = getXbyY($sql_order);

if (empty($order_result)) {
      echo "'Order not found!";
    exit;
}

$amount = $order_result[0]['amount'];
$user_token = $order_result[0]['user_token'];
$redirect_url = $order_result[0]['redirect_url'];
$cxrkalwaremark = $order_result[0]['byteTransactionId'];
$cxrbytectxnref = $order_result[0]['paytm_txn_ref'];
$cxruser_id = $order_result[0]['user_id'];
$orderstatus = $order_result[0]['status'];

// If order is already successful, stop the process
if ($orderstatus == "SUCCESS") {
    echo "<script>Swal.fire('Success!', 'Order is already successful!', 'info');</script>";
    exit;
}

// If redirect URL is empty, set a default
if ($redirect_url == '') {
    $redirect_url = 'https://'.$_SERVER["SERVER_NAME"].'/';
}

// Fetch UPI and Authorization details for the user
$sql_mobikwik = "SELECT * FROM mobikwik_token WHERE user_token='$user_token'";
$mobikwik_result = getXbyY($sql_mobikwik);
$upi_id = $mobikwik_result[0]['merchant_upi'];
$Authorization = $mobikwik_result[0]['Authorization'];

// Fetch user details
$sql_user = "SELECT * FROM users WHERE user_token='$user_token'";
$user_result = getXbyY($sql_user);
$unitId = $user_result[0]['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTR Number Submission</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<script>
    $(document).ready(function () {
        Swal.fire({
            title: 'Enter UTR Number',
            input: 'text',
            inputLabel: 'UTR Number',
            inputPlaceholder: 'Enter your UTR number here',
            inputAttributes: {
                autocapitalize: 'off',
                oninput: "this.value = this.value.replace(/\\D/g, '').slice(0, 12);"
            },
            showCancelButton: true,
            confirmButtonText: 'Submit',
            didOpen: () => {
                // Add the name attribute to the confirm button after the alert is opened
                const confirmButton = Swal.getConfirmButton();
                confirmButton.setAttribute('name', 'utrverify');
            },
            preConfirm: (utr_number) => {
                if (!utr_number) {
                    Swal.showValidationMessage('UTR number is required!');
                    return false;
                } else {
                    return new Promise((resolve) => {
                        // Submit UTR and token to khilaadixpro.shop/payment8/status.php via POST
                        $.post("https://<?php echo $_SERVER["SERVER_NAME"] ?>/payment8/status.php", {
                            utr_number: utr_number,    // Send UTR number
                            token: '<?php echo $link_token; ?>',  // Send token from PHP
                            utrverify: ''               // Send empty utrverify
                        }, function(response) {
                            // Handle the response from the PHP page
                            if (response.status === 'success') {
                                Swal.fire('Success', response.message, 'success').then(() => {
                                    // Redirect if the response contains a redirect URL
                                    if (response.redirect_url) {
                                        window.location.href = response.redirect_url;
                                    }
                                });
                            } else if (response.status === 'error') {
                                Swal.fire('Error', response.message, 'error');
                            } else if (response.status === 'info') {
                                Swal.fire('Info', response.message, 'info');
                            }
                            resolve(response);
                        }, 'json').fail(function() {
                            Swal.fire('Error', 'There was an issue processing your UTR number!', 'error');
                        });
                    });
                }
            }
        });
    });
</script>




</body>
</html>
