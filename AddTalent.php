<?php
include 'Connect.php';
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["id_user"])) {
    header("location:Login.php");
} else {
    if (isset($_POST['submit']) || isset($_POST['talentimg'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $img = $_FILES['talentimg']['name'];
        $img_tmp_name = $_FILES['talentimg']['tmp_name'];
        $img_folder = 'uploaded_card_img/' . $img;

        $sql = mysqli_query($con, "SELECT * FROM `talents` WHERE nom ='$name' AND description= '$description' AND talent_owner = '" . $_SESSION['id_user'] . "' ");
        if (mysqli_num_rows($sql) > 0) {
            $message[] = ' Talent Already exists';
        } else {

            $query =  "INSERT INTO `talents` (nom,description,price,img,talent_owner) VALUES( '$name','$description','$price','$img_folder','" . $_SESSION['id_user'] . "' )";
            $insert = mysqli_query($con, $query);

            if ($insert) {
                move_uploaded_file($img_tmp_name, $img_folder);
                $message[] = ' Talent Added Succesfully';
                header('location:Talents.php');
            } else {
                $message[] = 'Error';
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
    <title>Add Talent</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

</head>
<style>
    .form {
        max-width: 500px;
        margin: auto;
        padding: 5rem 1rem;
    }
</style>


<body>

    <div class="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="home.php"><img src="assets/assetsindex/images/logo-dark-Recovered.png" alt="Logo" width="120px" height="200px"></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <?php include './includes/sidebar.php'; ?>

                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>

        </div>

        <div id="main" class="layout-navbar">
            <header class="mb-3">
                <nav class="navbar navbar-expand navbar-light">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="z-index: 999;">
                            <ul class="nav" style="padding-left: 1rem !important;padding-bottom: .5rem !important;">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="home.php">Acceuil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="Talents.php">Browse</a>
                                </li>

                            </ul>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            <?php
                            $sql = mysqli_query($con, "SELECT * FROM `users` WHERE id = '" . $_SESSION['id_user'] . "' ");
                            if (mysqli_num_rows($sql) > 0) {
                                foreach ($sql as $res) {
                            ?>
                                    <div class="dropdown ms-auto">
                                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="user-menu d-flex">
                                                <div class="user-name text-end me-3">
                                                    <h6 class="mb-0 text-gray-600"><?= $res['username']; ?></h6>
                                                    <p class="mb-0 text-sm text-gray-600"><?= $res['user_level'] === 1 ? 'Etudiant' : 'Client' ?></p>
                                                </div>
                                                <div class="user-img d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="<?= $res['img']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <h6 class="dropdown-header">Hello, <?= $res['username']; ?>!</h6>
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
            <?php
                                }
                            }

            ?>
        </div>
        </nav>
        </header>
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
        <form class="form form-vertical" method="post" enctype="multipart/form-data">
            <div class="form-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="first-name-vertical">Talent Name :</label>
                            <input type="text" id="first-name-vertical" class="form-control" name="name" id="name" placeholder="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="email-id-vertical">Talent Image</label>
                            <input type="file" class="form-control form-control-md" id="talentimg" name="talentimg">
                            <div class="form-control-icon">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="contact-info-vertical">Price </label>
                            <input type="number" id="contact-info-vertical" class="form-control" id="price" name="price">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="password-vertical">Description</label>
                            <input type="text" id="password-vertical" class="form-control" id='desciption' name="description">
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1" name="submit">Add</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1" id="reset">Reset </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/main.js"></script>
<script>
    $(document).ready(function() {
        $('#reset').on('click', function() {
            var Name = $('#name').val('');
            var description = $('#description').val('');
            var price = $('#price').val('');
            var img = $('#talentimg').val('');

        });
    });
</script>




</html>