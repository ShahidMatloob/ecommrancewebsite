<?php 
ob_start();
session_start();
$title = "Home ";

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}


?>

<!--header start -->

<?php
    include 'inc/header.php'; 
    $sliderQuery = mysqli_query($connection,"SELECT * FROM `slider`");
?>

<!--header end -->

    <div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Hero Area Section:::... -->
    <div class="hero-area">
        <div class="hero-area-wrapper hero-slider-dots fix-slider-dots">
        <?php while($slider = mysqli_fetch_assoc($sliderQuery)){ ?>
            <!-- Start Hero Slider Single -->
            <div class="hero-area-single">
                <div class="hero-area-bg">
                    <img class="hero-img" src="assets/images/slider_images/<?php echo $slider['slider_image']; ?>" alt="<?php echo $slider['slider_image']; ?>">
                </div>
            </div> 
            <!-- End Hero Slider Single -->
            <?php } ?>
        </div>
    </div> <!-- ...:::: End Hero Area Section:::... -->

    <!-- ...:::: Start Product Catagory Section:::... -->
    <div class="product-catagory-section section-top-gap-100">
        <!-- Start Section Content -->
        <div class="section-content-gap">
            <div class="container">
                <div class="row">
                    <div class="section-content">
                        <h3 class="section-title">Featured Categories</h3>
                    </div>
                </div>
            </div>
        </div> <!-- End Section Content -->

        <!-- ...:::: Start category Banner Section:::... -->
        <div class="banner-section ">
            <!-- Start category Banner Wrapper -->
            <div class="banner-wrapper">
                <div class="container">
                    <div class="row">
                    <?php
                        $category_q = mysqli_query($connection,"SELECT * FROM `category` WHERE `is_featured` = 'Yes' ")  ;                  
                        while($feature_category = mysqli_fetch_assoc($category_q)){ 
                    ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Start category Banner Single -->
                            <div class="banner-single">
                                <a href="shop.php?category_id=<?php echo $feature_category['id']; ?>&category_name=<?php echo $feature_category['category']; ?>" class="banner-img-link">
                                    <img class="banner-img" src="assets/images/categories_images/<?php echo $feature_category['category_image']; ?>" alt="<?php echo $feature_category['category_image']; ?> " style="height: 368px;">
                                </a>
                            </div> <!-- End category Banner Single -->
                            <div class="banner-content-bottom">
                                <h3 class="banner-text-md"><?php echo $feature_category['category']; ?></h3>
                                <span style="text-align: center;"><a href="shop.php?category_id=<?php echo $feature_category['id']; ?>&category_name=<?php echo $feature_category['category']; ?>" class="banner-link">Shop Now</a></span>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div> <!-- End Banner Wrapper -->
        </div> <!-- ...:::: End Banner Section:::... -->
    </div> <!-- ...:::: End Product Catagory Section:::... -->

    
    
    <!-- ...:::: Start New Arrival Section:::... -->
    <div class="product-tab-section section-top-gap-100">
        <!-- Start Section Content -->
        <div class="section-content-gap">
            <div class="container">
                <div class="row">
                    <div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                        <h3 class="section-title">Featured Products</h3>
                    </div>
                </div>
            </div>
        </div> <!-- End Section Content -->

        <!-- Start Product Wrapper -->
        <div class="product-tab-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content tab-animate-zoom">
                            <div class="tab-pane show active">
                                <div class="product-default-slider product-default-slider-4grids-1row">
                                <?php 
                                    $feature_product_query = mysqli_query($connection,"SELECT * FROM `products` WHERE `is_featured` = 1 ORDER BY `products`.`id` DESC LIMIT 5");
                                    if (mysqli_num_rows($feature_product_query) > 0) {
                                        while($feature_product = mysqli_fetch_assoc($feature_product_query)){
                                ?>
                                    <!-- Start Product Defautlt Single -->
                                    <div class="product-default-single border-around">
                                        <div class="product-img-warp">
                                            <a href="product.php?product_id=<?php echo $feature_product['id']; ?>" class="product-default-img-link">
                                                <img src="assets/images/products_images/<?php echo $feature_product['image']; ?>" alt="<?php echo $feature_product['image']; ?>" class="product-default-img img-fluid">
                                            </a>
                                            <div class="product-action-icon-link">
                                                <ul>
                                                    <li><a href="req/add_to_wishlist.php?wish_product_id=<?php echo $feature_product['id']; ?>"><i class="icon-heart"></i></a></li>
                                                    <li class="d-none"><a href="#"><i class="icon-repeat"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-default-content">
                                            <h6 class="product-default-link"><a href="product.php?product_id=<?php echo $feature_product['id']; ?>"><?php echo $feature_product['title']; ?></a></h6>
                                            <?php if($feature_product['sale_price'] == 0 AND empty($feature_product['sale_price'])) {?>
                                                <span class="product-default-price"> <?php echo "Rs ".$feature_product['regular_price']; ?></span>
                                            <?php
                                                }else{
                                            ?>
                                                <span class="product-default-price"><del class="product-default-price-off"><?php echo "Rs ".$feature_product['regular_price']; ?></del> <?php echo "Rs ".$feature_product['sale_price']; ?></span>
                                            <?php    } 
                                                if (in_array($feature_product['id'],$product_id_array)) {
                                            ?>

                                                <a href="req/add_to_cart.php?product_id=<?php echo $feature_product['id']; ?>" class="btn-add-to-cart  btn-dark">Product Added</a>
                                            
                                            <?php
                                                }else{
                                            ?>
                                            
                                                <a href="req/add_to_cart.php?product_id=<?php echo $feature_product['id']; ?>" class="btn-add-to-cart">Add to Cart</a>

                                            <?php } ?>

                                        </div>
                                    </div> <!-- End Product Defautlt Single -->

                                    <?php }} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Product Wrapper -->

    </div> 



    <!-- ...:::: Start New Arrival Section:::... -->
    <div class="product-tab-section section-top-gap-100">
        <!-- Start Section Content -->
        <div class="section-content-gap">
            <div class="container">
                <div class="row">
                    <div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                        <h3 class="section-title">New Arrivals</h3>
                    </div>
                </div>
            </div>
        </div> <!-- End Section Content -->

        <!-- Start Product Wrapper -->
        <div class="product-tab-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content tab-animate-zoom">
                            <div class="tab-pane show active">
                                <div class="product-default-slider product-default-slider-4grids-1row">
                                <?php 
                                    $new_arrival_query = mysqli_query($connection,"SELECT * FROM `products` ORDER BY `products`.`id` DESC LIMIT 5");
                                    if (mysqli_num_rows($new_arrival_query) > 0) {
                                        while($new_arival = mysqli_fetch_assoc($new_arrival_query)){
                                ?>
                                    <!-- Start Product Defautlt Single -->
                                    <div class="product-default-single border-around">
                                        <div class="product-img-warp">
                                            <a href="product.php?product_id=<?php echo $new_arival['id']; ?>" class="product-default-img-link">
                                                <img src="assets/images/products_images/<?php echo $new_arival['image']; ?>" alt="<?php echo $new_arival['image']; ?>" class="product-default-img img-fluid">
                                            </a>
                                            <div class="product-action-icon-link">
                                                <ul>
                                                    <li><a href="req/add_to_wishlist.php?wish_product_id=<?php echo $new_arival['id']; ?>"><i class="icon-heart"></i></a></li>
                                                    <li class="d-none"><a href="#"><i class="icon-repeat"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-default-content ">
                                            <h6 class="product-default-link"><a href="product.php?product_id=<?php echo $new_arival['id']; ?>"><?php echo $new_arival['title']; ?></a></h6>
                                            <?php if($new_arival['sale_price'] == 0 AND empty($new_arival['sale_price'])) {?>
                                                <span class="product-default-price"> <?php echo "Rs ".$new_arival['regular_price']; ?></span>
                                            <?php
                                                }else{
                                            ?>
                                                <span class="product-default-price"><del class="product-default-price-off"><?php echo "Rs ".$new_arival['regular_price']; ?></del> <?php echo "Rs ".$new_arival['sale_price']; ?></span>
                                            <?php    } 
                                            
                                            if (in_array($new_arival['id'],$product_id_array)) {
                                            ?>

                                                <a href="req/add_to_cart.php?product_id=<?php echo $new_arival['id']; ?>" class="btn-add-to-cart btn-dark">Product Added</a>

                                            <?php
                                            }else{
                                            ?>
                                            
                                                <a href="req/add_to_cart.php?product_id=<?php echo $new_arival['id']; ?>" class="btn-add-to-cart">Add to Cart</a>

                                            <?php } ?>
                                        </div>
                                    </div> <!-- End Product Defautlt Single -->

                                    <?php }} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Product Wrapper -->

    </div> 

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
