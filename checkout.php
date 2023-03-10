<?php
ob_start();
session_start();
$title = "Checkout";
if(empty($_SESSION['cart'])){
    header('location:shop.php');    
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

    <!-- ...:::: Start Checkout Section:::... -->
    <div class="checkout_section">
        <div class="container">
            <div class="row">

            <?php 
                if(isset($_SESSION['no_login'])){
                    ?>
                    <div class="alert alert-warning text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo $_SESSION['no_login']; ?>
                    </div>
                    <?php
                    unset($_SESSION['no_login']);
                }

                if(isset($_SESSION['login_fail'])){
                    ?>
                    <div class="alert alert-danger text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo $_SESSION['login_fail']; ?>
                    </div>
                    <?php
                    unset($_SESSION['login_fail']);
                }

                if(isset($_SESSION['login_success'])){
                    ?>
                    <div class="alert alert-success text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <?php echo $_SESSION['login_success']; ?>
                    </div>
                    <?php
                    unset($_SESSION['login_success']);
                }
            ?>
                <!-- User Quick Action Form -->
                <div class="col-12">
                <?php  if (!isset($_SESSION['UserID'])) { ?>
                    <div class="user-actions accordion">
                        <h3>
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            Returning customer?
                            <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true">Click here to login</a>
                        </h3>
                        <div id="checkout_login" class="collapse" data-parent="#checkout_login">
                            <div class="checkout_info">
                                <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; section.</p>
                                <form action="req/checkout_login.php" method="post">
                                    <div class="form_group default-form-box">
                                        <label>Email <span>*</span></label>
                                        <input type="email" name="login_email" required >
                                    </div>
                                    <div class="form_group default-form-box">
                                        <label>Password <span>*</span></label>
                                        <input type="password" name="login_password" required>
                                    </div>
                                    <div class="form_group group_3 default-form-box">
                                        <button class="mb-20" type="submit" name="login">login</button>
                                        <label class="checkbox-default">
                                            <input type="checkbox">
                                            <span>Remember me</span>
                                        </label>
                                    </div>
                                    <a href="#" class="d-none">Lost your password?</a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- User Quick Action Form -->
            </div>
            <!-- Start User Details Checkout Form -->
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <form action="req/checkout_req.php" method="POST">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-lg-12 mb-20">
                                    <div class="default-form-box">
                                        <label>Full Name <span>*</span></label>
                                        <input type="text" name="fullName" value="<?php if(isset($_SESSION['UserID'])){ echo $userData['UserFullName']; } ?>" placeholder="-" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="default-form-box">
                                        <label>Address <span>*</span></label>
                                        <input name="address" type="text" value="<?php if(isset($_SESSION['UserID'])){ echo $userData['UserAddress']; } ?>" placeholder="-" required="required">
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="default-form-box">
                                        <label>City <span>*</span></label>
                                        <input type="text" name="city" value="<?php if(isset($_SESSION['UserID'])){ echo $userData['UserCity']; } ?>" placeholder="-" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="default-form-box">
                                        <label>State / Province<span>*</span></label>
                                        <input type="text" name="state" value="<?php if(isset($_SESSION['UserID'])){ echo $userData['UserState']; } ?>" placeholder="-" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="default-form-box">
                                        <label for="country">Country <span style="font-size: 11px;">you can not edit this</span></label>
                                        <input type="text" value="Pakistan" name="country" readonly required>

                                        <!--<select class="country_option nice-select wide" name="country" id="country">
                                            <option value="2">Bangladesh</option>
                                            <option value="3">Algeria</option>
                                            <option value="4">Afghanistan</option>
                                            <option value="5">Ghana</option>
                                            <option value="6">Albania</option>
                                            <option value="7">Bahrain</option>
                                            <option value="8">Colombia</option>
                                            <option value="9">Dominican Republic</option>
                                        </select>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label>Phone<span>*</span></label>
                                        <input type="number" name="phone" value="<?php if(isset($_SESSION['UserID'])){ echo $userData['UserMobile']; } ?>" placeholder="03001234567" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label> Email Address <span>*</span></label>
                                        <input type="email" name="email" value="<?php if(isset($_SESSION['UserID'])){ echo $userData['UserEmail']; } ?>" placeholder="example@example.com" required>
                                    </div>
                                </div>
                                <div class="col-12 mt-20">
                                    <div class="order-notes">
                                        <label for="order_note">Order Notes</label>
                                        <textarea id="order_note" name="order_note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                            <h3>Your order</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        //initialize total
                                        $total = 0;
                                        if(!empty($_SESSION['cart'])){
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

                                        <tr>
                                            <td> <?php echo $product_in_cart['title']; ?> <strong> × <?php echo $product_qty_array[$qty_index]; ?></strong></td>
                                            <td> Rs. <?php echo number_format($product_qty_array[$qty_index]*$price, 2); ?></td>
                                            <?php $total += $product_qty_array[$qty_index]*$price; ?>
                                        </tr>
                                        <?php $qty_index ++ ; }}?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Cart Subtotal</th>
                                            <td>Rs. <?php echo number_format($total, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td><strong>Rs. <?php echo number_format($shipping_ammount['shipping'], 2); ?></strong></td>
                                        </tr>
                                        <tr class="order_total">
                                            <th>Order Total</th>
                                            <?php $net_total = $total + $shipping_ammount['shipping'];?>
                                            <td><strong>Rs. <?php echo number_format($net_total, 2); ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment_method">
                                <div class="panel-default">
                                    <label class="checkbox-default" >
                                        <input type="checkbox" name="cod" value="Cash on Delivery" checked required>
                                        <span>Cash on Delivery</span>
                                    </label>

                                    <div class="card-body1">
                                        <p>You will Pay Cash on Delivery.</p>
                                    </div>
                                </div>
                                <div class="order_button pt-15">
                                    <button type="submit" name="place_order">Place Order</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- Start User Details Checkout Form -->
        </div>
    </div><!-- ...:::: End Checkout Section:::... -->

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
