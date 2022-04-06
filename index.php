<style>
    <?php
    include 'css/index.css';
    ?>
</style>
<?php
include_once 'config.php';

/**
 * prisijungimas
 * registracija su rolemis (sandelio darbuotojas, parduotuves darbuotojas)
 *
 * //sandelio darbuotojas
 * prekiu kategorijos (duona, pieno produktai, kaceliarija ... )
 * prekiu valdymas (prideti, atnaujinti, istrinti) - prekės yra priskirtos prie parduotuvės
 * sandėlis - jame saugomos visos prekiu sarasas ir yra maksimalus vienetu skaicius
 *
 * parduotuviu uzsakymai is sandelio (sandelio istorija)
 *
 * //parduotuves darbuotojas
 * parduotuviu valdymas (prideti, atnaujinti, istrinti) (bendra marzas, papildomos marzos pagal kategorijas arba akcijos)
 * parduotuves prekiu informacija (galiojimo laikas, kiekis/vienetai, kaina
 * prekes kurias reikejo ismesti (kuriu galiojimas baigiasi) parduotuve
 *
 * pirkejas ir jo krepselis(kur ir ka pirko ir kiek sumokejo)
 *
 * statistika (kiek parduotuves uzdirbo, kokios prekes populiariausios)
 */
?>

<html>
<head>
    <title>Last Bora</title>
</head>
<body>
<header>
    <a href="index.php?action=add_role">Add Role</a>
    <a href="index.php?action=employee_registration">New Employee</a>
    <a href="index.php?action=product_category">Add Category</a>
    <a href="index.php?action=create_product">Create Product</a>
    <!--    <a href="index.php?action=employee">Hire an employee</a>-->
    <!--    <a href="index.php?action=reservation">Make a reservation</a>-->
    <!--    <a href="index.php?action=reservations_list">Reservations list</a>-->
</header>
<main class="main">
    <?php
    if ($action === 'add_role') {
        include 'pages/add_role.php';
    } elseif ($action === 'employee_registration') {
        include 'pages/employee_registration.php';
    } elseif ($action === 'product_category') {
        include 'pages/add_product_category.php';
    } elseif ($action === 'create_product') {
        include 'pages/create_product.php';
    }
    //    elseif ($action === 'employee') {
    //        include 'pages/employee.php';
    //    } elseif ($action === 'reservation') {
    //        include 'pages/reservation.php';
    //    } elseif ($action === 'reservations_list') {
    //        include 'pages/reservations_list.php';
    //    }
    ?>
</main>
<footer>

</footer>

</body>
</html>