<?php



session_start();
include "connection.php";
$tid = $_SESSION["t"]["id"];
?>

<div class="col-12 secondcolor">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="row">
                <div class="col-12 col-lg-4 mt-1 mb-1 text-center">


                </div>
                <div class="col-12 col-lg-8">
                    <div class="row text-center text-lg-start">
                        <div class="col-12 mt-0 mt-lg-4">
                            <span class="text-white fw-bold"><?php echo $_SESSION["t"]["first_name"] . " " . $_SESSION["t"]["last_name"]; ?></span>
                        </div>
                        <div class="col-12">
                            <span class="text-black-50 fw-bold"><?php echo $_SESSION["t"]["email"]; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="row">
                <div class="col-12 col-lg-10 mt-2 my-lg-4">
                    <h1 class="offset-4 offset-lg-2 text-white fw-bold">My Products</h1>
                </div>
                <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">
                    <button class="btn btn-warning fw-bold" onclick="addCourse();">Add Course</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- header -->
<!-- body -->
<div class="col-12">
    <div class="row">
        <!-- filter -->
        
        <!-- filter -->
        <!-- product -->
        <div class="col-12 col-lg-12 mt-3 mb-3 bg-white">
            <div class="row" id="sort">
                <div class="offset-1 col-10 text-center">
                    <div class="row justify-content-center">

                        <?php

                        if (isset($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }

                        $product_rs = Database::search("SELECT * FROM `course` INNER JOIN `teacher_has_course` ON teacher_has_course.course_course_id=course.course_id 
                                        INNER JOIN `teacher` ON teacher_has_course.teacher_id=teacher.id WHERE `teacher_id`=$tid");
                        $product_num = $product_rs->num_rows;

                        $results_per_page = 6;
                        $number_of_pages = ceil($product_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page;
                        $selected_rs = Database::search("SELECT * FROM `course` INNER JOIN `teacher_has_course` ON teacher_has_course.course_course_id=course.course_id 
                                        INNER JOIN `teacher` ON teacher_has_course.teacher_id=teacher.id WHERE `teacher_id`=$tid 
                                    LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                        $selected_num = $selected_rs->num_rows;

                        for ($x = 0; $x < $selected_num; $x++) {
                            $selected_data = $selected_rs->fetch_assoc();

                        ?>

                            <!-- card -->
                            <div class="card mb-3 mt-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-md-4 mt-4">

                                        <img src="<?php echo $selected_data["image"]; ?>" class="img-fluid rounded-start" />
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                            <span class="card-text fw-bold text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $selected_data["course_id"]; ?>" <?php if ($selected_data["status_id"] == 2) {
                                                                                                                                                                ?>checked<?php
                                                                                                                                                                }
                                                                                ?> onclick="changeStatus(<?php echo $selected_data['course_id']; ?>);" />
                                                <label class="form-check-label fw-bold text-info" for="fd<?php echo $selected_data["course_id"]; ?>">
                                                    <?php if ($selected_data["status_id"] == 2) { ?>
                                                        Make Your Course Active
                                                    <?php } else { ?>
                                                        Make Your Course Deactive
                                                    <?php
                                                    }
                                                    ?>

                                                </label>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-center">
                                                    <div class="row g-1">
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a class="btn btn-success fw-bold" onclick="sendId(<?php echo $selected_data['course_id']; ?>);">Update</a>
                                                        </div>
                                                        <!-- <div class="col-12 col-lg-6 d-grid">
                                                            <button class="btn btn-danger fw-bold" onclick="deleteCourse(<?php echo $selected_data['course_id']; ?>);">Delete</button>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card -->

                        <?php

                        }

                        ?>


                    </div>
                </div>

                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-lg justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                echo "#";
                                                            } else {
                                                                echo "?page=" . ($pageno - 1);
                                                            } ?>" aria-label="Previous">
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
                                <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                echo "#";
                                                            } else {
                                                                echo "?page=" . ($pageno + 1);
                                                            } ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
        <!-- product -->
    </div>
</div>
<!-- body -->