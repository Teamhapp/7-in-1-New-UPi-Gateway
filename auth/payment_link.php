<?php include "header.php"; ?>

<style>
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f4f4f9;
        color: #333;
    }

    .page-heading {
        background-color: #6c5ce7;
        color: #fff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .page-title {
        font-size: 24px;
        margin: 0;
    }

    .breadcrumb-item a {
        color: #fff;
    }

    .ibox {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card {
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #f8a5c2, #f9d67a);
        padding: 20px;
        color: #333;
    }

    .form-control {
        border: 1px solid #6c5ce7;
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #ff7675;
        box-shadow: 0 0 5px rgba(255, 118, 117, 0.5);
    }

    .btn-primary {
        background-color: #6c5ce7;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        color: #fff;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #a29bfe;
    }

    .copy-btn {
        background-color: #ff7675;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px;
        transition: background-color 0.3s;
    }

    .copy-btn:hover {
        background-color: #ff6b81;
        cursor: pointer;
    }

    .clipboard {
        position: relative;
        display: flex;
        align-items: center;
        margin-top: 15px;
    }

    .copied {
        font-family: 'Montserrat', sans-serif;
        width: 100px;
        opacity: 0;
        position: fixed;
        bottom: 20px;
        left: 0;
        right: 0;
        margin: auto;
        color: #fff;
        padding: 15px 15px;
        background-color: #6c5ce7;
        border-radius: 5px;
        transition: .4s opacity;
        text-align: center;
    }

    /* Modal styles */
    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        background-color: #6c5ce7;
        color: #fff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .modal-body {
        background-color: #f9f9f9;
    }
</style>

<?php

// Uncomment these lines for error debugging
// ini_set("display_errors", true);
// error_reporting(E_ALL);

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $remark = !empty($_POST['remark']) ? $_POST['remark'] : 'Your Payment Link is Created';
    $amount = $_POST['amount'];
    
    $orderid = mt_rand(10000000000, 9999999999999);
    
    $data = array(
        'customer_mobile' => $mobile,
        'user_token' => $userdata["user_token"],
        'amount' => $amount,
        'order_id' => $orderid,
        'redirect_url' => 'https://' . $_SERVER["SERVER_NAME"] . '/success',
        'remark1' => $remark,
    );
  
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://' . $_SERVER["SERVER_NAME"] . '/api/create-order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array('User-Agent: Apidog/1.0.0 (https://apidog.com)'),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $jsondatares = json_decode($response, true);
    
    if ($jsondatares["status"] === true) {
        $paymentlink = $jsondatares["result"]["payment_url"];
    } else {
        echo '
            <script>
                Swal.fire({
                    title: "Oops! Failed To Create Payment Link!",
                    text: "' . htmlspecialchars($jsondatares["message"], ENT_QUOTES, 'UTF-8') . '",
                    confirmButtonText: "Ok",
                    icon: "error"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "payment_link"; // Replace with your desired redirect URL
                    }
                });
            </script>
        ';
        exit;
    }
}
?>

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Create Payment Link</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <div class="card m-t-20 m-b-20">
                <div class="card-body">
                    <div class="main-panel">
                        <main class="app-content">
                            <div class="tile mb-4">
                                <div class="page-header">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row row-card-no-pd">
                                                <div class="col-md-12">

                                                    <?php if ($userdata["role"] == 'User') { ?>
                                                        <div class="main-panel">
                                                            <div class="content">
                                                                <div class="container-fluid">
                                                                    <h4 class="page-title">Create Payment Link</h4>
                                                                    <form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Customer Name</label>
                                                                            <input type="text" name="name" placeholder="Your Name" class="form-control" required />
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Mobile Number</label>
                                                                            <input type="number" name="mobile" placeholder="Your Mobile" class="form-control" required />
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Amount (INR)</label>
                                                                            <input type="number" name="amount" placeholder="₹0.00" class="form-control" required />
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label>Remark</label>
                                                                            <input type="text" name="remark" placeholder="Remarks Eg.Gift, Deposit etc." class="form-control" />
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                          <center><button type="submit" name="create" class="btn btn-primary btn-sm">Generate Link</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Payment Link Copy -->
<div class="modal fade" id="copypaymentlinkmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Your Payment Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="clipboard">
                    <input type="text" id="copyClipboard" class="copy-input" value="<?php echo htmlspecialchars($paymentlink, ENT_QUOTES, 'UTF-8'); ?>" readonly />
                    <button class="copy-btn" onclick="copy()"><i class="fa fa-copy"></i></button>
                </div>
                <div class="copied" id="copiedMessage">Copied!</div>
            </div>
        </div>
    </div>
</div>



<!-- Include necessary JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script>
    function copy() {
        var copyText = document.getElementById("copyClipboard");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand("copy");

        var message = document.getElementById("copiedMessage");
        message.style.opacity = 1;
        setTimeout(function() {
            message.style.opacity = 0;
        }, 2000);
    }

    // Show modal on successful payment link generation
    <?php if (isset($paymentlink)) { ?>
        $(document).ready(function() {
            $('#copypaymentlinkmodal').modal('show');
        });
    <?php } ?>
</script>

</body>
</html>