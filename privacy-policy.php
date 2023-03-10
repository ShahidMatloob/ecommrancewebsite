<?php
ob_start();
session_start();
$title = "Privacy Policy";
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
                        <h3 class="breadcrumb-title"><?php echo $title ?></h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active" aria-current="page"><?php echo $title ?></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...::::Start Privacy Policy  Section:::... -->
    <div class="privacy-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="privacy-policy-wrapper">
                        <div class="privacy-single-item">
                            <h3>What personal data we collect and why we collect it</h3>
                            <h4>Comments</h4>
                            <p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor’s IP address and browser user agent string to help spam detection.</p>
                        </div> <!-- Start Privacy Policy Single Item -->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...::::End Privacy Policy Section:::... -->

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
