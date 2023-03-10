<?php 
ob_start();
session_start();
$title = "Dashboard";
if(empty($_SESSION['UserID']))
{
	header('location:my-account.php');	
}
?>

<!--header start -->

<?php
    include 'inc/header.php';
    $orderQuery = mysqli_query($connection,"SELECT * FROM `orders` WHERE `user_id` = '" . $_SESSION['UserID'] . "' ORDER BY `orders`.`id` DESC");
    $wishlistQuery = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE `user_id` = '" . $_SESSION['UserID'] . "' ORDER BY `wishlist`.`id` DESC");
 ?>

<!--header end -->

    <div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">My Account</h3>
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

    <!-- ...:::: Start Account Dashboard Section:::... -->
    <div class="account_dashboard">
        <div class="container">
            <div class="row">

            <?php
                if(isset($_SESSION['detail_msg'])){
                    ?>
                    <div class="alert alert-success text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <?php echo $_SESSION['detail_msg']; ?>
                    </div>
                    <?php
                    unset($_SESSION['detail_msg']);
                }

                if(isset($_SESSION['password_msg'])){
                    ?>
                    <div class="alert alert-success text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo $_SESSION['password_msg']; ?>
                    </div>
                    <?php
                    unset($_SESSION['password_msg']);
                }
            ?> 

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="#dashboard" data-toggle="tab" class="nav-link active">Dashboard</a></li>
                            <li> <a href="#orders" data-toggle="tab" class="nav-link">Orders</a></li>
                            <li> <a href="#wishlist" data-toggle="tab" class="nav-link">Wishlist</a></li>
                            <li><a href="#account-details" data-toggle="tab" class="nav-link">Account details</a></li>
                            <li><a href="req/logout.php" class="nav-link">logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade show active" id="dashboard">
                            <h4>Dashboard </h4>
                            <p>From your account dashboard. you can easily check &amp; view your <a href="javascript:void(0)">recent orders</a> and <a href="javascript:void(0)" >Edit your password and account details.</a></p>
                        </div>
                        
                        <div class="tab-pane fade" id="orders">
                            <?php  if (mysqli_num_rows($orderQuery) > 0) { ?>
                            <h4>Orders</h4>
                            <div class="table_page table-responsive " style="overflow-x: auto;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Tracking Number</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while( $orders = mysqli_fetch_assoc($orderQuery)){ ?>
                                        <tr>
                                            <td><?php echo $orders['order_date']; ?></td>
                                            <td><span class="success"><?php echo $orders['order_status']; ?></span></td>
                                            <td><span class="success"><?php echo $orders['order_ammount'] . " + " . $orders['shipping_cost']; ?> </td>
                                            <td><span class="success"><?php echo $orders['tracking_number']; ?> </td>
                                            <td><a href="view-order.php?order_id=<?php echo $orders['id']; ?>" class="view">view</a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } else { ?>
                                <div class="text-center"><h3>No Order is Placed yet.</h3></div>
                            <?php } ?>
                        </div>

                        <div class="tab-pane fade" id="wishlist">
                            <?php  if (mysqli_num_rows($wishlistQuery) > 0) { ?>
                            <h4>Wishlist</h4>
                            <div class="table_page table-responsive " style="overflow-x: auto;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Wish Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        while( $wish = mysqli_fetch_assoc($wishlistQuery)){ 
                                        $product_in_wish_query = mysqli_query($connection,"SELECT * FROM `products` WHERE `id` = '" . $wish['product_id'] . "' ");
                                        $product_in_wish = mysqli_fetch_assoc($product_in_wish_query);
                                    ?>
                                        <tr>
                                            <td><a href="product.php?product_id=<?php echo $product_in_wish['id']; ?>&product_title=<?php echo $product_in_wish['title']; ?>"><?php echo $product_in_wish['title']; ?></a></td>
                                            <?php 
                                                if($product_in_wish['sale_price'] == 0 AND empty($product_in_wish['sale_price'])) {
                                                    $price = $product_in_wish['regular_price'];
                                                }else{
                                                    $price = $product_in_wish['sale_price'];
                                                }

                                            ?>
                                            <td><span class="success">Rs. <?php echo $price; ?></span></td>
                                            <td><span class="success"><?php echo $wish['created_at']; ?> </td>
                                            <td><a href="req/remove_wish.php?wish_product_id=<?php echo $product_in_wish['id']; ?>" class="btn btn-sm btn-danger">Remove</a> <a href="req/add_to_cart.php?wish_product_id=<?php echo $product_in_wish['id']; ?>" class="btn btn-sm btn-success">Add to Cart</a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } else { ?>
                                <div class="text-center"><h3>No item in Wishlist.</h3></div>
                            <?php } ?>
                        </div>


                        <div class="tab-pane fade" id="account-details">
                            <h3>Account details </h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                        <form action="req/save_account_details.php" method="POST">
                                            <div class="default-form-box mb-20">
                                                <label>Full Name</label>
                                                <input type="text" value="<?php echo $userData['UserFullName']; ?>" name="fullName">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Email <span style="font-size: 11px;">login with this email</span></label>
                                                <input type="email" value="<?php echo $userData['UserEmail']; ?>" name="email">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Mobile</label>
                                                <input type="number" value="<?php echo $userData['UserMobile']; ?>" name="mobile">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Address</label>
                                                <input type="text" value="<?php echo $userData['UserAddress']; ?>" name="address">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>City</label>
                                                <input type="text" value="<?php echo $userData['UserCity']; ?>" name="city">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>State / Province</label>
                                                <input type="text" value="<?php echo $userData['UserState']; ?>" name="state">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Country <span style="font-size: 11px;">you can not edit this</span></label>
                                                <input type="text" value="<?php if (empty($userData['UserCountry'])) { echo "Pakistan"; }else{ echo $userData['UserCountry']; } ?>" name="country" readonly>
                                            </div>
                                            <div class="save_button primary_btn default_button ">
                                                <button type="submit" name="detail">Save Details</button>
                                            </div>
                                        </form>
                                        
                                        <form action="req/save_account_details.php" method="POST">

                                            <div class="default-form-box mt-20 mb-20">
                                                <label>Password <span style="font-size: 11px;">you can not edit this</span></label>
                                                <input type="text" value="<?php echo $userData['UserPassword']; ?>" name="password" readonly>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>New Password</label>
                                                <input type="text" name="new_password">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Confirm New Password</label>
                                                <input type="text" name="confirm_new_password" >
                                            </div>
                                            <div class="save_button primary_btn default_button">
                                                <button type="submit" name="password">Update Password</button>
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Account Dashboard Section:::... -->

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
