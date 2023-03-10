<?php
ob_start();
session_start();
$title = "Cart";
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

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
                                    <li class="active" aria-current="page"><?php echo $title; ?></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Cart Section:::... -->
    <div class="cart-section">
        <!-- Start Cart Table -->
        <div class="cart-table-wrapper">
            <div class="container">
                <div class="row">
                <form method="POST" action="req/update_cart.php">

                    <?php 
                        if(isset($_SESSION['message'])){
                            ?>
                            <div class="alert alert-success text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php echo $_SESSION['message']; ?>
                            </div>
                            <?php
                            unset($_SESSION['message']);
                        }

                        if(!empty($_SESSION['cart'])){
                    ?>

                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive" style="overflow-x: auto;">
                                <table>
                                    <!-- Start Cart Table Head -->
                                    <thead>
                                        <tr>
                                            <th class="product_remove"></th>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Total</th>
                                        </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <tbody>

                                    <?php
                                        //initialize total
                                        $total = 0;
                                        
                                        //create array of initail qty which is 1
                                        $product_in_cart_query = mysqli_query($connection,
                                                                "SELECT * FROM `products` WHERE `id` IN (".$product_in_cart_id.") ORDER BY FIELD(id,$product_in_cart_id)");
                                        $qty_index = 0;
                                        while($product_in_cart = mysqli_fetch_assoc($product_in_cart_query)){
                                                if (isset($product_in_cart['sale_price']) && $product_in_cart['sale_price'] != 0) {
                                                    $price = $product_in_cart['sale_price'];
                                                }else{
                                                    $price = $product_in_cart['regular_price'];
                                                }
                                    ?>


                                        <!-- Start Cart Single Item-->
                                        <tr>
                                            <td class="product_remove"><a href="req/delete_item.php?product_id=<?php echo $product_in_cart['id']; ?>"><i class="fa fa-trash-o"></i></a></td>
                                            <td class="product_thumb"><a href="product.php?product_id=<?php echo $product_in_cart['id']; ?>"><img src="assets/images/products_images/<?php echo $product_in_cart['image']; ?>" alt="<?php echo $product_in_cart['image']; ?>"></a></td>
                                            <td class="product_name"><a href="product.php?product_id=<?php echo $product_in_cart['id']; ?>"><?php echo $product_in_cart['title']; ?></a></td>
                                            <td class="product-price">Rs. <?php echo number_format($price,2); ?></td>
                                            <td class="product_quantity"><input type="number" min="1" value="<?php echo $product_qty_array[$qty_index]; ?>" name="product_qty[] ?>" ></td>
                                            <td class="product_total">Rs. <?php echo number_format($product_qty_array[$qty_index]*$price, 2); ?></td>
                                            <?php $total += $product_qty_array[$qty_index]*$price; ?>
                                        </tr> <!-- End Cart Single Item-->
                                    <?php
                                            $qty_index ++ ;
                                        }
                                            
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <a href="req/empty_cart.php" class="btn btn-dark">Empty Cart</a>
                                <button type="submit" class="btn btn-success bg-success btn-update-cart" name="update_cart">Update Cart</button>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>

                            <div class="text-center"><img src="assets/images/empty-cart.svg" alt=""></div>
                            <div class="text-center"><h3>Your Cart is Empty</h3></div>
                            <div class="text-center m-5"><a href="shop.php" class="btn btn-dark">Return to Shop</a></div>
                        
                    <?php } ?>
                </form>
                </div>
            </div>
        </div> <!-- End Cart Table -->


<?php if(!empty($_SESSION['cart'])){ ?>
        <!-- Start Coupon Start -->
        <div class="coupon_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 d-none">
                        <div class="coupon_code left">
                            <h3>Coupon</h3>
                            <div class="coupon_inner">
                                <p>Enter your coupon code if you have one.</p>
                                <input placeholder="Coupon code" type="text">
                                <button type="submit">Apply coupon</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 ml-auto order-2">
                        <div class="coupon_code right">
                            <h3>Cart Totals</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Subtotal</p>
                                    <p class="cart_amount">Rs. <?php echo number_format($total, 2); ?></p>
                                </div>
                                <div class="cart_subtotal ">
                                    <p>Shipping</p>
                                    <p class="cart_amount">Flat Rate: Rs. <?php echo number_format($shipping_ammount['shipping'], 2); ?></p>
                                </div>
                                <a href="javascript:void(0)">Cash on Delivery</a>

                                <div class="cart_subtotal">
                                    <p>Total</p>
                                    <?php $net_total = $total + $shipping_ammount['shipping'];?>
                                    <p class="cart_amount">Rs. <?php echo number_format($net_total, 2); ?></p>
                                </div>
                                <div class="checkout_btn">
                                    <a href="checkout.php">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Coupon Start -->
<?php } ?>

    </div> <!-- ...:::: End Cart Section:::... -->

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
