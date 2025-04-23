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
            <h1>Student Edit Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Edit Form</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

   
    <section class="content">
      <div class="card">
        <div class="card-body">
          <form autocomplete='off' id='nur_form_edit' method='POST' enctype='multipart/form-data'>
			<fieldset class="scheduler-border">
			<legend class="scheduler-border">APPLICANT DETAILS</legend>
			<div class='row'>
				<div class='col-sm-4'>
				<input type='hidden' id='upd_id' name='upd_id' value='<?php echo $stuData[0]['id']; ?>'>
					<div class="form-group">
						<label>Applicant's Name <span>*</span></label>
						<input type="text" value='<?php echo $stuData[0]['stu_nm']; ?>' class="form-control" name='stu_nm' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' required>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Date of Birth <span>*</span></label>
						<input type="text" value='<?php echo date('d-M-y',strtotime($stuData[0]['dob'])); ?>' class="form-control datepicker" name='dob' required>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Gender <span>*</span></label>
						<select class="form-control" name='gender' required>
							<option value=''>Select</option>
							<option value='1' <?php if($stuData[0]['gender'] == 1){ echo "selected"; }?>>Male</option>
							<option value='2' <?php if($stuData[0]['gender'] == 2){ echo "selected"; }?>>Female</option>
						</select>
					</div>
				</div>
			
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Physically Challenged</label>
						<select class="form-control" name='phy_challenged' required>
							<option value=''>Select</option>
							<option value='YES' <?php if($stuData[0]['phy_challenged'] == 'YES'){ echo "selected"; }?>>YES</option>
							<option value='NO' <?php if($stuData[0]['phy_challenged'] == 'NO'){ echo "selected"; }?>>NO</option>
						</select>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Category <span>*</span></label>
						<select class="form-control" name='category' required>
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
						<input type="number" value='<?php echo $stuData[0]['aadhaar_no']; ?>'class="form-control" id='aadhaar_no' name='aadhaar_no' onkeypress="if(this.value.length==12) { return false;}" min='0' onchange='no_validate(12,this)'>
					</div>
				</div>	
			
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Mother Tongue <span>*</span></label>
						<select class="form-control" name='mother_tounge' required>
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
						<select class="form-control" name='religion' required>
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
						<select class="form-control" name='blood_group' required>
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
						<input type='file' id='filePHOTO' name='img' class='form-control file_upload1' onchange='img_validate()'>
						<span style='font-size:10.5px;'><i><b>File size must be less than 200kb allowed format JPG,JPEG,PNG only</b></i></span>
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
										<input type="text" value='<?php echo $stuData[0]['f_name']; ?>' class="form-control" name='f_name' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' required>
									</div>
								</div>
								
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Qualification <span>*</span></label>
										<select class="form-control" name='f_qualification' required>
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
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Occupation <span>*</span></label>
										<select class="form-control" name='f_accupation' required>
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
										<input type="text" value='<?php echo $stuData[0]['m_name']; ?>' class="form-control" name='m_name' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' required>
									</div>
								</div>
								
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Qualification <span>*</span></label>
										<select class="form-control" name='m_qualification' required>
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
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Occupation <span>*</span></label>
										<select class="form-control" name='m_accupation' required>
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
								<input type="number" value='<?php //echo $stuData[0]['no_of_son']; ?>' class="form-control" id='no_of_son' name='no_of_son' onkeypress="if(this.value.length==1) { return false;}" min='0' max='9' oninput='sibling()'>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class="form-group">
								<label>No. of Daughters</label>
								<input type="number" value='<?php //echo $stuData[0]['no_of_daughters']; ?>' class="form-control" name='no_of_daughters' id='no_of_daughters' onkeypress="if(this.value.length==1) { return false;}" min='0' max='9' oninput='sibling()'>
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
									<input type='text' class="form-control" id='stuofjvm_<?php echo $i; ?>' name='stuofjvm_<?php echo $i; ?>' oninput='stuof(this)' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' value='<?php echo $stuData[0]['stuofjvm_'.$i]; ?>'>
								</div>
							</div>
							
							<div class='col-sm-3'>
								<div class="form-group">
									<label>Class</label>
									<select class="form-control" id='classes_<?php echo $i; ?>' name='class_<?php echo $i; ?>' onchange='classes(this)'>
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
									<select class="form-control" id='sec_<?php echo $i; ?>' name='sec_<?php echo $i; ?>'>
										<option value='<?php echo $stuData[0]['sec_'.$i]; ?>'><?php echo $stuData[0]['secc_'.$i]?></option>
									</select>
								</div>
							</div>
							<div class='col-sm-3'>
								<div class="form-group">
									<label>Reg. No.</label>
									<input type="text" value='<?php echo $stuData[0]['registration_'.$i]; ?>' class="form-control" id='reg_<?php echo $i; ?>' name='registration_<?php echo $i; ?>' onkeypress='return event.charCode >= 47 && event.charCode <= 57' maxlength='9'>
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
						<input type="text" value='<?php echo $stuData[0]['last_name_school']; ?>' class="form-control" name='last_name_school' id='last_name_school' pattern="^[a-zA-Z][\sa-zA-Z]*" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46'>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Last Class</label>
						<select name='last_class' id='last_class' class='form-control'>
							<option value=''>Select</option>
							<option value='II' <?php if($stuData[0]['last_class'] == 'II') { echo "selected"; } ?>>II</option>
						</select>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Year of Study</label>
						<input type="text" value='<?php echo $stuData[0]['last_year_study']; ?>' class="form-control" name='last_year_study' id='last_year_study' readonly>
					</div>
				</div>
				
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Board Qualification Exam</label>
						<select name='last_board_qualification' id='last_board_qualification' class='form-control'>
							<option value=''>Select</option>
							<option value='JAC' <?php if($stuData[0]['last_board_qualification'] == 'JAC') { echo "selected"; } ?>>JAC</option>
							<option value='CBSE' <?php if($stuData[0]['last_board_qualification'] == 'CBSE') { echo "selected"; } ?>>CBSE</option>
							<option value='ICSE' <?php if($stuData[0]['last_board_qualification'] == 'ICSE') { echo "selected"; } ?>>ICSE</option>
							<option value='OTHERS' <?php if($stuData[0]['last_board_qualification'] == 'OTHERS') { echo "selected"; } ?>>OTHRES</option>
						</select>
					</div>
				</div>
				
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Medium of Instruction</label>
						<select name='last_medium' id='last_medium' class='form-control'>
							<option value=''>Select</option>
							<option value='ENGLISH' <?php if($stuData[0]['last_medium'] == 'ENGLISH') { echo "selected"; } ?>>ENGLISH</option>
							<option value='HINDI' <?php if($stuData[0]['last_medium'] == 'HINDI') { echo "selected"; } ?>>HINDI</option>
							<option value='OTHERS' <?php if($stuData[0]['last_medium'] == 'OTHERS') { echo "selected"; } ?>>OTHERS</option>
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
									<textarea required class="form-control" name='residentail_add' id='residentail_add' rows='4'><?php echo $stuData[0]['residentail_add']; ?></textarea>
								</div>
							</div>
							
							<div class='row'>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>PIN Code <span>*</span></label>
									<input type="number" value="<?php echo $stuData[0]['pin_code']; ?>" class="form-control" name='pin_code' id='pin_code' onkeypress="if(this.value.length==6) { return false;}" min='0' required onchange='no_validate(6,this)'>
								</div>
								
							</div>
								<div class='col-sm-6'>
										<div class="form-group">
									<label>Phone Residence</label>
									<input type="number" value="<?php echo $stuData[0]['phone_residence']; ?>" class="form-control" name='phone_residence' id='phone_residence' onkeypress="if(this.value.length==11) { return false;}" min='0'>
								</div>
								</div>
							
							</div>
							
							
							<div class='row'>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Mobile <span>*</span></label>
									<input type="number" value="<?php echo $stuData[0]['mobile']; ?>" class="form-control" name='mobile' id='mobile' onkeypress="if(this.value.length==10) { return false;}" min='0' required onchange='no_validate(10,this)'>
								</div>
							</div>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Email Id (Preferable)</label>
									<input type="email" value="<?php echo $stuData[0]['email']; ?>" class="form-control" name='email' style='text-transform: lowercase'>
								</div>
							</div>
							</div>	
							
						</fieldset>	
					</div>
					
					<div class='col-sm-6'>
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">PERMANENT ADDRESS</legend>
							<div class='col-sm-12'>
								<div class="form-group">
									<label>Address <span>*</span> <input type='checkbox' name='chk' onclick='sameAs()'><i style='font-size:12px;'> (If same as Residential address)</i></label>
									<textarea required class="form-control" name='p_residentail_add' id='p_residentail_add' rows='4'><?php echo $stuData[0]['p_residentail_add']; ?></textarea>
								</div>
							</div>
							
							<div class='row'>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>PIN Code <span>*</span> </label>
									<input type="number" value="<?php echo $stuData[0]['p_pin_code']; ?>" class="form-control" name='p_pin_code' id='p_pin_code' onkeypress="if(this.value.length==6) { return false;}" min='0' required onchange='no_validate(6,this)'>
								</div>
							</div>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Phone Residence</label>
									<input type="number" class="form-control" name='p_phone_residence' value="<?php echo $stuData[0]['p_phone_residence']; ?>" id='p_phone_residence' onkeypress="if(this.value.length==11) { return false;}" min='0'>
								</div>
							</div>
							</div>
							<div class='row'>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Mobile <span>*</span></label>
									<input type="number" value="<?php echo $stuData[0]['p_mobile']; ?>" class="form-control" name='p_mobile' id='p_mobile' onkeypress="if(this.value.length==10) { return false;}" min='0' required onchange='no_validate(10,this)'>
								</div>
							</div>
							</div>
						</fieldset>	
					</div>
				</div>
				
				<div class='row'>
					<div class='col-sm-12'>
						<div class="icheck-success d-inline">
							<input type="radio" value='1' id="checkboxSuccess1" name="r1" onclick='rjct()' <?php if($stuData[0]['verified_status'] == 1){ echo "checked"; } ?>>
							<label for="checkboxSuccess1">Verify</label>
						</div>
					    <div class="icheck-danger d-inline">
							<input type="radio" value='2' id="radioDanger2" name="r1" onclick='rjct()' <?php if($stuData[0]['verified_status'] == 2){ echo "checked"; } ?>>
							<label for="radioDanger2">Reject</label>
							
							<?php
								if($stuData[0]['verified_status'] == 2){
									?>
										(<i><?php echo $stuData[0]['reject_reason']; ?></i>)
									<?php
								}
							?>
					    </div>
					</div>
				</div>
				
				<div class='row'>
					<div class='col-sm-12'>
						<center><button class='btn btn-success' id='sv_btn'>UPDATE</button></center>
					</div>
				</div>
				
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Reason</h4>
						<button type="button" class="close" data-dismiss="modal" onclick='modal_cls()'>&times;</button>
					</div>
					  <div class="modal-body">
						<textarea class='form-control' name='reject_reason' id='reject_reason'><?php echo $stuData[0]['reject_reason']; ?></textarea>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-success" onclick='reason_save()'>DONE</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick='modal_cls()'>Close</button>
					  </div>
					</div>
				  </div>
				</div>
				
			</form>
        </div>
      </div>
    </section>
  </div>
  
  <script type="text/javascript">
	$('.datepicker').datepicker({
	    format: 'dd-M-yyyy',
	    autoclose:true,
		// startDate: "01-OCT-2015",
		// endDate: "30-SEP-2016",
		// dataToggle:"bottom"
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
	
	
	// $("#last_year_study").datepicker({
	    // format: 'yyyy',
	    // autoclose:true,
		// startView: "years", 
        // minViewMode: "years",
		//endDate: "today"
	//});
	
	function sibling(){
		var no_of_son       = $("#no_of_son").val();
		var no_of_daughters = $("#no_of_daughters").val();
		var add = Number(no_of_son)+Number(no_of_daughters);
		if(add >= 1){
			$("#stuofjvm_0").prop('disabled',false);
			$("#stuofjvm_1").prop('disabled',false);
			$("#classes_0").prop('disabled',false);
			$("#classes_1").prop('disabled',false);
			$("#sec_0").prop('disabled',false);
			$("#sec_1").prop('disabled',false);
			$("#reg_0").prop('disabled',false);
			$("#reg_1").prop('disabled',false);
		}else{
			$("#stuofjvm_0").prop('disabled',true);
			$("#stuofjvm_1").prop('disabled',true);
			$("#classes_0").prop('disabled',true);
			$("#classes_1").prop('disabled',true);
			$("#sec_0").prop('disabled',true);
			$("#sec_1").prop('disabled',true);
			$("#reg_0").prop('disabled',true);
			$("#reg_1").prop('disabled',true);
		}
	}
	
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
		if(stuofjvm != ''){
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
	
	function grnd_prntt(val){
		if(val == 'YES'){
			$("#grp_prnts").show();
			$("#grand_parent").html("<option value=''>Select</option><?php foreach($grand_parent as $key => $val){ if($key != 4){  ?><option value='<?php echo $key; ?>'><?php echo $val; ?></option><?php } } ?>");
		}else{
			$("#grp_prnts").hide();
			$("#grand_parent").html("<?php foreach($grand_parent as $key => $val){ if($key == 4){  ?><option value='<?php echo $key; ?>'><?php echo $val; ?></option><?php } } ?>");
		}
	}
	
	$("#filePHOTO").change(function(){
		$(".file_upload1").css("border-color","#F0F0F0");
		var file_size = $('#filePHOTO')[0].files[0].size;
		var ext = $('#filePHOTO').val().split('.').pop().toLowerCase();
			if(file_size > 200000 || !(ext == 'png' || ext == 'PNG' || ext == 'jpg' || ext == 'JPG' || ext == 'jpeg' || ext == 'JPEG')){
				$.toast({
					heading: 'Error',
					text: 'File size must be less than 200kb allowed format JPG,JPEG,PNG only',
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
	
	
	
	$(document).ready(function(){
		var radio = $("input[name='grnd_prnt']:checked").val();
		if(radio == 'NO'){
			$("#grp_prnts").hide();
		}else{
			$("#grp_prnts").show();
		}
	});
	
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
	var ses_id = <?php echo $session_id; ?>;
	if(ses_id == 2){
		$("#sv_btn").prop('disabled',true);
		$("#process").show();
		var formData = new FormData(this);
		$.ajax({
				url: "<?php echo base_url('adm_three/Stu_list/verifyUpdForm'); ?>",
				type: "POST",
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success: function(data){
					$.toast({
						heading: 'Success',
						text: 'Update Successfully',
						showHideTransition: 'slide',
						icon: 'success',
						position: 'top-right',
					});
					setTimeout(function(){
						window.location="<?php echo base_url('adm_three/Stu_list/index'); ?>";
					},1500);
				}
			});
	}else{
		$("#sv_btn").prop('disabled',true);
		$("#process").show();
		var formData = new FormData(this);
		$.ajax({
				url: "<?php echo base_url('adm_three/Stu_list/updForm'); ?>",
				type: "POST",
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success: function(data){
					$.toast({
						heading: 'Success',
						text: 'Update Successfully',
						showHideTransition: 'slide',
						icon: 'success',
						position: 'top-right',
					});
					setTimeout(function(){
						window.location="<?php echo base_url('adm_three/Stu_list/index'); ?>";
					},1500);
				}
			});
	}
	 });
	 
	 function rjct(){
		 var reject = $("input[name='r1']:checked").val();
		 if(reject == 2){
			 $("#myModal").modal('show');
		 }
	 }
	 
	 function reason_save(){
		 var reject_reason = $("#reject_reason").val();
		 var upd_id        = $("#upd_id").val();
		 $.ajax({
			url: "<?php echo base_url('adm_three/Stu_list/rejectReasonSave'); ?>",
			type: "POST",
			data:{reject_reason:reject_reason,upd_id:upd_id},
			success: function(data){
				$("#myModal").modal('hide');
			}
		});
	 }
	 
	 function modal_cls(){
		 $("#reject").prop('checked',false);
	 }
	 
	 $("#stulist_menu").addClass('active');
</script>