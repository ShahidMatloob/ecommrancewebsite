<?php
ob_start();
session_start();
$title = "Track Order";
?>

<!--header start -->

<?php include 'inc/header.php' ?>

<!--header end -->


<div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Account</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active" aria-current="page">Track Order</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Customer  Section :::... -->
    <div class="customer_login">
        <div class="container">
            <div class="row">

                <!--track order area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        <?php           
                            if(isset($_SESSION['track_msg'])){
                                ?>
                                <div class="alert alert-danger text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo $_SESSION['track_msg']; ?>
                                </div>
                                <?php
                                unset($_SESSION['track_msg']);
                            }
                        ?>         
                        <h3>Track Your Order Status</h3>
                        <form action="order-tracked.php" method="GET">
                            <div class="default-form-box mb-20">
                                <label>Order Track ID <span>*</span></label>
                                <input type="number" name="tracking_number" required>
                            </div>
                            <div class="login_submit">
                                <button type="submit">Track Order</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--track order area end-->
            </div>
        </div>
    </div> <!-- ...:::: End Customer  Section :::... -->

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
