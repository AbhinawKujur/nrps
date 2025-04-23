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

 </style>
 
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('pay_control/paycontrol'); ?>">Monthly Entries</a> <i class="fa fa-angle-right"></i> Create Pay Control</li>
</ol>
 <div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="row"> 
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Employee ID</label>
                        <select class="form-control select2" name="emp_id" id="emp_id" onchange="getEmpDetails()">
                          <option value="">Select Employee ID</option>
                          <?php foreach ($employeeDetails as $key => $value) { ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['EMPID']." (".$value['EMP_FNAME']." ".$value['EMP_MNAME']." ".$value['EMP_LNAME'].")"; ?></option>
                          <?php } ?>
                        </select>
                        <span class="validation_error"><?php echo form_error('emp_id'); ?></span>
                      </div>
                    </div>      
                    <div class="employee_details">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="first_name" class="form-control first_name" readonly="">
                        </div>
                      </div>  
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Middle Name</label>
                          <input type="text" name="middle_name" class="form-control middle_name" readonly="">
                        </div>
                      </div>  
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Title Name</label>
                          <input type="text" name="title_name" class="form-control title_name" readonly="">
                        </div>
                      </div>   
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Father's Name</label>
                          <input type="text" name="fathers_name" class="form-control fathers_name" readonly="">
                        </div>
                      </div>    
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Designation</label>
                          <select class="form-control designation" name="designation" disabled="">
                            <option value="">Select Designation</option>
                            <?php foreach ($designation as $key => $value) { ?>
                              <option value="<?php echo $value['Sno']; ?>"><?php echo $value['DESIG']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>    
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Date of Joining</label>
                          <input type="text" name="doj" class="form-control doj datepicker" value="<?php echo set_value('doj'); ?>" disabled="">
                        </div>
                      </div>    
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Date of Birth</label>
                          <input type="text" name="dob" class="form-control dob datepicker" value="<?php echo set_value('dob'); ?>" disabled="">
                        </div>
                      </div>    
                    </div>  
                  </div>  
              </div>
            </div>
            <br>
          
        </section>


      </div>
    </div>
  </div>
</div><br><br>
<div style="background-color: #f9f9f9;padding: 20px;border-top: 3px solid #5785c3;display: none;" class="deduction_div">
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="box box-primary">
              <strong>Deductions</strong><hr>
              <!-- /.box-header -->
            <form id="deduction_form">
              <input type="hidden" name="id" id="id">
              <div class="box-body">
                  <div class="row"> 
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>FPF</label><span class="req">*</span>
                        <input type="text" name="fpf" class="form-control fpf" autocomplete="off">
                      </div>
                    </div> 
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>VPF</label><span class="req">*</span>
                        <input type="text" name="vpf" class="form-control vpf" autocomplete="off">
                      </div>
                    </div> 
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Professional Tax</label><span class="req">*</span>
                        <input type="text" name="prof_tax" class="form-control prof_tax" autocomplete="off">
                      </div>
                    </div>  
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>LIC</label><span class="req">*</span>
                        <input type="text" name="lic" class="form-control lic" autocomplete="off" readonly="">
                      </div>
                    </div>  
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>TDS</label><span class="req">*</span>
                        <input type="text" name="tds" class="form-control tds" autocomplete="off">
                      </div>
                    </div>  
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Medical Deduction</label><span class="req">*</span>
                        <input type="text" name="medical_deduction" class="form-control medical_deduction" autocomplete="off">
                      </div>
                    </div>  
                    
                  </div>  
                  <br>
                  <div class="hra_details">
                    <strong>House Rent</strong><hr>
                    <div class="row"> 
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Rent</label><span class="req">*</span>
                          <input type="text" name="rent" class="form-control rent" autocomplete="off">
                        </div>
                      </div> 
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Electricity</label><span class="req">*</span>
                          <input type="text" name="electricity" class="form-control electricity" autocomplete="off">
                        </div>
                      </div> 
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Security</label><span class="req">*</span>
                          <input type="text" name="security" class="form-control security" autocomplete="off">
                        </div>
                      </div>  
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Garage</label><span class="req">*</span>
                          <input type="text" name="garage" class="form-control garage" autocomplete="off">
                        </div>
                      </div>  
                    </div><br>
                  </div>
              <strong>Allowance</strong><hr>
              <div class="row"> 
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Fixed Allowance</label><span class="req">*</span>
                    <input type="text" name="fixed_allow" class="form-control fixed_allow" autocomplete="off">
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Shift Allowance</label><span class="req">*</span>
                    <input type="text" name="shift_allow" class="form-control shift_allow" autocomplete="off">
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Medical Reimbursement</label><span class="req">*</span>
                    <input type="text" name="medical_reimbursement" class="form-control medical_reimbursement" autocomplete="off" value="0">
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>SH Rent</label><span class="req">*</span>
                    <input type="text" name="sh_rent" class="form-control sh_rent" autocomplete="off">
                  </div>
                </div>  
              </div> <br> 
              <strong>Arrear Salary</strong><hr>
              <div class="row"> 
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Arrear Basic</label><span class="req">*</span>
                    <input type="text" name="arrear_basic" class="form-control arrear_basic" autocomplete="off">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Arrear DA</label><span class="req">*</span>
                    <input type="text" name="arrear_da" class="form-control arrear_da" autocomplete="off">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Arrear HRA</label><span class="req">*</span>
                    <input type="text" name="arrear_hra" class="form-control arrear_hra" autocomplete="off">
                  </div>
                </div> 
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Arrear TA</label><span class="req">*</span>
                    <input type="text" name="arrear_ta" class="form-control arrear_ta" autocomplete="off">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Arrear Fixed Allowance</label><span class="req">*</span>
                    <input type="text" name="arrear_fixed_allowance" class="form-control arrear_fixed_allowance" autocomplete="off">
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Arrear Shift Allowance</label><span class="req">*</span>
                    <input type="text" name="arrear_shift_allowance" class="form-control arrear_shift_allowance" autocomplete="off">
                  </div>
                </div> 
              </div>  <br>
              <div class="advance_salary_management">
                <strong>Advance Salary Management</strong><hr>
                <div class="row"> 
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Amount</label><span class="req">*</span>
                      <input type="text" name="advance_salary_amount" class="form-control advance_salary_amount" onblur="calculateInstallAmount()" autocomplete="off" id="adv_sal_amt">
                    </div>
                  </div> 
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>No of Installment</label><span class="req">*</span>
                      <input type="text" name="no_of_installment" class="form-control no_of_installment" onblur="calculateInstallAmount()" autocomplete="off" id="no_of_install" disabled="">
                    </div>
                  </div> 
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Installment Amount</label>
                      <input type="text" name="installment_amount" class="form-control installment_amount" readonly="">
                    </div>
                  </div> 
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Date</label><span class="req">*</span>
                      <input type="text" name="advance_salary_date" class="form-control advance_salary_date datepicker" readonly="" id="adv_sal_date" disabled="">
                    </div>
                  </div> 
                </div>
              </div>
              <div class="box-footer">
                <div class="alert alert-success deduction_message" style="display: none;">
                  <p class="deduction_messages"></p>
                </div>
                <button type="button" class="btn btn-green pull-right" id="deduction_form_submit_btn"><i class="fa fa-paper-plane"></i> Save and Apply</button>
              </div>
            </div>
          </form>
            <br>
          
        </section>

        
      </div>
    </div>
  </div>
</div><br><br>

 <div style="background-color: #f9f9f9;padding: 20px;border-top: 3px solid #5785c3;display: none;" class="advance_salary_details">
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="box box-primary">              
              <strong>Advance Salary Management</strong>
              <button class="btn btn-black pull-right add_new_btn" onclick="addNewAdvanceSalAmount()"><i class="fa fa-plus"></i> Add New</button>
              <hr>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="advance_salary_master">
                  <div class="row"> 
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control previous_amount" readonly="">
                      </div>
                    </div> 
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>No of Installment</label>
                        <input type="text" class="form-control previous_no_installment" readonly="">
                      </div>
                    </div> 
                    <div class="col-sm-3"></div>
                  </div>
                </div><br>
                <table class="table table-stripped table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th style="background: #337ab7; color: white !important;">Date</th>
                      <th style="background: #337ab7; color: white !important;">Amount (<i class="fa fa-inr"></i>)</th>
                      <th style="background: #337ab7; color: white !important;">No. Of Installment</th>
                      <th style="background: #337ab7; color: white !important;">Balance (<i class="fa fa-inr"></i>)</th>
                      <th style="background: #337ab7; color: white !important;">Status</th>
                      <!-- <th style="background: #337ab7; color: white !important;">Action</th>
                      <th style="background: #337ab7; color: white !important;"></th> -->
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <br>
          
        </section>


      </div>
    </div>
  </div>
</div><br><br>

<!--modal -->
<!-- Modal -->
<div id="addNewSalary" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Advance Salary</h4>
      </div>
      <form class="form-horizontal" id="newAdvanceSalary">
        <input type="hidden" name="emp_id" id="emp_ids">
        <div class="modal-body">
          <div class="alert alert-success newAdvanceSalaryMsg" style="display: none;">
            <p class="salary_message"></p>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4 text-right">Amount:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="new_sal_amt" name="new_sal_amt" autocomplete="off" onblur="showTotalAmtBox()">
            </div>
          </div>
          <div class="form-group total_amt_div" style="display:none;">
            <label class="control-label col-sm-4 text-right">Total Amount:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="total_amt" readonly="">
              <p style="color: blue;font-weight: bold;">Apply installment on Total Amount</p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4 text-right">No of Installment:</label>
            <div class="col-sm-6">          
              <input type="text" class="form-control" id="no_of_inst" name="no_of_inst" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4 text-right">Date:</label>
            <div class="col-sm-6">          
              <input type="text" class="form-control datepicker" id="new_sal_date" name="new_sal_date" readonly="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
              <button type="button" class="btn btn-primary" id="newAdvanceSalary_submit_btn">Save and Apply</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>

<div class="loader"></div>
  <script type="text/javascript">
    $('.loader').hide();
    $('.employee_details').hide();
     //Date picker
    $('.dob').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
    });

    $('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
    });

  </script>

  <script type="text/javascript">


//validation of deduction form
$(document).ready(function () {
    $('#deduction_form').validate({ // initialize the plugin
        rules: {
            fpf: {
                regex: /^[0-9.]{1,40}$/,
                required: true
            },
            vpf: {
                regex: /^[0-9.]{1,40}$/,
                required: true
            },
            prof_tax: {
                regex: /^[0-9.]{1,40}$/,
                required: true
            },
            lic: {
                regex: /^[0-9.]{1,40}$/,
                required: true
            },
            tds: {
                regex: /^[0-9.]{1,40}$/,
                required: true
            },
            medical_deduction: {
                regex: /^[0-9.]{1,40}$/,
                required: true
            },
            rent: {
                regex: /^[0-9.]{1,40}$/,
                required: true
            },
            electricity: {
                 regex: /^[0-9.]{1,40}$/,
                required: true
            },
            security: {
                regex: /^[0-9.]{1,40}$/,
                required: true
            },
            garage: {
                 regex: /^[0-9.]{1,40}$/,
                required: true
            },
            fixed_allow:{
              regex: /^[0-9.]{1,40}$/,
              required: true
            },
            shift_allow:{
               regex: /^[0-9.]{1,40}$/,
              required: true
            },
            arrear_basic:{
               regex: /^[0-9.]{1,40}$/,
              required: true
            },
            arrear_ta:{
               regex: /^[0-9.]{1,40}$/,
              required: true
            },
            arrear_hra:{
               regex: /^[0-9.]{1,40}$/,
              required: true
            },
            arrear_da:{
               regex: /^[0-9.]{1,40}$/,
              required: true
            },
            arrear_shift_allowance:{
               regex: /^[0-9.]{1,40}$/,
              required: true
            },
            arrear_fixed_allowance:{
               regex: /^[0-9.]{1,40}$/,
              required: true
            },
            advance_salary_amount:{
               regex: /^[0-9.]{1,40}$/,
              required: true
            },
            advance_salary_date:{
              required: true
            },
            no_of_installment:{
               regex: /^[0-9.]{1,40}$/,
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


//validation of new advance salary
$(document).ready(function () {
    $('#newAdvanceSalary').validate({ // initialize the plugin
        rules: {
            new_sal_amt: {
                regexs: /^[0-9-.]{1,40}$/,
                required: true
            },
            new_sal_date: {
                required: true
            },
            no_of_inst:{
               regex: /^[0-9.]{1,40}$/,
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

//validation of regex
$.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "It accept digits and point only"
);

//validation of regex
$.validator.addMethod(
        "regexs",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "It accept digits, minus and point only"
);

//update deduction details
 $("#deduction_form_submit_btn").on("click", function(event){
  $("#deduction_form").validate();
  if ($('#deduction_form').valid())
  {
    var emp_id = $('#emp_id').val();
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('pay_control/paycontrol/updateDeduction'); ?>",
      type: "POST",
      data: $("#deduction_form").serialize(),
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.message == 1)
        {
          $('.deduction_message').removeClass("alert-danger");
          $('.deduction_message').addClass("alert-success");
          $('.deduction_message').show();
          $('.deduction_messages').html('Record Saved Successfully.');
          $('.deduction_message').hide(5000);
          $('.advance_salary_management').hide();
          $('.advance_salary_details').show();
          $('.advance_salary_amount').val('');
          getSalaryHistoryData();
          getPayControlDetails(emp_id);
          
        }
        else
        {
          $('.deduction_message').removeClass("alert-success");
          $('.deduction_message').addClass("alert-danger");
          $('.deduction_message').show(1000);
          $('.deduction_messages').html('Failed!');
          $('.deduction_message').hide(10000);
        }
      }
    });
   }
});


 //inserting data into advance_salary_history table
 //update deduction details
 $("#newAdvanceSalary_submit_btn").on("click",function(event){
  $("#newAdvanceSalary").validate();
  if ($('#newAdvanceSalary').valid())
  {
    var emp_ids = $('#emp_ids').val();
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('pay_control/paycontrol/createNewAdvanceSalary'); ?>",
      type: "POST",
      data: $("#newAdvanceSalary").serialize(),
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.message == 1)
        {
          $('.newAdvanceSalaryMsg').removeClass("alert-danger");
          $('.newAdvanceSalaryMsg').addClass("alert-success");
          $('.newAdvanceSalaryMsg').show();
          $('.salary_message').html('Record Saved Successfully.');
          $('#newAdvanceSalary')[0].reset();
          $('.salary_message').hide(2000);
          getPayControlDetails(emp_ids);
          getSalaryHistoryData();
        }
        else
        {
          $('.newAdvanceSalaryMsg').removeClass("alert-success");
          $('.newAdvanceSalaryMsg').addClass("alert-danger");
          $('.newAdvanceSalaryMsg').show();
          $('.salary_message').html('Failed!');
          $('.salary_message').hide(2000);
        }
      }
    });
   }
});


function getSalaryHistoryData()
{
  var emp_id = $('#emp_id').val();
  //fetching data from advance_salary_history
  $('#myTable').dataTable( {
        "ajax":"<?= base_url('pay_control/paycontrol/getAdvanceSalaryDetails'); ?>/"+emp_id,
        'order':[],
        "bDestroy": true,
         "ordering": false,
          dom: 'Bfrtip',
          buttons: [
              'copy', 'excel', 'pdf', 'print'
          ],
    });
}

function getEmpDetails()
{
  var emp_id = $('#emp_id').val();
  $.ajax({
      url: "<?php echo base_url('pay_control/paycontrol/getEmpDetails'); ?>",
      data: {id:emp_id},
      type: "POST",
      dataType: 'json',
      beforeSend:function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function (result) {
        $('.loader').hide();
        $('#id').val(emp_id);
        $('body').css('opacity', '1.0');
        $('.employee_details').show(1000);
        $('.first_name').val(result.EMP_FNAME);
        $('.middle_name').val(result.EMP_MNAME);
        $('.title_name').val(result.EMP_LNAME);
        $('.fathers_name').val(result.FATHERS_NAME);
        $('.designation').val(result.DESIG);
        $('.dob').val(result.D_O_B);
        $('.doj').val(result.D_O_J);
        if(result.HRA_APP == 1)
        {
          $('.hra_details').show();
        }
        else
        {
          $('.hra_details').hide();
        }

        $('.deduction_div').show(1000);
        getPayControlDetails(emp_id);
        checkAdvanceSalaryHistory(emp_id);
        getSalaryHistoryData()
      }
  });
}

function getPayControlDetails(emp_id)
{
  $.ajax({
      url: "<?php echo base_url('pay_control/paycontrol/getPayControlDetails'); ?>",
      data: {emp_id:emp_id},
      type: "POST",
      dataType: 'json',
      beforeSend:function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function (result) {
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(result == null)
        {
          $('.fpf').val('0');
          $('.vpf').val('0');
          $('.prof_tax').val('0');
          $('.lic').val('0');
          $('.rent').val('0');
          $('.electricity').val('0');
          $('.security').val('0');
          $('.garage').val('0');
          $('.tds').val('0');
          $('.medical_deduction').val('0');
          $('.sh_rent').val('0');
          $('.fixed_allow').val('0');
          $('.shift_allow').val('0');
          $('.medical_reimbursement').val('0');
          $('.arrear_basic').val('0');
          $('.arrear_da').val('0');
          $('.arrear_hra').val('0');
          $('.arrear_ta').val('0');
          $('.arrear_fixed_allowance').val('0');
          $('.arrear_shift_allowance').val('0');
        }
        else
        {
          $('.fpf').val(result.FPF);
          $('.vpf').val(result.VPF);
          $('.prof_tax').val(result.PROF_TAX);
          $('.lic').val(result.LIC);
          $('.rent').val(result.HRA_RENT);
          $('.electricity').val(result.HRA_ELECT);
          $('.security').val(result.HRA_SECURITY);
          $('.garage').val(result.HRA_GARAGE);
          $('.tds').val(result.TDS);
          $('.medical_deduction').val(result.MEDICAL_DEDUCT);
          $('.sh_rent').val(result.SH_RENT);
          $('.fixed_allow').val(result.FIXED_ALLOW);
          $('.shift_allow').val(result.SHIFT_ALLOW);
          $('.medical_reimbursement').val(result.MEDICAL_REIMBURSEMENT);
          $('.arrear_basic').val(result.ARREAR_BASIC);
          $('.arrear_da').val(result.ARREAR_DA);
          $('.arrear_hra').val(result.ARREAR_HRA);
          $('.arrear_ta').val(result.ARREAR_TA);
          $('.arrear_fixed_allowance').val(result.ARREAR_FIXED_ALLOW);
          $('.arrear_shift_allowance').val(result.ARREAR_SHIFT_ALLOW);
          $('.previous_amount').val(result.TOTAL_ADV_SAL_AMT);
          $('.previous_no_installment').val(result.NO_OF_INSTALLMENT);
        }
        $('.advance_salary_amount').val('0');
        $('.no_of_installment').val('0');
        $('.no_of_installment').val('0');
        $('.advance_salary_date').val('');
        $('.employee_details').show(1000);
        $('.deduction_div').show(1000);
      }
  });
}

function getAdvanceSalaryDetails(emp_id)
{
   $.ajax({
      url: "<?php echo base_url('pay_control/paycontrol/getAdvanceSalaryDetails'); ?>",
      data: {emp_id:emp_id},
      type: "POST",
      dataType: 'json',
      beforeSend:function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function (result) {
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        $('.advance_pay_details').html(result.htmldata);
      }
  });
}


function createNewAdvanceSalary(row_no)
{
  var emp_id = $('#emp_id').val();
  $.ajax({
      url: "<?php echo base_url('pay_control/paycontrol/createNewAdvanceSalary'); ?>",
      data: $('#newAdvanceSalary').serialize(),
      type: "POST",
      dataType: 'json',
      beforeSend:function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function (result) {
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(result.message == 1)
        {
          
        }
        else
        {
          alert("Insertion Failed");
        }
      }
  });

}

function addNewAdvanceSalAmount()
{
  $('#addNewSalary').modal({
    backdrop: 'static',
    keyboard: false
  });
  var emp_id = $('#emp_id').val();
  $('#emp_ids').val(emp_id);
}


//it checks advance salary history if it is not available then hide extra advvance salary amount details
function checkAdvanceSalaryHistory(emp_id)
{
  $.ajax({
      url: "<?php echo base_url('pay_control/paycontrol/checkAdvanceSalaryHistory'); ?>",
      data: {emp_id:emp_id},
      type: "POST",
      dataType: 'json',
      beforeSend:function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function (result) {
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(result.message == 1)
        {
          $('.advance_salary_management').hide();
          $('.advance_salary_details').show();
        }
        else
        {
          $('.advance_salary_management').show();
          $('.advance_salary_details').hide();
        }
      }
  });
}

function calculateInstallAmount()
{
  var sal_amt = $('.advance_salary_amount').val();
  var no_of_installment = $('.no_of_installment').val();
  if(sal_amt > 0)
  {
    $('#no_of_install').removeAttr("disabled");
    $('#adv_sal_date').removeAttr("disabled");

    var install_amt = Number(sal_amt/no_of_installment);
    $('.installment_amount').val(install_amt);
  }
  else if(sal_amt <= 0)
  {
    $('#no_of_install').attr("disabled","");
    $('#adv_sal_date').attr("disabled","");
    $('#no_of_install').val('0');
    $('.installment_amount').val('0');
  }
}


function showTotalAmtBox()
{
  var new_sal_amt = $('#new_sal_amt').val();
  var emp_ids = $('#emp_ids').val();

  if(new_sal_amt != '')
  {
    $.ajax({
      url: "<?php echo base_url('pay_control/paycontrol/showTotalAmtBox'); ?>",
      data: {emp_ids:emp_ids,new_sal_amt:new_sal_amt},
      type: "POST",
      dataType: 'json',
      beforeSend:function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function (result) {
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        $('.total_amt_div').show();
        $('#total_amt').val(result);
      }
  });
  }
}

$('.select2').select2();
</script>