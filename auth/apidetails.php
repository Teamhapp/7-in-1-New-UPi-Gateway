<?php
include "header.php";



if(isset($_POST['get_api_token'])){
    
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "CSRF token verification failed!";
        exit(); // Stop processing the request
    }
    
    $bbbyteuserid=$_SESSION['user_id'];
    // Assuming $mobile is already defined in header.php
    $sanitizedMobile = mysqli_real_escape_string($conn, $mobile);

    $uniqueNumber = mt_rand(1000000000, 9999999999);
    $uniqueNumber = str_pad($uniqueNumber, 10, '0', STR_PAD_LEFT); 

    $key = md5($uniqueNumber);
    $keyquery = "UPDATE `users` SET user_token='$key' WHERE mobile = '$sanitizedMobile'";
    $queryres = mysqli_query($conn, $keyquery);
    
    //update token in orders table
    
    $keyqueryorders = "UPDATE `orders` SET user_token='$key' WHERE user_id = $bbbyteuserid";
    $queryorders = mysqli_query($conn, $keyqueryorders);
    
     //update token in reports table
    
    $keyqueryordersreports = "UPDATE `reports` SET user_token='$key' WHERE user_id = $bbbyteuserid";
    $queryordersreports = mysqli_query($conn, $keyqueryordersreports);
    
    
    
    
    //hdfc token update 
    
    $keyqueryhdfc = "UPDATE `hdfc` SET user_token='$key' WHERE user_id = $bbbyteuserid";
    $queryreshdfc = mysqli_query($conn, $keyqueryhdfc);
    
    // Updating user_token in bharatpe_tokens table
    $keyquerybharatpe = "UPDATE `bharatpe_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresbharatpe = mysqli_query($conn, $keyquerybharatpe);
    
    
    //update for phonepe  Updating user_token in phonepe_tokens  table and store_id table
    
    $keyqueryphonepetoken = "UPDATE `phonepe_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresphonepetoken = mysqli_query($conn, $keyqueryphonepetoken);
    
    //now to update user_token in table store_id
    
    $keyqueryphonepetoken2 = "UPDATE `store_id` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresphonepetoken2 = mysqli_query($conn, $keyqueryphonepetoken2);
    
    //now to update user_token in table paytm_tokens
    
    $keyquerypaytm2 = "UPDATE `paytm_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryrespaytm = mysqli_query($conn, $keyquerypaytm2);
    
    //now to update user_token in table googlepay_transactions
    
    $keyquerygooglepay = "UPDATE `googlepay_transactions` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresgooglepay = mysqli_query($conn, $keyquerygooglepay);
    
    //now to update user_token in table googlepay_tokens
    
     $keyquerygooglepay1 = "UPDATE `googlepay_tokens` SET user_token='$key' WHERE user_id = '$bbbyteuserid'";
    $queryresgooglepay1 = mysqli_query($conn, $keyquerygooglepay1);
    
    
    if($queryres && $queryreshdfc){
        
        
        
        // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "New API Key generated!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "apidetails"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

    exit;
    
    } else {
        
        
        
        
          // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "API Key Generating Failed!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "apidetails"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';
exit;
    }
}
?>
<?php

// Custom function to validate URLs
function isValidUrl($url) {
    $parsed_url = parse_url($url);
    return isset($parsed_url['host']) && preg_match("/\.\w+$/", $parsed_url['host']);
}

if(isset($_POST['update_webhook'])){
    
    
    $bytecallbackurl=mysqli_real_escape_string($conn,$_POST['webhook_url']);
    
    // Validate the webhook URL
    // Check if the URL has a valid TLD
    if (!isValidUrl($bytecallbackurl)) {
        
        // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Invalid webhook url!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "apidetails"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

        exit(); // Stop processing the request
    }

    
    
    // Assuming $mobile is already defined in header.php
    $sanitizedMobile = mysqli_real_escape_string($conn, $mobile);


    $key = md5($uniqueNumber);
    $keyquery = "UPDATE `users` SET  callback_url='$bytecallbackurl' WHERE mobile = '$sanitizedMobile'";
    $queryres = mysqli_query($conn, $keyquery);
    if($queryres){
        
        
        
        // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "Webhook Updated Successfully",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "apidetails"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

    exit;
    
    } else {
        
        
        
        
          // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error Updating Webhook Try again Later!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "apidetails"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';
exit;
    }
}
?>
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">API Details</h1>
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

						<!-- <h4 class="page-title">Api Documentation</h4>	 -->
	

									
						<div class="row row-card-no-pd">							
							<div class="col-md-12">
								<form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
								<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
								<div class="col-md-8 mb-2">
									<label>Api Token</label>
									<input type="text" placeholder="Click Generate Button for API Token" value="<?php echo htmlspecialchars($userdata['user_token'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
								</div>
								<div class="col-md-4 mb-2">
									<label>&nbsp;</label>
									<button type="submit" name="get_api_token" class="btn btn-primary btn-block">Generate Api Token</button>
								</div>
							  </form>
							</div>		
							
					     
							
							<div class="col-md-12">
							<form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
							<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
						   <div class="col-md-8 mb-2">
									<label>Webhook URL</label>
									<input type="url" name="webhook_url" placeholder="Enter Your Webhook URL" value="<?php echo htmlspecialchars($userdata['callback_url'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" required pattern="https?://[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/?[a-zA-Z0-9.-]*\??[a-zA-Z0-9.-]*" title="Enter a valid URL">
									<b style="color:red">Note: URL must include protocol (http / https)</b>
								</div>
								<div class="col-md-4 mb-2">
									<label>&nbsp;</label>
									<button type="submit" name="update_webhook" class="btn btn-primary btn-block">Update URL</button>
								</div>
							<hr>
								
							  </form>
							</div>

							<div class="col-md-12 mb-4"><hr></div>

							<div class="col-md-12">
								<h6 class="mb-3"><b>Create Order API</b></h6>
								<form class="row mb-4" method="POST" action="">
								<div class="col-md-12 mb-2">
									<label>URL</label>
									<input type="text" placeholder="URL" value="https://<?php echo htmlspecialchars($server, ENT_QUOTES, 'UTF-8'); ?>/api/create-order" class="form-control" readonly>
									<b style="color:red">Order Timeout 30 Minutes. Order Will Be Automatically Failed After 30 Minutes.</b>
								</div>
								<div class="col-md-12 mb-2">
									<label>Form-Encoded Payload (application/x-www-form-urlencoded)</label>
									<textarea type="text" placeholder="Form-Encoded Payload (Parameter)" class="form-control" style="height: 190px;" readonly>{
  "customer_mobile": "8145344963",
  "user_token": "<?php echo htmlspecialchars($userdata['user_token'], ENT_QUOTES, 'UTF-8'); ?>",
  "amount": "1",
  "order_id": "8787772321800",
  "redirect_url": "your website url",
  "remark1" : "testremark",
  "remark2 : "testremark2,
}</textarea>

								</div>
								<div class="col-md-6 mb-2">
									<label>Success Response</label>
									<textarea type="text" placeholder="Success Response" class="form-control" style="height: 230px;" readonly>
    {
    "status": true,
    "message": "Order Created Successfully",
    "result": {
        "orderId": "1234561705047510",
        "payment_url": "https://yourwebsite.com/payment/pay.php?data=MTIzNDU2MTcwNTA0NzUxMkyNTIy"
    }
}
</textarea>

								</div>
								<div class="col-md-6 mb-2">
									<label>Failed Response</label>
									<textarea type="text" placeholder="Failed Response" class="form-control" style="height: 140px;" readonly>{
    "status": "false",
    "message": "Order_id Already Exist"
}</textarea> 
								</div>
							  </form>
							</div>

							<div class="col-md-12 mb-4"><hr></div>

							<div class="col-md-12">
								<h6 class="mb-3"><b>Check Order Status API</b></h6>
								<form class="row mb-4" method="POST" action="">
								<div class="col-md-12 mb-2">
									<label>URL</label>
									<input type="text" placeholder="URL" value="https://<?php echo htmlspecialchars($server, ENT_QUOTES, 'UTF-8'); ?>/api/check-order-status" class="form-control" readonly>
								</div>
								<div class="col-md-12 mb-2">
									<label>Form-Encoded Payload (application/x-www-form-urlencoded)</label>
									<textarea type="text" placeholder="Post Data into Form Header into Form Header (Parameter)" class="form-control" style="height: 120px;" readonly>{
    "user_token": "2048f66bef68633fa3262d7a398ab577",
    "order_id": "8052313697"
}</textarea> 
								</div>
								<div class="col-md-6 mb-2">
									<label>Success Response</label>
									
								<textarea type="text" placeholder="Success Response" class="form-control" style="height: 190px;" readonly>
{
    "status": "COMPLETED",
    "message": "Transaction Successfully",
    "result": {
        "txnStatus": "COMPLETED",
        "resultInfo": "Transaction Success",
        "orderId": "784525sdD",
        "status": "SUCCESS",
        "amount": "1",
        "date": "2024-01-12 13:22:08",
        "utr": "454525454245"
    }
}
</textarea>

								</div>
								<div class="col-md-6 mb-2">
									<label>Failed Response</label>
									<textarea type="text" placeholder="Failed Response" class="form-control" style="height: 140px;" readonly>{
    "status": ERROR,
    "message": "Error Massege",
    
}</textarea> 
								</div>
							  </form>
							</div>      
							<script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
							<script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>