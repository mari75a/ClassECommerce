<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Sign In | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/png" href="resource/logo.png"/>
    
</head>
<body class="background2">

<div class="container-fluid justify-content-center " style="margin-top: 100px;">
    <div class="row align-content-center">

    <div class="col-12">
        <div class="row">

        <div class="col-12 logo"></div>
        <div class="col-12">
            <p class="text-center title1">Hi, Welcome to E-Wings Admins.</p>
        </div>

        </div>
    </div>

    <div class="col-12 p-5">
        <div class="row">

        <div class="col-6 bg5 d-none d-lg-block "></div>
        <div class="col-12 col-lg-6 d-block">
            <div class="row g-3">
                <div class="col-12">
                    <p class="title2 h4">Sign In to your Account</p>
                </div>
                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="ex : john@gmail.com" id="e"/>
                </div>
                <div class="col-12 col-lg-6 d-grid">
                    <button class="btn btn-primary" onclick="adminVerification();">Send verification code</button>
                </div>
                <div class="col-12 col-lg-6 d-grid">
                    <a href="index.php" class="btn btn-danger">Back to Home</a>
                </div>
            </div>
        </div>

        </div>
    </div>
   <!-- model -->
   <div class="modal" tabindex="-1" id="verificationModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Admin Verification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="" class="form-label">Enter Your Verification code</label>
        <input type="text " class="form-control " id="vcode">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
      </div>
    </div>
  </div>
</div>
   <!-- model -->

    <div class="col-12 fixed-bottom text-center">
        <p>&copy; 2023 Ewings.lk | All Rights Reserved</p>
        <p class="fw-bold">Java Institute &trade;</p>
    </div>

    </div>
</div>
    

<script src="bootstrap.bundle.js"></script>
<script src="script.js"></script>
</body>
</html>