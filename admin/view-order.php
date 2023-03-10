<?php
$title = "All Orders";
if(!isset($_GET['order_id'])){
    header('location:order.php');
    exit;
}else{
    $order_id = $_GET['order_id'];
    
}

?>
       
        <!-- ============================================================== -->
        <!-- Header  -->
        <!-- ============================================================== -->

        <?php 
            include 'inc/header.php' ;

            $orderQuery = mysqli_query($connection,"SELECT * FROM `orders` WHERE `id` = '$order_id'");
            $order = mysqli_fetch_assoc($orderQuery);
            if($order_id != $order['id']){
                header('location:my-account.php');
            }
            $product_ids = $order['products_id'];
            $product_qtys = explode(",",$order['products_qty']);
            $product_qty_array = array();
            foreach($product_qtys as $qtys){
                array_push($product_qty_array,$qtys);
            }
                
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
                        <h4 class="page-title"><?php echo $title ?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                        <?php 
                            if(isset($_SESSION['a_product_message'])){
                                ?>
                                <div class="alert alert-success text-center">
                                    <?php echo $_SESSION['a_product_message']; ?>
                                </div>
                                <?php
                                unset($_SESSION['a_product_message']);
                            }
                        ?>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $total = 0;
                                            $orderProductQuery = mysqli_query($connection,"SELECT * FROM `products` WHERE `id` IN (".$product_ids.") ORDER BY FIELD(id,$product_ids)");
                                            $qty_index = 0;
                                            while($orderProduct = mysqli_fetch_assoc($orderProductQuery)){
                                        ?>
                                            <tr>
                                                <td><?php echo $orderProduct['id']; ?></td>
                                                <td><?php echo $orderProduct['title']; ?></td>
                                                <td><img src="../assets/images/products_images/<?php echo $orderProduct['image']; ?>" style="height:80px;" ></td>
                                                <td><?php echo $orderProduct['category_name']; ?></td>
                                            <?php 
                                                if($orderProduct['sale_price'] == 0 AND empty($orderProduct['sale_price'])) {
                                                    $price = $orderProduct['regular_price'];
                                                }else{
                                                    $price = $orderProduct['sale_price'];
                                                }
                                            ?>

                                                <td>
                                                    <?php if($orderProduct['sale_price'] == 0 AND empty($orderProduct['sale_price'])) {?>
                                                        <span class="price"> <?php echo "Rs ".$orderProduct['regular_price']; ?></span>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <span class="price"><del><?php echo "Rs ".$orderProduct['regular_price']; ?></del> <?php echo "Rs. ".$orderProduct['sale_price']; ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $product_qty_array[$qty_index]; ?></td>
                                                <td>Rs. <?php echo number_format($price*$product_qty_array[$qty_index]); ?></td>
                                                <?php $total += $product_qty_array[$qty_index]*$price; ?>
                                            </tr>
                                            <?php $qty_index++; } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Action</th>
                                                <th colspan="2">
                                                    <a href="req/cancel_order.php?order_id=<?php echo $order['id']; ?>" class="btn btn-dark">Cancel Order</a>
                                                    <a href="req/process_order.php?order_id=<?php echo $order['id']; ?>" class="btn btn-primary">Processing Order</a>
                                                    <a href="req/complete_order.php?order_id=<?php echo $order['id']; ?>" class="btn btn-success">Complete Order</a>
                                                    (Press a button to update Order Status)
                                                </th>
                                                <th>Order Status</th>
                                                <th><?php echo $order['order_status'] ?></th>
                                                <th>Total</th>
                                                <td>Rs. <?php echo number_format($total); ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
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
