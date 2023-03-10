<?php 

$title = "Dashboard";




?>
        <!-- ============================================================== -->
        <!-- Header  -->
        <!-- ============================================================== -->

        <?php 
            include 'inc/header.php';
            $ordersQuery = mysqli_query($connection,"SELECT * FROM `orders` WHERE `order_status` = 'Pending' ORDER BY `orders`.`id` DESC LIMIT 6");
            $ordersTotalQuery = mysqli_query($connection,"SELECT count(*) AS orders_total FROM `orders` WHERE `order_status` = 'Pending'");
            $ordersCount = mysqli_fetch_assoc($ordersTotalQuery);
            $productsQuery = mysqli_query($connection,"SELECT * FROM `products` ORDER BY `products`.`id` DESC LIMIT 3");
            $productsTotalQuery = mysqli_query($connection,"SELECT count(*) AS products_total FROM `products`");
            $productsCount = mysqli_fetch_assoc($productsTotalQuery);
            $userTotalQuery = mysqli_query($connection,"SELECT count(*) AS users_total FROM `user`");
            $userCount = mysqli_fetch_assoc($userTotalQuery);
        ?>  

        <!-- ============================================================== -->
        <!-- End Header  -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- Sidebar  -->
        <!-- ============================================================== -->
        <?php include 'inc/sidebar.php'; ?>
        <!-- ============================================================== -->
        <!-- End Sidebar  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"><?php echo $title; ?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-cart"></i></h1>
                                <h6 class="text-white"><?php echo $ordersCount['orders_total']; ?> Orders</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-dark text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-basket"></i></h1>
                                <h6 class="text-white"><?php echo $productsCount['products_total']; ?> Products</h6>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-currency-usd"></i></h1>
                                <h6 class="text-white">0 Earning</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-account"></i></h1>
                                <h6 class="text-white"><?php echo $userCount['users_total']; ?> Customers</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Latest Orders</h5>
                                <div class="table-responsive">
                                    <table  class="table table-collapse">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($order = mysqli_fetch_assoc($ordersQuery)) { ?>
                                            <tr>
                                                <td><?php echo $order['id']; ?></td>
                                                <td><?php echo $order['order_ammount']; ?> Rs</td>
                                                <td><?php echo $order['order_status']; ?></td>
                                                <td><?php echo $order['order_date']; ?></td>
                                                <td><a href="view-order.php?order_id=<?php echo $order['id']; ?>" class="btn btn-outline-cyan ">View</a></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body text-right">
                                    <a href="order.php" class="btn btn-outline-dark ">View All</a>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- column -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Latest Products</h4>

                                <div class="comment-widgets scrollable">
                                    <?php while($product = mysqli_fetch_assoc($productsQuery)) { ?>
                                    <!-- Comment Row -->
                                    <div class="d-flex flex-row comment-row border-top">
                                        <div class="p-2"><img src="../assets/images/products_images/<?php echo $product['image']; ?>" alt="user" width="50" ></div>
                                        <div class="comment-text active w-100">
                                            <h6 class="font-medium"><?php echo $product['title']; ?></h6>
                                            <span class="m-b-15 d-block"><?php echo $product['description']; ?></span>
                                            <div class="comment-footer">
                                                <span class="text-muted float-right"><?php echo $product['created_at']; ?></span> 
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <a href="products.php" class="btn btn-outline-dark ">View All</a>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include 'inc/footer.php' ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
