<?php
include 'Connect.php';
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["id_user"])) {
  header("location:Login1.php");
} else {
  $talent_id = $_GET["talent_id"];

 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>navbar</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/orders.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <main>
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="assets/assetsindex/images/logo-dark-Recovered.png" alt="" width="150" height="57">
        <h2>Checkout form</h2><br>
        <p class="lead">Fill out this Form to start your Order.</p>
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

      <div class="row g-5">

        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Checkout Form :</h4>
          <form class="needs-validation" id="saveorder">
            <div class="row g-3">
              <input type="hidden" value="<?php echo $talent_id;?>" name="tid">
              <div class="col-12">
                <label for="username" class="form-label">Username : </label>
                <input type="text" class="form-control" id="username" name="username">

              </div>



              <div class="col-12">
                <label for="email" class="form-label">Email :</label>
                <div class="input-group has-validation">
                  <span class="input-group-text">@</span>
                  <input type="email" class="form-control" id="email" name="email" required>

                </div>
              </div>
              <?php


              $sql = mysqli_query($con, "SELECT u.username ,t.nom FROM `users`u ,talents t where  t.talent_owner = u.id and t.id = '$talent_id' ");
              if (mysqli_num_rows($sql) > 0) {
                foreach ($sql as $res) {
              ?>

                  <div class="col-12">
                    <label for="Tname" class="form-label">Talent Name : </label>
                    <input type="text" class="form-control" id="Tname" value="<?= $res['nom']; ?>" name="Tname" disabled>

                  </div>
                  <div class="col-12">
                    <label for="Tname" class="form-label">Talent Owner : </label>
                    <input type="text" class="form-control" id="Tname" value="<?= $res['username']; ?>" disabled>

                  </div>
              <?php }
              } ?>

              <div class="col-12">
                <label for="number" class="form-label">Phone Number :</label>
                <input type="text" class="form-control" id="number" name="number" required>

              </div>
              <br>
              <br>









              <button class="w-100 btn btn-primary btn-lg save" type="submit" value="<?php echo $talent_id ;?>" style="border-radius: 10px;">Order</button>
          </form>
        </div>
      </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; Talents Ismagi</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="index.php#contact">Support</a></li>

      </ul>
    </footer>
  </div>
  <script src="assets/js/jquery.min.js"></script>
 <script>
 
  $(document).on('submit','#saveorder', function(e){
            e.preventDefault(); 

            var formData = new FormData(this);
            formData.append('save_order',true);
            $.ajax({
                type: "POST",
                url: "AddOrder.php",
                data: formData,
                processData:false,
                contentType:false,
                success: function (response) {
                     var res = jQuery.parseJSON(response);
                     if(res.stat == 422)
                     {
                      alert(res.message);
                        
                     }
                     else if((res.stat == 200))
                     {
                      alert(res.message);
                     }
                }
            });
        });
  
 </script>
</body>