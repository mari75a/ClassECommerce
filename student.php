<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student | E wings</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="icon" type="image/png" href="resource/logo.png"/>
    </head>

    <body>
        <div class="container-fluid vh-100">
            <div class="row">
                <?php
                include "header.php";
                ?>
                <div class="col-12">
                    <div class="row">

                        <div class="col-lg-2 bg-dark ">
                            <div class="row">
                                <div class="col-lg-12 d-flex flex-column">
                                    <div class="row">
                                        <div class="col-lg-12 mt-lg-3  border border-dark btn btn-success" onclick="studentProfile();" style="height: 60px;border-width:5px;  ">
                                            <div class="container-fluid d-flex justify-content-center">
                                                <div class="row align-content-center">
                                                    <label for="" class="form-label fw-bold mt-3">My Profile</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 mt-lg-3   border border-dark  navc text-white butn" onclick="myCourse();" style="height: 60px;border-width:5px;  ">
                                            <div class="container-fluid d-flex justify-content-center">
                                                <div class="row align-content-center">
                                                    <label for="" class="form-label fw-bold mt-3">Manage My Courses</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-lg-3   border border-dark  navc text-white butn" onclick="purchaseHistory();" style="height: 60px;border-width:5px;  ">
                                            <div class="container-fluid d-flex justify-content-center">
                                                <div class="row align-content-center">
                                                    <label for="" class="form-label fw-bold mt-3">Purchase History</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mt-lg-3  border border-dark btn btn-danger" onclick="signout();" style="height: 60px;border-width:5px;  ">
                                            <div class="container-fluid d-flex justify-content-center">
                                                <div class="row align-content-center">
                                                    <label for="" class="form-label fw-bold mt-3">Log out</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-10 bg-body " style="height: 90vh;background-image: url('resource/Chalkboard-background-powerpoint.jpg');">
                            <div class="row">
                                <div class="col-lg-12" id="body">
                                    <div class="row">
                                    <div class="col-lg-12">
    <div class="row">
        <?php

        
        
        $u = $_SESSION["u"]["email"];

        $details_rs = Database::search("SELECT * FROM `users`  WHERE `email`='" . $u . "'");
        $data = $details_rs->fetch_assoc();

        ?>
        <div class="col-lg-12 col-12">
            <label for="" class="form-label  fw-bold fs-2 offset-5">My Profile</label>
        </div>

        <div class="col-lg-2  offset-lg-5 offset-5 col-2 justify-content-center ">
            <img src="<?php echo $data["image"]; ?>" class="rounded-circle mt-5" style="width: 150px;height:150px" id="viewImg" />
        </div>
        <input type="file" class="d-none" id="profileimg" accept="image/*" />
        <label for="profileimg" class="btn btn-primary mt-5 offset-3 col-6" onclick="changeImage();">Update Profile Image</label>
        <div class="col-lg-6">
            <label for="" class="form-label col-12  fw-bold">First Name</label>
            <input type="text" class="form-control col-12  " value="<?php echo $data['fname']; ?>" id="fname">
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label col-12  fw-bold">Last Name</label>
            <input type="text" class="form-control col-12 " value="<?php echo $data['lname']; ?>" id="lname">
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label col-12  fw-bold">Address</label>
            <input type="text" class="form-control col-12 " value="<?php echo $data['address']; ?>" id="address">
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label col-12  fw-bold">Email</label>
            <input type="text" class="form-control col-12 " value="<?php echo $data['email']; ?>" id="e">
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label col-12  fw-bold">Mobile No</label>
            <input type="text" class="form-control col-12 " value="<?php echo $data['mobile_no']; ?>" id="m">
        </div>
        
        
        <div class="col-lg-6 offset-lg-3 mt-3">
            <button class="btn btn-primary col-12" onclick="studentupdateProfile();">Update Profile</button>
        </div>
    </div>
</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
                                <button type="button" class="btn btn-primary" onclick="teacherresetpw();">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>
<?php

} else {
    echo ("You are Not a valid user");
}

?>