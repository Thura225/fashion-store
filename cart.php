<?php
session_start();
error_reporting(1);
include('connection.php');


$email = $_SESSION['email'];
$sql = "SELECT * FROM profile WHERE user_email='$email'";
$val = mysqli_query($con, $sql);
$obj = mysqli_fetch_object($val);
$img = $obj->img;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/index.css" />
</head>

<body class='bg-secondary'>
    <header class="w-100 d-flex flex-row bg-primary justify-content-between shadow-lg">

        <nav class="navbar navbar-expand-lg w-75">
            <div class='container'>
                <a href='#' class="navbar-brand text-decoration-none text-white fs-1">FASHION STORE</a>
            </div>
            <ul class='navbar-nav d-none d-lg-flex'>
                <li class='nav-item'><a href="index.php" class='nav-link text-white'>Home</a></li>
                <li class='nav-item'><a href="search.php" class='nav-link text-white'>Search</a></li>
                <li class='nav-item'><a href="cart.php" class='nav-link text-white'>Cart</a></li>
                <li class='nav-item'><a href="contact.php" class='nav-link text-white'>Contact</a></li>
            </ul>
        </nav>
        <?php if ($_SESSION['email'] == '') {
            echo "<div class='profile w-25 d-flex justify-content-center align-items-center'><a href='login.php' class='text-decoration-none text-light'>Login</a></div>";
        } else { ?>
            <div class='profile w-25 d-none d-lg-flex justify-content-center align-items-center position-relative'>
                <a href="#" class="text-decoration-none"><img class="profile-img" src=<?php echo 'profile/' . $img ?>
                        alt=""></a>
                <div class='p-3 w-50 dropdown-profile position-absolute flex-column bg-light'>
                    <a href='profile/index.php' class='text-decoration-none'>Profile</a>
                    <hr />
                    <a href='logout.php' class='text-decoration-none'>Logout</a>
                </div>
            </div>
        <?php } ?>
        <div id='side-btn' class='side-btn m-auto d-block d-lg-none'>
            <div class='menu'></div>
            <div class='menu'></div>
            <div class='menu'></div>
        </div>
    </header>
    <div id='side' class='side position-fixed top-0 start-0 d-none d-lg-none justify-content-end w-100 h-100'>
        <div class='sidebar w-50 h-100 bg-dark'>
            <div class='d-flex flex-row justify-content-end'>
                <span id='close' class='text-end fs-3 text-white mx-2'>&#x2715;</span>
            </div>

            <?php
            if ($_SESSION['email'] == '') {
                ?>
                <div class='d-flex flex-column align-items-center p-5'>
                    <img class='profile-img' src='profile/img/unknown.jpg' />
                    <a href='login.php' class='text-white mt-3 fs-4'>Login</a>
                </div>
                <hr class='text-white'>
                <ul class='list-group m-0'>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="index.php" class='text-decoration-none text-white'>Home</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="search.php" class='text-decoration-none text-white'>Search</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="cart.php" class='text-decoration-none text-white'>Cart</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="contact.php" class='text-decoration-none text-white'>Contact</a>
                    </li>
                </ul>
            <?php } else { ?>
                <div class='d-flex flex-column align-items-center p-5'>
                    <img class='profile-img' src=<?php echo 'profile/' . $img ?> />
                    <span class='text-white mt-3 fs-4'>
                        <?php echo $_SESSION['name'] ?>
                        <span>
                </div>
                <hr class='text-white'>
                <ul class='list-group m-0'>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="index.php" class='text-decoration-none text-white'>Home</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="profile/index.php" class='text-decoration-none text-white'>Profile</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="search.php" class='text-decoration-none text-white'>Search</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="cart.php" class='text-decoration-none text-white'>Cart</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="contact.php" class='text-decoration-none text-white'>Contact</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="logout.php" class='text-decoration-none text-white'>Logout</a>
                    </li>
                </ul>
            <?php } ?>


        </div>
    </div>
    <h1 class='mx-3 my-2 text-center'>Carts</h1>
    <main class='mt-3 mb-5 p-3 d-flex flex-column justify-content-start'>
        <?php
        if ($_SESSION['email'] == '') {
            ?>
            <div class='text-center'><a href='login.php' class='text-center text-danger'>Please login first<a></div>

        <?php } else {
            // include('connection.php');
            $user = $_SESSION['name'];
            $sql = "SELECT * FROM carts WHERE customer='$user'";
            $sqldata = mysqli_query($con, $sql);
            while (list($id, $customer, $name, $img, $price) = mysqli_fetch_array($sqldata)) {
                echo "<div class='cart-item p-3 d-flex justify-content-between'>";
                echo "<div class='d-flex flex-row'>";
                echo "<img src='admin/$img' width=100 height=150 class='me-3' />";
                echo "<div>";
                echo "<h3>$name</h3>";
                echo "<span>Price:$$price</span>";
                echo "</div>";
                echo "</div>";
                echo "<div class='d-flex align-self-center'>";
                echo "<form action='addorder.php' method='post'>";
                echo "<input type='submit' name='$id' value='Buy' class='btn btn-success mx-2'/>";
                echo "</form>";
                echo "<form action='deletecart.php' method='get'>";
                echo "<input type='submit' name='$id' value='Cancel' class='btn btn-danger mx-2'/>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
    </main>
    <footer class='bg-primary py-1 position-fixed start-0 bottom-0 w-100'>
        <p class='text-success fs-4 mt-2 text-center'>Created by <a href='#' class='text-white text-decoration-none'>Aung Thura Tun</a></p>
    </footer>
    <script src="js/index.js"></script>
</body>

</html>