<?php

$product_id_array = array();
$product_qty_array = array();

if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $key => $value){
        array_push($product_id_array, $value['product_id']);
        array_push($product_qty_array, $value['product_qty']);
    }
}else{
    unset($_SESSION['cart']);
}

$product_in_cart_id =  implode(',', $product_id_array);


?>

    <!-- ...:::: Start Offcanvas Addcart Section :::... -->
    <div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right border-bottom">
            <h4 class="offcanvas-title float-left">Your Cart</h4>
            <button class="offcanvas-close ">X</button>
        </div> <!-- End Offcanvas Header -->

        <!-- Start  Offcanvas Addcart Wrapper -->
        <div class="offcanvas-add-cart-wrapper">
            
            <ul class="offcanvas-cart">
            <?php
                //initialize total
                $total = 0;
                if(!empty($_SESSION['cart'])){
                //create array of initail qty which is 1
                $product_in_cart_query = mysqli_query($connection,
                                        "SELECT * FROM `products` WHERE `id` IN (".$product_in_cart_id.") ORDER BY FIELD(id,$product_in_cart_id)");
                $qty_index = 0;
                while($product_in_cart = mysqli_fetch_assoc($product_in_cart_query)){
                        if (isset($product_in_cart['sale_price']) && $product_in_cart['sale_price'] != 0) {
                            $price = $product_in_cart['sale_price'];
                        }else{
                            $price = $product_in_cart['regular_price'];
                        }
            ?>

                <li class="offcanvas-cart-item-single">
                    <div class="offcanvas-cart-item-block">
                        <a href="product.php?product_id=<?php echo $product_in_cart['id']; ?>" class="offcanvas-cart-item-image-link">
                            <img src="assets/images/products_images/<?php echo $product_in_cart['image']; ?>" alt="" class="offcanvas-cart-image">
                        </a>
                        <div class="offcanvas-cart-item-content">
                            <a href="product.php?product_id=<?php echo $product_in_cart['id']; ?>" class="offcanvas-cart-item-link"><?php echo $product_in_cart['title']; ?></a>
                            <div class="offcanvas-cart-item-details">
                                <span class="offcanvas-cart-item-details-quantity"><?php echo $product_qty_array[$qty_index]; ?> x </span>
                                <span class="offcanvas-cart-item-details-price">Rs. <?php echo number_format($price, 2); ?></span>
                                <?php $total += $product_qty_array[$qty_index]*$price; ?>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-cart-item-delete text-right" style="display:none">
                        <a href="req/delete_item.php?product_id=<?php echo $product_in_cart['id']; ?>&product_title=<?php echo $product_in_cart['title']; ?>" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
            <?php
                    $qty_index ++ ;
                        }
                    }else{
                        ?>
                            <div class="text-center"><img src="assets/images/empty-cart.svg" style="height:200px" alt=""></div>
                            <h3 colspan="6" class="text-lg-center " style="font-size: 25px; font-weight:500; padding:20px 0px;">Your cart is Empty</h3>
                        <?php
                    }
            ?>
            </ul>
            <?php if(!empty($_SESSION['cart'])){ ?>
            <div class="offcanvas-cart-total-price">
                <span class="offcanvas-cart-total-price-text">Subtotal:</span>
                <span class="offcanvas-cart-total-price-value">Rs. <?php  echo number_format($total, 2); ?></span>
            </div>
            <ul class="offcanvas-cart-action-button">
                <li class="offcanvas-cart-action-button-list"><a href="cart.php" class="offcanvas-cart-action-button-link">View Cart</a></li>
                <li class="offcanvas-cart-action-button-list"><a href="checkout.php" class="offcanvas-cart-action-button-link">Checkout</a></li>
            </ul>
            <?php } ?>
        </div> <!-- End  Offcanvas Addcart Wrapper -->

    </div> <!-- ...:::: End  Offcanvas Addcart Section :::... -->

