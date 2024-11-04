<?php
// Configuration file paths
$dbInfoFile = 'pages/dbInfo.php';
$configFile = 'auth/config.php';

// Check if the setup has been done
if (!file_exists($dbInfoFile) || !file_exists($configFile)) {
    header('Location: install.php');
    exit;
}

// If setup is done, include the database connection file
include 'pages/dbInfo.php';

// You can now use the connect_database function if needed
$con = connect_database();

// Now you can display your index page content
include 'auth/function.php';


?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="common/img/favicon.png">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta charset="UTF-8">
    <title><?php echo $site_settings['brand_name']; ?> - All-in-One Payment Gateway</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,700,900" rel="stylesheet">
    <!-- ===========================================
		CSS
	============================================= -->
    <link rel="stylesheet" href="common/css/linearicons.css">
    <link rel="stylesheet" href="common/css/font-awesome.min.css">
    <link rel="stylesheet" href="common/css/bootstrap.css">
    <link rel="stylesheet" href="common/css/magnific-popup.css">
    <link rel="stylesheet" href="common/css/nice-select.css">  
    <link rel="stylesheet" href="common/css/animate.min.css">
    <link rel="stylesheet" href="common/css/owl.carousel.css">
    <link rel="stylesheet" href="common/css/main.css">
    <link rel="stylesheet" href="common/css/custom.css">
</head>
    <body class="version1">    
            <!-- start Header Area -->
    <header id="header">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div id="logo">
                    <a href="index.php"><img src="<?php echo $site_settings['logo_url']; ?>"/></a>
                </div>
                <div class="nav-wrap d-flex flex-row align-items-center">
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                           <li><a href="index.php">Home</a></li>
                            <li><a href="">About Us</a></li>
                            
                             <li class="menu-has-children"><a href="#">Services</a>
                                <ul>
                                    <li><a href="">eWallet Systems Development</a></li>
                                    <li><a href="">Payment Gateway Integration</a></li>
                                    <li><a href="">IT Consulting and Advisory</a></li>
                                </ul>
                            </li>  
                            <li><a href="">Portfolio</a></li>
                            <li><a href="">Contact Us</a></li>
                            <li><a href="Register">Register</a></li>
                            <li><a href="auth/index">Login</a></li>
					   <!--<li class="flag"><a href="" data-toggle="modal" data-target="#langModal"><img src="common/img/flag/world.png"></a></li>-->
                        </ul> 
                    </nav>
                   
                </div>
                <!-- #nav-menu-container -->
            </div>
        </div>
    </header>
    <!-- End Header Area -->            
           
    <!-- Start hero-section -->
    <section class="hero-section relative">
        <div class="container">
            <div class="row align-items-center relative" style="height: 700px !important">
                <div class="col-lg-6 col-md-6 content-wrap">
                    <h1>
                    FinTech Solutions<br>for your business
                    </h1>
                    <p class="pt-20 pb-10 mw-510">
                        <?php echo $site_settings['brand_name']; ?> is a Financial Technology company specializing in the development and provision of modern payments solutions and services
                    </p>
                    <a href="Register" class="genric-btn2">3 Days Free trial</a>
                </div>
                <div class="col-lg-6 col-md-6 text-center" style="position: relative">
                    <img class="img-fluid updown updown-money" src="common/img/banner_01-icon1.png">
                    <img class="img-fluid updown2 updown-money" src="common/img/banner_01-icon2.png">
                    <img class="img-fluid" src="common/img/banner_01.png" alt="">
                </div>
            </div>
        </div>
        
    </section>
    <!-- End hero-section -->
    
     <!-- Start important-points section -->
    <section class="important-points-section section-gap">
        <div class="container">
            <div class="row justify-content-center section-title-wrap">
                <div class="col-lg-12">
                    <h1>Our Services</h1>
                    <p>
                     Mix and match products from <?php echo $site_settings['brand_name']; ?>'s payment suite to solve for your exact business use case.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 single-points aquablue-bg">
                    <img src="common/img/points-01.png" alt="">
                    <h4>Digital Wallet</h4>
                    <p>Full-fledged payment system for all kinds of payments and transfers. Whether you operate financial services company, a retail network or a telecom operator – our eWallet solution will bring your business to the next level, allowing you to harness up-to-date tech trends.</p>
                </div>
                <div class="col-lg-4 col-md-6 single-points aquablue-bg">
                    <img src="common/img/points-02.png" alt="">
                    <h4>Payment Gateway</h4>
                    <p>We offer white label services, which allow payment service providers, e-commerce platforms, ISOs, resellers, or acquiring banks to fully brand the payment gateway's technology as their own.</p>
                </div>
                <div class="col-lg-4 col-md-6 single-points aquablue-bg">
                    <img src="common/img/points-03.png" alt="">
                    <h4>IT Consulting & Advisory</h4>
                    <p>Technology can help you build better relationships with your customers, cut costs, drive growth and generate value, but it also has the potential to do the exact opposite.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End important-points section -->
    
    <!-- Start unique-feature Area -->
    <section class="unique-feature-area section-gap">
        <div class="container">
            <div class="row justify-content-center section-title-wrap">
                <div class="col-lg-12">
                    <h1>Why Choose Us</h1>
                    <p>Empower your business with all the right tools to accept online payments and provide the best customer experience</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                        <img class="img-fluid" src="common/img/banner_02.png" alt="">
                </div>
                <div class="col-lg-6">
                   
                    <div class="feature-list single-ex-process d-flex flex-row">
                        <div class="icon">
                            <img src="common/img/features-01.png" alt="">
                        </div>
                        <div class="desc ml-20">
                            <h4>Scalability</h4>
                            <p class="mt-20 mb-0">The unique technology and the open architecture allow our products and systems adapting the requirements of customers</p>
                        </div>
                    </div>
                    
                   <div class="feature-list single-ex-process d-flex flex-row">
                        <div class="icon">
                            <img src="common/img/features-02.png" alt="">
                        </div>
                        <div class="desc ml-20">
                            <h4>Robust</h4>
                            <p class="mt-20 mb-0">The security, performance and efficiency of our products and systems are ensured by tests and practical operation for a period of time</p>
                        </div>
                    </div>
                    
                   <div class="feature-list single-ex-process d-flex flex-row">
                        <div class="icon">
                            <img src="common/img/features-03.png" alt="">
                        </div>
                        <div class="desc ml-20">
                            <h4>Secure</h4>
                            <p class="mt-20 mb-0">We’ll use the top technology to protect your information and security, our websites and systems are also certified by global security solution providers</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- End unique-feature Area -->
    
    <!-- Start client-review section -->
    <section class="client-review-section section-gap">
                <div class="container">
                    <div class="row justify-content-center section-title-wrap">
                        <div class="col-lg-12">
                            <h1>Our Clients are our first Priority</h1>
                        </div>
                    </div>                     
                    <div class="active-review-carusel">
                        <div class="single-review">
                            <div class="quote-wrap">
                                <p>
                                    “<?php echo $site_settings['brand_name']; ?>'s FinTech solution was much smoother than any previously undertaken and the level of customer support was superb.”
                                </p>
                                <div class="star">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>                
                                </div>                                      
                            </div>
                            <div class="userinfo-wrap aquablue-bg d-flex flex-row align-items-center relative">
                                <div></div>
                                <div class="thumb relative">
                                    <img src="common/img/review/u1.png" alt="">
                                </div>
                                <div class="details relative">
                                     <h4>Vera Ball</h4>
                                     <p>Founder, CEO</p>
                                </div>
                            </div>
                        </div>  
                        <div class="single-review">
                            <div class="quote-wrap">
                                <p>
                                    “<?php echo $site_settings['brand_name']; ?> helped us focus on our core business without worrying about payment issues.”
                                </p>
                                <div class="star">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star  checked"></span>                
                                </div>                                      
                            </div>
                            <div class="userinfo-wrap aquablue-bg d-flex flex-row align-items-center relative">
                                <div></div>
                                <div class="thumb relative">
                                    <img src="common/img/review/u2.png" alt="">
                                </div>
                                <div class="details relative">
                                     <h4>Derek Malone</h4>
                                     <p>CTO</p>
                                </div>
                            </div>
                        </div>  
                        <div class="single-review">
                            <div class="quote-wrap">
                                <p>
                                    “Our experience working with <?php echo $site_settings['brand_name']; ?> has been great. For our core consumer payments solution, <?php echo $site_settings['brand_name']; ?> has helped us achieve good payment success rates.”
                                </p>
                                <div class="star">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>                
                                </div>                                      
                            </div>
                            <div class="userinfo-wrap aquablue-bg d-flex flex-row align-items-center relative">
                                <div></div>
                                <div class="thumb relative">
                                    <img src="common/img/review/u3.png" alt="">
                                </div>
                                <div class="details relative">
                                     <h4>Stella Pierce</h4>
                                     <p>CFO</p>
                                </div>
                            </div>
                        </div>                                                                                
                    </div>
                </div>    
            </section>
    <!-- End client-review section -->
    

  
 <section class="cta-section section-gap gradient-bg2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="text-white">Supercharge your business with <?php echo $site_settings['brand_name']; ?></h2>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex flex-row justify-content-end cta-btn">
                        <a href="#" class="ct-btn active">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section> 
   
     <!-- start footer Area -->      
    <footer class="footer-area section-gap" style="padding-bottom: 30px">

        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer-widget">
                        <img class="footerlogo" src="<?php echo $site_settings['logo_url']; ?>">
                        <p><?php echo $site_settings['brand_name']; ?> is a software house dedicated to providing IT technology solutions to financial institutions. The company founder has over 15 years of professional experience in investment bank, listed company and multinational corporations to lead the development team to complete significant number of large-scale projects.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer-widget">
                        <h4>Services</h4>
                        <ul class="menu-list">
                            <li><a href="service-ewallet.php">eWallet Systems Development</a></li>
                            <li><a href="service-payment.php">Payment Gateway Integration</a></li>
                            <li><a href="service-consulting.php">IT Consulting and Advisory</a></li>
                        </ul>
                    </div>
                </div>                  
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer-widget">
                        <h4>Quick Link</h4>
                        <ul class="menu-list">
                            <li><a href="privacy.php">Privacy</a></li>
                            <li><a href="terms.php">Terms & Conditions</a></li>
                            <li><a href="disclaimer.php">Disclaimer</a></li>
                        </ul>
                    </div>
                </div> 
                                                                              
                                      
            </div>
            <div class="footer-bottom row justify-content-center mt-30">
                <p class="footer-text m-0 col-lg-6 col-md-12">© <script>document.write(new Date().getFullYear())</script> <?php echo $site_settings['brand_name']; ?>. All Rights Reserved.</a></p>
            </div>
        </div>
    </footer>   
    <!-- End footer Area -->

    <script src="common/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="common/js/popper.min.js"></script>
    <script src="common/js/vendor/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="common/js/easing.min.js"></script>            
    <script src="common/js/superfish.min.js"></script>
    <script src="common/js/jquery.ajaxchimp.min.js"></script>
    <script src="common/js/owl.carousel.min.js"></script>   
    <script src="common/js/mail-script.js"></script>
    <script src="common/js/main.js"></script>
    <script src="common/js/changelang.js"></script>
</body>

</html>

<!-- Start of ccavenuehelpdesk Zendesk Widget script -->
<script> var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = 'https://media.wanotifier.com/assets/whatsapp-button.js'; s.onload = function() { CreateWhatsappChatWidget({"phoneNumber":"+919305872054","greetingMessage":"Hi, how can we help you?","buttonStyle":"btn-style-1","customImageUrl":""}); }; document.body.appendChild(s); </script>
<!-- End of ccavenuehelpdesk Zendesk Widget script -->
<div id="langModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h3 class="mt-20">Switch The Language</h3>
        <div class="mt-30 mb-30 languagebox">
		  <a href="javascript:changeLanguage('/en/')"><img src="common/img/flag/en.png"> English</a>
		  <a href="javascript:changeLanguage('/tc/')"><img src="common/img/flag/tc.png"> 繁體</a>
      	  <a href="javascript:changeLanguage('/sc/')"><img src="common/img/flag/cn.png"> 简体</a>
		  </div>
      </div>
    </div>
  </div>
</div>
<!-- modal -->
  