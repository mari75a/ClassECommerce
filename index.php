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
    <title>Home | EWings</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" type="image/png" href="resource/logo.png"/>
</head>

<body >
    <div class="container-fluid ">
        <div class="row">
            <?php
            include "header.php";
            ?>
            <div class="col-12 background d-flex animate__animated animate__fadeInDown">
                <div class="row align-content-center">
                    <div class="col-12 mt-5">
                        <label for="" class="form-label fw-bold head  " style="font-size: 60px;"><span class="l1">Learning</span> <span class=" l2">Today</span> ..</label>
                    </div>
                    <div class=" offset-1 col-10 mt-1 ">
                        <label for="" class="form-label fw-bold head  l1" style="font-size: 60px;"><span class="l2">Leading</span> Tommorow...</label>
                    </div>
                    <div class=" offset-2 col-10 mt-5">
                        <button class="btn btn-primary col-2 fs-3 text-white " id="button" onclick="window.location='course.php'" style="width: 200px;border-radius:20px;">->Get Start</button>
                    </div>
                </div>
            </div>



            


            <div class="col-12 d-none d-lg-block">
                <div id="carouselExampleIndicators" class="carousel ">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 500px;">
                            <div class="row">
                                <div class="col-lg-6 navc  col-12" style="height: 500px;">
                                    <?php

                                    $course_rs = Database::search("SELECT * FROM `course`");
                                    $course_num = 3;

                                    $course_data = $course_rs->fetch_assoc();
                                    ?>
                                    <img src="<?php echo $course_data['image'] ?>" style="height:500px;width:100%" class="card-img-top" alt="...">
                                </div>
                                <div class="col-lg-6 col-12 navc d-flex justify-content-center m-0" style="height: 500px;">
                                    <div class="row align-content-center">
                                        <label for="" class="form-label fw-bold head text-white" style="font-size: 60px;"><?php echo $course_data['title'] ?></label>
                                        <a href="<?php echo "course-details.php?id=" . $course_data["course_id"]; ?>" class="btn btn-outline-warning " style="width: 200px;border-radius:20px;">Register</a>
                                    </div>

                                </div>


                            </div>

                        </div>
                        <?php

                        for ($y = 1; $y < $course_num; $y++) {
                            $course_data = $course_rs->fetch_assoc();
                        ?>
                            <div class="carousel-item animate__animated animate__fadeInDown" style="height: 500px;">
                                <div class="row">
                                    <div class="col-lg-6 col-12 bg-image hover-zoom" style="height: 500px;">
                                        <img src="<?php echo $course_data['image'] ?>" class="card-img-top" alt="...">
                                    </div>
                                    <div class="col-lg-6 col-12 navc d-flex justify-content-center " style="height: 500px;">
                                        <div class="row align-content-center">
                                            <label for="" class="form-label fw-bold head text-white" style="font-size: 60px;"><?php echo $course_data['title'] ?></label>
                                            <a href="<?php echo "course-details.php?id=" . $course_data["course_id"]; ?>" class="btn btn-outline-warning " style="width: 200px;border-radius:20px;">Register</a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        <?php
                        } ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>


            <div class="col-12 navc d-flex justify-content-center mt-3" style="height: 60px;">
                <div class="row align-content-center ">
                    <label for="" class="form-label fs-2  text-white fw-bold">Courses</label>
                </div>
            </div>
            <div class="col-lg-10 col-8 offset-2 d-flex  offset-lg-1">
                <div class="row justify-content-center">
                    <?php

                    $course_rs = Database::search("SELECT * FROM `course` WHERE `status_id`!= 2");
                    $course_num = $course_rs->num_rows;
                    for ($x = 0; $x < $course_num; $x++) {
                        $course_data = $course_rs->fetch_assoc();
                    ?>


                        <div id="myButton" class="card  col-12 col-lg-2 me-lg-2    mt-3 1 ms-0  btn btn-outline-dark  hover-zoom " onclick='window.location="<?php echo "course-details.php?id=" . $course_data["course_id"]; ?>"'>
                            <div class="row">
                                <div class="col-12">
                                    <img src="<?php echo $course_data['image'] ?>" style="background-size: container;height:150px;" class="card-img-top" alt="...">
                                </div>

                                <div class="card-body">

                                   
                                        <h5 class="   txtcl"><?php echo $course_data['title'] ?></h5>

                                    
                                    <div class="d-flex">
                                        <p class="fs-5   text-primary fw-bold">LKR <?php echo $course_data['price'] ?>.00</p>
                                        
                                    </div>
                                    <button class="col-12 fw-bold btn btn-primary mt-2" onclick="addToCart(<?php echo $course_data['course_id']; ?>);">Add to Cart</button>
                                    <div class="d-flex">
                                        <?php
                                        
                                        $teacher_rs=Database::search("SELECT * FROM `teacher` WHERE `id` IN(SELECT `teacher_id` FROM `teacher_has_course` WHERE `course_course_id`='".$course_data["course_id"]."')");
                                        $teacher_data=$teacher_rs->fetch_assoc();
                                        ?>
                                        <p class=" text-success fw-bold"><?php echo $teacher_data['first_name'].$teacher_data["last_name"] ?></p>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>



                    <?php } ?>

                </div>
            </div>
            <div class="offset-3 col-6 d-flex justify-content-center">
                <a href="course.php" class="btn btn-primary col-lg-3 col-6 mt-3 fs-4">-> More..</a>
            </div>

            <div class="col-12 navc d-flex justify-content-center mt-3" style="height: 60px;">
                <div class="row align-content-center ">
                    <label for="" class="form-label fs-2  text-white fw-bold">Tutors</label>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center d-none d-lg-block">
                <div class="row">
                    <div class="col-4  ">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">

                                <img src="resource/profile_img/dharshana ukuwela_63cf84c6f0611.jpeg" style="background-size: cover;" alt="">
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <label for="" class="fw-bold fs-4">Dharshana Ukuwela</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4  ">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">

                                <img src="resource/profile_img/Ravindra Bandara_63eb567679fa5.jpeg" style="background-size: cover;height:450px" alt="">
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <label for="" class="fw-bold fs-4">Ravindra Bandara</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4  ">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">

                                <img src="resource/profile_img/_642d197d32e12.jpeg" style="background-size: cover;height:450px" alt="">
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <label for="" class="fw-bold fs-4">Anushaka Indunil</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center thirdcolor box2 d-none d-lg-block">
                <div class="row">
                    <p class="fw-bold text-center fs-2">What is E-wings ?</p>
                    <div class="col-6">
                        <p class="text-center ">Welcome to our educational website! Our mission is to provide high-quality learning resources that empower learners of all ages and backgrounds to achieve their educational goals. Whether you are a student, teacher, or lifelong learner, our website is designed to provide you with a wealth of educational resources and tools that will help you excel in your studies and expand your knowledge.

                            Our website offers a wide range of educational content, including courses, tutorials, assessments, educational videos, interactive simulations, and online forums. Our content is curated and developed by a team of experienced educators who are passionate about teaching and learning. Our resources are designed to be engaging, informative, and accessible, and we strive to make learning a fun and rewarding experience for all learners.

                            At our website, we believe that education is a lifelong journey, and we are committed to providing learners with the tools and resources they need to achieve their educational goals. Whether you are seeking to improve your academic performance, acquire new skills, or simply explore new ideas and topics, our website is the perfect destination for you. So start exploring our educational resources today and take the first step on your educational journey!</p>
                    </div>
                    <div class="col-3">
                        <img src="resource/bg.jfif" style="background-size: cover;height:250px;" alt="">
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
                        <?php

$email = "";
$password = "";

if (isset($_COOKIE["email"])) {
    $email = $_COOKIE["email"];
}

if (isset($_COOKIE["password"])) {
    $password = $_COOKIE["password"];
}

?>
                            <span class="text-danger" id="msg2"></span>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="<?php echo $email?>" id="e2" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" value="<?php echo $password?>" id="p2" />
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

<!-- modal -->

<div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="npi" />
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp" />
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc" />
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal -->


            <?php
            include "footer.php";
            ?>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>