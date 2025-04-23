<html>
  <head>
    <title>Forgot Password</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<style>
	  .form-gap {
			padding-top: 70px;
	   }
	   body{
		   background:#648cd4;
	   }
	</style>
  </head>
  <body>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <div class="form-gap"></div>
<div class="container">
    <div class="row">
	  <div class="col-md-4 col-md-offset-4">
	    <?php
		  if(!empty($this->session->flashdata('error'))){
			?>
			<div class="alert alert-danger">
			  <strong><center><?php echo $this->session->flashdata('error'); ?></center></strong> 
		    </div>
			<?php
		  }
		?>
	  </div>
	</div>
	<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
		  <div class="panel-body">
			<div class="text-center">
			  <h3><i class="fa fa-lock fa-4x"></i></h3>
			  <h2 class="text-center">Forgot Password?</h2>
			  <p>You can reset your password here.</p>
			  <div class="panel-body">

				<form action="<?php echo base_url('forgot_password/Forgot_password/fetch_username'); ?>" autocomplete="off" class="form" method="post">

				  <div class="form-group">
					<div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
					  <input id="email" name="uname" placeholder="User Name" class="form-control"  type="text" style='text-transform: uppercase;'required>
					</div>
				  </div>
				  <div class="form-group">
					<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Submit" type="submit">
				  </div>
				  
				  <input type="hidden" class="hide" name="token" id="token" value=""> 
				</form>

			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>
  </body>
</html>