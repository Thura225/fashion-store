<?php
session_start();
error_reporting(1);
include('connection.php');
if ($_SESSION['email'] == '') {
    header('location:../login.php');
} else {
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM profile WHERE user_email='$email'";
    $val = mysqli_query($con, $sql);
    $obj = mysqli_fetch_object($val);
    $img = $obj->img;
    if (isset($_POST['edit'])) {
        include('connection.php');
        $name = $_POST['name'];
        $ph_no = $_POST['ph_no'];
        $profile_img = $_FILES['img']['name'];
        print_r($_FILES['img']);
        if ($_FILES['img']['size'] > 0) {
            move_uploaded_file($_FILES['img']['tmp_name'], 'img/' . $profile_img);
        } else {
            $err = "Unsupported Image";
        }
        move_uploaded_file($_FILES['img']['tmp_name'], 'img/' . $profile_img);
        $psql = "UPDATE profile SET img='img/$profile_img'
        WHERE user_email='$email'";
        $pval = mysqli_query($con, $psql);
        $usql = "UPDATE users SET name='$name',ph_no='$ph_no'
        WHERE email='$email'";
        $uval = mysqli_query($con, $usql);
        header('location:index.php');
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile</title>
        <link rel="stylesheet" href="../css/index.css" />
    </head>

    <body class='bg-secondary'>
        <header class="w-100 sticky-top d-flex flex-row bg-primary justify-content-between shadow-lg">

            <nav class="navbar navbar-expand-lg w-75">
                <div class='container'>
                    <a href='#' class="navbar-brand text-decoration-none text-white fs-1">FASHION STORE</a>
                </div>
                <ul class='navbar-nav d-none d-lg-flex'>
                    <li class='nav-item'><a href="../index.php" class='nav-link text-white'>Home</a></li>
                    <li class='nav-item'><a href="../search.php" class='nav-link text-white'>Search</a></li>
                    <li class='nav-item'><a href="../cart.php" class='nav-link text-white'>Cart</a></li>
                    <li class='nav-item'><a href="../contact.php" class='nav-link text-white'>Contact</a></li>
                </ul>
            </nav>
            <?php if ($_SESSION['email'] == '') {
                echo "<div class='profile w-25 d-flex justify-content-center align-items-center'><a href='login.php' class='text-decoration-none text-light'>Login</a></div>";
            } else { ?>
                <div class='profile w-25 d-flex justify-content-center align-items-center position-relative'>
                    <a href="#" class="text-decoration-none"><img class="profile-img" src=<?php echo @$img ?> alt=""></a>
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
                            <a href="../index.php" class='text-decoration-none text-white'>Home</a>
                        </li>
                        <li class='list-group-item bg-dark m-0 border-0'>
                            <a href="../search.php" class='text-decoration-none text-white'>Search</a>
                        </li>
                        <li class='list-group-item bg-dark m-0 border-0'>
                            <a href="../cart.php" class='text-decoration-none text-white'>Cart</a>
                        </li>
                        <li class='list-group-item bg-dark m-0 border-0'>
                            <a href="../contact.php" class='text-decoration-none text-white'>Contact</a>
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
                            <a href="../index.php" class='text-decoration-none text-white'>Home</a>
                        </li>
                        <li class='list-group-item bg-dark m-0 border-0'>
                            <a href="index.php" class='text-decoration-none text-white'>Profile</a>
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
        <h1 class='mx-3 my-2 text-center'>Edit your profile</h1>
        <main class='mt-3 p-3 d-flex flex-column flex-lg-row flex-wrap justify-content-start'>
            <form method='post' class='d-block mb-2 mx-auto rounded' enctype="multipart/form-data">
                <font color='red'>
                    <?php echo $err ?>
                </font><br>
                <img src=<?php echo @$img ?> width=150 height=150 /><br><br>
                <input type='file' name='img' /><br><br>
                <label>Name</label><br>
                <input type='text' name='name' /><br><br>
                <label>Phone Number</label><br>
                <input type='text' name='ph_no' /><br><br>
                <input type='submit' name='edit' value='Edit' class='btn btn-success' />
            </form>;
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
<?php } ?>