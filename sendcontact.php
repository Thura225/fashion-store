<?php
session_start();
error_reporting(1);
include('connection.php');
if (isset($_POST['send'])) {
    $name = $_SESSION['name'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $add_feedback = "INSERT INTO feedback VALUES ('','$name','$title','$content')";
    mysqli_query($con, $add_feedback);
    header('location:index.php');
}
?>