<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products | Admins | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" type="image/png" href="resource/logo.png"/>

</head>

<body class="navc" >

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <label class="form-label text-primary fw-bold fs-1">Manage Course</label>
            </div>

            

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 secondcolor py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 col-lg-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Product Image</span>
                    </div>
                    <div class="col-4 col-lg-2 secondcolor py-2">
                        <span class="fs-4 fw-bold text-white">Title</span>
                    </div>
                    <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Price</span>
                    </div>
                    <div class="col-2  d-none d-lg-block secondcolor py-2">
                        <span class="fs-4 fw-bold text-white">Teacher</span>
                    </div>

                    <div class="col-2 col-lg-1 bg-white"></div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php
                    require "connection.php";

                    $query = "SELECT * FROM `course`";
                    $pageno;

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $product_rs = Database::search($query);
                    $product_num = $product_rs->num_rows;

                    $results_per_page = 20;
                    $number_of_pages = ceil($product_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();

                        $teacher_rs = Database::search("SELECT * FROM `teacher` WHERE `id` IN(SELECT `teacher_id` FROM `teacher_has_course` WHERE `course_course_id`='" . $selected_data["course_id"] . "')");
                        $teacher_data = $teacher_rs->fetch_assoc();
                    ?>

                        <div class=" col-12 mt-3  mb-3">
                            <div class="row">
                                <div class="col-2 col-lg-1 secondcolor py-2 text-end">
                                    <span class="fs-4 fw-bold text-white"><?php echo $selected_data["course_id"]; ?></span>
                                </div>
                                <div class="col-lg-2 d-none d-lg-block bg-light py-2" onclick="viewProductModal('<?php echo $selected_data['course_id']; ?>');">

                                    <img src="<?php echo $selected_data["image"]; ?>" style="height: 100px;width:200px;" />


                                </div>
                                <div class="col-4 col-lg-2 secondcolor py-2">
                                    <span class="fs-5 fw-bold text-white"><?php echo $selected_data["title"]; ?></span>
                                </div>
                                <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                                    <span class="fs-4 fw-bold">Rs. <?php echo $selected_data["price"]; ?> .00</span>
                                </div>
                                <div class="col-lg-2 d-none d-lg-block secondcolor py-2">
                                    <span class="fs-4 fw-bold text-white"><?php echo $teacher_data["first_name"].$teacher_data["last_name"]; ?></span>
                                </div>
                                <div class="col-lg-2 d-none d-lg-block bg-light py-2">

                                </div>
                                <div class="col-2 col-lg-1 bg-white py-2 d-grid">
                                    <?php

                                    if ($selected_data["status_id"] == 1) {
                                    ?>
                                        <button id="pb<?php echo $selected_data['course_id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $selected_data['course_id']; ?>');">Block</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button id="pb<?php echo $selected_data['course_id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $selected_data['course_id']; ?>');">Unblock</button>
                                    <?php

                                    }

                                    ?>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- modal 01 -->
            


            <!--  -->
            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php

                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }

                        ?>

                        <li class="page-item">
                            <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!--  -->

            <hr />

            

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>