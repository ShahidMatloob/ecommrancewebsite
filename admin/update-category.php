<?php
$title = "Update Category";
$category_id = $_GET['category'];

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

    <?php 

        $categoryQuery = mysqli_query($connection,"SELECT * FROM `category` WHERE `id` = '$category_id' ");
        $category = mysqli_fetch_assoc($categoryQuery);

    ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="" enctype="multipart/form-data" method="POST">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <label class="m-t-15">Category Name</label>
                                            <input type="text" class="form-control" value="<?php echo $category['category']; ?>" name="category_name" placeholder="-" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="col-md-12 m-t-15">Dropdown (want to make Dropdown)</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="is_dropdown">
                                                <option value="<?php echo $category['is_dropdown']; ?>"  Style="display:none"><?php echo $category['is_dropdown']; ?></option>
                                                <option value="yes">yes</option>
                                                <option value="no">no</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="col-md-12 m-t-15">Menu (want to Show in Menu)</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="in_menu" required>
                                                <option value="<?php echo $category['in_menu']; ?>" Style="display:none"><?php echo $category['in_menu']; ?></option>
                                                <option value="yes">yes</option>
                                                <option value="no">no</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="col-md-12 m-t-15">Featured (want to make Feature Category)</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="is_featured" required>
                                                <option value="<?php echo $category['is_featured']; ?>" Style="display:none"><?php echo $category['is_featured']; ?></option>
                                                <option value="yes">yes</option>
                                                <option value="no">no</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="m-t-15">Category Image <span style="color:red; font-size: 12px;">Image should be <strong>370 x 250</strong>. Image should <strong>png / jpg</strong> and less than <strong>1MB</strong></span></label>
                                            <input type="file" class="form-control" name="category_image" >
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="submit" name="category" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

<?php 
$image = $category['category_image'];
if (isset($_POST['category'])) {
    
    $category = $_POST['category_name'];
    $dropdown = $_POST['is_dropdown'];
    $menu = $_POST['in_menu'];
    $feature = $_POST['is_featured'];

    if(isset($_FILES['category_image']) && !empty($_FILES['category_image']['name'])){
        // Get Image Dimension
        $fileinfo = @getimagesize($_FILES["category_image"]["tmp_name"]);
        $width = $fileinfo[0];
        $height = $fileinfo[1];

        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );

        // Get image file extension
        $file_extension = pathinfo($_FILES["category_image"]["name"], PATHINFO_EXTENSION);

    }


    if($_FILES['category_image']['name'] == ''){
        $category_image = $image;
    }else if (! in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            "type" => "error",
            "message" => "Upload valid images. Only PNG and JPEG are allowed."
        );
        echo $result;
    }    // Validate image file size
    else if ($_FILES["category_image"]["size"] > 1000000) {
        $response = array(
            "type" => "error",
            "message" => "Image size should be Less than 1MB"
        );
    }    // Validate image file dimension
    else if ($width >= 375 || $height >= 255) {
        $response = array(
            "type" => "error",
            "message" => "Image dimension should be within 370 X 250"
        );
    } else {
        $folder = "../assets/images/categories_images/";
        $category_image = date("dmYhi")."-".$_FILES['category_image']['name'];
        $path = $folder.$category_image;
        move_uploaded_file($_FILES['category_image']['tmp_name'] , $path);
    }

    if(empty($response)){
        $query = "UPDATE `category` SET `category`='$category',`is_dropdown`='$dropdown',`is_featured`='$feature',`in_menu`='$menu',`category_image`='$category_image' WHERE `id` = $category_id";
        $run = mysqli_query($connection,$query);
        if ($run) {
            $_SESSION['category_message'] = "Category Updated Successfully.";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=category.php">';
        }
    }

}

?>



<?php if(!empty($response)) { ?>
    <div style="font-size:35px; color:red; font-weight:800;">
        <?php echo "ERROR: " . $response["message"]; ?>
    </div>
<?php }?>

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
