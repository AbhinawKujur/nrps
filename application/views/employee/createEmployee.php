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
          <form role="form" action="<?php echo base_url('employee/employee/createProcess'); ?>" method="post" id="myform">
            <div class="box box-primary">
              <div class="box-header with-border">
                <!-- <div class="box-tools pull-left">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div> -->
                <h3 class="box-title">Basic Information</h3><hr style="width: 100%;height: 5px;">
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                  <div class="row">
                    <div class="col-sm-2" style="display: none;">
                      
                      <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" name="emp_id" class="form-control" value="<?php echo set_value('emp_id'); ?>" id="emp_id">
                        <span class="validation_error"><?php echo form_error('emp_id'); ?></span>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Initials</label><span class="req">*</span>
                        <select class="form-control" name="initials">
                          <option value="Shri" <?php if(set_value('initials') == 'Shri'){ echo "selected";} ?>>Shri</option>
                          <option value="Smt." <?php if(set_value('initials') == 'Smt.'){ echo "selected"; } ?>>Smt.</option>
						<option value="Ms" <?php if(set_value('initials') == 'Ms'){ echo "selected"; } ?>>Ms</option>
						<option value="MD" <?php if(set_value('initials') == 'MD'){ echo "selected"; } ?>>MD</option>
                        </select>
                        <span class="validation_error"><?php echo form_error('initials'); ?></span>
                      </div>
                    </div>      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>First Name</label><span class="req">*</span>
                        <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>"  autocomplete="off">
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" value="<?php echo set_value('middle_name'); ?>"  autocomplete="off">
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Title Name</label>
                        <input type="text" name="title_name" class="form-control" value="<?php echo set_value('title_name'); ?>"  autocomplete="off">
                      </div>
                    </div>   
                             
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Father's Name</label>
                        <input type="text" name="fathers_name" class="form-control" value="<?php echo set_value('fathers_name'); ?>"  autocomplete="off">
                      </div>
                    </div> 
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Spouse Name</label>
                        <input type="text" name="guardian_name" class="form-control" value="<?php echo set_value('guardian_name'); ?>"  autocomplete="off">
                      </div>
                    </div>       
                     <div class="col-sm-3">
                      <div class="form-group">
                        <label>Gender</label><span class="req">*</span>
                        <select class="form-control" name="gender">
                          <option value="">Select Gender</option>
                          <?php foreach ($gender as $key => $value) { ?>
                            <option value="<?php echo $key; ?>" <?php if(set_value('gender')==$key){ echo "selected";} ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div> 
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Category</label><span class="req">*</span>
                        <select class="form-control" name="category">
                          <option value="">Select Category</option>
                          <option value="General">General</option>
                          <option value="OBC">OBC</option>
                          <option value="ST">ST</option>
                          <option value="SC">SC</option>
                        </select>
                      </div>
                    </div>      
                  </div>      
                  <div class="row">
                     <div class="col-sm-3">
                      <div class="form-group">
                        <label>Date of Joining</label><span class="req">*</span>
                        <input type="text" name="doj" class="form-control doj datepicker" autocomplete="off" value="<?php echo set_value('doj'); ?>" readonly="">
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Date of Birth</label><span class="req">*</span>
                        <input type="text" name="dob" class="form-control dob datepicker" autocomplete="off" value="<?php echo set_value('dob'); ?>" readonly="">
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Mobile</label><span class="req"> *</span>
                        <input type="text" name="mobile" class="form-control" autocomplete="off" value="<?php echo set_value('mobile'); ?>" maxLength="10">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" autocomplete="off" value="<?php echo set_value('email'); ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Aadhaar No</label>
                        <input type="text" name="aadhaar_no" class="form-control" autocomplete="off" value="<?php echo set_value('aadhaar_no'); ?>" maxLength="12">
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>PAN No</label>
                        <input type="text" name="pan_no" class="form-control" autocomplete="off" value="<?php echo set_value('pan_no'); ?>" maxLength="10">
                    </div>              
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Designation</label><span class="req">*</span>
                        <select class="form-control" name="designation">
                          <option value="">Select Designation</option>
                          <?php foreach ($designation as $key => $value) { ?>
                            <option value="<?php echo $value['Sno']; ?>"><?php echo $value['DESIG']; ?></option>
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
                            <option value="<?php echo $key; ?>" <?php if(set_value('employee_type')==$key){ echo "selected";} ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
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
                            <option value="<?php echo $key; ?>" <?php if(set_value('staff_type')==$key){ echo "selected";} ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Teacher Type</label><span class="req">*</span>
                        <select class="form-control" name="teacher_type" disabled="" id="teaching_type">
                          <option value="">Select Type</option>
                          <?php foreach ($teacherType as $key => $value) { ?>
                            <option value="<?php echo $key; ?>" <?php if(set_value('teacher_type')==$key){ echo "selected";} ?>><?php echo $value; ?></option>
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
                            <option value="<?php echo $value['ID']; ?>"><?php echo $value['NAME']; ?></option>
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
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>  
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Correspondence Address</label>
                        <textarea class="form-control" name="correspondence_address" id="correspondence_address"><?php echo set_value('correspondence_address'); ?></textarea>
                      </div>
                    </div>    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Permanent Address</label>
                        <textarea class="form-control" name="permanent_address" id="permanent_address"><?php echo set_value('permanent_address'); ?></textarea>
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
            <div class="box box-primary" style="border-top: 3px solid #5785c3;">
              <div class="box-header with-border">
                <h3 class="box-title">Qualification Details</h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body" id="qualification_details">   
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Basic Qualification</label><span class="req">*</span>
                        <select class="form-control select2" name="basic_qualification" style="width: 100%;">
                          <option value="">Basic Qualification</option>
                          <?php foreach ($qualification as $key => $value) { ?>
                            <option value="<?php echo $value['Sno']; ?>" <?php if(set_value('basic_qualification')==$value['Sno']){ echo "selected";} ?>><?php echo $value['qualification']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Master Qualification</label>
                        <select class="form-control select2" name="master_qualification" style="width: 100%;">
                          <option value="">Master Qualification</option>
                          <?php foreach ($qualification as $key => $value) { ?>
                            <option value="<?php echo $value['Sno']; ?>" <?php if(set_value('master_qualification')==$value['Sno']){ echo "selected";} ?>><?php echo $value['qualification']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Professional Qualification</label>
                        <select class="form-control select2" name="professional_qualification" style="width: 100%;">
                          <option value="">Professional Qualification</option>
                          <?php foreach ($qualification as $key => $value) { ?>
                            <option value="<?php echo $value['Sno']; ?>" <?php if(set_value('professional_qualification')==$value['Sno']){ echo "selected";} ?>><?php echo $value['qualification']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>    
                  </div>
              </div>
            </div><br>
            <div class="box box-primary" style="border-top: 3px solid #5785c3;">
              <div class="box-header with-border">
                <h3 class="box-title">Leave Details
                <button type="button"  data-toggle="collapse" data-target="#leave_details" class="btn-xs btn-black"><i class="fa fa-plus"></i></button></h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body collapse" id="leave_details">   
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Casual Leave</label>
                        <input type="text" name="casual_leave" class="form-control casual_leave" value="<?php echo set_value('casual_leave'); ?>" readonly="">
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Medical Leave</label>
                        <input type="text" name="medical_leave" class="form-control medical_leave" value="<?php echo set_value('medical_leave'); ?>" readonly="">
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Earned Leave</label>
                        <input type="text" name="earned_leave" class="form-control earned_leave" value="<?php echo set_value('earned_leave'); ?>" readonly="">
                      </div>
                    </div>   
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Half Paid Leave</label>
                        <input type="text" name="half_paid_leave" class="form-control half_paid_leave" value="<?php echo set_value('half_paid_leave'); ?>" readonly="">
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
              <div class="box-body" id="shift_details">   
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- checkbox -->
                      <div class="form-group">
                        <label>Contract Type</label><span class="req">*</span>
                        <div class="form-group">
                          <label>
                            <input type="radio" class="flat-red" name="contract_type" id="contract_type_roll" value="Permanent" checked="">
                             Permanent
                          </label>
                          <label>
                            <input type="radio" class="flat-red" name="contract_type" id="contract_type_contract" value="Contract">
                            Contract
                          </label>
                        </div>
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Shift</label> <span class="req">*</span>
                        <select class="form-control" name="shift" style="width: 100%;" required="">
                          <option value="">Select Shift</option>
                           <?php foreach ($shiftList as $key => $value) { ?>
                            <option value="<?php echo $value['ID']; ?>"><?php echo $value['SHIFT_NAME']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>  

                    <div class="col-sm-3" id="wing_details">
                      <div class="form-group">
                        <label>Wing</label> <span class="req">*</span>
                        <select class="form-control" name="wing" style="width: 100%;">
                          <option value="">Select Wing</option>
                           <?php foreach ($wingList as $key => $value) { ?>
                            <option value="<?php echo $value['ID']; ?>"><?php echo $value['NAME']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>  
                  </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-black pull-right">Save</button>
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

    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip(); 
    });

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

//validation
$(document).ready(function () {

    $('#myform').validate({ // initialize the plugin
        rules: {
            emp_id: {
                remote: {
                url: '<?php echo base_url('employee/employee/checkEmpID'); ?>',
                type: "post",
                data: {
                  emp_id: function() {
                    return $( "#emp_id" ).val();
                  }
                }
              },
              regex: /^[a-zA-Z0-9-,'.\s]{1,40}$/
            },
            initials: {
                required: true,
            },
            first_name: {
                required: true,
            },
            designation: {
                required: true,
            },
            role: {
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
            category: {
                required: true,
            },
            employee_type: {
                required: true,
            },
            teacher_type: {
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
                minlength: 10,
                maxlength: 10,
            },
            correspondence_address:{
              regex: /^[a-zA-Z0-9-,/'.\s]{1,40}$/
            },
            permanent_address:{
              regex: /^[a-zA-Z0-9-,'/.\s]{1,40}$/
            },
            basic_qualification: {
                required: true
            },
            mobile: {
                digits: true,
                required: true,
                minlength:10,
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
        "It accepts only  , / -  symbol"
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
</script>