<style>
	label span{
		color:red;
		font-weight:bold;
	}
	fieldset.scheduler-border {
		border: 1px groove #ddd !important;
		padding: 0 1.4em 1.4em 1.4em !important;
		margin: 0 0 1.5em 0 !important;
		-webkit-box-shadow:  0px 0px 0px 0px #000;
				box-shadow:  0px 0px 0px 0px #000;
	}

	legend.scheduler-border {
		font-size: 1.2em !important;
		font-weight: bold !important;
		text-align: left !important;
		width:inherit; /* Or auto */
		padding:0 10px; /* To give a bit of padding on the left and right */
		border-bottom:none;
	}
	.main{
		background:#eee;
		padding:10px;
	}
	body{
		font-family: Verdana,Geneva,sans-serif !important; 
	}
	input,select,textarea{
		text-transform: uppercase
	}
	.form-control:focus{
		border:1px solid red;
	}
</style>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">My Form</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

   
    <section class="content">
      <div class="card">
        <div class="card-body">
          <form autocomplete='off' action='<?php echo base_url('adm_three/Adm_nur/payNow'); ?>' method='POST'>
			<fieldset class="scheduler-border">
			<legend class="scheduler-border">BASIC DETAILS</legend>
			<div class='row'>
				<div class='col-sm-4'>
				<input type='hidden' name='upd_id' value='<?php echo $stuData[0]['id']; ?>'>
					<div class="form-group">
						<label>Applicant's Name <span>*</span></label>
						<input type="text" value='<?php echo $stuData[0]['stu_nm']; ?>' class="form-control" name='stu_nm' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' disabled>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Date of Birth <span>*</span></label>
						<input type="text" value='<?php echo date('d-M-y',strtotime($stuData[0]['dob'])); ?>' class="form-control datepicker" name='dob' disabled>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Gender <span>*</span></label>
						<select class="form-control" name='gender' disabled>
							<option value=''>Select</option>
							<option value='1' <?php if($stuData[0]['gender'] == 1){ echo "selected"; }?>>Male</option>
							<option value='2' <?php if($stuData[0]['gender'] == 2){ echo "selected"; }?>>Female</option>
						</select>
					</div>
				</div>
			
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Physically Challenged</label>
						<select class="form-control" name='phy_challenged' disabled>
							<option value=''>Select</option>
							<option value='YES' <?php if($stuData[0]['phy_challenged'] == 'YES'){ echo "selected"; }?>>YES</option>
							<option value='NO' <?php if($stuData[0]['phy_challenged'] == 'NO'){ echo "selected"; }?>>NO</option>
						</select>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Category <span>*</span></label>
						<select class="form-control" name='category' disabled>
							<option value=''>Select</option>
							<?php
								foreach($category as $key => $val){
									?>
										<option value='<?php echo $val['CAT_CODE']; ?>' <?php if($stuData[0]['category'] == $val['CAT_CODE']){ echo "selected"; }?>><?php echo $val['CAT_DESC']; ?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Aadhaar No.</label>
						<input type="number" value='<?php echo $stuData[0]['aadhaar_no']; ?>'class="form-control" id='aadhaar_no' name='aadhaar_no' onkeypress="if(this.value.length==12) { return false;}" min='0' disabled onchange='no_validate(12,this)'>
					</div>
				</div>	
			
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Mother Tongue <span>*</span></label>
						<select class="form-control" name='mother_tounge' disabled>
							<option value=''>Select</option>
							<?php
								foreach($motherTounge as $key => $val){
									?>
										<option value='<?php echo $key; ?>' <?php if($key == $stuData[0]['mother_tounge']){ echo "selected"; }?>><?php echo $val; ?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Religion <span>*</span></label>
						<select class="form-control" name='religion' disabled>
							<option value=''>Select</option>
							<?php
								foreach($religion as $key => $val){
									?>
										<option value='<?php echo $val['RNo']; ?>' <?php if($stuData[0]['religion'] == $val['RNo']){ echo "selected"; }?>><?php echo $val['Rname']; ?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
			
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Blood Group <span>*</span></label>
						<select class="form-control" name='blood_group' disabled>
							<option value=''>Select</option>
							<?php
								foreach($bloodGroup as $key => $val){
									?>
										<option value='<?php echo $key; ?>' <?php if($key == $stuData[0]['blood_group']) { echo "selected"; } ?>><?php echo $val; ?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>

				<div class='col-sm-4'>
					<div class="form-group">
						<label>Photograph <span>*</span></label>
						<span style='font-size:10.5px;'><i><b>File size must be less than 200kb allowed format JPG,JPEG,PNG only</b></i></span>
						<input type='file' id='filePHOTO' name='img' class='form-control file_upload1' onchange='img_validate()' disabled>
					</div>
				</div>	
				
				<div class='col-sm-4'>
					<div style='text-align:left; margin-top:20px;'><img src='<?php echo base_url($stuData[0]['img']); ?>' style='width:100px'></div>
				</div>
			</div>
			</fieldset>
			
			<fieldset class="scheduler-border">
				<legend class="scheduler-border">PARENT'S DETAILS</legend>
					<div class='row'>	
						<div class='col-sm-6'>
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">FATHER'S DETAILS</legend>
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Name <span>*</span></label>
										<input type="text" value='<?php echo $stuData[0]['f_name']; ?>' class="form-control" name='f_name' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' disabled>
									</div>
								</div>
								
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Qualification <span>*</span></label>
										<select class="form-control" name='f_qualification' disabled>
											<option value=''>Select</option>
											<?php
												foreach($parent_qualification as $key => $val){
													?>
														<option value='<?php echo $key; ?>' <?php if($key == $stuData[0]['f_qualification']){ echo "selected"; } ?>><?php echo $val; ?></option>
													<?php
												}
											?>
										</select>
									</div>
								</div>
								
								<div class='row'>
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Occupation <span>*</span></label>
										<select class="form-control" name='f_accupation' disabled>
											<option value=''>Select</option>
											<?php
												foreach($parent_accupation as $key => $val){
													?>
														<option value='<?php echo $key; ?>' <?php if($key == $stuData[0]['f_accupation']){ echo "selected"; } ?>><?php echo $val; ?></option>
													<?php
												}
											?>
										</select>
									</div>
								</div>
								</div>
							</fieldset>	
						</div>
						
						<div class='col-sm-6'>
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">MOTHER'S DETAILS</legend>
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Name <span>*</span></label>
										<input type="text" value='<?php echo $stuData[0]['m_name']; ?>' class="form-control" name='m_name' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' disabled>
									</div>
								</div>
								
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Qualification <span>*</span></label>
										<select class="form-control" name='m_qualification' disabled>
											<option value=''>Select</option>
											<?php
												foreach($parent_qualification as $key => $val){
													?>
														<option value='<?php echo $key; ?>' <?php if($key == $stuData[0]['m_qualification']){ echo "selected"; } ?>><?php echo $val; ?></option>
													<?php
												}
											?>
										</select>
									</div>
								</div>
								
								<div class='row'>
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Occupation <span>*</span></label>
										<select class="form-control" name='m_accupation' disabled>
											<option value=''>Select</option>
											<?php
												foreach($parent_accupation as $key => $val){
													?>
														<option value='<?php echo $key; ?>' <?php if($key == $stuData[0]['m_accupation']){ echo "selected"; } ?>><?php echo $val; ?></option>
													<?php
												}
											?>
										</select>
									</div>
								</div>
								</div>
							</fieldset>	
						</div>
					</div>
					
					<!--<div class='row'>
					    <div class='col-sm-12'>
					    <fieldset class="scheduler-border">
						<legend class="scheduler-border">CHILD DETAILS <span style='font-size:12px;'>(Studying in this school)</span></legend>
						<div class='row'>
						<div class='col-sm-6'>
							<div class="form-group">
								<label>No. of Sons</label>
								<input type="number" value='<?php //echo $stuData[0]['no_of_son']; ?>' class="form-control" name='no_of_son' onkeypress="if(this.value.length==1) { return false;}" min='0' disabled>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class="form-group">
								<label>No. of Daughters</label>
								<input type="number" value='<?php //echo $stuData[0]['no_of_daughters']; ?>' class="form-control" name='no_of_daughters' onkeypress="if(this.value.length==1) { return false;}" min='0' disabled>
							</div>
						</div>
						</div>
						</fieldset>
						</div>
					</div>-->
				</fieldset>
				
				<div class='row'>
					<div class='col-sm-12'>
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Own Brother/Sister presently studying in this School</legend>
							<?php
								for($i=0; $i<2; $i++){
							?>
							<div class='row'>
							<div class='col-sm-3'>
								<div class="form-group">
									<label>Name of student</label>
									<input type='text' pattern="^[a-zA-Z][\sa-zA-Z]*" class="form-control" id='stuofjvm_<?php echo $i; ?>' name='stuofjvm_<?php echo $i; ?>' oninput='stuof(this)' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' disabled value='<?php echo $stuData[0]['stuofjvm_'.$i]?>'>
								</div>
							</div>
							
							<div class='col-sm-3'>
								<div class="form-group">
									<label>Class</label>
									<select class="form-control" id='classes_<?php echo $i; ?>' name='class_<?php echo $i; ?>' onchange='classes(this)' disabled>
										<option value=''>Select</option>
										<?php
											foreach($stu_classes as $key => $val){
												?>
													<option value='<?php echo $val['CLASS']?>' <?php if($val['CLASS'] == $stuData[0]['class_'.$i]){ echo "selected"; }?>><?php echo $val['DISP_CLASS']?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
			
							<div class='col-sm-3'>
								<div class="form-group">
									<label>Sec</label>
									<select class="form-control" id='sec_<?php echo $i; ?>' name='sec_<?php echo $i; ?>' disabled>
										<option value=''><?php echo $stuData[0]['sec_'.$i]?></option>
									</select>
								</div>
							</div>
							<div class='col-sm-3'>
								<div class="form-group">
									<label>Reg. No.</label>
									<input type="text" value='<?php echo $stuData[0]['registration_'.$i]; ?>' class="form-control" id='reg_<?php echo $i; ?>' name='registration_<?php echo $i; ?>' onkeypress='return event.charCode >= 47 && event.charCode <= 57' maxlength='9' disabled>
								</div>
							</div>
							</div>
							<?php } ?>
							<span style='color:red'>* <b>Note:- </b><i>(Cousin are not allowed)</i></span>
						</fieldset>		
					</div>
				</div>	
				
				<fieldset class="scheduler-border">
				<legend class="scheduler-border">LAST ATTENDED SCHOOL</legend>
				<div class='row'>	
					<div class='col-sm-4'>
					<div class="form-group">
						<label>Name of the School</label>
						<input type="text" class="form-control" name='last_name_school' id='last_name_school' value='<?php echo $stuData[0]['last_name_school']; ?>' disabled>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Last Class</label>
						<select name='last_class' id='last_class' class='form-control' disabled>
							<option value=''>Select</option>
							<option value='II' <?php if($stuData[0]['last_class'] == 'II'){ echo "selected"; } ?>>II</option>
						</select>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Year of Study</label>
						<input type="text" class="form-control" name='last_year_study' value='2019-2020' readonly id='last_year_study'>
					</div>
				</div>
				
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Board Qualification Exam</label>
						<select name='last_board_qualification' id='last_board_qualification' class='form-control' disabled>
							<option value=''>Select</option>
							<option value='JAC' <?php if($stuData[0]['last_board_qualification'] == 'JAC'){ echo "selected"; } ?>>JAC</option>
							<option value='CBSE' <?php if($stuData[0]['last_board_qualification'] == 'CBSE'){ echo "selected"; } ?>>CBSE</option>
							<option value='ICSE' <?php if($stuData[0]['last_board_qualification'] == 'ICSE'){ echo "selected"; } ?>>ICSE</option>
							<option value='OTHERS' <?php if($stuData[0]['last_board_qualification'] == 'OTHERS'){ echo "selected"; } ?>>OTHERS</option>
						</select>
					</div>
				</div>
				
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Medium of Instruction</label>
						<select name='last_medium' id='last_medium' class='form-control' disabled>
							<option value=''>Select</option>
							<option value='ENGLISH' <?php if($stuData[0]['last_medium'] == 'ENGLISH'){ echo "selected"; } ?>>ENGLISH</option>
							<option value='HINDI' <?php if($stuData[0]['last_medium'] == 'HINDI'){ echo "selected"; } ?>>HINDI</option>
							<option value='OTHERS' <?php if($stuData[0]['last_medium'] == 'OTHERS'){ echo "selected"; } ?>>OTHERS</option>
						</select>
					</div>
				</div>	
				</div>
				</fieldset>
				
				<div class='row'>	
					<div class='col-sm-6'>
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">RESIDENTIAL ADDRESS</legend>
							<div class='col-sm-12'>
								<div class="form-group">
									<label>Address (of Ranchi Only) <span>*</span></label>
									<textarea required class="form-control" name='residentail_add' id='residentail_add' rows='4' disabled><?php echo $stuData[0]['residentail_add']; ?></textarea>
								</div>
							</div>
							
							<div class='row'>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>PIN Code <span>*</span></label>
									<input type="number" value="<?php echo $stuData[0]['pin_code']; ?>" class="form-control" name='pin_code' id='pin_code' onkeypress="if(this.value.length==6) { return false;}" min='0' required onchange='no_validate(6,this)' disabled>
								</div>
							</div>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Phone Residence</label>
									<input type="number" value="<?php echo $stuData[0]['phone_residence']; ?>" class="form-control" name='phone_residence' id='phone_residence' onkeypress="if(this.value.length==11) { return false;}" min='0' disabled>
								</div>
							</div>
							</div>
							
							<div class='row'>
								
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Mobile <span>*</span></label>
									<input type="number" value="<?php echo $stuData[0]['mobile']; ?>" class="form-control" name='mobile' id='mobile' onkeypress="if(this.value.length==10) { return false;}" min='0'  onchange='no_validate(10,this)' disabled>
								</div>
							</div>
								<div class='col-sm-6'>
								<div class="form-group">
									<label>Email Id (Preferable)</label>
									<input type="email" value="<?php echo $stuData[0]['email']; ?>" class="form-control" name='email' disabled>
								</div>
							</div>	
							</div>
							
							<div class='row'>
							
							</div>
						</fieldset>	
					</div>
					
					<div class='col-sm-6'>
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">PERMANENT ADDRESS</legend>
							<div class='col-sm-12'>
								<div class="form-group">
									<label>Address <span>*</span> <input type='checkbox' name='chk' onclick='sameAs()' disabled><i style='font-size:12px;'> (If same as Residential address)</i></label>
									<textarea class="form-control" name='p_residentail_add' id='p_residentail_add' rows='4' disabled><?php echo $stuData[0]['p_residentail_add']; ?></textarea>
								</div>
							</div>
							
							<div class='row'>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>PIN Code <span>*</span> </label>
									<input type="number" value="<?php echo $stuData[0]['p_pin_code']; ?>" class="form-control" name='p_pin_code' id='p_pin_code' onkeypress="if(this.value.length==6) { return false;}" min='0'  onchange='no_validate(6,this)' disabled>
								</div>
							</div>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Phone Residence</label>
									<input type="number" class="form-control" name='p_phone_residence' value="<?php echo $stuData[0]['p_phone_residence']; ?>" id='p_phone_residence' onkeypress="if(this.value.length==11) { return false;}" min='0' disabled>
								</div>
							</div>
							</div>
							
							<div class='row'>
							
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Mobile <span>*</span></label>
									<input type="number" value="<?php echo $stuData[0]['p_mobile']; ?>" class="form-control" name='p_mobile' id='p_mobile' onkeypress="if(this.value.length==10) { return false;}" min='0' required onchange='no_validate(10,this)' disabled>
								</div>
							</div>
							<div class='col-sm-6'>
								<div class="form-group">
									
								</div>
							</div>
							</div>
						</fieldset>	
					</div>
				</div>
				<?php
					if($stuData[0]['f_code'] != 'Ok'){
				?>
				<div class='row'>
					<div class='col-sm-12'>
						<center><button class='btn btn-success' id='sv_btn'>Proceed To Payment</button></center>
					</div>
				</div>
				<?php } ?>
			</form>
			<?php
					if($stuData[0]['f_code'] == 'Ok'){
				?>
				<div class='row'>
					<div class='col-sm-12'>
						<center><button class='btn btn-warning' id='sv_btn' onclick='download()'>DOWNLOAD</button></center>
					</div>
				</div>
				<?php } ?>
        </div>
      </div>
    </section>
  </div>
  
  <script type="text/javascript">
	$('.datepicker').datepicker({
	    format: 'dd-M-yyyy',
	    autoclose:true,
		startDate: "01-OCT-2015",
		endDate: "30-SEP-2016",
		dataToggle:"bottom"
	});
	
	$('#f_year_leaving').datepicker({
	    format: 'yyyy',
	    autoclose:true,
		startView: "years", 
        minViewMode: "years",
		endDate: "today"
	});
	
	$('#m_year_leaving').datepicker({
	    format: 'yyyy',
	    autoclose:true,
		startView: "years", 
        minViewMode: "years",
		endDate: "today"
	});
	
	function alumini(val,gen){
		if(gen == 'F' && val == 'YES'){
			$("#f_hideShow").show();
			$("#f_year_leaving").prop('disabled',false);
			$("#f_reg_no").prop('disabled',false);
		}else if(gen == 'M' && val == 'YES'){
			$("#m_hideShow").show();
			$("#m_year_leaving").prop('disabled',false);
			$("#m_reg_no").prop('disabled',false);
		}else if(gen == 'F' && val == 'NO'){
			$("#f_hideShow").hide();
			$("#f_year_leaving").prop('disabled',true);
			$("#f_reg_no").prop('disabled',true);
		}else{
			$("#m_hideShow").hide();
			$("#m_year_leaving").prop('disabled',true);
			$("#m_reg_no").prop('disabled',true);
		}
	}
	
	function stuof(val){
		var str = val.id;
		var splt = str.split("_");
		var fin_id = splt[1];
		var stuofjvm = $("#stuofjvm_"+fin_id).val();
		if(stuofjvm == 'YES'){
			$("#classes_"+fin_id).prop('disabled',false);
		    $("#reg_"+fin_id).prop('disabled',false);	
		    $("#sec_"+fin_id).prop('disabled',false);	
		}else{
			$("#classes_"+fin_id).prop('disabled',true);
		    $("#reg_"+fin_id).prop('disabled',true);
		    $("#sec_"+fin_id).prop('disabled',true);
		}
	}
	
	function classes(val){
		var str = val.id;
		var splt = str.split("_");
		var fin_id = splt[1];
		var classes = $("#classes_"+fin_id).val();
		$.post("<?php echo base_url('adm_three/Adm_nur/Getsec'); ?>",{classes:classes},function(data){
			$("#sec_"+fin_id).html(data);
		});
	}
	
	function single_parents(val){
		if(val == 'YES'){
			$("#fatormot").prop('disabled',false);
		}else{
			$("#fatormot").prop('disabled',true);
		}
	}
	
	function no_validate(req_no,id){
		var dyn_id = id.id;
		var count = $("#"+dyn_id).val().length;
		if(count != req_no){
			$("#"+dyn_id).val('');
			$("#"+dyn_id).focus();
			$.toast({
				heading: 'Error',
				text: 'Enter Valid Entry',
				showHideTransition: 'slide',
				icon: 'error',
				position: 'top-right',
			});
		}else{
			if(dyn_id == 'aadhaar_no'){
				var adhr_no = $("#"+dyn_id).val();
				$.post("<?php echo base_url('adm_three/Adm_nur/existAdhar'); ?>",{adhr_no:adhr_no},function(data){
					if(data != 0){
						$("#"+dyn_id).val('');
						$.toast({
							heading: 'Error',
							text: 'Aadhaar No. already exist',
							showHideTransition: 'slide',
							icon: 'error',
							position: 'top-right',
						});	
					}
				});
			}
		}
	}
	
	function sameAs(){
		var residentail_add = $("#residentail_add").val();
		var pin_code = $("#pin_code").val();
		var distance = $("#distance").val();
		var phone_residence = $("#phone_residence").val();
		var phone_ofc = $("#phone_ofc").val();
		var mobile = $("#mobile").val();
		
		var ckbox = $('input[name=chk]').is(':checked')
		if(ckbox == true){
			$("#p_residentail_add").text(residentail_add);
			$("#p_pin_code").val(pin_code);
			$("#p_distance").val(distance);
			$("#p_phone_residence").val(phone_residence);
			$("#p_phone_ofc").val(phone_ofc);
			$("#p_mobile").val(mobile);
		}else{
			$("#p_residentail_add").text('');
			$("#p_pin_code").val('');
			$("#p_distance").val('');
			$("#p_phone_residence").val('');
			$("#p_phone_ofc").val('');
			$("#p_mobile").val('');
		}
	}
	
	$("#filePHOTO").change(function(){
		$(".file_upload1").css("border-color","#F0F0F0");
		var file_size = $('#filePHOTO')[0].files[0].size;
		var ext = $('#filePHOTO').val().split('.').pop().toLowerCase();
			if(file_size > 200000 || !(ext == 'png' || ext == 'PNG' || ext == 'jpg' || ext == 'JPG' || ext == 'jpeg' || ext == 'JPEG')){
				$.toast({
					heading: 'Error',
					text: 'File size must be less than 200kb and only allowed jpg,jpeg,png format',
					showHideTransition: 'slide',
					icon: 'error',
					position: 'top-right',
				});
				$("#filePHOTO").val('');
			$(".file_upload1").css("border-color","#FF0000");
				return false;
			}
		return true;
	});
	
	// $(document).ready(function(){
		// loadSec("classes_0","sec_0","<?php echo $stuData[0]['sec_0']; ?>");
		// loadSec("classes_1","sec_1","<?php echo $stuData[0]['sec_1']; ?>");
	// });
	function loadSec(class_id,sec_id,sec_val){
		var classes = $("#"+class_id).val();
		$.ajax({
			url: "<?php echo base_url('adm_three/Adm_nur/Getsec'); ?>",
			type : "POST",
			data: {classes:classes},
			dataType: "text",
			success: function(data){
				$("#"+sec_id).html(data);
				$("#"+sec_id).val(sec_val);
			}
		});
	}
	
	$("#nur_form_edit").on("submit", function (event) {
    event.preventDefault();
	$("#sv_btn").prop('disabled',true);
	$("#process").show();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('adm_three/Payment/index'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				alert(data);
			}
		});
	 });
	
	function download(){
		var reg_id = "<?php echo generate_session['id']; ?>";
		window.location="<?php echo base_url('adm_three/Stu_list/downloadPDF/"+reg_id+"'); ?>";
	}
	
	
	$("#my_form").addClass('active');
</script>