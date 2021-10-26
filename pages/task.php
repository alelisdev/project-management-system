<?php include '../includes/auth.php'; 
$status = isset($_GET['status']) ? $_GET['status'] : 'all';
$username = isset($_GET['user']) ? $_GET['user'] : 'all';

$year = isset($_GET['y']) ? $_GET['y'] : date('Y');
$month = isset($_GET['m']) ? $_GET['m'] : date('m');

?>

<input type="hidden" id="nowY" name="nowY" value="<?php echo $year; ?>" />
<input type="hidden" name="nowM" id="nowM" value="<?php echo $month; ?>" />
<div class="col-md-12">
  <h4>Tasks</h4>

<hr style="border-bottom:1px solid black"></hr>
</div>
<div class="row container">
<?php if ($_SESSION['ROLE'] == 100) { ?>
    <!-- <div class="cold-md-3"> -->
        <label class="col-md-1 control-label text-right" style="padding:0.8rem;">User:</label>
        <div class="col-md-2">
            <select class = "form-control" id="user" name="user" type="text" onchange="javascript:onUser()" required>
                <option <?php if ($username == 'all') {
                    echo 'selected';
                } else {
                    echo '';
                } ?> value="all">All</option>
                <?php
                include '../includes/db.php';
                $query = mysqli_query(
                    $conn,
                    'SELECT * FROM users where active=1 and role="200" order by uid'
                );
                while ($row = mysqli_fetch_assoc($query)) { ?>
                <option  <?php if (
                    $username == $row['fullname']
                ) {
                    echo 'selected';
                } ?> value="<?php echo $row['fullname']; ?>"><?php echo $row[
    'fullname'
]; ?>
                </option>
                <?php }
                ?>
            </select>
        </div>
    <!-- </div> -->
<?php } else { ?>
<input type="hidden" name="user" id="user" value="<?php echo $_SESSION['NAME']; ?>" />
<?php } ?>
    <!-- <div class="cold-md-3"> -->
        <label class="col-md-1 control-label text-right" style="padding:0.8rem;">Status:</label>
        <div class="col-md-2">
            <?php
            $status = isset($_GET['status']) ? $_GET['status'] : 'all';
            $username = isset($_GET['user']) ? $_GET['user'] : 'all';
            ?>
            <select class = "form-control" id="status" name="status" type="text" onchange="javascript:onStatus()" required>
                <option value="all" <?php if ($status == 'all') {
                    echo 'selected';
                } ?>>All</option>
                <option value="2" <?php if ($status == 2) {
                    echo 'selected';
                } ?>>Processing</option>
                <option value="3" <?php if ($status == 3) {
                    echo 'selected';
                } ?>>Completed</option>
                <option value="4" <?php if ($status == 4) {
                    echo 'selected';
                } ?>>Canceled</option>
            </select>
        </div>
    <!-- </div> -->
    <!-- <div class="cold-md-3"> -->
        <label class="col-md-1 control-label text-right" style="padding:0.8rem;">Year:</label>
        <div class="col-md-2">
            <select class = 'form-control' id = 'year'  name = 'year' type = 'text' onchange = 'javascript:selectYear()' value = '2021' required>
            <script language = 'javascript'>
            for ( var i = 2020; i <= ( new Date() ).getFullYear();
            i ++ ) {
                if ( i == $('#nowY').val() ) {
                    document.write( '<option selected value=\'' + i + '\'>' + i + '</option>\n' );
                } else {
                    document.write( '<option value=\'' + i + '\'>' + i + '</option>\n' );
                }

            }
            </script>
            </select>
        </div>
    <!-- </div>
    <div class="cold-md-3"> -->
        <label class="col-sm-1 control-label text-right" style="padding:0.8rem;">Month:</label>
        <div class="col-md-2">
            <select class = 'form-control' id = 'month' name = 'month' type = 'text' onchange = 'javascript:selectMonth()' required>
            <script language = 'javascript'>
            const monthNames = [
                1,
                2,
                3,
                4,
                5,
                6,
                7,
                8,
                9,
                10,
                11,
                12,
            ];
            //Loop and add the Year values to DropDownList.
            for ( var i = 1; i <= monthNames.length; i++ ) {
                if ( i == $('#nowM').val() ) {
                    document.write( '<option selected value=\'' + monthNames[i-1] + '\'>' + i + '</option>\n' );
                } else {
                    document.write( '<option value=\'' + monthNames[i-1] + '\'>' + i + '</option>\n' );
                }

            }
            </script>
            </select>
        </div>
    <!-- </div> -->
</div>

<div class="col-lg-12" id="trans_list">
    <div class="panel panel-default">
        <div class="panel-heading">
            <button class="btn btn-success" id="btnExport">EXPORT TO EXCEL</button>
        </div>
        <div class="panel-body"> 
      
            <table id="position" class="table table-bordered table-condensed">
                <thead>
                    <tr id="heads">
                        <th class="col-md-1 text-center">FullName</th>
                        <th class="col-md-1 text-center">Account</th>
                        <th class="col-md-1 text-center">Client</th>
                        <th class="col-md-2 text-center">Job</th>
                        <th class="col-md-1 text-center">Applied Budget($)</th>
                        <th class="col-md-1 text-center">Final Budget($)</th>
                        <th class="col-md-1 text-center">Bid Date</th>
                        <th class="col-md-1 text-center">Start Date</th>
                        <th class="col-md-1 text-center">End Date</th>
                        <?php if ($_SESSION['ROLE'] == 100): ?>
                        <th class="col-md-1 text-center">Status</th>
                        <?php endif; ?>
                        <?php if ($_SESSION['ROLE'] == 200): ?>
                        <th class="col-md-1 text-center"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                include '../includes/db.php';
                $status = isset($_GET['status']) ? $_GET['status'] : 'all';
                if ($_SESSION['ROLE'] == 100) {
                    $username = isset($_GET['user']) ? $_GET['user'] : 'all';
                } else {
                    $username = $_SESSION['NAME'];
                }
                if ($status == 'all' && $username == 'all') {
                    $query_string = sprintf("SELECT * FROM bids where status >= 2 AND YEAR(bid_date) = '%s' AND MONTH(bid_date) = '%s' order by id", $year, $month);
                } elseif ($status !== 'all' && $username == 'all') {
                    $query_string = sprintf(
                        "SELECT * FROM bids where status = '%s' AND YEAR(bid_date) = '%s' AND MONTH(bid_date) = '%s'",
                        $status, $year, $month
                    );
                } elseif ($status == 'all' && $username !== 'all') {
                    $query_string = sprintf(
                        "SELECT * FROM bids where fullname = '%s' AND status >= 2 AND YEAR(bid_date) = '%s' AND MONTH(bid_date) = '%s' order by id",
                        $username, $year, $month
                    );
                } else {
                    $query_string = sprintf(
                        "SELECT * FROM bids where fullname = '%s' AND status = '%s' AND YEAR(bid_date) = '%s' AND MONTH(bid_date) = '%s' order by id",
                        $username,
                        $status, $year, $month
                    );
                }

                $query = mysqli_query($conn, $query_string);

                while ($row = mysqli_fetch_assoc($query)) {

                    $id = $row['id'];
                    $bid_date = date('d/m/Y', strtotime($row['bid_date']));
                    $start_date = date('d/m/Y', strtotime($row['start_date']));
                    

                    if (!empty($row['end_date'])) {
                        $end_date = date('d/m/Y', strtotime($row['end_date']));
                    } else {
                        $end_date = '--';
                    }
                    ?>
                <tr style="<?php if ($row['status'] == 3) {
                    echo 'background-color: #41a834; color: white';
                } elseif ($row['status'] == 4) {
                    echo 'background-color: #b81919; color: white';
                } ?>">
                    <td  class="text-center"><?php echo $row[
                        'fullname'
                    ]; ?></td>
                    <td  class="text-center"><?php echo $row[
                        'account_name'
                    ]; ?></td>
                    <td  class="text-center"><?php echo $row[
                        'client_name'
                    ]; ?></td>
                    <td  class="text-center"><?php echo $row[
                        'job_name'
                    ]; ?></td>
                    <td  class="text-center"><?php echo $row[
                        'applied_budget'
                    ]; ?></td>
                    <td  class="text-center"><?php echo $row[
                        'final_budget'
                    ]; ?></td>
                    <td  class="text-center"><?php echo $bid_date; ?></td>
                    <td  class="text-center"><?php echo $start_date; ?></td>
                    <td  class="text-center"><?php echo $end_date; ?></td>
                    <?php if ($_SESSION['ROLE'] == 100): ?>
                    <td  class="text-center"><?php if (
                        $row['status'] == 1
                    ) {
                        echo '-';
                    } elseif ($row['status'] == 2) {
                        echo 'processing';
                    } elseif ($row['status'] == 3) {
                        echo 'completed';
                    } elseif ($row['status'] == 4) {
                        echo 'canceled';
                    } ?></td>
                    <?php endif; ?>
                    <?php if ($_SESSION['ROLE'] == 200): ?>
                    <td  class="text-center">
                    <center>
                        <?php if ($row['status'] == 2) { ?>
                        <a onclick="javascript:onComplete(<?php echo $row[
                            'id'
                        ]; ?>)" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a> | 
                        <a onclick="javascript:onCancel(<?php echo $row[
                            'id'
                        ]; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-close"></i></a>
                        <?php } else if($row['status'] == 3){ 
                            echo "Completed"; } 
                            else if($row['status'] == 4) {
                            echo "Canceled";
                        } ?>
                    </center></td>
                    <?php endif; ?>
                </tr>

                <?php include '../includes/update_modals.php';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">

var username;
var status;
function onStatus() {
    status = $('#status').val();
    username = $('#user').val();
    var year = $( '#year' ).val();
    var month = $( '#month' ).val();
    onSearch(status, username, year, month);
}

function onUser() {
    status = $('#status').val();
    username = $('#user').val();
    var year = $( '#year' ).val();
    var month = $( '#month' ).val();
    onSearch(status, username, year, month);
}

function onSearch(status, username, year, month) {
    if(username == "" || username == undefined){
        window.location = 'index.php?page=task&&status=' + status + '&&y=' + year + '&&m=' + month;
    }
    else if (status == "") {
        window.location = 'index.php?page=task&&user=' + username + '&&y=' + year + '&&m=' + month;
    } else if (username == "" && status == "") {
        window.location = 'index.php?page=task' + '&&y=' + year + '&&m=' + month;
    } else {
        window.location = 'index.php?page=task&&status=' + status + "&&user=" + username + '&&y=' + year + '&&m=' + month;
    }
}

function selectYear() {
    status = $('#status').val();
    username = $('#user').val();
    var year = $( '#year' ).val();
    var month = $( '#month' ).val();
    onSearch(status, username, year, month);
}

function selectMonth() {
    status = $('#status').val();
    username = $('#user').val();
    var year = $( '#year' ).val();
    var month = $( '#month' ).val();
    onSearch(status, username, year, month);
}

 

function onComplete(id) {
    $.ajax({
        type: "GET",
        url: "../forms/update_forms.php?action=bid_update",
        data: {
            id: id,
            type: 3
        },
        success: function(html){
            $.notify("Successfully completed!", successOptions);
            var delay = 2000;
            setTimeout(function(){  window.location.reload();   }, delay);
        }
    });
}

function onCancel(id) {
    $.ajax({
        type: "GET",
        url: "../forms/update_forms.php?action=bid_update",
        data: {
            id: id,
            type: 4
        },
        success: function(html){
            $.notify("Successfully canceled!", successOptions);
            var delay = 2000;
            setTimeout(function(){  window.location.reload();   }, delay);
        }
    });
}

$(document).ready(function(){
    $("#btnExport").click(function() {
        var status = "";
        if($('#status').val() == 2)
        {
            status = "processing";
        } else if( $('#status').val() == 3) {
            status = "completed";
        } else if($('#status').val() == 4) {
            status = "canceled";
        }

        let name =  $('#user').val() + "-" + status + "-" + $( '#year' ).val() + "-" + $( '#month' ).val() + '.xlsx';

        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
           name: name, // fileName you could use any name
           sheet: {
              name: 'Sheet 1' // sheetName
           }
        });
    });
});

$(function() {
    $("#position").dataTable(
        { "aaSorting": [[ 2, "asc" ]] }
    );
});
</script>
