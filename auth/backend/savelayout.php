<?php
session_start();
require("../config.php");

$data = json_decode(file_get_contents('php://input') , true);

$mobile = $_SESSION['username'];

if($data["key"] == 'fixedNavbar'){
$updatelayout = $conn->query("UPDATE users SET fixed_navbar = '{$data["value"]}' WHERE mobile = '$mobile'");
}

if($data["key"] == 'fixedLayout'){
$updatelayout = $conn->query("UPDATE users SET fixed_layout = '{$data["value"]}' WHERE mobile = '$mobile'");
}

if($data["key"] == 'sidebarLayout'){
$updatelayout = $conn->query("UPDATE users SET sidebar_layout = '{$data["value"]}' WHERE mobile = '$mobile'");
}

if($data["key"] == 'boxLayout'){
$updatelayout = $conn->query("UPDATE users SET box_style = '{$data["value"]}' WHERE mobile = '$mobile'");
}

if($data["key"] == 'theme'){
$updatelayout = $conn->query("UPDATE users SET theme_color = '{$data["value"]}' WHERE mobile = '$mobile'");
}

if($updatelayout){
echo json_encode(['status' => 'success']);
}else{
echo json_encode(['status' => 'failed']);
}
?>
