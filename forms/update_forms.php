<?php
session_start();
include '../includes/db.php';

/********
 * user list
 */

$action = $_GET['action'];
echo $action;

if ($action == 'user') {
    $uid = $_POST['uid'];
    $fullname = $_POST['fullname'];
    $birthday = $_POST['birthday'];
    $status = $_POST['status'];

    if (
        $query = mysqli_query(
            $conn,
            "UPDATE users SET fullname = '$fullname',
													birthday = '$birthday',
													active = '$status' where uid = '$uid'"
        )
    ) {
        echo '<div class="alert alert-success" id="msg2"><i class="fa fa-check"></i>Data successfully updated.</div>
	<script>$("#msg2").show("SlideDown");
	</script>';
    } else {
        echo "<script>alert('updating data failed!.')</script>";
    }
}

if ($action == 'account') {
    $id = $_GET['id'];
    if (
        $query = mysqli_query(
            $conn,
            "UPDATE accounts SET deleted_at = NOW() where id = '$id'"
        )
    ) {
        echo '<div class="alert alert-success" id="msg2"><i class="fa fa-check"></i>Data successfully deleted. </div>
                <script>$("#msg2").show("SlideDown");
                </script>';
    } else {
        echo "<script>alert('deleting data failed!.')</script>";
    }
}

if ($action == 'payment') {
    $id = $_GET['id'];
    if (
        $query = mysqli_query(
            $conn,
            "UPDATE payments SET deleted_at = NOW() where id = '$id'"
        )
    ) {
        echo 'true';
    } else {
        echo 'fasle';
    }
}

if ($action == 'user2') {
    $uid = $_POST['uid'];
    $query20 = mysqli_query($conn, "SELECT * FROM users where uid ='$uid'");
    $row20 = mysqli_fetch_assoc($query20);
    $cpass = $_POST['current'];

    $user = $_POST['user'];
    $npass = $_POST['npass'];
    $hash = MD5($npass);
    if (MD5($cpass) == $row20['password']) {
        if (
            $query = mysqli_query(
                $conn,
                "UPDATE users SET username = '$user',
													password = '$hash' where uid = '$uid' "
            )
        ) {
            echo '<script>$.notify("Password successfully reset", successOptions);
	                var delay = 2000;
                    setTimeout(function(){  window.location.reload();   }, delay);
	            </script>';
        } else {
            echo '<script>$.notify("Password reset falid!", errorOptions);</script>';
        }
    } else {
        echo '<script>$.notify("Password is incorrect!", errorOptions);</script>';
    }
}

/*
task modal
*/

if ($action == 'position') {
    $id = $_POST['id'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $abg = $_POST['abg'];
    $fbg = $_POST['fbg'];
    $status = $_POST['status'];
    if (
        mysqli_query(
            $conn,
            "UPDATE bids SET start_date = '$sdate' , end_date = '$edate', applied_budget = '$abg', final_budget = '$fbg', status = '$status' where id = '$id'"
        )
    ) {
        echo '<h4 class="alert alert-success"><i class="fa fa-fw fa-check"></i>  Data Succesfully Updated.</h4>';
    } else {
        echo "<script>alert('Updating data failed!.')</script>";
    }
}

/**bid */
if ($action == 'bid') {
    $id = $_POST['id'];
    $fbname = $_POST['fbname'];
    $update = mysqli_query(
        $conn,
        "UPDATE bids set status = '2', start_date = now(), final_budget = '$fbname' where id='$id'"
    );
    if ($update) {
        echo 'sucess';
    } else {
        echo 'falid';
    }
}

/**task */
if ($action == 'bid_update') {
    $id = $_GET['id'];
    $type = $_GET['type'];
    $update = mysqli_query(
        $conn,
        "UPDATE bids set status = '$type', end_date = now() where id='$id'"
    );
    if ($update) {
        echo 'sucess';
    }
}
?>

