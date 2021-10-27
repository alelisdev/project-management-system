<?php
$servername = 'localhost';
$dbusername = 'root';
$password = '';
$dbname = 'pms';

$conn = mysqli_connect($servername, $dbusername, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

?>
