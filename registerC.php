<?php
include 'Connect.php';
if (isset($_POST['submit']) || isset($_POST['pimg'])) {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
  $mail = mysqli_real_escape_string($con, $_POST['mail']);
  $img = $_FILES['pimg']['name'];
  $img_tmp_name = $_FILES['pimg']['tmp_name'];
  $img_folder = 'uploaded_Profile_img/' . $img;

  $sql = mysqli_query($con, "SELECT * FROM `users` WHERE username ='$username' AND password= '$password' ");
  if (mysqli_num_rows($sql) > 0) {
    $message[] = ' User Already exists';
  } else {
    if ($password != $cpassword) {
      $message[] = ' Password mismatch';
    } else {
      $query =  "INSERT INTO `users` (username,email,password,user_level,img) VALUES( '$username','$mail','$password',2,'$img_folder')";
      $insert = mysqli_query($con,$query);

      if ($insert) {
        move_uploaded_file($img_tmp_name, $img_folder);
        $message[] = ' Signed-up Succesfully';
         header('location:Login1.php');
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
    <title>Register Client</title>
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
                        <h4 class="fw-bold"> create your Client Account 🔥</h4>
                        <p class="text-secondary-500 lg-text-rg mb-5">Please input your field here</p>
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
                        <form method="post" class="needs-validation" enctype="multipart/form-data">
                            <div class="form-group mb-4">
                                <input type="file" class="form-control form-control-md"  name="pimg">
                                <div class="invalid-feedback animate__animated animate__headShake">
                                    <i class="bi bi-exclamation-circle-fill pe-1 pt-2"></i>Please input your profile picture
                                </div>
                                <div class="valid-feedback animate__animated animate__bounceIn">
                                    <i class="bi bi-check-circle-fill pe-1 pt-2"></i>
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="email" class="form-control form-control-md" id="validationEmail" placeholder="Email" required name="mail">
                                <div class="invalid-feedback animate__animated animate__headShake">
                                    <i class="bi bi-exclamation-circle-fill pe-1 pt-2"></i>Please input your email
                                </div>
                                <div class="valid-feedback animate__animated animate__bounceIn">
                                    <i class="bi bi-check-circle-fill pe-1 pt-2"></i>
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control form-control-md" id="validationEmail" placeholder="Username" required name="username">
                                <div class="invalid-feedback animate__animated animate__headShake">
                                    <i class="bi bi-exclamation-circle-fill pe-1 pt-2"></i>Please input your username
                                </div>
                                <div class="valid-feedback animate__animated animate__bounceIn">
                                    <i class="bi bi-check-circle-fill pe-1 pt-2"></i>
                                    Looks good!
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <input type="password" class="form-control form-control-md" id="password" placeholder="Password" required name="password">
                                <div class="invalid-feedback animate__animated animate__headShake">
                                    <i class="bi bi-exclamation-circle-fill pe-1 pt-2"></i>Please input your password
                                </div>
                                <div class="valid-feedback animate__animated animate__bounceIn">
                                    <i class="bi bi-check-circle-fill pe-1 pt-2"></i>
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control form-control-md" id="confirmPassword" placeholder="Confirm Password" required name="cpassword">
                                <div class="invalid-feedback animate__animated animate__headShake">
                                    <i class="bi bi-exclamation-circle-fill pe-1 pt-2"></i>Please input confirm your
                                    password
                                </div>
                                <div class="valid-feedback animate__animated animate__bounceIn">
                                    <i class="bi bi-check-circle-fill pe-1 pt-2"></i>
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <button class="w-100 btn btn-lg btn-primary lg-text-md" type="submit" name="submit">Sign
                                    Up</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="text-center">
                    <span class="md-text-rg">Already have an account?<a href="Login1.php" class="fw-bold"> Sign
                            In</a></span>
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