<?php

// Dene the absolute path to the functions.php file
define('ABSPATH', dirname(__FILE__) . '/'); // Adjust the path as needed
// Include the database connection file
require_once(ABSPATH . 'header.php');


?>

<?php
// Function to sanitize user input
    function sanitizeInput($input) {
        if (is_string($input)) {
            return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
        } else {
            // Handle non-string input here (e.g., arrays, objects, etc.) if needed.
            return $input;
        }
    }
    






if(isset($_POST['verifyotp'])) {
    
   
    
    // Show SweetAlert2 error message
                           
echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Merchant instance not set in instance app!!",
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

    
    $bbbyteuserid=$_SESSION['user_id'];
    
    $postinstanceid=($_POST["IID"]);
    $postinstancesecret=($_POST["IIDSecret"]);
    $postupiid=($_POST["UPI"]);
    
    // Check if instance_id and instance_secret match a record in the users table
$query = "SELECT id, user_token FROM users WHERE instance_id = ? AND instance_secret = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $postinstanceid, $postinstancesecret);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    // Code to execute when the conditions are not met
    // Show SweetAlert2 error message
                           
echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Invalid Instance ID!!",
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

} else {
    // Matching record found, fetch id and user_token
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
    $user_token = $row['user_token'];
    $cxrabbidverify=$userdata['user_token'];
    
    if ($cxrabbidverify==$user_token){
        
       
       $sqlUpdateUser = "UPDATE users SET googlepay_connected='Yes' WHERE user_token='$cxrabbidverify'";
    $resultUpdateUser = mysqli_query($conn, $sqlUpdateUser);
    
    
       $sqlw = "UPDATE googlepay_tokens SET Instance_Id='$postinstanceid', Upiid='$postupiid', status='Active', user_id=$bbbyteuserid WHERE user_token='$cxrabbidverify'";
$result = mysqli_query($conn, $sqlw);

if ($result) {
       
  
    
     
    // Show SweetAlert2 success message
                           
echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your Google Pay Hasbeen Connected Successfully!",
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

    //exit;
    
    
} else {
    // Query failed
  //  echo "Error: " . mysqli_error($conn);
  
   // Show SweetAlert2 error message
                           
echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Please Try Again Later!!",
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


       
       

    }  //> if condition for token match
    
    else{
        
       
echo '<script src="js/jquery-3.2.1.min.js"></script>';echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';echo '<script>$("#loading_ajax").hide();
    Swal.fire({
        icon: "error",
        title: "Invalid Token Mismatch!!",
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
    }  //> token mismatch
        
    
    
    

}
    
    
    
   

    
}
//form


if(isset($_POST['Verify'])) {
    


if ($userdata['googlepay_connected']=="Yes"){
        
         
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
exit;

        
        
    }
    
    $bbgooglepaymobile=($_POST['googlepay_mobile']); 
    $constructedUpi = $bbgooglepaymobile . '-1@okaxis';
    
    $instanceId=$userdata['instance_id'];
    $secret=$userdata['instance_secret'];
    
    $baseUrl = 'https://khilaadixpro.shop/api/instance/events/google-pay';
$fullUrl = $baseUrl . '?instance=' . urlencode($instanceId) . '&secret=' . urlencode($secret);

    

    // Now, you can use the $paytm_mobile variable as needed
?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Google Pay UPI Settings</h4>
                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-2">
                            <div class="row" id="merchant">
                                <div class="col-md-4 mb-2"> 
                                    <label>Enter Instance ID</label> 
                                    <input type="text" name="IID" placeholder="Enter Instance ID"  class="form-control" required=""> 
                                    <input type="hidden" class="form-control" id="IIDSecret" name="IIDSecret" value="<?php echo $secret; ?>">
                                </div>
                                
                               <div class="col-md-4 mb-2"> 
                               <label>Instance Url</label> 
                               <input type="text" name="Iurl" placeholder="Instance Url" value="<?php echo $fullUrl; ?>" class="form-control" required readonly> 
                               </div>

                                <div class="col-md-4 mb-2"> 
                                    <label>Upi ID</label>
                                <input type="text" class="form-control" id="number" name="UPI" value="<?php echo $constructedUpi; ?>">
                                
                                </div>
                                <div class="col-md-4 mb-2"> 
                                
                                </div>
                                    <label>&nbsp;</label> 
                                    <button type="submit" name="verifyotp" class="btn btn-primary btn-block">Verify Google Pay</button> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} // End of if(isset($_POST['Verify']))

?>
