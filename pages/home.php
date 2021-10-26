<?php
include '../includes/db.php'; ?>

<style>
.control-label {
    text-transform:capitalize;
}
.panel .form-group {
    margin:unset
}

#notif {
    display:none;
}
.col-sm-4.project-item {
    background: #008aff24;
    padding: .5em;
    border-radius: 6px;
    border: 1px solid #0000ff59;
}
.col-sm-4.project-item:hover {
    background:#008aff8c;
}

</style>

<div class="col-lg-12" id="notif">

<?php
$query1 = mysqli_query($conn, "SELECT * FROM users where active = '1' ");

while ($row1 = mysqli_fetch_assoc($query1)) {
    $current_date = date("d-m");
    $birth_date  = date("d-m", strtotime($row1['birthday']));

    if ($birth_date == $current_date) { ?>
    <div class = 'panel panel-primary'>
        <div class = 'panel-heading'>
        Conguratuate!
        </div>
        <div class = 'panel-body'>
        <center><h2>Today is <b><?php echo $row1[
            'fullname'
        ]; ?></b>'s birthday.</h2></center>
                <p><i>Today:</i><b><?php echo date('d/m/Y'); ?></b></p>
        </div>
    </div>
	<?php }
}
?>
</div>
 
<input type="hidden" id="nowY" name="nowY" value="" />
<input type="hidden" name="nowM" id="nowM" value="" />

<div id="tabs">
  <h2>Performance</h2>
  <?php if($_SESSION['ROLE'] == 100) {?>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Integrated</a></li>
    <li id="aaa"><a data-toggle="tab" href="#menu1">Personally</a></li>    
  </ul>
  <?php } ?>

  <div class="tab-content" id="tabs">
    <?php if ($_SESSION['ROLE'] == 100) {?>
    <div id="home" class="tab-pane fade in active">
      <h3>Integrated</h3>
        <div class="row container" style="margin-top: 30px;">
            <!-- <div class="cold-md-3"> -->
                <label class="col-md-1 control-label text-right" style="padding:0.8rem;">Year:</label>
                <div class="col-md-2">
                    <select class = 'form-control' id = 'year'  name = 'year' type = 'text' onchange = 'javascript:selectYear()' value = '2021' required>
                    <script language = 'javascript'>
                    for ( var i = 2020; i <= ( new Date() ).getFullYear();
                    i ++ ) {
                        if ( i == ( new Date() ).getFullYear() ) {
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
                        if ( i == ( new Date() ).getMonth() + 1 ) {
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
        <div id="allChart" style="height: 370px; width: 100%;"></div>
    </div>
    <?php } ?>

    
    <div id="menu1" class="tab-pane fade <?php if($_SESSION['ROLE'] == 200) { echo 'in active'; } ?>">
      <h3>Personally</h3>
      <div class="row container" style="margin-top: 50px;">
        <?php if ($_SESSION['ROLE'] == 100) { ?>
            <!-- <div class="cold-md-3"> -->
                <label class="col-md-1 control-label text-right" style="padding:0.8rem;">User:</label>
                <div class="col-md-2">
                    <select class = "form-control" id="user" name="user" type="text" onchange="javascript:selectUser()" required>
                        <?php
                        include '../includes/db.php';
                        $query = mysqli_query(
                            $conn,
                            'SELECT * FROM users where active=1 and role="200" order by fullname'
                        );
                        while ($row = mysqli_fetch_assoc($query)) { ?>
                        <option  value="<?php echo $row[
                            'fullname'
                        ]; ?>"><?php echo $row['fullname']; ?>
                        </option>
                        <?php }
                        ?>
                    </select>
                </div>
            <!-- </div> -->
        <?php } ?>
            <!-- <div class="cold-md-3"> -->
                <label class="col-md-1 control-label text-right" style="padding:0.8rem;">Year:</label>
                <div class="col-md-2">
                    <select class = 'form-control' id='pyear'  name='pyear' type ='text' onchange='javascript:selectPYear()' value = '2021' required>
                    <script language = 'javascript'>
                    for ( var i = 2020; i <= ( new Date() ).getFullYear();
                    i ++ ) {
                        if ( i == ( new Date() ).getFullYear() ) {
                            document.write( '<option selected value=\'' + i + '\'>' + i + '</option>\n' );
                        } else {
                            document.write( '<option value=\'' + i + '\'>' + i + '</option>\n' );
                        }

                    }
                    </script>
                    </select>
                </div>
            <!-- </div> -->
        </div>
        <div id="personChart" style="height: 370px; width: 100%;"></div>
    </div>
  </div>
</div>

<script type = 'text/javascript'>
    jQuery( document ).ready( function() {
            getChart( ( new Date() ).getFullYear(), ( new Date() ).getMonth() + 1 );
        }
    );

    $("#aaa").on("click", function() {
        var delay = 1000;
        setTimeout(function(){  getPersonChart($('#user').val(), ( new Date() ).getFullYear());  }, delay);
        // getPersonChart($('#user').val(), ( new Date() ).getFullYear());
    });

    function getChart( y, m ) {
        $.ajax( {
            type: 'GET',
            url: './function.php?action=total',
            data: {
                year: y,
                month: m
            }
            ,
            success: function( data ) {
                var chartData = JSON.parse(data);     

                var options = {
                    title: {
                        text: ""              
                    },
                    animationEnabled: true, 
                    theme: 'theme4', 
                    axisY: { title: 'USD($)'},
                    axisX:{
                        interval: 1,
                        labelAngle: -70 
                    },
                    exportEnabled: true,
                    data: [              
                    {
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "column",
                        dataPoints: chartData
                    }
                    ]
                };

                $("#allChart").CanvasJSChart(options);
            }
        });
    }

    function getPersonChart(name, year) {
        $.ajax( {
            type: 'GET',
            url: './function.php?action=person',
            data: {
                pyear: year,
                name: name
            }
            ,
            success: function( data ) {
                var title = $('#user').val();

                var chartPersonData = JSON.parse(data);
                var options1 = {
                    title: {
                        text: title          
                    },
                    animationEnabled: true, 
                    theme: 'theme4',
                    axisY: { title: 'USD($)'},
                    axisX:{
                        interval: 1,
                        labelAngle: -70 
                    },
                    exportEnabled: true,
                    data: [              
                    {
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "column",
                        dataPoints: chartPersonData
                    }
                    ]
                };
                $("#personChart").CanvasJSChart(options1);
                // var delay = 1000;
                // setTimeout(function(){   }, delay);

                
            }
        });
    }

    function selectYear() {
        var year = $( '#year' ).val();
        var month = $( '#month' ).val();
        getChart( year, month );
    }

    function selectMonth() {
        var year = $( '#year' ).val();
        var month = $( '#month' ).val();
        getChart( year, month );
    }

    function selectUser() {
        var user = $('#user').val();
        var pyear = $('#pyear').val();
        getPersonChart( user, pyear );
    }

    function selectPYear() {
        var user = $('#user').val();
        var pyear = $('#pyear').val();
        getPersonChart( user, pyear );
    }

    if ( $('#notif.panel').length > 0 ) {
        $('#project-field').removeClass('col-lg-12').addClass('col-md-8');
        $('#notif').show();
    }

</script>

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>