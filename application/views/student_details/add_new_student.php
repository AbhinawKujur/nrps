<?php
 if($admission)
 {
    $adm_no = $admission[0]->adm_no;
    $studentid = $admission[0]->studentid;
 }
 $student_id=$studentid.$adm_no;
?>
<style>
	.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  margin: 0px auto;
  z-index:99999;
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
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Add New Student</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Student_details/Student_master'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br />
        </div><br />
		 <div class="row" id="row">
            <div class="col">
                <form method="post" action="<?php echo base_url('Student_details/add_record'); ?>" id="form" onsubmit="return validation()" enctype="multipart/form-data">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist" id="ul">
                        <li class="active">
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
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                         <div class="form-row">
                                            <div class="form-group col-md-4">
                                               <label>Student Id</label>
                                                <input type="text" name="std_id" id="std_id" class="form-control" readonly="true" value="<?php echo $student_id; ?>">
                                            </div>                    
                                            <div class="form-group col-md-4">
                                                <label>Admission Number&nbsp;<span id="adm_error" class="span">*</span></label>
                                                <input type="text" onblur="checkadm(this.value)" required name="std_adn" id="std_adn" class="form-control" placeholder="Enter Student Nubmer" autocomplete="off" value="<?php echo $adm_no; ?>" >
                                            </div>
                                            <div class="form-group col-md-4">
                                              <label>Admission Date&nbsp;<span id="adm_data" class="span">*</span></label>
                                              <input type="date" name="std_adm_date" id="std_adm_date"  class="form-control" required>
                                            </div>
                                         </div>
                                         <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Full Name&nbsp;<span id="name_error" class="span">*</span></label>
                                                <input type="text" style="text-transform:uppercase;" name="sfn" id="sfn" class="form-control" autocomplete="off" required>
                                            </div>
                                        </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>APAAR Id&nbsp;</label>
                                        <input type="text" style="text-transform:uppercase;" maxlength="12" name="aparid" id="aparid" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                </div>
                                   
                               </div>
                       <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Admission in Class<span id="admclass_error" class="span">*</span></label>
                            <select name="admclass" class="form-control" id="admclass" required>
                                <option value="">Select Class</option>
                            	<?php
                            	if($class){
                            		foreach ($class as $class_data) {
                            			?>
                            			<option value="<?php echo $class_data->Class_No; ?>"><?php echo $class_data->CLASS_NM; ?></option>
                            			<?php
                            		}
                            	}
                            	?>
                            	
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                        	<label>Section&nbsp;<span id="adm_secerror" class="span">*</span></label>
                        	<select name="admsec" class="form-control" id="admsec" required>
                                <option value="">Select Sec</option>
                        		<?php
                        		if($section){
                        			foreach ($section as $section_data) {
                        			 ?>
                        <option value="<?php echo $section_data->section_no; ?>"><?php echo $section_data->SECTION_NAME; ?></option>
                        			 <?php
                        			}
                        		} 
                        		?>
                        	</select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Current Class&nbsp;<span id="current_class_error" class="span">*</span></label>
                            <select name="curtclass" class="form-control" id="curtclass" required>
                                <option value="">Select Class</option>
                            	<?php
                            	if($class){
                            		foreach ($class as $class_data) {
                            			?>
                            			<option value="<?php echo $class_data->Class_No ?>"><?php echo $class_data->CLASS_NM ?></option>
                            			<?php
                            		}
                            	}
                            	?>	
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                        	<label>Section&nbsp; <span id="section_error" class="span">*</span></label>
                        	<select name="curtsec" class="form-control" id="curtsec" required>
                                <option value="">Select Section</option>
                        		<?php
                        		if($section){
                        			foreach ($section as $section_data) {
                        			 ?>
                        <option value="<?php echo $section_data->section_no ?>"><?php echo $section_data->SECTION_NAME ?></option>
                        			 <?php
                        			}
                        		} 
                        		?>
                        	</select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Roll No.<span id="showroll" class="span"></span></label>
                            <input type="number" min="0" class="form-control" name="roll" id="roll" autocomplete="off" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Gender<span id="showsex" class="span">*</span></label>
                            <select id="sex" name="sex" class="form-control" required>
                            	<option value="">Select Gender</option>
                            	<option value="1">Male</option>
                            	<option value="2">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label>Date of Birth<span id="showdob" class="span">*</span></label>
                          <input type="date" class="form-control" id="dob" name="dob">
                        </div>
						 <div class="form-group col-md-3">
                          <label>PEN</label>
                          <input type="text" class="form-control" id="pen" name="pen">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Category<span id="showcategory" class="span">*</span></label>
                            <select class="form-control" id="category" name="category">
                                <option value="">select category</option>
                                <?php
                                if($category){
                                    foreach($category as $category_data)
                                    {
                                        ?>
                                        <option value="<?php echo $category_data->CAT_CODE; ?>"><?php echo $category_data->CAT_ABBR; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>House</label>
                             <select class="form-control" id="house" name="house">
                                <!-- <option value="">Select House..</option> -->
                                 <?php
                                 if($house){
                                    foreach ($house as $house_data) {
                                        ?>
                                        <option value="<?php echo $house_data->HOUSENO; ?>" <?php if($house_data->HOUSENO==1) {echo "selected";} ?> ><?php echo $house_data->HOUSENAME; ?></option>
                                        <?php
                                    }
                                 }
                                 ?>
                             </select>    
                        </div>
						
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Ward Type<span id="showward" class="span">*</span></label>
                        <select class="form-control" id="ward" name="ward">
                            <option>Select Ward Type</option>
                            <?php
                            if($eward){
                                foreach ($eward as $eward_data) {
                                    ?>
                                    <option value="<?php echo $eward_data->HOUSENO; ?>"><?php echo $eward_data->HOUSENAME; ?></option>
                                    <?php
                                }
                            } 
                            ?>
                        </select>
                      </div>
					  <div class="form-group col-md-6">
                        <label>Blood Group</label>
                        <select class="form-control" id="blood_group" name="blood_group">
                            <option value="NONE">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                      </div>
                      
                    </div>
                    <div class="form-row">
                      
                      <div class="form-group col-md-6">
                        <label>Account No.</label>
                        <input type="number" class="form-control"  id="account" name="account" autocomplete="off">
                      </div>
                       <div class="form-group col-md-6">
                        <label>Aadhaar No.&nbsp;<span id="showaadhar" class="span">*</span></label>
                        <input type="number" class="form-control" value="000000000000" name="aadhar" id="aadhar" autocomplete="off" onkeypress="if(this.value.length==12) { return false;}">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Religion&nbsp;<span id="religion_error" class="span">*</span></label>
                        <select id="religion" name="religion" class="form-control">
                            <option value="">Select Religion</option>
                            <?php
                            if($religion){
                                foreach ($religion as $religion_data) {
                                    ?>
                                    <option value="<?php echo $religion_data->RNo; ?>"><?php echo $religion_data->Rname; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>  
                      </div>
                       <div class="form-group col-md-6 col-sm-6 col-lg-6">
                        <label>Handicap</label>
                        <input type="radio" name="radio4" value="1" onclick="handicapp(this.value)">Yes
                        <input type="radio" name="radio4" value="0" onclick="handicapp(this.value)" checked>No<br>
                        <input type="text" name="handicap" class="form-control" placeholder="TYPE" autocomplete="off" disabled id="ntype">    
                      </div>  
                    </div>
                    
                  <hr style="border: .5px solid black;">
                  <div class="form-row">
                  	<h4>Last School Details</h4>
                  	<div class="form-group col-md-6">
                  		<label>Last School Name</label>
                  		<input type="text" name="lsn" id="lsn" class="form-control" >
                  	</div>
                  	<div class="form-group col-md-6">
                  		<label>Last School Address</label>
                  		<input type="text" name="lsa" id="lsa" class="form-control">
                  	</div>
                  </div>
                   <hr style="border: .5px solid black;">
                   <div class="form-row">
                       <h4>Upload Image <!-- <span class="span">Max-Size 100kb</span> --></h4>
                       <div class="form-group col-md-4">
                        <input type="file" name="upload_img" id="upload_img" onchange="upload_validate(this.files[0].size,this.value.split('.').pop().toLowerCase())"><br>
                        <span class="span">Size of image should not be more than 100 KB & must be in jpeg, png, jpg, file format only.</span>
                           <!-- <p data-toggle="popover" title="Upload Instruction" data-content="Only jpeg,jpg,png image are allowed And Not More Than 100 kb" onclick="pop()" style="cursor: pointer;">Image Upload Instruction</p> -->
                       </div>
                       <div class="form-group col-md-8 text-danger">
                           <?php
                            if($this->session->flashdata('msg')){
                             echo $this->session->flashdata('msg');
                        }
                            ?>
                       </div>
                   </div>
                  <div class="row">
                      <div class="col-md-12">
                         <h4>Certificate</h4>
						 1- <input type='checkbox' name='b_certificate'> Birth Certificate<br />
						 2- <input type='checkbox' name='tc'> TC<br />
						 3- <input type='checkbox' name='rc'> Report Card<br />
						 4- <input type='checkbox' name='ac'> Aadhar Card<br />
						 5- <input type='checkbox' name='m_certificate'> Migration Certificate
                      </div>
                  </div>
				  <div class="row">
                      <div class="col-md-12">
                         <center><span id="std_error" class="span"></span></center>
                          <center><a href="#" id="btnNext" class="btn btn-success">NEXT</a></center><br>
                      </div>
                  </div>
              </div>
            <div class="tab-pane" id="tab2">
             <br>
             <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Parent Details</i></b></h2>
             <br>
             <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <h3 class="text-center text-info">Father's Details</h3>
                    <div class="form-group">
                        <label>Name&nbsp;<span id="father_error" class="span">*</span></label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" id="fathername" name="fathername"  autocomplete="off">    
                    </div>
                    <div class="form-group">
                        <label>Educational Qualification</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" id="father_qualification" name="father_qualification"  autocomplete="off">  
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" id="father_occupation" name="father_occupation"  autocomplete="off">  
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" id="father_designation" name="father_designation" autocomplete="off">   
                    </div>
                    <div class="form-group">
                        <label>Monthly Income</label>
                        <input type="Number" class="form-control" id="father_income" name="father_income" autocomplete="off" oncopy="return false;" onpaste="return false;">
                    </div>
                    <div class="form-group">
                        <label>Mobile No.</label>
                        <input type="Number" class="form-control" id="father_mobile" name="father_mobile" autocomplete="off" oncopy="return false;" onpaste="return false;" onkeypress="if(this.value.length==10){ return false;}">   
                    </div>
                    <div class="form-group">
                        <label>Address</label><br>
                       <input type="text" style="text-transform:uppercase;" class="form-control" id="father_address" name="father_address"  autocomplete="off">   
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" id="father_city" name="father_city"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>PinCode</label>
                        <input type="Number" class="form-control" id="father_pin" name="father_pin" autocomplete="off" oncopy="return false;" onpaste="return false;" onkeypress="if(this.value.length==6){ return false;}">
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control" id="father_state" name="father_state">
                                <option value="">Select State</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Orissa">Orissa</option>
                                <option value="Pondicherry">Pondicherry</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttaranchal">Uttaranchal</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="West Bengal">West Bengal</option>
                        </select>
                        <input type="hidden" name="hidden" id="hidden">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <h3 class="text-center text-info">Mother's Details</h3>
                    <div class="form-group">
                        <label>Name&nbsp;<span id="mother_error" class="span">*</span></label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="mothername" id="mothername"  autocomplete="off">
                        
                    </div>
                    <div class="form-group">
                        <label>Educational Qualification</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="medu" id="medu" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="moccupation" id="moccupation" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="mdesignation" id="mdesignation"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Monthly Income</label>
                        <input type="Number" class="form-control" name="mincome" id="mincome" autocomplete="off">
                        
                    </div>
                    <div class="form-group">
                        <label>Mobile No.</label>
                        <input type="Number"class="form-control" name="mmoblie" id="mmoblie" onkeypress="if(this.value.length==10){ return false;}">
                    </div>
                    <div class="form-group">
                        <label>Address&nbsp;&nbsp;<span class="span"><input type="checkbox" name="address" id="address" onclick="copyaddress()">Check If Same</span></label><br>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="maddress" id="maddress" autocomplete="off">
                        
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="mcity" id="mcity" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>PinCode</label>
                        <input type="Number" onkeypress="if(this.value.length==6){ return false;}" class="form-control" name="mpin" id="mpin">
                        
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control" id="mstate" name="mstate">
                                <option value="">Select State</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Orissa">Orissa</option>
                                <option value="Pondicherry">Pondicherry</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttaranchal">Uttaranchal</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="West Bengal">West Bengal</option>
                            
                        </select>
                    </div>
                </div>  
             </div>
              <div class="row">
                      <div class="col-md-12">
                         <center><span id="std_error" class="span"></span></center>
                          <center><a href="#" id="btnbackpar" class="btn btn-success">BACK</a>&nbsp;<a href="#" id="btnextpste" class="btn btn-success">NEXT</a></center><br>
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
                            <input type="text" class="form-control" id="crossaddress" name="crossaddress">
                        </div> 
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" id="crosscity" name="crosscity">
                        </div>
                        <div class="form-group">
                            <label>PinCode</label>
                            <input type="Number" class="form-control" id="crosspin" name="crosspin" onkeypress="if(this.value.length==6){return false;}" >
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <select name="crossstate" id="crossstate" class="form-control">
                                <option value="">Select State</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Orissa">Orissa</option>
                                <option value="Pondicherry">Pondicherry</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttaranchal">Uttaranchal</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="West Bengal">West Bengal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control" id="crosscountry" name="crosscountry">
                                <option value="">Select Country</option>
                                <option value="India">India</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input type="Number" class="form-control" id="crossmoblile" name="crossmoblile" onkeypress="if(this.value.length==10){ return false;}" >
                        </div>
                        <div class="form-group">
                            <label>Phone No.</label>
                            <input type="text" class="form-control" id="crossphone" name="crossphone">
                            
                        </div>
                        <div class="form-group">
                            <label>Phone No 2</label>
                            <input type="text" class="form-control" id="crossphone2" name="crossphone2">
                            
                        </div>
                        <div class="form-group">
                            <label>Fax No.</label>
                            <input type="text" class="form-control" id="crossfax" name="crossfax">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" class="form-control" id="crossemail" name="crossemail">
                        </div>
                       <!-- <input type="checkbox" name="address" id="address"><span>Checked If Address Same</span>-->    
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3 class="text-info text-center">Permanent Address</h3>
                        <div class="form-group">
                            <label>Address&nbsp;&nbsp;<span class="span"><input type="checkbox" id="getaddress" onclick="filladdress()">Check If Same</span></label><br>
                            <input class="form-control" id="peradd" name="peradd">
                        </div> 
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" id="percity" name="percity">
                        </div>
                        <div class="form-group">
                            <label>PinCode</label>
                            <input type="Number" class="form-control" id="perpin" name="perpin" onkeypress="if(this.value.length==6) {return false;} " >
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <select class="form-control" id="perstate" name="perstate">
                                <option value="">Select State</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Orissa">Orissa</option>
                                <option value="Pondicherry">Pondicherry</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttaranchal">Uttaranchal</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="West Bengal">West Bengal</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                           <select class="form-control" id="percountry" name="percountry">
                            <option value="">select country..</option>
                            <option value="India">INDIA</option>
                               
                           </select>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input type="Number" class="form-control" id="permobile" name="permobile" onkeypress="if(this.value.length==10){return false;}"  >
                        </div>
                        <div class="form-group">
                            <label>Phone No.</label>
                            <input type="text" class="form-control" id="perphone" name="perphone">
                            
                        </div>
                        <div class="form-group">
                            <label>Phone No 2</label>
                            <input type="text" class="form-control" id="perphone2" name="perphone2">
                        </div>
                        <div class="form-group">
                            <label>Fax No.</label>
                            <input type="text" class="form-control" id="perfax" name="perfax">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" class="form-control" id="peremail" name="peremail">
                            
                        </div>
                    </div>           
                </div>
                <div class="row">
				  <div class="col-md-12">
					 <center><span id="std_error" class="span"></span></center>
					  <center><a href="#" id="btnbackpar1" class="btn btn-success">BACK</a>&nbsp;<a href="#" id="btnextpste1" class="btn btn-success">NEXT</a></center><br>
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
                        <label>Name</label>
                        <input type="text" class="form-control" id="sibling1" name="sibling1" placeholder="Name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select id="sibling_gender" name ="sibling_gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male">MALE</option>
                            <option value="Female">FEMALE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date"class="form-control" id="siblingdob" name="siblingdob">
                    </div>
                    <div class="form-group">
                        <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" class="form-control" id="siblingadmission" name="siblingadmission" placeholder="Admission Number" autocomplete="off">
                        
                    </div>
                 </div>
                 <br>
                 <div class="col-sm-6 col-md-6 col-lg-6">
                    <h4 class="text-center text-info">Second Sibling Details</h4>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="sibling2" name="sibling2" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" id="second_sibling_gender" name="second_sibling_gender">
                            <option value="">Select Gender</option>
                            <option value="Male">MALE</option>
                            <option value="Female">FEMALE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" id="second_sibling_dob" name="second_sibling_dob">
                    </div>
                    <div class="form-group">
                    <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" class="form-control" id="second_sibling_adm" name="second_sibling_adm" placeholder="Admission Number">  
                    </div>
                        
                    
                 </div>
             </div>
             <div class="row">
                 <div class="col-sm-6 col-md-6 col-lg-6">
                     <h4 class="text-center text-info">Third Sibling Details</h4>
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="sibling3" name="sibling3" placeholder="Name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" id="third_sibling_gender" name="third_sibling_gender">
                            <option value="">Select Gender</option>
                            <option value="Male">MALE</option>
                            <option value="Female">FEMALE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" name="third_sibling_dob" id="third_sibling_dob">
                    </div>
                    <div class="form-group">
                    <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                    <input type="text" class="form-control" id="third_sibling_adm" name="third_sibling_adm" placeholder="Admission Number" autocomplete="off">
                        
                    </div>
                 
                 </div>
                 <div class="col-md-6 col-lg-6 col-sm-6"> 
                     <h4 class="text-center text-info">Fourth Sibling Details</h4>
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="sibling4" name="sibling4" autocomplete="off" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                       <select class="form-control" id="fourth_sibling_gender" name="fourth_sibling_gender">
                            <option value="">Select Gender</option>
                            <option value="Male">MALE</option>
                            <option value="Female">FEMALE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" name="fourth_sibling_dob" id="fourth_sibling_dob">
                    </div>
                    <div class="form-group">
                        <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" class="form-control" name="fourth_sibling_adm" id="fourth_sibling_adm" placeholder="Admission Number" autocomplete="off">
                        
                    </div>
               
                 </div>
             </div> 
            <div class="row">
				  <div class="col-md-12">
					 <center><span id="std_error" class="span"></span></center>
					  <center><a href="#" id="btnbackpar2" class="btn btn-success">BACK</a>&nbsp;<a href="#" id="btnextpste2" class="btn btn-success">NEXT</a></center><br>
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
                        <select class="form-control" id="first_subject" name="first_subject">
                            <option value="">Select Subject</option>
                            <?php
                            if($subject)
                            {
                                foreach ($subject as $subject_data) {
                                 ?>
                                 <option value="<?php echo $subject_data->SubSName; ?>"><?php echo $subject_data->SubName; ?></option>
                                 <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Second Subject</label>
                        <select class="form-control" id="second_subject" name="second_subject">
                            <option value="">Select Subject</option>
                            <?php
                            if($subject)
                            {
                                foreach ($subject as $subject_data) {
                                 ?>
                                 <option value="<?php echo $subject_data->SubSName; ?>"><?php echo $subject_data->SubName; ?></option>
                                 <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Third Subject</label>
                        <select class="form-control" id="third_subject" name="third_subject">
                            <option value="">Select Subject</option>
                            <?php
                            if($subject)
                            {
                                foreach ($subject as $subject_data) {
                                 ?>
                                 <option value="<?php echo $subject_data->SubSName; ?>"><?php echo $subject_data->SubName; ?></option>
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
                        <select class="form-control" id="fourth_subject" name="fourth_subject">
                            <option value="">Select Subject</option>
                            <?php
                            if($subject)
                            {
                                foreach ($subject as $subject_data) {
                                 ?>
                                 <option value="<?php echo $subject_data->SubSName; ?>"><?php echo $subject_data->SubName; ?></option>
                                 <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fifth Subject</label>
                        <select class="form-control" id="fifth_subject" name="fifth_subject">
                            <option value="">Select Subject</option>
                            <?php
                            if($subject)
                            {
                                foreach ($subject as $subject_data) {
                                 ?>
                                 <option value="<?php echo $subject_data->SubSName; ?>"><?php echo $subject_data->SubName; ?></option>
                                 <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sixth Subject</label>
                        <select class="form-control" id="sixth_subject" name="sixth_subject">
                            <option value="">Select Subject</option>
                            <?php
                            if($subject)
                            {
                                foreach ($subject as $subject_data) {
                                 ?>
                                 <option value="<?php echo $subject_data->SubSName; ?>"><?php echo $subject_data->SubName; ?></option>
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
                        <input type="text" class="form-control" placeholder="Enter CBSE Registration Number" id="cbse_reg" name="cbse_reg" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6">
				<div class="form-group">
                    <label>Board Roll No.</label>
                    <input type="text" class="form-control" placeholder="Enter CBSE Roll Number" id="cbse_roll" name="cbse_roll">
					</div>
                </div>
            </div>
            <div class="col-md-12">
				<center><span id="std_error" class="span"></span></center>
				<center><a href="#" id="btnbackpar3" class="btn btn-success">BACK</a>&nbsp;<a href="#" id="btnextpste3" class="btn btn-success">NEXT</a></center><br>
			</div>
            </div>
			<div class="tab-pane" id="tab6">
				<br>
				<h2 class="text-center" style="color:black;padding-top:10px"><b><i>Facility Details</i></b></h2>
				<br>
				<div class='row'>
					<div class="form-group col-md-4">
                        <span id="comp_error" class="span">*</span>
                        <label>Computer</label>
                        <input type="radio" name="radio2" id="comp_yes" value="1">Yes
                        <input type="radio" name="radio2" id="comp_no" value="0">No
                    </div>
					 <div class="form-group col-md-4">
                                <span id="music_error" class="span">*</span>
                                <label>Music</label>
                                <input type="radio" name="radio5" id="music_yes" value="1">Yes
                                <input type="radio" name="radio5" id="music_no" value="0">No
                            </div>
					<div class='form-group col-md-4'>
						<label>Hostel</label>
						<input type="radio" name="radio1" value="1">Yes
						<input type="radio" name="radio1" value="0">No
					</div>
				</div>
				<div class='row'>
					<div class="form-group col-md-6">
                        <label>Science Fee</label>
                        <select class="form-control" id="sciencefee" name="sciencefee">
                            <option value="0">Select Science Fee</option>
                            <option value="1">1 Subject</option>
                            <option value="2">2 Subject</option>
                            <option value="3">3 subject</option>
                            <option value="4">4 subject</option>  
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Free Ship</label>
                        <input type="radio" name="radio3" value="1" id="freeshipyes" onclick="freeshipyess(this.value)">Yes
                        <input type="radio" name="radio3" value="0" id="freeshipno" checked onclick="freeshipyess(this.value)">No<br>
						
						<div class='col-sm-6'>
							<select class="form-control" name="freeship" id="freeshiptype" disabled>
								<option value="APR">APR</option>
							</select>
						</div>
						<div class='col-sm-6'>
							<select class="form-control" name="freeshipType" id="freeshiptypeType" disabled>
								<option value="ARYASAMAJ-WISE">Aryasamaj Wise</option>
								<option value="SCHOOL">School</option>
							</select>
						</div>
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
                        <label>Bus Stoppage<span id="showbus" class="span">*</span></label>
                        <select id="busstopage" class="form-control" onchange="busstopagee(this.value)" name="busstopage">
						          <option value="">Select Stoppage</option>
                            <?php
                            if($stopage){
                                foreach($stopage as $stopage_data){
                                    ?>
                                    <option value="<?php echo $stopage_data->STOPNO; ?>"><?php echo $stopage_data->STOPPAGE; ?></option>
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
							<label>Applicable Month</label>
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
                        <label>Fare</label>
                        <input type="text" name="half_paid_leave" class="form-control half_paid_leave" value="<?php echo set_value('half_paid_leave'); ?>" readonly="">
                      </div>
                    </div>
				  </div>
              </div>
            </div><br>
			<div class="box box-primary" style="border-top: 3px solid #5785c3;">
              <div class="box-header with-border">
                <h3 class="box-title">Admission in mid session
                <button type="button"  data-toggle="collapse" data-target="#leave" aria-expanded="true" class="btn-xs btn-black"><i class="fa fa-plus"></i></button></h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body collapse in" aria-expanded="true" id="leave">
                  <div class="row">
					<div class='col-md-6 form-group' id='sms'>
						<span id="scums" class="span">*</span>
                        <label>Student comes under mid session</label><br>
                        <input type="radio" onclick="studentcomesundermisses(this.value)" name="midses" id="mid_ses" value="1">Yes
                        <input type="radio" onclick="studentcomesundermisses(this.value)" name="midses" id="mid_sesno" value="0">No
					</div>
					<div class='col-md-6 form-group'>
						<label>Month fee applicable from&nbsp;<span id="adm_error_from" class="span"></span></label>
						<select disabled name='admfrom' id='admfrom' class='form-control'>
						<option value=''>Select</option>
						<?php
							foreach($month as $monkey=>$monvalue){
								?>
								<option value='<?php echo $monvalue->id; ?>'><?php echo $monvalue->month_name; ?></option>
								<?php
							}
						?>
						</select>
					</div>
                  </div>
              </div>
            </div><br>
				<div class="row">
					<div class="col-sm-12">
					  <center>
						<a href="#" id="btnbackpar4" class="btn btn-success">BACK</a>&nbsp;
						<input type="submit" name="submt" value="SAVE" class="btn btn-success">
					 </center>
					</div>
				</div>
            </div>
           <br> 
        </div>
      </div>
	  <input type='hidden' name='route_id' id='route_id' value='0'>
    </form>
   </div>
 </div>
<br /><br />
<div class="clearfix"></div>
<script>
function studentcomesundermisses(val){
	if(val == 1){
		$('#adm_error_from').text('*');
		$('#admfrom').prop('disabled',false);
		$('#admfrom').prop('required',true);
	}else{
		$('#adm_error_from').text('');
		$('#admfrom').prop('disabled',true);
		$('#admfrom').prop('required',false);
	}
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
function checkadm(val){
	if(val ==""){
		Command: toastr["error"]("Admission Can't Be Empty", "Empty")

		toastr.options = {
		  "closeButton": false,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": true,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
		return false;
	}
	else{
		$.ajax({
		url: "<?php echo base_url('Student_details/checkadm'); ?>",
		type: "POST",
		data: {val:val},
		beforeSend:function(){
			$('.loader').show();
			$('body').css('opacity', '0.5');
		},
		success: function(data){
			$('.loader').hide();
			$('body').css('opacity', '1.0');
			if(data >0){
				Command: toastr["warning"]("This Admission Number Is Already Exist", "Warning")

				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": true,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut"
				}
				$('#std_adn').val("");
			}else{
				Command: toastr["success"]("Admission Number Is Accepted.", "Success")

				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": true,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut"
				}
			}
		},
	});
	}
	
}
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
   
function freeshipyess(val){
   if(val == 1){
	  $('#freeshiptype').prop('disabled', false);
	  $('#freeshiptypeType').prop('disabled', false);
   }else{
	  $('#freeshiptype').prop('disabled', true); 
	  $('#freeshiptypeType').prop('disabled', true); 
   }
}
function handicapp(getdata){
if(getdata == 1)
{
	$('#ntype').prop('disabled',false)
}
else{
	$('#ntype').prop('disabled',true);
}
}

function copyaddress(){
if($('#address').is(':checked'))
{
			var add=$('#father_address').val();
			var city=$('#father_city').val();
			var pin=$('#father_pin').val();
			var state=$('#father_state').find(':selected').val();
			
			$("#maddress").val(add);
			$("#mcity").val(city);
			$("#mpin").val(pin);
			$("#mstate").val(state);
}
else
{
		var blank=$('#hidden').val();

		$("#maddress").val(blank);
		$("#mcity").val(blank);
		$("#mpin").val(blank);
	   $('#mstate option[value=""]').prop('selected',true);

}

}
function filladdress(){
if($('#getaddress').is(':checked'))
{
	var crossaddress = $('#crossaddress').val();
	var crosscity = $('#crosscity').val();
	var crosspin = $('#crosspin').val();
	var crossstate = $('#crossstate').find(':selected').val();
	var crosscountry = $('#crosscountry').find(':selected').val();
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
	$('#perstate option[value=""]').prop('selected',true);
	$('#percountry option[value=""]').prop('selected',true);
	$('#permobile').val(blank);
	$('#perphone').val(blank);
	$('#perphone2').val(blank);
	$('#perfax').val(blank);
	$('#peremail').val(blank);
}
}

function validation()
{
	var admission_number = document.getElementById('std_adn').value;
	var admission_date = document.getElementById('std_adm_date').value;
	var first_name = document.getElementById('sfn').value;
	var admission_class = document.getElementById('admclass').selectedIndex;
	var admission_sec = document.getElementById('admsec').selectedIndex;
	var current_class = document.getElementById('curtclass').selectedIndex;
	var current_sec = document.getElementById('curtsec').selectedIndex;
	var sex = document.getElementById('sex').selectedIndex;
	var dob = document.getElementById('dob').value;
	var category = document.getElementById('category').selectedIndex;
	var ward = document.getElementById('ward').selectedIndex;
	var busstopagee = document.getElementById('busstopage').selectedIndex;
	var aadhar =document.getElementById('aadhar').value;
	var father =  document.getElementById('fathername').value;
	var mother = document.getElementById('mothername').value;
	var religion = document.getElementById('religion').selectedIndex;
	var img = document.getElementById('upload_img').value;

	var valname=/^[a-zA-Z ]{1,}$/;
	//var valroll=/^[0-9]{1,}$/;
	var valpincode=/^[0-9]{6}$/;
	var valaadhar=/^[0-9]{12}$/;
	var valparent=/^[a-zA-Z ]{1,}$/;
	var valadmno=/^[a-zA-Z0-9]{2,}$/;

	if(admission_date!='')
	{
		document.getElementById('adm_data').innerHTML="*";
	}
	else
	{
		document.getElementById('adm_data').innerHTML="* Required";
		return false;
	}
	if(valname.test(first_name)){
		document.getElementById('name_error').innerHTML="*";
	}
	else
	{
		document.getElementById('name_error').innerHTML="* Invalid Name";
		return false;
	}
	if(admission_class!="")
	{
		document.getElementById('admclass_error').innerHTML="*";
	}
	else
	{
		document.getElementById('admclass_error').innerHTML="* Required";
		return false;
	}
	if(admission_sec!="")
	{
		document.getElementById('adm_secerror').innerHTML="*";
	}
	else
	{
		document.getElementById('adm_secerror').innerHTML="* Required";
		return false;
	}
	if(current_class!="")
	{
		document.getElementById('current_class_error').innerHTML="*";
	}
	else
	{
		document.getElementById('current_class_error').innerHTML="* Required";
		return false;
	}
	if(current_sec!="")
	{
		document.getElementById('section_error').innerHTML="*";

	}
	else
	{
		document.getElementById('section_error').innerHTML="* Required";
		return false;
	}
	if(sex!='')
	{
		document.getElementById('showsex').innerHTML="*";
	}
	else
	{
		document.getElementById('showsex').innerHTML="* Please Select Gender";
		return false;
	}
	if(dob!='')
	{
		document.getElementById('showdob').innerHTML="*";
	}
	else
	{
		document.getElementById('showdob').innerHTML="* Please Select D.O.B";
		return false;
	}
	if(category!="")
	{
		document.getElementById('showcategory').innerHTML="*";
	}
	else
	{
		document.getElementById('showcategory').innerHTML="* Please Select";
		return false;
	}
	if(ward!='')
	{
		document.getElementById('showward').innerHTML="*";
	}
	else
	{
		document.getElementById('showward').innerHTML="* Please Select";
		return false;
	}
	if(valaadhar.test(aadhar))
	{
		document.getElementById('showaadhar').innerHTML="*";
	}
	else
	{
		document.getElementById('showaadhar').innerHTML="* Enter Aadhar";
		return false;
	}
	if(valparent.test(father))
	{
		document.getElementById('father_error').innerHTML="*";
	}
	else
	{
		document.getElementById('father_error').innerHTML="* Please Enter Father Name";
		return false;
	}
	if(valparent.test(mother))
	{
		document.getElementById('mother_error').innerHTML="*";
	}
	else
	{
		document.getElementById('mother_error').innerHTML="* Please Enter Mother Name";
		return false;
	}
	if(religion!='')
	{
		document.getElementById('religion_error').innerHTML="*";
	}
	else
	{
		document.getElementById('religion_error').innerHTML="* Please select";
		return false;
	}
	if(document.getElementById('comp_yes').checked || document.getElementById('comp_no').checked) {
		document.getElementById('comp_error').innerHTML="*";
	}else {
		document.getElementById('comp_error').innerHTML="* Please select";
		  $(window).scrollTop(0);
		return false;
		
	}
	if(document.getElementById('music_yes').checked || document.getElementById('music_no').checked) {
		document.getElementById('music_error').innerHTML="*";
	}else {
		document.getElementById('music_error').innerHTML="* Please select";
		  $(window).scrollTop(0);
		return false;
		
	}
	if(busstopagee!='')
	{
		document.getElementById('showbus').innerHTML="*";
	}
	else
	{
		document.getElementById('showbus').innerHTML="* Please select";
		$("#ss").scrollTop(0);
		return false;
	}
	if(document.getElementById('mid_ses').checked || document.getElementById('mid_sesno').checked) {
		document.getElementById('scums').innerHTML="*";
	}else {
		document.getElementById('scums').innerHTML="* Please select";
		  $("#sms").scrollTop(0);
		return false;
		
	}
}

$('#btnNext').click(function(){
    var admission_number = document.getElementById('std_adn').value;
    var admission_date = document.getElementById('std_adm_date').value;
    var first_name = document.getElementById('sfn').value;
    var admission_class = document.getElementById('admclass').selectedIndex;
    var admission_sec = document.getElementById('admsec').selectedIndex;
    var current_class = document.getElementById('curtclass').selectedIndex;
    var current_sec = document.getElementById('curtsec').selectedIndex;
    var roll = document.getElementById('roll').value;
    var sex = document.getElementById('sex').selectedIndex;
    var dob = document.getElementById('dob').value;
    var category = document.getElementById('category').selectedIndex;
    var ward = document.getElementById('ward').selectedIndex;
    var aadhar =document.getElementById('aadhar').value;
    var religion = document.getElementById('religion').selectedIndex;
    var img = document.getElementById('upload_img').value;
    var busstopagee = document.getElementById('busstopage').selectedIndex;
    //var admfrom = document.getElementById('admfrom').selectedIndex;
		
         var valname=/^[a-zA-Z ]{1,}$/;
        //var valroll=/^[0-9]{1,}$/;
        var valpincode=/^[0-9]{6}$/;
        var valaadhar=/^[0-9]{12}$/;
        var valadmno=/^[a-zA-Z0-9]{2,}$/;
        if(admission_number !=""){
            if(admission_date!='')
            {
                document.getElementById('adm_data').innerHTML="*";
                if(valname.test(first_name)){
                   document.getElementById('name_error').innerHTML="*";
					if(admission_class!="")
                   {
                     document.getElementById('admclass_error').innerHTML="*";
                     if(admission_sec!="")
                     {
                        document.getElementById('adm_secerror').innerHTML="*";
                        if(current_class!="")
                        {
                            document.getElementById('current_class_error').innerHTML="*";
                            if(current_sec!="")
                            {
                                document.getElementById('section_error').innerHTML="*";
                                if(sex!='')
                                {
                                    document.getElementById('showsex').innerHTML="*";
                                    if(dob!='')
                                    {
                                        document.getElementById('showdob').innerHTML="*";
                                        if(category!="")
                                        {
                                            document.getElementById('showcategory').innerHTML="*";
                                            if(ward!='')
                                            {
                                                document.getElementById('showward').innerHTML="*";
                                                        if(valaadhar.test(aadhar))
                                                            {
                                                                document.getElementById('showaadhar').innerHTML="*";
                                                            if(religion!='')
                                                            {
                                                                document.getElementById('religion_error').innerHTML="*";
                                                               
            if(img!="" || img=="")
            {
				$.ajax({
					url: "<?php echo base_url('Student_details/checkadm'); ?>",
					type: "POST",
					data: {val:admission_number},
					beforeSend:function(){
						$('.loader').show();
						$('body').css('opacity', '0.5');
					},
					success: function(data){
						$('.loader').hide();
						$('body').css('opacity', '1.0');
						if(data >0){
							Command: toastr["warning"]("This Admission Number Is Already Exist", "Warning")

							toastr.options = {
							  "closeButton": false,
							  "debug": false,
							  "newestOnTop": false,
							  "progressBar": true,
							  "positionClass": "toast-top-right",
							  "preventDuplicates": false,
							  "onclick": null,
							  "showDuration": "300",
							  "hideDuration": "1000",
							  "timeOut": "5000",
							  "extendedTimeOut": "1000",
							  "showEasing": "swing",
							  "hideEasing": "linear",
							  "showMethod": "fadeIn",
							  "hideMethod": "fadeOut"
							}
							$('#std_adn').val("");
							$('#adm_error').text('* Enter Admission No.');
						}else{
							$('.nav-tabs > .active').next('li').find('a').trigger('click');
						}
					},
				});
                

            }
            else
            {
																							document.getElementById('img_error').innerHTML=" * Please Upload Image";
            return false;

            }
                                                                 
                                                                
                                                            }
                                                            else
                                                            {
                                                                document.getElementById('religion_error').innerHTML="* Please select";
																$.scrollTo($('#religion_error'), 3000);
                                                                return false;
                                                            }
                                                            }
                                                            else
                                                            {
                                                                document.getElementById('showaadhar').innerHTML="* Enter Aadhar";
																$.scrollTo($('#showaadhar'), 3000);
                                                                return false;
                                                            }
                                                    
                                            }
                                            else
                                            {
                                                document.getElementById('showward').innerHTML="* Please Select";
												$.scrollTo($('#showward'), 3000);
                                                return false;   
                                            }
                                        }
                                        else
                                        {
                                            document.getElementById('showcategory').innerHTML="* Please Select";
											$.scrollTo($('#showcategory'), 3000);
                                            return false;

                                        }
                                    }
                                    else
                                    {
                                        document.getElementById('showdob').innerHTML="* Please Select D.O.B";
										$.scrollTo($('#showdob'), 3000);
                                        return false;        
                                    }

                                }
                                else
                                {
                                    document.getElementById('showsex').innerHTML="* Please Select Gender";
									$.scrollTo($('#showsex'), 3000);
                                    return false;

                                }
                            }
                            else
                            {
                                document.getElementById('section_error').innerHTML="* Required";
								$.scrollTo($('#section_error'), 3000);
                                return false;
                            }
                        }
                        else
                        {
                            document.getElementById('current_class_error').innerHTML="* Required";
							$.scrollTo($('#current_class_error'), 3000);
                            return false;

                        }

                     }
                     else
                     {
                        document.getElementById('adm_secerror').innerHTML="* Required";
						$.scrollTo($('#adm_secerror'), 3000);
                        return false;

                     }
                   }
                   else
                   {
                    document.getElementById('admclass_error').innerHTML="* Required";
					$.scrollTo($('#admclass_error'), 3000);
                    return false;
                   }
                }else
                {
                    document.getElementById('name_error').innerHTML="* Invalid Name";
					 $.scrollTo($('#name_error'), 3000);
                    return false;
                }
            }
            else
            {
              document.getElementById('adm_data').innerHTML="* Required";
			   $.scrollTo($('#adm_data'), 3000);
              return false;  
            }

        }else{
             

        }

        });
    
         $('#btnextpste').click(function(){

            var father =  document.getElementById('fathername').value;
            var mother = document.getElementById('mothername').value; 

            var valparent=/^[a-zA-Z ]{1,}$/;
            if(valparent.test(father) && valparent.test(mother))
            {
                document.getElementById('father_error').innerHTML="*";
               document.getElementById('mother_error').innerHTML="*";
               $('.nav-tabs > .active').next('li').find('a').trigger('click'); 
            }
            else{
               document.getElementById('father_error').innerHTML="* Please Enter Father Name";
               document.getElementById('mother_error').innerHTML="* Please Enter Mother Name";
			   $.scrollTo($('#mother_error'), 3000);
               return false; 
            }
         
         });

        $('#btnbackpar').click(function(){
			$('.nav-tabs > .active').prev('li').find('a').trigger('click');
		});

        $('#btnextpste1').click(function(){
         $('.nav-tabs > .active').next('li').find('a').trigger('click');
         });

        $('#btnbackpar1').click(function(){
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
      });

        $('#btnextpste2').click(function(){
         $('.nav-tabs > .active').next('li').find('a').trigger('click');
         });
		 
		 $('#btnextpste3').click(function(){
         $('.nav-tabs > .active').next('li').find('a').trigger('click');
         });

        $('#btnbackpar2').click(function(){
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
      });
	  
	  $('#btnbackpar3').click(function(){
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
      });


         $('#btnbackpar4').click(function(){
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
      });

         function pop(){
            $('[data-toggle="popover"]').popover();
         }

         function upload_validate(val,val1)
         {
            if(val<=102400)
            {
                document.getElementById('img_error').innerHTML="*";
            }
            else
            {
                document.getElementById('img_error').innerHTML=" * Upload file Not More Than 100 kb";
                $('#upload_img').val('');
                return false;
            }
           if(val1=='jpg' || val1=='jpeg' || val1=='png')
           {
                document.getElementById('img_error').innerHTML=" *";
           }
           else
           {
                 document.getElementById('img_error').innerHTML=" * Please Upload photo jpg,jpeg,png format only";
                $('#upload_img').val('');
                return false;
           }
         }
     
</script>		
<div class="inner-block"></div>