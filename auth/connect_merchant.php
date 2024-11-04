<?php include "header.php"; ?>
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Merchant Connect Setting</h1>
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
				<div class="content">
					<div class="container-fluid">
						<!-- <h4 class="page-title">UPI Settings</h4> -->
						<div class="row row-card-no-pd">
							<div class="col-md-12">
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['addmerchant'])){
    
    
    $bbbytemerchant = mysqli_real_escape_string($conn, $_POST['merchant_name']);
    
    if ($bbbytemerchant=="hdfc"){
    $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
    $data = "INSERT INTO hdfc(id, number, seassion, device_id, user_token, pin, upi_hdfc, UPI, tidlist, status, mobile) VALUES ('','$no','','','" . $userdata['user_token'] . "','','','','', 'Deactive','$mobile')";
    $insert = mysqli_query($conn, $data);
    }
    
    elseif ($bbbytemerchant=="phonepe"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO phonepe_tokens (user_token, phoneNumber, userId, token, refreshToken, name, device_data)
        VALUES ('$bbbytetokken', '$no', '', '', '', '', '')";
$insert = mysqli_query($conn, $data);


    }
    elseif ($bbbytemerchant=="paytm"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO paytm_tokens (user_token, phoneNumber, MID, Upiid)
        VALUES ('$bbbytetokken', '$no', '','')";
        $insert = mysqli_query($conn, $data);


    }
    
    elseif ($bbbytemerchant=="bharatpe"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO bharatpe_tokens (user_token, phoneNumber, token, cookie, merchantId)
        VALUES ('$bbbytetokken', '$no', '', '', '')";
$insert = mysqli_query($conn, $data);
     }
     
     elseif ($bbbytemerchant=="googlepay"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO googlepay_tokens (user_token, phoneNumber, Instance_Id, Upiid)
        VALUES ('$bbbytetokken', '$no', '','')";
        $insert = mysqli_query($conn, $data);


    }

    elseif ($bbbytemerchant=="sbi"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
         $fcuser_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session

$data = "INSERT INTO sbi_token (user_token, phoneNumber, user_id)
         VALUES ('$bbbytetokken', '$no', '$fcuser_id')";
$insert = mysqli_query($conn, $data);



    }
    
    
     elseif ($bbbytemerchant=="freecharge"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
         $fcuser_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session

$data = "INSERT INTO freecharge_token (user_token, phoneNumber, user_id)
         VALUES ('$bbbytetokken', '$no', '$fcuser_id')";
$insert = mysqli_query($conn, $data);



    }
    elseif ($bbbytemerchant=="mobikwik"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
         $fcuser_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session

$data = "INSERT INTO mobikwik_token (user_token, phoneNumber, user_id)
         VALUES ('$bbbytetokken', '$no', '$fcuser_id')";
$insert = mysqli_query($conn, $data);



    }
    
        
    
    
    if($insert){
        
        
        
        
        // Show SweetAlert2 success message
                            
 echo '<script src="js/jquery-3.2.1.min.js"></script>';
 echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';         echo '<script>         $("#loading_ajax").hide();
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your Merchant Hasbeen Added Successfully!",
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
        
    
        
        
    }else{
        
        
        // Show SweetAlert2 error message
                            
 echo '<script src="js/jquery-3.2.1.min.js"></script>';         echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';         echo '<script>         $("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Opps Sorry Merhcant Adding Failure!",
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
}


if (isset($_POST['delete'])) {
    
    
    

 

    $merchant_type = mysqli_real_escape_string($conn, $_POST['merchant_type']);
    $token = $userdata['user_token'];

    // Initialize the delete and update queries
    $del = "";
    $update = "";

    // Construct the delete and update queries based on merchant type
    if ($merchant_type == 'hdfc') {
        $del = "DELETE FROM hdfc WHERE user_token = '$token'";
        $update = "UPDATE users SET hdfc_connected = 'No' WHERE user_token = '$token'";
    } elseif ($merchant_type == 'phonepe') {
        $del = "DELETE FROM phonepe_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET phonepe_connected = 'No' WHERE user_token = '$token'";
        
        // Add a query to delete from the store_id table as well
        $del_store_id = "DELETE FROM store_id WHERE user_token = '$token'";
        mysqli_query($conn, $del_store_id);
    } elseif ($merchant_type == 'paytm') {
        $del = "DELETE FROM paytm_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET paytm_connected = 'No' WHERE user_token = '$token'";
    } elseif ($merchant_type == 'bharatpe') {
        $del = "DELETE FROM bharatpe_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET bharatpe_connected = 'No' WHERE user_token = '$token'";
    }  elseif ($merchant_type == 'googlepay') {
        
        $del = "DELETE FROM googlepay_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET googlepay_connected = 'No' WHERE user_token = '$token'";
        
    } elseif ($merchant_type == 'freecharge') {
        
        $del = "DELETE FROM freecharge_token WHERE user_token = '$token'";
        $update = "UPDATE users SET freecharge_connected = 'No' WHERE user_token = '$token'";
        
    }
    elseif ($merchant_type == 'sbi') {
        
        $del = "DELETE FROM sbi_token WHERE user_token = '$token'";
        $update = "UPDATE users SET sbi_connected = 'No' WHERE user_token = '$token'";
        
    }  
    elseif ($merchant_type == 'mobikwik') {
        
        $del = "DELETE FROM mobikwik_token WHERE user_token = '$token'";
        $update = "UPDATE users SET mobikwik_connected = 'No' WHERE user_token = '$token'";
        
    }

    // Execute the delete query
    $res_del = mysqli_query($conn, $del);

    // Execute the update query
    $res_update = mysqli_query($conn, $update);

    if ($res_del && $res_update) {
        // Show SweetAlert2 success message
        
         echo '<script src="js/jquery-3.2.1.min.js"></script>';         echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';         echo '<script>         $("#loading_ajax").hide();
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your Merchant Has been Deleted Successfully!",
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
        exit;
    } else {
        // Show SweetAlert2 error message
        
         echo '<script src="js/jquery-3.2.1.min.js"></script>';         echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';         echo '<script>         $("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Merchant Not Deleted! Contact Admin",
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
        exit;
    }
}

?>





							<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-2">


            
								<div class="row" id="merchant">
								    <div class="col-md-4 mb-2">
    									<label>Merchant Name</label>
    								<select name="merchant_name" class="form-control">
                                        <option value="hdfc">HDFC Vyapar</option>
                                        <option value="sbi">SBI Merchant </option>
                                        <option value="phonepe">Phonepe</option>
                                        <option value="paytm">Paytm</option>
                                        <option value="bharatpe">BharatPe</option>
                                        <option value="mobikwik"> Mobikwik</option>
                                        <!--<option value="googlepay">Google Pay</option>-->
                                         <option value="freecharge">Freecharge Upi</option>
                                    </select>

    								</div>
    								<div class="col-md-4 mb-2"> 
        								<label>Cashier Mobile Number</label> 
        								<input type="number" name="c_mobile" placeholder="Enter Mobile Number" class="form-control" onkeypress="if(this.value.length==10) return false;" required=""> 
    								</div>
                                    <div class="col-md-4 mb-2"> 
        								<label>&nbsp;</label> 
        								
        								<button type="submit" name="addmerchant" class="btn btn-primary btn-block">Add Merchant</button> 
        							</div>
								</div>
								
							</form>	



							<div class="table-responsive">
                        <h5>All Merchants</h5>
                        <table class="table table-sm table-hover table-bordered table-head-bg-primary" id="dataTable" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Merchant Type</th>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Last Sync</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$cxrrrrtoken = $userdata['user_token'];
$fetchData = "
    SELECT 'hdfc' AS merchant_type, id, number, date, status FROM hdfc WHERE user_token = '$cxrrrrtoken' 
    UNION ALL 
    SELECT 'phonepe' AS merchant_type, sl AS id, phoneNumber AS number, date, status FROM phonepe_tokens WHERE user_token = '$cxrrrrtoken'
    UNION ALL
    SELECT 'paytm' AS merchant_type, id, phoneNumber AS number, date, status FROM paytm_tokens WHERE user_token = '$cxrrrrtoken'
    UNION ALL
    SELECT 'bharatpe' AS merchant_type, id, phoneNumber AS number, date, status FROM bharatpe_tokens WHERE user_token = '$cxrrrrtoken'
    UNION ALL
    SELECT 'googlepay' AS merchant_type, id, phoneNumber AS number, date, status FROM googlepay_tokens WHERE user_token = '$cxrrrrtoken'
    UNION ALL
    SELECT 'freecharge' AS merchant_type, id, phoneNumber AS number, date, status FROM freecharge_token WHERE user_token = '$cxrrrrtoken'
    UNION ALL
    SELECT 'sbi' AS merchant_type, id, phoneNumber AS number, date, status FROM sbi_token WHERE user_token = '$cxrrrrtoken'
    UNION ALL
    SELECT 'mobikwik' AS merchant_type, id, phoneNumber AS number, date, status FROM mobikwik_token WHERE user_token = '$cxrrrrtoken'
";

// echo $fetchData;

$ssData = mysqli_query($conn, $fetchData);

if ($ssData) {
    $counter = 1;
    while ($merchant = mysqli_fetch_array($ssData)) {
        $class = ($merchant['status'] == 'Active') ? 'badge badge-success' : 'badge badge-danger';
        ?>
        <tr>
            <td><?php echo $counter++; ?></td>
            <td><?php echo !empty($merchant['merchant_type']) ? strtoupper(htmlspecialchars($merchant['merchant_type'], ENT_QUOTES, 'UTF-8')) : ''; ?></td>
            <td><?php echo !empty($merchant['number']) ? htmlspecialchars($merchant['number'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
            <td>
                <button type="button" class="btn ripple btn-primary px-2"><?php echo !empty($merchant['date']) ? htmlspecialchars($merchant['date'], ENT_QUOTES, 'UTF-8') : ''; ?></button>
            </td>
            <td style="color: <?php echo ($merchant['status'] == 'Active') ? 'green' : 'red'; ?>">
                <?php echo htmlspecialchars($merchant['status'], ENT_QUOTES, 'UTF-8'); ?>
            </td>
            <td>
<?php
if ($merchant['merchant_type'] == 'hdfc') {
    ?>
    <form action="send_hdfcotp" method="post">
        <input type="hidden" name="hdfc_mobile" value="<?php echo $merchant['number']; ?>">
        
        <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'phonepe') {
    ?>
    <form action="send_phonepeotp" method="post">
        <input type="hidden" name="phonepe_mobile" value="<?php echo $merchant['number']; ?>">
        
        <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'paytm') {
    ?>
    <form action="send_paytmotp" method="post">
        <input type="hidden" name="paytm_mobile" value="<?php echo $merchant['number']; ?>">
        
        <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'bharatpe') {
    ?>
    <form action="send_bharatpeotp" method="post">
        <input type="hidden" name="bharatpe_mobile" value="<?php echo $merchant['number']; ?>">
        
        <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'googlepay') {
    ?>
    <form action="send_googlepayotp" method="post">
        <input type="hidden" name="googlepay_mobile" value="<?php echo $merchant['number']; ?>">
        
        <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'freecharge') {
    ?>
    <form action="send_freechargeotp" method="post">
        <input type="hidden" name="freecharge_mobile" value="<?php echo $merchant['number']; ?>">
        
        <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'sbi') {
    ?>
    <form action="send_sbiotp" method="post">
        <input type="hidden" name="sbi_mobile" value="<?php echo $merchant['number']; ?>">
        
        <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'mobikwik') {
    ?>
    <form action="send_mobikwikotp" method="post">
        <input type="hidden" name="mobikwik_mobile" value="<?php echo $merchant['number']; ?>">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        <button class="btn ripple btn-primary px-2" name="Verify">Verify</button>
    </form>
    <?php
}
?>
            </td>
            <td>
<?php
if ($merchant['merchant_type'] == 'hdfc') {
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="hdfc_mobile" value="<?php echo $merchant['number']; ?>">
        <input type="hidden" name="merchant_type" value="hdfc">
        
        <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'phonepe') {
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="phonepe_mobile" value="<?php echo $merchant['number']; ?>">
        
        <input type="hidden" name="merchant_type" value="phonepe">
        <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'paytm') {
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="paytm_mobile" value="<?php echo $merchant['number']; ?>">
        
        <input type="hidden" name="merchant_type" value="paytm">
        <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'bharatpe') {
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="bharatpe_mobile" value="<?php echo $merchant['number']; ?>">
        
        <input type="hidden" name="merchant_type" value="bharatpe">
        <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'googlepay') {
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="googlepay_mobile" value="<?php echo $merchant['number']; ?>">
        
        <input type="hidden" name="merchant_type" value="googlepay">
        <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'freecharge') {
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="freecharge_mobile" value="<?php echo $merchant['number']; ?>">
        
        <input type="hidden" name="merchant_type" value="freecharge">
        <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'sbi') {
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="sbi_mobile" value="<?php echo $merchant['number']; ?>">
        
        <input type="hidden" name="merchant_type" value="sbi">
        <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
    </form>
    <?php
} elseif ($merchant['merchant_type'] == 'mobikwik') {
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="mobikwik_mobile" value="<?php echo $merchant['number']; ?>">
        
        <input type="hidden" name="merchant_type" value="mobikwik">
        <button class="btn ripple btn-danger px-2" name="delete">Delete</button>
    </form>
    <?php
}
?>
            </td>
        </tr>
        <?php
    }
}
?>
</tbody>
</table>


</div>
</div>
</div>

<script>
function showInvalidPasswordAlert(id) {
    alert('Invalid Password for merchant with ID: ' + id);
}
</script>



					</div>
				</div>
</div>
</div>
</div>
<script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- CORE PLUGINS-->
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
</body>
</html>
