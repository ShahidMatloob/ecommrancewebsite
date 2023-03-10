<?php
include '../inc/config.php';
if (isset($_POST['category'])) {
    
    $category = $_POST['category_name'];
    $dropdown = $_POST['is_dropdown'];
    $menu = $_POST['in_menu'];
    $feature = $_POST['is_featured'];


    //if ($_FILES['category_image']['name'] != '') {
      //  $folder = "../../assets/images/categories_images/";
      //  $category_image = $_FILES['category_image']['name'];
      //  $path = $folder.$category_image;
      //  move_uploaded_file($_FILES['category_image']['tmp_name'] , $path);
    //}else{
      //  $category_image = "category.png";
    //}

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




    if($_FILES['category_image']['name'] == ''){
        $category_image = "category.png";
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
        $folder = "../../assets/images/categories_images/";
        $category_image = date("dmYhi")."-".$_FILES['category_image']['name'];
        $path = $folder.$category_image;
        if (move_uploaded_file($_FILES['category_image']['tmp_name'] , $path)) {

            $query = "INSERT INTO `category`(`category`, `is_dropdown`, `is_featured`, `in_menu`, `category_image`) 
                                        VALUES ('$category','$dropdown','$feature','$menu','$category_image')";
            $run = mysqli_query($connection,$query);
            if ($run) {
                $_SESSION['category_message'] = "Category Created Successfully.";
                header('location:../category.php');
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
