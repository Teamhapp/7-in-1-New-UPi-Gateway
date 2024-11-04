<?php
define('cxrpaysecureheader', true);
// Dene the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed
// Include the database connection file
require_once(ABSPATH . 'header.php');


?>


<?php
if(isset($_POST['Verify'])){ //from last page
    

    if ($userdata['freecharge_connected']=="Yes"){
        // Show SweetAlert2 error message
       
        echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
            Swal.fire({
                icon: "error",
                title: "Merchant Already Connected !!",
                showConfirmButton: true, // Show the confirm button
                confirmButtonText: "Ok!", // Set text for the confirm button
                allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
                allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "connect_merchant"; // Redirect to "connect_merchant" when the user clicks the confirm button
                }
            });
        </script>';
        exit();
    }
    

    

   $mobileNumber = filter_var($_REQUEST['freecharge_mobile'], FILTER_VALIDATE_INT);
   
   
    // The URL to send the POST request to
    $url = "https://miniapi.in/api/fc/send-otp";

    // The data to send in the POST request
    $data = [
        'no' => $mobileNumber
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
    $responseArray = json_decode($response, true);
    $status1=$responseArray['status'];
    $errorMessage=$responseArray['msg'];
    $otpId=$responseArray['otpId'];

    if ($status1 == 'success') {
        // Show success message
       
        echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
            Swal.fire({
                title: "Your OTP Has Been Sent!!",
                text: "Please click Ok button!!",
                icon: "success",
                confirmButtonText: "Ok"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Freecharge UPI Settings",
                        html: `
                            <form id="hdfcForm" method="POST" action="freecharge_verify" class="mb-2">
                                <div class="row" id="merchant">
                                    <div class="col-md-12 mb-2">
                                        <label for="OTP">Enter OTP</label>
                                        <input type="number" name="OTP" id="OTP" placeholder="Enter OTP" class="form-control" required>
                                    </div>
                                    <input type="hidden" name="number" value="' . $mobileNumber . '">
                                    <input type="hidden" name="user_token" value="' . $userdata['user_token'] . '">
                                    <input type="hidden" name="otpid" value="' . $otpId . '">
                                    <div class="col-md-12 mb-2">
                                        <button type="submit" name="verifyotp" class="btn btn-primary btn-block mt-2">Verify OTP</button>
                                    </div>
                                </div>
                            </form>
                        `,
                        showCancelButton: false,
                        showConfirmButton: false,
                        customClass: {
                            popup: "swal2-custom-popup",
                            title: "swal2-title",
                            content: "swal2-content"
                        },
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    });
                }
            });
        </script>';
    } else {
        // Show SweetAlert2 error message
       
        echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
            Swal.fire({
                icon: "error",
                title: "' . $errorMessage . '!",
                showConfirmButton: true, // Show the confirm button
                confirmButtonText: "Ok!", // Set text for the confirm button
                allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
                allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "connect_merchant"; // Redirect to "connect_merchant" when the user clicks the confirm button
                }
            });
        </script>';
        exit();
    }
} ////if(isset($_POST['Verify'])){ action from veirfy page


else{
    
echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Form Not Submitted!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "connect_merchant"; // Redirect to "connect_merchant" when the user clicks the confirm button
        }
    });
</script>';
exit;
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
