<?php
session_start();
error_reporting(1);
if ($_SESSION['admin-email'] == 'admin@gmail.com') {
    include('connection.php');
    $query = "SELECT * FROM products";
    $products = mysqli_query($con, $query);
    while (list($id, $name, $type, $img, $description, $price, $stock) = mysqli_fetch_array($products)) {
        if (isset($_POST[$id])) {
            $u_stocks = $_POST['update-stocks'];
            $u_price = $_POST['update-price'];
            $stock = $u_stocks;
            $price = $u_price;
            $update_query = "UPDATE products SET product_price='$price', product_stocks='$stock' WHERE product_id='$id'";
            mysqli_query($con, $update_query);
            header('location:index.php');
        }
    }
} else {
    header('location:login.php');
} ?>