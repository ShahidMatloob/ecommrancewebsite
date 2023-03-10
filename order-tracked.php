<?php
ob_start();
session_start();
$title = "Order Tracked";

if(!isset($_GET['tracking_number'])){
    $_SESSION['track_msg'] = "Tracking Number is not Set."; 
    header('location:track-order.php');
}else{
    $tracking_number = $_GET['tracking_number'];
}

?>


<!--header start -->

<?php 
    include 'inc/header.php';
    $orderQuery = mysqli_query($connection,"SELECT * FROM `orders` WHERE `tracking_number` = '$tracking_number' ");
    $order = mysqli_fetch_assoc($orderQuery);
    if($tracking_number != $order['tracking_number']){
        $_SESSION['track_msg'] = "Tracking Number is Wrong."; 
        header('location:track-order.php');
    }
    $product_ids = $order['products_id'];
    $product_qtys = explode(",",$order['products_qty']);
    $product_qty_array = array();
    foreach($product_qtys as $qtys){
        array_push($product_qty_array,$qtys);
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

    <!-- ...:::: Start Cart Section:::... -->
    <div class="cart-section">
        <!-- Start Cart Table -->
        <div class="cart-table-wrapper">
            <div class="container">
                <div class="row">

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

                    ?>

                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive" style="overflow-x: auto;">
                                <table>
                                    <!-- Start Cart Table Head -->
                                    <thead>
                                        <tr>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Total</th>
                                        </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <tbody>
                                    <?php 
                                        $total = 0;
                                        $orderProductQuery = mysqli_query($connection,"SELECT * FROM `products` WHERE `id` IN (".$product_ids.") ORDER BY FIELD(id,$product_ids)");
                                        $qty_index = 0;
                                        while($orderProduct = mysqli_fetch_assoc($orderProductQuery)){
                                    ?>
                                        <!-- Start Cart Single Item-->
                                        <tr>
                                            <td class="product_thumb"><a href="product.php?product_id=<?php echo $orderProduct['id']; ?>&product_title=<?php echo $orderProduct['title']; ?>"><img src="assets/images/products_images/<?php echo $orderProduct['image']; ?>" alt="<?php echo $orderProduct['image']; ?>"></a></td>
                                            <td class="product_name"><a href="product.php?product_id=<?php echo $orderProduct['id']; ?>&product_title=<?php echo $orderProduct['title']; ?>"><?php echo $orderProduct['title']; ?></a></td>
                                            <?php 
                                                if($orderProduct['sale_price'] == 0 AND empty($orderProduct['sale_price'])) {
                                                    $price = $orderProduct['regular_price'];
                                                }else{
                                                    $price = $orderProduct['sale_price'];
                                                }
                                            ?>

                                            <td class="product-price">Rs. <?php echo number_format($price); ?></td>
                                            <td class="product_quantity"><?php echo $product_qty_array[$qty_index]; ?></td>
                                            <td class="product_total">Rs. <?php echo number_format($price*$product_qty_array[$qty_index]); ?></td>
                                            <?php $total += $product_qty_array[$qty_index]*$price; ?>
                                        </tr> <!-- End Cart Single Item-->
                                    <?php $qty_index++; } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <p style="display: inline-block; font-weight:700; margin: 0 25px;font-size:20px;  color: #fc7070;" >Status of Your Order</p>
                                <?php if($order['order_status'] == "Pending"){?>
                                    <span class="alert alert-dark" style="font-size:20px;">Your Order is Pending.</span>
                                <?php }elseif($order['order_status'] == "Processing"){ ?>
                                    <span class="alert alert-primary" style="font-size:20px;">Your Order is being Processed.</span>
                                <?php }elseif($order['order_status'] == "Canceled"){ ?>
                                    <span class="alert alert-secondary" style="font-size:20px;">Your Order is Canceled</span>
                                <?php }else{?>
                                    <span class="alert alert-success" style="font-size:20px;">Your Order is Completed.</span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->


        <!-- Start Coupon Start -->
        <div class="coupon_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 ml-auto">
                        <div class="coupon_code right">
                            <h3>Shipping Detail</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Name</p>
                                    <p class="cart_amount"> <?php echo $order['user_name']; ?></p>
                                </div>
                                <div class="cart_subtotal ">
                                    <p>Address</p>
                                    <p class="cart_amount"><?php echo $order['address'] . "<br > " . $order['city'] . "<br > " . $order['state'] . "<br > " . $order['country']; ?></p>
                                </div>
                                <div class="cart_subtotal ">
                                    <p>Email</p>
                                    <p class="cart_amount"><?php echo $order['email']; ?></p>
                                </div>
                                <div class="cart_subtotal ">
                                    <p>Contact</p>
                                    <p class="cart_amount"><?php echo $order['phone']; ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 ml-auto">
                        <div class="coupon_code right">
                            <h3>Order Totals</h3>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Coupon Start -->
    </div> <!-- ...:::: End Cart Section:::... -->

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
