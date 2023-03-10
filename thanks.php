<?php 
ob_start();
session_start();
$title = "Thank You";
if (!isset($_SESSION['thanks'])) {
    header('location:shop.php');
}
unset($_SESSION['thanks'])
?>


<!--header start -->

<?php include 'inc/header.php' ?>

<!--header end -->


<div class="offcanvas-overlay"></div>


<div class="container mt-100">
    <div class="row text-center ">
        <!--Thanks Order area start-->
        <div class="col-lg-12 col-md-12">
            <div>
                <img src="assets/images/tick.png" alt="tick" style="height: 110px; margin:0 0 20px 0">
            </div>
            <h1>Thank You</h1>
            <p style="font-size: 20px;">Your Order has been placed successfully.</p>
            <p style="font-size: 20px; margin: -15px 0;">We have sent you an email with Tracking No. of your Order. You can <a href="track-order.php" style="text-decoration:underline; font-size: 23px; font-weight:500; color: #fc7070;">Track Your Order</a> . </p>
        </div>

    </div>
</div>

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
