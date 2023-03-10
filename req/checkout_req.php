<?php 
ob_start();
session_start();
include '../inc/config.php';

if(!isset($_SESSION['UserID'])){
    
    $_SESSION['no_login'] = "Please <a href='my-account.php' ><b>Login or Create an Account</b></a> to Place Order.";
    header('location:../checkout.php');

}else{

    $user_id = $_SESSION['UserID'] ;
    $user_name = $_POST['fullName']  ; 
    $country = $_POST['country']  ;
    $address = $_POST['address']  ;
    $city = $_POST['city']  ;
    $state = $_POST['state']  ;
    $phone = $_POST['phone']  ;
    $email = $_POST['email']  ;
    $shipping_method = $_POST['cod']  ;
    $order_note = $_POST['order_note'] ;
    $shipping_cost = $shipping_ammount['shipping'] ;
    $order_date = date("d/m/Y h:i A") ;
    $tracking_number = date("ymhis"); ;


    $product_id_array = array();
    $product_qty_array = array();
    foreach($_SESSION['cart'] as $key => $value){
        array_push($product_id_array, $value['product_id']);
        array_push($product_qty_array, $value['product_qty']);
    }
    $products_id =  implode(',', $product_id_array) ;
    $products_qty =  implode(',', $product_qty_array) ;

    //initialize total
    $order_ammount = 0;
    if(!empty($_SESSION['cart'])){
    //create array of initail qty which is 1
    $product_in_cart_query = mysqli_query($connection,
                            "SELECT * FROM `products` WHERE `id` IN (".$products_id.") ORDER BY FIELD(id,$products_id)");
    $qty_index = 0;
    while($product_in_cart = mysqli_fetch_assoc($product_in_cart_query)){
            if (isset($product_in_cart['sale_price']) && $product_in_cart['sale_price'] != 0) {
                $price = $product_in_cart['sale_price'] ;
            }else{
                $price = $product_in_cart['regular_price'] ;
            }
                $order_ammount += $product_qty_array[$qty_index]*$price;
                $qty_index++;
        }
    }






    $query = mysqli_query($connection,
               "INSERT INTO `orders`(`user_id`, `products_id`, `products_qty`, `user_name`, `address`, `city`, `state`, `country`, `phone`, `email`, `shipping_cost`, `shipping_method`, `order_ammount`, `order_note`, `tracking_number`, `order_date`, `order_status`) 
                             VALUES('$user_id','$products_id','$products_qty','$user_name','$address','$city','$state','$country','$phone','$email','$shipping_cost','$shipping_method','$order_ammount','$order_note','$tracking_number','$order_date','Pending')" );

    if($query){
        
        unset($_SESSION['cart']);
        
        
        $to = $email;
        
        // Subject
        $subject = 'Order #' .$tracking_number . ' confirmed' ;
        
        // Message
        $message = '


            <!DOCTYPE html>
            <html>
            
            <head>
                <title></title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <style type="text/css">
                    body,
                    table,
                    td,
                    a {
                        -webkit-text-size-adjust: 100%;
                        -ms-text-size-adjust: 100%;
                    }
            
                    table,
                    td {
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                    }
            
                    img {
                        -ms-interpolation-mode: bicubic;
                    }
            
                    img {
                        border: 0;
                        height: auto;
                        line-height: 100%;
                        outline: none;
                        text-decoration: none;
                    }
            
                    table {
                        border-collapse: collapse !important;
                    }
            
                    body {
                        height: 100% !important;
                        margin: 0 !important;
                        padding: 0 !important;
                        width: 100% !important;
                    }
            
                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                    }
            
                    @media screen and (max-width: 480px) {
                        .mobile-hide {
                            display: none !important;
                        }
            
                        .mobile-center {
                            text-align: center !important;
                        }
                    }
            
                    div[style*="margin: 16px 0;"] {
                        margin: 0 !important;
                    }
                </style>
            
            <body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" >
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                <tr>
                                    <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#282828">
                                        <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                                          <h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 30px; font-weight: 800; line-height: 48px;" class="mobile-center">Sass Online Store</h1>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                            <tr>
                                                <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> Dear ' . $user_name . ', </p>
                                                    <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Thank You For Your Order! </h2>
                                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> We have received your order and we will process it soon. </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="padding-top: 20px;">
                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tr>
                                                            <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> Order Tracking # </td>
                                                            <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> ' . $tracking_number . ' </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style=" padding: 35px; background-color: #ff7361;">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                            <tr>
                                                <td align="center" style="padding: 25px 0 15px 0;">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td align="center" style="border-radius: 5px;"> <a href="https://yechezz.com/sass/track-order.php" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #282828;margin-right:5px; padding: 15px 30px; display: block;">Track Order</a> </td>
                                                            <td align="center" style="border-radius: 5px;"> <a href="https://yechezz.com/sass" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #282828; padding: 15px 30px; display: block;">Shop Again</a> </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            
            </html>


        ';
        
        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        
        // Additional headers
        $headers[] = 'From: Sass Online Store <anyemail@example.com>';
        
        
        // Mail it
        mail($to, $subject, $message, implode("\r\n", $headers));

        
        
        
        $_SESSION['thanks'] = "Order Placed";
        header('location:../thanks.php?status=order_placed');
    }                           

}



