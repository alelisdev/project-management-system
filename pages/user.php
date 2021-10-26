<?php
include '../includes/db.php'; ?>
<div class="col-md-12">
	<h4>Users</h4>

<hr style="border-bottom:1px solid black"></hr>
</div>
<div class="col-lg-12"  id="user_list">
	<div class="panel panel-default">
        <div class="panel-heading">
        <?php if ($_GET['active'] == '1') {
            $btn_class1 = 'class="btn btn-md btn-success"';
        } else {
            $btn_class1 = 'class="btn btn-md btn-default"';
        } ?>
        <?php if ($_GET['active'] == '2') {
            $btn_class = 'class="btn btn-md btn-success"';
        } else {
            $btn_class = 'class="btn btn-md btn-default"';
        } ?>
          <a href="index.php?page=user&active=1" <?php echo $btn_class1; ?> > Active</a>
          <a href="index.php?page=user&active=2" <?php echo $btn_class; ?> > Inactive</a>
          <a class="pull-right btn btn-md btn-info" onclick="new_user()" id="new_user"><center><i class="fa fa-plus"></i> New</center></a>
        </div> 
        <div class="panel-body"> 
			
       <table id="emp" class="table table-bordered table-condensed">
    <thead>
      <tr id="heads">
        <th class="col-md-3 text-center">user name</th>
        <th class="col-md-3 text-center">full name</th>
        <th class="col-md-3 text-center">birthday</th>
        <th class="col-md-1 text-center">operation</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $query = mysqli_query(
        $conn,
        "SELECT * FROM users where role = 200 and users.active = '" . $_GET['active'] . "'"
    );
    while ($row = mysqli_fetch_assoc($query)) {

        $username = $row['username'];
        $fullname = $row['fullname'];
        $birthday = $row['birthday'];
        $id = $row['uid'];
        ?>
      <tr>
        <td class="text-center"><?php echo $row[
            'username'
        ]; ?></td>
        <td class="text-center"><?php echo $row[
            'fullname'
        ]; ?></td>
        <td class="text-center"><?php echo $row[
            'birthday'
        ]; ?></td>
        <td class="text-center"><center><a onclick="edit_user('<?php echo $id; ?>')" ><i class="fa fa-edit"></i> Edit</a></center></td>
       </tr>

      <?php
    }
    ?>
    </tbody>
  </table>
		</div>
	</div>
</div>
<div class="col-md-4 pull-right">
  <div id="user">
  <center><h4>New User</h4></center>

  <hr style="border-bottom:1px solid grey"></hr>
  <div class="alert alert-success" id="msg"><i class="fa fa-check"></i> Data successfully added. </div>
  <div class="alert alert-danger" id="err"><i class="fa fa-error"></i> Error encounted. </div>
    <form id="user_form" method="POST">
      <div class="form-group">
        <div class="col-sm-4 text-right"><label for="us">username:</label></div>
        <div class="col-sm-8">
        <input type="text" class="form-control input-sm" id="us" name="username" required>
        </div>
      </div>
      <br>
      <div class="form-group">
        <div class="col-sm-4 text-right"><label for="us">fullname:</label></div>
        <div class="col-sm-8">
        <input type="text" class="form-control input-sm" id="fs" name="fullname" required>
        </div>
      </div>
      <br>
      <div class="form-group">
        <div class="col-sm-4 text-right"><label for="us">birthday:</label></div>
        <div class="col-sm-8">
        <input type="date" class="form-control input-sm" id="fs" name="birthday" required>
        </div>
      </div>
      <br>
      <div class="form-group">
        <div class="col-sm-4 text-right"><label for="pass">password:</label></div>
        <div class="col-sm-8">
        <input type="password" class="form-control input-sm" id="pass" name="pass" required>
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
  </div>
</div>

<script>
	jQuery(document).ready(function(){
    $('#user').hide();
		$('#msg').hide();
    $('#err').hide();

    jQuery("#user_form").submit(function(e){
        e.preventDefault();
        var formData = jQuery(this).serialize();
        $.ajax({
          type: "POST",
          url: "../forms/add_forms.php?action=user",
          data: formData,
          dataType: 'text',
          success: function(data){
              $('#msg').slideDown();
              var delay = 2000;
							setTimeout(function(){	
                $('#msg').slideUp(); 
                $('#user').hide();
                $('#user_list').removeClass('col-md-7').addClass("col-lg-12");
                $('#new_user').show('slideDown');
                window.location.reload();
              }, delay);
          }
        });
          return false;
    });
  });

  function new_user(){
    $('#new_user').hide('slideUp');
    $('#user').show('slideUp');
    $('#user_list').removeClass('col-lg-12').addClass("col-md-7");

  }
  function edit_user(i){
   $.ajax({
    url:"edit_user.php?uid="+i,
    success: function(html){
      $('#user').html(html);
      $('#new_user').hide();
      $('#user').show('SlideDown');
      $('#user_list').removeClass('col-lg-12').addClass("col-md-7");
    }
   });
  }
</script>

<script type="text/javascript">
        $(function() {
            $("#emp").dataTable(
        { "aaSorting": [[ 0, "asc" ]] }
      );
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

