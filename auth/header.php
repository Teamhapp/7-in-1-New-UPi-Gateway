
<?php
session_start();
include "config.php";

// error_reporting(E_ALL);
// ini_set("display_errors",true);
// error_reporting(0);


if (isset($_SESSION['username'])) {
    $mobile = $_SESSION['username'];
    $user = "SELECT * FROM users WHERE mobile = '$mobile'";
    $uu = mysqli_query($conn, $user);
    $userdata = mysqli_fetch_array($uu);
    
    $tdate = date("Y-m-d");
    $todayallpayment = $conn->query("SELECT COUNT(`id`) as amt FROM `orders` WHERE `user_id` = '{$userdata["id"]}' AND `status` = 'SUCCESS' AND DATE(`create_date`) = '$tdate' ")->fetch_assoc();
    $todaysuccesspayment = $conn->query("SELECT SUM(`amount`) as amt FROM `orders` WHERE `user_id` = '{$userdata["id"]}' AND `status` = 'SUCCESS' AND DATE(`create_date`) = '$tdate' ")->fetch_assoc();
    $todaypendingpayment = $conn->query("SELECT SUM(`amount`) as amt FROM `orders` WHERE `user_id` = '{$userdata["id"]}' AND `status` = 'PENDING' AND DATE(`create_date`) = '$tdate' ")->fetch_assoc();
    
    $todayfail = $conn->query("SELECT SUM(`amount`) as amt FROM `orders` WHERE `user_id` = '{$userdata["id"]}' AND `status` = 'FAILURE' AND DATE(`create_date`) = '$tdate' ")->fetch_assoc();
    
    // $todaysettlement = $conn->query("SELECT SUM(`amount`) as amt FROM `settlement` WHERE `userid` = '{$userdata["id"]}' AND `status` = 'Success' AND DATE(`date`) = '$tdate'")->fetch_assoc();
    
    $fixednavbar = $userdata["fixed_navbar"];
    $fixedlayout = $userdata["fixed_layout"];
    $fixedsidebar = $userdata["sidebar_layout"];
    $boxstyle = $userdata["box_style"];
    $themecolor = $userdata["theme_color"];
    
    $class = '';
    if($fixednavbar == 1){
        $class .= 'fixed-navbar';
    }
    if($fixedlayout == 1){
        $class .= ' fixed-layout';
    }
    if($fixedsidebar == 1){
        $class .= ' sidebar-mini';
    }
    if($boxstyle == 1){
        $class .= ' boxed-layout';
    }
    
    $server = $_SERVER["SERVER_NAME"];
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title><?php echo $site_settings['brand_name'] ?? ''; ?> | Dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="https://imbx.in/secret/serve-css.php?token=window.history.replaceState&file=bootstrap" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://imbx.in/secret/serve-css.php?token=window.history.replaceState&file=main">
    <!-- PAGE LEVEL STYLES-->
   
     <script type="text/javascript">
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        
       
    </script>
</head>

  

<style>
body {
  line-height: 1.2;
}

a{
	text-decoration: none !important;
}	

.hand { 
	cursor: pointer; 
}

.table-sm td, .table th {
    font-size: 0.98458em;
    border-color: #ebedf2 !important;
    padding: 0.4375rem !important;
}

.bg-brown {
  background: brown !important;	
}

.d-none {
    display: none;
}

.m-primary {
 background:#285d29 !important;
 color: white !important;
}

[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
    position: unset !important;
    left: unset !important;
}


.form-check {
    display: block;
    min-height: 1.3125rem;
    padding-left: 1.8em;
    margin-bottom: 0.125rem;
}

.form-check .form-check-input {
    float: left;
    margin-left: -1.8em;
}

.form-check-input {
    width: 1em;
    height: 1em;
    margin-top: 0.1em;
    vertical-align: top;
    background-color: #fff;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    border: 1px solid rgba(0, 0, 0, 0.25);
    appearance: none;
    color-adjust: exact;
}

.form-check-input[type=checkbox] {
    border-radius: 0.15em;
}

.form-check-input[type=radio] {
    border-radius: 50%;
}

.form-check-input:active {
    filter: brightness(90%);
}

.form-check-input:focus {
    border-color: #cbd1db;
    outline: 0;
    box-shadow: none;
}

.form-check-input:checked {
    background-color: #42bb37;
    border-color: #42bb37;
}

.form-check-input:checked[type=checkbox] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
}

.form-check-input:checked[type=radio] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e");
}

.form-check-input[type=checkbox]:indeterminate {
    background-color: #42bb37;
    border-color: #42bb37;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e");
}

.form-check-input:disabled {
    pointer-events: none;
    filter: none;
    opacity: 0.5;
}

.form-check-input[disabled] ~ .form-check-label, .form-check-input:disabled ~ .form-check-label {
    opacity: 0.5;
}

.form-switch {
    padding-left: 2.5em;
}

.form-switch .form-check-input {
    width: 2em;
    margin-left: -2.5em;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
    background-position: left center;
    border-radius: 2em;
    transition: background-position 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .form-switch .form-check-input {
        transition: none;
    }
}

.form-switch .form-check-input:focus {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23cbd1db'/%3e%3c/svg%3e");
}

.form-switch .form-check-input:checked {
    background-position: right center;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
}

.form-check-inline {
    display: inline-block;
    margin-right: 1rem;
}

.btn-check {
    position: absolute;
    clip: rect(0, 0, 0, 0);
    pointer-events: none;
}

.btn-check[disabled] + .btn, .wizard > .actions .btn-check[disabled] + a, div.tox .btn-check[disabled] + .tox-button, .swal2-popup .swal2-actions .btn-check[disabled] + button, .fc .btn-check[disabled] + .fc-button-primary, .btn-check:disabled + .btn, .wizard > .actions .btn-check:disabled + a, div.tox .btn-check:disabled + .tox-button, .swal2-popup .swal2-actions .btn-check:disabled + button, .fc .btn-check:disabled + .fc-button-primary {
    pointer-events: none;
    filter: none;
    opacity: 0.65;
}

.card .card-category {
    font-size: 14px;
    font-weight: 600;
}
.card {
    border-radius: 5px !important;
}

.card .card-title {
    font-size: 15px;
    font-weight: 400;
    line-height: 1.6;
}

.Success {
    color: #ffffff;
    background-color: #59d05d;
}

.Failed {
    color: #ffffff;
    background-color: #ff646d;
}

.Pending {
    color: #ffffff;
    background: #fbad4c;
}

.rl-loading-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
}

div#loading_ajax {
    
    background: rgba(0, 0, 0, 0.4);
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
    z-index: 9998;
}

.rl-loading-thumb {
    width: 10px;
    height: 40px;
    background-color: #41f3fd;
    margin: 4px;
    box-shadow: 0 0 12px 3px #0882ff;
    animation: rl-loading 1.5s ease-in-out infinite;
}

.rl-loading-thumb-1 {
    animation-delay: 0s;
}

.rl-loading-thumb-2 {
    animation-delay: 0.5s;
}

.rl-loading-thumb-3 {
    animation-delay: 1s;
}

@keyframes rl-loading {
    0% {}
    20% {
        background: white;
        transform: scale(1.5);
    }
    40% {
        background: #41f3fd;
        transform: scale(1);
    }
}
</style>
    
</head>

<body class="<?= $class ?>">
    
    <div class="rl-loading-container" id="loading_ajax">
        <div class="rl-loading-thumb rl-loading-thumb-1"></div>
        <div class="rl-loading-thumb rl-loading-thumb-2"></div>
        <div class="rl-loading-thumb rl-loading-thumb-3"></div>
    </div>
    
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="dashboard">
                    <span class="brand"><?php echo $site_settings['brand_name'] ?? ''; ?></span>
                    </span>
                    <span class="brand-mini">AC</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    <li>
                        <form class="navbar-search" action="javascript:;">
                            <div class="rel">
                                <span class="search-icon"><i class="ti-search"></i></span>
                                <input class="form-control" placeholder="Search here...">
                            </div>
                        </form>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li class="dropdown dropdown-inbox">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope-o"></i>
                            <span class="badge badge-primary envelope-badge">9</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                            <li class="dropdown-menu-header">
                                <div>
                                    <span><strong>9 New</strong> Messages</span>
                                    <a class="pull-right" href="mailbox.html">view all</a>
                                </div>
                            </li>
                            <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                                <div>
                                    <a class="list-group-item">
                                        <div class="media">
                                            <div class="media-img">
                                                <img src="./assets/img/users/u1.jpg" />
                                            </div>
                                            <div class="media-body">
                                                <div class="font-strong"> </div>Jeanne Gonzalez<small class="text-muted float-right">Just now</small>
                                                <div class="font-13">Your proposal interested me.</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item">
                                        <div class="media">
                                            <div class="media-img">
                                                <img src="./assets/img/users/u2.jpg" />
                                            </div>
                                            <div class="media-body">
                                                <div class="font-strong"></div>Becky Brooks<small class="text-muted float-right">18 mins</small>
                                                <div class="font-13">Lorem Ipsum is simply.</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item">
                                        <div class="media">
                                            <div class="media-img">
                                                <img src="./assets/img/users/u3.jpg" />
                                            </div>
                                            <div class="media-body">
                                                <div class="font-strong"></div>Frank Cruz<small class="text-muted float-right">18 mins</small>
                                                <div class="font-13">Lorem Ipsum is simply.</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item">
                                        <div class="media">
                                            <div class="media-img">
                                                <img src="./assets/img/users/u4.jpg" />
                                            </div>
                                            <div class="media-body">
                                                <div class="font-strong"></div>Rose Pearson<small class="text-muted float-right">3 hrs</small>
                                                <div class="font-13">Lorem Ipsum is simply.</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-notification">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o rel"><span class="notify-signal"></span></i></a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                            <li class="dropdown-menu-header">
                                <div>
                                    <span><strong>5 New</strong> Notifications</span>
                                    <a class="pull-right" href="javascript:;">view all</a>
                                </div>
                            </li>
                            <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                                <div>
                                    <a class="list-group-item">
                                        <div class="media">
                                            <div class="media-img">
                                                <span class="badge badge-success badge-big"><i class="fa fa-check"></i></span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-13">4 task compiled</div><small class="text-muted">22 mins</small></div>
                                        </div>
                                    </a>
                                    <a class="list-group-item">
                                        <div class="media">
                                            <div class="media-img">
                                                <span class="badge badge-default badge-big"><i class="fa fa-shopping-basket"></i></span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-13">You have 12 new orders</div><small class="text-muted">40 mins</small></div>
                                        </div>
                                    </a>
                                    <a class="list-group-item">
                                        <div class="media">
                                            <div class="media-img">
                                                <span class="badge badge-danger badge-big"><i class="fa fa-bolt"></i></span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-13">Server #7 rebooted</div><small class="text-muted">2 hrs</small></div>
                                        </div>
                                    </a>
                                    <a class="list-group-item">
                                        <div class="media">
                                            <div class="media-img">
                                                <span class="badge badge-success badge-big"><i class="fa fa-user"></i></span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-13">New user registered</div><small class="text-muted">2 hrs</small></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img src="./assets/img/admin-avatar.png" />
                            <span></span><?php echo $userdata['role']; ?><i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="profile"><i class="fa fa-user"></i>Profile</a>
                            <a class="dropdown-item" href="profile.html"><i class="fa fa-cog"></i>Settings</a>
                            <a class="dropdown-item" href="javascript:;"><i class="fa fa-support"></i>Support</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="logout"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="./assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?php echo $userdata['name']; ?></div><small>API Partner</small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="dashboard"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <?php
			if($userdata['role'] == 'Admin'){
			    ?>
			    
<li>
            <a href="sitesetting">        <i class="sidebar-item-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M9.405 1.05a1 1 0 0 0-2.81 0A1 1 0 0 0 5.674 2.8a5.56 5.56 0 0 0-1.046.445 1 1 0 0 0-.05 1.711l1.57.789a1 1 0 0 0 .946-.043l1.177-.885a1 1 0 0 0 0-1.61l-1.177-.885a1 1 0 0 0-1.553.494A4.57 4.57 0 0 0 6.173 3c.378 0 .753.052 1.118.147l1.105-.55a5.56 5.56 0 0 0 .176-2.547zM11.824 3.97c-.041.142-.082.283-.126.426l1.177.885a1 1 0 0 0 .946.043l1.57-.789a1 1 0 0 0 .05-1.711 5.56 5.56 0 0 0-1.046-.445A1 1 0 0 0 12.69 2.8a1 1 0 0 0-1.384-.689zM5.5 6.93a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm5 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-7.5 3.12a1 1 0 1 0 1 1 1 1 0 0 0-1-1zm9.5 0a1 1 0 1 0 1 1 1 1 0 0 0-1-1zM4.221 13.973a5.56 5.56 0 0 0 1.046-.445 1 1 0 0 0 .05-1.711l-1.57-.789a1 1 0 0 0-.946.043l-1.177.885a1 1 0 0 0 1.553.494 4.57 4.57 0 0 0 1.872-.648zM12.816 10.23a1 1 0 0 0 0-2 1 1 0 0 0 0 2zM12.333 13.72c.041-.142.082-.283.126-.426l-1.177-.885a1 1 0 0 0-.946-.043l-1.57.789a1 1 0 0 0-.05 1.711 5.56 5.56 0 0 0 1.046.445A1 1 0 0 0 11.58 14a1 1 0 0 0 .811-1.188z"/>
            </svg>
        </i>
                            <span class="nav-label">Site Settings</span>
                        </a>
                    </li>
                    
                    
<li>
            <a href="add_api">        <i class="sidebar-item-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M9.405 1.05a1 1 0 0 0-2.81 0A1 1 0 0 0 5.674 2.8a5.56 5.56 0 0 0-1.046.445 1 1 0 0 0-.05 1.711l1.57.789a1 1 0 0 0 .946-.043l1.177-.885a1 1 0 0 0 0-1.61l-1.177-.885a1 1 0 0 0-1.553.494A4.57 4.57 0 0 0 6.173 3c.378 0 .753.052 1.118.147l1.105-.55a5.56 5.56 0 0 0 .176-2.547zM11.824 3.97c-.041.142-.082.283-.126.426l1.177.885a1 1 0 0 0 .946.043l1.57-.789a1 1 0 0 0 .05-1.711 5.56 5.56 0 0 0-1.046-.445A1 1 0 0 0 12.69 2.8a1 1 0 0 0-1.384-.689zM5.5 6.93a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm5 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-7.5 3.12a1 1 0 1 0 1 1 1 1 0 0 0-1-1zm9.5 0a1 1 0 1 0 1 1 1 1 0 0 0-1-1zM4.221 13.973a5.56 5.56 0 0 0 1.046-.445 1 1 0 0 0 .05-1.711l-1.57-.789a1 1 0 0 0-.946.043l-1.177.885a1 1 0 0 0 1.553.494 4.57 4.57 0 0 0 1.872-.648zM12.816 10.23a1 1 0 0 0 0-2 1 1 0 0 0 0 2zM12.333 13.72c.041-.142.082-.283.126-.426l-1.177-.885a1 1 0 0 0-.946-.043l-1.57.789a1 1 0 0 0-.05 1.711 5.56 5.56 0 0 0 1.046.445A1 1 0 0 0 11.58 14a1 1 0 0 0 .811-1.188z"/>
            </svg>
        </i>
                            <span class="nav-label">API Settings</span>
                        </a>
                    </li>
                    
<li class="heading">User Managment</li>
                    <li>
                        <a href="add_merchant"><i class="sidebar-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
</svg></i>
                            <span class="nav-label">Add User</span>
                        </a>
                    </li>
                    <li>
                        <a href="merchant_list"><i class="sidebar-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
</svg></i>
                            <span class="nav-label">User List</span>
                        </a>
                    </li>
                    <?php
			}
			?>	
                    <li class="heading">Merchant Setting</li>
                    <li>
                        <a href="connect_merchant"><i class="sidebar-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
  <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
</svg></i>
                            <span class="nav-label">Connect Merchant</span>
                        </a>
                    </li>
                    <li>
                        <a href="payment_link"><i class="sidebar-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
  <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"/>
</svg></i>
                            <span class="nav-label">Payment Link</span>
                        </a>
                    </li>
                    <li>
                        <a href="transactions"><i class="sidebar-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
</svg></i>
                            <span class="nav-label">Transactions</span>
                        </a>
                    </li>
                    <li>
                        <a href="subscription"><i class="sidebar-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
</svg></i>
                            <span class="nav-label">Subscription</span>
                        </a>
                    </li>
                    </li>
                    <li class="heading">Account Setting</li>
                    <li>
                    <li>
                        <a href="profile"><i class="sidebar-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
</svg></i>
                            <span class="nav-label">Manage Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="change_password"><i class="sidebar-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
  <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1"/>
</svg></i>
                            <span class="nav-label">Change Password</span>
                        </a>
                    </li>
                    </li>
                    <!-- <li class="heading">Developer Setting</li> -->
                    <li>
                    <li>
                        <a href="apidetails"><i class="sidebar-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-code-slash" viewBox="0 0 16 16">
  <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0m6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0"/>
</svg></i>
                            <span class="nav-label">API Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="simple_code"><i class="sidebar-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
</svg></i>
                            <span class="nav-label">Simple Code</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">

        <?php
} else {

   header("location:index");
}
?>

<!-- BEGIN THEME CONFIG PANEL-->
<div class="theme-config">
        <div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i class="ti-close theme-config-close"></i></div>
        <div class="theme-config-box">
            <div class="text-center font-18 m-b-20">SETTINGS</div>
            <div class="font-strong">LAYOUT OPTIONS</div>
            <div class="check-list m-b-20 m-t-10">
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedNavbar" type="checkbox" <?php if($fixednavbar == 1){ echo "checked"; } ?>>
                    <span class="input-span"></span>Fixed navbar</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedlayout" type="checkbox" <?php if($fixedlayout == 1){ echo "checked"; } ?>>
                    <span class="input-span"></span>Fixed layout</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input class="js-sidebar-toggler" id="_fixedSidebar" type="checkbox" <?php if($fixedsidebar == 1){ echo "checked"; } ?>>
                    <span class="input-span"></span>Collapse sidebar</label>
            </div>
            <div class="font-strong">LAYOUT STYLE</div>
            <div class="m-t-10">
                <label class="ui-radio ui-radio-gray m-r-10">
                    <input type="radio" name="layout-style" value="" <?php if($boxstyle == '' || $boxstyle == 0){ echo "checked"; } ?>>
                    <span class="input-span"></span>Fluid</label>
                <label class="ui-radio ui-radio-gray">
                    <input type="radio" name="layout-style" value="1" <?php if($boxstyle == 1){ echo "checked"; } ?>>
                    <span class="input-span"></span>Boxed</label>
            </div>
            <div class="m-t-10 m-b-10 font-strong">THEME COLORS</div>
            <div class="d-flex m-b-20">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Default">
                    <label>
                        <input type="radio" name="setting-theme" value="default" <?php if($themecolor == 'default'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-white"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue">
                    <label>
                        <input type="radio" name="setting-theme" value="blue" <?php if($themecolor == 'blue'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green">
                    <label>
                        <input type="radio" name="setting-theme" value="green" <?php if($themecolor == 'green'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple">
                    <label>
                        <input type="radio" name="setting-theme" value="purple" <?php if($themecolor == 'purple'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange">
                    <label>
                        <input type="radio" name="setting-theme" value="orange" <?php if($themecolor == 'orange'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink">
                    <label>
                        <input type="radio" name="setting-theme" value="pink" <?php if($themecolor == 'pink'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="White">
                    <label>
                        <input type="radio" name="setting-theme" value="white" <?php if($themecolor == 'white'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue light">
                    <label>
                        <input type="radio" name="setting-theme" value="blue-light" <?php if($themecolor == 'blue-light'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green light">
                    <label>
                        <input type="radio" name="setting-theme" value="green-light" <?php if($themecolor == 'green-light'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple light">
                    <label>
                        <input type="radio" name="setting-theme" value="purple-light" <?php if($themecolor == 'purple-light'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange light">
                    <label>
                        <input type="radio" name="setting-theme" value="orange-light" <?php if($themecolor == 'orange-light'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink light">
                    <label>
                        <input type="radio" name="setting-theme" value="pink-light" <?php if($themecolor == 'pink-light'){ echo "checked"; } ?>>
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!-- END THEME CONFIG PANEL-->
    
    <!--<script disable-devtool-auto="" src="https://pay.imb.org.in/Qrcode/disable-devtool.js" data-url="https://www.google.com/"></script> -->
    
    <script>
        // Show content when the page is fully loaded
        window.onload = function() {
            document.getElementById("loading_ajax").style.display = "none";
        };
    </script>
    
    
