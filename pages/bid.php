<?php include '../includes/auth.php'; 
if ($_SESSION['ROLE'] == 100) {
    $username = isset($_GET['user']) ? $_GET['user'] : 'all';
} else {
    $username = $_SESSION['NAME'];
}

$year = isset($_GET['y']) ? $_GET['y'] : date('Y');
$month = isset($_GET['m']) ? $_GET['m'] : date('m');

?>
<div class="col-md-12">
	<h4>Bids</h4>
    <hr style="border-bottom:1px solid black"></hr>
</div>
<input type="hidden" id="nowY" name="nowY" value="<?php echo $year; ?>" />
<input type="hidden" name="nowM" id="nowM" value="<?php echo $month; ?>" />
<div class="row container">
<?php if ($_SESSION['ROLE'] == 100) { ?>
    <!-- <div class="cold-md-3"> -->
        <label class="col-md-1 control-label text-right" style="padding:0.8rem;">User:</label>
        <div class="col-md-2">
            <select class = "form-control" id="biduser" name="biduser" type="text" onchange="javascript:onBidUser()" required>
            <!-- <select class = "form-control" id="user" name="user" type="text" onchange="javascript:onUser()" required> -->
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
<input type="hidden" name="biduser" id="biduser" value="<?php echo $_SESSION['NAME']; ?>" />
<?php } ?>
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


<div class="col-lg-12">

	<div class="panel panel-default">
        
        <div class="panel-heading">
        <button class="btn btn-success" id="btnExport">EXPORT TO EXCEL</button>
          <?php if ($_SESSION['ROLE'] == 200): ?>
          <a class="btn btn-md btn-info" href="#new_project" data-toggle="modal"><center><i class="fa fa-plus"></i> New Bid</center></a>
          <?php endif; ?>
            
            
        </div> 
        <div class="panel-body"> 
			
            <table id="position" class="table table-bordered table-condensed">
                <thead>
                    <tr id="heads">
                        <th class="col-md-1 text-center">Full Name</th>
                        <th class="col-md-2 text-center">Account Name</th>
                        <th class="col-md-1 text-center">Client Name</th>
                        <th class="col-md-2 text-center">Job Name</th>
                        <th class="col-md-1 text-center">Applied Budget($)</th>
                        <th class="col-md-1 text-center">Final Budget($)</th>
                        <th class="col-md-2 text-center">Bid Date</th>
                        <th class="col-md-1 text-center">Status</th>
                        <?php if ($_SESSION['ROLE'] == 200): ?>
                        <th class="col-md-1 text-center">Operation</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                include '../includes/db.php';

                if ($_SESSION['ROLE'] == 100) {
                    $username = isset($_GET['user']) ? $_GET['user'] : 'all';
                } else {
                    $username = $_SESSION['NAME'];
                }

                if ($username == 'all') {
                    $query_string = sprintf(
                        'SELECT * FROM bids where status = 1 AND YEAR(bid_date) = '.$year.' AND MONTH(bid_date) = '.$month
                    );
                } elseif ($username !== 'all') {
                    $query_string = sprintf(
                        "SELECT * FROM bids where fullname = '%s' AND status = 1 AND YEAR(bid_date) = '%s' AND MONTH(bid_date) = '%s'",
                        $username, $year, $month
                    );
                }
                $query = mysqli_query($conn, $query_string);

                while ($row = mysqli_fetch_assoc($query)) {
                    $id = $row['id']; ?>
                <tr>
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

                    <td  class="text-center"><?php echo '-'; ?></td>
                    <td  class="text-center"><?php echo date(
                        'd/m/Y',
                        strtotime($row['bid_date'])
                    ); ?></td>
                    <td  class="text-center"><?php if (
                        $row['status'] == 1
                    ) {
                        echo '-';
                    } elseif ($row['status'] == 2) {
                        echo 'hired';
                    } ?></td>
                    <?php if ($_SESSION['ROLE'] == 200): ?>
                    <td  class="text-center">
                        <center>
                            <a href="#bid<?php echo $id; ?>" data-toggle="modal" class="btn btn-sm btn-success">Hired</a>
                        </center>
                    </td>        
                    <?php endif; ?>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
		</div>
	</div>
</div>
<?php
include '../includes/update_modals.php';
include '../includes/add_modal.php';
?>
<script>

    var successOptions = {
        autoHideDelay: 20000,
        showAnimation: "fadeIn",
        hideAnimation: "fadeOut",
        hideDuration: 700,
        arrowShow: false,
        className: "success",
    };

    var errorOptions = {
        autoHideDelay: 20000,
        showAnimation: "fadeIn",
        hideAnimation: "fadeOut",
        hideDuration: 700,
        arrowShow: false,
        className: "error",
    };

    

    jQuery(document).ready(function(){
        jQuery("#proj_form").submit(function(e){
                e.preventDefault();
                var formData = jQuery(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "../forms/add_forms.php?action=project",
                    data: formData,

                    success: function(html){
                        $.notify("Successfully bid added!", successOptions);
                        var delay = 2000;
                        setTimeout(function(){  window.location.reload();   }, delay);
                    }
                });
                    return false;
        });
    });


    function onBidUser() {
        var username = $('#biduser').val();
        var year = $( '#year' ).val();
        var month = $( '#month' ).val();
        if(username == "" || username == undefined){
            window.location = 'index.php?page=bid&&user=' + username + '&&y=' + year + '&&m=' + month;
        } else {
            window.location = 'index.php?page=bid&&user=' + username + '&&y=' + year + '&&m=' + month;          
        }
    }

    function selectYear() {
        var username = $('#biduser').val();
        var year = $( '#year' ).val();
        var month = $( '#month' ).val();
        if(username == "" || username == undefined){
            window.location = 'index.php?page=bid&&user=' + username + '&&y=' + year + '&&m=' + month;
        } else {
            window.location = 'index.php?page=bid&&user=' + username + '&&y=' + year + '&&m=' + month;          
        }
    }

    function selectMonth() {
        var username = $('#biduser').val();
        var year = $( '#year' ).val();
        var month = $( '#month' ).val();
        if(username == "" || username == undefined){
            window.location = 'index.php?page=bid&&user=' + username + '&&y=' + year + '&&m=' + month;
        } else {
            window.location = 'index.php?page=bid&&user=' + username + '&&y=' + year + '&&m=' + month;          
        }
    }

    $(document).ready(function(){
        $("#btnExport").click(function() {
            let name =  $('#biduser').val() + "-" + $( '#year' ).val() + "-" + $( '#month' ).val() + '.xlsx';
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
            { "aaSorting": [[ 2, "desc" ]] }
        );
    });
</script>