<?php 
$title = "Add New Product";



?>        
        <!-- ============================================================== -->
        <!-- Header  -->
        <!-- ============================================================== -->

        <?php include 'inc/header.php' ?>  

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
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="req/insert_product.php" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="m-t-15">Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="Product Title..." required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="m-t-15">Description</label>
                                            <textarea type="text" rows="10" class="form-control" name="description" placeholder="Product Description..."></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="m-t-15">Category</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="category" required>
                                                <option value="" class="d-none">--select--</option>
                                                <?php 
                                                    $categoryQuery = mysqli_query($connection,"SELECT * FROM `category` ORDER BY `id` ASC");
                                                    while($category = mysqli_fetch_assoc($categoryQuery)) { 
                                                        $category_id = $category['id'];
                                                ?>

                                                    <option value="<?php echo "category" . "|" . $category['id'] . "|" . $category['category']; ?>" style="font-weight:700;"><?php echo $category['category']; ?></option>
                                                <?php 
                                                    $subCategoryQuery = mysqli_query($connection,"SELECT * FROM `sub_category` WHERE `parent_id` = '$category_id' ORDER BY `id` ASC");
                                                    while($subCategory = mysqli_fetch_assoc($subCategoryQuery)) { 
                                                ?>

                                                    <option value="<?php echo "subcategory" . "|" .$subCategory['id'] . "|" . $subCategory['sub_category']; ?>">--<?php echo $subCategory['sub_category']; ?></option>

                                                <?php } ?>    
                                                
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="m-t-15">Stock</label>
                                            <input type="number" name="stock" class="form-control" placeholder="-">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="m-t-15">Regular price</label>
                                            <input type="number" name="regular_price" class="form-control" placeholder="-" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="m-t-15">Sale price</label>
                                            <input type="number" name="sale_price" class="form-control" placeholder="-">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="m-t-15" >Image <span style="color:red; font-size: 12px;">Image should be <strong>432 x 432</strong>. Image should <strong>png / jpg</strong> and less than <strong>1MB</strong></span>  </label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="m-t-15">Feature</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="is_featured">
                                                <option value="" class="d-none">--select--</option>
                                                <option value="1" >Yes</option>
                                                <option value="0" >No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-12 ">
                                            <button class="btn btn-success btn-lg float-right" type="submit" name="add_product">Publish</button>
                                        </div>
                                    </div>
                                </form>
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
