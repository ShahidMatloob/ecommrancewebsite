<?php
ob_start();
session_start();
$title = "About Us";
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

    <!-- ...::::Start About Us Top Section:::... -->
    <div class="about-us-top-area" style="margin-top: -50px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-us-top-content text-center">
                        <h4>Who we are?</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia minima consequuntur nulla voluptate sunt accusamus error dolores laboriosam facere, et saepe, velit incidunt doloremque ab eius. Explicabo magnam iure et.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End About Us Top Section:::... -->

    <!-- ...::::Start About Us Center Section:::... -->
    <div class="about-us-center-area section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-us-center-content text-center">
                        <h4>Why Chose Us?</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Start About Promo Single Item -->
                    <div class="about-promo-single-item">
                        <img src="assets/images/icon/about-icon-1.jpg" alt="">
                        <h6>Quality PRoducts</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia minima consequuntur nulla voluptate sunt accusamus error dolores laboriosam facere, et saepe, velit incidunt doloremque ab eius. Explicabo magnam iure et.</p>
                    </div> <!-- End About Promo Single Item -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Start About Promo Single Item -->
                    <div class="about-promo-single-item">
                        <img src="assets/images/icon/about-icon-2.jpg" alt="">
                        <h6>Nice Products</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia minima consequuntur nulla voluptate sunt accusamus error dolores laboriosam facere, et saepe, velit incidunt doloremque ab eius. Explicabo magnam iure et.</p>
                    </div> <!-- End About Promo Single Item -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Start About Promo Single Item -->
                    <div class="about-promo-single-item">
                        <img src="assets/images/icon/about-icon-3.jpg" alt="">
                        <h6>Online Support 24/7</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia minima consequuntur nulla voluptate sunt accusamus error dolores laboriosam facere, et saepe, velit incidunt doloremque ab eius. Explicabo magnam iure et.</p>
                    </div> <!-- End About Promo Single Item -->
                </div>
            </div>
        </div>
    </div> <!-- ...::::End  About Us Center Section -->


    <!-- ...::::Start Testimonial Section -->
    <div class="testimonial-section section-top-gap-100">
        <div class="container">
            <div class="row">
                <h4 class="testimonial-title">What Our Custumers Say ?</h4>
            </div>
            <div class="row">
                <div class="testimonial-slider fix-slider-dots testimonial-slider-dots">
                    <!-- Start Testiminial Single Item -->
                    <div class="testimonial-slider-single">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia minima consequuntur nulla voluptate sunt accusamus error dolores laboriosam facere, et saepe, velit incidunt doloremque ab eius. Explicabo magnam iure et.</p>
                        <div class="testimonial-img">
                            <img src="assets/images/testimonial/testimonial-1.png" alt="">
                        </div>
                        <span class="name">Kathy Young</span>
                    </div> <!-- End Testiminial Single Item -->
                    <!-- Start Testiminial Single Item -->
                    <div class="testimonial-slider-single">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia minima consequuntur nulla voluptate sunt accusamus error dolores laboriosam facere, et saepe, velit incidunt doloremque ab eius. Explicabo magnam iure et.</p>
                        <div class="testimonial-img">
                            <img src="assets/images/testimonial/testimonial-2.jpg" alt="">
                        </div>
                        <span class="name">Kathy Young</span>
                    </div> <!-- End Testiminial Single Item -->
                    <!-- Start Testiminial Single Item -->
                    <div class="testimonial-slider-single">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia minima consequuntur nulla voluptate sunt accusamus error dolores laboriosam facere, et saepe, velit incidunt doloremque ab eius. Explicabo magnam iure et.</p>
                        <div class="testimonial-img">
                            <img src="assets/images/testimonial/testimonial-3.jpg" alt="">
                        </div>
                        <span class="name">Kathy Young</span>
                    </div> <!-- End Testiminial Single Item -->
                </div>
            </div>
        </div>
    </div> <!-- End Testimonial Section:::... -->

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
