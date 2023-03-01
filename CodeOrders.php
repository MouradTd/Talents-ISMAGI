<?php
include 'Connect.php';
if(isset($_GET['order_id'])){
    
    $order_id = mysqli_real_escape_string($con,$_GET['order_id']);
    
    $query1 = "SELECT Id,talent_name , status FROM orders WHERE id ='$order_id' ";
    $query_run1 = mysqli_query($con,$query1);
    
    if(mysqli_num_rows($query_run1) == 1){
        $task1 = mysqli_fetch_array($query_run1);
        $res = [
            'stat' => 200,
            'message' => 'Order Found by Id',
            'data' => $task1
        ];
        echo json_encode($res);
        return false;   

    }
    else{
        $res = [
            'stat' => 404,
            'message' => 'Order Id not found'
        ];
        echo json_encode($res);
        return false;   
    }

}


if(isset($_POST['update_order'])){

    $order_id = $_POST['id'];
    $status=$_POST['status'];
    
    

    if( $status == NULL){
        $res = [
            'stat' => 422,
            'message' => 'All fields must be filled'
        ];
        echo json_encode($res);
        return false;    
    }
    $sql="UPDATE orders SET status ='$status' WHERE Id = '$order_id'";
    $resut=mysqli_query($con, $sql);

    if($resut){
        $res = [
            'stat' => 200,
            'message' => 'Order updated succesfully'
        ];
        echo json_encode($res);
        return ; 
    }
    else{
        $res = [
            'stat' => 500,
            'message' => 'Erreur'
        ];
        echo json_encode($res);
        return false; 
    }



}


if(isset($_POST['reject_order'])){

    $order_id = $_POST['order_id'];
    

    $sql="UPDATE orders SET status ='Rejected' WHERE Id = '$order_id'";
    $resut=mysqli_query($con, $sql);
    if($resut){
        $res = [
            'stat' => 200,
            'message' => 'Order Rejected Succesfully',
        ];
        
        echo json_encode($res);
        return ;   

    }
    else{
        $res = [
            'stat' => 500,
            'message' => 'Order not Rejected'
        ];

        echo json_encode($res);
        return false;   
    }
}



// Custom order

if(isset($_GET['custom_order_id'])){
    
    $custom_order_id = mysqli_real_escape_string($con,$_GET['custom_order_id']);
    
    $query1 = "SELECT id,talent_name , status FROM custom WHERE id ='$custom_order_id' ";
    $query_run1 = mysqli_query($con,$query1);
    
    if(mysqli_num_rows($query_run1) == 1){
        $task1 = mysqli_fetch_array($query_run1);
        $res = [
            'stat' => 200,
            'message' => 'Order Found by Id',
            'data' => $task1
        ];
        echo json_encode($res);
        return false;   

    }
    else{
        $res = [
            'stat' => 404,
            'message' => 'Order Id not found'
        ];
        echo json_encode($res);
        return false;   
    }

}
if(isset($_POST['update_custom_order'])){

    $order_id = $_POST['Cid'];
    $status=$_POST['Cstatus'];
    
    

    if( $status == NULL){
        $res = [
            'stat' => 422,
            'message' => 'All fields must be filled'
        ];
        echo json_encode($res);
        return false;    
    }
    $sql="UPDATE custom SET status ='$status' WHERE id = '$order_id'";
    $resut=mysqli_query($con, $sql);

    if($resut){
        $res = [
            'stat' => 200,
            'message' => 'Custom Order updated succesfully'
        ];
        echo json_encode($res);
        return ; 
    }
    else{
        $res = [
            'stat' => 500,
            'message' => 'Erreur'
        ];
        echo json_encode($res);
        return false; 
    }



}

if(isset($_POST['reject_custom_order'])){

    $order_id = $_POST['custom_order_id'];
    

    $sql="UPDATE custom SET status ='Rejected' WHERE Id = '$order_id'";
    $resut=mysqli_query($con, $sql);
    if($resut){
        $res = [
            'stat' => 200,
            'message' => ' Custom Order Rejected Succesfully',
        ];
        
        echo json_encode($res);
        return ;   

    }
    else{
        $res = [
            'stat' => 500,
            'message' => 'Custom Order not Rejected'
        ];

        echo json_encode($res);
        return false;   
    }
}