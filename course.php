<?php

session_start();

require "connection.php";



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course | EWings</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/png" href="resource/logo.png"/>
</head>

<body class="bg-body">
    <div class="container-fluid">
        <div class="row">
            <?php
            include "header.php";
            ?>


            <div class="col-12 ">
                <div class="row">
                    <div class="col-12 ">
                        <div class="row">
                            <div class="col-lg-2 navc"></div>
                            <div class="offset-lg-1 offset-3 col-6 d-flex justify-content-center navc mt-2" style="height: 70px;border-radius:5px;">
                                <div class="row align-content-center">

                                    <label for="" class="form-label text-white fs-2 fw-bold">Course</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offset-lg-0 offset-0 col-lg-12 mt-0" data-aos="fade-up">

                        <div class="row" data-aos="zoom-in" data-aos-delay="100">
                            <div class="col-12   navc col-lg-2">
                                <div class="sidebar offset-lg-1 mt-5">
                                    <input type="search" class="form-control col-8 mb-5" placeholder="Search Teacher" required="required" id="txt">

                                    <!-- Categories -->
                                    <div class="sidebar_section">

                                        <div class="sidebar_section_title fs-4 mt-1 mb-3 text-white">Year</div>
                                        <div class="sidebar_categories">

                                            <select class="form-select mt-2  col-lg-8" id="c3">

                                                <option value="0" >Select Year</option>
                                                <?php

                                                $category_rs = Database::search("SELECT * FROM `category` ");
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

                                    <div class="sidebar_section_title fs-4 mt-1 mb-3 text-white">Subjects</div>
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
                                        <div class="sidebar_section_title fs-4 mt-1 text-white " style="display:block;">Lectures</div>
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

                                        <button action="submit" class="btn btn-primary col-12 mt-3" style="border-radius: 20px;" onclick="coursesearch()">Search now</button>
                                    </div>



                                </div>
                            </div>
                            <div class=" col-12 col-lg-8 mt-3 mb-3 ">
                                <div class="row">
                                    <div class="offset-1 col-11 text-center">
                                        <div class="row justify-content-center " id="view">

                                            <?php

                                            if (isset($_GET["page"])) {
                                                $pageno = $_GET["page"];
                                            } else {
                                                $pageno = 1;
                                            }


                                            $course_rs1 = Database::search("SELECT * FROM `course` WHERE `status_id`!= 2");
                                            $course_num1 = $course_rs1->num_rows;
                                            $results_per_page = 6;
                                            $number_of_pages = ceil($course_num1 / $results_per_page);
                    
                                            $page_results = ($pageno - 1) * $results_per_page;

                                            $course_rs = Database::search("SELECT * FROM `course`WHERE `status_id`!= 2 LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
                                            $course_num = $course_rs->num_rows;
                                            for ($x = 0; $x < $course_num; $x++) {
                                                $course_data = $course_rs->fetch_assoc();




                                            ?>

                                                <!-- card -->
                                                <div class="card mb-3 mt-3  col-12 col-lg-4 p-2 pb-0">
                                                    <div class="row">
                                                        <div class="col-md-12 mt-4">
                                                            <img src="<?php echo $course_data["image"] ?>" style="width: 300px;height:150px;" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="course-content ">
                                                            <div class="d-block  mb-3">
                                                                <div>
                                                                    <h3 class="txtcl"><?php echo $course_data["title"] ?></h3>
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                <p class="fs-5   text-primary fw-bold">LKR <?php echo $course_data['price'] ?>.00</p>
                                                                </div>

                                                            </div>
                                                            <div>
                                                                <a href='<?php echo "course-details.php?id=" . $course_data["course_id"]; ?>' class="col-12 btn btn-warning">Buy Now</a>
                                                                <button class="col-12 fw-bold btn btn-dark mt-2" onclick="addToCart(<?php echo $course_data['course_id']; ?>);">Add to Cart</button>
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





                            <!-- <div class="col-12 col-lg-10 d-flex flex-row ">
                                <div class="row" id="view">
                               
                                <div class="offset-1 col-10 text-center">
                                    <div class="row justify-content-center">

                                    <?php
                                    $course_rs = Database::search("SELECT * FROM `course`");
                                    $course_num = $course_rs->num_rows;

                                    for ($x = 0; $x < $course_num; $x++) {
                                        $course_data = $course_rs->fetch_assoc();
                                    ?>


                                        <div class="col-lg-4 col-12  border1 p-2 mt-2 ms-2">
                                            <div class="row">
                                                <div class="course-item">
                                                    <img src="<?php echo $course_data["image"] ?>" style="width: 300px;height:150px;" class="img-fluid" alt="...">
                                                    <div class="course-content">
                                                        <div class="d-block  mb-3">
                                                            <div>
                                                                <h3><?php echo $course_data["title"] ?></h3>
                                                            </div>
                                                            <div>
                                                                <p class="price">Rs<?php echo $course_data["price"] ?>.00</p>
                                                            </div>

                                                        </div>
                                                        <a href='<?php echo "course-details.php?id=" . $course_data["course_id"]; ?>' class="col-12 btn btn-success">Buy Now</a>
                                                        <button class="col-12 btn btn-danger mt-2" onclick="addToCart(<?php echo $course_data['course_id']; ?>);">Add to Cart</button>




                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                        </div>





                                </div>







                            </div>End Course Item -->


                        </div>
                    </div>



                </div>
            </div>
            <div class="modal" tabindex="-1" id="register">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Register</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="alertdiv">
                                    <i class="bi bi-x-octagon-fill fs-5" id="msg">

                                    </i>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="f" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="l" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="e" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="p" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="m" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="g">
                                    <?php



                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                    <?php

                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-12 d-grid my-2">
                                <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-12 d-grid">
                                <button class="btn btn-dark" data-bs-dismiss="modal" onclick="changeView();">Already have an account?Sign In</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="sl">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Log In</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <span class="text-danger" id="msg2"></span>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="e2" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="p2" />
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberme">
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-12 d-grid">
                                <button class="btn btn-primary my-2" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-12 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">New to eShop?Join Now</button>
                            </div>
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
    <script src="bootstrap.bundle.js"></script>
</body>

</html>