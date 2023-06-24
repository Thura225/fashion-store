<?php
session_start();
error_reporting(1);
include('connection.php');
if ($_SESSION['email'] == '') {
    header('location:login.php');
} else {
    
    $user = $_SESSION['name'];
    $sql = "SELECT * FROM carts WHERE customer='$user'";
    $sqldata = mysqli_query($con,$sql);
    while (list($id, $customer, $name,$img, $price) = mysqli_fetch_array($sqldata)) {
        if(isset($_POST[$id])){
                $address = $_POST['address'];
                $credit = $_POST['credit'];
                $data = "INSERT INTO orders VALUES ('$id','$customer','$name','$img','$price','$address','$credit')";
                $val = mysqli_query($con,$data);
                $sql = "DELETE FROM carts WHERE order_id='$id'";
                $del = mysqli_query($con,$sql);
                header('location:index.php');
        }else{
            continue;
        } 
    }
}    
?>