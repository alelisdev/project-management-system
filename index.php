<?php

session_start();
include 'includes/header2.php';
if (isset($_SESSION['UID'])) {
    header('location:pages/index.php');
}
?>
<style>
	label {
		font-weight: 100 !important;
	}

	#title1 {
		display: block;
		width:50%;
		height:90px;
		background-color: white;
		padding:1px;
		border-radius:5px;
		position:fixed;
		top:30%;
		z-index: 1000px;
	}
	#main-bod{
		background: url(assets/images/login.jpg);
		background-repeat: no-repeat;
		background-size: cover;
		display:flex;
		height:calc(100%);
		width:calc(100%);
		align-items:center;
		justify-content:center;
		top: 0;
		margin:unset
	}
</style>
<body id="main-bod">
	<div class="col-lg-5">
		<div class="panel panel-info" style="">
			<div class="panel-heading">
				Login
			</div>
			<div class="panel-body">
					<div class="container-fluid">
					<form class="form-horizontal" method="POST" id="login_form">
					<div class="form-group" id="form-login">
						<label for="" class="control-label">Username</label>
						<input class="form-control" id="user" name="user" type="text">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Password</label>
						<input type="password" name="pass" id="pass" class="form-control">
					</div>
					<div class="form-group" id="msg">
					<div class="col-sm-8 col-sm-offset-10">
						<button type="submit" class="btn btn-info">Login</button> <br>
					</div>
					</div>
				</form>
			</div> 
		</div>
	</div>
</body>
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
		jQuery("#login_form").submit(function(e){
				e.preventDefault();
				var formData = jQuery(this).serialize();
				$.ajax({
					type: "POST",
					url: "includes/login.php",
					data: formData,
					success: function(html){
						if(html=='true' )
						{
							$.notify("Successfully login!", successOptions);
							var delay = 2000;
							setTimeout(function(){	window.location = 'pages/index.php?page=home';   }, delay);  
						} else {
							$.notify("Error log in!", errorOptions);
						}
					}
				});
		});
	});
</script>