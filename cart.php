<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | EWings</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/png" href="resource/logo.png"/>
   
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;


                Database::iud("UPDATE `cart` SET `status`='1' WHERE `user_email`='".$_SESSION["u"]["email"]."'");
            ?>

                <div class="col-12 pt-3" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 border border-1 border-primary rounded mb-3">
                    <div class="row">

                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder">Cart <i class="bi bi-cart4 fs-1 text-success"></i></label>
                        </div>

                        <div class="col-12 col-lg-6">
                            <hr />
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in Cart..." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <?php

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $email . "' AND `pay_status`='0'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {

                        ?>
                            <!-- Empty View -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptyCart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 fw-bold">
                                            You have no items in your Cart yet.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                        <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">
                                            Start Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty View -->
                        <?php

                        } else {
                        ?>

                            <!-- products -->
                            <div class="col-12 col-lg-9">
                                <div class="row">

                                    <?php

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `course` INNER JOIN `teacher_has_course` 
                                        ON `teacher_has_course`.`course_course_id`=`course`.`course_id` INNER JOIN `teacher` ON `teacher`.`id`=`teacher_has_course`.`teacher_id`
                                        WHERE  `course_id`='" . $cart_data["course_id"] . "'");
                                        $product_num = $product_rs->num_rows;
                                        $product_data = $product_rs->fetch_assoc();


                                        $total = $total + ($product_data["price"] );

                                      $teacher=$product_data["first_name"].$product_data["last_name"];

                                        


                                    ?>



                                        <div class="card mb-3 mx-0 col-12">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Teacher :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $teacher; ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-4">

                                                    
                                                        <img src="<?php echo $product_data["image"]; ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                    </span>

                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>

                                                       
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                                        <br>
                                                        
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">
                                                        <a class="btn btn-outline-success mb-2"  href='<?php echo "course-details.php?id=" . $product_data["course_id"]; ?>'>Buy Now</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs.
                                                                <?php echo ($product_data["price"] ) ; ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php

                                    }

                                    ?>




                                </div>
                            </div>
                            <!-- products -->

                            <!-- summary -->
                            <div class="col-12 col-lg-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                                    </div>

                                   

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold">Total</span>
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold">Rs. <?php echo ($shipping + $total); ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        
                                        <button onclick="checkout(<?php echo $total?>);" class="btn btn-warning col-12" id="btn1">Check Out</button>
                                    <div id="paypal-button-container"   class="col-12">
                                    </div>

                                </div>
                            </div>

                            <!-- summary -->

                        <?php
                        }

                        ?>





                    </div>
                </div>

            <?php

            } else {
                echo ("Please Sign In or Register");
            }

            include "footer.php";

            ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
    <script src="https://www.paypal.com/sdk/js?client-id=Aft56JMOWjrrD0Ao3Q-dBMi0T1BkwjjTK3bNYNeS2x_pX4IhHxqdZnGGglSf-UL7Wq3gBB8bT0UhpKgW"></script>
</body>

</html>