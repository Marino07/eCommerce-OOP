<?php
if(session_status() === PHP_SESSION_NONE) {
session_start();}
$severname = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'shop';

$conn = mysqli_connect($severname, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Neuspjesna konekcija!");
}