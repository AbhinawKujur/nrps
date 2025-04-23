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
		  if(!empty($this->session->flashdata('otp_error'))){
			?>
			<div class="alert alert-danger">
			  <strong><center><?php echo $this->session->flashdata('otp_error'); ?></center></strong> 
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
			  <img src="<?php echo base_url($this->session->userdata('school_logo')); ?>" alt="" class="responsive-img circle" style="width:100px;">
			  <h2 class="text-center">OTP VERIFICATION</h2>
			  <p>OTP IS SENDED ON YOUR MOBILE NUMBER</p>
			  <div class="panel-body">

				<?php echo form_open('Parentlogin/verify_otp'); ?>
				  <div class="form-group">
					<div class="input-group">
					  <span class="input-group-addon"><i class="fa fa-key"></i></span>
					  <input id="otp" name="otp" placeholder="Enter 6 Digit OTP" class="form-control"  maxlength="6" type="text" style='text-transform: uppercase;' required>
					</div>
				  </div>
				  <div class="form-group">
					<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Submit" type="submit">
				  </div>
				  
				  <input type="hidden" class="hide" name="token" id="token" value=""> 
				<?php echo form_close(); ?>

			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>
  </body>
</html>