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
