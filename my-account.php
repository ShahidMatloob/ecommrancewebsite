<?php 
ob_start();
session_start();
$title = "My Account";

if(!empty($_SESSION['UserID']))
{
	header('location:dashboard.php');	
}
?>


<!--header start -->

<?php include 'inc/header.php' ?>

<!--header end -->


<div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Account</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active" aria-current="page">Register or Login</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Customer Login Section :::... -->
    <div class="customer_login">
        <div class="container">
            <div class="row">
                <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form">
                        <h3>login</h3>
                        <?php           
                            if(isset($_SESSION['login_message'])){
                                ?>
                                <div class="alert alert-danger text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo $_SESSION['login_message']; ?>
                                </div>
                                <?php
                                unset($_SESSION['login_message']);
                            }
                        ?>         
                        <form action="req/login.php" method="post">
                            <div class="default-form-box mb-20">
                                <label>Email <span>*</span></label>
                                <input type="email" name="login_email" required>
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Passwords <span>*</span></label>
                                <input type="password" name="login_password" required>
                            </div>
                            <div class="login_submit">
                                <button class="mb-20" type="submit" name="login">login</button>
                                <label class="checkbox-default mb-20" for="offer">
                                    <input type="checkbox" id="offer">
                                    <span>Remember me</span>
                                </label>
                                <a href="forget-password.php" class="d-none">Lost your password?</a>

                            </div>
                        </form>
                    </div>
                </div>
                <!--login area end-->

                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        <h3>Register</h3>
                        <?php           
                            if(isset($_SESSION['message'])){
                                ?>
                                <div class="alert alert-danger text-center">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                                <?php
                                unset($_SESSION['message']);
                            }
                        ?>         
                        <form action="req/register.php" method="post">
                            <div class="default-form-box mb-20">
                                <label>Full Name <span>*</span></label>
                                <input type="text" name="fullName" required>
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Email <span>*</span></label>
                                <input type="email" name="email" required>
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Passwords <span>*</span></label>
                                <input type="password" name="password" required>
                            </div>
                            <div class="login_submit">
                                <button type="submit" name="register">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div> <!-- ...:::: End Customer Login Section :::... -->

    <!--footer start -->

    <?php include 'inc/footer.php' ?>
    
    <!--footer end -->
