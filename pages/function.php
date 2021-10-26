<?php
include '../includes/auth.php';
include '../includes/db.php';

$action = $_GET['action'];

$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$month = isset($_GET['month']) ? $_GET['month'] : date('m');

$pyear = isset($_GET['pyear']) ? $_GET['pyear'] : date('Y');
$name = isset($_GET['name']) ? $_GET['name'] : '';
if($_SESSION['ROLE'] == 200) {
    $name = $_SESSION['NAME'];
}

$date = new DateTime();
$date->setDate($year, $month, 26);
$time = $date->format('Y-m-d');
$new_date = date('Y-m-d', strtotime($time . ' - 29 days'));

if ($action == 'total') {
    if (!is_null($year) || !is_null($month)) {
        $query1 = mysqli_query($conn, 'SELECT * FROM users where role = 200 and active = 1');
        $result = [];


        while ($row1 = mysqli_fetch_assoc($query1)) {
            $where = $row1['fullname'];
            $query2 = mysqli_query(
                $conn,
                "SELECT fullname, SUM(amount) as total_amount FROM transactions where fullname = '$where' and pay_date > '$new_date' and pay_date <= '$time'"
            );
            $row2 = mysqli_fetch_assoc($query2);
            if ($row2['fullname'] !== null) {
                array_push($result, [
                    'label' => $row2['fullname'],
                    'y' => intval($row2['total_amount']),
                ]);
            } else {
                array_push($result, [
                    'label' => $where,
                    'y' => 0,
                ]);
            }
        }

        $query3 = mysqli_query(
            $conn,
            "SELECT SUM(amount) as total_amount FROM transactions where pay_date > '$new_date' and pay_date <= '$time' "
        );
        $row3 = mysqli_fetch_assoc($query3);
        array_push($result, [
            'label' => 'Total',
            'y' => intval($row3['total_amount']),
        ]);

        echo json_encode($result);
    }
}

if ($action == 'person') {
    if (!is_null($pyear) || !is_null($name)) {
        $query1 = mysqli_query(
            $conn,
            "SELECT SUM(amount) AS total_amount, MONTH(pay_date) AS mon, YEAR(pay_date) AS ya FROM transactions WHERE 
            fullname='$name' AND YEAR(pay_date) = '$pyear' GROUP BY MONTH(pay_date)"
        );
        $result1 = [];
        $total = 0;

        if($_SESSION['ROLE'] == 100) {
            for ($i=1; $i <=12 ; $i++) { 
                array_push($result1, [
                    'label' => $i,
                    'y' => 0,
                ]);
            }
        } else {
            for ($i=1; $i <= date('m') ; $i++) { 
                array_push($result1, [
                    'label' => $i,
                    'y' => 0,
                ]);
            }
        }
        
        
        while ($row1 = mysqli_fetch_assoc($query1)) {
            foreach ($result1 as $key => $value) {
                if($value['label'] == $row1['mon']) {
                     $result1[$key]['y'] = intval($row1['total_amount']);
                }         
            }
            $total += intval($row1['total_amount']);
        }
        array_push($result1, [
            'label' => 'Total',
            'y' => $total,
        ]);
        echo json_encode($result1);
    }
}
