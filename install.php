<?php
// Configuration file paths
$dbInfoFile = 'pages/dbInfo.php';
$configFile = 'auth/config.php';
$sqlFile = 'webdyno.sql'; // Path to your SQL file

// Check if the config files already exist
if (file_exists($dbInfoFile) && file_exists($configFile)) {
    header('Location: index.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $host = $_POST['host'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dbname = $_POST['dbname'];

    // Test database connection
    $connection = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($connection->connect_error) {
        // Output SweetAlert script
        echo "
        <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>
        <script>
            window.onload = function() {
                swal({
                    title: 'Error!',
                    text: 'Database details are incorrect: " . addslashes($connection->connect_error) . "',
                    icon: 'error',
                    button: 'OK'
                }).then(function() {
                    window.location.href = 'install.php'; // Redirect to install.php when OK is clicked
                });
            }
        </script>";
        exit; // Stop further execution
    } else {
        // Create dbInfo.php with the database details
        $dbInfoContent = "<?php\n";
        $dbInfoContent .= "error_reporting(0);\n";
        $dbInfoContent .= "date_default_timezone_set('Asia/Kolkata');\n\n";
        $dbInfoContent .= "function connect_database() {\n";
        $dbInfoContent .= "\t\$fetchType = \"array\";\n";
        $dbInfoContent .= "\t\$dbHost = \"$host\";\n";
        $dbInfoContent .= "\t\$dbLogin = \"$username\";\n";
        $dbInfoContent .= "\t\$dbPwd = \"$password\";\n";
        $dbInfoContent .= "\t\$dbName = \"$dbname\";\n";
        $dbInfoContent .= "\t\$con = mysqli_connect(\$dbHost, \$dbLogin, \$dbPwd, \$dbName);\n";
        $dbInfoContent .= "\tif (!\$con) {\n";
        $dbInfoContent .= "\t\tdie(\"Database Connection failed: \" . mysqli_connect_errno());\n";
        $dbInfoContent .= "\t}\n";
        $dbInfoContent .= "\treturn (\$con);\n";
        $dbInfoContent .= "}\n\n";
        $dbInfoContent .= "// Database configuration\n";
        $dbInfoContent .= "define('DB_HOST', '$host');\n";
        $dbInfoContent .= "define('DB_USERNAME', '$username');\n";
        $dbInfoContent .= "define('DB_PASSWORD', '$password');\n";
        $dbInfoContent .= "define('DB_NAME', '$dbname');\n";
        $dbInfoContent .= "?>";

        // Create config.php with your desired structure
        $configContent = "<?php\n";
        $configContent .= "// error_reporting(E_ALL);\n";
        $configContent .= "// ini_set(\"display_errors\", true);\n\n";
        $configContent .= "\$conn = new mysqli(\"$host\", \"$username\", \"$password\", \"$dbname\");\n";
        $configContent .= "\$server = \$_SERVER[\"SERVER_NAME\"];\n\n";
        $configContent .= "// Fetch site settings from the database\n";
        $configContent .= "\$query = \"SELECT * FROM site_settings LIMIT 1\";\n";
        $configContent .= "\$result = mysqli_query(\$conn, \$query);\n\n";
        $configContent .= "if (\$result && mysqli_num_rows(\$result) > 0) {\n";
        $configContent .= "    \$site_settings = mysqli_fetch_assoc(\$result);\n";
        $configContent .= "} else {\n";
        $configContent .= "    // Default values in case settings are not found\n";
        $configContent .= "    \$site_settings = [\n";
        $configContent .= "        'brand_name' => 'Default Brand Name',\n";
        $configContent .= "        'logo_url' => 'default_logo.png',\n";
        $configContent .= "        'site_link' => 'https://example.com',\n";
        $configContent .= "        'whatsapp_number' => '0000000000',\n";
        $configContent .= "        'copyright_text' => '© Default Copyright'\n";
        $configContent .= "    ];\n";
        $configContent .= "}\n";
        $configContent .= "?>";

        // Write the files
        file_put_contents($dbInfoFile, $dbInfoContent);
        file_put_contents($configFile, $configContent);

        // Import SQL file
        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            $queries = explode(";", $sql); // Split the SQL file into queries

            foreach ($queries as $query) {
                $query = trim($query);
                if ($query) {
                    if (!$connection->query($query)) {
                        echo "
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script>
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'>
                        <script>
                            window.onload = function() {
                                swal({
                                    title: 'Import Error!',
                                    text: 'Failed to execute query: " . addslashes($connection->error) . "',
                                    icon: 'error',
                                    button: 'OK'
                                }).then(function() {
                                    window.location.href = 'install.php';
                                });
                            }
                        </script>";
                        exit; // Stop further execution
                    }
                }
            }
        }

        // Redirect to index.php if connection is successful and SQL import is complete
        header('Location: index.php');
        exit;
    }
}

// Show the form with styling
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Database Setup</h2>
    <form method="POST" id="dbForm">
        <label for="host">Database Host:</label>
        <input type="text" id="host" name="host" value="localhost" required>

        <label for="username">Database Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Database Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="dbname">Database Name:</label>
        <input type="text" id="dbname" name="dbname" required>

        <input type="submit" value="Connect">
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>
