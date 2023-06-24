<?php
session_start();
error_reporting(1);
include('connection.php');
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ph_no = $_POST['ph_no'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($password1 == $password2) {
        $sql = "INSERT INTO users VALUES ('','$name','$email','$ph_no','$password2')";
        if (mysqli_query($con,$sql)) {
            $profile_sql = "INSERT INTO profile VALUES ('','img/unknown.jpg','$email')";
            mysqli_query($con,$profile_sql);
            header('location:login.php');
        } else {
            $err = "<div class='alert alert-warning'>
            <font color='red'>User already exists</font>
        </div>";
        }
    } else {
        $err = "<div class='alert alert-warning'>
        <font color='red'>Confim password doesn't match</font>
    </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                <li class='nav-item'><a href="search" class='nav-link text-white'>Search</a></li>
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
    <main class='mt-3 p-3 d-flex flex-column flex-lg-row flex-wrap justify-content-start'>
        <form class='mt-5 mx-auto shadow-lg p-3 rounded' method="post">
            <h2 class='text-start my-2'>Register</h2>
                <?php
                echo $err;
                ?>
            <div class='mb-3'>
                <label>Name</label><br>
                <input type="text" name="name" placeholder="Enter your name" required />
            </div>
            <div class='mb-3'>
                <label>Email</label><br>
                <input type="email" name="email" placeholder="Enter your email" required />
            </div>
            <div class='mb-3'>
                <label>Phone Number</label><br>
                <input type="text" name="ph_no" placeholder="Enter your ph number" required />
            </div>
            <div class='mb-3'>
                <label>Password </label><br>
                <input type="password" name="password1" placeholder="Enter your password" required />
            </div>
            <div class='mb-3'>
                <label>Confirm Your Password</label><br>
                <input type="password" name="password2" placeholder="Confirm your password" required />
            </div><br>
            <input type="submit" name="register" value="Register" class="btn btn-primary" />
            <p>Already have an account? <a href="login.php">Login Now</a></p>
        </form>
    </main>
    <footer class='position-absolute bottom-0 start-0 w-100 d-flex flex-row bg-primary m-0'>
        <div class='w-50 d-flex justify-content-center align-items-center p-3'>
            <p class='m-0 text-white'>Owned by <a href='#' class='text-success'>Fashion Store</a></p>
        </div>
        <div class='w-50 d-flex justify-content-center align-items-center p-3'>
            <p class='m-0 text-white'>Created by <a href='#' class='text-info'>Aung Thura Tun</a></p>
        </div>
    </footer>
    <script src="js/index.js"></script>
</body>

</html>