<?php
session_start();

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users | Admins | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" type="image/png" href="resource/logo.png"/>

</head>

<body class="navc">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <label class="form-label text-primary fw-bold fs-1">Manage All Users</label>
            </div>

            

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 secondcolor py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>
                    <div class="col-4 col-lg-2 secondcolor py-2">
                        <span class="fs-4 fw-bold text-white">User Name</span>
                    </div>
                    <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Email</span>
                    </div>
                    <div class="col-2 d-none d-lg-block secondcolor py-2">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-2 col-lg-1 bg-white"></div>
                </div>
            </div>

            <?php

            $query = "SELECT * FROM `users`";
            $pageno;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $user_rs = Database::search($query);
            $user_num = $user_rs->num_rows;

            $results_per_page = 20;
            $number_of_pages = ceil($user_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

                $prof_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $selected_data["email"] . "'");
                $prof_data = $prof_rs->fetch_assoc();

            ?>
                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-2 col-lg-1 secondcolor py-2 text-end">
                            <span class="fs-4 text-white"><?php echo $x + 1; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2" onclick="m('<?php echo $selected_data['email']; ?>');">

                            <?php

                            if (empty($prof_data["image"])) {

                            ?>
                                <img src="resource/new_user.svg" style="height: 40px;margin-left: 80px; " />
                            <?php

                            } else {

                            ?>
                                <img src="<?php echo $prof_data['image']; ?>" style="height: 40px;margin-left: 80px;" />
                            <?php

                            }

                            ?>
                        </div>

                        <div class="col-4 col-lg-2 secondcolor py-2">
                            <span class="fs-4 text-white"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span>
                        </div>

                        <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                            <span class="fs-6 "><?php echo $selected_data['email']; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block secondcolor py-2">
                            <span class="fs-4 text-white"><?php echo $selected_data['mobile_no']; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2">
                            <span class="fs-4 "><?php echo $selected_data['joined_date']; ?></span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white py-2 d-grid">
                            <?php

                            if ($selected_data["status"] == 1) {
                            ?>
                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                            <?php

                            }

                            ?>

                        </div>
                        
                        <!-- msg modal -->
                        <!--  -->
                    </div>
                </div>
            <?php
            } ?>






        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>