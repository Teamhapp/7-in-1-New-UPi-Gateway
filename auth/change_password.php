<?php
include "header.php";
if (isset($_REQUEST['update'])) {
    
   

    // Assuming $mobile is already defined in header.php
    $sanitizedMobile =  $mobile;
    
    // Sanitize input using mysqli_real_escape_string
    $current_password =  $_REQUEST['current_password'];
    $new_password =  $_REQUEST['new_password'];
    $confirm_password =  $_REQUEST['confirm_password'];

    // Retrieve the hashed password from the database
    $query = "SELECT `password` FROM `users` WHERE `mobile` = '$sanitizedMobile'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $hashedPasswordFromDB = $row['password'];
        
        // Check if the current password matches the stored hashed password
        if (password_verify($current_password, $hashedPasswordFromDB)) {
            if ($new_password === $confirm_password) {
                // Hash the new password using bcrypt
                $newpass = password_hash($new_password, PASSWORD_DEFAULT);
                
                // Update the password in the database
                $passwor = "UPDATE `users` SET `password` = '$newpass' WHERE `mobile` = '$sanitizedMobile'";
                $up = mysqli_query($conn, $passwor);
                
                if ($up) {
                    // Password changed successfully
                    
                     echo '<script src="js/jquery-3.2.1.min.js"></script>';         echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';         echo '<script>         $("#loading_ajax").hide();
                        Swal.fire({
                            icon: "success",
                            title: "Password Changed Successfully",
                            text: "Your password has been updated.",
                            showConfirmButton: true,
                            confirmButtonText: "Ok",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "dashboard.php";
                            }
                        });
                    </script>';
                    exit;
                } else {
                    // Password update failed, handle the error
                    
                     echo '<script src="js/jquery-3.2.1.min.js"></script>';         echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';         echo '<script>         $("#loading_ajax").hide();
                        Swal.fire({
                            icon: "error",
                            title: "Password Update Failed",
                            text: "Please try again later.",
                            showConfirmButton: true,
                            confirmButtonText: "Try Again",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "changepassword.php";
                            }
                        });
                    </script>';
                    exit;
                }
            } else {
                // New Password and Confirm Password do not match
                
                 echo '<script src="js/jquery-3.2.1.min.js"></script>';         echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';         echo '<script>         $("#loading_ajax").hide();
                    Swal.fire({
                        icon: "error",
                        title: "New Password and Confirm Password Do Not Match",
                        showConfirmButton: true,
                        confirmButtonText: "Try Again",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "changepassword.php";
                        }
                    });
                </script>';
                exit;
            }
        } else {
            // Current Password does not match
            
             echo '<script src="js/jquery-3.2.1.min.js"></script>';         echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';         echo '<script>         $("#loading_ajax").hide();
                Swal.fire({
                    icon: "error",
                    title: "Current Password Does Not Match",
                    showConfirmButton: true,
                    confirmButtonText: "Try Again",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "changepassword.php";
                    }
                });
            </script>';
            exit;
        }
    } else {
        // Database query error
        
         echo '<script src="js/jquery-3.2.1.min.js"></script>';         echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';         echo '<script>         $("#loading_ajax").hide();
            Swal.fire({
                icon: "error",
                title: "Please try again later.",
                text: "Please try again later.",
                showConfirmButton: true,
                confirmButtonText: "Try Again",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "changepassword.php";
                }
            });
        </script>';
        exit;
    }
}
?>
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Change Password</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <!-- <li class="breadcrumb-item">Icons</li> -->
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                        <!-- <div class="row"> -->
                            <!-- <div class="col-md-4"> -->
                                <div class="card m-t-20 m-b-20">
                                    <div class="card-body">
                                    <div class="main-panel">

                                    <div class="main-panel">
<div class="content">
    <div class="container-fluid">

        <!-- <h4 class="page-title">Change Password</h4>	 -->
                        
        <div class="row row-card-no-pd">							
            <div class="col-md-12">
                <form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                     <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="col-md-4 mb-3">
                    <label>Current Password</label>
                    <input type="password" name="current_password" placeholder="Current Password" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>New Password</label>
                    <input type="password" name="new_password" placeholder="New Password" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <button type="submit" name="update" class="btn btn-primary btn-block">Change Password</button>
                </div>

              </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</body>
<script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/rechpay.js?1697765682"></script>
<script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
<script type="text/javascript">
function utr_search(utr_number){
if(getCurentFileName()=="transactions"){	
if(utr_number.length==12){
search_txn('2023-10-01','2023-10-20','',utr_number);
}else{
Swal.fire('Enter Valid UTR Number!');	
}
}else{
location.href ='transactions';
}
}
</script>
</html>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
$("#dataTable").DataTable();
});
</script>
<script src="assets/js/bharatpe.js?1697765682"></script>
