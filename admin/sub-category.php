<?php
$title = "Sub Category";



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
                        <h4 class="page-title"><?php echo $title ?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="deashboard.php">Home</a></li>
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
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

    

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="req/insert_sub_category.php" method="POST">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="m-t-15">Sub Category Name</label>
                                            <input type="text" class="form-control" name="sub_category" placeholder="-" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="col-md-12 m-t-15">Parent Category</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="parent_id" required>
                                                <option value="" Style="display:none">-</option>
                                            <?php 
                                                $categoryQuery = mysqli_query($connection,"SELECT * FROM `category` ORDER BY `id` ASC");
                                                while($category = mysqli_fetch_assoc($categoryQuery)) { 
                                            ?>
                                                <option value="<?php echo $category['id']; ?>"><?php echo $category['category']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="submit" name="subcategory" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">All <?php echo $title; ?></h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Parent ID</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $subCategoryQuery = mysqli_query($connection,"SELECT * FROM `sub_category` ORDER BY `id` ASC");
                                                while($subCategory = mysqli_fetch_assoc($subCategoryQuery)) { 
                                            ?>
                                            <tr>
                                                <td><?php echo  $subCategory['id'] ?></td>
                                                <td><?php echo  $subCategory['sub_category'] ?></td>
                                                <td><?php echo  $subCategory['parent_id'] ?></td>
                                                <td> <a href="req/delete_suub_category.php?sub_category=<?php echo $subCategory['id']; ?>" class="btn btn-sm btn-danger">Delete</a></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
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
