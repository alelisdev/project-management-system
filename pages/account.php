<div class="col-md-12">
  <h4>Accounts</h4>
<hr style="border-bottom:1px solid black"></hr>
</div>
<div class="col-lg-12">
  <div class="panel panel-default">
        <div class="panel-heading">
          <a class="btn btn-md btn-success"  href="#new_account" data-toggle="modal"><center><i class="fa fa-plus"></i> New</center></a>
        </div> 
      <div class="panel-body">
        </div> 
        <div class="panel-body"> 
  
      
       <table id="emp" class="table table-bordered table-condensed">
    <thead>
      <tr id="heads">
        <th class="col-md-4 text-center">Account Name</th>
        <th class="col-md-5 text-center">Country Name</th>
        <th class="col-md-3 text-center">Operation</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include '../includes/db.php';

    $query = mysqli_query(
        $conn,
        'SELECT * FROM accounts where deleted_at is null'
    );

    while ($row = mysqli_fetch_assoc($query)) { ?>
      <tr>
        <td  class="text-center"><?php echo $row[
            'name'
        ]; ?></td>
        <td  class="text-center"><?php echo $row[
            'country'
        ]; ?></td>
        <td  class="text-center"><center><button onclick="javascript:deleteAccount(<?php echo $row[
            'id'
        ]; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-cycle"></i> Delete</button></center></td>
       </tr>

      <?php }
    ?>
    </tbody>
  </table>
    </div>
  </div>
</div>
<div class="col-md-2">
  
  
</div>
<div id="retCode1"></div>


<div id="new_account" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
               <div class="modal-content modal-md">  
             
                  <div class="modal-header"> 
                     <h4 class="modal-title" id='head'>
                     <i class=""></i> New Account
                     </h4> 
                 
                  </div> 
                       <form method="POST" id='account_form'>
 <div class="modal-body">

   
    <div class="form-horizontal">
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Account Name:</label>
          <div class="col-sm-8">
            <input class="form-control"  id="" name="a_name" type="text"  required>
          </div>
        </div>
   
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Country Name:</label>
          <div class="col-sm-8">
            <input class="form-control"  id="" name="c_name" type="text"  required>
          </div>
        </div>
    </div>
   </div>
  <div class="modal-footer">
       <button type="submit" class="btn btn-info btn-sm" id="btn_sub">Save</button>
        <button data-dismiss="modal" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-close"></i>Close</button>
    </form>
             </div>
             </div> 
    </div>
  </div>

<script>
  var successOptions = {
        autoHideDelay: 2000,
        showAnimation: "fadeIn",
        hideAnimation: "fadeOut",
        hideDuration: 700,
        arrowShow: false,
        className: "success",
    };

    var errorOptions = {
        autoHideDelay: 2000,
        showAnimation: "fadeIn",
        hideAnimation: "fadeOut",
        hideDuration: 700,
        arrowShow: false,
        className: "error",
    };


  jQuery(document).ready(function(){

    jQuery("#account_form").submit(function(e){
          e.preventDefault();
          var formData = jQuery(this).serialize();
          $.ajax({
            type: "POST",
            url: "../forms/add_forms.php?action=account",
            data: formData,
            success: function(html){
              $.notify("Successfully created!", successOptions);
            var delay = 2000;
              setTimeout(function() {  window.location = 'index.php?page=account';   }, delay);
            }
          });
            return false;
      });
    });
</script>


<script type="text/javascript">

  function deleteAccount(id) {
    swal({
      title: "Are you sure?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Yes!',
      cancelButtonText: 'No',
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
              type: "GET",
              url: "../forms/update_forms.php?action=account&&id="+id,
              success: function(html){
                $.notify("Successfully deleted!", successOptions);
                var delay = 2000;
                setTimeout(function() {  window.location = 'index.php?page=account';   }, delay);
                }
        });
      } else {
      }
    })
   
  }
  $(function() {
      $("#emp").dataTable(
        { "aaSorting": [[ 2, "asc" ]] }
      );
  });
</script>


