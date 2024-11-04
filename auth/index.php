<?php

include 'function.php'; // Custom functions if any
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../common/assets/" data-template="vertical-menu-template" data-style="light">

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<title><?php echo $site_settings['brand_name']; ?> | Login</title>
<link rel="icon" type="image/x-icon" href="../common/img/favicon.png" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../common/assets/vendor/fonts/remixicon/remixicon.css" />
<link rel="stylesheet" href="../common/assets/vendor/fonts/flag-icons.css" />
<link rel="stylesheet" href="../common/assets/vendor/libs/node-waves/node-waves.css" />
<link rel="stylesheet" href="../common/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="../common/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="../common/assets/css/demo.css" />
<link rel="stylesheet" href="../common/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="../common/assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="../common/assets/vendor/libs/@form-validation/form-validation.css" />
<link rel="stylesheet" href="../common/assets/vendor/css/pages/page-auth.css">
<script src="../common/assets/vendor/js/template-customizer.js"></script>
<script src="../common/assets/js/config.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="authentication-wrapper authentication-cover">
<div class="authentication-inner row m-0">
<!-- /Left Section -->
<div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-12 pb-2">
<div>
<img src="../common/img/auth-v2-login-illustration.Cx3OW7g8.png" class="authentication-image-model d-none d-lg-block" alt="auth-model" data-app-light-img="illustrations/auth-cover-login-illustration-light.png" data-app-dark-img="illustrations/auth-cover-login-illustration-dark.png">
</div>
<img src="../common/assets/img/illustrations/tree.png" alt="tree" class="authentication-image-tree z-n1">
<img src="../common/assets/img/illustrations/auth-cover-mask-light.png" class="scaleX-n1-rtl authentication-image d-none d-lg-block w-75" alt="triangle-bg" height="362" data-app-light-img="illustrations/auth-cover-mask-light.png" data-app-dark-img="illustrations/auth-cover-mask-dark.png">
</div>
<!-- /Left Section -->

<!-- Login -->
<div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-12 py-4">
<div class="w-px-400 mx-auto pt-5 pt-lg-0">
<div class="mb-4">
<img src="<?php echo $site_settings['logo_url']; ?>" alt="Logo" class="img-fluid" style="max-width: 150px; height: auto;">
</div>
<h4 class="mb-1">Welcome <?php echo $site_settings['brand_name']; ?>! 👋🏻</h4>
<p class="mb-5"><?php echo $site_settings['brand_name']; ?> | Login</p>

<?php

session_start(); // Start the PHP session
include "config.php"; // Include your database connection
include 'function.php'; // Custom functions if any

$showOtpForm = false;

// Function to send OTP to email
function sendOTPEmail($email, $otp, $sender_email) {
    $subject = "Your OTP Code";
    $message = "Your OTP code is: " . $otp . ". It is valid for 5 minutes.";
    $headers = "From: $sender_email\r\n";
    $headers .= "Reply-To: $sender_email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Send the email
    return mail($email, $subject, $message, $headers);
}

// Function to send OTP via WhatsApp API
function sendOTPViaWhatsApp($mobile, $otp, $whatsapp_api_url, $apikey, $sender_id) {
    $api_key = "$apikey"; // Your WhatsApp API key
    $sender = "$sender_id"; // Your WhatsApp sender number
    $message = urlencode("Your OTP code is: " . $otp . ". It is valid for 5 minutes.");

    // Ensure the number is formatted correctly for WhatsApp
    $formattedNumber = "91" . ltrim($mobile, '0'); // Prepend country code

    // Construct the URL for the WhatsApp API
    $url = "https://$whatsapp_api_url/send-message?api_key=$api_key&sender=$sender&number=$formattedNumber&message=$message";

    // Use file_get_contents or cURL to send the request
    $response = file_get_contents($url);

    return $response; // Return the API response
}

// Check if OTP is submitted
if (isset($_POST['verify_otp'])) {
    $otp = $_POST['otp'];
    $username = $_SESSION['username']; // Get the username from session

    // Verify OTP and check expiry
    $query = "SELECT * FROM users WHERE mobile = '$username' AND otp = '$otp' AND otp_expiry > NOW()";
    $run = mysqli_query($conn, $query);

    if (mysqli_num_rows($run) > 0) {
        // OTP verified successfully
        echo '<script>Swal.fire("OTP Verified!", "Redirecting to the dashboard...", "success").then(() => { window.location.href = "dashboard"; });</script>';
        exit;
    } else {
        echo '<script>Swal.fire("Invalid OTP!", "Please try again.", "error");</script>';
    }
}

// Check if login form is submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE mobile = '$username'";
    $run = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($run);

    if (mysqli_num_rows($run) > 0) {
        $hashFromDatabase = $row['password'];
        $acc_lock = $row['acc_lock'];
        $acc_ban = $row['acc_ban'];
        $byteuserid = $row['id'];
        $email = $row['email'];
        $whatsapp_alert = $row['whatsapp_alert'];
        $email_alert = $row['email_alert'];
        $is_otp = $row['is_otp'];

        if ($acc_ban == 'on') {
            echo '
            <script>
            Swal.fire({
                title: "Account Locked!",
                text: "Please contact the administrator.",
                icon: "error",
                confirmButtonText: "Ok"
            }).then(() => {
                window.location.href = "index";
            });
            </script>';
            exit;
        }

        if (password_verify($password, $hashFromDatabase)) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $byteuserid;

            $query = "UPDATE users SET acc_lock = 0 WHERE mobile = '$username'";
            mysqli_query($conn, $query);

            if ($is_otp === 'NO') {
                echo '<script>window.location.href = "dashboard";</script>';
                exit;
            }

            $otp = rand(100000, 999999);
            $otp_expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));

            $query = "UPDATE users SET otp = '$otp', otp_expiry = '$otp_expiry' WHERE mobile = '$username'";
            mysqli_query($conn, $query);

            if ($whatsapp_alert === 'YES') {
                $apiResponse = sendOTPViaWhatsApp($username, $otp, $whatsapp_api_url, $apikey, $sender_id);
            }

            if ($email_alert === 'YES') {
                if (sendOTPEmail($email, $otp, $sender_email)) {
                    echo '<script>Swal.fire("OTP Sent!", "An OTP has been sent to your email. Please check your inbox.", "success");</script>';
                } else {
                    echo '<script>Swal.fire("Error!", "Failed to send OTP via email. Please try again.", "error");</script>';
                }
            }

            $showOtpForm = true;
        } else {
            $acc_lock++;
            $query = "UPDATE users SET acc_lock = $acc_lock WHERE mobile = '$username'";
            mysqli_query($conn, $query);

            if ($acc_lock >= 3) {
                echo '
                <script>
                Swal.fire({
                    title: "Account Locked!",
                    text: "Too many failed login attempts. Please contact the administrator.",
                    icon: "error",
                    confirmButtonText: "Ok"
                }).then(() => {
                    window.location.href = "index";
                });
                </script>';
                exit;
            }

            echo '<script>Swal.fire("Invalid Password!", "Please try again.", "error");</script>';
        }
    } else {
        echo '<script>Swal.fire("Invalid Username!", "No account found with this mobile number.", "error");</script>';
    }
}
?>

<?php if (!$showOtpForm): ?>
<form id="formAuthentication" class="mb-3" action="index.php" method="POST">
    <div class="mb-3">
        <label for="username" class="form-label">Mobile Number</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your mobile number" autofocus />
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" />
    </div>
    
    <div class="mb-5 d-flex justify-content-between flex-wrap py-2">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" id="remember-me">
                                <label class="form-check-label me-2" for="remember-me">
                Remember Me
              </label>
                            </div>
                            <a href="../forgot-password" class="float-end mb-1">
              <span>Forgot Password?</span>
            </a>
                        </div>
    <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit" name="submit">Login</button>
    </div>
</form>
<?php else: ?>
<form id="otpForm" class="mb-3" action="index.php" method="POST">
    <div class="mb-3">
        <label for="otp" class="form-label">Enter OTP</label>
        <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter the OTP" autofocus />
    </div>
    <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit" name="verify_otp">Verify OTP</button>
    </div>
    </form>
<?php endif; ?>

<p class="text-center">
<span>New on our platform?</span>
<a href="../Register">
<span>Create an account</span>
</a>
</p>

<div class="divider my-5">
<div class="divider-text">or</div>
</div>

<div class="d-flex justify-content-center gap-2">
<a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
<i class="tf-icons ri-facebook-fill ri-24px"></i>
</a>
<a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
<i class="tf-icons ri-twitter-fill ri-24px"></i>
</a>
<a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
<i class="tf-icons ri-github-fill ri-24px"></i>
</a>
<a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
<i class="tf-icons ri-google-fill ri-24px"></i>
</a>
</div>
</div>
</div>
<!-- /Login -->
</div>
</div>
</div>

<!-- Core JS -->
<script src="../common/assets/vendor/libs/jquery/jquery.js"></script>
<script src="../common/assets/vendor/libs/popper/popper.js"></script>
<script src="../common/assets/vendor/js/bootstrap.js"></script>
<script src="../common/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="../common/assets/vendor/libs/@form-validation/form-validation.js"></script>
<script src="../common/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../common/assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="../common/assets/js/main.js"></script>
<script src="../common/assets/js/pages-auth.js"></script>
</body>

</html>