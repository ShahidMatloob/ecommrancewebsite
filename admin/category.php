<?php
$title = "Category";



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
                        <?php 
                            if(isset($_SESSION['category_message'])){
                                ?>
                                <div class="alert alert-success text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo $_SESSION['category_message']; ?>
                                </div>
                                <?php
                                unset($_SESSION['category_message']);
                            }
                        ?>

                        <div class="card">
                            <form action="req/insert_category.php" enctype="multipart/form-data" method="POST">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <label class="m-t-15">Category Name</label>
                                            <input type="text" class="form-control" name="category_name" placeholder="-" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="col-md-12 m-t-15">Dropdown (want to make Dropdown)</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="is_dropdown">
                                                <option value="" Style="display:none">-</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="col-md-12 m-t-15">Menu (want to Show in Menu)</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="in_menu" required>
                                                <option value="" Style="display:none">-</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="col-md-12 m-t-15">Featured (want to make Feature Category)</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="is_featured" required>
                                                <option value="" Style="display:none">-</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="m-t-15">Category Image <span style="color:red; font-size: 12px;">Image should be <strong>370 x 250</strong>. Image should <strong>png / jpg</strong> and less than <strong>1MB</strong></span>  </label>
                                            <input type="file" class="form-control " name="category_image" required>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="submit" name="category" class="btn btn-success">Submit</button>
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
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Dropdown</th>
                                                <th>Featured </th>
                                                <th>Menu</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $categoryQuery = mysqli_query($connection,"SELECT * FROM `category` ORDER BY `id` ASC");
                                                while($category = mysqli_fetch_assoc($categoryQuery)) { 
                                            ?>
                                            <tr>
                                                <td><?php echo  $category['id'] ?></td>
                                                <td> <img src="../assets/images/categories_images/<?php echo  $category['category_image'] ?>" style="height: 50px;"></td>
                                                <td><?php echo  $category['category'] ?></td>
                                                <td><?php echo  $category['is_dropdown'] ?></td>
                                                <td><?php echo  $category['is_featured'] ?></td>
                                                <td><?php echo  $category['in_menu'] ?></td>
                                                <td><a href="update-category.php?category=<?php echo  $category['id']; ?> " class="btn btn-sm btn-primary">Edit</a> <a href="req/delete_category.php?category=<?php echo  $category['id']  ?>" class="btn btn-sm btn-danger">Delete</a></td>
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
