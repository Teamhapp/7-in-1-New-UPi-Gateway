<?php include "header.php"; ?>
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />
 
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Transactions</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head"></div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mobile</th>
                                    <th>TXN Id</th>
                                    <th>Date Time</th>
                                    <th>Merchant</th>
                                    <th>Gateway Txn</th>
                                    <th>Bank RRN</th>
                                    <th>Order ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
if($userdata['role'] == 'User'){
    $token = $userdata['user_token'];

    // Modified query for descending order
    $query = "SELECT `id`, `create_date`, `gateway_txn`, `customer_mobile`, `method`, `utr`, `byteTransactionId`, `order_id`, `amount`, `status` 
              FROM `orders` 
              WHERE user_token = '$token' 
              ORDER BY STR_TO_DATE(`create_date`, '%Y-%m-%d %H:%i:%s') DESC"; // Sort by date in descending order

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['customer_mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['byteTransactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['create_date'], ENT_QUOTES, 'UTF-8') . "</td>";
            ?>
            <td class="badge badge-dark" style="width:70px;"><?php echo htmlspecialchars($row['method']); ?></td>
            <?php
            echo "<td>" . htmlspecialchars($row['gateway_txn'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['utr'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";

            // Handling status
            if($row['status']=="SUCCESS"){
                $sts = 'Success';
                $cls = "badge badge-success";
            } else {
                $sts = 'Pending';
                $cls = "badge badge-warning";
            }
            echo "<td><button class='$cls'>" . $sts . "</button></td>";
            echo "</tr>";
        }
    } else {
        echo "Error in query: ";
    }
} else {
    // For Admin
    $query = "SELECT `id`, `transactionId`, `date`, `mobile`, `UTR`, `description`, `order_id`, `amount`, `status` 
              FROM `reports` 
              ORDER BY STR_TO_DATE(`date`, '%Y-%m-%d %H:%i:%s') DESC"; // Sort by date in descending order

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['transactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') . "</td>";
            ?>
            <td class="badge badge-dark" style="width:70px;">HDFC</td>
            <?php
            echo "<td>" . htmlspecialchars($row['UTR'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";

            // Handling status
            if($row['status']==3){
                $sts = 'Success';
                $cls = "badge badge-success";
            } else {
                $sts = 'Pending';
                $cls = "badge badge-warning";
            }
            echo "<td><button class='$cls'>" . $sts . "</button></td>";
            echo "</tr>";
        }
    } else {
        echo "Error in query: ";
    }
}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    
            </div>
        </div>
    </div>
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="./assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#example-table').DataTable({
                pageLength: 10,
                order: [[3, 'desc']], // Force sorting by date/time column (4th column, index 3) in descending order
            });
        })
    </script>
</body>

</html>
