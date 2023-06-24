<?php
include('connection.php');
if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $img = $_FILES['img']['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        if (file_exists("img" . "/" . $_FILES['img']['name'])) {
            $err = "FIle already exists.";
        } else {
            move_uploaded_file($_FILES['img']['tmp_name'], "img/" . $_FILES['img']['name']);
            $add_query = "INSERT INTO products VALUES ('','$name','$type','img/$img','$description','$price','$stock')";
            mysqli_query($con,$add_query);
            header('location:index.php');
        }
    }

?>