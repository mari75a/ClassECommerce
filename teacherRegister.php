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
    <title>Teacher Register | EWings</title>
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
                                <h3 class="fw-bold">How to become a Teacher</h3>
                            </div>
                            <div class="col-12 mt-5">
                                <input type="text" class="col-12 form-control " placeholder="First  name *" id="f">
                            </div>
                            <div class="col-12 mt-4">
                                <input type="text" class="col-12 form-control " placeholder="Last  name *" id="l">
                            </div>
                            <div class="col-12 mt-4">
                                <input type="text" class="col-12 form-control " placeholder="Email *" id="e">
                            </div>
                            <div class="col-12 mt-4">
                                <input type="text" class="col-12 form-control " placeholder="NIC Number *" id="n">
                            </div>
                            <div class="col-12 mt-4">
                                <label class="form-label fw-bold">Gender</label>
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
                            <div class="col-12 mt-4">
                                <input type="text" class="col-12 form-control " placeholder="Phone Number *" id="m">
                            </div>
                            <div class="col-12 mt-4">
                                <input type="text" class="col-12 form-control " placeholder="Password *" id="p">
                            </div>
                            <div class="col-12 mt-4">
                                <input type="text" class="col-12 form-control " placeholder="Confirm Password *">
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary offset-3 col-6" onclick="teachersignUp();">Apply</button>
                            </div>
                            <div class="col-12 col-lg-12 d-grid mt-2">
                                <button class="btn btn-danger  offset-3 col-6" onclick="window.location='teacherSignin.php'">Have an account</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 bg3 d-none d-lg-block m-5" style="height: 500px;width:500px">

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