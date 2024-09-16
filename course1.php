<?php

session_start();





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid bg2 ">
        <div class="row">
            <?php
            include "header.php";
            ?>
            <div class="col-12  ">
                <div class="row">
                    <div class="offset-3 col-6 d-flex justify-content-center bg-success mt-2" style="height: 70px;border-radius:5px;">
                        <div class="row align-content-center">
                            <label for="" class="form-label text-white fs-2 fw-bold">Course</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12  ">
                <div class="row">
                    <div class="offset-2  col-lg-8 mt-3" style="height: 100px;" data-aos="fade-up">

                        <div class="row" data-aos="zoom-in" data-aos-delay="100">
                            <div class="col-12 col-lg-2">
                                <div class="sidebar">
                                    <input type="search" class="form-control col-8 mb-5" placeholder="Search Teacher" required="required" id="txt">

                                    <!-- Categories -->
                                    <div class="sidebar_section">

                                        <div class="sidebar_section_title fs-4 mt-1 mb-3">Year</div>
                                        <div class="sidebar_categories">

                                            <select class="form-select mt-2 col-lg-8" id="c3">

                                                <option value="0">Select Year</option>
                                                <?php
                                                require "connection.php";
                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;
                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();
                                                ?>


                                                    <option value="<?php echo  $category_data["id"]; ?>"><?php echo $category_data["name"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>



                                        </div>
                                    </div>

                                    <div class="sidebar_section_title fs-4 mt-1 mb-3">Subjects</div>
                                    <div class="sidebar_categories">

                                        <select class="form-select mt-1 col-lg-8" id="s">

                                            <option value="0">Select Subject</option>
                                            <?php
                                            $class_rs = Database::search("SELECT * FROM `class`  ");
                                            $class_num = $class_rs->num_rows;
                                            for ($y = 0; $y < $class_num; $y++) {
                                                $class_data = $class_rs->fetch_assoc();
                                            ?>


                                                <option value="<?php echo  $class_data["id"]; ?>"><?php echo $class_data["subject"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>



                                    </div>


                                    <!-- Latest Course -->
                                    <div class="sidebar_section ">
                                        <div class="sidebar_section_title fs-4 mt-1  " style="display:block;">Lectures</div>
                                        <select class="form-select mt-2 col-lg-8" id="l">

                                            <option value="0">Select Lecture</option>
                                            <?php
                                            $lect_rs = Database::search("SELECT * FROM `lectures` ");
                                            $lect_num = $lect_rs->num_rows;

                                            for ($x = 0; $x < $lect_num; $x++) {
                                                $lect_data = $lect_rs->fetch_assoc();
                                            ?>


                                                <option value="<?php echo $lect_data["id"]; ?>"><?php echo $lect_data["lecture_name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                        <button action="submit" class="btn btn-primary mt-3" onclick="coursesearch()">Search now</button>
                                    </div>



                                </div>
                            </div>
                            <div class="col-12 col-lg-10  d-flex" id="view">
                                <div class="row">



                                    <?php
                                    $course_rs = Database::search("SELECT * FROM `course`");
                                    $course_num = $course_rs->num_rows;

                                    for ($x = 0; $x < $course_num; $x++) {
                                        $course_data = $course_rs->fetch_assoc();
                                    ?>


                                        <div class="col-lg-4 col-md-6 border1 mt-2 ms-2">
                                            <img src="<?php echo $course_data['image'] ?>" class="card-img-top" alt="...">
                                            <div class="card-body">

                                                <div class="d-flex justify-content-between align-items-center mb-3 ">
                                                    <h4 class="bg-warning p-2 "><?php echo $course_data['title'] ?></h4>

                                                </div>
                                                <div class="d-flex">
                                                    <p class="price p-2 border border-2">Rs <?php echo $course_data['price'] ?>.00</p>
                                                    <p class="border bg-primary col-6 col-lg-6 text-center text-white  p-2 ">December</p>
                                                </div>
                                                <a href='<?php echo "course-details.php?id=" . $course_data["course_id"]; ?>' class="col-12 btn btn-success">Buy Now</a>
                                                <button class="col-12 btn btn-danger mt-2">Add to Cart</button>
                                            </div>
                                        </div>
                                    <?php } ?>



                                </div>







                            </div><!-- End Course Item-->


                        </div>
                    </div>



                </div>
            </div>
            <?php
            include "footer.php";
            ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>