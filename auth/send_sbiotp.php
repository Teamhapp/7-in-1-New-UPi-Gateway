<?php
define('cxrpaysecureheader', true);
// Dene the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed
// Include the database connection file
require_once(ABSPATH . 'header.php');


?>


<?php
/////////////////////////

$sbiversion = "2.3.32";

function RandomString($length) {
    $key = '';
    $keys = array_merge(range('9', '0'), range('a', 'f'));
    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return $key;
}

function RandomNumber($length) {
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= mt_rand(0, 9);
    }
    return $str;
}




function get_rand_ip(){
    $z = rand(1,240);
    $x = rand(1,240);
    $c = rand(1,240);
    $v = rand(1,240);
    $ip = $z.".".$x.".".$c.".".$v;    
    return $ip;
}

function curl_request($method=null, $url, $postData, $header=array(), $hreturn=0, $cookie=false, $cookieType='w', $timeout=0, $ssl=false){
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

    if(!empty($postData)){
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    }

    if($hreturn==true){
        curl_setopt($curl, CURLOPT_HEADER, $hreturn);
    }

    if(!empty($method)){
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    }

    if(!empty($cookie) && $cookieType == "w"){
        unlink("components/tmp/$cookie.txt");    
        curl_setopt($curl, CURLOPT_COOKIEJAR, "components/tmp/$cookie.txt");
        curl_setopt($curl, CURLOPT_COOKIEFILE, "components/tmp/$cookie.txt");
    }

    if(!empty($cookie) && $cookieType == "r"){
        curl_setopt($curl, CURLOPT_COOKIEFILE, "components/tmp/$cookie.txt");
    }

    if($ssl == true){
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
    }

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}



if(isset($_POST['verifyotp'])) {
   

    $bbbyteuserid = $_SESSION['user_id'];
    $bbytepaytmuserid = $userdata['user_token'];
    $sbimerchantname = ($_POST["merchant_username"]);
    $sbimerchaantpassword = ($_POST["password"]);
    $sbimobiletoadd= ($_POST["sbi_number"]);
    
    
$merchant_username = $sbimerchantname;

function get_sbimerchant_validation($merchant_username){
    $ip = get_rand_ip();    
    $postData = array();
    $postData['UserID'] = $merchant_username;
    $postData['UUID'] = $merchant_username;
    $postData['version'] = '2.3.32'; // Assuming a default version since $sbiversion is undefined
    $postData['lang'] = "en";
    $postData = json_encode($postData);
    $length = strlen($postData);

    $url = "https://merchantapp.hitachi-payments.com/YMAVOLBP/MercMobAppResAPI/RestService.svc/UserValidation";
    $headers = array(
        "Content-Length: $length",
        "Content-Type: application/json",
        "user-agent: okhttp/3.12.13",
        "X-Forwarded-For: $ip"
    );

    $response = curl_request("POST", $url, $postData, $headers, false, false, false, 0, true);
    return json_decode($response, true);
}

$response = get_sbimerchant_validation($merchant_username);

if(empty($response['Result'][0]['ExistingUser'])){
    
    
    
    echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
        Swal.fire({
            icon: "error",
            title: "SBI ID INVALID!!",
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



$merchant_password = $sbimerchaantpassword;

function get_sbimerchant_login($merchant_username, $merchant_password) {
    global $sbiversion;  // Ensure the global variable is accessible
    $s1 = substr(hash('sha256', RandomNumber(13)), 0, 32);
    $s2 = substr(hash('sha256', RandomNumber(19)), 0, 32);
    $deviceFingerprint = RandomString(16) . 'c2RtNjM2-cWNvbQ-';
    $fingerprint = "$s1.$s2.Xiaomi." . RandomString(64);
    $ip = get_rand_ip();

    $postData = array(
        'username' => $merchant_username,
        'password' => "$merchant_password|LOGIN",
        'UUID' => $merchant_username,
        'mpin' => "",
        'guid' => "",
        'IPAddress' => "",
        'MobileInfo' => "Version.release : 11, Version.incremental : V12.5.1.0." . RandomString(6) . ", Version.sdk.number : 31, Board : Raphaelin, Bootloader : Unknown, Brand : Xiaomi, Cpu_abi : Arm64v8a, Cpu_abi2 : , Display : Rkq1.200826.002 Testkeys, Fingerprint : $fingerprint, Hardware : Qcom, Host : $deviceFingerprint, Id : Rkq1.200826.002, Manufacturer : Xiaomi, Model : Redmi 7, Product : Raphaelin, Serial : Unknown, Tags : Releasekeys, Type : User, Unknown : Unknown, User : Builder, App Version: $sbiversion",
        'version' => $sbiversion,
        'lang' => "en"
    );
    
    $postData = json_encode($postData);
    $length = strlen($postData);

    $url = "https://merchantapp.hitachi-payments.com/YMAVOLBP/MercMobAppResAPI/RestService.svc/Login";
    $headers = array(
        "Content-Length: $length",
        "Content-Type: application/json",
        "user-agent: okhttp/3.12.13",
        "X-Forwarded-For: $ip"
    );

    $response = curl_request("POST", $url, $postData, $headers, false, false, false, 0, true);
    return $response;
}

// Call the function and print the response
$response = get_sbimerchant_login($merchant_username, $merchant_password);

// Decode the JSON response
$decodedResponse = json_decode($response, true);

// Check if the response is valid JSON
/*if (json_last_error() === JSON_ERROR_NONE) {
    echo "<pre>";
    print_r($decodedResponse);
    echo "</pre>";
} else {
    echo $response;
}

*/

// Extract the required values
if (!empty($decodedResponse['Result'][0])) {
    $merchant_upi = "SBIPMOPAD." . $decodedResponse['Result'][0]['MID'] . "-" . $decodedResponse['Result'][0]['FinalTID'] . "@SBIPAY";

    if (!empty($decodedResponse['Result'][0]['GUID']) && $decodedResponse['Result'][0]['bqr'] > 0) {
        $merchant_session = $decodedResponse['Result'][0]['GUID'];
        $merchant_csrftoken = $decodedResponse['Result'][0]['FinalTID'];
        $merchant_token = $decodedResponse['Result'][0]['MercID'];
        
        
        
        // Prepare and execute SQL queries using $conn
            $stmt = $conn->prepare("UPDATE sbi_token SET merchant_username = ?, merchant_session = ?, merchant_csrftoken = ?, merchant_token = ?, merchant_upi = ?, status = 'Active' WHERE user_id = ? AND phoneNumber = ?");
            $stmt->bind_param("sssssis", $merchant_username, $merchant_session, $merchant_csrftoken, $merchant_token, $merchant_upi, $bbbyteuserid, $sbimobiletoadd);
            
            // Execute the first query
            $result1 = $stmt->execute();
            
            // Prepare and execute the second query
            $stmt = $conn->prepare("UPDATE users SET sbi_connected = 'Yes' WHERE id = ?");
            $stmt->bind_param("i", $bbbyteuserid);
            $result2 = $stmt->execute();

            // Check if both queries were successful
            if ($result1) {
               // echo "okay";.
               
               
        // Show SweetAlert2 success message
        
        echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
            Swal.fire({
                icon: "success",
                title: "Congratulations! Your Sbi Hasbeen Connected Successfully!",
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
        exit;
        
            }
            
            
            
            
      /*   
        echo "Merchant UPI: $merchant_upi\n";
        echo "<br>";
        echo "Merchant Session: $merchant_session\n";
        echo "<br>";
        echo "Merchant CSRF Token: $merchant_csrftoken\n";
        echo "<br>";
        echo "Merchant Token: $merchant_token\n";
        echo "<br>";
        
        */
        
    }
}
else{
    
       
        echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
            Swal.fire({
                icon: "error",
                title: "Sbi Password Wrong!",
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
        
        
} //sbi api response

} //if(isset($_POST['verifyotp'])) {

if(isset($_POST['Verify'])) { ///to open this page from last
  


    if ($userdata['sbi_connected'] == "Yes") {
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

    $sbimobile = ($_POST["sbi_mobile"]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
    <script>
        Swal.fire({
            title: 'SBI UPI Settings',
            html: `
                <form id="paytmForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-2">
                    <div class="row" id="merchant">
                        <div class="col-md-12 mb-2">
                            <label for="MID">Enter SBI Merchant ID</label>
                            <input type="text" name="merchant_username" id="MID" placeholder="Enter Merchant ID" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="Number">Enter Password</label>
                            <input type="hidden" name="sbi_number" value="<?php echo $sbimobile; ?>">
                            <input type="text" name="password" id="Number" placeholder="Enter Password" value="<?php echo $paytm_mobile; ?>" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-2">
                            <button type="submit" name="verifyotp" class="btn btn-primary btn-block mt-2">Verify Sbi Merchant</button>
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