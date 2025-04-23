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
			  <h3 class="text-center">Update Details</h3>
			  <p style="text-align:center;">Please Update Your Contact Details For Feature Update.</p>
			  <div class="panel-body">

				<?php echo form_open('Parentlogin/send_otp'); ?>
				  <div class="form-group">
					<div class="input-group">
					  <span class="input-group-addon"><i style="font-size:20px;" class="fa fa-mobile"></i></span>
					  <input name="number" placeholder="10 Digit Mobile Number" class="form-control"  maxlength="6" type="number" min="1" onkeypress="if(this.value.length==10){ return false;}" style='text-transform: uppercase;' required>
					</div>
				  </div>
				  <div class="form-group">
					<div class="input-group">
					  <span class="input-group-addon"><i style="font-size:20px;" class="fa fa-envelope"></i></span>
					  <input name="email" placeholder="Email-Id" class="form-control"   type="email" required>
					</div>
				  </div>
				  <div class="form-group">
					<input name="submit" class="btn btn-lg btn-primary btn-block" value="Generate otp" type="submit">
				  </div>
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