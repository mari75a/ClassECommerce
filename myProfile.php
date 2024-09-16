<?php
session_start();
require "connection.php";
?>


<div class="col-lg-12">
<div class="row">
        <?php

        
        
        $u = $_SESSION["t"]["email"];

        $details_rs = Database::search("SELECT * FROM `teacher`  WHERE `email`='" . $u . "'");
        $data = $details_rs->fetch_assoc();

        ?>
        <div class="col-lg-12">
            <label for="" class="form-label  fw-bold fs-2 offset-5">My Profile</label>
        </div>

        <div class="col-lg-2 offset-5 justify-content-center ">
            <img src="<?php echo $data["timage"]; ?>" class="rounded-circle mt-5" style="width: 150px;height:150px" id="viewImg" />
        </div>
        <input type="file" class="d-none" id="profileimg" accept="image/*" />
        <label for="profileimg" class="btn btn-primary mt-5 offset-3 col-6" onclick="changeImage();">Update Profile Image</label>
        <div class="col-lg-6">
            <label for="" class="form-label col-12  fw-bold">First Name</label>
            <input type="text" class="form-control col-12  " value="<?php echo $data['first_name']; ?>" id="fname">
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label col-12  fw-bold">Last Name</label>
            <input type="text" class="form-control col-12 " value="<?php echo $data['last_name']; ?>" id="lname">
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
        
        
        <div class="col-lg-6 offset-3 mt-3">
            <button class="btn btn-primary col-12" onclick="mn();">Update Profile</button>
        </div>
    </div>
</div>