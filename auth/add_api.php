<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start output buffering to prevent premature output
ob_start();

include "header.php";
include "config.php"; // Assuming config.php contains the database connection

// Initialize variables
$whatsapp_api_url = '';
$sender_id = '';
$api_key = '';
$sender_email = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Capture the POST data
$whatsapp_api_url = $_POST['whatsapp_api_url'];
$sender_id = $_POST['sender_id'];
$api_key = $_POST['api_key'];
$sender_email = $_POST['sender_email'];

// Check if settings already exist
$query = "SELECT * FROM api_settings LIMIT 1"; // Get any existing setting
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
// If settings exist, update them
$settings = $result->fetch_assoc();
$id = $settings['id'];

// Prepare the update statement
$update_query = "UPDATE api_settings SET whatsapp_api_url = ?, sender_id = ?, api_key = ?, sender_email = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_query);
$update_stmt->bind_param("ssssi", $whatsapp_api_url, $sender_id, $api_key, $sender_email, $id);

if ($update_stmt->execute()) {
// Success message
echo "<script>
Swal.fire({
title: 'Success!',
text: 'API settings updated successfully!',
icon: 'success',
confirmButtonText: 'OK'
});
  </script>";
} else {
// Error during update
echo "<script>
Swal.fire({
title: 'Error!',
text: 'Error updating settings: " . addslashes($update_stmt->error) . "',
icon: 'error',
confirmButtonText: 'OK'
});
  </script>";
}

$update_stmt->close(); // Close the update statement
} else {
// If no settings exist, insert new ones
$insert_query = "INSERT INTO api_settings (whatsapp_api_url, sender_id, api_key, sender_email) VALUES (?, ?, ?, ?)";
$insert_stmt = $conn->prepare($insert_query);
$insert_stmt->bind_param("ssss", $whatsapp_api_url, $sender_id, $api_key, $sender_email);

if ($insert_stmt->execute()) {
// Success message for insert
echo "<script>
Swal.fire({
title: 'Success!',
text: 'API settings added successfully!',
icon: 'success',
confirmButtonText: 'OK'
});
  </script>";
} else {
// Error during insert
echo "<script>
Swal.fire({
title: 'Error!',
text: 'Error adding settings: " . addslashes($insert_stmt->error) . "',
icon: 'error',
confirmButtonText: 'OK'
});
  </script>";
}

$insert_stmt->close(); // Close the insert statement
}
}


// Fetch current API settings to display in the form if they exist
$query = "SELECT * FROM api_settings LIMIT 1"; // Get any existing setting
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
$settings = $result->fetch_assoc();
$whatsapp_api_url = $settings['whatsapp_api_url'];
$sender_id = $settings['sender_id'];
$api_key = $settings['api_key'];
$sender_email = $settings['sender_email'];
} else {
// No settings found, set default values
$whatsapp_api_url = '';
$sender_id = '';
$api_key = '';
$sender_email = '';
}



// End output buffering and flush output
ob_end_flush();
?>
<?php if($userdata["role"] == 'Admin'){  ?>
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">API Settings</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <!-- Display success/error message -->
            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
                <script>
                    // Redirect after 1 second (1000ms)
                    setTimeout(function() {
                        window.location = "sitesetting.php";
                    }, 1000);
                </script>
            <?php endif; ?>
            
            <!-- Site Settings Form -->
<!-- HTML Form for API Settings -->
<div class="page-content fade-in-up">
<div class="ibox">
<div class="ibox-body">

<form method="POST" action="">
<div class="row">
<div class="col-md-6 mb-3">
<label>WhatsApp API URL</label>
<input type="text" name="whatsapp_api_url" value="<?php echo htmlspecialchars($whatsapp_api_url); ?>" class="form-control" required>
</div>
<div class="col-md-6 mb-3">
<label>Sender ID</label>
<input type="text" name="sender_id" value="<?php echo htmlspecialchars($sender_id); ?>" class="form-control" required>
</div>
<div class="col-md-6 mb-3">
<label>API Key</label>
<input type="text" name="api_key" value="<?php echo htmlspecialchars($api_key); ?>" class="form-control" required>
</div>
<div class="col-md-6 mb-3">
<label>Sender Email</label>
<input type="email" name="sender_email" value="<?php echo htmlspecialchars($sender_email); ?>" class="form-control" required>
</div>
<div class="col-md-12 mb-3">
<button type="submit" class="btn btn-primary">Save Settings</button>
</div>
</div>
</form>
</div>
</div>
</div>
 <?php } ?>