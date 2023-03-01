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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talents</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/bootstrap.css" />

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/css/app.css" />

</head>
<style>
    .card-content img {
        aspect-ratio: 2/2;
        object-fit: contain;
    }
</style>


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
                        <div class="collapse navbar-collapse" style="z-index: 999;">
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

        <!-- Modal for Adding a Talent -->
        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Add Talent </h4>

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
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <label>Talent Name: </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <label>Talent Image</label>
                            <div class="form-group ">
                                <input type="file" class="form-control form-control-md" accept="image/jpeg ,image/png ,image/jpg" name="talentimg" required>
                                <div class="form-control-icon">
                                </div>
                            </div>

                            <label>Price: </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="price" required>
                            </div>
                            <label>Description: </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="description" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-primary me-1 mb-1" name="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- //Modal for Adding a Modal // -->
        <!-- Search Input start -->




        <div class="container ">
            <div class="row d-flex flex-row-reverse ">

                <div class="col-md-6">
                    <div class="form-group row align-items-end">
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label-lg">Search :</label>
                        </div>
                        <div class="col-lg-10 col-9">
                            <input type="text" id="search" class="form-control form-control-lg">
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- Search Input end -->

        <div id="main-content pt-4" style="box-sizing: content-box">
            <div class="right__col pt-4">
                <div class="container">
                    <div class="row">
                        <section id="content-types">
                            <div class="row">
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM `talents` WHERE talent_owner = '" . $_SESSION['id_user'] . "' ");
                                if (mysqli_num_rows($sql) > 0) {
                                    foreach ($sql as $res) {
                                ?>
                                        <!-- Begin card -->
                                        <div class="col-xl-4 col-md-6 col-sm-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <h4 class="card-title"><?= $res['nom']; ?></h4>
                                                        <p class="card-text">
                                                            <?= $res['description']; ?>
                                                        </p>
                                                    </div>
                                                    <img class="img-fluid w-100" src="<?= $res['img']; ?>" alt="<?= $res['nom']; ?>">
                                                </div>
                                                <div class="card-footer d-flex justify-content-between">
                                                    <span>Price : <?= $res['price']; ?> $</span>

                                                    <button class="btn btn-light-info UpdateBtn" value="<?= $res['id']; ?>">Update</button>
                                                    <!-- Button trigger for danger theme modal -->
                                                    <button class="btn btn-light-danger deletebtn" value="<?= $res['id']; ?>" type="button" data-bs-toggle="modal" data-bs-target="#danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END card -->
                                <?php
                                    }
                                }
                                ?>

                                <!-- Begin card -->

                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <h4 class="card-title">Add New Talent</h4>

                                                </div>
                                                <img class="img-fluid w-100" src="assets/images/samples/plus_PNG106.png" alt="Add Talent" style="width: 415px;max-height: 350px;">
                                            </div>
                                            <div class="card-footer d-flex justify-content-between">
                                                <span>Add Talent</span>

                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- END card -->



                            </div>


                        </section>





                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Delting Modal -->
    <div class="modal-danger me-1 mb-1 d-inline-block">
        <!--Danger theme Modal -->
        <div class="modal fade text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title white" id="myModalLabel120">
                            Delete Talent
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure u want to delete this talent?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" name="delete" class="btn btn-danger ml-1 " id="delete" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deleting Modal -->


    <!-- Update Modal -->
    <div class="modal fade text-left" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Update Talent </h4>

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
                <form id="updatetalent">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <label>Talent Name: </label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>

                        <label>Talent Image</label>
                        <div class="form-group ">
                            <input type="file" class="form-control form-control-md" accept="image/jpeg ,image/png ,image/jpg" name="updated_img" id="updated_img" required>
                            <div class="form-control-icon">
                            </div>
                        </div>

                        <label>Price: </label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="price" id="price" required>
                        </div>
                        <label>Description: </label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="description" id="description" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" onclick="window.location.reload();">
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

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/extensions/sweetalert2.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="assets/js/jquery.min.js"></script>

    <script>
        // Get data to modal
        $(document).on('click', '.UpdateBtn', function() {
            var talent_id = $(this).val();
            //alert(talent_id);
            $.ajax({
                type: "GET",
                url: "code.php?talent_id=" + talent_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.stat == 404) {
                        alert(res.message);
                    } else if ((res.stat == 200)) {
                        $('#id').val(res.data.id);
                        $('#name').val(res.data.nom);
                        $('#price').val(res.data.price);
                        $('#description').val(res.data.description);
                        $('#UpdateModal').modal('show');
                    }
                }
            });
        });
        // update talent from modal
        $(document).on('submit', '#updatetalent', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('update_talent', true);
            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.stat == 500) {

                        //alert(res.status);
                        Swal.fire({
                            icon: "error",
                            title: res.status
                        })

                    } else if ((res.stat == 200)) {

                        //alert(res.message);
                        Swal.fire({
                            icon: "success",
                            title: res.message
                        })
                        $('#UpdateModal').modal('hide');

                    }
                }
            });
        });
        // Delete talent from modal
        $(document).on('click', '.deletebtn', function() {
            var talent_id = $(this).val();
            //alert(talent_id);
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_talent': true,
                        'talent_id': talent_id
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.stat == 500) {
                            alert(res.message);

                        } else {
                            alert(res.message);
                            window.location.reload();

                        }
                    }
                });


            });

        });
    </script>
    <script defer>
        // Get the input element where the user will enter the search query
        var searchInput = document.querySelector('#search');

        // Add an event listener that will be called whenever the user types in the input
        searchInput.addEventListener('input', function() {
            // Get the search query from the input element
            var title = this.value;

            // Filter the cards
            filterCards(title);
        });

        // This is the same filterCards function as in the previous examples
        function filterCards(title) {
            // Get all of the cards
            var cards = document.querySelectorAll('.card');

            // Loop through each card
            for (var i = 0; i < cards.length; i++) {
                var card = cards[i];

                // Get the title element of the card
                var cardTitle = card.querySelector('.card-title');

                // If the title of the card matches the search query, show the card
                if (cardTitle.textContent.toLowerCase().includes(title.toLowerCase())) {
                    card.style.display = 'block';
                } else {
                    // Otherwise, hide the card
                    card.style.display = 'none';
                }
            }
        }
    </script>
</body>



</html>