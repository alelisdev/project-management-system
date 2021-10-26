<?php include '../includes/auth.php'; 
if ($_SESSION['ROLE'] == 100) {
    $username = isset($_GET['user']) ? $_GET['user'] : 'all';
} else {
    $username = $_SESSION['NAME'];
}
$year = isset($_GET['y']) ? $_GET['y'] : date('Y');
$month = isset($_GET['m']) ? $_GET['m'] : date('m');
?>
<input type="hidden" id="nowY" name="nowY" value="<?php echo $year; ?>" />
<input type="hidden" name="nowM" id="nowM" value="<?php echo $month; ?>" />
<div class="col-md-12">
	<h4>Transactions</h4>

<hr style="border-bottom:1px solid black"></hr>
</div>
<div class="row container">
<?php if ($_SESSION['ROLE'] == 100) { ?>
    <!-- <div class="cold-md-3"> -->
        <label class="col-md-1 control-label text-right" style="padding:0.8rem;">User:</label>
        <div class="col-md-2">
            <select class = "form-control" id="transuser" name="transuser" type="text" onchange="javascript:onTransUser()" required>
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
<input type="hidden" name="transuser" id="transuser" value="<?php echo $_SESSION['NAME']; ?>" />
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
    <!-- </div> -->
    <!-- <div class="cold-md-3"> -->
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
        	<div class="panel-heading">
            <button class="btn btn-success" id="btnExport">EXPORT TO EXCEL</button>
        	<?php if ($_SESSION['ROLE'] == 200): ?>
          <a class="btn btn-md btn-info" id="add_pos" onclick="add_form()"><center><i class="fa fa-plus"></i> Add</center></a>
          <?php endif; ?>
        </div> 
          
        </div> 
        <div class="panel-body"> 
			
       <table id="transaction" class="table table-bordered table-condensed">
    <thead>
      <tr id="heads">
        <th class="col-md-2 text-center">full name</th>
        <th class="col-md-2 text-center">job name</th>
        <th class="col-md-2 text-center">client name</th>
        <th class="col-md-2 text-center">payment method</th>
        <th class="col-md-1 text-center">amount</th>
        <th class="col-md-2 text-center">date</th>
        <!-- <th class="col-md-1 text-center">Operation</th> -->
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
        $query_string = sprintf("SELECT * FROM transactions where YEAR(pay_date) = '%s' AND MONTH(pay_date) = '%s' order by pay_date", $year, $month);
    } elseif ($username !== 'all') {
        $query_string = sprintf(
            "SELECT * FROM transactions where fullname='%s' AND YEAR(pay_date) = '%s' AND MONTH(pay_date) = '%s' order by pay_date",
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
            'job_name'
        ]; ?></td>
        <td  class="text-center"><?php echo $row[
            'client_name'
        ]; ?></td>
        <td  class="text-center"><?php echo $row[
            'pay_method'
        ]; ?></td>
        <td  class="text-center"><?php echo $row[
            'amount'
        ]; ?>$</td>
        <td  class="text-center"><?php echo date(
            'd/m/Y',
            strtotime($row['pay_date'])
        ); ?></td>
        <!-- <td  class="text-center"><center><a href="#pos<?php echo $id; ?>" data-toggle="modal"><i class="fa fa-pencil"></i> edit</a></center></td> -->
       </tr>

      <?php include '../includes/update_modals.php';
    }
    ?>
    </tbody>
  </table>
		</div>
	</div>
</div>

<div class="col-md-12">
	
	
<?php
include '../includes/db.php';
$query = mysqli_query(
    $conn,
    sprintf(
        "SELECT * FROM bids where status = 2 and fullname = '%s' order by id",
        $_SESSION['NAME']
    )
);
?>
<div id="add_form">
	<h4>New Transaction</h4>
	<hr style="border-bottom:1px solid grey"></hr>
	
	<form method="POST" id="pos_form">
		<div class="form-horizontal">
			<div class="form-group">
			<div class="col-sm-4"><label class="control-label" for="cname">client name:</label></div>
				<div class="col-sm-5">
				<select class="form-control"  id="cname" name="cname" type="text" required>
						<option value="" selected="" disabled="">Select your client.</option>
						<?php while ($row = mysqli_fetch_assoc($query)) { ?>
						<option  value="<?php echo $row[
          'client_name'
      ]; ?>"><?php echo $row['client_name']; ?></option>
						<?php } ?>
            		</select>
				</div>
			</div>
		</div>	
		<div class="form-horizontal">
			<div class="form-group">
				<div class="col-sm-4"><label class="control-label" for="pay">job name:</label></div>
				<div class="col-sm-5">
					<select class="form-control"  id="jname" name="jname" type="text" required>
						<option value="" selected="" disabled="">Select your job.</option>
						<?php
      include '../includes/db.php';
      $query = mysqli_query(
          $conn,
          sprintf(
              "SELECT * FROM bids where status = 2 and fullname = '%s' order by id",
              $_SESSION['NAME']
          )
      );
      while ($row = mysqli_fetch_assoc($query)) { ?>
						<option  value="<?php echo $row[
          'job_name'
      ]; ?>"><?php echo $row['job_name']; ?></option>
						<?php }
      ?>
            		</select>
				</div>
			</div>
		</div>
		
		<div class="form-horizontal">
			<div class="form-group">
				<div class="col-sm-4"><label class="control-label" for="pay">payment method:</label></div>
				<div class="col-sm-5">
					<select class="form-control"  id="pay" name="pay" type="text"  required>
						<option value="" selected="" disabled="">Select payment method.</option>
						<?php
      include '../includes/db.php';
      $query = mysqli_query($conn, 'SELECT * FROM payments where deleted_at is null');
      while ($row = mysqli_fetch_assoc($query)) { ?>
						<option  value="<?php if (
          $row['address'] == ''
      ) {
          echo $row['name'];
      } else {
          echo $row['name'] . '(' . $row['address'] . ')';
      } ?>"><?php if ($row['address'] == '') {
    echo $row['name'];
} else {
    echo $row['name'] . '(' . $row['address'] . ')';
} ?></option>
						<?php }
      ?>
            		</select>
				</div>
			</div>
		</div>
		<div class="form-horizontal">
			<div class="form-group">
			<div class="col-sm-4"><label class="control-label" for="amount">amount:</label></div>
				<div class="col-sm-5">
					<input type="text" style="text-align:right" class="form-control input-sm" name="amount" id="amount" placeholder="$" required/>
				</div>
			</div>
		</div>
		<div class="form-horizontal">
			<div class="form-group">
			<div class="col-sm-4"><label class="control-label" for="date">date:</label></div>
				<div class="col-sm-5">
					<input type="date" style="text-align:right" class="form-control input-sm" name="date" id="date" placeholder="Php." required/>
				</div>
			</div>
		</div>
		
		<hr style="border-bottom:1px solid grey"></hr>

		<div class="form-horizontal">
			<div class="form-group">
				<div class="col-sm-12">
					<center>
					<button class="col-sm-4 btn btn-info btn-sm" id="save_pos">Save</button>
					<div class="col-sm-4"></div> 
					<a class="col-sm-4 btn btn-info btn-sm" onclick="can_pos()">Cancel</a> 
					</center>
				</div>
			</div>
		</div>
		<hr style="border-bottom:1px solid grey"></hr>

	</form>

</div>
</div>
<div id="retCode1"></div>
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

    function selectYear() {
        var username = $('#transuser').val();
        var year = $( '#year' ).val();
        var month = $( '#month' ).val();
        if(username == "" || username == undefined){
            window.location = 'index.php?page=transaction&&user=' + username + '&&y=' + year + '&&m=' + month;
        } else {
            window.location = 'index.php?page=transaction&&user=' + username + '&&y=' + year + '&&m=' + month;          
        }
    }

    function selectMonth() {
        var username = $('#transuser').val();
        var year = $( '#year' ).val();
        var month = $( '#month' ).val();
        if(username == "" || username == undefined){
            window.location = 'index.php?page=transaction&&user=' + username + '&&y=' + year + '&&m=' + month;
        } else {
            window.location = 'index.php?page=transaction&&user=' + username + '&&y=' + year + '&&m=' + month;          
        }
    }

    function onTransUser() {
        var username = $('#transuser').val();
        var year = $( '#year' ).val();
        var month = $( '#month' ).val();
        if(username == "" || username == undefined){
            window.location = 'index.php?page=transaction&&user=' + username + '&&y=' + year + '&&m=' + month;
        } else {
            window.location = 'index.php?page=transaction&&user=' + username + '&&y=' + year + '&&m=' + month;          
        }
    }

	jQuery(document).ready(function(){
						jQuery("#pos_form").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								$.ajax({
									type: "POST",
									url: "../forms/add_forms.php?action=transaction",
									data: formData,
									success: function(html){
										$.notify("Successfully transaction added!", successOptions);
										
										var delay = 2000;
										setTimeout(function(){	window.location = 'index.php?page=transaction';   }, delay);  
									
									}
								});
									return false;
						});
						});
</script>
<script>
	$(document).ready(function(){
		$('#add_form').hide();
	})
	function add_form(){
		$('#add_pos').hide();
		$('#trans_list').hide();
		$('#add_form').show('SlideDown');
	}
	function can_pos(){
		$('#trans_list').show();
		$('#add_form').hide('slideUp');
		$('#add_pos').show('SlideDown');
		$('#pos').val('');
		$('#dr').val('');

	}
    $(document).ready(function(){
        $("#btnExport").click(function() {
            let name =  $('#transuser').val() +  "-" + $( '#year' ).val() + "-" + $( '#month' ).val() + '.xlsx';
            let table = document.getElementsByTagName("table");
            TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
            name: name, // fileName you could use any name
            sheet: {
                name: 'Sheet 1' // sheetName
            }
            });
        });
    });
</script>


<script type="text/javascript">
        $(function() {
            $("#transaction").dataTable(
        { "aaSorting": [[ 2, "asc" ]] }
      );
        });
    </script>