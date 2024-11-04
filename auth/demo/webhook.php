<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the data sent by the webhook
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];
    $remark1 = $_POST['remark1'];
    $utr = $_POST['utr'];

    // Check if the status is "SUCCESS"
    if ($status === 'SUCCESS') {
        // Process the data here as needed
        // For example, log it or perform other actions

        // Respond to the webhook with a success message
        echo "Webhook received successfully";
    } else {
        // Respond with an error message if the status is not "SUCCESS"
        http_response_code(400); // Bad Request
        echo "Invalid status: " . $status;
    }

    // You may want to add additional error handling and security measures here
} else {
    http_response_code(400); // Bad Request
    echo "Invalid request method";
}
?>
