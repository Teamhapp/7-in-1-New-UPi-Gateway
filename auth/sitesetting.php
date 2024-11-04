<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start output buffering to prevent premature output
ob_start();

include "header.php";
include "config.php"; // Assuming config.php contains the database connection

// Initialize message variable
$message = "";

// Fetch existing settings from the database
$query = "SELECT * FROM site_settings LIMIT 1";
$result = mysqli_query($conn, $query);
$settings = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand_name = $_POST['brand_name'];
    $logo_url = $_POST['logo_url'];
    $site_link = $_POST['site_link'];
    $whatsapp_number = $_POST['whatsapp_number'];
    $copyright_text = $_POST['copyright_text'];

    if ($settings) {
        // Update existing record
        $update_query = "UPDATE site_settings SET brand_name='$brand_name', logo_url='$logo_url', site_link='$site_link', whatsapp_number='$whatsapp_number', copyright_text='$copyright_text' WHERE id=".$settings['id'];
        if (mysqli_query($conn, $update_query)) {
            $message = "Settings updated successfully.";
        } else {
            $message = "Error updating settings: " . mysqli_error($conn);
        }
    } else {
        // Insert new record
        $insert_query = "INSERT INTO site_settings (brand_name, logo_url, site_link, whatsapp_number, copyright_text) VALUES ('$brand_name', '$logo_url', '$site_link', '$whatsapp_number', '$copyright_text')";
        if (mysqli_query($conn, $insert_query)) {
            $message = "Settings saved successfully.";
        } else {
            $message = "Error saving settings: " . mysqli_error($conn);
        }
    }

    // Redirect after form submission
    header("Location: sitesetting.php?message=" . urlencode($message));
    exit();
}

// End output buffering and flush output
ob_end_flush();
?>
<?php if($userdata["role"] == 'Admin'){  ?>
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Manage Site Settings</h1>
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
            <form method="post" action="sitesetting.php">
                <label>Brand Name:</label><br>
                <input class="form-control" type="text" name="brand_name" value="<?php echo $settings['brand_name'] ?? ''; ?>"><br><br>

                <label>Logo URL:</label><br>
                <input class="form-control" type="text" name="logo_url" value="<?php echo $settings['logo_url'] ?? ''; ?>"><br><br>

                <label>Site Link:</label><br>
                <input class="form-control" type="text" name="site_link" value="<?php echo $settings['site_link'] ?? ''; ?>"><br><br>

                <label>WhatsApp Number:</label><br>
                <input class="form-control" type="text" name="whatsapp_number" value="<?php echo $settings['whatsapp_number'] ?? ''; ?>"><br><br>

                <label>Copyright Text:</label><br>
                <input class="form-control" type="text" name="copyright_text" value="<?php echo $settings['copyright_text'] ?? ''; ?>"><br><br>

                <input class="btn btn-primary btn-block" type="submit" value="Save Settings">
            </form>
        </div>
    </div>
</div>
 <?php } ?>