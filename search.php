<?php
session_start();
error_reporting(1);
include('connection.php');


$query = "SELECT * FROM products";
$products = mysqli_query($con,$query);
while (list($id, $name, $type, $img, $description, $price, $stock) = mysqli_fetch_array($products)) {
    if (isset($_GET[$id])) {
        if ($_SESSION['email'] == '') {
            $err = "<div class='alert alert-warning text-center'>You need to login first!</div>";
        } else {
            $customer = $_SESSION['name'];
            $order_name = $name;
            $order_price = $price;
            $order_id = 'ord' . rand(1111, 9999);
            $ordersql = "INSERT INTO carts VALUES ('$order_id','$customer','$order_name','$img','$order_price')";
            mysqli_query($con,$ordersql);
            $updatestocks = $stock - 1;
            $updateproduct = "UPDATE products SET product_stocks='$updatestocks' WHERE product_id='$id'";
            $val = mysqli_query($con,$updateproduct);
            header('location:cart.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="css/index.css" />
</head>

<body class='bg-secondary'>
    <header class=" w-100 d-flex flex-row bg-primary justify-content-between shadow-lg">

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
        } else {
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM profile WHERE user_email='$email'";
            $val = mysqli_query($con,$sql);
            $obj = mysqli_fetch_object($val);
            $img = $obj->img; ?>
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
    <?php echo @$err ?>
    <h1 class='mx-3 my-2 text-center'>Search</h1>
    <div class='mt-3 p-3'>
        <form class='d-flex flex-row' method='get'>
            <input class='w-100 mx-3' type='text' name='search' />
            <input class='mx-2 btn btn-success' type='submit' name='submit-search' />
        </form>
    </div>
    <main class='mt-3 p-3 d-flex flex-column flex-lg-row flex-wrap justify-content-start'>

        <?php
        if (isset($_GET['submit-search'])) {
            $search = mysqli_real_escape_string($con,$_GET['search']);
            // include('connection.php');
            $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%' OR product_type LIKE '%$search%' OR product_description LIKE '%$search%'";
            $sqldata = mysqli_query($con,$sql);
            $query_result = mysqli_num_rows($sqldata);
            if ($query_result > 0) {
                while (list($id, $name, $type, $img, $description, $price, $stock) = mysqli_fetch_array($sqldata)) {
                    echo "<div class='card border-0 shadow-lg'>";
                    echo "<div class='card-header border-0 bg-primary'>";
                    echo "<h3 class='card-title text-white'>$name</h3>";
                    echo '</div>';
                    echo "<div class='card-body d-flex flex-column flex-lg-row border-0'>";
                    echo "<img class='card-image me-lg-2' src='admin/$img' />";
                    echo "<div class='d-flex flex-column justify-content-between'>";
                    echo "<p class='card-paragraph fs-5'>$description</p>";
                    echo "<div>";
                    echo "<span>Type:$type</span><br>";
                    echo "<span>Price:$$price</span><br>";
                    echo "</div>";
                    echo "</div>";
                    echo '</div>';
                    echo "<div class='card-footer border-0'>";
                    echo "<form method='get'>";
                    echo "<input type='submit' value='Add To Cart' class='btn btn-primary' name='$id' />";
                    echo "</form>";
                    echo '</div>';
                    echo '</div>';
                }
            }else{
                echo "<font color='red' class='text-center'>No Result</font>";
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