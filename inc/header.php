<?php
include 'inc/config.php';
if (isset($_SESSION['UserID'])) {
    $id = $_SESSION['UserID'];
    $userQuery = mysqli_query($connection, "SELECT * FROM `user` WHERE `UserID` = $id");
    $userData = mysqli_fetch_assoc($userQuery);
    $wishTotalQuery = mysqli_query($connection,"SELECT count(*) AS wish_total FROM `wishlist` WHERE `user_id` = '" . $_SESSION['UserID'] . "'");
    $wishcount = mysqli_fetch_assoc($wishTotalQuery);

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title . " - " . "Sass Collection"; ?></title>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/plaza-icon.css">
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="assets/css/plugins/slick.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/venobox.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <!-- ...:::: Start Header Section:::... -->
    <header class="header-section d-lg-block d-none">
        <!-- Start Header Top Area -->
        <div class="header-top">
            <div class="container">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-6">
                        <div class="header-top--left">
                            <span>Welcome to our store!</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="header-top--right">
                            <!-- Start Header Top Menu -->
                            <ul class="header-user-menu">
                                <li><a href="wishlist.php" ><i class="icon-heart"></i> Wishlist</a></li>
                                <li class="d-none"><a href="compare.php"><i class="icon-repeat"></i> Compare </a></li>
                                <?php
                                    if (isset($_SESSION['UserID'])) {
                                ?>
                                <li class="has-user-dropdown">
                                    <a href="my-account.php"><i class="icon-user"></i> <?php echo $userData['UserFullName'];?></a>
                                    <ul class="user-sub-menu">
                                        <li><a href="dashboard.php">My Account</a></li>
                                        <li><a href="cart.php">Shopping Cart</a></li>
                                        <li><a href="checkout.php">Checkout</a></li>
                                        <li><a href="req/logout.php">Logout</a></li>
                                    </ul>
                                </li>
                                <?php
                                    }else{
                                    ?>
                                <li><a href="my-account.php"><i class="icon-user"></i> Register / Login</a></li>
                                    <?php    
                                    }
                                ?>
                                
                            </ul> <!-- End Header Top Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Header Top Area -->

        <!-- Start Header Center Area -->
        <div class="header-center">
            <div class="container">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-3">
                        <!-- Logo Header -->
                        <div class="header-logo">
                            <a href="index.php"><img src="assets/images/logo/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <!-- Start Header Search -->
                        <div class="header-search">
                            <form action="search.php" method="post" id="search-form">
                                <div class="header-search-box default-search-style d-flex">
                                    <input class="default-search-style-input-box border-around" name="search" type="text" placeholder="Search entire store here ..." >
                                    <!--<button class="default-search-style-input-btn" type="submit" name="search_btn"><i class="icon-search"></i></button>-->

                                </div>
                            </form>
                        </div> <!-- End Header Search -->
                    </div>
                    <div class="col-3 text-right">
                        <!-- Start Header Action Icon -->
                        <ul class="header-action-icon">
                            <li>
                                <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="header-action-icon-item-count"><?php if(isset($_SESSION['cart'])){ echo count($_SESSION['cart']); }else{ unset($_SESSION['cart']); echo 0; }; ?></span>
                                </a>
                            </li>
                        </ul> <!-- End Header Action Icon -->
                    </div>
                </div>
            </div>
        </div> <!-- End Header Center Area -->

        <!-- Start Bottom Area -->
        <div class="header-bottom sticky-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Header Main Menu -->
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li>
                                        <a class="active main-menu-link" href="index.php">Home</a>
                                    </li>
                                    <?php 
                                    $menuQuery = mysqli_query($connection, "SELECT * FROM `category` WHERE `in_menu` = 'Yes' ");
                                    while($menu = mysqli_fetch_assoc($menuQuery)){ 
                                        if($menu['is_dropdown'] == 'yes'){
                                    ?>

                                    <li class="has-dropdown">
                                        <a href="shop.php?category_id=<?php echo $menu['id']; ?>&category_name=<?php echo $menu['category']; ?> "><?php echo $menu['category']; ?> <i class="fa fa-angle-down"></i></a>
                                        <!-- Sub Menu -->
                                        <ul class="sub-menu">
                                        <?php 
                                            $subMenuQuery = mysqli_query($connection, "SELECT * FROM `sub_category` WHERE `parent_id` = '" . $menu['id'] . "'");
                                            while($subMenu = mysqli_fetch_assoc($subMenuQuery)){
                                        ?>
                                            <li><a href="shop.php?sub_category_id=<?php echo $subMenu['id']; ?>&sub_category_name=<?php echo $subMenu['sub_category']; ?> "><?php echo $subMenu['sub_category']; ?></a></li>
                                        <?php } ?>
                                        </ul>
                                    </li>
                                    <?php 
                                        }else{
                                    ?>
                                    <li>
                                        <a href="shop.php?category_id=<?php echo $menu['id']; ?>&category_name=<?php echo $menu['category']; ?>" class="main-menu-link"><?php echo $menu['category']; ?></a>
                                    </li>
                                    
                                   <?php }} ?>
                                </ul>
                            </nav>
                        </div> <!-- Header Main Menu Start -->
                    </div>
                </div>
            </div>
        </div> <!-- End Bottom Area -->
    </header> <!-- ...:::: End Header Section:::... -->


        <!-- ...:::: Start Mobile Header Section:::... -->
    <div class="mobile-header-section d-block d-lg-none">
        <!-- Start Mobile Header Wrapper -->
        <div class="mobile-header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <div class="mobile-header--left">
                            <a href="index.php" class="mobile-logo-link">
                                <img src="assets/images/logo/logo.png" alt="" class="mobile-logo-img">
                            </a>
                        </div>

                        <div class="mobile-header--right">
                            <a href="#mobile-menu-offcanvas" class="mobile-menu offcanvas-toggle">
                                <span class="mobile-menu-dash"></span>
                                <span class="mobile-menu-dash"></span>
                                <span class="mobile-menu-dash"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-header-search">
            <div class="container">
                <div class="row " style="margin: 25px 0 -23px 0;">

                    <form action="search.php" method="post" id="m-search-form">
                        <div class="header-search-box default-search-style d-flex">
                            <input class="default-search-style-input-box border-around" name="search" type="text" placeholder="Search entire store here ..." >
                            <!--<button class="default-search-style-input-btn" type="submit" name="search_btn"><i class="icon-search"></i></button>-->
                        </div>
                    </form>

                </div>
            </div>
            </div>
        </div> <!-- End Mobile Header Wrapper -->
    </div> <!-- ...:::: Start Mobile Header Section:::... -->

    <!-- ...:::: Start Offcanvas Mobile Menu Section:::... -->
    <div id="mobile-menu-offcanvas" class="offcanvas offcanvas-leftside offcanvas-mobile-menu-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right border-bottom">
            <button class="offcanvas-close"><i class="fa fa-times"></i></button>
            <!-- Start Mobile Menu User Center -->
            <div class="mobile-menu-center float-left">
                <!-- Start Header Action Icon -->
                <ul class="mobile-action-icon">
                    <li class="mobile-action-icon-item d-none">
                        <a href="wishlist.html" class="mobile-action-icon-link">
                            <i class="icon-repeat"></i>
                            <span class="mobile-action-icon-item-count">0</span>
                        </a>
                    </li>
                    <li class="mobile-action-icon-item">
                        <a href="wishlist.php" class="mobile-action-icon-link">
                            <i class="icon-heart"></i>
                            <span class="mobile-action-icon-item-count"><?php if (!empty($wishcount['wish_total'])) { echo $wishcount['wish_total']; }else{ echo 0; }  ?></span>
                        </a>
                    </li>
                    <li class="mobile-action-icon-item">
                        <a href="cart.php" class="mobile-action-icon-link">
                            <i class="icon-shopping-cart"></i>
                            <span class="mobile-action-icon-item-count"><?php if(isset($_SESSION['cart'])){ echo count($_SESSION['cart']); }else{ unset($_SESSION['cart']); echo 0;}; ?></span>
                        </a>
                    </li>
                </ul> <!-- End Header Action Icon -->
            </div> <!-- End Mobile Menu User Center -->

        </div> <!-- End Offcanvas Header -->

        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-mobile-menu-wrapper">
            <!-- Start Mobile Menu Bottom -->
            <div class="mobile-menu-bottom">

                <div class="offcanvas-menu">
                    <ul>
                        <?php
                            if (isset($_SESSION['UserID'])) {
                        ?>
                        <li><a href="my-account.php"><i class="icon-user"></i> <?php echo $userData['UserFullName'];?></a></li>
                        <?php
                            }else{
                            ?>
                        <li><a href="my-account.php"><i class="icon-user"></i> Register / Login</a></li>
                            <?php    
                            }
                        ?>
                        <li>
                            <a class="active main-menu-link" href="index.php">Home</a>
                        </li>
                        <?php 
                            
                                $menuQuery = mysqli_query($connection, "SELECT * FROM `category` WHERE `in_menu` = 'Yes' ");
                                while($menu = mysqli_fetch_assoc($menuQuery)){ 
                                    if($menu['is_dropdown'] == 'yes'){
                        ?>

                        <li>
                            <a href="javascript:void(0)"><?php echo $menu['category']; ?></a>
                            <!-- Sub Menu -->
                            <ul class="mobile-sub-menu">
                            <?php 
                                $subMenuQuery = mysqli_query($connection, "SELECT * FROM `sub_category` WHERE `parent_id` = '" . $menu['id'] . "'");
                                while($subMenu = mysqli_fetch_assoc($subMenuQuery)){
                            ?>
                                <li><a href="shop.php?sub_category_id=<?php echo $subMenu['id']; ?>&sub_category_name=<?php echo $subMenu['sub_category']; ?> "><?php echo $subMenu['sub_category']; ?></a></li>
                            <?php } ?>
                            </ul>
                        </li>
                        <?php 
                        }else{
                        ?>
                        <li>
                            <a href="shop.php?category_id=<?php echo $menu['id']; ?>&category_name=<?php echo $menu['category']; ?>" class="main-menu-link"><?php echo $menu['category']; ?></a>
                        </li>
                        
                        <?php }} ?>
                    </ul>
                </div> <!-- Header Main Menu Start -->

            </div> <!-- End Mobile Menu Bottom -->
        </div> <!-- End Offcanvas Mobile Menu Wrapper -->
    </div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<?php include 'inc/canvas_cart.php'; ?>