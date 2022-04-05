<?php
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

$ip = 'localhost';
$username = 'root';
$password = '';
$data_base = 'lastbora';

$database = mysqli_connect($ip, $username, $password, $data_base);

if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "Pavyko";
}
?>

<!--<html>-->
<!--<head>-->
<!--    <title>Last Bora</title>-->
<!--</head>-->
<!--<body>-->
<!--<header>-->
<!--    <a href="index.php?action=services">Add new service</a>-->
<!--    <a href="index.php?action=employee">Hire an employee</a>-->
<!--    <a href="index.php?action=reservation">Make a reservation</a>-->
<!--    <a href="index.php?action=reservations_list">Reservations list</a>-->
<!--</header>-->
<!--<main class="main">-->
<!--    --><?php
//    if ($action === 'services') {
//        include 'pages/services.php';
//    } elseif ($action === 'employee') {
//        include 'pages/employee.php';
//    } elseif ($action === 'reservation') {
//        include 'pages/reservation.php';
//    } elseif ($action === 'reservations_list') {
//        include 'pages/reservations_list.php';
//    }
//    ?>
<!--</main>-->
<!--<footer>-->
<!---->
<!--</footer>-->
<!---->
<!--</body>-->
<!--</html>-->
