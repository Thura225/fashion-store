<?php
session_start();
error_reporting(1);
if ($_SESSION['admin-email'] == 'admin@gmail.com') {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Feedbacks</title>
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
        <h1 class='mx-3 my-2 text-center'>Feedbacks</h1>
        <main class='mt-3 p-3 d-flex flex-column flex-lg-row flex-wrap justify-content-start'>
            <?php
            include('connection.php');
            $sql = "SELECT * FROM feedback";
            $sqldata = mysqli_query($con,$sql);
            while (list($id, $name, $title, $content) = mysqli_fetch_array($sqldata)) {
                echo "<div class='mx-2 my-3 bg-primary p-3 w-100 shadow-lg'>";
                echo "<p class='text-center text-light'>$name has send feedback!</p>";
                echo "<div class='bg-light p-3'>";
                echo "<h3>$title</h3>";
                echo "<p>$content</p>";
                echo "</div>";
                echo "<form method='get' class='my-2 w-100 d-flex flex-row justify-content-end'>";
                echo "<input type='submit' value='Delete' name='$id' class='btn btn-danger'/>";
                echo "</form>";
                echo "</div>";

            }
            ?>
        </main>
        <script src="../js/index.js"></script>
    </body>

    </html>
<?php } else {
    header('location:login.php');
} ?>

<?php
include('connection.php');
$sql = "SELECT * FROM feedback";
$sqldata = mysqli_query($con,$sql);
while (list($id, $name, $title, $content) = mysqli_fetch_array($sqldata)) {
    $del_sql = "DELETE FROM feedback WHERE id='$id'";

    $del = mysqli_query($con,$del_sql);

}
?>