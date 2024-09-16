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
    <title>Teacher Sign IN | EWings</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/png" href="resource/logo.png"/>
</head>

<body>

    <div class="container-fluid body-color  vh-100">
        <div class="row">
            <?php
            include "header.php";
            ?>
            <div class="col-12">
                <div class="row">
                    <div class="offset-lg-2 offset-0 mt-5 col-lg-4 col-12 box-color vh-90">
                        <div class="row">
                            <div class="col-12 d-flex mt-5 justify-content-center">
                                <h3 class="fw-bold">Signin Teacher</h3>
                            </div>
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
                                <button class="btn btn-primary my-2" onclick="teachersignIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-12 d-grid">
                                <button class="btn btn-danger" onclick="window.location='teacherRegister.php'">New to eShop?Join Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 m-5" >
                        <h4>Tearm and Conditions</h4>
<p class="text-danger">
1.  Follow the website's policies and guidelines: Ensure that you read and understand the website's policies and guidelines for teachers. Adhere to these policies and guidelines at all times.

<br>2.  Provide accurate information: When creating content for the website, make sure that the information you provide is accurate and up-to-date. Use reliable sources and provide references where necessary.

<br>3.  Respect copyright laws: Do not use copyrighted material without permission from the owner. If you need to use material that is copyrighted, ensure that you obtain permission or use it within the limits of fair use.

<br>4.  Create appropriate content: Ensure that the content you create is appropriate for the audience and aligns with the website's goals and values. Avoid controversial or sensitive topics that may offend or harm users.

<br>5.  Use respectful and professional language: When communicating with students, use respectful and professional language. Avoid using slang or informal language, and be mindful of your tone and attitude.

<br> 6.  Respond to student inquiries promptly: Respond to student inquiries and messages in a timely manner. If you are unable to respond immediately, let students know when they can expect a response.

<br> 7.  Maintain student confidentiality: Protect student privacy by not sharing personal information with third parties without their consent. Also, ensure that your online classroom is secure and that only authorized users can access it.

<br> 8.  Report inappropriate behavior: If you notice any inappropriate behavior on the website, such as harassment or bullying, report it to the website's administration immediately.

<br> 9.  Continuous improvement: Continuously evaluate your performance as a teacher on the website and strive for improvement. Solicit feedback from students and colleagues and use it to improve your teaching methods and content.
</p>
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
</body>

</html>