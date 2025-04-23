<?php


error_reporting(0);
//student details from student tables//
if($student_detail){
	$ID = $student_detail[0]->ID;
	$ADMISSION_NO = $student_detail[0]->ADMISSION_NO;
	$ADMISSION_DATE = $student_detail[0]->ADMISSION_DATE;
	$STUDENT_NAME = $student_detail[0]->STUDENT_NAME;
	$CLASS_NAME = $student_detail[0]->CLASS_NAME;
	$SECTION_NAME = $student_detail[0]->SECTION_NAME;
	$CURRENT_CLASS = $student_detail[0]->CURRENT_CLASS;
	$CURRENT_SECTION = $student_detail[0]->CURRENT_SECTION;
	$ROLL_NO = $student_detail[0]->ROLL_NO;
	$GENDER = $student_detail[0]->GENDER;
	$DATE_OF_BIRTH = $student_detail[0]->DATE_OF_BIRTH;
	$CATEGORY = $student_detail[0]->CATEGORY;
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
	$APRILFEE = $student_detail[0]->APRILFEE;
	$MAYFEE = $student_detail[0]->MAYFEE;
	$JUNEFEE = $student_detail[0]->JUNEFEE;
	$JULYFEE = $student_detail[0]->JULYFEE;
	$AUGUSTFEE = $student_detail[0]->AUGUSTFEE;
	$SEPTEMBERFEE = $student_detail[0]->SEPTEMBERFEE;
	$OCTOBERFEE = $student_detail[0]->OCTOBERFEE;
	$NOVEMBERFEE = $student_detail[0]->NOVEMBERFEE;
	$DECEMBERFEE = $student_detail[0]->DECEMBERFEE;
	$JANUARYFEE = $student_detail[0]->JANUARYFEE;
	$FEBRUARYFEE = $student_detail[0]->FEBRUARYFEE;
	$MARCHFEE = $student_detail[0]->MARCHFEE;
  	$LAST_SCHOOL =$student_detail[0]->LAST_SCHOOL;
  	$LSCH_ADD = $student_detail[0]->LSCH_ADD;
  	$STUDENT_IMAGE = $student_detail[0]->STUDENT_IMAGE;
	$PEN = $student_detail[0]->PEN;
	
	$adm = $CLASS_NAME."-".$SECTION_NAME;
	$curadm = $CURRENT_CLASS." - ".$CURRENT_SECTION;
	$science_subject = $SCIENCE_FEE." SUBJECT";
	
	if($GENDER == 1)
	{
		$sex="MALE";
	}
	else
	{
		$sex="FEMALE";
	}

}
//parent details from parents tables//]
if($father_detail){
	$ED_QUA = $father_detail[0]->ED_QUA;
	$OCCUPATION = $father_detail[0]->OCCUPATION;
	$DESIG = $father_detail[0]->DESIG;
	$MTH_INCOME = $father_detail[0]->MTH_INCOME;
	$ADDRESS = $father_detail[0]->ADDRESS;
	$CITY = $father_detail[0]->CITY;
	$STATE = $father_detail[0]->STATE;
	$NATION = $father_detail[0]->NATION;
	$PIN = $father_detail[0]->PIN;
	$PHONE1 = $father_detail[0]->PHONE1;
	$PHONE2 = $father_detail[0]->PHONE2;
	$FAXNO = $father_detail[0]->FAXNO;
	$MOBILE = $father_detail[0]->MOBILE;
	$EMAIL = $father_detail[0]->EMAIL;
}
//getting data from parents details for mother//
if($mother_detail){
	$MED_QUA     = $mother_detail[0]->ED_QUA;
	$MOCCUPATION = $mother_detail[0]->OCCUPATION;
	$MDESIG      = $mother_detail[0]->DESIG;
	$MMTH_INCOME = $mother_detail[0]->MTH_INCOME;
	$MADDRESS    = $mother_detail[0]->ADDRESS;
	$MCITY       = $mother_detail[0]->CITY;
	$MSTATE      = $mother_detail[0]->STATE;
	$MNATION     = $mother_detail[0]->NATION;
	$MPIN        = $mother_detail[0]->PIN;
	$MPHONE1     = $mother_detail[0]->PHONE1;
	$MPHONE2     = $mother_detail[0]->PHONE2;
	$MFAXNO      = $mother_detail[0]->FAXNO;
	$MMOBILE     = $mother_detail[0]->MOBILE;
	$MEMAIL      = $mother_detail[0]->EMAIL;
}
//getting data from the childhist table from the data base//
if($sibling_details){
	$Name1 =$sibling_details[0]->Name1;
	$DOB1  =$sibling_details[0]->DOB1;
	$Sex1  =$sibling_details[0]->Sex1;
	$Adm1  =$sibling_details[0]->Adm1;
	$Name2 =$sibling_details[0]->Name2;
	$DOB2  =$sibling_details[0]->DOB2;
	$Sex2  =$sibling_details[0]->Sex2;
	$Adm2  =$sibling_details[0]->Adm2;
	$Name3 =$sibling_details[0]->Name3;
	$DOB3  =$sibling_details[0]->DOB3;
	$Sex3  =$sibling_details[0]->Sex3;
	$Adm3  =$sibling_details[0]->Adm3;
	$Name4 =$sibling_details[0]->Name4;
	$DOB4  =$sibling_details[0]->DOB4;
	$Sex4  =$sibling_details[0]->Sex4;
	$Adm4  =$sibling_details[0]->Adm4;
}
?>
<style type="text/css">
  body{
   font-family: Verdana,Geneva,sans-serif; 
  }
  .t{
	  background-color:#b6b6c5;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Student Details</a> <i class="fa fa-angle-right"></i></li>
</ol>
<form method="post" action="<?php echo base_url('Student_details/update_fee_details'); ?>" id="form" onsubmit="return validation()">          
<!--four-grids here-->
		<div style="padding: 10px; background-color: white">
			<div class="row">
				<div class="col-md-7">
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
          <!--<center><a href="<?php //echo base_url('Student_details/update_student_details/'.$ID); ?>" class="btn btn-success">Modify Details</a></center>-->
          <td><i title="Recall Student" style='cursor: pointer; color:black; font-size: 20px;' onclick="recall('<?php echo $ID; ?>','<?php echo $ADMISSION_NO; ?>')" class="fa fa-reply" aria-hidden="true"></i><h4 style="display: inline;font-size: 25px; margin-top: 45px; margin-left :20px"><b >RECALL</b></h4></td>
        </div>
		<div class="col-md-2">
          <!--<center><p class="btn btn-danger" onclick="deletestudent()">Delete Student</p></center>-->
			 <center><a href="<?php echo base_url('userauth/check_auth/delete_student/' . $ID); ?>" class="btn btn-danger">Delete Student</a></center>
        </div>
        <div class='col-sm-1'>    
      <a href="<?php echo base_url('Disabledstudent/index'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br />
        </div><br />
        </div>
		 <div class="row" id="row">
            <div class="col">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist" id="ul">
                        <li class="nav-item active" id="li">
                            <a class="nav-link " data-toggle="tab" href="#tab1" role="tab">Student Details</a>
                                 <!-- active class is an attribute of the <a> element! -->
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
                            <a class="nav-link" data-toggle="tab" href="#tab6" role="tab">Fee Details</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab7" role="tab">Fee Paid Ledger</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab8" role="tab">Student Ledger</a>
                            
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
                                  <img class="img-thumbnail" style="border:1.5px solid #09b1cc;" src="<?php echo base_url($STUDENT_IMAGE); ?>" style="height:200px; width:180px;">
                                  <?php

                                }
                                else
                                {
                                  ?>
                                  <img src="<?php echo base_url('assets/student_photo/default.jpg'); ?>" style="height: auto; width: 100%;">
                                  <?php

                                }
                              ?>
                                </div>
                                <div class="col-md-10 col-sm-10 col-lg-10">
                                         <div class="form-row">
                                            <div class="form-group col-md-4">
                                               <label>Student Id</label>
                                                   <input type="text" id="sti" name="sti" class="form-control" readonly value="<?php echo $ID; ?>">
                                            </div>                    
                                            <div class="form-group col-md-4">
                                                <label>Admission Number</label>
                                                <input type="text" name="adn" class="form-control" readonly value="<?php echo $ADMISSION_NO; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                              <label>Admission Date</label>
                                              <input type="text" name="ad" class="form-control" readonly value="<?php echo  $ADMISSION_DATE; ?>">
                                            </div>
                                         </div>
                                         <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Student Full Name</label>
                                                <input type="text" name="sfn" class="form-control" readonly value="<?php echo $STUDENT_NAME; ?>">
                                            </div>  
                                        </div>
                                </div>
                                   
                               </div>
                       <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Admission in Class-Sec</label>
                           <input type="text" class="form-control" readonly value="<?php echo $adm; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Current Class-Sec</label>
                            
                            <input type="text" class="form-control" value="<?php echo $curadm ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Roll No.</label>
                            <input type="text" readonly class="form-control" value="<?php echo $ROLL_NO; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Gender</label>
                            <input type="text" class="form-control" value="<?php echo $sex; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Date of Birth</label>
                          <input type="text" class="form-control" value="<?php echo $DATE_OF_BIRTH; ?>" readonly>
                          
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Category</label>
                            <input type="text" class="form-control" value="<?php echo $CATEGORY; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>House</label>
                             <input type="text" class="form-control" value="<?php echo $HOUSE_NAME; ?>" readonly>     
                        </div>
						<div class="form-group col-md-4">
                            <label>PEN</label>
                             <input type="text" class="form-control" value="<?php echo $PEN; ?>" readonly>     
                        </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Ward Type</label>
                        <input type="text" class="form-control" value="<?php echo $EMPLOYEE_WARD; ?>" readonly>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Bus Stoppage</label>
                        <input type="text" class="form-control" value="<?php echo $BUSSTOPAGE; ?>" readonly> 
                      </div>
                      <div class="form-group col-md-4">
                        <label>Bus No.</label>
                        <input type="text" class="form-control" value="" readonly>
                      </div> 
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Blood Group</label>
                        <input type="text" class="form-control" value="<?php echo $BLOOD_GROUP; ?>" readonly>
                      </div>
                       <div class="form-group col-md-4">
                        <label>Account No</label>
                        <input type="text" class="form-control" value="<?php echo $ACCOUNT_NUMBER; ?>" readonly>
                      </div>
                       <div class="form-group col-md-4">
                        <label>Aadhaar No</label>
                        <input type="text" class="form-control" value="<?php echo $AADHAR_NUMBER; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Religion</label>
                        <input type="text" class="form-control" value="<?php echo $RELIGION; ?>" readonly>  
                      </div>
                      <div class="form-group col-md-4">
                        <label>Science Fee</label>
                        <input type="text" class="form-control" value="<?php echo $science_subject; ?>" readonly>
                      </div>
					  <div class="form-group col-md-4">
                                <label>MUSIC</label>
                                <input type="radio" name="radio5" value="1" <?php if ($MUSIC_STATUS == 1) {
                                                                                echo "checked";
                                                                            } ?>>Yes
                                <input type="radio" name="radio5" value="0" <?php if ($MUSIC_STATUS == 0) {
                                                                                echo "checked";
                                                                            } ?>>No
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Hostel</label>
                        <input type="radio" name="radio1" value="1" <?php if($HOSTEL_STATUS == 1) { echo "checked";} ?>>Yes
                        <input type="radio" name="radio1" value="0" <?php if($HOSTEL_STATUS == 0) { echo "checked";} ?>>No
                      </div>
                      <div class="form-group col-md-4">
                        <label>Computer</label>
                        <input type="radio" name="radio2" value="1" <?php if($COUMPUTER_STATUS ==1) {echo "checked";} ?>>Yes
                        <input type="radio" name="radio2" value="0" <?php if($COUMPUTER_STATUS ==0) {echo "checked";} ?>>No
                      </div>
                      <div class="form-group col-md-4">
                        <label>Freeship</label>
                        <input type="radio" name="radio3" value="1" <?php if($FREESHIP_STATUS == 1) {echo "checked";} ?>>Yes
                        <input type="radio" name="radio3" value="0" <?php if($FREESHIP_STATUS == 0) {echo "checked";} ?>>No<br>
                        <input type="text" name="freeship" id="freeship" readonly value="<?php echo $FREESHIP_MONTH; ?>">
                      </div>
					</div>
					<div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Handicap</label>
                        <input type="radio" name="radio4" value="1"<?php if($HANDICAP == 1) {echo "checked";} ?>>Yes
                        <input type="radio" name="radio4" value="0"<?php if($HANDICAP == 0) {echo "checked";} ?>>No<br>
                        <input type="text" name="handicap" class="form-control" value="<?php echo $HANDICAP_NATURE; ?>" readonly>    
                      </div>
					 </div>
                      <hr style="border: .5px solid black;">
                      <div class="row">
                        <div class="col-md-12">
                          Last School Details
                        </div>
                      </div><br><br>
                      <div class="row">
                        <div class="col-md-6">
						<div class="form-group">
							 <label>School Name</label>
							 <input type="text" name="sn" id="sn" class="form-control" value="<?php echo $LAST_SCHOOL; ?>" readonly>
						</div>
                        </div>
                        <div class="col-md-6">
						<div class="form-group">
							<label>School Address</label>
                          <input type="text" name="sa" id="sa" class="form-control" value="<?php echo $LSCH_ADD; ?>" readonly>
						</div> 
                        </div>
                      </div>            
                  </div>
              </div>
            <div class="tab-pane" id="tab2">
             <br>
             <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Parent's Details</i></b></h2>
             <br>
             <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <h3 class="text-center text-info">Father's Details</h3>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" value="<?php echo $FATHERNAME; ?>" readonly>    
                    </div>
                    <div class="form-group">
                        <label>Educational Qualification</label>
                        <input type="text" class="form-control" readonly value="<?php echo $ED_QUA; ?>">  
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" class="form-control" readonly value="<?php echo $OCCUPATION; ?>">  
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" readonly value="<?php echo $DESIG; ?>">   
                    </div>
                    <div class="form-group">
                        <label>Monthly Income</label>
                        <input type="text" class="form-control" readonly value="<?php echo $MTH_INCOME; ?>">
                    </div>
                    <div class="form-group">
                        <label>Mobile No.</label>
                        <input type="text" class="form-control" readonly value="<?php echo $MOBILE; ?>">   
                    </div>
                    <div class="form-group">
                        <label>Address</label><br>
                       <input type="text" class="form-control" readonly value="<?php echo $ADDRESS; ?>">   
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" readonly value="<?php echo $CITY; ?>">
                    </div>
                    <div class="form-group">
                        <label>PinCode</label>
                        <input type="text" class="form-control" readonly value="<?php echo $PIN; ?>">
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" readonly value="<?php echo $STATE; ?>">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <h3 class="text-center text-info">Mother's Details</h3>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" readonly value="<?php echo $MOTHERNAME; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>Educational Qualification</label>
                        <input type="text" class="form-control" readonly value="<?php echo $MED_QUA; ?>">
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" class="form-control" readonly value="<?php echo $MOCCUPATION; ?>">
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" readonly value="<?php echo $MDESIG; ?>">
                    </div>
                    <div class="form-group">
                        <label>Monthly Income</label>
                        <input type="text" class="form-control" readonly value="<?php echo $MMTH_INCOME; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>Mobile No.</label>
                        <input type="text"class="form-control" readonly value="<?php echo $MMOBILE; ?>">
                    </div>
                    <div class="form-group">
                        <label>Address</label><br>
                        <input type="text" class="form-control" readonly value="<?php echo $MADDRESS; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" readonly value="<?php echo $MCITY; ?>">
                    </div>
                    <div class="form-group">
                        <label>PinCode</label>
                        <input type="text" class="form-control" readonly value="<?php echo $MPIN; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" readonly value="<?php echo $MSTATE; ?>">
                    </div>
                </div>  
             </div>                   
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
                            <input type="text" class="form-control" readonly value="<?php echo $CROSSADD; ?>">
                        </div> 
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" readonly value="<?php echo $CROSSCITY; ?>" >
                        </div>
                        <div class="form-group">
                            <label>PinCode</label>
                            <input type="text" class="form-control" readonly value="<?php echo $CROSSPIN; ?>">
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" readonly value="<?php echo $CROSSSTATE; ?>">
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" readonly value="<?php echo $CROSSNATION; ?>">
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input type="text" class="form-control" readonly value="<?php echo $CROSSMOBILE; ?>">
                        </div>
                        <div class="form-group">
                            <label>Phone No.</label>
                            <input type="text" class="form-control" readonly value="<?php echo $CROSSPHONE1; ?>">
                            
                        </div>
                        <div class="form-group">
                            <label>Phone No 2</label>
                            <input type="text" class="form-control" readonly value="<?php echo $CROSSPHONE2; ?>">
                            
                        </div>
                        <div class="form-group">
                            <label>Fax No.</label>
                            <input type="text" class="form-control" readonly value="<?php echo $CROSSFAX; ?>">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" class="form-control" readonly value="<?php echo $CROSSEMAIL; ?>">
                        </div>
                       <!-- <input type="checkbox" name="address" id="address"><span>Checked If Address Same</span>-->    
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3 class="text-info text-center">Permanent Address</h3>
                        <div class="form-group">
                            <label>Address</label><br>
                            <input class="form-control" readonly value="<?php echo $PERADD; ?>">
                        </div> 
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" readonly value="<?php echo $PERCITY; ?>">
                        </div>
                        <div class="form-group">
                            <label>PinCode</label>
                            <input type="text" class="form-control" value="<?php echo $PERPIN; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" value="<?php echo $PERSTATE; ?>" readonly> 
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" value="<?php echo $PERNATION; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input type="text" class="form-control" value="<?php echo $PERMOBILE; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Phone No.</label>
                            <input type="text" class="form-control" value="<?php echo $PERPHONE1; ?>" readonly>
                            
                        </div>
                        <div class="form-group">
                            <label>Phone No 2</label>
                            <input type="text" class="form-control" value="<?php echo $PERPHONE2; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Fax No.</label>
                            <input type="text" class="form-control" value="<?php echo $PERFAX; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" class="form-control" value="<?php echo $PEREMAIL; ?>" readonly>
                            
                        </div>
                    </div>           
                </div>
            </div>
            <div class="tab-pane" id="tab4">
                <br>
            <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Sibling Details</i></b></h2>
             <br>

             <div class="row">
                 <div class="col-sm-6 col-md-6 col-lg-6"><br>
                    <h4 class="text-center text-info">First Sibling Details</h4>
                    <div class="form-group">
                        <label>Sibling Name</label>
                        <input type="text" class="form-control" readonly value="<?php echo $Name1; ?>">
                    </div>
                    <div class="form-group">
                        <label>Sex</label>
                        <input type="text" class="form-control" readonly value="<?php echo $Sex1; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="text"class="form-control" readonly value="<?php echo date('d-M-Y',strtotime($DOB1)); ?>">
                    </div>
                    <div class="form-group">
                        <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" class="form-control" readonly value="<?php echo $Adm1; ?>">
                        
                    </div>
                 </div>
                 <br>
                 <div class="col-sm-6 col-md-6 col-lg-6">
                    <h4 class="text-center text-info">Second Sibling Details</h4>
                    <div class="form-group">
                        <label>Sibling Name</label>
                        <input type="text" class="form-control" readonly value="<?php echo $Name2; ?>">
                    </div>
                    <div class="form-group">
                        <label>Sex</label>
                        <input type="text" class="form-control" readonly value="<?php echo $Sex2; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="text" class="form-control" readonly value="<?php echo date('d-M-Y',strtotime($DOB2)); ?>">
                    </div>
                    <div class="form-group">
                    <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" class="form-control" readonly value="<?php echo $Adm2; ?>">  
                    </div>
                        
                    
                 </div>
             </div>
             <div class="row">
                 <div class="col-sm-6 col-md-6 col-lg-6">
                     <h4 class="text-center text-info">Third Sibling Details</h4>
                     <div class="form-group">
                        <label>Sibling Name</label>
                        <input type="text" class="form-control" readonly value="<?php echo $Name3; ?>">
                    </div>
                    <div class="form-group">
                        <label>Sex</label>
                        <input type="text" class="form-control" readonly value="<?php echo $Sex2; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="text" class="form-control" readonly value="<?php echo date('d-M-Y',strtotime($DOB3)); ?>">
                    </div>
                    <div class="form-group">
                    <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                    <input type="text" class="form-control" readonly value="<?php echo $Adm3; ?>">
                        
                    </div>
                 
                 </div>
                 <div class="col-md-6 col-lg-6 col-sm-6"> 
                     <h4 class="text-center text-info">Fourth Sibling Details</h4>
                     <div class="form-group">
                        <label>Sibling Name</label>
                        <input type="text" class="form-control" readonly value="<?php echo $Name4; ?>">
                    </div>
                    <div class="form-group">
                        <label>Sex</label>
                       <input type="text" class="form-control"  readonly value="<?php echo $Sex2; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="text" class="form-control" readonly value="<?php echo date('d-M-Y',strtotime($DOB4)); ?>">
                    </div>
                    <div class="form-group">
                        <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" class="form-control" readonly value="<?php echo $Adm3; ?>">
                        
                    </div>
               
                 </div>
             </div>         
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
                        <input type="text" class="form-control" readonly value="<?php echo $SUBJECT1;  ?>">
                    </div>
                    <div class="form-group">
                        <label>Second Subject</label>
                        <input type="text" class="form-control" readonly value="<?php echo $SUBJECT2; ?>">
                    </div>
                    <div class="form-group">
                        <label>Third Subject</label>
                        <input type="text"class="form-control" readonly value="<?php echo $SUBJECT3; ?>">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Fourth Subject</label>
                        <input type="text" class="form-control" readonly value="<?php echo $SUBJECT4; ?>">
                    </div>
                    <div class="form-group">
                        <label>Fifth Subject</label>
                        <input type="text" class="form-control" readonly value="<?php echo $SUBJECT5; ?>">
                    </div>
                    <div class="form-group">
                        <label>Sixth Subject</label>
                        <input type="text" class="form-control" readonly value="<?php echo $SUBJECT6; ?>">
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>Board Reg No.</label>
                        <input type="text" class="form-control" disabled value="<?php echo $CBSEREGISTRATION; ?>">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6">
					<div class="form-group">
						<label>Board Roll No.</label>
						<input type="text" class="form-control" disabled value="<?php echo $CBSEROLL; ?>">
					</div>
                </div>
            </div>
            </div>
            <div class="tab-pane" id="tab6">
                <br>
            <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Fee Details</i></b></h2> 
              <br>
              <!--first quatar year-->
              <div class="pull-right">
                  <input type="checkbox" name="feedetails" id="feedetails"><span id="fee_error">Please Checked For Update Fee Detail</span>
              </div><br><br>
               <div class="pull-right ">
                    <input type="submit" name="updatefeedetails" value="Update Fee Details" class="btn btn-success">
                </div><br /><br>
              <div class="row">
                  <div class="col-md-4 col-sm-4 col-lg-4">
                      <label>April</label>
                      <input type="text" name="april" id="april" class="form-control" disabled value="<?php echo $APRILFEE; ?>">
                  </div>
                  <div class="col-md-4 col-sm-4 col-lg-4">
                      <label>May</label>
                      <input type="text" name="may" id="may" class="form-control" disabled value="<?php echo $MAYFEE;  ?>">
                  </div>
                  <div class="col-md-4 col-sm-4 col-lg-4">
                      <label>June</label>
                      <input type="text" name="june" id="june" class="form-control" disabled value="<?php echo $JUNEFEE; ?>">
                  </div>
              </div>
              <!--second quatar year-->
              <div class="row">
                  <div class="col-md-4 col-sm-4 col-lg-4">
                      <label>July</label>
                      <input type="text" name="july" id="july" class="form-control" disabled value="<?php echo $JULYFEE; ?>">
                  </div>
                  <div class="col-md-4 col-sm-4 col-lg-4">
                      <label>August</label>
                      <input type="text" name="august" id="august" class="form-control" disabled value="<?php echo $AUGUSTFEE; ?>">
                  </div>
                  <div class="col-md-4 col-sm-4 col-lg-4">
                    <label>September</label>
                    <input type="text" name="september" id="september" class="form-control" disabled value="<?php echo $SEPTEMBERFEE; ?>">
                      
                  </div>
              </div>
              <!--third quatar year-->
              <div class="row">
                  <div class="col-md-4 col-sm-4 col-lg-4">
                      <label>October</label>
                      <input type="text" name="october" id="october" class="form-control" disabled value="<?php echo $OCTOBERFEE; ?>">
                  </div>
                  <div class="col-md-4 col-sm-4 col-lg-4">
                      <label>November</label>
                      <input type="text" name="november" id="november" class="form-control" disabled value="<?php echo $NOVEMBERFEE; ?>">
                  </div>
                  <div class="col-md-4 col-sm-4 col-lg-4">
                      <label>December</label>
                      <input type="text" name="december" id="december" class="form-control" disabled value="<?php echo $DECEMBERFEE; ?>">
                  </div>
              </div>
              <!--fourth quatar year-->
              <div class="row">
                  <div class="col-md-4 col-sm-4 col-lg-4">
                    <label>January</label>
                    <input type="text" name="january" id="january" class="form-control" disabled value="<?php echo $JANUARYFEE; ?>">
                      
                  </div>
                  <div class="col-md-4 col-sm-4 col-lg-4">
                      <label>February</label>
                      <input type="text" name="february" id="february" class="form-control" disabled value="<?php echo $FEBRUARYFEE; ?>">
                  </div>
                  <div class="col-md-4 col-sm-4 col-lg-4">
                      <label>March</label>
                      <input type="text" name="march" id="march" class="form-control" disabled value="<?php echo $MARCHFEE; ?>">
                  </div>
              </div>
            </div>
            <div class="tab-pane" id="tab7">
                <br>
            <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Fee Paid Ledger</i></b></h2>
            <br>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-lg-12">
						<div style="overflow:auto;">
							<table class="table" id="example">
								<tr>
									<th>Receipt No</th>
									<th>Receipt Date</th>
									<th>Particular</th>
									<th>Total Amount</th>
								</tr>
								<?php
									foreach($arr_mrg as $key=> $value){
										?>
											<tr>
												<td class="t"><?php echo $value->RECT_NO; ?></td>
												<td class="t"><?php echo date("d-M-Y",strtotime($value->RECT_DATE)); ?></td>
												<td class="t"><?php echo $value->PERIOD; ?></td>
												<td class="t"><?php echo $value->TOTAL."/-"; ?></td>
											</tr>
										<?php
										foreach($feehead as $key1=>$value1){
											$fh = $key1+1;
											$fee = "Fee".$fh;
											if($value->$fee > 0){
												?>
													<tr>
														<td></td>
														<td></td>
														<td><?php echo $value1->FEE_HEAD.":-".$value->$fee."/-"; ?></td>
														<td></td>
													</tr>
												<?php
											}
										}
									}
								?>
							</table>
						</div>
					</div>
				</div>
           </div>
           <div class="tab-pane" id="tab8">
              <br>
              <h2 class="text-center" style="color:black; padding-top: 10px;"><b><i>Student ledger</i></b></h2> 
           </div>
           <br>
      </div>    
    </div>      
  </div>
</div><br />
</form>
        <div class="clearfix"></div>
		<script>
		$("#msg").fadeOut(8000);
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
		});
		
		$("#feedetails").click(function(){
			var val = $('#feedetails').is(':checked');
			if(val == true){
				$("#april").prop('disabled', false);
                $("#may").prop('disabled', false);
                $("#june").prop('disabled', false);
                $("#july").prop('disabled', false);
                $("#august").prop('disabled', false);
                $("#september").prop('disabled', false);
                $("#october").prop('disabled', false);
                $("#november").prop('disabled', false);
                $("#december").prop('disabled', false);
                $("#january").prop('disabled', false);
                $("#february").prop('disabled', false);
                $("#march").prop('disabled', false);
			}else{
				$("#april").prop('disabled', true);
                $("#may").prop('disabled', true);
                $("#june").prop('disabled', true);
                $("#july").prop('disabled', true);
                $("#august").prop('disabled', true);
                $("#september").prop('disabled', true);
                $("#october").prop('disabled', true);
                $("#november").prop('disabled', true);
                $("#december").prop('disabled', true);
                $("#january").prop('disabled', true);
                $("#february").prop('disabled', true);
                $("#march").prop('disabled', true);
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
		function deletestudent(){
			var id = $('#sti').val();
			var r = confirm("Are You Sure Want To Delete This Student");
						  if (r == true) {
							window.location="<?php echo base_url('Student_details/delete_student_details'); ?>"+"/"+id;
						  } else {
							  
						  }
		}

        function recall(val,adm){
		var r = confirm("Are you sure want to recall admission no. "+adm+" ?");
		  if (r == true) {
				$.ajax({
				url: "<?php echo base_url('Disabledstudent/active_student'); ?>",
				method: "POST",
				data:{val:val},
				success:function(data){
					if(data == 1){
						location.reload();
					}
				},
			});
		  }
		
	}
		</script>
		<!-- /script-for sticky-nav -->
        <!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->