 <style type="text/css">
   .error{
    color: red;
   }
   .box-header>.box-tools {
        position: relative;
    }
    .loader {
      position: fixed;
      top: 50%;
      left: 50%;
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
      }

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
input[type="text"]
{
  text-transform: uppercase;
}
 </style>
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Employee</li>
</ol>
 <div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <!-- Content Header (Page header) -->
        <section class="content">
          <form role="form" action="<?php echo base_url('employee/employee/updateProcess/').$singleData['id']; ?>" method="post" id="myform">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Basic Information</h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                  <div class="row">
                    <div class="col-sm-2">
                      
                      <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" name="emp_id" class="form-control" value="<?php echo set_value('emp_id',$singleData['EMPID']); ?>" id="emp_id" readonly="">
                        <span class="validation_error"><?php echo form_error('emp_id'); ?></span>
                      </div>
                    </div>    
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Initials</label><span class="req">*</span>
                        <select class="form-control" name="initials">
                          <option value="Shri" <?php if(set_value('initials',$singleData['INITIALS']) == 'Shri'){ echo "selected";} ?>>Shri</option>
                          <option value="Smt." <?php if(set_value('initials',$singleData['INITIALS']) == 'Smt.'){ echo "selected"; } ?>>Smt.</option>
							<option value="Ms" <?php if(set_value('initials',$singleData['INITIALS']) == 'Ms'){ echo "selected"; } ?>>Ms</option>
							<option value="MD" <?php if(set_value('initials',$singleData['INITIALS']) == 'MD'){ echo "selected"; } ?>>MD</option>
                        </select>
                        <span class="validation_error"><?php echo form_error('initials'); ?></span>
                      </div>
                    </div>      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>First Name</label><span class="req">*</span>
                        <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name',$singleData['EMP_FNAME']); ?>"  autocomplete="off">
                        <span class="validation_error"><?php echo form_error('first_name'); ?></span>
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" value="<?php echo set_value('middle_name',$singleData['EMP_MNAME']); ?>"  autocomplete="off">
                        <span class="validation_error"><?php echo form_error('middle_name'); ?></span>
                      </div>
                    </div>  
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Title Name</label>
                        <input type="text" name="title_name" class="form-control" value="<?php echo set_value('title_name',$singleData['EMP_LNAME']); ?>"  autocomplete="off">
                        <span class="validation_error"><?php echo form_error('title_name'); ?></span>
                      </div>
                    </div>              
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Father's Name</label>
                        <input type="text" name="fathers_name" class="form-control" value="<?php echo set_value('fathers_name',$singleData['FATHERS_NAME']); ?>"  autocomplete="off">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Spouse Name</label>
                        <input type="text" name="guardian_name" class="form-control" value="<?php echo set_value('guardian_name',$singleData['G_NAME']); ?>"  autocomplete="off">
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Gender</label><span class="req">*</span>
                        <select class="form-control" name="gender">
                          <option value="">Select Gender</option>
                          <?php foreach ($gender as $key => $value) { ?>
                            <option value="<?php echo $key; ?>" <?php if(set_value('gender',$singleData['SEX'])==$key){ echo "selected";} ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                        <span class="validation_error"><?php echo form_error('gender'); ?></span>
                      </div>
                    </div> 
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Category</label><span class="req">*</span>
                        <select class="form-control" name="category">
                          <option value="General" <?php if(set_value('category',$singleData['SEX'])=='General'){ echo "selected";} ?>>General</option>
                          <option value="OBC" <?php if(set_value('category',$singleData['CATEGORY'])=='OBC'){ echo "selected";} ?>>OBC</option>
                          <option value="ST" <?php if(set_value('category',$singleData['CATEGORY'])=='ST'){ echo "selected";} ?>>ST</option>
                          <option value="SC" <?php if(set_value('category',$singleData['CATEGORY'])=='SC'){ echo "selected";} ?>>SC</option>
                        </select>
                      </div>
                    </div>      
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Date of Joining</label><span class="req">*</span>
                        <input type="text" name="doj" class="form-control doj datepicker" autocomplete="off" value="<?php echo set_value('doj',date('d-M-Y',strtotime($singleData['D_O_J']))); ?>" readonly="">
                        <span class="validation_error"><?php echo form_error('doj'); ?></span>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Date of Birth</label><span class="req">*</span>
                        <input type="text" name="dob" class="form-control dob datepicker" autocomplete="off" value="<?php echo set_value('dob',date('d-M-Y',strtotime($singleData['D_O_B']))); ?>" readonly="">
                        <span class="validation_error"><?php echo form_error('dob'); ?></span>
                      </div>
                    </div>      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Mobile</label><span class="req"> *</span>
                        <input type="text" name="mobile" class="form-control" autocomplete="off" value="<?php echo set_value('mobile',$singleData['C_MOBILE']); ?>" maxLength="10">
                        <span class="validation_error"><?php echo form_error('mobile'); ?></span>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" autocomplete="off" value="<?php echo set_value('email',$singleData['C_EMAIL']); ?>">
                        <span class="validation_error"><?php echo form_error('email'); ?></span>
                      </div>
                    </div>
                  </div>    
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Aadhaar No</label>
                        <input type="text" name="aadhaar_no" class="form-control" autocomplete="off" value="<?php echo set_value('aadhaar_no',$singleData['AADHAARNO']); ?>" maxLength="12">
                        <span class="validation_error"><?php echo form_error('aadhaar_no'); ?></span>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>PAN No</label>
                        <input type="text" name="pan_no" class="form-control" autocomplete="off" value="<?php echo set_value('pan_no',$singleData['PAN_NUMBER']); ?>" maxLength="10">
                        <span class="validation_error"><?php echo form_error('pan_no'); ?></span>
                    </div>              
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Designation</label><span class="req">*</span>
                        <select class="form-control" name="designation">
                          <option value="">Select Designation</option>
                          <?php foreach ($designation as $key => $value) { ?>
                            <option value="<?php echo $value['Sno']; ?>" <?php if(set_value('designation',$singleData['DESIG']) == $value['Sno']){ echo "selected";} ?>><?php echo $value['DESIG']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div> 
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Employee Type</label><span class="req">*</span>
                        <select class="form-control employee_type" name="employee_type" onchange="getLeaveDays()">
                          <option value="">Select Employee Type</option>
                          <?php foreach ($employeeType as $key => $value) { ?>
                            <option value="<?php echo $key; ?>" <?php if(set_value('employee_type',$singleData['EMP_TYPE'])==$key){ echo "selected";} ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                        <span class="validation_error"><?php echo form_error('employee_type'); ?></span>
                      </div>
                    </div> 
                  </div>    
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Staff</label><span class="req">*</span>
                        <select class="form-control" name="staff_type" onchange="getTeachingType()" id="staff_type">
                          <option value="">Select Staff</option>
                          <?php foreach ($staffType as $key => $value) { ?>
                            <option value="<?php echo $key; ?>" <?php if(set_value('staff_type',$singleData['STAFF_TYPE'])==$key){ echo "selected";} ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                        <span class="validation_error"><?php echo form_error('staff_type'); ?></span>
                      </div>
                    </div>   
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Teacher Type</label><span class="req">*</span>
                        <select class="form-control" name="teacher_type" disabled="" id="teaching_type">
                          <option value="">Select Type</option>
                          <?php foreach ($teacherType as $key => $value) { ?>
                            <option value="<?php echo $key; ?>" <?php if(set_value('teacher_type',$singleData['TEACHER_TYPE'])==$key){ echo "selected";} ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>   
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Role</label><span class="req">*</span>
                        <select class="form-control" name="role" onchange="checkWing()" id="role">
                          <option value="">Select Role</option>
                          <?php foreach ($roleList as $key => $value) { ?>
                            <option value="<?php echo $value['ID']; ?>" <?php if(set_value('role',$singleData['ROLE_ID'])==$value['ID']){ echo "selected";} ?>><?php echo $value['NAME']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div> 
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Employee Level</label><span class="req">*</span>
                        <select class="form-control" name="emp_level">
                          <option value="">Select Employee Level</option>
                          <?php foreach ($empLevel as $key => $value) { ?>
                            <option value="<?php echo $key; ?>" <?php if(set_value('emp_level',$singleData['EMP_LEVEL'])==$key){ echo "selected";} ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>     
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Correspondence Address</label>
                        <textarea class="form-control" name="correspondence_address" id="correspondence_address"><?php echo set_value('correspondence_address',$singleData['C_ADD']); ?></textarea>
                        <span class="validation_error"><?php echo form_error('correspondence_address'); ?></span>
                      </div>
                    </div>    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Permanent Address</label>
                        <textarea class="form-control" name="permanent_address" id="permanent_address"><?php echo set_value('permanent_address',$singleData['P_ADD']); ?></textarea>
                        <span class="validation_error"><?php echo form_error('permanent_address'); ?></span>
                      </div>
                    </div>    
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>
                          <input type="checkbox" class="flat-red same_address" id="same_address" name="address_checkbox">
                        </label>
                        <label style="font-weight: bold;color: #175f8c;" for="same_address">Tick this checkbox if permanent address is same as correspondence address</label>
                      </div>
                    </div>       
                  </div>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Qualification Details</h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body">   
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Basic Qualification</label><span class="req">*</span>
                        <select class="form-control select2" name="basic_qualification" style="width: 100%;">
                          <option value="">Basic Qualification</option>
                          <?php foreach ($qualification as $key => $value) { ?>
                            <option value="<?php echo $value['Sno']; ?>" <?php if(set_value('basic_qualification',$singleData['QUAL'])==$value['Sno']){ echo "selected";} ?>><?php echo $value['qualification']; ?></option>
                          <?php } ?>
                        </select>
                        <span class="validation_error"><?php echo form_error('basic_qualification'); ?></span>
                      </div>
                    </div>    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Master Qualification</label>
                        <select class="form-control select2" name="master_qualification" style="width: 100%;">
                          <option value="">Master Qualification</option>
                          <?php foreach ($qualification as $key => $value) { ?>
                            <option value="<?php echo $value['Sno']; ?>" <?php if(set_value('master_qualification',$singleData['MASTERQUAL'])==$value['Sno']){ echo "selected";} ?>><?php echo $value['qualification']; ?></option>
                          <?php } ?>
                        </select>
                        <span class="validation_error"><?php echo form_error('master_qualification'); ?></span>
                      </div>
                    </div>    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Professional Qualification</label>
                        <select class="form-control select2" name="professional_qualification" style="width: 100%;">
                          <option value="">Professional Qualification</option>
                          <?php foreach ($qualification as $key => $value) { ?>
                            <option value="<?php echo $value['Sno']; ?>" <?php if(set_value('professional_qualification',$singleData['PROFQUAL'])==$value['Sno']){ echo "selected";} ?>><?php echo $value['qualification']; ?></option>
                          <?php } ?>
                        </select>
                        <span class="validation_error"><?php echo form_error('professional_qualification'); ?></span>
                      </div>
                    </div>    
                  </div>
              </div>
            </div><br>
            <div class="box box-primary" style="border-top: 3px solid #5785c3;">
              <div class="box-header with-border">
                <h3 class="box-title">Leave Details</h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body">   
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Casual Leave</label>
                        <input type="text" name="casual_leave" class="form-control casual_leave" value="<?php echo set_value('casual_leave',$singleData['CAS_LEAVE']); ?>" readonly="">
                        <span class="validation_error"><?php echo form_error('casual_leave'); ?></span>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Medical Leave</label>
                        <input type="text" name="medical_leave" class="form-control medical_leave" value="<?php echo set_value('medical_leave',$singleData['ML']); ?>" readonly="">
                        <span class="validation_error"><?php echo form_error('medical_leave'); ?></span>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Earned Leave</label>
                        <input type="text" name="earned_leave" class="form-control earned_leave" value="<?php echo set_value('earned_leave',$singleData['EL']); ?>" readonly="">
                        <span class="validation_error"><?php echo form_error('earned_leave'); ?></span>
                      </div>
                    </div>   
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Half Paid Leave</label>
                        <input type="text" name="half_paid_leave" class="form-control half_paid_leave" value="<?php echo set_value('half_paid_leave',$singleData['hpl']); ?>" readonly="">
                        <span class="validation_error"><?php echo form_error('half_paid_leave'); ?></span>
                      </div>
                    </div>    
                  </div>
              </div>
            </div><br>
            <div class="box box-primary" style="border-top: 3px solid #5785c3;">
              <div class="box-header with-border">
                <h3 class="box-title">Shift and Other Details</h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body">   
                  <div class="row">
                    <div class="col-sm-4">
                      <!-- checkbox -->
                      <div class="form-group">
                        <label>Contract Type</label><span class="req">*</span>
                        <div class="form-group">
                          <label>
                            <input type="radio" class="flat-red" name="contract_type" id="contract_type_roll" value="Permanent" checked="" <?php if(set_value('contract_type',$singleData['CONTRACT_TYPE']) == "Permanent"){ echo "checked"; }  ?>>
                             Permanent
                          </label>
                          <label>
                            <input type="radio" class="flat-red" name="contract_type" id="contract_type_contract" value="Contract" <?php if(set_value('contract_type',$singleData['CONTRACT_TYPE']) == "Contract"){ echo "checked"; }  ?>>
                            Contract
                          </label>
                        </div>
                      </div>
                    </div>  
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Shift</label><span class="req"> *</span>
                        <select class="form-control" name="shift" style="width: 100%;" required="">
                          <option value="">Select Shift</option>
                           <?php foreach ($shiftList as $key => $value) { ?>
                            <option value="<?php echo $value['ID']; ?>" <?php if(set_value('shift',$singleData['SHIFT']==$value['ID']))
                            {
                            echo "selected";
                            }?>><?php echo $value['SHIFT_NAME']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>  
                    <div class="col-sm-4" id="wing_details">
                      <div class="form-group">
                        <label>Wing</label> <span class="req">*</span>
                        <select class="form-control" name="wing" style="width: 100%;">
                          <option value="">Select Wing</option>
                           <?php foreach ($wingList as $key => $value) { ?>
                            <option value="<?php echo $value['ID']; ?>" <?php if(set_value('wing',$singleData['WING_MASTER_ID']) == $value['ID']){ echo "selected"; } ?>><?php echo $value['NAME']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>  
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Employee Status</label> <span class="req">*</span>
                        <select class="form-control" name="status" style="width: 100%;" id="seperatedStatus" onchange="getSeparationDate()">
                          <?php foreach ($statusList as $key => $value) { ?>
                            <option value="<?php echo $key; ?>" <?php if($singleData['STATUS'] == $key){ echo "selected"; } ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>  
                    <div class="col-sm-4" id="seperatedDateCol">
                      <div class="form-group">
                        <label>Date of Separation</label> <span class="req">*</span>
                        <input type="text" name="seperation_date" class="form-control datepicker" id="seperatedDate" value="<?php echo date('d-M-Y',strtotime($singleData['DATE_OF_SEPARATION'])); ?>" autocomplete="off">
                      </div>
                    </div>  
                  </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-black pull-right">Update</button>
              </div>
            </div><br>
          </form>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div><br><br>
<div class="loader"></div>
  <script type="text/javascript">
    $('.loader').hide();

       //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });

     //Date picker
    $('.doj').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
    });

     //Date picker
    $('.dob').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
    });
    
  </script>

  <script type="text/javascript">
//copy address from correspondence address to permanent address
$('#same_address').on('ifChanged', function(event){
    if(this.checked) // if changed state is "CHECKED"
    {
        var correspondence_address = $('#correspondence_address').val();
        $('#permanent_address').val(correspondence_address);
    }
    else
    {
      $('#permanent_address').val('');
    }
});

//disable contract type when one is checked
$('#contract_type_roll').on('ifChanged', function(event){
    if(this.checked) // if changed state is "CHECKED"
    {
        $('#contract_type_contract').iCheck('disable');
    }
    else
    {
        $('#contract_type_contract').iCheck('enable');
    }
});

$('#contract_type_contract').on('ifChanged', function(event){
    if(this.checked) // if changed state is "CHECKED"
    {
        $('#contract_type_roll').iCheck('disable');
    }
    else
    {
        $('#contract_type_roll').iCheck('enable');
    }
});

//disable field on yes or no option
$('.pf_applied').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $(".pf_ac_no").removeAttr("disabled"); 
      $(".pf_joining_date").removeAttr("disabled"); 
      $(".uan_no").removeAttr("disabled"); 
      $(".nominee_name").removeAttr("disabled"); 
      $(".relation").removeAttr("disabled"); 
    }
    else
    {
      $(".pf_ac_no").val('');
      $(".pf_joining_date").val('');
      $(".uan_no").val('');
      $(".nominee_name").val('');
      $(".relation").val('');
       $(".pf_ac_no").attr("disabled", "disabled"); 
       $(".pf_joining_date").attr("disabled", "disabled"); 
       $(".uan_no").attr("disabled", "disabled"); 
       $(".nominee_name").attr("disabled", "disabled"); 
       $(".relation").attr("disabled", "disabled"); 
    }
});

$('.esi_applied').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $(".esi_ac_no").removeAttr("disabled"); 
    }
    else
    {
        $(".esi_ac_no").val('');
       $(".esi_ac_no").attr("disabled", "disabled"); 
    }
});

$('.hra_applied').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $(".eps_ac_no").removeAttr("disabled"); 
    }
    else
    {
       $(".eps_ac_no").val(''); 
       $(".eps_ac_no").attr("disabled", "disabled"); 
    }
});

$('.ta_allowance_applied').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $(".ta_slab").removeAttr("disabled"); 
    }
    else
    {
       $(".ta_slab").val(''); 
       $(".ta_slab").attr("disabled", "disabled"); 
    }
});

$('.group_insurance_policy').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $(".group_insurance_policy_slab").removeAttr("disabled"); 
    }
    else
    {
       $(".group_insurance_policy_slab").val(''); 
       $(".group_insurance_policy_slab").attr("disabled", "disabled"); 
    }
});


//validation
$(document).ready(function () {

    $('#myform').validate({ // initialize the plugin
        rules: {
            initials: {
                required: true,
            },
            first_name: {
                required: true,
            },
            designation: {
                required: true,
            },
            doj: {
                required: true,
            },
            dob: {
                required: true,
            },
            gender: {
                required: true,
            },
            role: {
                required: true,
            },
            employee_type: {
                required: true,
            },
            emp_level: {
                required: true,
            },
            staff_type: {
                required: true,
            },
            aadhaar_no: {
                digits: true,
                minlength:12,
                maxlength: 12,
                regex: /^[a-zA-Z0-9]{1,40}$/
            },
            pan_no: {
                regexs: /^[a-zA-Z0-9]{1,40}$/,
                minlength:10,
                maxlength: 10,
            },
            correspondence_address:{
              regex: /^[a-zA-Z0-9-,'/.\s]{1,40}$/
            },
            permanent_address:{
              regex: /^[a-zA-Z0-9-,'/.\s]{1,40}$/
            },
            basic_qualification: {
                required: true
            },
            contract_type: {
                required: true
            },
            pf_ac_no: {
                required: true,
            },
            esi_ac_no: {
                required: true,
            },
            eps_ac_no: {
                required: true,
            },
            ta_slab: {
                required: true,
            },
            group_insurance_policy_slab: {
                required: true,
            },
            bank_ac: {
                digits: true,
            },
            quater_area: {
                digits: true,
            },
             mobile: {
                digits: true,
                required: true,
                minlength:10,
                maxlength: 10,
            },
             casual_leave: {
                digits: true
            },
             medical_leave: {
                digits: true
            },
             earned_leave: {
                digits: true
            },
            quater_rent:{
              regexs: /^[0-9.]{1,40}$/
            },
            vpf:{
              regexs: /^[0-9.]{1,40}$/
            },
            wing: {
                required: true
            },
        },
        submitHandler: function (form) { // for demo 
                     if ($(form).valid()) 
                         form.submit(); 
                     return false; // prevent normal form posting
        }
    });
});

$.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "It accepts only , / - symbol"
);

//pan number validation
$.validator.addMethod(
        "regexs",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "Please do not enter any special character"
);

getLevelYear();
function getLevelYear()
{
  var level_year_data = '<?php echo $singleData['LEVEL_YEAR']; ?>';
  var div_data = "<option value=''>Select Level Year</option>";
  var level_no = $('#level_no').val();
  $.ajax({
      url: "<?php echo base_url('employee/employee/getLevelYear'); ?>",
      data: {level_no:level_no},
      type: "POST",
      dataType: 'json',
      success: function (result) {
           $.each(result, function (key, val) {
                if(val.level_year == level_year_data)
                {
                  var sel = "";
                  sel = "selected";
                  getPay();
                }
                div_data += "<option value='"+val.level_year+"'"+sel+">"+val.level_year+"</option>";
            });
           $('#level_year').html(div_data);
      }
  });
}
function getPay()
{
  var level_no = $('#level_no').val();
  var level_year = $('#level_year').val();
  if(level_year == null)
  {
    var level_year = '<?php echo $singleData['LEVEL_YEAR']; ?>';
  }
  $.ajax({
      url: "<?php echo base_url('employee/employee/getPay'); ?>",
      data: {level_year:level_year,level_no:level_no},
      type: "POST",
      dataType: 'json',
      success: function (result) {
           $('#basic_pay').val(result.pay);
      }
  });
}

function getLeaveDays()
{
  var emp_type = $('.employee_type').val();
  $.ajax({
      url: "<?php echo base_url('employee/employee/getLeaveDays'); ?>",
      data: {emp_type:emp_type},
      type: "POST",
      dataType: 'json',
      beforeSend: function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function (result) {
            $('.loader').hide();
            $('body').css('opacity', '1.0');
           $('.casual_leave').val(result.casual.no_days);
           $('.medical_leave').val(result.medical.no_days);
           $('.earned_leave').val(result.earned.no_days);
           $('.half_paid_leave').val(result.hpl.no_days);
      }
  });
}

  $('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
    });

$('.select2').select2();

//hiding wing details when role is principal
checkWing();

function checkWing()
{
  var role = $('#role').val();
  if(role == 4)
  {
    $('#wing_details').hide();
  }
  else
  {
    $('#wing_details').show();
  }
}

//get teaching type details
function getTeachingType()
{
  var staff_type = $('#staff_type').val();
  if(staff_type == 1)
  {
    $("#teaching_type").removeAttr('disabled');
  }
  else
  {
    $("#teaching_type").attr('disabled',"");
  }
}
//separation process
getSeparationDate();
function getSeparationDate()
{
  var status = $('#seperatedStatus').val();
  if(status == 1)
  {
    $('#seperatedDate').val('');
    $('#seperatedDateCol').hide();
  }
  else
  {
    $('#seperatedDateCol').show();
  }
}
</script>