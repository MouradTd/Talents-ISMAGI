<?php
include("Connect.php");

session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 0) {
        $message[] = " username or password incorrect";
    } else if ((mysqli_num_rows($result) > 0)) {
        foreach ($result as $row) {
            $_SESSION["username"] = $username;
            $_SESSION["id_user"] = $row["id"];
        }
        header("location:home.php");
    }
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/auth.css">

    <!-- CSS Libraries -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />

</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto my-4">
                <div class="card my-5">
                    <div class="card-body p-5">
                        <h4 class="fw-bold">Hi, Welcome back 👋</h4>
                        <p class="text-secondary-500 lg-text-rg mb-5">Please log in with your correctly</p>
                        <div>
                            <?php
                            if (isset($message)) {
                                foreach ($message as $message) {
                                    echo "
                                     <div class='alert alert-secondary'>$message</div>
                                  ";
                                }
                            }
                            ?>
                        </div>
                        <form method="post" class="needs-validation">
                            <div class="form-group mb-4">
                                <input type="text" class="form-control form-control-md" id="validationEmail" placeholder="Username" name="username" required>
                                <div class="invalid-feedback animate__animated animate__headShake">
                                    <i class="bi bi-exclamation-circle-fill pe-1 pt-2"></i>Please input your email
                                </div>
                                <div class="valid-feedback animate__animated animate__bounceIn">
                                    <i class="bi bi-check-circle-fill pe-1 pt-2"></i>
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="float-end">
                                    <a href="forgot-password.html" class="text-danger md-text-rg"> Forgot password?</a>
                                </label>
                                <input type="password" class="form-control form-control-md" id="validationPassword" placeholder="Password" name="password" required>
                                <div class="invalid-feedback animate__animated animate__headShake">
                                    <i class="bi bi-exclamation-circle-fill pe-1 pt-2"></i>Please input your password
                                </div>
                                <div class="valid-feedback animate__animated animate__bounceIn">
                                    <i class="bi bi-check-circle-fill pe-1 pt-2"></i>
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <button class="w-100 btn btn-primary lg-text-md" type="submit" name="submit">Sign
                                    In</button>
                            </div>
                            <div class="text-center mb-4">
                                <span class="md-text-rg text-secondary-800">Login with social media</span>
                            </div>
                            <div class="form-group mb-4">
                                <button class="w-100 btn btn-outline-light lg-text-md btn-img-auth" type="submit">
                                    <img src="assets/images/icons/google.svg" alt="icons">
                                    Login with Google
                                </button>
                            </div>
                            <div class="form-group mb-4">
                                <button class="w-100 btn btn-outline-light lg-text-md btn-img-auth" type="submit">
                                    <img src="assets/images/icons/github.svg" alt="icons">
                                    Login with Github
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center">
                    <span class="md-text-rg">Don't have an account?<br> Join as a<a href="registerV.php" class="fw-bold">
                            Student </a>or as a <a href="registerC.php" class="fw-bold">
                            Client</a></span>

                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- Template JS FIle -->
    <script src="assets/js/main.js"></script>

    <!-- Js Libraries -->
    <script src="assets/js/jquery.min.js"></script>


</body>

</html>