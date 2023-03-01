<?php
session_start();
include 'Connect.php';
if (isset($_GET['talent_id'])) {

    $talent_id = mysqli_real_escape_string($con, $_GET['talent_id']);

    $query1 = "SELECT * FROM talents WHERE id ='$talent_id' ";
    $query_run1 = mysqli_query($con, $query1);

    if (mysqli_num_rows($query_run1) == 1) {
        $task1 = mysqli_fetch_array($query_run1);
        $res = [
            'stat' => 200,
            'message' => 'Talent Found by Id',
            'data' => $task1
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'stat' => 404,
            'message' => 'Talent Id not found'
        ];
        echo json_encode($res);
        return false;
    }
}

if (isset($_POST['update_talent'])) {

    $talent_id = $_POST['id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $updated_img = $_FILES['updated_img']['name'];
    $updated_img_tmp_name = $_FILES['updated_img']['tmp_name'];
    $updated_img_folder = 'uploaded_card_img/' . $updated_img;

    $sql = mysqli_query($con, "SELECT * FROM `talents` WHERE id = '$talent_id' ");
    if (mysqli_num_rows($sql) > 0) {
        foreach ($sql as $res) {

            $old_card_img = $res['img'];
        }
    }

    $update = "UPDATE talents SET nom ='$name',price = '$price', description='$description' , img = '$updated_img_folder' WHERE id = '$talent_id'";
    $resut = mysqli_query($con, $update);



    if ($resut) {
        $res = [
            'stat' => 200,
            'message' => 'Talent updated succesfully'
        ];
        unlink($old_card_img);
        move_uploaded_file($updated_img_tmp_name, $updated_img_folder);
        echo json_encode($res);
        return;
    } else {
        $res = [
            'stat' => 500,
            'message' => 'Error,Talent not processed'
        ];
        echo json_encode($res);
        return false;
    }
}


if(isset($_POST['delete_talent'])){

    $talent_id = $_POST['talent_id'];
    $img = mysqli_query($con, "SELECT img FROM `talents` WHERE id = '$talent_id' ");
    if (mysqli_num_rows($img) > 0) {
        foreach ($img as $res) {

            $old_card_img = $res['img'];
        }
    }

    $sql="DELETE FROM talents WHERE id = '$talent_id'";
    $resut=mysqli_query($con, $sql);
    if($resut){
        $res = [
            'stat' => 200,
            'message' => 'Talent Deleted Succesfully',
        ];
        unlink($old_card_img);
        echo json_encode($res);
        return ;   

    }
    else{
        $res = [
            'stat' => 500,
            'message' => 'Talent not Deleted'
        ];

        echo json_encode($res);
        return false;   
    }
}


?>