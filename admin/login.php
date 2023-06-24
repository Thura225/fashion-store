<?php
session_start();
error_reporting(1);
include('connection.php');
if (isset($_POST['login'])) {
    $admin_email = $_POST['email'];

    $sql = "SELECT * FROM admin WHERE email='$admin_email'";
    $q = mysqli_query($con, $sql);
    $obj = mysqli_fetch_object($q);
    $email = $obj->email;
    $pass = $obj->password;
    if ($email = $_POST['email'] && $pass = $_POST['password']) {
        $_SESSION['admin-name'] = 'Admin';
        $_SESSION['admin-email'] = $admin_email;
        header('location:index.php');
    } else {
        $err = "You are not admin!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/index.css" />
</head>

<body>
    <a href='../index.php' class='btn btn-danger m-2'>Go back to user's site!</a>
    <form class='mt-5 mx-auto p-5 w-75 shadow-lg' method="post">
        <h2>Admin Login</h2>
        <div>
            <?php echo "<font color='red'>$err</font>" ?>
        </div>
        <div>
            <label>Email</label><br>
            <input type="email" name="email" placeholder="Enter your email" />
        </div>
        <div>
            <label>Password </label><br>
            <input type="password" name="password" placeholder="Enter your password" />
        </div><br>
        <input type="submit" name="login" value="Login" class="btn btn-primary" />
    </form>
</body>

</html>