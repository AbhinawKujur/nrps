	<?php echo form_open_multipart('userauth/check_auth/scholarship_document'); ?> 
	<br><br>
	<input type="hidden" name="last_id" id="last_id" value="<?php echo $last_id;?>">
	<div class="container-fluid"> 
		<div class="row">
			<div class="col-md-4">
	                        <div class="form-group">
	                            <label>Scholarship Reference Number</label>
	                        </div>
	                    </div> 
	 		<div class="col-md-4">
	                        <div class="form-group">
	                            <input type="text" name="refno"  id="refno"  value="" class="form-control"/> 
	                        </div>
	                    </div> 
		</div> 
		<div class="row">
			<div class="col-md-4">
	                        <div class="form-group">
	                            <label>Do you have document to upload</label>
	                        </div>
	                    </div> 
	 		<div class="col-md-4">
	                        <div class="form-group">
	                            <select class='form-control' name='scholarship_dd' id="scholarship_dd"  >
	                            <option value="none">Select</option>
								  <option value="yes">Yes</option>
								  <option value="no">No</option>
								  
								</select>
	                        </div>
	         </div> 

		</div> 
		<div class="row">
			 <div id="upload"> 
	         	<div class="col-md-4">
	                        <div class="form-group">
	                            <label>Upload Document<span style="color:red">  (Not More Than 200KB)</span></label>
	                        </div>
	                    </div> 
<div class="col-md-4">
	                        <input type="file"  id="myFile" name="myFile">
  
	                    </div> 
	                    
	                    
	         </div>
		</div>
		<div class="row">
			<center>
			<input type="submit" class="btn btn-primary">
			</center>
		</div>
	</div>
<?php echo form_close(); ?>
	<script type="text/javascript">
		

	</script>