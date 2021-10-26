<div class="col-md-12">
  <h4>Payments</h4>
<hr style="border-bottom:1px solid black"></hr>
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a class="btn btn-md btn-success"  href="#new_payment" data-toggle="modal"><center><i class="fa fa-plus"></i> New </center></a>
        </div> 
        <div class="panel-body"> 
            <table id="emp" class="table table-bordered table-condensed">
                <thead>
                    <tr id="heads">
                        <th class="col-md-4 text-center">payment name</th>
                        <th class="col-md-4 text-center">address</th>
                        <th class="col-md-4 text-center">operation</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include '../includes/db.php';

                $query = mysqli_query(
                    $conn,
                    'SELECT * FROM payments where deleted_at is null'
                );

                while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td  class="text-center"><?php echo $row[
                            'name'
                        ]; ?></td>
                        <td  class="text-center"><?php echo $row[
                            'address'
                        ]; ?></td>
                        <td  class="text-center"><center><button onclick="javascript:deletePayment(<?php echo $row[
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

<div id="new_payment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog"> 
      <div class="modal-content modal-md">  
    
        <div class="modal-header"> 
            <h4 class="modal-title" id='head'>Add payment method</h4> 
        </div> 
        <form id="payment" method="POST">
          <div class="modal-body">
          
            <div class="form-group">
                <div class="col-sm-4 text-right"><label for="pn">Payment name:</label></div>
                <div class="col-sm-8">
                  <input type="text" class="form-control input-sm" id="pn" name="pn" placeholder="you must input, this is required." required>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-sm-4 text-right"><label for="pn">Address:</label></div>
                <div class="col-sm-8">
                  <input type="text" class="form-control input-sm" id="address" placeholder="this is not required." name="address">
                </div>
            </div>
            <br />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-md btn-info" id="btn_sub"><i class="fa fa-save"></i> Save</button>
                <button data-dismiss="modal" class="btn btn-md btn-info"><i class="glyphicon glyphicon-close"></i>Close</button>
            </div>
        </form>    
    </div> 
  </div>
</div>


<script type="text/javascript">

    jQuery(document).ready(function(){
        jQuery("#payment").submit(function(e){
        e.preventDefault();
        var formData = jQuery(this).serialize();
        $.ajax({
          type: "POST",
          url: "../forms/add_forms.php?action=payment",
          data: formData,
          success: function(html){
            $.notify("Successfully added!", successOptions);
            var delay = 2000;
            setTimeout(function(){  window.location.reload();   }, delay);
          }
        });
          return false;
        });
    })
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

    function deletePayment(id) {
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
                url: "../forms/update_forms.php?action=payment&&id="+id,
                success: function(html){
                        $.notify("Successfully deleted!", successOptions);
                        var delay = 2000;
                        setTimeout(
                            function() {  window.location = 'index.php?page=payment';   }, delay
                        );
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


