<!-- New Bid Modal -->
<div id="new_project" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog"> 
      <div class="modal-content modal-md">  
    
        <div class="modal-header"> 
            <h4 class="modal-title" id='head'>New Bid</h4>
        </div> 
        <form method="POST" id='proj_form'> 
          <div class="modal-body">


          <div class="form-horizontal">
              <div class="form-group" id="form-login">
                <label class="col-sm-4 control-label">Account Name:</label>
                <div class="col-sm-8">
                <select type="text" class="form-control input-sm"  autocomplete="off" name="account_name" id="account_name" required/>
                <option value="" selected="" disabled="">Select account name.</option>
                  <?php
                  include '../includes/db.php';
                  $query = mysqli_query(
                      $conn,
                      'SELECT * FROM accounts where deleted_at IS NULl order by id'
                  );
                  while ($row = mysqli_fetch_assoc($query)) { ?>
                  <option  value="<?php echo $row[
                      'name'
                  ]; ?>"><?php echo $row['name']; ?></option>
                  <?php }
                  ?>
                </select>
                </div>
              </div>
            <div class="form-group" id="form-login">
                <label class="col-sm-4 control-label">Client Name:</label>
                <div class="col-sm-8">
                  <input class="form-control"  id="" name="cname" type="text"  required>
                </div>
              </div>
            <div class="form-group" id="form-login">
                <label class="col-sm-4 control-label">Job Name:</label>
                <div class="col-sm-8">
                  <input class="form-control"  id="" name="jname" type="text"  required>
                </div>
              </div>
            <div class="form-group" id="form-login">
                <label class="col-sm-4 control-label">Applied Budget:</label>
                <div class="col-sm-6">
                  <input class="form-control" style="text-align:right" id="abname" name="abname" type="text" placeholder="$" required>
                </div>
              </div>
          </div>   
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info btn-sm" id="btn_sub"><i class="fa fa-save"></i> Save</button>
              <button data-dismiss="modal" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-close"></i>Close</button>
        </div>
      </form>
    </div> 
  </div>
</div>



<!-- New transaction Modal -->
<div id="new_transaction" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
               <div class="modal-content modal-md">  
             
                  <div class="modal-header"> 
                     <h4 class="modal-title" id='head'>
                     <i class=""></i> New Bid
                     </h4> 
                 
                  </div> 
                       <form method="POST" id='proj_form'> 
 <div class="modal-body">

   
    <div class="form-horizontal">
        
        <div class="form-group" id="form-login">
            <div class="col-sm-12">
             <div id="retCode2">
               <div class="alert alert-success" id="suc_msg2">
               <h4><i class="fa fa-check"></i> Data successfully added.</h4>
             </div>
             <div class="alert alert-danger" id="err_msg2">
               <h4><i class="fa fa-times"></i> Data failed to add.</h4>
             </div>
             </div>
             </div>
        </div>
         <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Account Name:</label>
          <div class="col-sm-8">
           <select type="text" class="form-control input-sm"  autocomplete="off" name="account_name" id="account_name" required/>
            <option></option>
            <?php
            include '../includes/db.php';
            $query = mysqli_query(
                $conn,
                'SELECT * FROM accounts where deleted_at IS NULl order by id'
            );
            while ($row = mysqli_fetch_assoc($query)) { ?>
            <option  value="<?php echo $row[
                'name'
            ]; ?>"><?php echo $row['name']; ?></option>
            <?php }
            ?>
          </select>
          </div>
        </div>
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Client Name:</label>
          <div class="col-sm-8">
            <input class="form-control"  id="" name="cname" type="text"  required>
          </div>
        </div>
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Job Name:</label>
          <div class="col-sm-8">
            <input class="form-control"  id="" name="jname" type="text"  required>
          </div>
        </div>
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Applied Budget:</label>
          <div class="col-sm-6">
            <input class="form-control" style="text-align:right" id="abname" name="abname" type="text" placeholder="$" required>
          </div>
        </div>
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Final Budget:</label>
          <div class="col-sm-6">
            <input class="form-control" style="text-align:right" id="fbaname" name="fbaname" type="text" placeholder="$">
          </div>
        </div>
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Status:</label>
          <div class="col-sm-8">
           <select type="text" class="form-control input-sm"  autocomplete="off" name="status" id="status" required/>
             <option  value="1">undefined</option>
            <option  value="2">hired</option>
          </select>
          </div>
        </div>

      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Bid Date:</label>
          <div class="col-sm-8">
            <input class="form-control"  id="bdate" name="bdate" type="date"  required>
          </div>
        </div>
    </div>
   </div>
          <div class="modal-footer">
               <button type="submit" class="btn btn-info btn-sm" id="btn_sub"><i class="fa fa-save"></i> Save</button>
                <button data-dismiss="modal" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-close"></i>Close</button>
            </form>
                     </div>
                     </div> 
            </div>
          </div>


<script>
  jQuery(document).ready(function(){
      $('#suc_msg2').hide();
      $('#err_msg2').hide();

});

  function div_field(){
    var id = $('#p_type').val();
    $.ajax({
                  url: "div_field.php?id="+id,
                  success: function(html){
                    $('#div-field').html(html);
                   
                  }
                });

  }
  function mem_list(){
    var id = $('#tid').val();
    $.ajax({
                  url: "mem_list.php?id="+id,
                  success: function(html){
                    $('#mem-field').html(html);
                   
                  }
                });

  }
  
</script>