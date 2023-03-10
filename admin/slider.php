<?php
$title = "Slider";



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
                            <form action="" enctype="multipart/form-data" method="POST">
                                <div class="card-body">
                                    <div class="row mb-3">

                                        <div class="col-lg-6">
                                            <label class="m-t-15">Slider Image <span style="color:red; font-size: 12px;">Image should be <strong>1920 x 600</strong>. Image should <strong>png / jpg</strong> and less than <strong>1MB</strong></span>  </label>
                                            <input type="file" class="form-control " name="slider_image" required>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="submit" name="slider" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

<?php
if (isset($_POST['slider'])) {


    // Get Image Dimension
    $fileinfo = @getimagesize($_FILES["slider_image"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];

    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );

    // Get image file extension
    $file_extension = pathinfo($_FILES["slider_image"]["name"], PATHINFO_EXTENSION);

if (! in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            "type" => "error",
            "message" => "Upload valid images. Only PNG and JPEG are allowed."
        );
        echo $result;
    }    // Validate image file size
    else if (($_FILES["slider_image"]["size"] > 1000000)) {
        $response = array(
            "type" => "error",
            "message" => "Image size should be Less than 1MB"
        );
    }    // Validate image file dimension
    else if ($width <= 1925 || $height <= 605) {
        $response = array(
            "type" => "error",
            "message" => "Image dimension should be 1920 X 600"
        );
    } else {
        $folder = "../assets/images/slider_images/";
        $slider_image = date("dmYhi")."-".$_FILES['slider_image']['name'];
        $path = $folder.$slider_image;
        if (move_uploaded_file($_FILES['slider_image']['tmp_name'] , $path)) {

            $query = "INSERT INTO `slider`(`slider_image`) 
                                  VALUES ('$slider_image')";
            $run = mysqli_query($connection,$query);
            if ($run) {
                ?>
                <div style="font-size:35px; color:green; font-weight:800;">
                    <?php echo "Slider Updated Successfully"; ?>
                </div>
            <?php
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $slideryQuery = mysqli_query($connection,"SELECT * FROM `slider` ORDER BY `id` ASC");
                                                while($slider = mysqli_fetch_assoc($slideryQuery)) { 
                                            ?>
                                            <tr>
                                                <td><?php echo  $slider['id'] ?></td>
                                                <td> <img src="../assets/images/slider_images/<?php echo  $slider['slider_image'] ?>" style="height: 50px;"></td>
                                                <td> <a href="req/delete_slider.php?slider=<?php echo  $slider['id']  ?>" class="btn btn-sm btn-danger">Delete</a></td>
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
