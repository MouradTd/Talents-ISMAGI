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
                                <th>Name Client</th>
                                <th>Email</th>
                                <th>Talent Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = mysqli_query($con, "SELECT o.* FROM orders o,users u WHERE u.id = o.talent_owner AND u.username = '" . $_SESSION['username'] . "' ");
                            if (mysqli_num_rows($sql) > 0) {
                                foreach ($sql as $res) {
                            ?>
                                    <tr class="md-text-rg text-secondary-500 align-middle tb-vh-75">
                                        <td><?= $res['name_client']; ?></td>
                                        <td><?= $res['email']; ?></td>
                                        <td><?= $res['talent_name']; ?></td>
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

                                        ?> <td>
                                            <button class="btn btn-primary shadow-sm fw-bold btn-md editorder" value="<?= $res['Id']; ?>">Update</button>
                                            <button href="#" class="btn btn-danger shadow-sm fw-bold btn-md rejectbtn" value="<?= $res['Id']; ?>" data-bs-toggle="modal" data-bs-target="#danger">Rejeter</button>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Main content -->

        <!-- Custom Talent Table -->
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = mysqli_query($con, "SELECT * FROM custom where talent_owner = '" . $_SESSION['username'] . "'");
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

                                        ?> <td>
                                            <button href="#" class="btn btn-primary shadow-sm fw-bold btn-md edit_custom_order" value="<?= $res['id']; ?>" >Update</button>
                                            <button href="#" class="btn btn-danger shadow-sm fw-bold btn-md rejectCustombtn" value="<?= $res['id']; ?>" data-bs-toggle="modal" data-bs-target="#danger">Rejeter</button>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Custom Talent Table -->
    </div>

    <!-- Update Modal -->
    <div class="modal fade text-left" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Update Talent </h4>

                </div>

                <form id="updateorder">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <label>Talent Name: </label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name" disabled required>
                        </div>

                        <label>Status: </label>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="Completed">Completed</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary me-1 mb-1" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Update Modal -->

    <!-- Update Custom order -->
    <div class="modal fade text-left" id="UpdateCustomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Update Talent </h4>

                </div>

                <form id="updatecustomorder">
                    <div class="modal-body">
                        <input type="hidden" name="Cid" id="Cid">
                        <label>Talent Name: </label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="Cname" id="Cname" disabled required>
                        </div>

                        <label>Status: </label>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="status" name="Cstatus">
                                    <option value="Completed">Completed</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary me-1 mb-1" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Update Custom order -->

    <!-- Delting Modal -->
    <div class="modal-danger me-1 mb-1 d-inline-block">
        <!--Danger theme Modal -->
        <div class="modal fade text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title white" id="myModalLabel120">
                            Reject Order
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure u want to reject this Order?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" name="delete" class="btn btn-danger ml-1 " id="delete" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reject</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deleting Modal -->

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

<script src="assets/js/extensions/sweetalert2.js"></script>
<script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
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

    // Student Talent
    $(document).on('click', '.editorder', function() {
        var order_id = $(this).val();
        //alert(task_id);
        $.ajax({
            type: "GET",
            url: "CodeOrders.php?order_id=" + order_id,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.stat == 404) {
                    alert(res.message);
                } else if ((res.stat == 200)) {
                    $('#id').val(res.data.Id);
                    $('#name').val(res.data.talent_name);
                    $('#status').val(res.data.status);
                    $('#UpdateModal').modal('show');
                }
            }
        });
    });

    $(document).on('submit', '#updateorder', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append('update_order', true);
        $.ajax({
            type: "POST",
            url: "CodeOrders.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.stat == 422) {
                    Swal.fire({
                        icon: "info",
                        title: res.message
                    })
                } else if ((res.stat == 200)) {
                    Swal.fire({
                        icon: "success",
                        title: res.message
                    })
                    $('#UpdateModal').modal('hide');
                    $('#dataTableExport').load(location.href + " #dataTableExport");
                }
            }
        });
    });

    // Reject Order

    $(document).on('click', '.rejectbtn', function() {
        var order_id = $(this).val();
        
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "CodeOrders.php",
                data: {
                    'reject_order': true,
                    'order_id': order_id
                },
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.stat == 500) {
                        Swal.fire({
                            icon: "error",
                            title: res.status
                        })
                        $('#danger').modal('hide');

                    } else {
                        Swal.fire({
                            icon: "success",
                            title: res.message
                        })
                        $('#UpdateModal').modal('hide');
                        $('#dataTableExport').load(location.href + " #dataTableExport");

                    }
                }
            });


        });

    });

    // Student Talent

    // Custom Talent

    $(document).on('click', '.edit_custom_order', function() {
        var custom_order_id = $(this).val();
       
        $.ajax({
            type: "GET",
            url: "CodeOrders.php?custom_order_id=" + custom_order_id,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.stat == 404) {
                    alert(res.message);
                } else if ((res.stat == 200)) {

                    $('#Cid').val(res.data.id);
                    $('#Cname').val(res.data.talent_name);
                    $('#Cstatus').val(res.data.status);
                    $('#UpdateCustomModal').modal('show');
                }
            }
        });
    });

    $(document).on('submit', '#updatecustomorder', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append('update_custom_order', true);
        $.ajax({
            type: "POST",
            url: "CodeOrders.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.stat == 422) {
                    Swal.fire({
                        icon: "info",
                        title: res.message
                    })
                } else if ((res.stat == 200)) {
                    Swal.fire({
                        icon: "success",
                        title: res.message
                    })
                    $('#UpdateCustomModal').modal('hide');
                    $('#dataTable').load(location.href + " #dataTable");
                }
            }
        });
    });

    // Reject Order

    $(document).on('click', '.rejectCustombtn', function() {
        var custom_order_id = $(this).val();
        
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "CodeOrders.php",
                data: {
                    'reject_custom_order': true,
                    'custom_order_id': custom_order_id
                },
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.stat == 500) {
                        Swal.fire({
                            icon: "error",
                            title: res.status
                        })
                        $('#danger').modal('hide');

                    } else {
                        Swal.fire({
                            icon: "success",
                            title: res.message
                        })
                        $('#UpdateCustomModal').modal('hide');
                        $('#dataTable').load(location.href + " #dataTable");

                    }
                }
            });


        });

    });
    // Custom Talent
</script>




</html>