<?php include '../includes/db.php'; ?>


<!-- Task Modal -->
<div id="pos<?php echo $id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
               <div class="modal-content modal-md">  
             
                  <div class="modal-header"> 
                     <h4 class="modal-title" id='head'>
                     <i class=""></i> 
                     </h4> 
                     <div id="retCode"></div>
                  </div> 
                       <form method="POST" id='update_pos' > 
 <div class="modal-body">

   
    <div class="form-horizontal">
        
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">start date</label>
          <div class="col-sm-8">
          <input name="id" value='<?php echo $id; ?>' type='hidden'>
        <input class="form-control"  id="sdate" name="sdate" type="date" value="<?php echo $row[
            'start_date'
        ]; ?>" required>
          </div>
        </div>
        <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">end date</label>
          <div class="col-sm-8">        
            <input class="form-control"  id="edate" name="edate" type="date" value="<?php echo $row[
                'end_date'
            ]; ?>" required>
          </div>
        </div>
        <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">applied budget</label>
          <div class="col-sm-8">

            <input class="form-control" style="text-align:right" id="" name="abg" type="text" value="<?php echo $row[
                'applied_budget'
            ]; ?>" required>
          </div>
        </div>
        <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">final budget</label>
          <div class="col-sm-8">

            <input class="form-control" style="text-align:right" id="" name="fbg" type="text" value="<?php echo $row[
                'final_budget'
            ]; ?>" required>
          </div>
        </div>

        <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">status</label>
          <div class="col-sm-8">

            <select class="form-control"  id="status" name="status" type="text"  required>
            <option value="" selected="" disabled="">Select current status.</option>
            <option  value="2">hired</option>
            <option  value="3">completed</option>
            <option  value="4">canceled</option>
            </select>
          </div>
        </div>

    </div>
   </div>
          <div class="modal-footer">
               <button type="submit" class="btn btn-info" id="btn_sub"><i class="fa fa-save"></i>Update</button>
                <button data-dismiss="modal" class="btn btn-info"><i class="glyphicon glyphicon-close"></i>Close</button>
            </form>
                     </div>
                     </div> 
            </div>
          </div>


<div id="bid<?php echo $id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog"> 
      <div class="modal-content modal-md">  
    
        <div class="modal-header"> 
            <h4 class="modal-title" id='head'>Set task</h4>
        </div> 
        <form method="POST" id='update_bid'>
          <div class="modal-body">


            <div class="form-horizontal">
        
              <div class="form-group" id="form-login">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                <label class="col-sm-4 control-label">Final Budget:</label>
                <div class="col-sm-6">
                  <input class="form-control" style="text-align:right" id="fbname" name="fbname" type="text" placeholder="$" required>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info" id="btn_sub">OK</button>
            <button data-dismiss="modal" class="btn btn-info">Cancel</button>
          </div>
        </form>
            
      </div> 
  </div>
</div>




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
    $('#suc_msg').hide();
    $('#suc_msg1').hide();
    $('#err_msg1').hide();
    $('#suc_msg2').hide();
    $('#err_msg2').hide();
            jQuery("#update_pos").submit(function(e){
                e.preventDefault();
                var formData = jQuery(this).serialize();
                $.ajax({
                  type: "POST",
                  url: "../forms/update_forms.php?action=position",
                  data: formData,
                  success: function(html){
                    
                    var delay = 1500;
                    setTimeout(function(){  window.location = 'index.php?page=position';   }, delay);  
                  
                  }
                });
                  return false;
            });

            jQuery("#update_bid").submit(function(e){
                e.preventDefault();
                var formData = jQuery(this).serialize();
                $.ajax({
                  type: "POST",
                  url: "../forms/update_forms.php?action=bid",
                  data: formData,
                  success: function(html){
                    $.notify("Successfully set to task!", successOptions);
                    var delay = 1500;
                    setTimeout(function(){  window.location = 'index.php?page=bid';   }, delay);
                  }
                });
                  return false;
            });

            jQuery("#update_employee").submit(function(e){
                e.preventDefault();
                var formData = jQuery(this).serialize();
                $.ajax({
                  type: "POST",
                  url: "../forms/update_forms.php?action=employee",
                  data: formData,
                  success: function(html){
                   $('#retCode2').append(html);
                  
                  
                  }
                });
                  return false;
            });

            });
</script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>