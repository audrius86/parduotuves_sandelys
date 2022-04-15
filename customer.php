<style>
    <?php
    include 'css/index.css';
    ?>
</style>

<?php
include 'config.php';
?>

<html>
<head>
    <title>Last Bora</title>
</head>
<body>
<header>
    <button id="admin_button" onclick="window.location.href='index.php'">Admin</button>
    <?php if (isLoged() === false) { ?>
        <a href="customer.php?action=home">Home</a>
        <a href="customer.php?action=login">Login</a>
        <a href="customer.php?action=customer_registration">Registration</a>
    <?php } else { ?>
            <a href="customer.php?action=shops">Stores</a>
            <a href="customer.php?action=update_data">Update Data</a>
            <a href="customer.php?action=logout">Logout</a>
    <?php } ?>
</header>
<main class="main">
    <?php
    if ($action === 'home' and isLoged() === false) {
        include 'customer/home.php';
    } elseif ($action === 'home' and isLoged() === true) {
        include 'customer/home2.php';
    } elseif ($action === 'login') {
        include 'customer/login.php';
    } elseif ($action === 'customer_registration') {
        include 'customer/customer_registration.php';
    }


    elseif ($action === 'shops') {
        include 'customer/shops.php';
    }



    elseif ($action === 'update_data') {
        include 'customer/update_data.php';
    } elseif ($action === 'logout') {
        include 'customer/logout.php';
    }
    ?>
</main>
<footer>

</footer>

</body>
</html>