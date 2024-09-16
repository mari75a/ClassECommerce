<?php

session_start();

require "connection.php";

$user = $_SESSION["u"];

$search = $_POST["s"];


$query = "SELECT * FROM `users_has_course` INNER JOIN `course` ON `course`.`course_id`=`users_has_course`.`course_course_id` WHERE `users_email`='" . $user["email"] . "'";

if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'";
}


?>

<div class="offset-1 col-10 text-center">
    <div class="row justify-content-center">

        <?php

        if ("0" != ($_POST["page"])) {
            $pageno = $_POST["page"];
        } else {
            $pageno = 1;
        }

        $product_rs = Database::search($query);
        $product_num = $product_rs->num_rows;

        $results_per_page = 6;
        $number_of_pages = ceil($product_num / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page;
        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

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
                            

                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="row g-1">
                                        <div class="col-12 col-lg-6 d-grid">
                                            <a class="btn btn-success fw-bold" onclick="sendId(<?php echo $selected_data['course_id']; ?>);">view</a>
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
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                        ?> onclick="sort1('<?php echo ($pageno - 1); ?>');" <?php
                                                                                                } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php

            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {

            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="sort1('<?php echo $x; ?>');"><?php echo $x; ?></a>
                    </li>
                <?php

                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="sort1('<?php echo $x; ?>');"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }

            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                        ?> onclick="sort1('<?php echo ($pageno + 1); ?>');" <?php
                                                                                                } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>