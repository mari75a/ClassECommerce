<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
  
</head>

<body>
  <?php

  ?>
  <div class="col-12 navc head1">
    <div class="row mt-1 mb-1">

      <nav class="offset-lg-0 offset-0 col-lg-11 col-12 navbar navbar-dark navbar-expand-lg ">
        <div class="container-fluid">
          <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
          </button>
          <span class="navbar-brand ms-5 fs-3 text-white fw-bold" onclick="adminpanel();" style="cursor: pointer;"><img src="resource/logo.png" alt="" style="width:100px;height:80px;"></span>
         
          <div class="collapse navbar-collapse text-center" id="navbarTogglerDemo03">
            <ul class="navbar-nav offset-lg-1 me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active ms-2 fw-bold fs-md-6 text-white" id="button" aria-current="page" href="index.php">Home <br> මුල් පිටුව</a>
              </li>

              <li class="nav-item">
                <a class="nav-link  active  ms-2  fw-bold fs-6 fs-lg-6 text-white" id="button" href="course.php">Courses <br>පාඨමාලා</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  active  ms-2  fw-bold fs-6 fs-lg-6 text-white" id="button" href="teacherRegister.php">Become a Teacher <br>ගුරුවරයෙක් වන්න</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  active  ms-2  fw-bold fs-6 fs-lg-6 text-white" id="button" href="teacherSignin.php">Signin Teacher <br>ගුරුවරයෙක් වන්න</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  active ms-2  fw-bold fs-6 text-white" id="button" id="button" href="#">Blog <br>බ්ලොග් </a>
              </li>

            </ul>

            <div class="col-lg-4 d-flex justify-content-lg-end justify-content-center col-md-6 footer-newsletter">
            <?php
                if (isset($_SESSION["u"])) {
                  $cart_rs = Database::search("SELECT * FROM `cart` WHERE `status`='0' AND `user_email`='" . $_SESSION["u"]["email"] . "'");
                  $cart_num = $cart_rs->num_rows;
                  if ($cart_num != null) {
                ?>
                    <div class="circle bg-danger justify-content-center ">
                      <div class="align-items-center row">

                        <p class="text-white text-center"><?php echo $cart_num; ?></p>
                      </div>

                    </div>

                <?php
                  }
                }
                ?>
              <a href="cart.php"><i class="bi bi-cart4 me-5 fs-4 text-white"></i>
                

              </a>
              <?php



              if (isset($_SESSION["t"])) {
                $data = $_SESSION["t"];
                $details_rs = Database::search("SELECT * FROM `teacher`  WHERE `email`='" . $data["email"] . "'");
                $data2 = $details_rs->fetch_assoc();

              ?>
                <div class="ms-lg-4 d-flex justify-content-center ">
                  <div class="col-6">
                    <a href="teacher.php"><img src="<?php echo $data2['timage'] ?>" width="40px" class="rounded-circle ">

                    </a>
                    <div class="col-12">
                      <label class="text-white text-center">My profile </label>
                    </div>
                  </div>

                  <div class="fs-7 col-8 d-flex justify-content-center align-items-center  btn btn-danger fw-bold signout ms-lg-2" onclick="signout();">Sign Out</div> |
                </div>
              <?php

              } else if (isset($_SESSION["u"])) {
                $data = $_SESSION["u"];
                $details_rs = Database::search("SELECT * FROM `users`  WHERE `email`='" . $data["email"] . "'");
                $data2 = $details_rs->fetch_assoc();

              ?>
                <div class="ms-lg-3 d-flex ">
                <div class="col-6">
                    <a href="student.php"><img src="<?php echo $data2['image'] ?>" width="40px" class="rounded-circle ">

                    </a>
                    <div class="col-12">
                      <label class="text-white text-center">My profile </label>
                    </div>
                  </div> |

                  <div class="fs-7 col-8 d-flex justify-content-center align-items-center  btn btn-danger fw-bold signout ms-lg-2" onclick="signout();">Sign Out</div> |
                </div>
              <?php

              } else {

              ?>

                <a class="btn btn-danger get-started-btn  col-3 animate__animated animate__swing" id="button" style="cursor: pointer ;" onclick="regModel1();">Register</a>
                <a class="btn btn-primary  col-3 animate__animated animate__swing" id="button" style="cursor: pointer ;" onclick="logModel();">Log in</a>


              <?php

              }

              ?>



            </div>

          </div>
        </div>
      </nav>





    </div>
  </div>

  <script src="script.js"></script>
  <script src="bootstrap.bundle.js"></script>
</body>

</html>