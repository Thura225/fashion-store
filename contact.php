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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/index.css" />
</head>

<body>
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
    <main class='mt-3 mb-5 p-3 d-flex flex-column flex-lg-row flex-wrap justify-content-start'>
        <div class='w-100 mx-lg-auto'>
            <h1 class='text-center my-5'>Contact Form</h1>
            <p class='text-center fs-4 fw-700'>If you want to give some feedback or have an issue, feel free use that
                form below...</p>
            <?php if ($_SESSION['email'] == '') {
                echo "<div class='text-center'><a href='login.php' class='text-center text-danger'>Please login first<a></div>";
            } else { ?>
                <form action="sendcontact.php" method='post'
                    class=' rounded d-block w-lg-75 text-start mx-auto bg-primary text-light px-5 py-4'>
                    <label class='fs-4'>User:
                        <?php echo $_SESSION['name'] ?>
                    </label><br><br>
                    <label class='fs-4'>Title</label><br>
                    <input type='text' name='title' class='w-100' placeholder="Enter Title" /><br><br>
                    <label class='fs-4'>Content</label><br>
                    <textarea class='fs-4 w-100' name="content" cols="30" rows="10"></textarea><br><br>
                    <input class='fs-4 btn btn-success' type="submit" value="Send" name='send'>
                </form>
            <?php } ?>
        </div>
    </main>
    <footer class='bg-primary py-1 position-fixed start-0 bottom-0 w-100'>
        <p class='text-success fs-4 mt-2 text-center'>Created by <a href='#' class='text-white text-decoration-none'>Aung Thura Tun</a></p>
    </footer>
    <script src="js/index.js"></script>
</body>

</html>