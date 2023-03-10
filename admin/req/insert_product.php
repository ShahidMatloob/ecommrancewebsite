<?php
include '../inc/config.php';
if (isset($_POST['add_product'])){

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


    // Validate file input to check if is with valid extension
    if (! in_array($file_extension, $allowed_image_extension)) {
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
    else if ($width >= 435 || $height >= 435) {
        $response = array(
            "type" => "error",
            "message" => "Image dimension should be within 432 X 432"
        );
    } else {
        $folder = "../../assets/images/products_images/";
        $image = date("dmYhi")."-".$_FILES['image']['name'];
        $path = $folder.$image;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $path)) {


        $product_query = mysqli_query($connection,"INSERT INTO `products`(`title`, `description`, `category_id`, `sub_category_id`, `category_name`, `image`, `regular_price`, `sale_price`, `stock`, `is_featured`, `created_at`) 
                                                                VALUES ('$title','$description','$category_id','$sub_category_id','$category_name','$image','$regular_price','$sale_price','$stock','$is_featured','$created_at')" ) ;
            if ($product_query) {
                $_SESSION['product_message'] = "Product Published Successfully.";
                header('location:../products.php');
            }

        } 
    }
}

?>

<?php if(!empty($response)) { ?>
    <div style="font-size:35px; color:red; font-weight:800;">
        <?php echo "ERROR: " . $response["message"]; ?>
    </div>
<?php }?>
