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
    <title>Talent Overview</title>
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <!-- Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css" />



    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/orders.css">

</head>
<style>
    body {
        background-color: #F8F9FA;
    }

    .btn-light-primary {
        background-color: #ebf3ff;
        color: #002152
    }

    .navbar {
        height: 90px;
        padding: 1.5rem
    }

    .burger-btn {
        display: none
    }

    .navbar .user-menu img {
        width: 39px;
        height: 39px
    }

    .dropdown-menu {
        box-shadow: 0 0 30px rgba(0, 0, 0, .03)
    }

    .avatar {
        display: inline-flex;
        border-radius: 50% !important;
        text-align: center;
        vertical-align: middle;
        position: relative
    }

    .text-gray-600 {
        color: #6c757d !important
    }

    .text-sm {
        font-size: .875rem
    }

    @media only screen and (min-width: 768px) and (max-width: 990px) {
        .nav2 {
            padding-bottom: 320px;
        }
    }

    .navbarNav {
        float: right !important;

    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="
    padding-left: 15px !important;
    padding-right: 15px !important;
     ">
        <a class="navbar-brand" href="#">
            <img src="assets/assetsindex/images/logo-dark-Recovered.png" alt="" width="150">
        </a>

        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">


                <div class="col-md-6 col-lg-6 col-11 mx-auto my-auto search-box">
                    <div class="input-group form-container">
                        <input type="text" name="search" id="search" class="form-control search-input" placeholder="Search" autofocus="autofcus" autocomplete="off">
                        <span class="input-group-btn" style="padding-left: 10px;">
                            <button type="button" class="btn btn-outline-primary" id="btnSearch" style="border-radius: 5px;">Search</button>
                        </span>
                    </div>
                </div>

                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">

                    <?php
                    if (isset($_SESSION["username"]) || isset($_SESSION["id_user"])) {
                    ?>
                        <header class="mb-3 sticky-top" style="margin-top:1rem; ">
                            <nav class="navbar navbar-expand navbar-light">
                                <div class="container-fluid ">
                                    <a href="#" class="burger-btn d-block">
                                    </a>

                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="nav" style="padding-bottom: .5rem !important;">
                                            <li class="nav-item">
                                                <a class="nav-link active" aria-current="page" href="home.php" style="padding-right: 50px !important;">Browse Talents</a>
                                            </li>


                                        </ul>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT * FROM `users` WHERE id = '" . $_SESSION['id_user'] . "' ");
                                        if (mysqli_num_rows($sql) > 0) {
                                            foreach ($sql as $res) {
                                        ?>
                                                <div class="dropdown ms-auto">
                                                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <div class="user-menu d-flex">
                                                            <div class="user-name text-end me-3">
                                                                <h6 class="mb-0 text-gray-600"><?php echo $_SESSION["username"] ?></h6>
                                                                <p class="mb-0 text-sm text-gray-600"><?php echo $res['user_level'] == 1 ?  'Etudiant' : 'Client'; ?></p>
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
                                                            <li><a class="dropdown-item" href="Logout.php"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                                                    </ul>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                </div>
    </nav>
    </header>
<?php
                    } else {
?>
    <a href="home.php" class="btn btn-primary" style="border-radius: 10px;margin-left: 30px;padding-left: 30px;padding-right: 30px;padding-top: 10px;padding-bottom: 10px;">Enroll</a>
<?php
                    }

?>


          
</div>
</div>
</div>
</nav>

<!-- navbar2 -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding-left: 220px !important;padding-right: 15px !important;">
    <div class="container-fluid nav2 ">

        <ul class="navbar-nav  d-flex justify-content-around">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Graphics & Design
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 999;">
                    <li><a class="dropdown-item" href="#">Logo & Brand Identity</a></li>
                    <li><a class="dropdown-item" href="#">Gaming</a></li>
                    <li><a class="dropdown-item" href="#">Web & App Design</a></li>
                    <li><a class="dropdown-item" href="#">Marketing Design</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Art & Illustration</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Digital Marketing
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 999;">
                    <li><a class="dropdown-item" href="#">Logo & Brand Identity</a></li>
                    <li><a class="dropdown-item" href="#">Gaming</a></li>
                    <li><a class="dropdown-item" href="#">Web & App Design</a></li>
                    <li><a class="dropdown-item" href="#">Marketing Design</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Art & Illustration</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Writing & Translation
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 999;">
                    <li><a class="dropdown-item" href="#">Logo & Brand Identity</a></li>
                    <li><a class="dropdown-item" href="#">Gaming</a></li>
                    <li><a class="dropdown-item" href="#">Web & App Design</a></li>
                    <li><a class="dropdown-item" href="#">Marketing Design</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Art & Illustration</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Video & Animation
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 999;">
                    <li><a class="dropdown-item" href="#">Logo & Brand Identity</a></li>
                    <li><a class="dropdown-item" href="#">Gaming</a></li>
                    <li><a class="dropdown-item" href="#">Web & App Design</a></li>
                    <li><a class="dropdown-item" href="#">Marketing Design</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Art & Illustration</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Music & Audio
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 999;">
                    <li><a class="dropdown-item" href="#">Logo & Brand Identity</a></li>
                    <li><a class="dropdown-item" href="#">Gaming</a></li>
                    <li><a class="dropdown-item" href="#">Web & App Design</a></li>
                    <li><a class="dropdown-item" href="#">Marketing Design</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Art & Illustration</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Programming & Tech
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 999;">
                    <li><a class="dropdown-item" href="#">Logo & Brand Identity</a></li>
                    <li><a class="dropdown-item" href="#">Gaming</a></li>
                    <li><a class="dropdown-item" href="#">Web & App Design</a></li>
                    <li><a class="dropdown-item" href="#">Marketing Design</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Art & Illustration</a></li>
                </ul>
            </li>




        </ul>
    </div>
    </div>
</nav>
<!-- End Navbar -->

<!-- Main -->

<?php
$talent_id = $_GET["talent_id"];

$sql = mysqli_query($con, "SELECT * FROM `talents` WHERE id = '$talent_id' ");
if (mysqli_num_rows($sql) > 0) {
    foreach ($sql as $res) {
?>
        <section class="product-slider-section">
            <div class="container">
                <div id="productslider" class="carousel slide">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="carousel-inner">

                                        <div class="carousel-item active zoom-image">
                                            <img src="<?= $res['img']; ?>" class="img-fluid">
                                            <span class="sale-span">Sale</span>

                                        </div>





                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4" style="top: 2rem;">
                            <h3 class="product-name"><?= $res['nom']; ?></h3>
                            <p class="price">
                                <span class="new-price">$<?= $res['price']; ?></span>
                            </p>
                            <p>
                                <?php
                                ?>
                            </p>

                            <p>
                            <?= $res['description']; ?>
                            </p>

                            <div class="d-flex">
                                <a href="Checkout.php?talent_id=<?= $talent_id ?>"><button type="submit" class="add-to-cart-btn" src="">
                                        <span> Continue</span>
                                    </button></a>

                            </div>


                        </div>
                    </div>
                </div>
        </section>

        <?php }
} ?>
        <?php
            $owner = mysqli_query($con, "SELECT u.username ,u.email , u.description ,u.img FROM `users`u ,talents t where  t.talent_owner = u.id and t.id = '$talent_id' ");
            if (mysqli_num_rows($owner) > 0) {
                foreach ($owner as $res) {
        ?>
        <main class="container">




            <div class="row g-5">
                <div class="col-md-8">
                    <h3 class="pb-4 mb-4 fst-italic border-bottom">
                        About the owner of this This Talent
                    </h3>

                    <article class="blog-post">
                        <h2 class="blog-post-title">Made By   <a href="mailto:<?= $res['email']; ?>"><?= $res['username']; ?></a></h2>
                        <p class="blog-post-meta"></p>

                        <p><?= $res['username']; ?>'s Description :</p>
                        
                        <p><?= $res['description']; ?></p>
                        <h2>Some More Talents</h2>
                        <div id="main-content pt-4" style="box-sizing: content-box">
            <div class="w-100">
                <div class="container">
                    <div class="row">
                        <section id="content-types">
                            <div class="row">
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM `talents`where id!='$talent_id' ORDER BY RAND() LIMIT 3; ");
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
                                                    
                                                    <a class="btn btn-light-primary view" href="OverView.php?talent_id=<?= $res['id']; ?>">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END card -->
                                <?php
                                    }
                                }
                                ?>

                                



                            </div>


                        </section>





                    </div>
                </div>
            </div>
        </div>
                        
                    </article>


                </div>


               
            </div>


        </main>



        <?php }
} ?>
        






</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>


</html>