<?php
error_reporting(0);
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Edit Driver Details </a> <i class="fa fa-angle-right"></i></li>
</ol>
<style type="text/css">
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  margin: 0px auto;
  z-index:999;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div class="loader" style="display:none;"></div>
<!-- Content Wrapper. Contains page content -->
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
<div class="col-sm-3"></div>
		<div class='col-sm-6'>
		   <?php
		     if($this->session->flashdata('msg')):
		   ?>
		    <div class="alert alert-success" role="alert" id="msg">
			  <strong><?php echo $this->session->flashdata('msg'); ?></strong>
			</div>  
		   <?php endif; ?>	  
		</div>
        <div class='col-sm-3'>		
		  <a href="<?php echo base_url('Driver_master/index'); ?>" class='btn btn-warning pull-right'>Back</a><br /><br /><br />
        </div>
	<form action="<?php echo base_url('Driver_master/update_save'); ?>" method="post">
	<input type='hidden' name='id_name' value="<?php echo $details->Driver_ID; ?>">
	<input type='hidden' name='incharge_id' id="incharge_id" value="<?php echo $details->incharge_id; ?>">
	<div class="row">
		<div class="col-sm-3">
		  <div class="form-group">
			<label>Select Vehicle No:</label><span class="span">*</span>
			<select class="form-control" name="vn" required>
				<option value="">Select</option>
				<?php
					foreach($bus_master as $key=>$value){
						?>
						<option <?php if($value->BusCode == $details->BusCode){echo "selected";} ?> value='<?php echo $value->BusCode; ?>'><?php echo $value->BusNo; ?></option>
						<?php
					}
				?>
			</select>
		  </div>
		</div>
		<div class="col-sm-3">
		  <div class="form-group">
			<label>Select Trip:</label><span class="span">*</span>
			<select class="form-control" name="tm" required>
				<option value="">Select</option>
				<?php
					foreach($bus_trip_master as $trip=>$tripvalue){
						?>
						<option <?php if($tripvalue->Trip_ID == $details->trip_id){echo "selected";} ?> value='<?php echo $tripvalue->Trip_ID; ?>'><?php echo $tripvalue->Trip_Nm; ?></option>
						<?php
					}
				?>
			</select>
		  </div>
		</div>
		<div class="col-sm-6">
		  <div class="form-group">
			<label>Driver Name:</label><span class="span">*</span>
			<input type="text" class="form-control" value="<?php echo $details->driver_name; ?>" name="dn" required pattern="[a-zA-Z ]{2,}">
		  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label>Driver Date of Birth</label><span class="span">*</span>
				<input type="date" value="<?php echo date('Y-m-d',strtotime($details->driver_dob)); ?>" name="ddb" class="form-control" required>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Driver Phone No:</label><span class="span">*</span>
				<input type="number" name="dpn" min="1" class="form-control" value="<?php echo $details->driver_ph_no; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Driver Address:</label><span class="span">*</span>
				<input type="text" name="da" class="form-control" value="<?php echo $details->driver_address; ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label>Driver License No:</label><span class="span">*</span>
				<input type="text" name="dln" value="<?php echo $details->driver_license_no; ?>" name="ddb" class="form-control" required>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Khallasi Name:</label><span class="span">*</span>
				<input type="text" name="kn" pattern='[a-zA-Z ]{2,}' class="form-control" value="<?php echo $details->khallasi_nm; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Khallasi Phone No:</label><span class="span">*</span>
				<input type="text" name="kph" class="form-control" value="<?php echo $details->khallasi_ph_no; ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Incharge Name:</label><span class="span">*</span>
				<select class="form-control" required name="in" onchange='getinchargenumber(this.value)'>
					<option value="">select</option>
					<?php
						foreach($incharge as $in=>$inval){
							?>
								<option <?php if($inval->Incharge_Id == $details->incharge_id){echo "selected";} ?> value="<?php echo $inval->Incharge_Id ?>"><?php echo $inval->Incharge_nm; ?></option>
							<?php
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Incharge Phone No:</label><span class="span">*</span>
				<input type="number" readonly id='incharge_ph' name="ipn" min='1' class="form-control" value="<?php echo $details->Incharge_ph_no; ?>">
			</div>
		</div>
	</div>
	<button class='pull-right btn btn-success'>Save</button>
	</form>
</div><br></br>
<div class="clearflex"></div>
<script>
	function getinchargenumber(val){
		$.ajax({
			url: "<?php echo base_url('Driver_master/changeinchargephone'); ?>",
			type: "POST",
			data: {val:val},
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
				var user = JSON.parse(data);
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				$('#incharge_ph').val(user[0]);
				$('#incharge_id').val(user[1]);
			},
		});
	}
</script>