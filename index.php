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
    <?php if (isLoged() === false) { ?>
        <a href="index.php?action=home">Home</a>
        <a href="index.php?action=login">Login</a>
    <?php } else { ?>
        <?php if (getUserRole($connection) === 'admin') { ?>
            <a href="index.php?action=add_role">Add Role</a>
            <a href="index.php?action=employee_registration">New Employee</a>
            <a href="index.php?action=product_category">Add Category</a>
            <a href="index.php?action=create_product">Create Product</a>
            <a href="index.php?action=create_store">Open New Store</a>
            <a href="index.php?action=hire_employee">Hire An Employee</a>
        <?php } ?>
        <?php if (getUserRole($connection) === 'Warehouse worker') { ?>
            <a href="index.php?action=products_list">Products List</a>
            <a href="index.php?action=warehouse_products">Warehouse Products</a>
        <?php } ?>
        <?php if (getUserRole($connection) === 'Store employee') { ?>
            <a href="index.php?action=register_category">Register Category</a>
            <a href="index.php?action=edit_store_taxes">Store Taxes</a>
<!--            <a href="index.php?action=warehouse_products_list">Warehouse Products List</a>-->
<!--            <a href="index.php?action=shop_order">Make an Order</a>-->
        <?php } ?>
        <a href="index.php?action=logout">Logout</a>
    <?php } ?>
</header>
<main class="main">
    <?php
    if ($action === 'home') {
        include 'pages/home.php';
    } elseif ($action === 'login') {
        include 'pages/login.php';
    } elseif ($action === 'add_role') {
        include 'pages/add_role.php';
    } elseif ($action === 'employee_registration') {
        include 'pages/employee_registration.php';
    } elseif ($action === 'product_category') {
        include 'pages/add_product_category.php';
    } elseif ($action === 'create_product') {
        include 'pages/create_product.php';
    } elseif ($action === 'create_store') {
        include 'pages/create_store.php';
    } elseif ($action === 'hire_employee') {
        include 'pages/hire_employee.php';
    } elseif ($action === 'products_list') {
        include 'pages/products_list.php';
    } elseif ($action === 'warehouse_products') {
        include 'pages/warehouse_products.php';
    } elseif ($action === 'register_category') {
        include 'pages/register_category.php';
    } elseif ($action === 'update_quantity'){
        include 'pages/update_quantity.php';
    } elseif ($action === 'edit_store_taxes'){
        include 'pages/edit_store_taxes.php';
    } elseif ($action === 'logout') {
        include 'pages/logout.php';
    }
    ?>
</main>
<footer>

</footer>

</body>
</html>