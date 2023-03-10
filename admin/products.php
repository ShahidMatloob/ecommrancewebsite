<?php
$title = "All Products";

?>
       
        <!-- ============================================================== -->
        <!-- Header  -->
        <!-- ============================================================== -->

        <?php 
            include 'inc/header.php' ;

            $product_query = mysqli_query($connection, "SELECT * FROM `products` ORDER BY `id` DESC");
        
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
                    <div class="col-12">
                        <?php 
                            if(isset($_SESSION['product_message'])){
                                ?>
                                <div class="alert alert-success text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo $_SESSION['product_message']; ?>
                                </div>
                                <?php
                                unset($_SESSION['product_message']);
                            }
                        ?>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($product = mysqli_fetch_assoc($product_query)) { ?>
                                            <tr>
                                                <td><?php echo $product['id']; ?></td>
                                                <td><?php echo $product['title']; ?></td>
                                                <td><img src="../assets/images/products_images/<?php echo $product['image']; ?>" style="height:80px;" ></td>
                                                <td><?php echo $product['category_name']; ?></td>
                                                <td>
                                                    <?php if($product['sale_price'] == 0 AND empty($product['sale_price'])) {?>
                                                        <span class="price"> <?php echo "Rs ".$product['regular_price']; ?></span>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <span class="price"><del><?php echo "Rs ".$product['regular_price']; ?></del> <?php echo "Rs ".$product['sale_price']; ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $product['stock']; ?></td>
                                                <td><a href="update-product.php?product_id=<?php echo $product['id']; ?>" class="btn btn-primary">Edit</a> <a href="req/delete_product.php?product=<?php echo $product['id']; ?>" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Action</th>
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
