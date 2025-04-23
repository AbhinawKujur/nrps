<?php
	error_reporting(0);
  if($student_detail){
  $ID = $student_detail[0]->ID;
  $ADM_CLASS = $student_detail[0]->ADM_CLASS;
  $ADM_SEC = $student_detail[0]->ADM_SEC;
  $CURRENT_CLASS_CODE = $student_detail[0]->CURRENT_CLASS_CODE;
  $CURRENT_SEC_CODE = $student_detail[0]->CURRENT_SEC_CODE;
  $CATEGORY_CODE = $student_detail[0]->CATEGORY_CODE;
  $HOUSE_CODE = $student_detail[0]->HOUSE_CODE;
  $EMP_CODE = $student_detail[0]->EMP_CODE;
  $STOPPAGE_CODE = $student_detail[0]->STOPPAGE_CODE;
  $RELIGION_CODE = $student_detail[0]->RELIGION_CODE;
  $ADMISSION_NO = $student_detail[0]->ADMISSION_NO;
  $ADMISSION_DATE = $student_detail[0]->ADMISSION_DATE;
  $STUDENT_NAME = $student_detail[0]->STUDENT_NAME;
  $CLASS_NAME = $student_detail[0]->CLASS_NAME;
  $SECTION_NAME = $student_detail[0]->SECTION_NAME;
  $ROLL_NO = $student_detail[0]->ROLL_NO;
  $GENDER = $student_detail[0]->GENDER;
  $DATE_OF_BIRTH = $student_detail[0]->DATE_OF_BIRTH;
  $HOUSE_NAME = $student_detail[0]->HOUSE_NAME;
  $EMPLOYEE_WARD = $student_detail[0]->EMPLOYEE_WARD;
  $BUSSTOPAGE = $student_detail[0]->BUSSTOPAGE;
  $BLOOD_GROUP = $student_detail[0]->BLOOD_GROUP;
  $ACCOUNT_NUMBER = $student_detail[0]->ACCOUNT_NUMBER;
  $AADHAR_NUMBER = $student_detail[0]->AADHAR_NUMBER;
  $RELIGION = $student_detail[0]->RELIGION;
  $SCIENCE_FEE = $student_detail[0]->SCIENCE_FEE;
  $HOSTEL_STATUS =$student_detail[0]->HOSTEL_STATUS;
	$MUSIC_STATUS = $student_detail[0]->MUSIC_STATUS;
  $COUMPUTER_STATUS = $student_detail[0]->COUMPUTER_STATUS;
  $FREESHIP_STATUS = $student_detail[0]->FREESHIP_STATUS;
  $FREESHIP_MONTH =$student_detail[0]->FREESHIP_MONTH;
  $HANDICAP = $student_detail[0]->HANDICAP;
  $HANDICAP_NATURE = $student_detail[0]->HANDICAP_NATURE;
  $FATHERNAME = $student_detail[0]->FATHERNAME;
  $MOTHERNAME = $student_detail[0]->MOTHERNAME;
  $PERADD = $student_detail[0]->PERADD;
  $PERCITY = $student_detail[0]->PERCITY;
  $PERSTATE = $student_detail[0]->PERSTATE;
  $PERNATION = $student_detail[0]->PERNATION;
  $PERPIN = $student_detail[0]->PERPIN;
  $PERPHONE1 = $student_detail[0]->PERPHONE1;
  $PERPHONE2 = $student_detail[0]->PERPHONE2;
  $PERMOBILE = $student_detail[0]->PERMOBILE;
  $PERFAX = $student_detail[0]->PERFAX;
  $PEREMAIL = $student_detail[0]->PEREMAIL;
  $CROSSADD = $student_detail[0]->CROSSADD;
  $CROSSCITY = $student_detail[0]->CROSSCITY;
  $CROSSSTATE = $student_detail[0]->CROSSSTATE;
  $CROSSPIN = $student_detail[0]->CROSSPIN;
  $CROSSNATION = $student_detail[0]->CROSSNATION;
  $CROSSMOBILE = $student_detail[0]->CROSSMOBILE;
  $CROSSPHONE1 = $student_detail[0]->CROSSPHONE1;
  $CROSSPHONE2 = $student_detail[0]->CROSSPHONE2;
  $CROSSFAX = $student_detail[0]->CROSSFAX;
  $CROSSEMAIL = $student_detail[0]->CROSSEMAIL;
  $SUBJECT1 = $student_detail[0]->SUBJECT1;
  $SUBJECT2 = $student_detail[0]->SUBJECT2;
  $SUBJECT3 = $student_detail[0]->SUBJECT3;
  $SUBJECT4 = $student_detail[0]->SUBJECT4;
  $SUBJECT5 = $student_detail[0]->SUBJECT5;
  $SUBJECT6 = $student_detail[0]->SUBJECT6;
  $CBSEREGISTRATION = $student_detail[0]->CBSEREGISTRATION;
  $CBSEROLL = $student_detail[0]->CBSEROLL;
  $LAST_SCHOOL =$student_detail[0]->LAST_SCHOOL;
  $LSCH_ADD = $student_detail[0]->LSCH_ADD;
  $STUDENT_IMAGE = $student_detail[0]->STUDENT_IMAGE;
  $PEN 	= $student_detail[0]->PEN;
  $APAR_ID = $student_detail[0]->APAR_ID;
  }

  if($GENDER==1)
  {
    $gender_type='MALE';
  }else{
    $gender_type="FEMALE";
  }
  
 $Science_subject = $SCIENCE_FEE." SUBJECT";
 
 if($father_detail)
 {
  $ED_QUA =$father_detail[0]->ED_QUA;
  $OCCUPATION = $father_detail[0]->OCCUPATION;
  $DESIG = $father_detail[0]->DESIG;
  $MTH_INCOME = $father_detail[0]->MTH_INCOME;
  $ADDRESS = $father_detail[0]->ADDRESS;
  $MOBILE =$father_detail[0]->MOBILE;
  $CITY = $father_detail[0]->CITY;
  $PIN = $father_detail[0]->PIN;
  $STATEE =$father_detail[0]->STATE;
 }
 if($mother_detail){
  $MED_QUA =$mother_detail[0]->ED_QUA;
  $MOCCUPATION = $mother_detail[0]->OCCUPATION;
  $MDESIG = $mother_detail[0]->DESIG;
  $MMTH_INCOME = $mother_detail[0]->MTH_INCOME;
  $MADDRESS = $mother_detail[0]->ADDRESS;
  $MMOBILE =$mother_detail[0]->MOBILE;
  $MCITY = $mother_detail[0]->CITY;
  $MPIN = $mother_detail[0]->PIN;
  $MSTATEE =$mother_detail[0]->STATE;
}
if($sibling_details){
  $Name1 =$sibling_details[0]->Name1;
  $Sex1 =$sibling_details[0]->Sex1;
  $DOB1 =$sibling_details[0]->DOB1;
  $Adm1 =$sibling_details[0]->Adm1;
  $Name2 =$sibling_details[0]->Name2;
  $DOB2 =$sibling_details[0]->DOB2;
  $Sex2 =$sibling_details[0]->Sex2;
  $Adm2 =$sibling_details[0]->Adm2;
  $Name3 =$sibling_details[0]->Name3;
  $DOB3 =$sibling_details[0]->DOB3;
  $Sex3 =$sibling_details[0]->Sex3;
  $Adm3 =$sibling_details[0]->Adm3;
  $Name4 =$sibling_details[0]->Name4;
  $DOB4 =$sibling_details[0]->DOB4;
  $Sex4 =$sibling_details[0]->Sex4;
  $Adm4 =$sibling_details[0]->Adm4;
}
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Update Student Details</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style type="text/css">
  body{
   font-family: Verdana,Geneva,sans-serif; 
  }
  #form ul li a {
    background-color: #5785c3;
    color: white;
    font-size: 15px;
    text-align: center;
    padding-left: 7px;
    font-weight: 10px;
    margin-left: 0px;
}
</style>
<form method="post" action="<?php echo base_url('Student_details/re_update'); ?>" id="form" onsubmit="return validation()" enctype="multipart/form-data">
		<div style="padding: 10px; background-color: white">
			<div class="row">
				<div class="col-md-9">
					<?php
					   if($this->session->flashdata('msg')){
					   	?>
					   	<div class="alert alert-success" role="alert" id="msg" style="padding: 5px 0px;">
			  				<center><strong><?php echo $this->session->flashdata('msg'); ?></strong></center>
						</div>
					   	<?php
					   }
					?>
				</div>
        <div class="col-md-2">
          <center><input type="submit" name="submit" value="Update" class="btn btn-success"></center><br>
        </div>
		<div class="col-sm-1">		
		  <a href="<?php echo base_url('Student_details/show_student_details/'.$ID); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br />
        </div><br />
		</div>
		 <div class="row" id="row">
            <div class="col">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist" id="ul">
                        <li class="nav-item active" id="li">
                            <a class="nav-link " data-toggle="tab" href="#tab1" role="tab">Student Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">Parent Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">Address Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab4" role="tab">Sibling Details</a>  
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab5" role="tab">Subject Details</a> 
                        </li>
						<li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab6" role="tab">Optional Facility</a> 
                        </li>
                    </ul>

                    <div class="tab-content">
                     <div class="tab-pane fade active in cont" id="tab1">
                       <br>
                        <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Student Information</i></b></h2>        
                         <br>
                          <div class="row">
                            <div class="col-md-2 col-sm-2 col-lg-2">
                              <?php
                                if($STUDENT_IMAGE!='')
                                {
                                  ?>
                                  <img style="height: auto; width: 100%;" src="<?php echo base_url($STUDENT_IMAGE); ?>" id="uploaded_image"><br>
                                 <input type="file" name="reupload" id="id_image" onchange="reupload(this.files[0].size)"><br>
                                 <span class="span" id="img_error"></span>
                                  <?php

                                }
                                else
                                {
                                  ?>
                                  <img src="<?php echo base_url('assets/student_photo/default.jpg'); ?>" style="height: auto; width: 100%;" id="uploaded_image" ><br>
                                  <input type="file" name="reupload" id="id_image" onchange="reupload(this.files[0].size)"><br>
                                  <span class="span" id="img_error"></span>
                                  <?php

                                }
                              ?>
                            </div>
                                <div class="col-md-10 col-sm-10 col-lg-10">
                                         <div class="form-row">
                                            <div class="form-group col-md-4">
                                               <label>Student Id</label>
                                                   <input type="text" name="sti" id="stdid" class="form-control" value="<?php echo $ID; ?>" readonly>
                                            </div>                    
                                            <div class="form-group col-md-4">
                                                <label>Admission Number</label>
                                                <input type="text" name="adn" id="adm_no" class="form-control" value="<?php echo $ADMISSION_NO; ?>" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                              <label>Admission Date<span class='req'>*</span></label>
                                              <input type="date" id='std_adm_date' name="ad" class="form-control" value="<?php echo date('Y-m-d',strtotime($ADMISSION_DATE)) ?>">
                                            </div>
                                            
                                         </div>
                                         <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Student Full Name<span class='req'>*</span></label>
                                                <input type="text" style="text-transform:uppercase;" name="sfn" class="form-control" pattern="[A-Za-z ]{3,}" value="<?php echo $STUDENT_NAME; ?>" required>
                                            </div>  
                                        </div>
									      <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Apar ID</label>
                                                <input type="text" style="text-transform:uppercase;" name="aparid" class="form-control" value="<?php echo $APAR_ID; ?>">
                                            </div>  
                                        </div>
                                </div>
                                   
                               </div>
                       <div class="form-row">
                        <div class="form-group col-md-6">
                           <div class="row">
                            <div class="col-sm-6">
                              <label>Admission in Class<span class='req'>*</span></label>
                              <select name="admclass" id="admclass" class="form-control" readonly>
                                <?php
                                if($class)
                                {
                                  foreach ($class as $class_details) 
                                  {
                                    ?>
                                    <option value="<?php echo $class_details->Class_No;?>" <?php if($ADM_CLASS==$class_details->Class_No) { echo "selected";} ?> ><?php echo $class_details->CLASS_NM; ?></option>
                                    <?php
                                  }
                                }
                                ?>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label>Admission in Section<span class='req'>*</span></label>
                              <select name="admsec" id="admsec" class="form-control" class="form-control" readonly>
                               <?php
                               if($section){
                                foreach ($section as $section_details) {
                                  ?>
                                  <option value="<?php echo $section_details->section_no; ?>" <?php if($ADM_SEC==$section_details->section_no) {echo "selected";} ?> ><?php echo $section_details->SECTION_NAME; ?></option>
                                  <?php
                                }
                               }
                               ?>
                              </select>
                            </div>
                             
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                              <div class="col-sm-6">
							   <label>Current Class<span class='req'>*</span></label>
                                <select name="curclass" id="curclass" class="form-control" required>
                                  <?php
                                if($class)
                                {
                                  foreach ($class as $class_data) 
                                  {
                                    ?>
                                    <option value="<?php echo $class_data->Class_No; ?>" <?php if($CURRENT_CLASS_CODE==$class_data->Class_No) {echo "selected";} ?> ><?php echo $class_data->CLASS_NM; ?></option>
                                    <?php
                                  }
                                }
                                ?>
                                </select>
                              </div>
                              <div class="col-sm-6">
                                <label>Current Section<span class='req'>*</span></label>
                                <select name="cursec" id="cursec" class="form-control" required>
                                  <?php
                               if($section){
                                foreach ($section as $section_data) {
                                  ?>
                                  <option value="<?php echo $section_data->section_no; ?>" <?php if($CURRENT_SEC_CODE==$section_data->section_no) {echo "selected";} ?> ><?php echo $section_data->SECTION_NAME; ?></option>
                                  <?php
                                }
                               }
                               ?>
                                </select>
                              </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Roll No.<span class='req'>*</span></label>
                            <input type="text"  class="form-control" value="<?php echo $ROLL_NO; ?>" id='roll' name="roll" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Gender<span class='req'>*</span></label>
                            <select name="sex" id="sex" class="form-control">
                              <option value="1" <?php if($GENDER==1){ echo "selected";} ?>>MALE</option>
                              <option value="2"<?php if($GENDER==2){ echo "selected";} ?>>FEMALE</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label>Date of Birth</label>
                          <input type="date" name="dob" class="form-control" value="<?php echo date('Y-m-d',strtotime($DATE_OF_BIRTH)) ?>">
                          
                        </div>
						<div class="form-group col-md-3">
                          <label>PEN</label>
                          <input type="text" name="pen" class="form-control" value="<?php echo $PEN; ?>">
                          
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Category<span class='req'>*</span></label>
                            <select name="category" id="category" class="form-control" required>
                              <?php
                              if($category){
                                foreach ($category as $category_data) {
                                  ?>
                                  <option value="<?php echo $category_data->CAT_CODE; ?>" <?php if($CATEGORY_CODE==$category_data->CAT_CODE) { echo "selected"; }?> ><?php echo $category_data->CAT_ABBR; ?></option>
                                  <?php
                                }
                              }
                              ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>House</label>
                             <select required name="house" id="house" class="form-control">
                               <?php
                               if($house){
                                foreach ($house as $house_code) {
                                  ?>
                                  <option value="<?php echo $house_code->HOUSENO; ?>" <?php if($HOUSE_CODE==$house_code->HOUSENO) {echo "selected";} ?> ><?php echo $house_code->HOUSENAME; ?></option>
                                  <?php
                                }
                               }
                               ?>
                             </select>     
                        </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Ward Type<span class='req'>*</span></label>
                        <select id="ward" required name="ward" class="form-control">
                          <?php
                          if($eward){
                            foreach ($eward as $ward_data) {
                              ?>
                              <option value="<?php echo $ward_data->HOUSENO; ?>" <?php if($EMP_CODE==$ward_data->HOUSENO) { echo "selected"; } ?> ><?php echo $ward_data->HOUSENAME; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Blood Group</label>
                         <select class="form-control" id="blood_group" name="blood_group" required>
                            <option value="NONE" <?php if($BLOOD_GROUP=='NONE'){echo "selected";} ?>>Select Blood Group</option>
                            <option value="A+" <?php if($BLOOD_GROUP=="A+") {echo "selected";} ?> >A+</option>
                            <option value="A-" <?php if($BLOOD_GROUP=="A-") {echo "selected";} ?> >A-</option>
                            <option value="B+" <?php if($BLOOD_GROUP=="B+") {echo "selected";} ?> >B+</option>
                            <option value="B-" <?php if($BLOOD_GROUP=="B-") {echo "selected";} ?> >B-</option>
                            <option value="O+" <?php if($BLOOD_GROUP=="O+") {echo "selected";} ?> >O+</option>
                            <option value="O-" <?php if($BLOOD_GROUP=="O-") {echo "selected";} ?> >O-</option>
                            <option value="AB+" <?php if($BLOOD_GROUP=="AB+") {echo "selected";} ?> >AB+</option>
                            <option value="AB-" <?php if($BLOOD_GROUP=="AB-") {echo "selected";} ?>>AB-</option>
                        </select>
                      </div> 
                    </div>
                    <div class="form-row">
                       <div class="form-group col-md-6">
                        <label>Account No.</label>
                        <input type="text" style="text-transform:uppercase;" required name="account_number" class="form-control" value="<?php echo $ACCOUNT_NUMBER; ?>">
                      </div>
                       <div class="form-group col-md-6">
                        <label>Aadhaar No.<span class='req'>*</span></label>
                        <input type="text" required name="aadhar_no" class="form-control" value="<?php echo $AADHAR_NUMBER; ?>">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Religion<span class='req'>*</span></label>
                        <select name="religionn" required id="religion" class="form-control">
                          <?php
                          if($religion){
                            foreach ($religion as $religion_data) {
                              ?>
                              <option value="<?php echo $religion_data->RNo; ?>" <?php if($RELIGION_CODE==$religion_data->RNo) {echo "selected";} ?>><?php echo $religion_data->Rname; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select> 
                      </div>
                      <div class="form-group col-md-6">
                        <label>Handicap</label>
                        <input type="radio" name="radio4" value="1" <?php if($HANDICAP==1) {echo "checked";} ?> onclick="handicapp(this.value)" >Yes
                        <input type="radio" name="radio4" value="0" <?php if($HANDICAP==0) {echo "checked";} ?> onclick="handicapp(this.value)" >No<br>
                        <input type="text" id="handi_nature" name="handicap" class="form-control" value="<?php echo $HANDICAP_NATURE; ?>" <?php if($HANDICAP==0) {echo "disabled";} ?>>    
                      </div>   
                    </div>
                    
                  <hr style="border: .5px solid black;">
                    <div class="row">
                      <div class="col-md-12">
                        Last School Details
                      </div><br><br>
                    </div>
                    <div class="row">
                      <div class="form-group">
                        <div class="col-md-6">
                        <label>School Name</label>
                        <input type="text" style="text-transform:uppercase;" autocomplete="off" name="lsn" id="lsn" class="form-control" value="<?php echo $LAST_SCHOOL; ?>" >
                      </div>
                      <div class="col-md-6">
                        <label>School Address</label>
                        <input type="text" style="text-transform:uppercase;" autocomplete="off" name="lsa" id="lsa" class="form-control" value="<?php echo $LSCH_ADD; ?>">
                      </div>
                      </div>
                    </div><br>
					<!--<div class="row">
                      <div class="col-md-12">
                         <center><span id="std_error" class="span"></span></center>
                          <center><a href="#" id="btnNext" class="btn btn-success">NEXT</a></center><br>
                      </div>
                  </div>-->
              </div>
            <div class="tab-pane" id="tab2">
             <br>
             <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Parent's Details</i></b></h2>
             <br>
             <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <h3 class="text-center text-info">Father's Details</h3>
                    <div class="form-group">
                        <label>Name<span class='req'>*</span></label>
                        <input type="text" pattern="[A-Za-z /]{3,}" style="text-transform:uppercase;" name="fname" class="form-control" value="<?php echo $FATHERNAME; ?>" required>    
                    </div>
                    <div class="form-group">
                        <label>Educational Qualification</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="fedu" value="<?php echo $ED_QUA; ?>">  
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="foccupation" value="<?php echo $OCCUPATION; ?>" >  
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="fdesignation" value="<?php echo $DESIG; ?>">   
                    </div>
                    <div class="form-group">
                        <label>Monthly Income</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="fincome" value="<?php echo $MTH_INCOME; ?>">
                    </div>
                    <div class="form-group">
                        <label>Mobile No.</label>
                        <input type="number" class="form-control" name="fmobile" value="<?php echo $MOBILE; ?>">   
                    </div>
                    <div class="form-group">
                        <label>Address</label><br>
                       <input type="text" style="text-transform:uppercase;" class="form-control" name="faddress" value="<?php echo $ADDRESS; ?>">   
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="fcity" value="<?php echo $CITY; ?>">
                    </div>
                    <div class="form-group">
                        <label>PinCode</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="fpin" value="<?php echo $PIN; ?>">
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="fstate" name="fstate" id="fstate" value="<?php echo $STATEE; ?>">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <h3 class="text-center text-info">Mother's Details</h3>
                    <div class="form-group">
                        <label>Name<span class='req'>*</span></label>
                        <input type="text" pattern="[A-Za-z /]{3,}" style="text-transform:uppercase;" name="mname" class="form-control" value="<?php echo $MOTHERNAME; ?>" required>
                        
                    </div>
                    <div class="form-group">
                        <label>Educational Qualification</label>
                        <input type="text" style="text-transform:uppercase;" name="medu" class="form-control" value="<?php echo $MED_QUA; ?>">
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" style="text-transform:uppercase;" name="moccu" class="form-control" value="<?php echo $MOCCUPATION; ?>">
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" style="text-transform:uppercase;" name="mdesignation" class="form-control" value="<?php echo $MDESIG; ?>">
                    </div>
                    <div class="form-group">
                        <label>Monthly Income</label>
                        <input type="text" style="text-transform:uppercase;" name="mincome" class="form-control" value="<?php echo $MMTH_INCOME; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>Mobile No.</label>
                        <input type="number" style="text-transform:uppercase;" name="mmobile" class="form-control" value="<?php echo $MMOBILE; ?>">
                    </div>
                    <div class="form-group">
                        <label>Address</label><br>
                        <input type="text" style="text-transform:uppercase;" name="maddress" class="form-control" value="<?php echo $MADDRESS; ?>">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" style="text-transform:uppercase;" name="mcity" class="form-control" value="<?php echo $MCITY; ?>">
                    </div>
                    <div class="form-group">
                        <label>PinCode</label>
                        <input type="text" style="text-transform:uppercase;" name="mpin" class="form-control" value="<?php echo $MPIN; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" style="text-transform:uppercase;" name="mstate" id="mstate" class="form-control" value="<?php echo $MSTATEE; ?>">
                    </div>
                </div>  
             </div>
				<!--<div class="row">
                      <div class="col-md-12">
                         <center><span id="std_error" class="span"></span></center>
                          <center><a href="#" id="btnbackpar" class="btn btn-success">BACK</a>&nbsp;<a href="#" id="btnextpste" class="btn btn-success">NEXT</a></center><br>
                      </div>
                  </div>-->
            </div>

            <div class="tab-pane" id="tab3">
                <br>
            <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Address Details</i></b></h2>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3 class="text-info text-center">Correspondence Address</h3>
                        
                        <div class="form-group">
                            <label>Address</label><br>
                            <input type="text" style="text-transform:uppercase;" name="cross_add" id="crossaddress" class="form-control" value="<?php echo $CROSSADD; ?>">
                        </div> 
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" style="text-transform:uppercase;" id="crosscity" name="cross_city" class="form-control" value="<?php echo $CROSSCITY; ?>">
                        </div>
                        <div class="form-group">
                            <label>PinCode</label>
                            <input type="text" style="text-transform:uppercase;" id="crosspin" name="cross_pin" class="form-control" value="<?php echo $CROSSPIN; ?>">
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" style="text-transform:uppercase;" name="crossstate" id="crossstate" class="form-control" value="<?php echo $CROSSSTATE; ?>">
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" style="text-transform:uppercase;" name="cross_nation" class="form-control" id="crosscountry" value="<?php echo $CROSSNATION; ?>">
                        </div>
                        <div class="form-group">
                            <label>Mobile No.<span class='req'>*</span></label>
                            <input type="text" pattern="[0-9]{10}" style="text-transform:uppercase;" id="crossmoblile" name="cross_mobile" class="form-control" value="<?php echo $CROSSMOBILE; ?>">
                        </div>
                        <div class="form-group">
                            <label>Phone No.</label>
                            <input type="text" style="text-transform:uppercase;" id="crossphone" name="cross_phone1" class="form-control" value="<?php echo $CROSSPHONE1; ?>">
                            
                        </div>
                        <div class="form-group">
                            <label>Phone No 2</label>
                            <input type="text" style="text-transform:uppercase;" id="crossphone2" name="cross_phone2" class="form-control" value="<?php echo $CROSSPHONE2; ?>">
                            
                        </div>
                        <div class="form-group">
                            <label>Fax No.</label>
                            <input type="text" style="text-transform:uppercase;" id="crossfax" name="cross_fax" class="form-control" value="<?php echo $CROSSFAX; ?>">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" style="text-transform:uppercase;" id="crossemail" name="cross_email" class="form-control" value="<?php echo $CROSSEMAIL; ?>">
                        </div>
                       <!-- <input type="checkbox" name="address" id="address"><span>Checked If Address Same</span>-->    
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3 class="text-info text-center">Permanent Address</h3>
                        <div class="form-group">
                            <label>Address&nbsp;&nbsp;<span class="req"><input type="checkbox" id="getaddress" onclick="filladdress()">Check If Same</span></label><br>
                            <input type="text" style="text-transform:uppercase;" id="peradd" name="peradd" class="form-control" value="<?php echo $PERADD; ?>">
                        </div> 
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" style="text-transform:uppercase;" name="percity" class="form-control" value="<?php echo $PERCITY; ?>">
                        </div>
                        <div class="form-group">
                            <label>PinCode</label>
                            <input type="text" style="text-transform:uppercase;" id="perpin" name="per_pin" class="form-control" value="<?php echo $PERPIN; ?>">
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" style="text-transform:uppercase;" name="perstate" id="perstate" class="form-control" value="<?php echo $PERSTATE; ?>">
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" style="text-transform:uppercase;" name="pernation" id="percountry" class="form-control" value="<?php echo $PERNATION; ?>">
                        </div>
                        <div class="form-group">
                            <label>Mobile No.<span class='req'>*</span></label>
                            <input type="text" style="text-transform:uppercase;" name="per_mobile" pattern="[0-9]{10}" id="permobile" class="form-control" value="<?php echo $PERMOBILE; ?>">
                        </div>
                        <div class="form-group">
                            <label>Phone No.</label>
                            <input type="text" style="text-transform:uppercase;" id="perphone" name="phone_1" class="form-control" value="<?php echo $PERPHONE1; ?>">
                            
                        </div>
                        <div class="form-group">
                            <label>Phone No 2</label>
                            <input type="text" style="text-transform:uppercase;" id="perphone2" name="phone_2" class="form-control" value="<?php echo $PERPHONE2; ?>">
                        </div>
                        <div class="form-group">
                            <label>Fax No.</label>
                            <input type="text" style="text-transform:uppercase;" id="perfax" name="per_fax" class="form-control" value="<?php echo $PERFAX; ?>">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" id="peremail" name="per_email" class="form-control" value="<?php echo $PEREMAIL; ?>">
                            
                        </div>
                    </div>           
                </div>
				<!--<div class="row">
				  <div class="col-md-12">
					 <center><span id="std_error" class="span"></span></center>
					  <center><a href="#" id="btnbackpar1" class="btn btn-success">BACK</a>&nbsp;<a href="#" id="btnextpste1" class="btn btn-success">NEXT</a></center><br>
				  </div>
                </div>-->
            </div>
            <div class="tab-pane" id="tab4">
                <br>
            <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Sibling Details</i></b></h2>
             <br>

             <div class="row">
                 <div class="col-sm-6 col-md-6 col-lg-6"><br>
                    <h4 class="text-center text-info">First Sibling Details</h4>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $Name1; ?>" >
                    </div>
                    <div class="form-group">
                        <label>Sex</label>
                        <input type="text" name="first_sex" class="form-control" value="<?php echo $Sex1; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="first_dob" class="form-control" value="<?php echo date('Y-m-d',strtotime($DOB1)) ?>">
                    </div>
                    <div class="form-group">
                        <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" name="first_adm" class="form-control" value="<?php echo $Adm1; ?>">
                        
                    </div>
                 </div>
                 <br>
                 <div class="col-sm-6 col-md-6 col-lg-6">
                    <h4 class="text-center text-info">Second Sibling Details</h4>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="second_name" class="form-control" value="<?php echo $Name2; ?>">
                    </div>
                    <div class="form-group">
                        <label>Sex</label>
                        <input type="text" name="second_sex" class="form-control" value="<?php echo $Sex2; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="second_dob" class="form-control" value="<?php echo date('Y-m-d',strtotime($DOB2)) ?>">
                    </div>
                    <div class="form-group">
                    <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" name="second_adm" class="form-control" value="<?php echo $Adm2;?>">  
                    </div>
                        
                    
                 </div>
             </div>
             <div class="row">
                 <div class="col-sm-6 col-md-6 col-lg-6">
                     <h4 class="text-center text-info">Third Sibling Details</h4>
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="third_name" class="form-control" value="<?php echo $Name3; ?>">
                    </div>
                    <div class="form-group">
                        <label>Sex</label>
                        <input type="text" name="third_sex" class="form-control" value="<?php echo $Sex3; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="third_dob" class="form-control" value="<?php echo date('Y-m-d',strtotime($DOB3)) ?>">
                    </div>
                    <div class="form-group">
                    <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                    <input type="text" name="third_adm" class="form-control" value="<?php echo $Adm3; ?>">
                        
                    </div>
                 
                 </div>
                 <div class="col-md-6 col-lg-6 col-sm-6"> 
                     <h4 class="text-center text-info">Fourth Sibling Details</h4>
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="fourth_name" class="form-control" value="<?php echo $Name4; ?>">
                    </div>
                    <div class="form-group">
                        <label>Sex</label>
                       <input type="text" name="fourth_sex" class="form-control" value="<?php echo $Sex4; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="fourth_dob" class="form-control" value="<?php echo date('Y-m-d',strtotime($DOB4)) ?>">
                    </div>
                    <div class="form-group">
                        <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" name="fourth_adm" class="form-control" value="<?php echo $Adm4; ?>">
                        
                    </div>
               
                 </div>
             </div>
				<!--<div class="row">
				  <div class="col-md-12">
					 <center><span id="std_error" class="span"></span></center>
					  <center><a href="#" id="btnbackpar2" class="btn btn-success">BACK</a>&nbsp;<a href="#" id="btnextpste2" class="btn btn-success">NEXT</a></center><br>
				  </div>
				</div>-->
            </div>
            <!-- SUBJECT DETAILS OF STUDENT-->
            <div class="tab-pane" id="tab5">
             <br>
            <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Subject Details</i></b></h2>
            <br>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>First Subject</label>
                        <select name="first_subject" id="first_subject" class="form-control">
                          <option value="">select</option>
                          <?php
                          if($subject){
                            foreach ($subject as $subject_code1) {
                              ?>
                              <option value="<?php echo $subject_code1->SubSName; ?>" <?php if($SUBJECT1==$subject_code1->SubName or $SUBJECT1==$subject_code1->SubSName) {echo "selected";} ?> ><?php echo $subject_code1->SubName; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Second Subject</label>
                        <select name="second_subject" id="second_subject" class="form-control">
                          <option value="">select</option>
                          <?php
                          if($subject){
                            foreach ($subject as $subject_code2) {
                              ?>
                              <option value="<?php echo $subject_code2->SubSName; ?>" <?php if($SUBJECT2==$subject_code2->SubName or $SUBJECT2==$subject_code2->SubSName) {echo "selected";} ?>><?php echo $subject_code2->SubName; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Third Subject</label>
                        <select name="third_subject" id="third_subject" class="form-control">
                          <option value="">select</option>
                          <?php
                          if($subject){
                            foreach ($subject as $subject_code3) {
                              ?>
                              <option value="<?php echo $subject_code3->SubSName; ?>" <?php if($SUBJECT3==$subject_code3->SubName or $SUBJECT3==$subject_code3->SubSName) {echo "selected";} ?>><?php echo $subject_code3->SubName; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Fourth Subject</label>
                        <select name="fourth_subject" id="fourth_subject" class="form-control">
                          <option value="">select</option>
                          <?php
                          if($subject){
                            foreach ($subject as $subject_code4) {
                              ?>
                              <option value="<?php echo $subject_code4->SubSName; ?>" <?php if($SUBJECT4==$subject_code4->SubName or $SUBJECT4==$subject_code4->SubSName) {echo "selected";} ?> ><?php echo $subject_code4->SubName; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fifth Subject</label>
                       <select name="fifth_subject" id="fifth_subject" class="form-control">
                          <option value="">select</option>
                          <?php
                          if($subject){
                            foreach ($subject as $subject_code5) {
                              ?>
                              <option value="<?php echo $subject_code5->SubSName; ?>" <?php if($SUBJECT5==$subject_code5->SubName or $SUBJECT5==$subject_code5->SubSName) {echo "selected";} ?> ><?php echo $subject_code5->SubName; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sixth Subject</label>
                        <select name="sixth_subject" id="sixth_subject" class="form-control">
                          <option value="">select</option>
                          <?php
                          if($subject){
                            foreach ($subject as $subject_code6) {
                              ?>
                              <option value="<?php echo $subject_code6->SubSName; ?>" <?php if($SUBJECT6==$subject_code6->SubName or $SUBJECT6==$subject_code6->SubSName) {echo "selected";} ?> ><?php echo $subject_code6->SubName; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>Board Reg No.</label>
                        <input type="text" name="cbsereg" class="form-control" value="<?php echo $CBSEREGISTRATION; ?>">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6">
					<div class="form-group">
						<label>Board Roll No.</label>
						<input type="text" name="cbseroll" class="form-control" value="<?php echo $CBSEROLL; ?>">
					</div>
                </div>
            </div>
			<!--<div class="row">
				  <div class="col-md-12">
					 <center><span id="std_error" class="span"></span></center>
					  <center><a href="#" id="btnbackpar3" class="btn btn-success">BACK</a>&nbsp;<a href="#" id="btnextpste3" class="btn btn-success">NEXT</a></center><br>
				  </div>
			</div>-->
            </div>
			<div class="tab-pane" id="tab6">
				<br>
				<h2 class="text-center" style="color:black;padding-top:10px"><b><i>Facility Details</i></b></h2>
				<br>
				<div class='row'>
					<div class="form-group col-md-4">
                        <label>Computer</label>
                        <input type="radio" name="radio2" value="1" <?php if($COUMPUTER_STATUS==1) {echo "checked";} ?>>Yes
                        <input type="radio" name="radio2" value="0" <?php if($COUMPUTER_STATUS==0) {echo "checked";} ?>>No
                    </div>
					 <div class="form-group col-md-3">
                <label>Music</label>
                <input type="radio" name="radio5" value="1" <?php if ($MUSIC_STATUS == 1) {
                                                              echo "checked";
                                                            } ?>>Yes
                <input type="radio" name="radio5" value="0" <?php if ($MUSIC_STATUS == 0) {
                                                              echo "checked";
                                                            } ?>>No
              </div>
					<div class='form-group col-md-4'>
						<label>Hostel</label>
                        <input type="radio" name="radio1" value="1" <?php if($HOSTEL_STATUS==1) {echo "checked";} ?>>Yes
                        <input type="radio" name="radio1" value="0" <?php if($HOSTEL_STATUS==0) {echo "checked";} ?> >No
					</div>
				</div>
				<div class='row'>
					<div class="form-group col-md-6">
                        <label>Science Fee</label>
                       <select name="SCIENCE_FEE" required id="SCIENCE_FEE" class="form-control">
                         <option value="0" <?php if($Science_subject==0){echo "selected";} ?>>select subject</option>
                         <option value="1" <?php if($Science_subject==1){echo "selected";} ?> >1 subject</option>
                         <option value="2" <?php if($Science_subject==2){echo "selected";} ?> >2 subject</option>
                         <option value="3" <?php if($Science_subject==3){echo "selected";} ?> >3 subject</option>
                         <option value="4" <?php if($Science_subject==4){echo "selected";} ?> >4 subject</option>
                       </select>
                    </div>
                    <div class="form-group col-md-6">
                       <label>Freeship</label>
                        <input type="radio" name="radio3" value="1" <?php if($FREESHIP_STATUS==1) {echo "checked";} ?> onclick="freship(this.value)">Yes
                        <input type="radio" name="radio3" value="0" <?php if($FREESHIP_STATUS==0) {echo "checked";} ?> onclick="freship(this.value)">No<br>
                        <!--<input type="text" name="freeship" id="freeship" class="form-control">-->
						
                        <select class="form-control" name="freeship" id="freeship" <?php if($FREESHIP_STATUS != 1){echo "disabled";}?>>
                            <option value="N/A">select</option>
                            <?php
                            if($month){
                            	foreach ($month as $month_data) {
                            	?>
                            	<option value="<?php echo $month_data->month_name; ?>" <?php if($FREESHIP_MONTH==$month_data->month_name) {echo "selected";} ?> ><?php echo $month_data->month_name; ?></option>
                            	<?php
                            	}
                            }
                            ?>
                        </select>
                    </div>
				</div>
				<div class="box box-primary" style="border-top: 3px solid #5785c3;">
              <div class="box-header with-border">
                <h3 class="box-title">Transport Facility
                <button type="button"  data-toggle="collapse" data-target="#leave_details" aria-expanded="true" class="btn-xs btn-black"><i class="fa fa-plus"></i></button></h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body collapse in" aria-expanded="true" id="leave_details">   
                  <div class="row">
					<div class="form-group col-md-3" id="ss">
                        <label>Bus Stoppage</label>
                        <select id="busstopage" onchange="busstopagee(this.value)" required name="busstopage" class="form-control">
                          <?php
                          if($stoppage){
                            foreach ($stoppage as $stoppage_data) {
                              ?>
                              <option value="<?php echo $stoppage_data->STOPNO; ?>" <?php if($STOPPAGE_CODE==$stoppage_data->STOPNO) {echo "selected";} ?>><?php echo $stoppage_data->STOPPAGE; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                    </div>   
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Trip</label>
                        <select name='trip' onchange="getvechicleno(this.value)" id='trip' class='form-control'>
						</select>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Vehicle No.</label>
                         <select onchange="getpreference(this.value)" name='vechicleno' id='vechicleno' class='form-control'>
						</select>
                      </div>
                    </div>
					<div class="col-sm-3">
                      <div class="form-group">
                        <label>Preference</label>
                         <select name='Preference' onchange='getrouteId(this.value)' id='Preference' class='form-control'>
						</select>
                      </div>
                    </div>
                  </div>
				  <div class='row'>
					<div class='col-sm-6'>
						<div class="form-group">
							<label>Applicable Month From (Select Month to be effective from)</label>
							<select name='applicablemonth' class='form-control' id='applicablemonth'>
								<?php
									if($month){
										foreach($month as $monthkey=>$monthvalue){
											?>
											<option value='<?php echo $monthvalue->month_name; ?>'><?php echo $monthvalue->month_name; ?></option>
											<?php
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
                      <div class="form-group">
                       <!-- <label>Fare</label>
                        <input type="text" name="half_paid_leave" class="form-control half_paid_leave" value="<?php //echo set_value('half_paid_leave'); ?>" readonly="">
                      </div> -->
                    </div>
				  </div>
              </div>
            </div><br>
			<!--<div class="row">
				  <div class="col-md-12">
					 <center><span id="std_error" class="span"></span></center>
					  <center><a href="#" id="btnbackpar4" class="btn btn-success">BACK</a>&nbsp;</center><br>
				  </div>
			</div>-->
            </div>
           <br>
            <!-- <div class="col-sm-12">
              
           </div> -->
        </div>
      </div>
    </div>
  </div>
  <input type='hidden' name='route_id' id='route_id' value='<?php echo $student_detail[0]->route_id; ?>'>
  <input type='hidden' name='bus_facility_id' id='bus_facility_id' value='<?php echo $student_detail[0]->student_transport_facility_id; ?>'>
</form><br /><br />
        <div class="clearfix"></div>
<script>
$(document).ready(function(){
	$('#form').validate({ // initialize the plugin
        rules: {
            sfn: {
              required: true,
            },
			curclass: {
				required: true,
			},
            cursec: {
                required: true,
            },
            sex: {
                required: true,
            },
            fname: {
                required: true,
            },
            mname: {
                required: true,
            },
            ad: {
                required: true,
            },
            aadhar_no: {
                required: true,
				minlength:12,
                maxlength: 12,
            },
            category: {
                required: true,
            },
            ward: {
                required: true,
            },
            religionn: {
                required: true,
            },
            cross_mobile: {
                required: true,
				minlength:10,
                maxlength: 10,
            },
            per_mobile: {
                required: true,
				minlength:10,
                maxlength: 10,
            },
            admclass: {
                required: true,
            },
            admsec: {
                required: true,
            },
            // correspondence_address:{
              // regex: /^[a-zA-Z0-9-,/'.\s]{1,40}$/
            // },
            // permanent_address:{
              // regex: /^[a-zA-Z0-9-,'/.\s]{1,40}$/
            // },
            // basic_qualification: {
                // required: true
            // },
            // mobile: {
                // digits: true,
                // required: true,
                // minlength:10,
            // },
             // casual_leave: {
                // digits: true
            // },
             // medical_leave: {
                // digits: true
            // },
             // earned_leave: {
                // digits: true
            // },
            // wing: {
                // required: true
            // },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});
$('#btnNext').click(function(){
	if ($("#form").valid()) {
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
	}
});
$('#btnextpste').click(function(){
	if ($("#form").valid()) {
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
	}
});
$('#btnbackpar').click(function(){
	$('.nav-tabs > .active').prev('li').find('a').trigger('click');
});
 $('#btnextpste1').click(function(){
   if ($("#form").valid()) {
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
	}
});

$('#btnbackpar1').click(function(){
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});
$('#btnextpste2').click(function(){
    $('.nav-tabs > .active').next('li').find('a').trigger('click');
});
$('#btnbackpar2').click(function(){
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});
$('#btnextpste3').click(function(){
    $('.nav-tabs > .active').next('li').find('a').trigger('click');
});
$('#btnbackpar3').click(function(){
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});
function busstopagee(value){
   var div_data = '<option value="">Select</option>';
   var div_data1 = '<option value="">Select</option>';
   if(value == 1){
	  $("#trip").prop('required',false); 
   }else{
	  $.ajax({
		url:'<?php echo base_url('Student_details/stopage'); ?>',
		data:{value:value},
		method:"post",
		dataType:"json",
		success:function(response)
		{
			$.each(response, function(key,val){
			div_data += '<option value="'+val.Trip_ID+'">'+val.Trip_Nm+'</option>';
		});
			$('#trip').html(div_data);
			$("#trip").prop('required',true);
			$('#vechicleno').html(div_data1);
		}
	}); 
   }
 
}
function getvechicleno(val){
	var busstopage = $("#busstopage").val();
	var div_data = '<option value="">Select</option>';
	$.ajax({
		url:'<?php echo base_url('Student_details/getvehicleno'); ?>',
		data:{busstopage:busstopage,val:val},
		method:"post",
		dataType:"json",
		success:function(response)
		{
			$.each(response, function(key,val){
			div_data += '<option value="'+val.BusCode+'">'+val.BusNo+'</option>';
			});
			$('#vechicleno').html(div_data);
			$('#vechicleno').prop('required',true);
		}
	});	
}
function getpreference(val){
	var busstopage = $("#busstopage").val();
	var trip = $("#trip").val();
	var div_data = '<option value="">Select</option>';
	$.ajax({
		url:'<?php echo base_url('Student_details/getpreference'); ?>',
		data:{busstopage:busstopage,val:val,trip:trip},
		method:"post",
		//dataType:"json",
		success:function(response)
		{
			$('#Preference').html(response);
			$("#Preference").prop('required',true);
		}
	});
}
function getrouteId(val){
	var busstopage = $("#busstopage").val();
	var trip = $("#trip").val();
	var vechicleno = $("#vechicleno").val();
	$.ajax({
		url:'<?php echo base_url('Student_details/getrouteId'); ?>',
		data:{busstopage:busstopage,val:val,trip:trip,vechicleno:vechicleno},
		method:"post",
		success:function(response)
		{
			$("#route_id").val(response);
		}
	});
}
function filladdress(){
    if($('#getaddress').is(':checked'))
    {
        var crossaddress = $('#crossaddress').val();
        var crosscity = $('#crosscity').val();
        var crosspin = $('#crosspin').val();
        var crossstate = $('#crossstate').val();
        var crosscountry = $('#crosscountry').val();
        var crossmoblile = $('#crossmoblile').val();
        var crossphone = $('#crossphone').val();
        var crossphone2 = $('#crossphone2').val();
        var crossfax = $('#crossfax').val();
        var crossemail = $('#crossemail').val();
        //alert(''+crossstate);

        $('#peradd').val(crossaddress);
        $('#percity').val(crosscity);
        $('#perpin').val(crosspin);
        $('#perstate').val(crossstate);
        $('#percountry').val(crosscountry);
        $('#permobile').val(crossmoblile);
        $('#perphone').val(crossphone);
        $('#perphone2').val(crossphone2);
        $('#perfax').val(crossfax);
        $('#peremail').val(crossemail);
    }else{

        var blank=$('#hidden').val();
        $('#peradd').val(blank);
        $('#percity').val(blank);
        $('#perpin').val(blank);
        $('#perstate').val(blank);
        $('#percountry').val(blank);
        $('#permobile').val(blank);
        $('#perphone').val(blank);
        $('#perphone2').val(blank);
        $('#perfax').val(blank);
        $('#peremail').val(blank);
    }
   }
		$("#msg").fadeOut(15000);
		
		$("#feedetails").click(function(){
			var val = $('#feedetails').is(':checked');
			if(val == true){
				$("#april").prop('', false);
                $("#may").prop('', false);
                $("#june").prop('', false);
                $("#july").prop('', false);
                $("#august").prop('', false);
                $("#september").prop('', false);
                $("#october").prop('', false);
                $("#november").prop('', false);
                $("#december").prop('', false);
                $("#january").prop('', false);
                $("#february").prop('', false);
                $("#march").prop('', false);
			}else{
				$("#april").prop('', true);
                $("#may").prop('', true);
                $("#june").prop('', true);
                $("#july").prop('', true);
                $("#august").prop('', true);
                $("#september").prop('', true);
                $("#october").prop('', true);
                $("#november").prop('', true);
                $("#december").prop('', true);
                $("#january").prop('', true);
                $("#february").prop('', true);
                $("#march").prop('', true);
			}
		});

		function validation(){
			var chk = document.getElementById('feedetails');
			if(chk.checked){
				return true;
			}else{
				document.getElementById('fee_error').style.color = 'red';
				document.getElementById('fee_error').style.fontSize = 'larger';
				return false;
			}
		}
		
		function freship(val){
			if(val == 0){
				$("#freeship").prop('disabled',true);
			}else{
				$("#freeship").prop('disabled',false);
			}
		}
		
		function handicapp(val){
			if(val==0){
				$("#handi_nature").prop('disabled',true);
			}else{
				$("#handi_nature").prop('disabled',false);
			}
		}
    function readURL(input) {
    var size = input.files[0].size;
    var type = input.value.split('.').pop().toLowerCase();
     if(size<=102400)
     {
       document.getElementById('img_error').innerHTML="";
             if(type=='jpg' || type=='jpeg' || type=='png')
             {
              document.getElementById('img_error').innerHTML="";
               if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#uploaded_image').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }

       }
       else
       {
        document.getElementById('img_error').innerHTML=" * Please Upload photo jpg,jpeg,png format only";
          $('#id_image').val('');
          return false;

       }

     }
     else
     {
          document.getElementById('img_error').innerHTML=" * Upload file Not More Than 100 kb";
          $('#id_image').val('');
          return false;
     }
}

$("#id_image").change(function(){
    readURL(this);
});
		</script>
<div class="inner-block">
</div>