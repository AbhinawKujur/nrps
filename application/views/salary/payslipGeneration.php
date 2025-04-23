 <style type="text/css">
   .error{
    color: red;
   }
   .box-header>.box-tools {
        position: relative;
       
    }

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.thead-color{
background: #337ab7 !important; color: white !important;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    font-size: 12px;
    padding: 5px;
    white-space: nowrap;
    /*border: 1px solid #999790;*/
  }
.bottom-row{
  background: #b3afaf;
}
 </style>
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('employee/employee'); ?>">Monthly Entries</a> <i class="fa fa-angle-right"></i> Payslip Generation</li>
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
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                 <?= form_open('payroll/salary/payslip_gen',array('id'=>'searchForm')); ?>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Month</label><span class="req"> *</span>
                            <input type="text" name="month_year" class="form-control datepicker" id="date" autocomplete="off" required="" value="<?php echo set_value('month_year'); ?>">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label></label>
                            <button type="submit" class="btn btn-success form-control search_btn" name="display" onclick="processingFun()"><i class="fa fa-eye"></i> Display</button>
                          </div>
                        </div>
                      </div>
                    <?= form_close(); ?>
                    <hr>
					<?php if(isset($resultList)){ ?>
                    <div class="table-responsive details-table" style="height: 500px;">
                      <table class="table table-striped table-bordered dataTable">
                        <thead id="header-fixed">
                          <tr> 
                           <th colspan="6" class="text-center thead-color"></th>
                            <th colspan="9" class="text-center thead-color">Allowance</th>
                            <th colspan="6" class="text-center thead-color">Arrear</th>
                            <th class="text-center thead-color"></th>
                            <th colspan="14" class="text-center thead-color">Deduction</th>
                            <th class="text-center thead-color"></th>
                            <th class="text-center thead-color"></th>
                            <th class="text-center thead-color"></th>
                          </tr>
                          <tr>
                            <th><?php if($checkUpdationLock == false){ ?><input type="checkbox" id="checkAll"><?php } ?></th>
                            <th class="thead-color">S.No</th>
                            <th class="thead-color">Employee<br>ID</th>  
                            <th class="thead-color">Employee NAME</th>  
                            <th class="thead-color">W.<br>Days</th>  
                            <th class="thead-color">Pr.<br> Days</th>   
                            <th class="thead-color">Basic</th>   
                            <th class="thead-color text-center">Payable<br>Amt. of <br>Basic</th>   
                            <th class="thead-color text-center">DA</th>   
                            <th class="thead-color text-center">HRA</th>   
                            <th class="thead-color text-center">TA</th>   
                            <th class="thead-color">Fixed <br>Allow.</th>   
                            <th class="thead-color">Shift <br>Allow.</th>   
                            <th class="thead-color">Medical<br>Reimbur.</th>   
                            <th class="thead-color text-center">SH Rent</th>   
                            <th class="thead-color text-center">Basic</th>   
                            <th class="thead-color text-center">DA</th>   
                            <th class="thead-color text-center">HRA</th>     
                            <th class="thead-color text-center">TA</th>   
                            <th class="thead-color text-center">Fixed <br>Allow.</th>   
                            <th class="thead-color text-center">Shift <br>Allow.</th>  
                            <th class="thead-color">Gross <br>Payable</th>   
                            <th class="thead-color">EPF</th>   
                            <th class="thead-color">VPF</th>   
                            <th class="thead-color">Prof. Tax</th>   
                            <th class="thead-color">LIC</th> 
                            <th class="thead-color text-center">House<br>Rent</th> 
                            <th class="thead-color text-center">Elect</th> 
                            <th class="thead-color text-center">Security</th> 
                            <th class="thead-color text-center">Garage<br>Rent</th> 
                            <th class="thead-color">Group <br>Ins.<br>Amt</th>   
                            <th class="thead-color">Staff<br> Welfare<br>Fund</th>   
                            <th class="thead-color">TDS</th>   
                            <th class="thead-color">Medical</th>   
                            <th class="thead-color">Bus</th>   
                            <th class="thead-color">Adv.<br>Salary</th>   
                            <th class="thead-color">Total <br>Deduction</th>   
                            <th class="thead-color">Payable<br>Amount</th>   
                            <th class="thead-color">Salary<br>Deduct.<br>Days</th>   
                          </tr>
                        </thead>
            			<tbody>
            			<?php $increase=1; 

                        $grand_total_basic = 0;
                        $grand_total_payable_basic = 0;
                        $grand_total_da = 0;
                        $grand_total_hra = 0;
                        $grand_total_ta = 0;
                        $grand_total_fixed_all = 0;
                        $grand_total_shift_all = 0;
                        $grand_total_medical_reimb = 0;
                        $grand_total_sh_rent = 0;
                        $grand_total_arrear_basic = 0;
                        $grand_total_arrear_da = 0;
                        $grand_total_arrear_hra = 0;
                        $grand_total_arrear_ta = 0;
                        $grand_total_arrear_fixed_all = 0;
                        $grand_total_arrear_shift_all = 0;
                        $grand_total_gross_payable = 0;
                        $grand_total_epf = 0;
                        $grand_total_vpf = 0;
                        $grand_total_prof_tax = 0;
                        $grand_total_lic = 0;
                        $grand_total_hra_rent = 0;
                        $grand_total_hra_elect = 0;
                        $grand_total_hra_garage = 0;
                        $grand_total_hra_security = 0;
                        $grand_total_group_insur= 0;
                        $grand_total_staff_welfare = 0;
                        $grand_total_tds = 0;
                        $grand_total_medical_dedu = 0;
                        $grand_total_bus_dedu = 0;
                        $grand_total_advance_sal = 0;
                        $grand_total_deduction = 0;
                        $grand_total_payable = 0;

                        foreach($resultList as $key => $value){ ?>
            							<tr>
                            <td class="text-center">
                              <?php if($checkUpdationLock == false){ ?>
                                <input type="checkbox" name="emp_data" class="checkEmp" value="<?php echo $value['id']; ?>" onclick="checkEmp()">
                              <?php } ?>
                            </td>
            								<td class="text-center"><?php echo $increase++; ?></td>
                            <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                            <td><?php echo $value['EMP_NAME']; ?></td>
                            <td class="text-center"><?php echo $value['working_days']; ?></td>
                            <td class="text-center"><?php echo $value['present_days']; ?></td>
                            <td class="text-right"><?php echo number_format($value['basic_sal']); $grand_total_basic += $value['basic_sal']; ?></td>
                            <td class="text-right"><?php echo number_format($value['payable_basic']); $grand_total_payable_basic += $value['payable_basic']; ?></td>
                            <td class="text-right"><?php echo number_format($value['da']); $grand_total_da += $value['da']; ?></td>
                            <td class="text-right"><?php echo number_format($value['hra_amt_allowance']); $grand_total_hra += $value['hra_amt_allowance']; ?></td>
                            <td class="text-right"><?php echo number_format($value['ta_amount']); $grand_total_ta += $value['ta_amount']; ?></td>
                            <td class="text-right"><?php echo number_format($value['fixed_allowance']); $grand_total_fixed_all += $value['fixed_allowance']; ?></td>
                            <td class="text-right"><?php echo number_format($value['second_shift_amt']); $grand_total_shift_all += $value['second_shift_amt']; ?></td>
                            <td class="text-right"><?php echo number_format($value['medical_reimbursment']); $grand_total_medical_reimb += $value['medical_reimbursment']; ?></td>
                            <td class="text-right"><?php echo number_format($value['sh_rent']); $grand_total_sh_rent += $value['sh_rent']; ?></td>
                            <td class="text-right"><?php echo number_format($value['arrear_basic']); $grand_total_arrear_basic += $value['arrear_basic']; ?></td>
                            <td class="text-right"><?php echo number_format($value['arrear_da']); $grand_total_arrear_da += $value['arrear_da']; ?></td>
                            <td class="text-right"><?php echo number_format($value['arrear_hra']); $grand_total_arrear_hra += $value['arrear_hra']; ?></td>
                            <td class="text-right"><?php echo number_format($value['arrear_ta']); $grand_total_arrear_ta += $value['arrear_ta']; ?></td>
                            <td class="text-right"><?php echo number_format($value['arrear_fixed_allow']); $grand_total_arrear_fixed_all += $value['arrear_fixed_allow']; ?></td>
                            <td class="text-right"><?php echo number_format($value['arrear_shift_allow']); $grand_total_arrear_shift_all += $value['arrear_shift_allow']; ?></td>
                            <td class="text-right"><?php echo number_format($value['gross_payable']); $grand_total_gross_payable += $value['gross_payable']; ?></td>
                            <td class="text-right"><?php echo number_format($value['employee_pf']); $grand_total_epf += $value['employee_pf']; ?></td>
                            <td class="text-right"><?php echo number_format($value['vpf']); $grand_total_vpf += $value['vpf']; ?></td>
                            <td class="text-right"><?php echo number_format($value['prof_tax']); $grand_total_prof_tax += $value['prof_tax']; ?></td>
                            <td class="text-right"><?php echo number_format($value['lic']); $grand_total_lic += $value['lic']; ?></td>
                            <td class="text-right"><?php echo number_format($value['hra_rent']); $grand_total_hra_rent += $value['hra_rent']; ?></td>
                            <td class="text-right"><?php echo number_format($value['hra_elect']); $grand_total_hra_elect += $value['hra_elect']; ?></td>
                            <td class="text-right"><?php echo number_format($value['hra_security']); $grand_total_hra_security += $value['hra_security']; ?></td>
                            <td class="text-right"><?php echo number_format($value['hra_garage']); $grand_total_hra_garage += $value['hra_garage']; ?></td>
                            <td class="text-right"><?php echo number_format($value['group_insurance_amt'],2); $grand_total_group_insur += $value['group_insurance_amt']; ?></td>
                            <td class="text-right"><?php echo number_format($value['staff_welfare_fund']); $grand_total_staff_welfare += $value['staff_welfare_fund']; ?></td>
                            <td class="text-right"><?php echo number_format($value['tds']); $grand_total_tds += $value['tds']; ?></td>
                            <td class="text-right"><?php echo number_format($value['medical_deduction']); $grand_total_medical_dedu += $value['medical_deduction']; ?></td>
                            <td class="text-right"><?php echo number_format($value['bus_deduct']); $grand_total_bus_dedu += $value['bus_deduct']; ?></td>
                            <td class="text-right"><?php echo number_format($value['salary_advance_deduction_amt']); $grand_total_advance_sal += $value['salary_advance_deduction_amt']; ?></td>
                            <td class="text-right"><?php echo number_format($value['total_deduction'],2); $grand_total_deduction += $value['total_deduction']; ?></td>
            			    <td class="text-right"><?php echo number_format($value['payable_sal'],2); $grand_total_payable += $value['payable_sal']; ?></td>
                            <td class="text-center"><?php echo $value['absent_days']; ?></td>
            							</tr>
            						<?php } ?>
            						</tbody>
                        <tfoot>
                          <tr>
                            <th class="bottom-row text-right" colspan="6"><b>GRAND TOTAL</b></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_basic); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_payable_basic); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_da); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_hra); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_ta); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_fixed_all); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_shift_all); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_medical_reimb); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_sh_rent); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_arrear_basic); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_arrear_da); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_arrear_hra); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_arrear_ta); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_arrear_fixed_all); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_arrear_shift_all); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_gross_payable); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_epf); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_vpf); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_prof_tax); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_lic); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_hra_rent); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_hra_elect); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_hra_security); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_hra_garage); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_group_insur); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_staff_welfare); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_tds); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_medical_dedu); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_bus_dedu); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_advance_sal); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_deduction,2); ?></th>
                            <th class="text-right bottom-row"><?php echo number_format($grand_total_payable,2); ?></th>
                            <th class="text-right bottom-row"></th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <br>
                    <?php if($checkUpdationLock == false){ ?>
                      <button type="button" class="btn btn-danger pull-left details-table" onclick="updationLock()"><i class="fa fa-lock"></i> Updation Lock</button>
                      <button type="button" class="btn btn-success pull-right details-table" onclick="generatePaySlip()"><i class="fa fa-save"></i> Generate</button>
                    <?php }else { ?>
                      <div class="alert alert-info">
                        Payslip already generated and updation has been locked.
                      </div>
                    <?php } ?>
					<?php } ?>
              </div>
            </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div><br><br>


<!--Pay Control Modal-->
<div class="modal fade" id="lockModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <h4 class="modal-title">Unlock</h4>
      </div>
      <form id="otpform">
        <div class="modal-body">
          <table class="table table-striped table-hover table-bordered">
            <tr>
              <th>Mobile No :</th>
              <td><?php echo $schoolSetting['School_MobileNo']; ?></td>
            </tr>
            <tr>
              <th>OTP :</th>
              <td><input type="number" class="form-control" min="1" maxlength="6" minlength="6" required="" name="otptext"></td>
            </tr>
          </table>
          <br>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="verifyOTP()">Unlock</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

  <script type="text/javascript">
    

    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip(); 
    });

 $( document ).ajaxComplete(function() {
    // Required for Bootstrap tooltips in DataTables
    $('[data-toggle="tooltip"]').tooltip({
        "html": true,
        "delay": {"show": 10, "hide": 0},
    });
});

  //add checkbox
    $('#checkAll').click(function(){
        
          if($(this).prop("checked")) {
            if(confirm('Do you want to generate all employee pay slip'))
            {
              $(".checkEmp").prop("checked", true);
            }
            else
            {
              $(this).prop("checked",false);
            }
          } else {
              $(".checkEmp").prop("checked", false);
          }              
    });

    function checkEmp()
    {
        if($(".checkEmp").length == $(".checkEmp:checked").length) {
            $("#checkAll").prop("checked", true);
        }else {
            $("#checkAll").prop("checked", false);            
        }
    }

    function checkAllCheckBox()
    {
      if($(".checkEmp").length == $(".checkEmp:checked").length) {
          $("#checkAll").prop("checked", true);
      }else {
          $("#checkAll").prop("checked", false);            
      }
    }



var st_date = '<?php echo $current_year.'-'.$current_month.'-1'; ?>';
var end_dt = '<?php echo $current_year.'-'.$current_month.'-'.$total_days; ?>';
var startDate = new Date(st_date);
var endDate = new Date(end_dt);

$(".datepicker").datepicker({
 format: 'M-yyyy',
    autoclose: true,
    startView: "months", 
    minViewMode: "months",
   startDate: startDate,
   endDate: endDate
});

//validation
$(document).ready(function () {
    $('#otpform').validate({ // initialize the plugin
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});


 function generatePaySlip()
{
  var emp_id = [];
  $.each($("input[name='emp_data']:checked"), function(){            
      emp_id.push($(this).val());
  });
  if(emp_id != '')
  {
    if(confirm("Do you want to generate payslip?"))
    {
     $.ajax({
        url: "<?php echo base_url('payroll/salary/payslip_gen/generateMonthlyPayslip'); ?>",
        type: "POST",
        data: {emp_id:emp_id},
        dataType: 'json',
        beforeSend:function()
        {
          showLoader();
        },
        success: function(response){
          hideLoader();
          if(response.msg == 1)
          {
            swal({title: "Payslip Generated Successfully", text: "Payslip Generated Successfully", type: "success"});   
            getEmployeeData();
          }
          else
          {
            swal({title: "Payslip Generation Failed !", text: "Payslip Generation Failed !", type: "error"});   
          }
        }
      });
  }
   }
   else
   {
      alert('Please Select Employee First');
   }
}


$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});

function updationLock()
{
  var month = '<?php echo $current_month; ?>';
  var year = '<?php echo $current_year; ?>';
  var emp_id = [];
  $.each($("input[name='emp_data']:checked"), function(){            
      emp_id.push($(this).val());
  });
  if(emp_id != '')
  {
    if(confirm("Do you want to Lock Updation? You are not able to update payslip after updation lock."))
    {
      $.ajax({
        url: "<?php echo base_url('payroll/salary/payslip_gen/updationLock'); ?>",
        type: "POST",
        data: {emp_id:emp_id,month:month,year:year},
        dataType: 'json',
        beforeSend:function()
        {
          showLoader();
        },
        success: function(response){
          hideLoader();
          if(response.msg == 1)
          {
            swal({title: "Updation Lock Successfully", text: "Updation Lock Successfully", type: "success"});   
            getEmployeeData();
          }
          else
          {
            swal({title: "Failed !", text: "Failed !", type: "error"});   
          }
        }
      });
    }
  }
  else
  {
    alert('Please Select Employee First');
  }
}


function checkPayslipGenerated()
{
  var current_year = "<?php echo $current_year; ?>";
  var current_month = "<?php echo $current_month; ?>";
  $.ajax({
    url:'<?php echo base_url('payroll/salary/payslip_gen/checkPayslipGenerated'); ?>',
    data:{current_month:current_month,current_year:current_year},
    type:"post",
    dataType:"json",
    success:function(response)
    {
      if(response.msg == 2)
      {
        swal({title: "Please generate payslip first", text: "Please generate payslip first", type: "warning"});
      }
      else
      {
        window.open("<?php echo base_url('payroll/salary/payslip_gen/generatePayslipPDF'); ?>", "_blank");
      }
    }
  });
}


// $(document).ready(function(){

//   var check = '<?php echo $this->session->userdata('unlocksuccess'); ?>';
//   if(check != 1)
//   {
//     $('#lockModal').modal({
//         backdrop: 'static',
//         keyboard: false
//       });
//       var mobile = '<?php echo $schoolSetting['School_MobileNo']; ?>';
//       $.post("<?php echo base_url('payroll/salary/payslip_gen/sendSMS'); ?>", {mobile: mobile}, function(result){
        
//       });
//     }
// });

 function verifyOTP()
 {
  $("#otpform").validate();
  if ($('#otpform').valid())
  {
    var otp = '<?php echo $this->session->userdata('msgpayslip'); ?>';
    $.ajax({
      url:'<?php echo base_url('payroll/salary/payslip_gen/verifyOTP'); ?>',
      data:$('#otpform').serialize(),
      type:"post",
      dataType:"json",
      success:function(response)
      {
        if(response.msg == 1)
        {
          location.reload();
        }
        else
        {
          alert('OTP is not valid. Please enter valid OTP');
        }
      }
    });
  }
}

function processingFun()
{
  $('#searchForm').validate();
  if($('#searchForm').valid())
  {
    showLoader();
  }
}

  </script>
