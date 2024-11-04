<?php include "header.php"; ?>
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Subscription & Plans</h1>
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
						<!-- <h4 class="page-title">Subscription & Plans</h4> -->
						



<!-- <div class="alert alert-danger"> -->
<!-- <span data-notify="icon" class="la la-bell"></span> -->
<!-- <button type="button" class="close" data-dismiss="alert">x</button> -->
<!-- <b>Note:</b> Your old plan will be automatically deactivated after purchasing the new plan and is non-refundable. -->
</div>						<div class="row">							
											
							<div class="col-md-3">
								<div class="card text-center">
									<div class="card-header">
										<h4 class="card-title">Trail</h4>
										<h2 class="text-center">₹399</h2>
										<p class="card-category">1 Month</p>
									</div>
									<div class="card-body">
										
											<table class="mx-auto">
										<tbody>
										  <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>0 Transaction Fee</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>Realtime Transaction</p></td>
                                            </tr>
                                            <tr>
                                               <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>No Amount Limit</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p style="color:red;">HDFC Vyapar</p></td>
                                            
                                            </tr>                                              
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Dynamic QR Code</p></td>
                                            </tr>
                                                                                      
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Direct UPI Intent</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Accept All UPI Apps</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>24*7 WhatsApp Support</p></td>
                                            </tr>
										</tbody>
										</table>
									</div>
									<div class="card-footer">
										<form method="POST" action="lib/pay">
                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
											<input type="hidden" name="amount" value="399">
											<input type="hidden" name="planid" value="1">
											<!--<button name="paytm" class="btn btn-outline-success btn-block">Buy Now</button>-->
											<!--button name="upiapi" class="btn btn-outline-primary btn-block">Buy Now</button-->
											<button name="upigate" class="btn btn-outline-success btn-block">Buy Now</button>
										</form>
									</div>
								</div>
							</div>			
											
							<div class="col-md-3">
								<div class="card text-center">
									<div class="card-header">
										<h4 class="card-title">Starter</h4>
										<h2 class="text-center">₹699</h2>
										<p class="card-category">3 Month</p>
									</div>
									<div class="card-body">
										
											<table class="mx-auto">
										<tbody>
										  <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>0 Transaction Fee</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>Realtime Transaction</p></td>
                                            </tr>
                                            <tr>
                                               <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>No Amount Limit</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p style="color:red;">HDFC Vyapar</p></td>
                                            
                                            </tr>                                              
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Dynamic QR Code</p></td>
                                            </tr>
                                                                                      
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Direct UPI Intent</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Accept All UPI Apps</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>24*7 WhatsApp Support</p></td>
                                            </tr>
										</tbody>
										</table>
									</div>
									<div class="card-footer">
										<form method="POST" action="lib/pay">
                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
											<input type="hidden" name="amount" value="699">
											<input type="hidden" name="planid" value="2">
											<!--<button name="paytm" class="btn btn-outline-success btn-block">Buy Now</button>-->
											<!--button name="upiapi" class="btn btn-outline-primary btn-block">Buy Now</button-->
											<button name="upigate" class="btn btn-outline-success btn-block">Buy Now</button>
										</form>
									</div>
								</div>
							</div>			
											
							<div class="col-md-3">
								<div class="card text-center">
									<div class="card-header">
										<h4 class="card-title">Business</h4>
										<h2 class="text-center">₹949</h2>
										<p class="card-category">6 Month</p>
									</div>
									<div class="card-body">
										
											<table class="mx-auto">
										<tbody>
										  <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>0 Transaction Fee</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>Realtime Transaction</p></td>
                                            </tr>
                                            <tr>
                                               <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>No Amount Limit</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p style="color:red;">HDFC Vyapar</p></td>
                                            
                                            </tr>                                              
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Dynamic QR Code</p></td>
                                            </tr>
                                                                                      
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Direct UPI Intent</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Accept All UPI Apps</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>24*7 WhatsApp Support</p></td>
                                            </tr>
										</tbody>
										</table>
									</div>
									<div class="card-footer">
										<form method="POST" action="lib/pay">
                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
											<input type="hidden" name="amount" value="949">
											<input type="hidden" name="planid" value="3">
											<!--<button name="paytm" class="btn btn-outline-success btn-block">Buy Now</button>-->
											<!--button name="upiapi" class="btn btn-outline-primary btn-block">Buy Now</button-->
											<button name="upigate" class="btn btn-outline-success btn-block">Buy Now</button>
										</form>
									</div>
								</div>
							</div>			
											
							<div class="col-md-3">
								<div class="card text-center">
									<div class="card-header">
										<h4 class="card-title">Enterprise</h4>
										<h2 class="text-center">₹1999</h2>
										<p class="card-category">12 Month</p>
									</div>
									<div class="card-body">
										<table class="mx-auto">
										<tbody>
										  <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>0 Transaction Fee</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>Realtime Transaction</p></td>
                                            </tr>
                                            <tr>
                                               <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>No Amount Limit</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p style="color:red;">HDFC Vyapar</p></td>
                                            
                                            </tr>                                              
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Dynamic QR Code</p></td>
                                            </tr>
                                                                                      
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Direct UPI Intent</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-danger me-2" data-feather="x"></i></td>
                                                <td><p>Accept All UPI Apps</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="icon-md text-primary me-2" data-feather="check"></i></td>
                                                <td><p>24*7 WhatsApp Support</p></td>
                                            </tr>
										</tbody>
										</table>
									</div>
									<div class="card-footer">
										<form method="POST" action="lib/pay">
                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
											<input type="hidden" name="amount" value="1999">
											<input type="hidden" name="planid" value="4">
											
											<button name="upigate" class="btn btn-outline-success btn-block">Buy Now</button>
										</form>
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
<script src="assets/js/rechpay.js?1697835127"></script>
<script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
<script type="text/javascript">
function utr_search(utr_number){
if(getCurentFileName()=="transactions"){	
if(utr_number.length==12){
search_txn('2023-10-01','2023-10-21','',utr_number);
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
<script src="assets/js/bharatpe.js?1697835127"></script>