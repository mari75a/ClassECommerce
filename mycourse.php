<?php



session_start();
include "connection.php";
$tid = $_SESSION["u"]["email"];
?>

<div class="col-12 secondcolor">
    <div class="row">
        
        <div class="col-12  col-lg-12">
            <div class="row">
                <div class="col-12 col-lg-6 mt-2 my-lg-4">
                    <h1 class="offset-4 offset-lg-2 text-white fw-bold">My Courses</h1>
                </div>
                <div class="col-12  col-lg-6 mx-2 d-flex justify-lg-content-end justify-content-center mb-2 my-lg-4 mx-lg-0 ">
                    <div class="row">
                        <div class="col-12 col-lg-6 ">
                        <input type="text" placeholder="Search..." class="form-control  " id="s" />
                        </div>
                        <div class="col-12 col-lg-6">
                        <button class="btn btn-success col-lg-6 col-12 fw-bold" onclick="sort1(0);">Search</button>
                        </div>
                    </div>
                
                
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

                        $product_rs = Database::search("SELECT * FROM `course` INNER JOIN `users_has_course` ON users_has_course.course_course_id=course.course_id 
                                         WHERE `users_email`='".$tid."'");
                        $product_num = $product_rs->num_rows;

                        $results_per_page = 6;
                        $number_of_pages = ceil($product_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page;
                        $selected_rs = Database::search("SELECT * FROM `course` INNER JOIN `users_has_course` ON users_has_course.course_course_id=course.course_id 
                        WHERE `users_email`='".$tid."' 
                                    LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                        $selected_num = $selected_rs->num_rows;

                        for ($x = 0; $x < $selected_num; $x++) {
                            $selected_data = $selected_rs->fetch_assoc();

                        ?>

                            <!-- card -->
                            <div class="card mb-3 mt-3 col-12 col-lg-6 d-flex ">
                                <div class="row align-items-center">
                                    <div class="col-md-4 mt-4">

                                        <img src="<?php echo $selected_data["image"]; ?>" class="img-fluid rounded-start" />
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                            <br />

                                            
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row g-1">
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a class="btn btn-warning fw-bold" onclick="sendId(<?php echo $selected_data['course_id']; ?>);">view</a>
                                                        </div>
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <button class="btn btn-danger fw-bold" onclick="deleteCourse(<?php echo $selected_data['course_id']; ?>);">Delete</button>
                                                        </div>
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