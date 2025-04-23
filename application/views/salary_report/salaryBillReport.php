 <style type="text/css">
     .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    color: black;
    font-size: 11px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
  .thead-color{
    background: #abb0ac !important;
  }
 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <b>Monthly Salary Bill Report</b>
      <hr>
     <form id="searchForm" method="post" action="<?php echo base_url('salary_report/salary_bill'); ?>">
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>Month and Year</label><span class="req"> *</span>
              <input type="text" name="date" class="form-control datepicker" id="date" autocomplete="off" value="<?php echo set_value('date'); ?>" required="">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label></label>
              <button type="submit" class="btn btn-success form-control" name="search"><i class="fa fa-search"></i> Search</button>
            </div>
          </div>
        </div>
      </form>
      <hr>
      <?php if(isset($resultList) && !empty($resultList)){ ?>
        <center>
          <a href="<?php echo base_url('salary_report/salary_bill/generateSalaryPDFReport/'.$year.'/'.$month); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate or Print Report</a>
          <a href="<?php echo base_url('salary_report/salary_bill/generateSalaryRegisterPDFReport/'.$year.'/'.$month); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate Salary Register Report</a></center>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
              <thead id="header-fixed">
                <tr> 
                 <th colspan="5" class="text-center thead-color"></th>
                  <th colspan="9" class="text-center thead-color">Allowance</th>
                  <th colspan="6" class="text-center thead-color">Arrear</th>
                  <th class="text-center thead-color"></th>
                  <th colspan="14" class="text-center thead-color">Deduction</th>
                  <th class="text-center thead-color"></th>
                  <th class="text-center thead-color"></th>
                  <th class="text-center thead-color"></th>
                </tr>
                <tr>
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
                      <td class="text-center"><?php echo $increase++; ?></td>
                      <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                      <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                      <td class="text-center"><?php echo $value['total_working_days']; ?></td>
                      <td class="text-center"><?php echo $value['total_present']; ?></td>
                      <td class="text-right"><?php echo number_format($value['actual_basic']); $grand_total_basic += $value['actual_basic']; ?></td>
                      <td class="text-right"><?php echo number_format($value['basic_salary']); $grand_total_payable_basic += $value['basic_salary']; ?></td>
                      <td class="text-right"><?php echo number_format($value['da_pay']); $grand_total_da += $value['da_pay']; ?></td>
                      <td class="text-right"><?php echo number_format($value['hra_pay']); $grand_total_hra += $value['hra_pay']; ?></td>
                      <td class="text-right"><?php echo number_format($value['ta_pay']); $grand_total_ta += $value['ta_pay']; ?></td>
                      <td class="text-right"><?php echo number_format($value['fixed_allowance']); $grand_total_fixed_all += $value['fixed_allowance']; ?></td>
                      <td class="text-right"><?php echo number_format($value['second_shift_amount']); $grand_total_shift_all += $value['second_shift_amount']; ?></td>
                      <td class="text-right"><?php echo number_format($value['medical_reimbursement']); $grand_total_medical_reimb += $value['medical_reimbursement']; ?></td>
                      <td class="text-right"><?php echo number_format($value['sh_rent']); $grand_total_sh_rent += $value['sh_rent']; ?></td>
                      <td class="text-right"><?php echo number_format($value['arrear_basic']); $grand_total_arrear_basic += $value['arrear_basic']; ?></td>
                      <td class="text-right"><?php echo number_format($value['arrear_da']); $grand_total_arrear_da += $value['arrear_da']; ?></td>
                      <td class="text-right"><?php echo number_format($value['arrear_hra']); $grand_total_arrear_hra += $value['arrear_hra']; ?></td>
                      <td class="text-right"><?php echo number_format($value['arrear_ta']); $grand_total_arrear_ta += $value['arrear_ta']; ?></td>
                      <td class="text-right"><?php echo number_format($value['arrear_fixed_allow']); $grand_total_arrear_fixed_all += $value['arrear_fixed_allow']; ?></td>
                      <td class="text-right"><?php echo number_format($value['arrear_shift_allow']); $grand_total_arrear_shift_all += $value['arrear_shift_allow']; ?></td>
                      <td class="text-right"><?php echo number_format($value['gross_salary']); $grand_total_gross_payable += $value['gross_salary']; ?></td>
                      <td class="text-right"><?php echo number_format($value['pf_own_deduct']); $grand_total_epf += $value['pf_own_deduct']; ?></td>
                      <td class="text-right"><?php echo number_format($value['vpf_deduct']); $grand_total_vpf += $value['vpf_deduct']; ?></td>
                      <td class="text-right"><?php echo number_format($value['prof_tax']); $grand_total_prof_tax += $value['prof_tax']; ?></td>
                      <td class="text-right"><?php echo number_format($value['lic']); $grand_total_lic += $value['lic']; ?></td>
                      <td class="text-right"><?php echo number_format($value['hra_rent_deduct']); $grand_total_hra_rent += $value['hra_rent_deduct']; ?></td>
                      <td class="text-right"><?php echo number_format($value['hra_elect_deduct']); $grand_total_hra_elect += $value['hra_elect_deduct']; ?></td>
                      <td class="text-right"><?php echo number_format($value['hra_security_deduct']); $grand_total_hra_security += $value['hra_security_deduct']; ?></td>
                      <td class="text-right"><?php echo number_format($value['hra_garage_deduct']); $grand_total_hra_garage += $value['hra_garage_deduct']; ?></td>
                      <td class="text-right"><?php echo number_format($value['group_insurance_amt'],2); $grand_total_group_insur += $value['group_insurance_amt']; ?></td>
                      <td class="text-right"><?php echo number_format($value['staff_welfare_fund']); $grand_total_staff_welfare += $value['staff_welfare_fund']; ?></td>
                      <td class="text-right"><?php echo number_format($value['tds_deduct']); $grand_total_tds += $value['tds_deduct']; ?></td>
                      <td class="text-right"><?php echo number_format($value['medical_deduct']); $grand_total_medical_dedu += $value['medical_deduct']; ?></td>
                      <td class="text-right"><?php echo number_format($value['bus_deduction']); $grand_total_bus_dedu += $value['bus_deduction']; ?></td>
                      <td class="text-right"><?php echo number_format($value['advance_salary_deduct']); $grand_total_advance_sal += $value['advance_salary_deduct']; ?></td>
                      <td class="text-right"><?php echo number_format($value['total_deduction'],2); $grand_total_deduction += $value['total_deduction']; ?></td>
                <td class="text-right"><?php echo number_format($value['payable_amt'],2); $grand_total_payable += $value['payable_amt']; ?></td>
                      <td class="text-center"><?php echo $value['total_working_days']-$value['total_present']; ?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="bottom-row text-right" colspan="5"><b>GRAND TOTAL</b></th>
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
      <?php } else { ?>
        <div class="row">
          <div class="col-sm-12">
            <?php if($this->session->flashdata('msg')){
              echo $this->session->flashdata('msg');
            } ?>
          </div>
        </div>
      <?php } ?>
          <br>
          <br>
</div>


<script type="text/javascript">
        $(function () {
        $('.datatable').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : true,
          'pageLength'  : 25,
          dom: 'Bfrtip',
          buttons: [
              {
                extend: 'excelHtml5',
                title: 'Employee Report',
                              
              },
          ],
        })
      });

    $('.datepicker').datepicker({
      format: "M-yyyy",
      autoclose: true,
      startView: "months", 
    minViewMode: "months"
    });
</script>