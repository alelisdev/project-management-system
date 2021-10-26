<?php include '../includes/db.php'; ?>
<?php
include '../includes/auth.php';
/***********
User list
*/ $action = $_GET['action'];
if ($action == 'user') {
    // $eid = $_POST['eid'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $birthday = $_POST['birthday'];
    $pass = $_POST['pass'];
    $hash = MD5($pass); // $hash = password_hash($pass, PASSWORD_DEFAULT);
    // $u_type = $_POST['u_type'];
    if (
        $query = mysqli_query(
            $conn,
            "INSERT INTO users (username, fullname, birthday, password, active, created_at) VALUES('$username','$fullname','$birthday', '$hash','1', NOW())"
        )
    ) {
        echo 'success';
    } else {
        echo "<script>alert('Saving data failed!.')</script>";
    }
    exit();
}
if ($action == 'payment') {
    // $eid = $_POST['eid'];
    $name = $_POST['pn'];
    $address = $_POST['address'];
    if (
        $query = mysqli_query(
            $conn,
            "INSERT INTO payments (name, address, created_at) VALUES('$name','$address', NOW())"
        )
    ) {
        echo 'success';
    } else {
        echo "<script>alert('Saving data failed!.')</script>";
    }
    exit();
}
if ($action == 'account') {
    $name = $_POST['a_name'];
    $country = $_POST['c_name'];
    if (
        $query = mysqli_query(
            $conn,
            "INSERT INTO accounts (name, country, created_at) VALUES('$name','$country',NOW())"
        )
    ) {
        echo 'success';
    } else {
        echo "<script>alert('Saving data failed!.')</script>";
    }
}
if ($action == 'transaction') {
    $fullname = $_SESSION['NAME'];
    $pay = $_POST['pay'];
    $amount = floatval($_POST['amount']);
    $date = $_POST['date'];
    $jname = $_POST['jname'];
    $cname = $_POST['cname'];
    if (
        $query = mysqli_query(
            $conn,
            "INSERT INTO transactions (fullname, pay_method, amount, pay_date, job_name, client_name) VALUES ('$fullname','$pay', '$amount', '$date', '$jname', '$cname')"
        )
    ) {
        echo 'success';
    } else {
        echo "<script>alert('Saving data failed!.')</script>";
    }
}
if ($action == 'project') {
    $fullname = $_SESSION['NAME'];
    $cname = $_POST['cname'];
    $jname = $_POST['jname'];
    $abname = $_POST['abname'];
    $account_name = $_POST['account_name'];
    $query = mysqli_query(
        $conn,
        "INSERT INTO bids (fullname, account_name,client_name,job_name,applied_budget, status, bid_date, created_at) VALUES('$fullname','$account_name','$cname','$jname','$abname','1', now(), now())"
    );
    if ($query) {
        echo '<script>$("#msg").show("SlideDown");</script>';
    } else {
        echo "<script>alert('Saving data failed!.')</script>";
    }
}
?>


 