<?php
session_start();
// 

if ($_SESSION['email'] == '') {
    header('location:login.php');
} else {
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
        <title>Add Order</title>
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
        <h1 class='mx-3 my-2 text-center'>Add Order</h1>
        <main class='mt-3 p-3 d-flex flex-column justify-content-start'>
            <?php
            include('connection.php');
            $user = $_SESSION['name'];
            $sql = "SELECT * FROM carts WHERE customer='$user'";
            $sqldata = mysqli_query($con, $sql);
            while (list($id, $customer, $name, $img, $price) = mysqli_fetch_array($sqldata)) {
                if (isset($_POST[$id])) {
                    echo "<div class='d-flex mx-auto shadow-lg p-5'>";
                    echo "<img src='admin/$img' width=100 height=150 class='d-block me-5' />";
                    echo "<div>";
                    echo "<h3>$name</h3><br>";
                    echo "<span>Price: $price</span><br>";
                    echo "</div>";
                    echo "</div>";
                    echo "<form action='submitorder.php' method='post' class='mx-auto p-5 shadow-lg rounded'>
            <h3>Enter your necessary data</h3>
            <label>Enter Address</label><br>
            <textarea class='w-100' name='address'></textarea><br><br>
            <label>Enter Credit Card</label><br>
            <input class='w-100' type='text' name='credit' /><br><br>
            <input class='btn btn-primary' type='submit' value='Order' name='$id'>
        </form>";
                } else {
                    continue;
                }
            }
            ?>

        </main>
        <footer class='position-absolute w-100 d-flex flex-row bg-primary m-0'>
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
<?php } ?>