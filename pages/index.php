<?php include '../includes/auth.php';
include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<style>
    #page-wrapper {
    background-color: rgb(241, 241, 241) !important;
}
</style>
<body style="background-color:rgba(241, 241, 241, 0.9) !important">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href=""><b>Project Managent System</b></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                <?php echo $_SESSION['NAME']; ?>
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                   
                      <li>
                          <a href="#manage_account" data-toggle="modal"><i class="fa fa-fw fa-lock"></i> Password</a>
                      </li>
                      <li class="divider">
                          
                      </li>
                      <li>
                          <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                      </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php include '../includes/sidebar.php'; ?>
            </div>
            <!-- /.navbar-collapse -->
        </nav>


        <div id="page-wrapper">

            <div class="container-fluid">

<?php
error_reporting(E_ALL ^ E_NOTICE);

$page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 'home';
$pages = ['home', 'account', 'bid', 'task', 'transaction', 'user', 'payment'];
if (!empty($page)) {
    if (in_array($page, $pages)) {
        $page .= '.php';
        include $page;
    } else {
        echo 'Page not found. Return
        <a href="index.php?page=home">home</a>';
    }
}
?>

            </div>
        </div>
        </div>

<div id="manage_account" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog"> 
      <div class="modal-content modal-md">  
    
        <div class="modal-header"> 
            <h4 class="modal-title" id='head'>
            <i class=""></i> Reset password
            </h4> 
            <div id="retCode10"></div>
        </div> 
        <div class="modal-body">
  
        <div class="form-horizontal">

        <?php
        include '../includes/db.php';

        $query2 = mysqli_query(
            $conn,
            "SELECT * FROM users where uid = '" . $_SESSION['UID'] . "'"
        );
        $row2 = mysqli_fetch_assoc($query2);
        ?>
        <div id="retCode1"><div class="alert alert-success" id="msg20"><i class="fa fa-check"></i> Data successfully updated. </div></div>
        <div id="retCode1"><div class="alert alert-danger" id="msg21"><i class="fa fa-check"></i> Password is Incorrect. </div></div>
          <form id="update_user_form2" method="POST">
          <div class="form-group">
          
            <input type="hidden"  value="<?php echo $row2[
                'uid'
            ]; ?>" name="uid">

          </div>
          </div>
          <div class="form-group">
          <div class="col-sm-4 text-right"><label for="us">Username:</label></div>
          <div class="col-sm-8">
        <input type="text" class="form-control input-sm" id="us" value="<?php echo $row2[
            'username'
        ]; ?>" name="user" disabled required>
          </div>
          </div>
      <br>
      <br>
          <div class="form-group">
          <div class="col-sm-4 text-right"><label for="npass">New Password:</label></div>
          <div class="col-sm-8">
        <input type="password" class="form-control input-sm" id="npass" name="npass" required>
          </div>
          </div>
      <br>
      <br>
          <div class="form-group">
          <div class="col-sm-4 text-right"><label for="cpass">Current Password:</label></div>
          <div class="col-sm-8">
        <input type="password" class="form-control input-sm" id="cpass"  name="current" required>
          </div>
          </div>
      <br>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-info" id="btn_sub"><i class="fa fa-save"></i> Save</button>
                    <button data-dismiss="modal" class="btn btn-md btn-info"><i class="glyphicon glyphicon-close"></i>Close</button>
                </div>
       </form>
                  
    </div> 
  </div>
</div>


</body>

<footer>
    <center>All rights reserved © 2021</center>
</footer>
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

    $(document).ready(function(){
      $('#msg20').hide();
      $('#msg21').hide();
    });
     jQuery("#update_user_form2").submit(function(e){
        e.preventDefault();
        var formData = jQuery(this).serialize();
        $.ajax({
          type: "POST",
          url: "../forms/update_forms.php?action=user2",
          data: formData,
          success: function(html){
            $('#retCode10').append(html);
          }
        });
          return false;
    });
  </script>

</html>
