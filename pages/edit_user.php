<center><h4>Edit User</h4></center>
  <?php
  include '../includes/db.php';

  $query2 = mysqli_query(
      $conn,
      "SELECT * FROM users where uid = '" . $_GET['uid'] . "' "
  );
  $row2 = mysqli_fetch_assoc($query2);
  ?>
  <hr style="border-bottom:1px solid grey"></hr>
  <div id="retCode1"></div>
    <form id="update_user_form" method="POST">
    <div class="form-group">
    <div class="col-sm-12 text-right"><center><label for="emp"><?php echo ucwords(
        $row2['username']
    ); ?></label></center></div>
       <input type="hidden"  value="<?php echo $row2['uid']; ?>" name="uid">
    </div>
    </div>
<br>
<br>
     <div class="form-group">
    <div class="col-sm-4 text-right"><label for="us">FullName:</label></div>
    <div class="col-sm-8">
   <input type="text" class="form-control input-sm" id="us" value="<?php echo $row2[
       'fullname'
   ]; ?>" name="fullname">
    </div>
    </div>
<br>
<div class="form-group">
  <div class="col-sm-4 text-right"><label for="us">birthday:</label></div>
  <div class="col-sm-8">
   <input type="date" class="form-control input-sm" id="fs" name="birthday" value="<?php echo $row2[
       'birthday'
   ]; ?>" required>
  </div>
</div>
<br>
    <div class="form-group">
    <div class="col-sm-4 text-right"><label for="status">Status:</label></div>
    <div class="col-sm-8">
   <select type="text" class="form-control input-sm" id="status" name="status">
   <option value="<?php echo $row2['active']; ?>" >
   <?php if ($row2['active'] == '1') {
       echo 'Active';
   } else {
       echo 'Inactive';
   } ?>
   </option>
   <?php if (
       $row2['active'] == '2'
   ) { ?><option value="1">Active</option> <?php } ?>
    <?php if (
        $row2['active'] == '1'
    ) { ?><option value="2">Inactive</option><?php } ?>
   </select>
    </div>
    </div>
<br>
    <hr style="border-bottom:1px solid grey"></hr>

    <div class="form-horizontal">
      <div class="form-group">
        <div class="col-sm-12">
          <center>
          <div class="col-sm-4"></div> 
          <button class="col-sm-2 btn btn-info btn-sm" id="save_pos">Save</button>
          <div class="col-sm-2"></div> 
          <a class="col-sm-2 btn btn-info btn-sm" onclick="window.location.reload()">Cancel</a> 
          </center>
        </div>
      </div>
    </div>
    <hr style="border-bottom:1px solid grey"></hr>
    </form>

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
      $('#msg2').hide();
    });
     jQuery("#update_user_form").submit(function(e){
                e.preventDefault();
                var formData = jQuery(this).serialize();
                $.ajax({
                  type: "POST",
                  url: "../forms/update_forms.php?action=user",
                  data: formData,
                  success: function(html){
                    $.notify("Successfully updated!", successOptions);
                  var delay = 2000;
                    setTimeout(function(){  window.location.reload();   }, delay);  
                  
                  }
                });
                  return false;
            });
  </script>