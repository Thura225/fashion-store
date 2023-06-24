<?php
session_start();
include('connection.php');
if ($_SESSION['admin-email'] == 'admin@gmail.com') {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New Product</title>
        <link rel="stylesheet" href="../css/index.css" />
    </head>

    <body class='bg-secondary'>
        <header class="w-100 sticky-top d-flex flex-row bg-primary justify-content-between shadow-lg">

            <nav class="navbar navbar-expand-lg w-75">
                <div class='container'>
                    <a href='#' class="navbar-brand text-decoration-none text-white fs-1">FASHION STORE</a>
                </div>
                <ul class='navbar-nav d-none d-lg-flex'>
                    <li class='nav-item'><a href="index.php" class='nav-link text-white'>Products</a></li>
                    <li class='nav-item'><a href="add_product.php" class='nav-link text-white'>Add New</a></li>
                    <li class='nav-item'><a href="order.php" class='nav-link text-white'>Order</a></li>
                    <li class='nav-item'><a href="feedback.php" class='nav-link text-white'>Feedback</a></li>
                </ul>
            </nav>
            <div class='w-25 d-none d-lg-flex justify-content-center align-items-center'>
                <a href="#" class="text-decoration-none"><img class="profile-img" src="img/unknown.jpg" alt=""></a>
            </div>
            <div id='side-btn' class='side-btn m-auto d-block d-lg-none'>
                <div class='menu'></div>
                <div class='menu'></div>
                <div class='menu'></div>
            </div>
        </header>
        <a href='../index.php' class='btn btn-danger m-2'>Go back to user's site!</a>
        <div id='side' class='side position-fixed top-0 start-0 d-none d-lg-none justify-content-end w-100 h-100'>
            <div class='sidebar w-50 h-100 bg-dark'>
                <div class='d-flex flex-row justify-content-end'>
                    <span id='close' class='text-end fs-3 text-white mx-2'>&#x2715;</span>
                </div>
                <div class='d-flex flex-column align-items-center p-5'>
                    <img class='profile-img' src='' />
                    <span class='text-white mt-3 fs-4'>
                        <?php echo $_SESSION['admin-name'] ?>
                        <span>
                </div>
                <hr class='text-white'>
                <ul class='list-group m-0'>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="index.php" class='text-decoration-none text-white'>Products</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="add_product.php" class='text-decoration-none text-white'>Add New Product</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="order.php" class='text-decoration-none text-white'>Order</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="feedback.php" class='text-decoration-none text-white'>Feedbacks</a>
                    </li>
                    <li class='list-group-item bg-dark m-0 border-0'>
                        <a href="logout.php" class='text-decoration-none text-white'>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <main class='mt-3 p-3 d-flex flex-column flex-lg-row flex-wrap justify-content-start'>
            <div class='px-3 py-5 w-lg-75 mx-auto shadow-lg bg-secondary text-primary rounded'>
                <h1 class='text-center my-5'>Add New Product</h1>
                <form action='add.php' method='post' class="w-100 my-2" enctype="multipart/form-data">
                    <div class='w-75 mx-auto'>
                        <label class='fs-3'>Name</label><br>
                        <input type='text' class="w-100" name='name' placeholder="Enter product name" /><br><br>
                        <label class='fs-3'>Type</label><br>
                        <select class="w-100" name="type">
                            <option value="T-Shirt">T-Shirt</option>
                            <option value="Skirt">Skirt</option>
                            <option value="Trowser">Trowser</option>
                            <option value="Dress">Dress</option>
                            <option value="Sneakers">Sneakers</option>
                            <option value="Shoes">Shoes</option>
                        </select><br><br>
                        <label class='fs-3'>Image</label><br>
                        <input class="w-100" type='file' name='img' /><br><br>
                        <label class='fs-3'>Description</label><br>
                        <textarea class="w-100" name="description" cols="30" rows="10"></textarea><br><br>
                        <label class='fs-3'>Prices</label><br>
                        <input class="w-100" type='number' name='price' placeholder="Enter product price" /><br><br>
                        <label class='fs-3'>Stocks</label><br>
                        <input class="w-100" type='number' name='stock' placeholder="Enter product stocks" /><br><br>
                        <input type='submit' value="Add" name='add'
                            class="px-3 py-2 btn btn-success d-block mx-auto w-50" />
                    </div>

                </form>
            </div>

        </main>
        <footer class='position-absolute bottom-0 start-0 w-100 d-flex flex-row bg-primary m-0'>
            <div class='w-50 d-flex justify-content-center align-items-center p-3'>
                <p class='m-0 text-white'>Owned by <a href='#' class='text-success'>Fashion Store</a></p>
            </div>
            <div class='w-50 d-flex justify-content-center align-items-center p-3'>
                <p class='m-0 text-white'>Created by <a href='#' class='text-info'>Aung Thura Tun</a></p>
            </div>
        </footer>
        <script src="../js/index.js"></script>
    </body>

    </html>
    <?php
} else {
    header('location:login.php');
}
?>