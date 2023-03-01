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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">


    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/microwlights.css">

    <!-- CSS Libraries -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css" />

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
                                    <a class="nav-link active" aria-current="page" href="BrowseTalents.php">Browse</a>
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
                                                    <p class="mb-0 text-sm text-gray-600"><?= $res['user_level'] === "1" ? 'Etudiant' : 'Client' ?></p>
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


        <!-- Main Content -->
        <div class="card mb-4">
            <div class="card-header">
                 Orders
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTableExport" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Talent Name</th>
                                <th>Talent Owner</th>
                                <th>number</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = mysqli_query($con, "SELECT o.email,o.talent_name,o.status ,o.number, u.username FROM orders o ,users u WHERE u.id = o.talent_owner  AND name_client = '" . $_SESSION['username'] . "' ");
                            if (mysqli_num_rows($sql) > 0) {
                                foreach ($sql as $res) {
                            ?>
                                    <tr class="md-text-rg text-secondary-500 align-middle tb-vh-75">
                                        <td><?= $_SESSION['username'] ?></td>
                                        <td><?= $res['email']; ?></td>
                                        <td><?= $res['talent_name']; ?></td>
                                        <td><?= $res['username']; ?></td>
                                        <td><?= $res['number']; ?></td>
                                        <?php
                                        if ($res['status'] === "Pending") {
                                        ?>
                                            <td><span class="badge rounded-pill text-bg-warning-50 text-uppercase ps-3 pe-3" style="font-size:15px"><?= $res['status']; ?></span></td>
                                        <?php
                                        } elseif ($res['status'] === "Completed") {
                                        ?>
                                            <td><span class="badge rounded-pill text-bg-success-50 text-uppercase ps-3 pe-3" style="font-size:15px"><?= $res['status']; ?></span></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><span class="badge rounded-pill text-bg-danger-50 text-uppercase ps-3 pe-3" style="font-size:15px"><?= $res['status']; ?></span></td>
                                        <?php
                                        }

                                        ?>

                                    </tr>
                            <?php }
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Main content -->

        <!-- Custom Order -->
        <div class="card mb-4">
            <div class="card-header">
               Custom Orders
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name Client</th>
                                <th>Talent Name</th>
                                <th>Talent Owner</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = mysqli_query($con, "SELECT * FROM custom where client_name = '" . $_SESSION['username'] . "'");
                            if (mysqli_num_rows($sql) > 0) {
                                foreach ($sql as $res) {
                            ?>
                                    <tr class="md-text-rg text-secondary-500 align-middle tb-vh-75">
                                        <td><?= $res['client_name']; ?></td>
                                        <td><?= $res['talent_name']; ?></td>
                                        <td><?= $res['talent_owner']; ?></td>
                                        <td><?= $res['description']; ?></td>
                                        <?php
                                        if ($res['status'] === "Pending") {
                                        ?>
                                            <td><span class="badge rounded-pill text-bg-warning-50 text-uppercase ps-3 pe-3" style="font-size:15px"><?= $res['status']; ?></span></td>
                                        <?php
                                        } elseif ($res['status'] === "Completed") {
                                        ?>
                                            <td><span class="badge rounded-pill text-bg-success-50 text-uppercase ps-3 pe-3" style="font-size:15px"><?= $res['status']; ?></span></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><span class="badge rounded-pill text-bg-danger-50 text-uppercase ps-3 pe-3" style="font-size:15px"><?= $res['status']; ?></span></td>
                                        <?php
                                        }

                                        ?>

                                    </tr>
                            <?php }
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Custom Order -->
    </div>

</body>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/main.js"></script>



<!-- Js Libraries -->
<script src="assets/js/apexchrats.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTableExport').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }]
        });
    });
    $(document).ready(function() {
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }]
        });
    });
</script>




</html>