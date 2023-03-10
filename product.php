<?php
ob_start();
session_start();
include 'inc/config.php';
if(isset($_GET['product_id']) ){
    $product_id = $_GET['product_id'];
}else{
    header('location:my-account.php');
}

$single_product_query = mysqli_query($connection,"SELECT * FROM `products` WHERE `id` = '$product_id' ");
$single_product = mysqli_fetch_assoc($single_product_query);
if($product_id != $single_product['id']){
    header('location:shop.php');
}
$single_product_id = $single_product['id'];
$title = $product_title = $single_product['title'];

$reviewQuery =mysqli_query($connection,"SELECT * FROM `review` WHERE `product_id` = '$single_product_id'");
$reviewTotalQuery = mysqli_query($connection,"SELECT count(*) AS review_total FROM `review` WHERE `product_id` = '$single_product_id'");
$reviewcount = mysqli_fetch_assoc($reviewTotalQuery);

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
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop.php">Shop</a></li>
                                    <li class="active" aria-current="page"><?php echo $single_product['title']; ?></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->
    <!-- Start Product Details Section -->
    <div class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-details-gallery-area">
                        <div class="product-large-image product-large-image-horaizontal">
                            <div class="product-image-large-single zoom-image-hover">
                                <img src="assets/images/products_images/<?php echo $single_product['image']; ?>" alt="<?php echo $single_product['image']; ?>">
                            </div>
                        </div>
                        <div class="product-image-thumb product-image-thumb-horizontal pos-relative">
                            <div class="zoom-active product-image-thumb-single">
                                <img class="img-fluid" src="assets/images/products_images/<?php echo $single_product['image']; ?>" alt="<?php echo $single_product['image']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-details-content-area">
                        <!-- Start  Product Details Text Area-->
                        <div class="product-details-text">
                            <h4 class="title"><?php echo $single_product['title']; ?></h4>
                            <?php if($single_product['sale_price'] == 0 AND empty($single_product['sale_price'])) {?>
                                <span class="price"> <?php echo "Rs ".$single_product['regular_price']; ?></span>
                            <?php
                                }else{
                            ?>
                                <span class="price"><del><?php echo "Rs ".$single_product['regular_price']; ?></del> <?php echo "Rs ".$single_product['sale_price']; ?></span>
                            <?php } ?>

                        </div> <!-- End  Product Details Text Area-->
                        
                        <!-- Start Product Variable Area -->
                        <form action="req/add_to_cart.php" method="GET">
                        <div class="product-details-variable">
                            <div class="d-flex align-items-center">
                                <div class="variable-single-item ">
                                    <span>Quantity</span>
                                    <div class="product-variable-quantity">
                                        <input value="<?php echo $single_product['id']; ?>" type="hidden" name="product_id">
                                        <input min="1" max="5" value="1" type="number" name="product_qty">
                                    </div>
                                </div>

                                <div class="product-add-to-cart-btn">
                                    <button type="submit">Add To Cart</button>
                                </div>
                            </div>
                        </div> <!-- End Product Variable Area -->
                        </form>
                       
                        <!-- Start  Product Details Meta Area-->
                        <div class="product-details-meta mb-20">
                            <ul>
                                <li><a href="req/add_to_wishlist.php?wish_product_id=<?php echo $single_product['id']; ?>"><i class="icon-heart"></i>Add to wishlist</a></li>
                                <li class="d-none"><a href=""><i class="icon-repeat"></i>Compare</a></li>
                            </ul>
                        </div> <!-- End  Product Details Meta Area-->

                        <div class="border-top" style="border-color:#eee !important">
                                Category: <span class="theme-color" style="font-weight: 800; font-size:15px;"><?php echo $single_product['category_name']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Details Section -->

    <!-- Start Product Content Tab Section -->
    <div class="product-details-content-tab-section section-inner-bg section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-content-tab-wrapper">

                        <!-- Start Product Details Tab Button -->
                        <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                            <li><a class="nav-link active" data-toggle="tab" href="#description">
                                    <h5>Description</h5>
                                </a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#review">
                                    <h5>Reviews (<?php echo $reviewcount['review_total']; ?>)</h5>
                                </a></li>
                        </ul> <!-- End Product Details Tab Button -->

                        <!-- Start Product Details Tab Content -->
                        <div class="product-details-content-tab">
                            <div class="tab-content">
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane active show" id="description">
                                    <div class="single-tab-content-item">
                                        <p><?php echo $single_product['description']; ?></p>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane" id="review" >
                                    <div class="single-tab-content-item">
                                        <!-- Start - Review Comment -->
                                        <ul class="comment">
                                            <!-- Start - Review Comment list-->
                                            <?php 
                                                if (mysqli_num_rows($reviewQuery) > 0) {
                                                    while($review = mysqli_fetch_assoc($reviewQuery)){ 
                                            ?>
                                            <li class="comment-list">
                                                <div class="comment-wrapper">
                                                    <div class="comment-img">
                                                        <img src="assets/images/user/user-image.png" alt="">
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-content-top">
                                                            <div class="comment-content-left">
                                                                <h6 class="comment-name"><?php echo $review['name']; ?></h6>
                                                                <div class="product-review">
                                                                    <?php 
                                                                        $count = 1;
                                                                        while($count <= $review['rating']){ 
                                                                    ?>
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span> 
                                                                    <?php
                                                                    
                                                                    $count++; } 
                                                                    ?>
                                                                    <span style="margin-left:5px; font-weight:700;"><?php echo$review['rating']; ?> / 5</span>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="para-content">
                                                            <p><?php echo $review['view']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php }}else{  ?>
                                                <p style="font-size:20px; text-align:center; font-weight:500;">No Review Yet</p>
                                            <?php } ?>
                                            <!-- End - Review Comment list-->
                                        </ul> <!-- End - Review Comment -->
                                        <div class="review-form">
                                            <div class="review-form-text-top">
                                                <h5>ADD A REVIEW</h5>
                                            </div>

                                            <form class="rating-form"  action="req/review.php" method="post">
                                                <div class="row">
                                                    
                                                    <div class="col-md-12">
                                                        <div class="default-form-box">
                                                            <label>Your Rating <span>*</span></label>
                                                        </div>
                                                        <fieldset class="form-group">
                                                        
                                                            <div class="form-item">
                                                              <input id="rating-5" name="rating" type="radio" value="5" />
                                                              <label for="rating-5" data-value="5">
                                                                <span class="rating-star">
                                                                  <i class="fa fa-star-o"></i>
                                                                  <i class="fa fa-star"></i>
                                                                </span>
                                                              </label>
                                                              <input id="rating-4" name="rating" type="radio" value="4" />
                                                              <label for="rating-4" data-value="4">
                                                                <span class="rating-star">
                                                                  <i class="fa fa-star-o"></i>
                                                                  <i class="fa fa-star"></i>
                                                                </span>
                                                              </label>
                                                              <input id="rating-3" name="rating" type="radio" value="3" />
                                                              <label for="rating-3" data-value="3">
                                                                <span class="rating-star">
                                                                  <i class="fa fa-star-o"></i>
                                                                  <i class="fa fa-star"></i>
                                                                </span>
                                                              </label>
                                                              <input id="rating-2" name="rating" type="radio" value="2" />
                                                              <label for="rating-2" data-value="2">
                                                                <span class="rating-star">
                                                                  <i class="fa fa-star-o"></i>
                                                                  <i class="fa fa-star"></i>
                                                                </span>
                                                              </label>
                                                              <input id="rating-1" name="rating" type="radio" value="1" />
                                                              <label for="rating-1" data-value="1">
                                                                <span class="rating-star">
                                                                  <i class="fa fa-star-o"></i>
                                                                  <i class="fa fa-star"></i>
                                                                </span>
                                                              </label>
                                                            </div>
                                                        
                                                        </fieldset>                                                        
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="default-form-box mb-20">
                                                            <label for="comment-name">Your name <span>*</span></label>
                                                            <input id="comment-name" type="text" placeholder="Enter your name" name="name" required>
                                                            <input type="hidden" name="product_id" value="<?php echo $single_product_id; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="default-form-box mb-20">
                                                            <label for="comment-email">Your Email <span>*</span></label>
                                                            <input id="comment-email" type="email" placeholder="Enter your email" name="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="default-form-box mb-20">
                                                            <label for="comment-review-text">Your review <span>*</span></label>
                                                            <textarea id="comment-review-text" placeholder="Write a review" name="view" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="form-submit-btn" name="submit_review" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                            </div>
                        </div> <!-- End Product Details Tab Content -->

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Content Tab Section -->

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
                                                    <li><a href="req/add_to_wishlist.php?wish_product_id=<?php echo $new_arival['id']; ?>" ><i class="icon-heart"></i></a></li>
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
    <!-- ...:::: End Product Section:::... -->


    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
