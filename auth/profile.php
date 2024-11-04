<?php
include "header.php";
include "database_connection.php"; // Ensure this is the correct path to your DB connection file

// Initialize variables to avoid undefined variable notices
$is_otp = '';
$whatsapp_alert = '';
$email_alert = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
// Capture the POST data
$is_otp = $_POST['is_otp']; // Will be either 'YES' or 'NO'
$whatsapp_alert = $_POST['whatsapp_alert']; // Will be either 'YES' or 'NO'
$email_alert = $_POST['email_alert']; // Will be either 'YES' or 'NO'
$mobile = $_POST['mobile']; // Assuming you want to update based on the mobile number or any unique identifier

// Update user profile logic
$query = "UPDATE users SET is_otp = ?, whatsapp_alert = ?, email_alert = ? WHERE mobile = ?";
$stmt = $conn->prepare($query); // Prepare the statement
$stmt->bind_param("ssss", $is_otp, $whatsapp_alert, $email_alert, $mobile); // Bind parameters

if ($stmt->execute()) {
// Use Swal.fire for success message
echo "<script>
Swal.fire({
title: 'Success!',
text: 'Profile updated successfully!',
icon: 'success',
confirmButtonText: 'OK'
});
  </script>";
} else {
// Use Swal.fire for error message
echo "<script>
Swal.fire({
title: 'Error!',
text: 'Error updating profile: " . addslashes($stmt->error) . "',
icon: 'error',
confirmButtonText: 'OK'
});
  </script>";
}

$stmt->close(); // Close the statement
}

// Fetch user data to display in the form
// Assuming you have a way to get user data based on the mobile or session
$query = "SELECT * FROM users WHERE mobile = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $mobile);
$stmt->execute();
$result = $stmt->get_result();
$userdata = $result->fetch_assoc();
$stmt->close();
?>

<!-- HTML Form Below -->
<div class="page-heading">
<h1 class="page-title">Manage My Profile</h1>
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="dashboard"><i class="la la-home font-20"></i></a>
</li>
</ol>
</div>
<div class="page-content fade-in-up">
<div class="ibox">
<div class="ibox-body">
<div class="card m-t-20 m-b-20">
<div class="card-body">
<div class="main-panel">
<div class="content">
<div class="container-fluid">
<h4 class="page-title">My Profile</h4>
<div class="row row-card-no-pd">
<div class="col-md-12">
<form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="col-md-4 mb-3">
<label>Instance ID</label>
<input type="text" placeholder="Username" value="<?php echo htmlspecialchars($userdata['instance_id'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
</div>
<div class="col-md-4 mb-3">
<label>Mobile Number</label>
<input type="text" name="mobile" placeholder="Mobile Number" value="<?php echo htmlspecialchars($userdata['mobile'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control input-solid" required>
</div>
<div class="col-md-4 mb-3">
<label>Email Address</label>
<input type="text" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($userdata['email'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control input-solid" required readonly>
</div>
<div class="col-md-4 mb-3">
<label>Name</label>
<input type="text" placeholder="Name" value="<?php echo htmlspecialchars($userdata['name'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
</div>
<div class="col-md-4 mb-3">
<label>Company Name</label>
<input type="text" placeholder="Company Name" value="<?php echo htmlspecialchars($userdata['company'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
</div>
<div class="col-md-4 mb-3">
<label>PAN Number</label>
<input type="text" placeholder="PAN Number" value="<?php echo htmlspecialchars($userdata['pan'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
</div>
<div class="col-md-4 mb-3">
<label>Aadhaar Number</label>
<input type="text" placeholder="Aadhaar Number" value="<?php echo htmlspecialchars($userdata['aadhaar'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
</div>
<div class="col-md-8 mb-3">
<label>Location</label>
<input type="text" placeholder="Location" value="<?php echo htmlspecialchars($userdata['location'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
</div>

<!-- New Options -->
<div class="col-md-4 mb-3">
<label>Is OTP Required?</label>
<select name="is_otp" class="form-control">
<option value="YES" <?php echo ($userdata['is_otp'] === 'YES') ? 'selected' : ''; ?>>YES</option>
<option value="NO" <?php echo ($userdata['is_otp'] === 'NO') ? 'selected' : ''; ?>>NO</option>
</select>
</div>
<div class="col-md-4 mb-3">
<label>WhatsApp Alert?</label>
<select name="whatsapp_alert" class="form-control">
<option value="YES" <?php echo ($userdata['whatsapp_alert'] === 'YES') ? 'selected' : ''; ?>>YES</option>
<option value="NO" <?php echo ($userdata['whatsapp_alert'] === 'NO') ? 'selected' : ''; ?>>NO</option>
</select>
</div>
<div class="col-md-4 mb-3">
<label>Email Alert?</label>
<select name="email_alert" class="form-control">
<option value="YES" <?php echo ($userdata['email_alert'] === 'YES') ? 'selected' : ''; ?>>YES</option>
<option value="NO" <?php echo ($userdata['email_alert'] === 'NO') ? 'selected' : ''; ?>>NO</option>
</select>
</div>

<div class="col-md-4 mb-3">
<button type="submit" name="update" class="btn btn-primary btn-block">Save</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

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
<script src="assets/js/rechpay.js?1697765827"></script>
<script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 -->
<script>
$(document).ready(function () {
$("#dataTable").DataTable();
});
</script>
