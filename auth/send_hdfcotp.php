<?php

// Dene the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed
// Include the database connection file
require_once(ABSPATH . 'header.php');


?>


<?php
if(isset($_POST['Verify'])){ //from last page
    
    if ($userdata['hdfc_connected']=="Yes"){
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
    
    // Function to sanitize user input
    function sanitizeInput($input) {
        if (is_string($input)) {
            return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
        } else {
            // Handle non-string input here (e.g., arrays, objects, etc.) if needed.
            return $input;
        }
    } 
    
    function curlGet2($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }
        curl_close($ch);
        return $response;
    }

    $no = filter_var($_REQUEST['hdfc_mobile'], FILTER_VALIDATE_INT);
    $url = 'https://' . $server . '/HDFCSoft/login.php?no=' . $no;
    
    $response = curlGet2($url);
    $json = json_decode($response, true);
    $status = $json["status"];
    $respMessage = $json["respMessage"];
    $sessionId = $json["sessionId"];
    $deviceid = $json["deviceid"];

    if ($status == 'Success') {
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
                        title: "HDFC UPI Settings",
                        html: `
                            <form id="hdfcForm" method="POST" action="hdfc_verify" class="mb-2">
                                <div class="row" id="merchant">
                                    <div class="col-md-12 mb-2">
                                        <label for="OTP">Enter OTP</label>
                                        <input type="number" name="OTP" id="OTP" placeholder="Enter OTP" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="PIN">Enter PIN</label>
                                        <input type="number" name="PIN" id="PIN" placeholder="Enter PIN" class="form-control" required>
                                    </div>
                                    <input type="hidden" name="number" value="' . $no . '">
                                    <input type="hidden" name="UPI" value="">
                                    <input type="hidden" name="user_token" value="' . $userdata['user_token'] . '">
                                  
                                    <input type="hidden" name="seassion" value="' . $sessionId . '">
                                    <input type="hidden" name="deviceid" value="' . $deviceid . '">
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
                title: "' . $respMessage . '!",
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
