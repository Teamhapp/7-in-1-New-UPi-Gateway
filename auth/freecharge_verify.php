<?php
define('cxrpaysecureheader', true);
// Define the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed
// Include the database connection file
require_once(ABSPATH . 'header.php');
?>


<?php


// Verify CSRF token
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verifyotp'])) {
    
   

    // Sanitize and validate the inputs
    $no = filter_var($_REQUEST['number'], FILTER_VALIDATE_INT);
    $otp = filter_var($_POST['OTP'], FILTER_VALIDATE_INT);
    $otpId = filter_var($_POST['otpid'], FILTER_SANITIZE_STRING);

    // The URL to send the POST request to
    $url = "https://miniapi.in/api/fc/verify-otp";

    // The data to send in the POST request
    $data = [
        'otp' => $otp,
        'otpid' => $otpId
    ];

    // Initialize cURL session
    $ch = curl_init($url);

    // Set the options for cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_POST, true); // Set method to POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Attach the data

    // Execute the POST request
    $response = curl_exec($ch);
    curl_close($ch);

    // Check for any errors in the cURL request
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        // Decode the response from the server
        $responseArray = json_decode($response, true);

        if (isset($responseArray['status']) && $responseArray['status'] === 'success') {
            $cookies = $responseArray['cookies'];
            
            
            
            // The URL to send the POST request to
    $url = "https://miniapi.in/api/fc/udetails";

    // The data to send in the POST request
    $data = [
        'app_fc' => $cookies
    ];

    // Initialize cURL session
    $ch = curl_init($url);

    // Set the options for cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_POST, true); // Set method to POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Attach the data

    // Execute the POST request
    $response = curl_exec($ch);
    curl_close($ch);
      $responseArray1 = json_decode($response, true);
      
      
      $upiid=$responseArray1['primary_vpa'];
    
    

            // Update the database with the new cookie
           // Update the database with the new cookie and Upiid
// Update the database with the new cookie and UPI ID
$query = "UPDATE freecharge_token SET app_fc='$cookies', Upiid='$upiid', status='Active' WHERE phoneNumber='$no'";
$result = mysqli_query($conn, $query);

            if ($result && mysqli_affected_rows($conn) > 0) {
                
                $ssid=$_SESSION['user_id'];
                $sqlwbb4 = "UPDATE users SET freecharge_connected='Yes' WHERE id='$ssid'";
$rodrtny = mysqli_query($conn, $sqlwbb4); 






    
    








            // Show SweetAlert2 success message
                            
echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your FreechargeHasbeen Connected Successfully!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "dashboard"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

} else {
    // Show SweetAlert2 error message
            
    $error = mysqli_error($conn); // Get the MySQL error message
$error="hi";
    echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Failed to update the database. Error: ' . $error . '",
            showConfirmButton: true,
            confirmButtonText: "Ok",
            allowOutsideClick: false,
            allowEscapeKey: false
        });
    </script>';
}

        } else {
            $errorMessage = isset($responseArray['errorMessage']) ? $responseArray['errorMessage'] : 'Unknown error';

            // Show SweetAlert2 error message
            
            echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
                Swal.fire({
                    icon: "error",
                    title: "' . $errorMessage . '!",
                    showConfirmButton: true,
                    confirmButtonText: "Ok!",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "upisettings";
                    }
                });
            </script>';
            exit();
        }
    }

    // Close the cURL session
    curl_close($ch);
}
?>

<!--bootstrap js-->
  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
  <!--plugins-->
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/plugins/metismenu/metisMenu.min.js"></script>
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/js/main.js"></script>


</body>

</html>