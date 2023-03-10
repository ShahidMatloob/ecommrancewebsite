<?php
ob_start();
session_start();
$title = "Wishlist";
?>

<!--header start -->

<?php 

    include 'inc/header.php';
    if (isset($_SESSION['UserID'])) {
        $wishlistQuery = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE `user_id` = '" . $_SESSION['UserID'] . "' ORDER BY `wishlist`.`id` DESC");
    }
?>

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
                                    <li class="active" aria-current="page"><?php echo $title; ?></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Wishlist Section:::... -->
    <div class="wishlist-section">
        <!-- Start Cart Table -->
        <div class="wishlish-table-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <?php 

                        if(isset($_SESSION['wish_msg'])){
                            ?>
                            <div class="alert alert-success text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php echo $_SESSION['wish_msg']; ?>
                            </div>
                            <?php
                            unset($_SESSION['wish_msg']);
                        }
                        if (isset($_SESSION['UserID'])) {
                            
                        
                          if (mysqli_num_rows($wishlistQuery) > 0) { 
                              
                        ?>

                        <div class="table_desc">
                            <div class="table_page table-responsive" style="overflow-x: auto;">
                                <table>
                                    <!-- Start Wishlist Table Head -->
                                    <thead>
                                        <tr>
                                            <th class="product_remove"></th>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_stock">Wish Date</th>
                                            <th class="product_addcart">Add To Cart</th>
                                        </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <tbody>
                                        <!-- Start Wishlist Single Item-->
                                    <?php 
                                        while( $wish = mysqli_fetch_assoc($wishlistQuery)){ 
                                        $product_in_wish_query = mysqli_query($connection,"SELECT * FROM `products` WHERE `id` = '" . $wish['product_id'] . "' ");
                                        $product_in_wish = mysqli_fetch_assoc($product_in_wish_query);
                                    ?>

                                        <tr>
                                            <td class="product_remove"><a href="req/remove_wish.php?wish_product_id=<?php echo $product_in_wish['id']; ?>"><i class="fa fa-trash-o"></i></a></td>
                                            <td class="product_thumb"><a href="product.php?product_id=<?php echo $product_in_wish['id']; ?>"><img src="assets/images/products_images/<?php echo $product_in_wish['image']; ?>" alt=""></a></td>
                                            <td class="product_name"><a href="product.php?product_id=<?php echo $product_in_wish['id']; ?>"><?php echo $product_in_wish['title']; ?></a></td>
                                            <?php 
                                                if($product_in_wish['sale_price'] == 0 AND empty($product_in_wish['sale_price'])) {
                                                    $price = $product_in_wish['regular_price'];
                                                }else{
                                                    $price = $product_in_wish['sale_price'];
                                                }
                                            ?>

                                            <td class="product-price">Rs. <?php echo $price; ?></td>
                                            <td class="product_stock"><?php echo $wish['created_at']; ?></td>
                                            <td class="product_addcart"><a href="req/add_to_cart.php?wish_product_id=<?php echo $product_in_wish['id']; ?>" >Add To Cart</a></td>
                                        </tr> <!-- End Wishlist Single Item-->

                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } else { ?>
                            <div class="text-center"><h3>No item in Wishlist.</h3></div>
                        <?php }
                        }else{?>
                            <div class="text-center"><h3>You must<a href='my-account.php' ><b> login or register </b></a>to add items to your wishlist.</h3></div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->
    </div> <!-- ...:::: End Wishlist Section:::... -->

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
