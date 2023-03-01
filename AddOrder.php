<?php
session_start();
include 'Connect.php';



if (isset($_POST['save_order'])) {
    $talent_id =  $_POST['tid'];
    $sql = mysqli_query($con, "SELECT talent_owner,nom FROM talents WHERE id = '$talent_id' ");
    if (mysqli_num_rows($sql) > 0) {
        foreach ($sql as $res) {

            $id_owner  = $res['talent_owner'];
            $talent_name = $res['nom'];
        }
    }
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $number = mysqli_real_escape_string($con, $_POST['number']);


    $query =  "INSERT INTO `orders` (name_client,email,talent_name,talent_owner,number,status) VALUES( '$username','$email','$talent_name','$id_owner','$number','Pending' )";
    $insert = mysqli_query($con, $query);

    if ($insert) {
        $res = [
            'stat' => 200,
            'message' => 'Order Added succesfully'
        ];
        echo json_encode($res);
        return;
        // header('location:Orders.php');
    } else {
        $res = [
            'stat' => 500,
            'message' => 'Error'
        ];
        echo json_encode($res);
        return false;
    }
}
