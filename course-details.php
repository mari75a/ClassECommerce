<?php

session_start();
require "connection.php";
$cid = $_GET["id"];
if(isset($_SESSION["u"])){
    $email=$_SESSION["u"]["email"];
    $course_has_rs = Database::search("SELECT * FROM `users_has_course` WHERE `course_course_id`='" . $cid . "' AND `users_email`='".$email."' ");
                $course_has_num = $course_has_rs->num_rows;
}else{
    
                $course_has_num = 0;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            include "header.php";
            ?>
            <?php

            
            
                
            if (isset($_GET["id"])) {

                $cid = $_GET["id"];

                $course_rs = Database::search("SELECT * FROM `course` WHERE `course_id`='" . $cid . "'");
                $course_data = $course_rs->fetch_assoc();


                $teacher_rs = Database::search("SELECT * FROM `course`INNER JOIN `teacher_has_course` ON teacher_has_course.course_course_id=course.course_id 
                INNER JOIN `teacher` ON teacher_has_course.teacher_id=teacher.id WHERE `course_id`='" . $cid . "'  ");
                $teacher_data = $teacher_rs->fetch_assoc();
            ?>
                <div class="col-12">
                    <div class="container" data-aos="fade-up">

                        <div class="row">
                            <div class="col-lg-8">

                                <img src="<?php echo $course_data['image'] ?>" class="img-fluid" style="height: 500px;">

                            </div>
                            <div class="col-lg-4">

                                <div class="course-info d-flex justify-content-between align-items-center">
                                    <h5>Trainer</h5>
                                    <p><label><?php echo $teacher_data['first_name'] ?></label></p>
                                </div>

                                <div class="course-info d-flex justify-content-between align-items-center">
                                    <h5>Course Fee</h5>
                                    <p>Rs.<?php echo $course_data['price'] ?>.00</p>
                                </div>



                                <div class="course-info d-flex justify-content-between align-items-center">
                                    <h5>Schedule</h5>
                                    <p>7.00 am - 12.00 pm</p>
                                </div>
                                <div class="course-info d-flex justify-content-between align-items-center ">
                                    <?php
                                    if ($course_has_num > 1) {
                                    ?>

                                        <button class="btn btn-success col-12" type="submit"  >Enrolled</button>
                                    <?php
                                    } else {
                                    ?>
                                    <button onclick="m('<?php echo$cid;?>');" class="btn btn-success col-12" id="btn1">Buy Course</button>
                                    <div id="paypal-button-container"   class="col-12">
                                        
                                    </div>
                                        
                                    <?php
                                    }
                                    ?>

                                </div>


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
            }
            ?>
            
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=Aft56JMOWjrrD0Ao3Q-dBMi0T1BkwjjTK3bNYNeS2x_pX4IhHxqdZnGGglSf-UL7Wq3gBB8bT0UhpKgW"></script>
    <script>
   
   
            
           

    </script>
</body>

</html>