<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$action = $_REQUEST['action'] ?? null;

$ip = 'localhost';
$username = 'root';
$password = '';
$database = 'lastbora';

$connection = mysqli_connect($ip, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

function isLoged(): bool
{
    if (isset($_SESSION['email'])) {
        return true;
    } else {
        return false;
    }
}

function getUserRole($connection): string
{
    $sql = "SELECT r.role FROM roles r join employees e on r.id = e.role_id WHERE e.email='" .$_SESSION['email'] . "'";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
    return $result['role'];
}