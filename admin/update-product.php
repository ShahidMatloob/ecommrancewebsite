<?php 
$title = "Update Product";

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
}else{
    header('location:products.php');
}

?>        
        <!-- ============================================================== -->
        <!-- Header  -->
        <!-- ============================================================== -->

        <?php include 'inc/header.php';
            $productQuery = mysqli_query($connection,"SELECT * FROM `products` WHERE `id` = '$product_id'");
            $product = mysqli_fetch_assoc($productQuery);
        
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
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" enctype="multipart/form-data" method="POST">
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="m-t-15">Title</label>
                                            <input type="text" class="form-control" value="<?php echo $product['title'];?>" name="title" placeholder="Product Title..." required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="m-t-15">Description</label>
                                            <textarea type="text" rows="10" class="form-control" name="description" placeholder="Product Description..."><?php echo $product['description'];?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="m-t-15">Category</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="category" required>
                                                <option value="<?php if(!empty($product['category_id'])){
                                                    echo "category|".$product['category_id']."|".$product['category_name'];
                                                }else{
                                                    echo "subcategory|".$product['sub_category_id']."|".$product['category_name'];
                                                } ?>"
                                                
                                                 class="d-none">
                                                
                                                <?php echo $product['category_name'];?>
                                                
                                                
                                                </option>
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
                                            <input type="number" value="<?php echo $product['stock'];?>" name="stock" class="form-control" placeholder="-">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="m-t-15">Regular price</label>
                                            <input type="number" name="regular_price" value="<?php echo $product['regular_price'];?>" class="form-control" placeholder="-" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="m-t-15">Sale price</label>
                                            <input type="number" name="sale_price" value="<?php echo $product['sale_price'];?>" class="form-control" placeholder="-">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="m-t-15" >Image <span style="color:red; font-size: 12px;">Image should be <strong>432 x 432</strong>. Image should <strong>png / jpg</strong> and less than <strong>1MB</strong></span>  </label>
                                            <img src="../assets/images/products_images/<?php echo $product['image']; ?>" height="432px"/>
                                            <input type="file" name="image" class="form-control" >
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="m-t-15">Feature</label>
                                            <select class="form-control" style="width: 100%; height:36px;" name="is_featured">
                                                <option value="<?php echo $product['is_featured'];?>" class="d-none">
                                                <?php if($product['is_featured'] == 1) { echo "Yes"; }else{ echo "No"; } ?>
                                                
                                                </option>
                                                <option value="1" >Yes</option>
                                                <option value="0" >No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-12 ">
                                            <a href="products.php" class="btn btn-dark btn-lg float-left" type="submit" name="add_product">Back</a>
                                            <button class="btn btn-success btn-lg float-right" type="submit" name="update_product">Publish</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>




<?php
$product_img = $product['image'];
if (isset($_POST['update_product'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    
    
    $category_data = $_POST['category'];
    $category = explode('|', $category_data);
    $category_type = $category[0];
    if($category_type == 'category'){
        $category_id = $category[1];
        $sub_category_id = '';
    }else{
        $category_id = '';
        $sub_category_id = $category[1];
    }
    $category_name = $category[2];


    $stock = $_POST['stock'];
    $regular_price = $_POST['regular_price'];
    $sale_price = $_POST['sale_price'];
    $is_featured = $_POST['is_featured'];
    $created_at = date("d/m/Y h:i A") ;



    if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
        // Get Image Dimension
        $fileinfo = @getimagesize($_FILES["image"]["tmp_name"]);
        $width = $fileinfo[0];
        $height = $fileinfo[1];

        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );

        // Get image file extension
        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

    }


    if($_FILES['image']['name'] == ''){
        $image = $product_img;
    }else if (! in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            "type" => "error",
            "message" => "Upload valid images. Only PNG and JPEG are allowed."
        );
        echo $result;
    }    // Validate image file size
    else if ($_FILES["image"]["size"] > 1000000) {
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
        $folder = "../assets/images/products_images/";
        $image = date("dmYhi")."-".$_FILES['image']['name'];
        $path = $folder.$image;
        move_uploaded_file($_FILES['image']['tmp_name'] , $path);
    }

    if(empty($response)){
        $product_query = mysqli_query($connection,"UPDATE `products` SET `title`='$title',`description`='$description',`category_id`='$category_id',`sub_category_id`='$sub_category_id',`category_name`='$category_name',`image`='$image',`regular_price`='$regular_price',`sale_price`='$sale_price',`stock`='$stock',`is_featured`='$is_featured',`created_at`='$created_at' WHERE `id` = '$product_id' " ) ;
        if ($product_query) {
            $_SESSION['product_message'] = "Product Updated Successfully.";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=products.php">';
        } 
    }
}

?>

<?php  if(!empty($response)) { ?>
    <div style="font-size:35px; color:red; font-weight:800;">
        <?php echo "ERROR: " . $response["message"]; ?>
    </div>
<?php  }?>







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
