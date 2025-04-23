<br>
<style type="text/css">
  .thead-color{
   background: #bac9e2 !important;
  }
</style>
<div class="employee-dashboard">
    <?php if(isset($data)) { ?>
      <div class="row"> 
          <div class="col-sm-12">
            <div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
              <div class="panel-heading"><i class="fa fa-edit"></i> Student Details Update Class Section Wise</div>
              <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white; overflow-x: auto;height: 500px;">
                  <table class='table table-bordered table-striped dataTable'>
                    <thead>
                      <tr>
						<th class="thead-color text-center">Sl No</th>
                        <th class="thead-color text-center">Admission No</th>
                        <th class="thead-color text-center">Student Name</th>
                        <th class="thead-color text-center">Father Name</th>
                        <th class="thead-color text-center">Mother Name</th>
                        <th class="thead-color text-center">Roll No</th>
                        <th class="thead-color text-center">Class</th>
                        <th class="thead-color text-center">Sec</th>
                        <th class="thead-color text-center">Date of Birth</th>
                        <th class="thead-color text-center">Aadhaar No.</th>
                        <th class="thead-color text-center">Mobile No</th>
						<th class="thead-color text-center">Address</th>
						<th class="thead-color text-center">PIN</th>
                        <th class="thead-color text-center">Email Id</th>
                        <th class="thead-color text-center">Admission Date</th>
                        <th class="thead-color text-center">Blood Group</th>
                        <th class="thead-color text-center">Category</th>
                        <th class="thead-color text-center">Gender</th>
                        <th class="thead-color text-center">Religion</th>
                        <th class="thead-color text-center">Subject-1</th>
                        <th class="thead-color text-center">Subject-2</th>
                        <th class="thead-color text-center">Subject-3</th>
                        <th class="thead-color text-center">Subject-4</th>
                        <th class="thead-color text-center">Subject-5</th>
                        <th class="thead-color text-center">Subject-6</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php
						$i=1;
							foreach($data as $key=>$value){
								?>
									<tr>
										<td><?php echo $i; ?></td>

										<td><?php echo $value->ADM_NO; ?></td>

										<td class="table_data" onkeypress="return event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122 || event.charCode==32 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="FIRST_NM" contenteditable><?php echo $value->FIRST_NM; ?></td>

										<td class="table_data" onkeypress="return event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122 || event.charCode==32 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="FATHER_NM" contenteditable><?php echo $value->FATHER_NM; ?></td>

										<td class="table_data" onkeypress="return event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122 || event.charCode==32 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="MOTHER_NM" contenteditable><?php echo $value->MOTHER_NM; ?></td>

										<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="ROLL_NO" contenteditable><?php echo $value->ROLL_NO; ?></td>

										<td  class="table_data" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="CLASS"><?php echo $value->DISP_CLASS; ?></td>

										<td><select onchange="changesection(this.id)" id="<?php echo $value->STUDENTID."_SEC"; ?>">
											<option value="">select</option>
											<?php
												foreach($seclist as $seckey=>$secval){
													?>
														<option <?php if($secval->SECTION_NAME == $value->DISP_SEC){echo "selected";} ?> value="<?php echo $secval->section_no; ?>"><?php echo $secval->SECTION_NAME; ?></option>
													<?php
												}
											?>
										</select></td>

										

										<td><input type="date" id="<?php echo $value->ADM_NO; ?>" onchange="getbirth(this.id)" value="<?php echo date('Y-m-d',strtotime($value->BIRTH_DT)); ?>" ></td>

										<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="Bus_Book_No" contenteditable><?php echo $value->Bus_Book_No; ?></td>

										<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="C_MOBILE" contenteditable><?php echo $value->C_MOBILE; ?></td>
										<td class="table_data" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="CORR_ADD" contenteditable><?php echo $value->CORR_ADD; ?></td>
										
										<td class="table_data"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="C_PIN" contenteditable><?php echo $value->C_PIN; ?></td>

										<td class="table_data"  data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="C_EMAIL" contenteditable ><?php echo $value->C_EMAIL; ?></td>

										<td><input type="date" id="<?php echo $value->ADM_NO."_I"; ?>" onchange="getadmno(this.id)" value="<?php echo date('Y-m-d',strtotime($value->ADM_DATE)); ?>" ></td>
										
										

										<td class="table_data"  data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="BLOOD_GRP" contenteditable ><?php echo $value->BLOOD_GRP; ?></td>

										<td><select onchange="changecategory(this.id)" id="<?php echo $value->STUDENTID."_CATEGORY"; ?>">
											<option value="">select</option>
											<?php
												foreach($category as $cat=>$catval){
													?>
														<option <?php if($catval->CAT_CODE == $value->CATEGORY){echo "selected";} ?> value="<?php echo $catval->CAT_CODE; ?>"><?php echo $catval->CAT_ABBR; ?></option>
													<?php
												}
											?>
										</select></td>

										<td><select onchange="changegenger(this.id)" id="<?php echo $value->STUDENTID."_GENGER"; ?>">
											<OPTION value="">select</option>
											<OPTION value="1" <?php if($value->SEX == 1){echo "selected";} ?>>MALE</OPTION>
											<OPTION value="2" <?php if($value->SEX == 2){echo "selected";} ?> >FEMALE</OPTION>
										</select></td>

										<td><select onchange="changereligion(this.id)" id="<?php echo $value->STUDENTID."_RELEGION"; ?>" >
											<option value="">select</option>
											<?php
												foreach($religion as $REL=>$RELVAL){
													?>
														<option <?php if($RELVAL->RNo == $value->religion){echo "selected";} ?> value="<?php echo $RELVAL->RNo; ?>"><?php echo $RELVAL->Rname; ?></option>
													<?php
												}
											?>
										</select></td>
										<td><select onchange="changesubject1(this.id)" id="<?php echo $value->STUDENTID."_SUBJECT1"; ?>" >
											<option value="">select</option>
											<?php
												foreach($subject as $subkey=>$subval){
													?>
														<option <?php if($subval->SubSName == $value->SUBJECT1){echo "selected";} ?> value="<?php echo $subval->SubCode; ?>"><?php echo $subval->SubName; ?></option>
													<?php
												}
											?>
										</select></td>
										<td><select onchange="changesubject2(this.id)" id="<?php echo $value->STUDENTID."_SUBJECT2"; ?>" >
											<option value="">select</option>
											<?php
												foreach($subject as $subkey=>$subval){
													?>
														<option <?php if($subval->SubSName == $value->SUBJECT2){echo "selected";} ?> value="<?php echo $subval->SubCode; ?>"><?php echo $subval->SubName; ?></option>
													<?php
												}
											?>
										</select></td>
										<td><select onchange="changesubject3(this.id)" id="<?php echo $value->STUDENTID."_SUBJECT3"; ?>" >
											<option value="">select</option>
											<?php
												foreach($subject as $subkey=>$subval){
													?>
														<option <?php if($subval->SubSName == $value->SUBJECT3){echo "selected";} ?> value="<?php echo $subval->SubCode; ?>"><?php echo $subval->SubName; ?></option>
													<?php
												}
											?>
										</select></td>
										<td><select onchange="changesubject4(this.id)" id="<?php echo $value->STUDENTID."_SUBJECT4"; ?>" >
											<option value="">select</option>
											<?php
												foreach($subject as $subkey=>$subval){
													?>
														<option <?php if($subval->SubSName == $value->SUBJECT4){echo "selected";} ?> value="<?php echo $subval->SubCode; ?>"><?php echo $subval->SubName; ?></option>
													<?php
												}
											?>
										</select></td>
										<td><select onchange="changesubject5(this.id)" id="<?php echo $value->STUDENTID."_SUBJECT5"; ?>" >
											<option value="">select</option>
											<?php
												foreach($subject as $subkey=>$subval){
													?>
														<option <?php if($subval->SubSName == $value->SUBJECT5){echo "selected";} ?> value="<?php echo $subval->SubCode; ?>"><?php echo $subval->SubName; ?></option>
													<?php
												}
											?>
										</select></td>
										<td><select onchange="changesubject6(this.id)" id="<?php echo $value->STUDENTID."_SUBJECT6"; ?>" >
											<option value="">select</option>
											<?php
												foreach($subject as $subkey=>$subval){
													?>
														<option <?php if($subval->SubSName == $value->SUBJECT6){echo "selected";} ?> value="<?php echo $subval->SubCode; ?>"><?php echo $subval->SubName; ?></option>
													<?php
												}
											?>
										</select></td>
									</tr>
								<?php
								$i++;
							}
						?>
                    </tbody>
                  </table>
              </div>
          </div>
          </div>
      </div>
    <?php } ?>
 </div>
<br>
<script>
	$(document).on('blur', '.table_data', function(){
		var adm = $(this).data('row_adm');
		//var fh = $(this).data('row_fh');
		var table_column = $(this).data('column_name');
		var value = $(this).text();
		//alert("adm is:"+adm+"table is:"+table_column+" value"+value);
		$.ajax({
		  url:"<?php echo base_url('bulk_updation/Classsecwise/update_data'); ?>",
		  method:"POST",
		  data:{adm:adm,table_column:table_column, value:value},
		  success:function(data)
		  {
			$.toast({
                heading: 'Success',
                text: 'Saved Successfully',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
            });
		  }
		});
  });
  function changereligion(rel_data){
	  var religion_value = $('#'+rel_data).val();
	  var getiddd1 = rel_data.split("_");
	  var finiddd1 = getiddd1[0];
	  if(religion_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changereligion'); ?>",
				method : "POST",
				data : {finiddd1:finiddd1,religion_value:religion_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Category Change");
					}
				},
			});
	  }
  }
  function changecategory(CAT_data){
	  var category_value = $('#'+CAT_data).val();
	  var getiddd = CAT_data.split("_");
	  var finiddd = getiddd[0];
	  if(category_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changecategory'); ?>",
				method : "POST",
				data : {finiddd:finiddd,category_value:category_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Category Change");
					}
				},
			});
	  }
  }
  function changegenger(gen_data){
	  var gender_value = $('#'+gen_data).val();
	  var getidd = gen_data.split("_");
	  var finidd = getidd[0];
	  if(gender_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changegender'); ?>",
				method : "POST",
				data : {finidd:finidd,gender_value:gender_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Gender Change");
					}
				},
			});
	  }
  }
	function getadmno(val1){
		var value1 = $('#'+val1).val();
		var getid = val1.split("_");
		var finid = getid[0];
		if(val1 ==""){
			
		}else{
			$.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/adm_noupdate'); ?>",
				method : "POST",
				data : {finid:finid,value1:value1},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("Date of Birth Not Change");
					}
				},
			});
		}
	}
	function getbirth(val){
		var value = $('#'+val).val();
		if(val ==""){
			
		}else{
			$.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/birth_data'); ?>",
				method : "POST",
				data : {val:val,value:value},
				success:function(data)
				{
					if(data == 1){
						
					}else{
						alert("Date of Birth Not Change");
					}
				},
			});
		}
	}

	function changesection(sec_data){
   	  var sec_value = $('#'+sec_data).val();
	  var getidd = sec_data.split("_");
	  var finidd = getidd[0];
	  if(sec_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changesection'); ?>",
				method : "POST",
				data : {finidd:finidd,sec_value:sec_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Section Change");
					}
				},
			});
	  }
	}
	function changesubject1(sub_data){
   	  var sub_value = $('#'+sub_data).val();
	  var getidd = sub_data.split("_");
	  var finidd = getidd[0];
	  if(sub_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changesubject1'); ?>",
				method : "POST",
				data : {finidd:finidd,sub_value:sub_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Subject Change");
					}
				},
			});
	  }
	}
	function changesubject2(sub_data){
   	  var sub_value = $('#'+sub_data).val();
	  var getidd = sub_data.split("_");
	  var finidd = getidd[0];
	  if(sub_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changesubject2'); ?>",
				method : "POST",
				data : {finidd:finidd,sub_value:sub_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Subject Change");
					}
				},
			});
	  }
	}
	function changesubject3(sub_data){
   	  var sub_value = $('#'+sub_data).val();
	  var getidd = sub_data.split("_");
	  var finidd = getidd[0];
	  if(sub_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changesubject3'); ?>",
				method : "POST",
				data : {finidd:finidd,sub_value:sub_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Subject Change");
					}
				},
			});
	  }
	}
	function changesubject4(sub_data){
   	  var sub_value = $('#'+sub_data).val();
	  var getidd = sub_data.split("_");
	  var finidd = getidd[0];
	  if(sub_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changesubject4'); ?>",
				method : "POST",
				data : {finidd:finidd,sub_value:sub_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Subject Change");
					}
				},
			});
	  }
	}
	function changesubject5(sub_data){
   	  var sub_value = $('#'+sub_data).val();
	  var getidd = sub_data.split("_");
	  var finidd = getidd[0];
	  if(sub_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changesubject5'); ?>",
				method : "POST",
				data : {finidd:finidd,sub_value:sub_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Subject Change");
					}
				},
			});
	  }
	}
	function changesubject6(sub_data){
   	  var sub_value = $('#'+sub_data).val();
	  var getidd = sub_data.split("_");
	  var finidd = getidd[0];
	  if(sub_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changesubject6'); ?>",
				method : "POST",
				data : {finidd:finidd,sub_value:sub_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Subject Change");
					}
				},
			});
	  }
	}
</script>