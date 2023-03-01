<?php
include 'Connect.php';
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["id_user"])) {
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Talents</title>

    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <!-- Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css" />



    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css" />
    
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

    .card-content img {

        aspect-ratio: 2/2;
        object-fit: contain;
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

                <!-- <form class="input-group input-group-sm ">
                <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form> -->
                <div class="col-md-6 col-lg-6 col-11 mx-auto my-auto search-box">
                    <div class="input-group form-container">
                        <input type="text" name="search" id="search" class="form-control search-input" placeholder="Search" autofocus="autofcus" autocomplete="off">
                        <span class="input-group-btn" style="padding-left: 10px;">
                            <button type="button" class="btn btn-outline-primary" id="btnSearch" style="border-radius: 5px;">Search</button>
                        </span>
                    </div>
                </div>
               
                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav" >

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
                                                <a class="nav-link-lg active" aria-current="page" href="home.php" style="padding-right: 50px !important;">Home</a>
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

        <ul class="navbar-nav  d-flex justify-content-around" >
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

<!-- Main -->
<div class="main">
    <div class="container">
        <div class="row">
            <div class="row g-4">

                <?php
                $sql = mysqli_query($con, "SELECT * FROM `talents` ");
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
                <!-- Begin card -->



            </div>
        </div>
    </div>

</div>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>


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

</html>