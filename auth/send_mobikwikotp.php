<?php
define('cxrpaysecureheader', true);
// Dene the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed
// Include the database connection file
require_once(ABSPATH . 'header.php');


?>


<?php




if(isset($_POST['verifyotp'])) {
    

    $bbbyteuserid = $_SESSION['user_id'];
    $bbytepaytmuserid = $userdata['user_token'];
    $Authorization = ($_POST["auth"]);
    $bbytepaytmuserupiid = ($_POST["UPI"]);
    
    
    // Your authorization value
$authorization = $Authorization;

// Initialize a cURL session
$curl = curl_init();

// Set the URL and request method
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://webapi.mobikwik.com/p/wallet/history/v2',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '', // This will automatically handle 'gzip, deflate, br, zstd' encoding
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'accept: application/json, text/plain, */*',
        'accept-encoding: gzip, deflate, br, zstd',
        'accept-language: en-US,en;q=0.9',
        'authorization: ' . $authorization, // Authorization from variable
        'connection: keep-alive',
        'host: webapi.mobikwik.com',
        'origin: https://www.mobikwik.com',
        'referer: https://www.mobikwik.com/',
        'sec-ch-ua: "Chromium";v="128", "Not;A=Brand";v="24", "Google Chrome";v="128"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Windows"',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-site',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',
        'x-mclient: 0'
    ),
));

// Execute the request and get the response
$response = curl_exec($curl);

// Check for any errors
$err = curl_error($curl);

// Close the cURL session
curl_close($curl);


    // Output the response
 $decodedResponse = json_decode($response, true); // 'true' converts it into an associative array

    
    if ($decodedResponse['success']==false){
        
        
          // Show SweetAlert2 error message
       
        echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
            Swal.fire({
                icon: "error",
                title: "INVALID Authorization Code!!",
                showConfirmButton: true,
                confirmButtonText: "Ok!",
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "connect_merchant";
                }
            });
        </script>';
        exit();
        
        
        
    }

    $sqlUpdateUser = "UPDATE users SET mobikwik_connected='Yes' WHERE user_token='$bbytepaytmuserid'";
    $resultUpdateUser = mysqli_query($conn, $sqlUpdateUser);

    $sqlw = "UPDATE mobikwik_token SET Authorization='$Authorization', merchant_upi='$bbytepaytmuserupiid', status='Active', user_id=$bbbyteuserid WHERE user_token='$bbytepaytmuserid'";
    $result = mysqli_query($conn, $sqlw);

    if ($result) {
        // Show SweetAlert2 success message
       
        echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
            Swal.fire({
                icon: "success",
                title: "Congratulations! Your Mobikwik Has been Connected Successfully!",
                showConfirmButton: true,
                confirmButtonText: "Ok!",
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "connect_merchant";
                }
            });
        </script>';
        exit();
    } else {
        // Show SweetAlert2 error message
       
        echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
            Swal.fire({
                icon: "error",
                title: "Please Try Again Later!!",
                showConfirmButton: true,
                confirmButtonText: "Ok!",
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "connect_merchant";
                }
            });
        </script>';
        exit();
    }
}

if(isset($_POST['Verify'])) { ///to open this page from last
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
       
        echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
            Swal.fire({
                icon: "error",
                title: "CSRF token verification failed!",
                showConfirmButton: true,
                confirmButtonText: "Ok!",
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "connect_merchant";
                }
            });
        </script>';
        exit();
    }

    if ($userdata['mobikwik_connected'] == "Yes") {
        // Show SweetAlert2 error message
       
        echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
            Swal.fire({
                icon: "error",
                title: "Merchant Already Connected !!",
                showConfirmButton: true,
                confirmButtonText: "Ok!",
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "connect_merchant";
                }
            });
        </script>';
        exit();
    }

    $mobikwik_mobile = ($_POST["mobikwik_mobile"]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
    <script>
        Swal.fire({
            title: 'Mobikwik UPI Settings',
            html: `
                <form id="paytmForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-2">
                    <div class="row" id="merchant">
                        <div class="col-md-12 mb-2">
                            <label for="MID">Enter Authorization ID</label>
                             <input type="hidden" name="mobikwik_number" value="<?php echo $mobikwik_mobile; ?>">
                            <input type="text" name="auth" id="MID" placeholder="Enter Authorization ID" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="Number">Enter UPI ID</label>
                            <input type="text" name="UPI" id="Number" placeholder="Enter UPI ID"  class="form-control"  required>
                        </div>
                    
                        <div class="col-md-12 mb-2">
                            <button type="submit" name="verifyotp" class="btn btn-primary btn-block mt-2">Verify Mobikwik</button>
                        </div>
                    </div>
                </form>
            `,
            showCancelButton: false,
            showConfirmButton: false,
            customClass: {
                popup: 'swal2-custom-popup',
                title: 'swal2-title',
                content: 'swal2-content'
            },
            allowOutsideClick: false,
            allowEscapeKey: false
        });
    </script>
    <style>
        .swal2-custom-popup {
            max-width: 600px;
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .swal2-title {
            font-size: 24px;
            margin-bottom: 1em;
            color: #333;
            font-weight: bold;
        }
        .swal2-content {
            text-align: left;
        }
        .swal2-content form {
            display: flex;
            flex-direction: column;
        }
        .swal2-content .row {
            display: flex;
            flex-wrap: wrap;
        }
        .swal2-content .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 15px;
            box-sizing: border-box;
        }
        .swal2-content label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        .swal2-content input {
            margin-top: 0.5em;
            padding: 0.5em;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .swal2-content .btn-block {
            width: 100%;
            margin-top: 1em;
            padding: 0.75em;
            font-size: 16px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .swal2-content .btn-block:hover {
            background-color: #0056b3;
        }
    </style>
    <?php
} //iset from last page if(isset($_POST['Verify'])) {

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