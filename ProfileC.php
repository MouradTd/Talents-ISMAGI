<?php

include 'Connect.php';

session_start();


if (!isset($_SESSION["username"]) || !isset($_SESSION["id_user"])) {
    header("location:Login1.php");
}

if (isset($_POST['Update_Profile'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $mail = mysqli_real_escape_string($con, $_POST['email']);
    $updated_img = $_FILES['updated_img']['name'];
    $updated_img_tmp_name = $_FILES['updated_img']['tmp_name'];
    $updated_img_folder = 'uploaded_Profile_img/' . $updated_img;


    $sql = mysqli_query($con, "SELECT * FROM `users` WHERE id = '" . $_SESSION['id_user'] . "' ");
    if (mysqli_num_rows($sql) > 0) {
        foreach ($sql as $res) {
            $old_profile_img = $res['img'];
        }
    }

    $query =  "UPDATE `users` SET username = '$username', email ='$mail'   , img = '$updated_img_folder'  WHERE id = '" . $_SESSION['id_user'] . "' ";
    $update = mysqli_query($con, $query);

    if ($update) {
        move_uploaded_file($updated_img_tmp_name, $updated_img_folder);
        unlink($old_profile_img);
        $message[] = 'Profile updated succesfuly';
    } else {
        $message[] = 'Error';
    }
}

if (isset($_POST['Update_pass'])) {
    $old_pass = mysqli_real_escape_string($con, $_POST['oldpass']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $passQuery =  "SELECT password FROM `users` WHERE id = '" . $_SESSION['id_user'] . "'";
    $qq = mysqli_query($con, $passQuery);
    if (mysqli_num_rows($qq) > 0) {
        foreach ($qq as $res) {
            $old_pass_verification = $res['password'];
        }
    }
    if ($old_pass !== $old_pass_verification) {
        $message[] = "old Paswword invalid";
    } else {
        if ($cpassword !== $password) {
            $message[] = "Password dont match";
        }else{
            $update_pass = "UPDATE `users` SET  password = '$password' WHERE id = '" . $_SESSION['id_user'] . "' ";
            $up = mysqli_query($con, $update_pass);
            if($up){
             $message[]="Password changed successfully";
            }else{
                $message[]="Error";

            }
        }
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Icon Microwlights -->
    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/microwlights.css">

    <!-- CSS Libraries -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css" />
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css" />

</head>

<body>
    <div class="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                        <a href="home.php"><img src="assets/assetsindex/images/logo-dark-Recovered.png" alt="Logo" width="120px" height="200px"></a>
                        </div>
                        <div class="toggler" style="top:10px;left: 10px;">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <?php include './includes/sidebar.php'; ?>

                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
    </div>
    <?php
    $getcredentials = mysqli_query($con, "SELECT * FROM `users` WHERE id = '" . $_SESSION['id_user'] . "' ");
    if (mysqli_num_rows($getcredentials) > 0) {
        foreach ($getcredentials  as $result) {
    ?>


            <div id="main" class="layout-navbar " >
                <header class="mb-3 sticky-top">
                    <nav class="navbar navbar-expand navbar-light">
                        <div class="container-fluid w-100 ">
                            <a href="#" class="burger-btn d-block">
                                <i class="bi bi-justify fs-3"></i>
                            </a>

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse w-100" id="navbarSupportedContent" style="margin-right: 1rem;">

                                <div class="dropdown ms-auto">
                                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="user-menu d-flex">
                                            <div class="user-name text-end me-3">
                                                <h6 class="mb-0 text-gray-600"><?php echo $result["username"] ?></h6>
                                                <p class="mb-0 text-sm text-gray-600"><?php echo $res['user_level'] == 1 ?  'Etudiant' : 'Client'; ?></p>
                                            </div>
                                            <div class="user-img d-flex align-items-center">
                                                <div class="avatar avatar-md">
                                                    <img src="<?php echo $result["img"] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="margin-right: 3rem !important;">
                                        <li>
                                            <h6 class="dropdown-header">Hello, <?php echo $result["username"] ?>!</h6>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <?php
                                                        if ($res['user_level'] === "1") {
                                                        ?>
                                                            <li><a class="dropdown-item" href="Profile.php"><i class="icon-mid bi bi-person me-2"></i> My
                                                                    Profile</a></li>
                                                            <li>
                                                            <hr class="dropdown-divider">
                                                            <li><a class="dropdown-item" href="OrdersEtudiant.php"><i class="icon-mid bi bi-gear me-2"></i>
                                                                    My orders</a>
                                                            </li>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li><a class="dropdown-item" href="ProfileC.php"><i class="icon-mid bi bi-person me-2"></i> My
                                                                    Profile</a></li>
                                                            <li>
                                                            <hr class="dropdown-divider">
                                                            <li><a class="dropdown-item" href="OrdersClient.php"><i class="icon-mid bi bi-gear me-2"></i>
                                                                    My orders</a>
                                                            </li>
                                                            <?php
                                                        }
                                                            ?>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="Logout.php"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
            </div>
            </nav>
            </header>
            </div>
            <section class="profile">
                <div class="row">
                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div class="card p-1 mb-4">
                            <div class="card-header border-0">
                                <img src="assets/images/samples/background-profil-1.jpg" alt="" class="w-100 rounded-3">
                            </div>
                            <div class="profil-img d-flex justify-content-center container-xl px-4 mt-n10">
                                <img src="<?php echo $result["img"] ?>" alt="avatar" class="rounded-pill">
                            </div>
                            <div class="card-body text-center">
                                <h4 class="fw-bold"><?php echo $result["username"] ?></h4>
                                <p class="md-text-rg text-secondary-500">Account level: <span class="fw-bold text-secondary-700"><?php echo $res['user_level'] == 1 ?  'Etudiant' : 'Client'; ?></span></p>
                            </div>
                        </div>
                        <div class="card mb-4 p-4">
                            <div class="card-header">
                                <h5 class="fw-bold text-secondary-700">Change password</h5>
                                <span class="lg-text-rg text-secondary-400">Here you can set your new password</span>
                            </div>
                            <?php
                            if (isset($message)) {
                                foreach ($message as $message) {
                                    echo "
                  <div class='alert alert-secondary alert-dismissible show fade'>
                      $message
                      <button type='button' class='btn-close' data-bs-dismiss='alert'aria-label='Close'></button>
                  </div>
                  ";
                                }
                            }
                            ?>
                            <div class="card-body">
                                <form  method="post" enctype="multipart/form-data">
                                    <div class="form-group mb-4">
                                        <label for="old" class="text-secondary-700 mb-2">Old Password</label>
                                        <input type="text" class="form-control form-control-sm" name="oldpass">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="new" class="text-secondary-700 mb-2">New Password</label>
                                        <input type="text" name="password" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="confirm" class="text-secondary-700 mb-2">New Password
                                            Confirmation</label>
                                        <input type="text" name="cpassword" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group float-end">
                                        <button class="btn btn-primary btn-md" name="Update_pass" type="Update_pass">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 col-sm-12">
                        <div class="card mb-4 p-4">
                            <div class="card-header">
                                <h5 class="fw-bold text-secondary-700">Account Settings</h5>
                                <span class="lg-text-rg text-secondary-400">Here you can change user account
                                    information</span>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-4">
                                                <label for="username" class="text-secondary-700 mb-2">Username</label>
                                                <input type="text" name="username" class="form-control form-control-sm" placeholder="<?php echo $result["username"] ?>">
                                            </div>

                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-4">
                                                <label for="email" class="text-secondary-700 mb-2">Email
                                                    Address</label>
                                                <input type="email" name="email" class="form-control form-control-sm" placeholder="<?php echo $result["email"] ?>">
                                            </div>

                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="updated_img" class="text-secondary-700 mb-2">Profile Image :</label>
                                            <input type="file" class="form-control form-control-md" name="updated_img">

                                        </div>
                                        
                                    </div>
                                    <div class="form-group float-end">
                                        <button class="btn btn-primary btn-md" type="Update_Profile" name="Update_Profile">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
        <?php
        }
    }
        ?>
            </section>
            <!-- General JS Scripts -->
            <script src="assets/js/bootstrap.bundle.min.js"></script>

            <!-- Template JS FIle -->
            <script src="assets/js/main.js"></script>

            <!-- Js Libraries -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
            <script src="assets/js/main.js"></script>

</body>

</html>