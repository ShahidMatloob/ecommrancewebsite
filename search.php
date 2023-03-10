<?php
ob_start();
session_start();
$title = "Search";

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
                        <h3 class="breadcrumb-title"><?php echo $title; ?></h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="search.php"><?php echo $title; ?></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

<?php 

if ($_POST && !empty($_POST['search'])) {

    $search = substr(mysqli_real_escape_string($connection, $_POST['search']), 0, -1);
    $search_query = mysqli_query($connection, "SELECT * FROM `products` WHERE 
                                        `title` LIKE '%$search%' OR 
                                        `description` LIKE '%$search%' OR 
                                        `category_name` LIKE '%$search%'
                                        ");

    $results = mysqli_num_rows($search_query);

?>


    <!-- ...:::: Start Search Section:::... -->
    <div class="shop-section">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <?php //include 'inc/shop_sidebar.php'; ?>
                <div class="col-lg-12">
                    <!-- Start Shop Product Sorting Section -->
                    <div class="shop-sort-section"  style="display:none">
                        <div class="container">
                            <div class="row">
                                <!-- Start Sort Wrapper Box -->
                                <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                                    <!-- Start Sort Select Option -->
                                    <div class="sort-select-list">
                                        <form action="#">
                                            <fieldset>
                                                <select name="speed" id="speed">
                                                    <option>Sort by average rating</option>
                                                    <option>Sort by popularity</option>
                                                    <option selected="selected">Sort by newness</option>
                                                    <option>Sort by price: low to high</option>
                                                    <option>Sort by price: high to low</option>
                                                    <option>Product Name: Z</option>
                                                </select>
                                            </fieldset>
                                        </form>
                                    </div> <!-- End Sort Select Option -->

                                    <!-- Start Page Amount -->
                                    <div class="page-amount">
                                        <span>Showing 1–9 of 21 results</span>
                                    </div> <!-- End Page Amount -->

                                </div> <!-- Start Sort Wrapper Box -->
                            </div>
                        </div>
                    </div> <!-- End Section Content -->

                    <!-- Start Tab Wrapper -->
                    <div class="sort-product-tab-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content tab-animate-zoom">
                                        <!-- Start Grid View Product -->
                                        <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                                            <?php if ($results > 0) { 
                                                echo $results . " Search reasults are:"; 
                                                }    
                                            ?>
                                            <div class="row">
                                            <?php 
                                            if ($results > 0) {
                        
                                                while($product = mysqli_fetch_assoc($search_query)){ 
                                                
                                            ?>
                                                <div class="col-xl-3 col-sm-6 col-12">
                                                    <!-- Start Product Defautlt Single -->
                                                    <div class="product-default-single border-around">
                                                        <div class="product-img-warp">
                                                            <a href="product.php?product_id=<?php echo $product['id']; ?>&product_title=<?php echo $product['title']; ?>" class="product-default-img-link">
                                                                <img src="assets/images/products_images/<?php echo $product['image']; ?>" alt="<?php echo $product['image']; ?>" class="product-default-img img-fluid">
                                                            </a>
                                                            <div class="product-action-icon-link">
                                                                <ul>
                                                                    <li><a href="req/add_to_wishlist.php?wish_product_id=<?php echo $product['id']; ?>"><i class="icon-heart"></i></a></li>
                                                                    <li class="d-none"><a href="#"><i class="icon-repeat"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="product-default-content">
                                                            <h6 class="product-default-link"><a href="product.php?product_id=<?php echo $product['id']; ?>&product_title=<?php echo $product['title']; ?>"><?php echo $product['title']; ?></a></h6>
                                                            <?php if($product['sale_price'] == 0 AND empty($product['sale_price'])) {?>
                                                                <span class="product-default-price"> <?php echo "Rs ".$product['regular_price']; ?></span>
                                                            <?php
                                                                }else{
                                                            ?>
                                                                <span class="product-default-price"><del class="product-default-price-off"><?php echo "Rs ".$product['regular_price']; ?></del> <?php echo "Rs ".$product['sale_price']; ?></span>
                                                            <?php    } 
                                                                if (in_array($product['id'],$product_id_array)) {
                                                            ?>

                                                                <a href="req/add_to_cart.php?product_id=<?php echo $product['id']; ?>" class="btn-add-to-cart  btn-dark">Product Added</a>
                                                            
                                                            <?php
                                                                }else{
                                                            ?>
                                                            
                                                                <a href="req/add_to_cart.php?product_id=<?php echo $product['id']; ?>" class="btn-add-to-cart">Add to Cart</a>

                                                            <?php } ?>

                                                        </div>
                                                    </div> <!-- End Product Defautlt Single -->
                                                </div>
                                            <?php } 
                                                    }else{?>
                                                        <div class="text-center"><h3>No Product Found.</h3></div>
                                            <?php } ?>
                                            </div>
                                        </div> <!-- End Grid View Product -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Tab Wrapper -->
                    
                    <?php if ($results > 0) { ?>
                    <!-- Start Pagination -->
                    <div class="page-pagination text-center"  style="display:none">
                        <ul>
                            <li><a href="#">Previous</a></li>
                            <li><a class="active" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div> <!-- End Pagination -->
                    
                    <?php }else{} ?>


                </div> <!-- End Shop Product Sorting Section  -->
            </div>
        </div>
    </div> <!-- ...:::: End Search Section:::... -->

    <!--footer start -->

    <?php }else{ ?>
        <div class="text-center"><h3>Please Type Something to get Reasults.</h3></div>
    <?php } include 'inc/footer.php' ?>
    
    <!--footer end -->
