<?php

include 'Connect.php';

session_start();


if (!isset($_SESSION["username"]) || !isset($_SESSION["id_user"])) {
    header("location:Login1.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Talent ISMAGI</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
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
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Profile Statistics</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <?php
                                        $sql = mysqli_query($con, "SELECT COUNT(*) as NumTalents from talents where talent_owner = '" . $_SESSION['id_user'] . "' ");
                                        if (mysqli_num_rows($sql) > 0) {
                                            foreach ($sql as $res) {
                                        ?>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Nombre des Talents</h6>
                                                <h6 class="font-extrabold mb-0"><?= $res['NumTalents']; ?></h6>
                                            </div>
                                            <?php }}?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <?php
                                             $Nombre_Client=0;
                                        $sql = mysqli_query($con, "SELECT COUNT(*) as NumOrders from orders  where talent_owner = '" . $_SESSION['id_user'] . "' ");
                                        if (mysqli_num_rows($sql) > 0) {
                                            foreach ($sql as $res) {
                                                $Nombre_Client+=$res['NumOrders'];
                                        ?>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Nombre des orders</h6>
                                                <h6 class="font-extrabold mb-0"><?= $res['NumOrders']; ?></h6>
                                            </div>
                                            <?php }}?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <?php
                                        $sql = mysqli_query($con, "SELECT COUNT(*) as NumOrdersCustom from custom  where talent_owner = '" . $_SESSION['username'] . "' ");
                                        if (mysqli_num_rows($sql) > 0) {
                                            foreach ($sql as $res) {
                                                $Nombre_Client+=$res['NumOrdersCustom'];
                                        ?>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Nombre des orders custom</h6>
                                                <h6 class="font-extrabold mb-0"><?= $res['NumOrdersCustom']; ?></h6>
                                            </div>
                                            <?php }}?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Nombre des Clients total</h6>
                                                <h6 class="font-extrabold mb-0"><?= $Nombre_Client ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>orders</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <?php
                                        $sql = mysqli_query($con, "SELECT * FROM `users` WHERE id = '" . $_SESSION['id_user'] . "' ");
                                        if (mysqli_num_rows($sql) > 0) {
                                            foreach ($sql as $res) {
                                        ?>

                                                <div class="dropdown ms-auto" style="margin-bottom: .5rem; padding-left: 2rem; margin-top: 0.5rem;">
                                                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <div class="user-menu d-flex">
                                                            <div class="user-name text-end me-3">
                                                                <h6 class="mb-0 text-gray-600"><?php echo $_SESSION["username"] ?></h6>
                                                                <p class="mb-0 text-sm text-gray-600"><?php echo $res['user_level'] == "1" ?  'Etudiant' : 'Client'; ?></p>
                                                            </div>
                                                            <div class="user-img d-flex align-items-center">
                                                                <div class="avatar avatar-md">
                                                                    <img src="<?= $res['img']; ?>" alt="<?= $res['username']; ?>">
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
                                                            <li><a class="dropdown-item" href="Logout.php"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Log out</a></li>
                                                    </ul>
                                                </div>
                                        <?php
                                            }
                                        }

                                        ?>
                                    </div>
                                    <div class="ms-3 name">


                                        


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4> Messages</h4>
                            </div>
                            <?php
                            $random_user = mysqli_query($con, "SELECT * FROM `users` WHERE username!='" . $_SESSION['username'] . "' ORDER BY RAND() LIMIT 3;");
                            if (mysqli_num_rows($random_user) > 0) {
                                foreach ($random_user as $res) {
                            ?>
                                    <div class="card-content pb-4">
                                        <div class="recent-message d-flex px-4 py-3">
                                            <div class="avatar avatar-lg">
                                                <img src="<?= $res['img']; ?>">
                                            </div>
                                            <div class="name ms-4">
                                                <h5 class="mb-1"><?= $res['username']; ?></h5>
                                                <h6 class="text-muted mb-0">@<?= $res['username']; ?></h6>
                                            </div>
                                        </div>
                                <?php
                                }
                            }

                                ?>
                                <div class="px-4">
                                    <a class='btn btn-block btn-xl btn-light-primary font-bold mt-3' href="#">Start
                                        Conversation</a>
                                </div>
                                    </div>
                        </div>
                        <!-- <div class="card">
                                <div class="card-header">
                                    <h4>Visitors Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-visitors-profile"></div>
                                </div>
                            </div> -->
                    </div>
                </section>
            </div>



        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>