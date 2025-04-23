<?php
error_reporting(0);
	if($student){
		$f_name = $student[0]->FATHERNAME;
		$name = $student[0]->STUDENT_NAME;
		$ADM_NO = $student[0]->ADMISSION_NO;
		$STUDENTID = $student[0]->ID;
		$ADM_DATE = $student[0]->ADMISSION_DATE;
		$DATE_OF_BIRTH = $student[0]->DATE_OF_BIRTH;
		$ROLL_NO = $student[0]->ROLL_NO;
		$GENDER = $student[0]->GENDER;
		$CATEGORY = $student[0]->CATEGORY;
		$HOUSE_NAME = $student[0]->HOUSE_NAME;
		$EMPLOYEE_WARD = $student[0]->EMPLOYEE_WARD;
		$DISP_CLASS = $student[0]->CURRENT_CLASS;
		$DISP_SEC = $student[0]->CURRENT_SECTION;
		$current_class = $student[0]->CLASS_NAME;
		$current_sec = $student[0]->SECTION_NAME;
		$BLOOD_GROUP = $student[0]->BLOOD_GROUP;
		$BUSSTOPAGE = $student[0]->BUSSTOPAGE;
		$BUS_NUMBER = $student[0]->BUS_NUMBER;
		$AADHAR_NUMBER = $student[0]->AADHAR_NUMBER;
		$FATHERNAME = $student[0]->FATHERNAME;
		$MOTHERNAME = $student[0]->MOTHERNAME;
		$RELIGION = $student[0]->RELIGION;
		$CORR_ADD = $student[0]->CROSSADD;
		$C_CITY = $student[0]->CROSSCITY;
		$C_PIN = $student[0]->CROSSPIN;
		$C_STATE = $student[0]->CROSSSTATE;
		$C_NATION = $student[0]->CROSSNATION;
		$C_EMAIL = $student[0]->CROSSEMAIL;
		$C_FAXNO = $student[0]->CROSSFAX;
		$C_MOBILE = $student[0]->CROSSMOBILE;
		$C_PHONE1 = $student[0]->CROSSPHONE1;
		$C_PHONE2 = $student[0]->CROSSPHONE2;
		$PERM_ADD = $student[0]->PERADD;
		$P_CITY = $student[0]->PERCITY;
		$P_STATE = $student[0]->PERSTATE;
		$P_NATION = $student[0]->PERNATION;
		$P_PIN = $student[0]->PERPIN;
		$P_EMAIL = $student[0]->PEREMAIL;
		$P_FAXNO = $student[0]->PERFAX;
		$P_PHONE1 = $student[0]->PERPHONE1;
		$P_PHONE2 = $student[0]->PERPHONE2;
		$P_MOBILE = $student[0]->PERMOBILE;
		$SUBJECT1 = $student[0]->SUBJECT1;
		$SUBJECT2 = $student[0]->SUBJECT2;
		$SUBJECT3 = $student[0]->SUBJECT3;
		$SUBJECT4 = $student[0]->SUBJECT4;
		$SUBJECT5 = $student[0]->SUBJECT5;
		$SUBJECT6 = $student[0]->SUBJECT6;
		$student_image = $student[0]->STUDENT_IMAGE;
		$classec = $DISP_CLASS."/".$DISP_SEC;
		$adm_classec = $current_class."/".$current_sec;
		$date = date('d-m-y',strtotime($ADM_DATE));
		$dateofbirth = date('d-m-y',strtotime($DATE_OF_BIRTH));
	}
	if($father_details){
		$ED_QUA = $father_details->ED_QUA;
		$OCCUPATION = $father_details->OCCUPATION;
		$DESIG = $father_details->DESIG;
		$ADDRESS = $father_details->ADDRESS;
		$CITY = $father_details->CITY;
		$STATE = $father_details->STATE;
		$NATION = $father_details->NATION;
		$PIN = $father_details->PIN;
		$MOBILE = $father_details->MOBILE;
	}
	if($mother_details){
		$ED_QUA_m = $mother_details->ED_QUA;
		$OCCUPATION_m = $mother_details->OCCUPATION;
		$DESIG_m = $mother_details->DESIG;
		$ADDRESS_m = $mother_details->ADDRESS;
		$CITY_m = $mother_details->CITY;
		$STATE_m = $mother_details->STATE;
		$NATION_m = $mother_details->NATION;
		$PIN_m = $mother_details->PIN;
		$MOBILE_m = $mother_details->MOBILE;
	}
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
<style>
	/*.box-header {
    color: #444;
	background-color:#3c8cbc;
    display: block;
    padding: 10px;
    position: relative;
	}*/
	
	.p_detils{
		font-size:17px !important;
	}
	.box.box-default {
    border-top-color: #3c8cbc;
}
.vl {
  border-left: 2px solid #3c8dbc;
  height: 541px;
  position: absolute;
  left: 50%;
  margin-top: 30px;
   margin-left:  57px;
  top: 0;
}
</style> 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Student Details</a></li>
        <li class="active">Student Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Student Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
		 <div class="row">
			<div class='col-md-2 col-sm-2 col-lg-2'>
				<img class="img-thumbnail" src='<?php 
				if($student_image == null){
					echo base_url('assets/student_photo/default.jpg');
				}else{
					echo base_url($student_image);
				}
				?>' style='height:130px; width:110px; margin-left:30px;'>
			</div>
			<div class='col-md-10 col-sm-10 col-lg-10'>
				<div class='row'>
					<div class='col-md-4 '>
					<label>Name:</label>
						<p class='p_detils'><?php echo $name; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Admission No:</label>
						<p class='p_detils'><?php echo $ADM_NO; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Student Id:</label>
						<p class='p_detils'><?php echo $STUDENTID; ?></p>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-4 '>
					<label>Admission Date:</label>
						<p class='p_detils'><?php echo $date; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Admission Class/Sec:</label>
						<p class='p_detils'><?php echo $adm_classec; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Current Class/Sec:</label>
						<p class='p_detils'><?php echo $classec; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Roll No:</label>
						<p class='p_detils'><?php echo $ROLL_NO; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Date of Birth:</label>
						<p class='p_detils'><?php echo $dateofbirth; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Gender:</label>
						<p class='p_detils'><?php if($GENDER==1){echo "Male";}else{echo "Female";} ?></p>
					</div>
					<div class='col-md-4'>
					<label>Category:</label>
						<p class='p_detils'><?php echo $CATEGORY; ?></p>
					</div>
					<div class='col-md-4'>
					<label>House Name:</label>
						<p class='p_detils'><?php echo $HOUSE_NAME; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Ward Type:</label>
						<p class='p_detils'><?php echo $EMPLOYEE_WARD; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Blood Group:</label>
						<p class='p_detils'><?php echo $BLOOD_GROUP; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Stoppage:</label>
						<p class='p_detils'><?php echo $BUSSTOPAGE; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Bus No:</label>
						<p class='p_detils'><?php echo $BUS_NUMBER; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Religion:</label>
						<p class='p_detils'><?php echo $RELIGION; ?></p>
					</div>
					<div class='col-md-4'>
					<label>Aadhar No:</label>
						<p class='p_detils'><?php echo $AADHAR_NUMBER; ?></p>
					</div>
				</div>
			</div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
	  
	  	<!-- SELECT2 EXAMPLE -->
      <!--<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Subject Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
       
        <div class="box-body">
			<div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>First Subject:</label>
                        <p class='p_detils'><?php //echo $SUBJECT1;  ?></p>
                    </div>
                    <div class="form-group">
                        <label>Second Subject:</label>
                        <p class='p_detils'><?php //echo $SUBJECT2; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Third Subject:</label>
                        <p class='p_detils'><?php //echo $SUBJECT3; ?></p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Fourth Subject:</label>
                        <p class='p_detils'><?php //echo $SUBJECT4; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Fifth Subject:</label>
                        <p class='p_detils'><?php //echo $SUBJECT5; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Sixth Subject:</label>
                        <p class='p_detils'><?php //echo $SUBJECT6; ?></p>
                    </div>
                    
                </div>
            </div>
        </div>
        
      </div>-->
      <!-- /.box -->
	  
	  <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Parent Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
		 <div class='row'>
			<div class='col-md-6 col-sm-6 col-lg-6'>
				<h3 class='text-primary text-center'>Father Details</h3>
				<div class='row'>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Name:</label>
						<p class='p_detils'><?php echo $FATHERNAME; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Qualification:</label>
						<p class='p_detils'><?php echo $ED_QUA; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Occupation:</label>
						<p class='p_detils'><?php echo $OCCUPATION; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Designation:</label>
						<p class='p_detils'><?php echo $DESIG; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Address:</label>
						<p class='p_detils'><?php echo $ADDRESS; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>City:</label>
						<p class='p_detils'><?php echo $CITY; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Pin:</label>
						<p class='p_detils'><?php echo $PIN; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>State:</label>
						<p class='p_detils'><?php echo $STATE; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Nation:</label>
						<p class='p_detils'><?php echo $NATION; ?></p>
					</div>
				</div>
			</div>
			<!--<div class='col-md-1 col-sm-1 col-lg-1'>
			 <div class="vl"></div>
			</div>-->
			<div class='col-md-6 col-sm-6 col-lg-6'>
				<h3 class='text-primary text-center'>Mother Details</h3>
				<div class='col-md-12 col-sm-12 col-lg-12'>
					<label>Name:</label>
					<p class='p_detils'><?php echo $MOTHERNAME; ?></p>
				</div>
				<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Qualification:</label>
						<p class='p_detils'><?php echo $ED_QUA_m; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Occupation:</label>
						<p class='p_detils'><?php echo $OCCUPATION_m; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Designation:</label>
						<p class='p_detils'><?php echo $DESIG_m; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Address:</label>
						<p class='p_detils'><?php echo $ADDRESS_m; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>City:</label>
						<p class='p_detils'><?php echo $CITY_m; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Pin:</label>
						<p class='p_detils'><?php echo $PIN_m; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>State:</label>
						<p class='p_detils'><?php echo $STATE_m; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Nation:</label>
						<p class='p_detils'><?php echo $NATION_m; ?></p>
					</div>
			</div>
		 </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    	  <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Address Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
		 <div class='row'>
			<div class='col-md-6 col-sm-6 col-lg-6'>
				<h3 class='text-primary text-center'>Correspondence Address</h3>
				<div class='row'>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Address:</label>
						<p class='p_detils'><?php echo $CORR_ADD; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>City:</label>
						<p class='p_detils'><?php echo $C_CITY; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Pin-Code:</label>
						<p class='p_detils'><?php echo $C_PIN; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>State:</label>
						<p class='p_detils'><?php echo $C_STATE; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Country:</label>
						<p class='p_detils'><?php echo $C_NATION; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Mobile No:</label>
						<p class='p_detils'><?php echo $C_MOBILE; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Phone No:</label>
						<p class='p_detils'><?php echo $C_PHONE1; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Phone No 2:</label>
						<p class='p_detils'><?php echo $C_PHONE2; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Fax No:</label>
						<p class='p_detils'><?php echo $C_FAXNO; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>E-mail:</label>
						<p class='p_detils'><?php echo $C_EMAIL; ?></p>
					</div>
				</div>
			</div>
			<!--<div class='col-md-1 col-sm-1 col-lg-1'>
			 <div class="vl"></div>
			</div> -->
			<div class='col-md-6 col-sm-6 col-lg-6'>
				<h3 class='text-primary text-center'>Permanent Address</h3>
				<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Address:</label>
						<p class='p_detils'><?php echo $PERM_ADD; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>City:</label>
						<p class='p_detils'><?php echo $P_CITY; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Pin-Code:</label>
						<p class='p_detils'><?php echo $P_PIN; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>State:</label>
						<p class='p_detils'><?php echo $P_STATE; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Country:</label>
						<p class='p_detils'><?php echo $P_NATION; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Mobile No:</label>
						<p class='p_detils'><?php echo $P_MOBILE; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Phone No:</label>
						<p class='p_detils'><?php echo $PIN; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Phone No 2:</label>
						<p class='p_detils'><?php echo $P_PHONE1; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>Fax No:</label>
						<p class='p_detils'><?php echo $P_FAXNO; ?></p>
					</div>
					<div class='col-md-12 col-sm-12 col-lg-12'>
						<label>E-mail:</label>
						<p class='p_detils'><?php echo $P_EMAIL; ?></p>
					</div>
			</div>
		 </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
	  
	<!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Sibling Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
			    <div class="row">
                 <div class="col-sm-6 col-md-6 col-lg-6"><br>
                    <h4 class="text-center text-info">First Sibling Details</h4>
                    <div class="form-group">
                        <label>Sibling Name:</label>
                        <p class='p_detils'><?php echo $Name1; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Sex:</label>
                        <p class='p_detils'><?php echo $Sex1; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Date Of Birth:</label>
                        <p class='p_detils'><?php echo $DOB1; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Admission No: </label><br><span class="text-danger"> (If In The School)</span><br>
                        <p class='p_detils'><?php echo $Adm1; ?></p>
                        
                    </div>
                 </div>
                 <br>
                 <div class="col-sm-6 col-md-6 col-lg-6">
                    <h4 class="text-center text-info">Second Sibling Details</h4>
                    <div class="form-group">
                        <label>Sibling Name:</label>
                        <p class='p_detils'><?php echo $Name2; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Sex:</label>
                        <p><?php echo $Sex2; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Date Of Birth:</label>
                        <p class='p_detils'><?php echo $DOB2; ?></p>
                    </div>
                    <div class="form-group">
                    <label>Admission No: </label><br><span class="text-danger"> (If In The School)</span><br>
                        <p class='p_detils'><?php echo $Adm2; ?></p> 
                    </div>
                        
                    
                 </div>
            </div>
			<div class="row">
                 <div class="col-sm-6 col-md-6 col-lg-6">
                     <h4 class="text-center text-info">Third Sibling Details</h4>
                     <div class="form-group">
                        <label>Sibling Name:</label>
                        <p class='p_detils'><?php echo $Name3; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Sex:</label>
                        <p><?php echo $Sex2; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Date Of Birth:</label>
                        <p class='p_detils'><?php echo $DOB3; ?></p>
                    </div>
                    <div class="form-group">
                    <label>Admission No: </label><br><span class="text-danger"> (If In The School)</span><br>
                    <p class='p_detils'><?php echo $Adm3; ?></p>
                        
                    </div>
                 
                 </div>
                 <div class="col-md-6 col-lg-6 col-sm-6"> 
                     <h4 class="text-center text-info">Fourth Sibling Details</h4>
                     <div class="form-group">
                        <label>Sibling Name:</label>
                        <p class='p_detils'><?php echo $Name4; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Sex:</label>
                       <p class='p_detils'><?php echo $Sex2; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Date Of Birth:</label>
                        <p class='p_detils'><?php echo $DOB4; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Admission No: </label><br><span class="text-danger"> (If In The School)</span><br>
                        <p class='p_detils'><?php echo $Adm3; ?></p>
                        
                    </div>
               
                 </div>
             </div> 
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->