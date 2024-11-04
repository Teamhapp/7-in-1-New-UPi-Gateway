<!DOCTYPE html>

<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="common/assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Forgot Password - UPI Gateway</title>


    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://themeselection.com/item/materio-bootstrap-html-admin-template/">


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="common/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="common/assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="common/assets/vendor/fonts/flag-icons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="common/assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="common/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="common/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="common/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="common/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="common/assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="common/assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="common/assets/vendor/css/pages/page-auth.css">

    <!-- Helpers -->
    <script src="common/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="common/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="common/assets/js/config.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="index.html" class="auth-cover-brand d-flex align-items-center gap-3">
    <span class="app-brand-logo demo">
<span style="color:var(--bs-primary);">
  <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z" fill="currentColor" />
    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z" fill="black" />
    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z" fill="black" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z" fill="currentColor" />
    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z" fill="black" />
    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z" fill="black" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z" fill="white" fill-opacity="0.15" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z" fill="white" fill-opacity="0.3" />
  </svg>
</span>
</span>
    <span class="app-brand-text demo text-heading fw-semibold">UPI Gateway</span>
  </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">

            <!-- /Left Section -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-12 pb-2">
               
                <img src="common/assets/img/illustrations/tree.png" alt="tree" class="authentication-image-tree z-n1">
                <img src="common/assets/img/illustrations/auth-cover-mask-light.png" class="scaleX-n1-rtl authentication-image d-none d-lg-block w-75" height="362" alt="triangle-bg" data-app-light-img="illustrations/auth-cover-mask-light.png" data-app-dark-img="illustrations/auth-cover-mask-dark.png">
            </div>
            <!-- /Left Section -->

            <!-- Forgot Password -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto">
                    <h4 class="mb-1">Forgot Password? 🔒</h4>
                    <p class="mb-5">Enter your email and we'll send you instructions to reset your password</p>
                    
                    <?php
include "auth/config.php";
if(isset($_POST['submit'])){
    // Sanitize input using mysqli_real_escape_string
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pan = mysqli_real_escape_string($conn, $_POST['pan']);

    $pass = rand(000000,999999);
    $password = password_hash($pass, PASSWORD_BCRYPT);


    $fetch = "SELECT * FROM users WHERE mobile='$username'";
    $res = mysqli_query($conn, $fetch);
    $row = mysqli_fetch_array($res);

    if(mysqli_num_rows($res) > 0){
        if($pan == $row['pan']){
            $update = "UPDATE users SET password='$password' WHERE mobile='$username'";
            $quer = mysqli_query($conn, $update);

            if($quer){
                $msg = "Dear " . $row['name'] . " Your New Password Below
                Your Password = $pass
                Thanks & Regards
                imb pay";
                $encodedMsg = urlencode($msg);
                
                //file_get_contents("https://wamsg.tk/wa.php?api_key=Wn62PIQ09X8BiY7iOtnEmgBCFFTDM3&sender=918145511275&number=91$username&message=$encodedMsg");

                echo '
    <script>
        Swal.fire({
            title: "Congratulations! Your New Password Sent to Your WhatsApp!!",
            text: "Your new password is: ' . $pass . '. Please Click Ok Button to proceed.",
            confirmButtonText: "Ok",
            icon: "success"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "auth/index"; // Replace with your desired redirect URL
            }
        });
    </script>
';
exit;
            } else {
                echo '
                <script>
                    Swal.fire({
                        title: "Opps! Something went wrong Please try again Later!!",
                        text: "Please Click Ok Button!!",
                        confirmButtonText: "Ok",
                        icon: "error"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "forgot-password"; // Replace with your desired redirect URL
                        }
                    });
                </script>
                ';
                exit;
            }
        } else {
            echo '
            <script>
                Swal.fire({
                    title: "Provided Pan Does Not Match Or Exist!!",
                    text: "Please Click Ok Button!!",
                    confirmButtonText: "Ok",
                    icon: "error"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "forgot-password"; // Replace with your desired redirect URL
                    }
                });
            </script>
            ';
            exit;
        }
    } else {
        echo '
        <script>
            Swal.fire({
                title: "Opps! Sorry Your Mobile Number Does Not Exist In Our Record!!",
                text: "Please Click Ok Button!!",
                confirmButtonText: "Ok",
                icon: "error"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "forgot-password"; // Replace with your desired redirect URL
                }
            });
        </script>
        ';
        exit;
    }
} 
?>

                    
                    <form class="mb-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your Mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>
                            <label for="email">Mobile Number</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-5">
                            <input type="text" class="form-control" id="pan" name="pan" placeholder="Enter PAN Number" pattern="[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}" title="Enter PAN number in the format: AAAAANNNNA"
         oninput="this.value = this.value.toUpperCase();" maxlength="10" required>
                            <label for="email">PAN Number</label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary d-grid w-100 mb-5">Forgot Password</button>
                    </form>
                    <div class="text-center">
                        <a href="auth/index" class="d-flex align-items-center justify-content-center">
            <i class="ri-arrow-left-s-line scaleX-n1-rtl ri-20px me-1_5"></i>
            Back to login
          </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>

    <!-- / Content -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="common/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="common/assets/vendor/libs/popper/popper.js"></script>
    <script src="common/assets/vendor/js/bootstrap.js"></script>
    <script src="common/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="common/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="common/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="common/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="common/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="common/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="common/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="common/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="common/assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="common/assets/js/main.js"></script>


    <!-- Page JS -->
    <script src="common/assets/js/pages-auth.js"></script>

</body>

</html>

<!-- beautify ignore:end -->