<?php

session_start();

$errmsg_arr = [];

$errflag = false;

include 'db.php';

$user = $_POST['user'];
$pass = $_POST['pass'];
$hash = MD5($pass);

$query = mysqli_query(
    $conn,
    "SELECT * FROM users where username='$user' and password='$hash' and active='1'"
);
$count = mysqli_num_rows($query);
while ($row = mysqli_fetch_assoc($query)) {
    if ($count > 0) {
        session_regenerate_id();
        $_SESSION['NAME'] = $row['fullname'];
        $_SESSION['ROLE'] = $row['role'];
        $_SESSION['UID'] = $row['uid'];

        echo 'true';
    }
}

?>
