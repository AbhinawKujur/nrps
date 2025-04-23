

<?php
error_reporting(0);

//$otp_msg = $this->session->userdata('rand'); 

?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Visitor Form</a> <i class="fa fa-angle-right"></i></li>
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
.span{
	
	color:red;
}
</style>




<div class="loader" style="display:none;"></div>
<!-- Content Wrapper. Contains page content -->
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
<div class="col-sm-3"></div>
<div class="row">
		<div class='col-sm-6'>
		   <?php
		     if($this->session->flashdata('msg')):
		   ?>
		    <div class="alert alert-success" role="alert" id="msg">
			  <strong><?php echo $this->session->flashdata('msg'); ?></strong>
			</div>  
		   <?php endif; ?>	  
		</div>
	    
        <div class='col-sm-9'>		
			
		  <a href="<?php echo base_url('reception/Visitreg_form/index'); ?>" class='btn btn-warning pull-right'>Back</a><br /><br /><br />
        </div>
		</div>
	<form name="reg_form" id="reg_form" action="<?php echo base_url('reception/Visitreg_form/save_visit'); ?>" method="post" enctype="multipart/form-data">
	
	<div class="row">
	<div class="col-sm-4">
		  <div class="form-group">
			<label><b>Visit Date</b></label><span class="span"></span>
			<input type="date" name="vis_date" id='vis_date' class="form-control" value="<?php echo $today_date;?>">
		  </div>
		</div>
		<div class="col-sm-4">
		  <div class="form-group">
			<label><b>Entry Mode</b></label><span class="span">*</span>
			<select class='form-control' id='mode_id' name='mode_id' required>
					<option value=''>Select</option>
					<?php
						foreach($mode_data as $key => $val){
							?>
								<option value='<?php echo $val->id; ?>'><?php echo $val->mode_type; ?></option>
							<?php
						}
					?>
			</select>
		  </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label><b>Department</b></label><span class="span">*</span>
				<select class='form-control' id='dept' name='dept' required>
					<option value=''>Select</option>
					<?php
						foreach($dept_data as $key => $val){
							?>
								<option value='<?php echo $val->id; ?>'><?php echo $val->dept; ?></option>
							<?php
						}
					?>
			   </select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label><b>Visitor Purpose</b></label><span class="span">*</span>
				<select class='form-control' id='vis_purpose' name='vis_purpose' required>
					<option value=''>Select</option>
					<?php
						foreach($pur_data as $key => $val){
							?>
								<option value='<?php echo $val->id; ?>'><?php echo $val->vis_purpose; ?></option>
							<?php
						}
					?>
			   </select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label><b>Visitor Type</b></label><span class="span">*</span>
				<select class='form-control' id='vis_type' name='vis_type' required onchange="visit_val(this.value)">
					<option value=''>Select</option>
					<?php
						foreach($type_data as $key => $val){
							?>
								<option value='<?php echo $val->id; ?>'><?php echo $val->vis_type; ?></option>
							<?php
						}
					?>
			   </select>
			</div>
			<label id='sss' style='color:red;'></label>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<label><b>Photo</b></label>
				<input type='file' name='img' id='stu_photo' class='form-control'>
			</div>
		</div>
		
		
		<div class="col-md-4" id="emp" style="display:none;">
			<div class="form-group">
				<label><b>Employee Name</b></label><span class="span"></span>
				<select class='form-control' id='emp_id' name='emp_id' onchange="emp_fil(this.value)" style='width:100%'>
					<option value=''>Select</option>
					<?php
						foreach($emp_data as $key => $val){
							?>
								<option value='<?php echo $val->EMPID; ?>'><?php echo $val->EMPID. ' ('.$val->EMP_FNAME.'  '.$val->EMP_MNAME.')'; ?></option>
							<?php
						}
					?>
			   </select>
			</div>
		</div>
		
		<div class="col-md-4" id="suppl" style="display:none;">
			<div class="form-group">
				<label><b>Supplier Name</b></label><span class="span"></span>
				<select class='form-control' id='sup_id' name='sup_id' onchange="suppl_fil(this.value)" style='width:100%'>
					<option value=''>Select</option>
					<?php
						foreach($supp_data as $key => $val){
							?>
								<option value='<?php echo $val->Supplier_ID; ?>'><?php echo $val->Supplier_Name; ?></option>
							<?php
						}
					?>
			   </select>
			</div>
		</div>
		
	</div>
	
	<div class="row" id="stt" style="display:none;">
		
		<div class="col-md-6">
			<div class="form-group">
				<label><b>Student Admission No.</b></label><span class="span">*</span>
				<select class='form-control' id='stu_id' name='stu_id' onchange="stu_fil(this.value)" style='width:100%'>
					<option value=''>Select</option>
					<?php
						foreach($stuid_data as $key => $val){
							?>
								<option value='<?php echo $val->STUDENTID; ?>'><?php echo $val->ADM_NO. ' ('.$val->FIRST_NM.')'. ' ('.$val->DISP_CLASS.'  '.$val->DISP_SEC.')'; ?></option>
							<?php
						}
					?>
			   </select>
			</div>
		</div>
		
		<div class="col-md-3" id="suu" style="display:none;">
			<div class="form-group">
				<label><b>Student Name</b></label><span class="span"></span>
				<input type="text" id='stu_name' readonly name="stu_name" maxlength="12" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="form-group">
				<label><b>Class</b></label><span class="span"></span>
				<input type="text" readonly name="stu_class" id='stu_class' class="form-control" required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 58' maxlength="5">
				
			</div>
		</div>
		
		<div class="col-md-3" id="stuu" style="display:none;">
			<div class="form-group">
				<label><b>Section</b></label><span class="span"></span>
				<input type="text" id='stu_sec' readonly name="stu_sec" maxlength="12" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
			</div>
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label><b>Name</b></label><span class="span">*</span>
				<input type="text" name="name" id='name' class="form-control" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46 || event.charCode == 47' maxlength="30" required >
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label><b>Mobile</b></label><span class="span">*</span>
				<input type="text" id='mobile' name="mobile" maxlength="12" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
			</div>
		</div>
		
		<div class="col-md-4" >
			<div class="form-group">
				<label><b>Verify Mobile No.(with OTP)</b></label><span class="span">*</span>
				<select class='form-control' id='otp' name='otp' required onchange="gen_otp(this.value)">
					<!--<option value=''>Select</option>-->
					<!--<option value='Yes'>Yes</option>-->
					<option value='No'>No</option>
				</select>
			</div>
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label><b>In time</b></label><span class="span"></span>
				<input type="text" name="in_time" id='in_time' class="form-control" required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 58' maxlength="5" value="<?php echo $cur_time;?>">
				
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label><b>Remarks</b></label><span class="span"></span>
				<textarea rows="5" cols="50" id="remarks" name="remarks" maxlength="150" ></textarea>
			</div>
		</div>
		</div>
	<div class="row">
	<div class="col-md-4">
	
	</div>
	</div>
	 <!-- Modal-->
	
  </div>
	
	<button class='pull-right btn btn-success'>Save</button>
	
	</form>
<br></br>
<div class="clearflex"></div>
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title" style="color:red;">Authenticate OTP</h4>
        </div>
        <div class="modal-body">
		 <table class="table table-bordered">
		 <tr>
		 <td>
         <input type="text" name="ottpp" id="ottpp" placeholder="Enter 4 digit OTP" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4">
		 </td>
		 </tr>
		 </table>
        </div>
        <div class="modal-footer">
         <button class='btn btn-success btn-sm' onclick="verify_otp()">OK</button>
        </div>
      </div>
      
    </div>
  </div>

<script>

	
 $("#emp_id").select2();
 $("#stu_id").select2();
 
 $("#stu_photo").change(function(){
	$(".file_upload1").css("border-color","#F0F0F0");
	var file_size = $('#stu_photo')[0].files[0].size;
	var ext = $('#stu_photo').val().split('.').pop().toLowerCase();
		if(file_size > 200000 || !(ext == 'png' || ext == 'PNG' || ext == 'jpg' || ext == 'JPG' || ext == 'jpeg' || ext == 'JPEG')){
			alert('File size must be less than 200kb allowed format JPG,JPEG,PNG only','');
			$("#stu_photo").val('');
			return false;
		}
	return true;
});
 
 
 $('#msg').fadeIn().delay(2000).fadeOut();
	function gen_otp(val)
	{
		var data = val;
		var mob = $("#mobile").val();
		
		if(data == 'Yes' && mob !=''){
		//$('#entt_otp').show();
		$('#myModal').modal({
			backdrop: 'static', keyboard: false
		});
		$.ajax({
        url : "<?php echo base_url('reception/Visitreg_form/genn_otp') ?>",
        type: "POST",
		data: {mob:mob},
		dataType:"json",
        success: function(data)
        {
			
          var a=data.msg;
		  if(a=='S')
                {
                  
                  $('#ss').text('OTP in your Reg. Mobile');
				  $('#ss').fadeIn().delay(2000).fadeOut();
				  //$('#r_otp').val(otp_msg);
				  
                }
		  
		}, 
    }); 
	}
	else if(data == 'No')
	{
		//$('#entt_otp').hide();
		
	}
	}
	function visit_val(val)
	{
		var vis_type = val;
		var dept = $("#dept").val();
		var purpose = $("#vis_purpose").val();
		
		if(vis_type == '2')
		{
			$('#stt').show();
			$('#suu').show();
			$('#emp').hide();
			$('#stuu').hide();
			$('#suppl').hide();
			$('#stu_id').val(null).trigger('change');
			$('#emp_id').val(null).trigger('change');
			$("#stu_name").val('');
			$("#stu_class").val('');
			$("#name").val('');
			$("#mobile").val('');
			
		}
		else if(vis_type == '3')
		{	
			$('#emp').show();
			$('#stt').hide();
			$('#stuu').hide();
			$('#suppl').hide();
			$('#stu_id').val(null).trigger('change');
			$('#emp_id').val(null).trigger('change');
			$("#stu_name").val('');
			$("#stu_class").val('');
			$("#name").val('');
			$("#mobile").val('');
			
		}
		else if(vis_type == '1')
		{	
			$('#suu').hide();
			$('#stt').show();
			$('#stuu').show();
			$('#emp').hide();
			$('#suppl').hide();
			$('#stu_id').val(null).trigger('change');
			$('#emp_id').val(null).trigger('change');
			$("#stu_name").val('');
			$("#stu_class").val('');
			$("#name").val('');
			$("#mobile").val('');
			
		}
		else if(vis_type == '4')
		{	
			$('#suu').hide();
			$('#suppl').show();
			$('#stt').hide();
			$('#stuu').hide();
			$('#emp').hide();
			$('#stu_id').val(null).trigger('change');
			$('#emp_id').val(null).trigger('change');
			$("#stu_name").val('');
			$("#stu_class").val('');
			$("#name").val('');
			$("#mobile").val('');
		}
		else{
			
			$('#stt').hide();
			$('#suu').hide();
			$('#emp').hide();
			$('#stuu').hide();
			$('#suppl').hide();
			$("#mob_no").val('');
			$("#name").val('');
			$("#mobile").val('');
			$('#end_date').prop('readonly', false);
		}
		
		$.ajax({
        url : "<?php echo base_url('reception/Visitreg_form/visit_val') ?>",
        type: "POST",
		data: {vis_type:vis_type,dept:dept,purpose:purpose},
		dataType:"json",
        success: function(data)
        {
          var a=data.msg;
		  if(a=='S')
                {
                  
                  $('#sss').text('Today visit count over!!');
				  $('#sss').fadeIn().delay(2000).fadeOut();
				  $("#vis_type").val('');
                  $("#dept").val('');
				  $("#vis_purpose").val('');
				  
                }
		  
		}, 
    }); 
	}
	function verify_otp()
	{
		var get_otp = $("#ottpp").val();
		if(get_otp != '')
		{
		$.ajax({
        url : "<?php echo base_url('reception/Visitreg_form/verify_otp') ?>",
        type: "POST",
		data: {get_otp:get_otp},
		dataType:"json",
        success: function(data)
        {
         if(data == '1')
		 {
			 $('#myModal').modal('hide');
		 }
		 else{
			 $.toast({
					heading: 'Error',
					text: 'Invalid OTP',
					showHideTransition: 'slide',
					icon: 'error',
					position: 'top-right',
				});
				$("#ottpp").val('');
		 }
		}, 
    }); 
		}
		
	}
	function stu_fil(val)
	{
		var stu_id = val;
		$.ajax({
        url : "<?php echo base_url('reception/Visitreg_form/stu_fil') ?>",
        type: "POST",
		data: {stu_id:stu_id},
		dataType:"json",
        success: function(data)
        {
         
				  $("#stu_name").val(data.stu_name);
                  $("#stu_class").val(data.stu_class);
				  $("#stu_sec").val(data.stuu_sec);
				  $("#name").val(data.father_name);
				  $("#mobile").val(data.father_mob);
				 
		}, 
    }); 
	}
	function emp_fil(val)
	{
		var vis_date = $("#vis_date").val();
		var mode_id = $("#mode_id").val();
		var dept = $("#dept").val();
		var vis_purpose = $("#vis_purpose").val();
		var vis_type = $("#vis_type").val();
		var emp_id = val;
		$.ajax({
        url : "<?php echo base_url('reception/Visitreg_form/emp_fil') ?>",
        type: "POST",
		data: {emp_id:emp_id},
		dataType:"json",
        success: function(data)
        {
         
				  $("#name").val(data.emp_name);
				  $("#mobile").val(data.emp_mob);
				  
		}, 
    }); 
	
	}
	
	function suppl_fil(val)
	{
		var vis_date = $("#vis_date").val();
		var mode_id = $("#mode_id").val();
		var dept = $("#dept").val();
		var vis_purpose = $("#vis_purpose").val();
		var vis_type = $("#vis_type").val();
		var sup_id = val;
		$.ajax({
        url : "<?php echo base_url('reception/Visitreg_form/supp_fil') ?>",
        type: "POST",
		data: {sup_id:sup_id},
		dataType:"json",
        success: function(data)
        {
         
				  $("#name").val(data.supp_name);
				  $("#mobile").val(data.supp_mob);
				  
		}, 
    }); 
	}
	function stuu_fil(val)
	{
		var stuu_id = val;
		$.ajax({
        url : "<?php echo base_url('reception/Visitreg_form/stuu_fil') ?>",
        type: "POST",
		data: {stuu_id:stuu_id},
		dataType:"json",
        success: function(data)
        {
         
                  $("#stu_class").val(data.stuu_class);
				  $("#stu_sec").val(data.stuu_sec);
				  $("#name").val(data.stu_name);
				  $("#mobile").val(data.father_mob);
				 
		}, 
    }); 
	}
	
</script>