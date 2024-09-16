<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin Panel | eShop</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" type="image/png" href="resource/logo.png"/>
        
    </head>

    <body class="secondcolor" >

        <div class="container-fluid">
            <div class="row">
                <?php
include "header.php";
                ?>

                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="col-12 align-items-start  vh-70">
                            <div class="row g-1 text-center">

                                <div class="col-12 mt-5">
                                    <h4 class="text-white"><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h4>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                    <nav class="nav flex-column">
                                    <a class="nav-link bg-success text-dark fw-bold text-white fw-bold p-lg-4" href="index.php" aria-current="page" href="#">Home</a>
                                        <a class="nav-link active mt-2 p-lg-4" aria-current="page" href="#">Dashboard</a>
                                        <a class="nav-link bg-dark mt-2 text-white fw-bold p-lg-4" id="x" href="manageStudent.php"><i class="bi bi-people-fill me-2"></i>Manage Users</a>
                                        <a class="nav-link bg-dark mt-2 text-white fw-bold p-lg-4" href="manageTeacher.php"><i class="bi bi-book me-2"></i>Manage Teacher</a>
                                        <a class="nav-link bg-dark mt-2 text-white fw-bold p-lg-4" href="managecourse.php"><i class="bi bi-box-seam-fill me-2"></i>Manage Courses</a>
                                        <a class="nav-link bg-light mt-2 text-dark fw-bold p-lg-4" href="adminSellingHistory.php">Selling History</a>
                                    </nav>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-10">
                    <div class="row">

                        <div class="text-white fw-bold mb-1 mt-3">
                            <h2 class="fw-bold text-black">Dashboard</h2>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <div class="row g-1">

                                <div class="col-6 col-lg-4 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily Earnings</span>
                                            <br />
                                            <?php

                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $f = $f + $invoice_data["qty"]; //total qty

                                                $d = $invoice_data["date"];
                                                $splitDate = explode(" ", $d); //separate date from time
                                                $pdate = $splitDate[0]; //sold date

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }

                                                $splitMonth = explode("-", $pdate); //separate date as year,month & date
                                                $pyear = $splitMonth[0]; //year
                                                $pmonth = $splitMonth[1]; //month

                                                if ($pyear == $thisyear) {
                                                    if ($pmonth == $thismonth) {
                                                        $b = $b + $invoice_data["total"];
                                                        $e = $e + $invoice_data["qty"];
                                                    }
                                                }
                                            }

                                            ?>
                                            <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-warning text-black text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />

                                            <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $c; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $f; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagements</span>
                                            <br />
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `users`");
                                            $user_num = $user_rs->num_rows;
                                            ?>
                                            <span class="fs-5"><?php echo $user_num; ?> Members</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12 bg-dark">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center my-3">
                                    <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>
                                </div>
                                <div class="col-12 col-lg-10 text-center my-3">
                                    <?php
                                    
                                    $start_date = new DateTime("2022-09-27 00:00:00");

                                    $tdate = new DateTime();
                                    $tz = new DateTimeZone("Asia/Colombo");
                                    $tdate->setTimezone($tz);

                                    $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                    $difference = $end_date->diff($start_date);

                                    ?>
                                    <label class="form-label fs-4 fw-bold text-warning">
                                        <?php

                                        echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold ">Mostly Sold Course</label>
                                </div>
                                <?php

                                $freq_rs = Database::search("SELECT `course_course_id`,COUNT(`course_course_id`) AS `value_occurence` 
                                FROM `invoice` WHERE `date` LIKE '%" . $thismonth . "%' GROUP BY `course_course_id` ORDER BY 
                                `value_occurence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;
                                if ($freq_num > 0) {
                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `course` WHERE `course_id`='" . $freq_data["course_course_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    

                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                    `course_course_id`='" . $freq_data["course_course_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                    $qty_data = $qty_rs->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center shadow">
                                        <img src="<?php echo $product_data["image"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span><br />
                                        <span class="fs-6"><?php echo $qty_data["qty_total"]; ?> items</span><br />
                                        <span class="fs-6">Rs. <?php echo  $product_data["price"]; ?> .00</span>
                                    </div>
                                <?php

                                } else {
                                ?>
                                    <div class="col-12 text-center shadow">
                                        <img src="resource/empty.svg" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold">-----</span><br />
                                        <span class="fs-6">--- items</span><br />
                                        <span class="fs-6">Rs. ----- .00</span>
                                    </div>
                                <?php
                                }

                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
                            <div class="row g-1">
                                <?php
                                if ($freq_num > 0) {

                                    $profile_rs = Database::search("SELECT * FROM `teacher_has_course` INNER JOIN `teacher` ON `teacher`.`id`=`teacher_has_course`.`teacher_id` WHERE 
                                `course_course_id`='" . $product_data["course_id"] . "'");
                                    $profile_data = $profile_rs->fetch_assoc();

                                    

                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold ">Most Famouse Teacher</label>
                                    </div>
                                    <div class="col-12 text-center shadow">
                                        <img src="<?php echo $profile_data["timage"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $profile_data["first_name"]." ".$profile_data["last_name"]; ?></span><br />
                                        <span class="fs-6"><?php echo $profile_data["email"]; ?></span><br />
                                        <span class="fs-6"><?php echo $profile_data["mobile_no"]; ?></span>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold text-decoration-underline">Most Famouse Seller</label>
                                    </div>
                                    <div class="col-12 text-center shadow">
                                        <img src="resource/new_user.svg" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold">----- -----</span><br />
                                        <span class="fs-6">-----</span><br />
                                        <span class="fs-6">----------</span>
                                    </div>
                                <?php
                                }


                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php

} else {
    
    
    
}

?>