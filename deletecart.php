<?php
session_start();
error_reporting(1);
include('connection.php');
$user = $_SESSION['name'];
$sql = "SELECT * FROM carts WHERE customer='$user'";
$sqldata = mysqli_query($con, $sql);
while (list($id, $customer, $name, $img, $price) = mysqli_fetch_array($sqldata)) {
    if (isset($_GET[$id])) {
        $del_sql = "DELETE FROM carts WHERE order_id='$id'";
        $del = mysqli_query($con, $del_sql);
        header('location:cart.php');
    }
}
?>