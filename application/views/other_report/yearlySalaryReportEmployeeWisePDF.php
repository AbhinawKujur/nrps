 <html>
<head>
  <style>
    /*@page { margin: 180px 50px; }*/
    /*#header { position: fixed; left: 0px; top: 0px; right: 0px;text-align: center; }*/
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: center;border-top: 1px solid black;}
        #footer .page:after { content: counter(page, decimal); }

        .table {
          border-collapse: collapse;
          font-size: 14px;
        }

        .table, th, td {
          border: 1px solid #abb5c4;
        }
        .customtable tr td {
          border: none;
        }
        .name {
          text-align: left;
        }
    @page { margin: 20px 30px 40px 50px; }
  </style>
  <title>Yearly Salary Report</title>
</head>
<body>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
  <div id="content">
    <div style="text-align: center;">
      <span style="font-size: 25px;font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span>
      <br><span><?php echo $school_setting['School_Address'] ?> </span><br>
    </div>
    <center><b>YEARLY SALARY STATEMENT FOR THE FINANCIAL YEAR <?php echo $current_session['Session_Nm']; ?></b></center>
      <hr>
      <table style="width: 100%;" class="customtable">
        <tr>
          <td>Employee Name :</td>
          <td><?php echo $employeeDetails['EMP_FNAME'].' '.$employeeDetails['EMP_MNAME'].' '.$employeeDetails['EMP_LNAME']; ?></td>
          <td>Father's / Husband Name :</td>
          <td>
            <?php if($employeeDetails['FATHERS_NAME'] != ''){
              echo $employeeDetails['FATHERS_NAME'];
            }else{
              echo $employeeDetails['G_NAME'];
            } ?>
          </td>
        </tr>
        <tr>
          <td>Joining Date :</td>
          <td><?php echo date('d-M-Y',strtotime($employeeDetails['D_O_J'])); ?></td>
          <td>PAN Number :</td>
          <td><?php echo $employeeDetails['PAN_NUMBER']; ?></td>
        </tr>
        <tr>
          <td>PF Joining Date :</td>
          <td><?php echo date('d-M-Y',strtotime($employeeDetails['PF_JOIN_DT'])); ?></td>
          <td>Bank Account No. :</td>
          <td><?php echo $employeeDetails['BANK_AC_NO']; ?></td>
        </tr>
        <tr>
          <td>PF Account No :</td>
          <td><?php echo $employeeDetails['PF_AC_NO']; ?></td>
          <td>UAN Number</td>
          <td><?php echo $employeeDetails['UANNO']; ?></td>
        </tr>
        <tr>
          <td>ESI Account No :</td>
          <td><?php echo $employeeDetails['ESI_AC_NO']; ?></td>
          <td>Aadhaar No :</td>
          <td><?php echo $employeeDetails['AADHAARNO']; ?></td>
        </tr>
      </table><br><br>
          <div>
            <table style="width: 100%;" class="table">
              <thead>
                <tr>
                  <th style="background: #337ab7 !important; color: white !important;text-align: center;">Month</th>
                  <th style="background: #337ab7 !important; color: white !important;">Year</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Working Days</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Days Worked</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Basic</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Allowance</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Gross Salary</th>  
                  <th style="background: #337ab7 !important; color: white !important;">PF</th>  
                  <th style="background: #337ab7 !important; color: white !important;">TDS</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Advance Ded.</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Misc. Ded.</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Total Ded.</th>
                  <th style="background: #337ab7 !important; color: white !important;">Net Salary Paid</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  $total_basic = 0;
                  $total_allow = 0;
                  $total_gross = 0;
                  $total_pf = 0;
                  $total_tds = 0;
                  $total_esi = 0;
                  $total_adv_ded = 0;
                  $total_mis_ded = 0;
                  $total_deduction = 0;
                  $total_net_sal = 0;

                  foreach ($resultData as $key => $value) {  ?>
                      <tr>
                          <td><?php echo $value['month_name']; ?></td>
                          <td style="text-align: center;"><?php echo $value['payslip_year']; ?></td>
                          <td style="text-align: center;"><?php echo sprintf('%g',$value['total_working_days']); ?></td>
                          <td style="text-align: center;"><?php echo sprintf('%g',$value['total_present']); ?></td>
                          <td style="text-align: right;"><?php echo $value['basic_salary']; ?></td>
                          <td style="text-align: right;"><?php 
                          $mis_allow = $value['da_pay'] + $value['hra_pay'] + $value['ta_pay']+ $value['fixed_allowance']+ $value['shift_allowance'] + $value['second_shift_amount'] + $value['arrear_basic'] + $value['arrear_da'] + $value['arrear_hra'] + $value['arrear_ta'] + $value['arrear_fixed_allow'] + $value['arrear_shift_allow'];
                          echo $mis_allow; ?></td>
                          <td style="text-align: right;"><?php echo $value['gross_salary']; ?></td>
                          <td style="text-align: right;"><?php echo $value['pf_own_deduct']; ?></td>
                          <td style="text-align: right;"><?php echo $value['tds_deduct']; ?></td>
                          <td style="text-align: right;"><?php echo $value['advance_salary_deduct']; ?></td>
                          <td style="text-align: right;"><?php 
                          $mis_deduc =$value['fpf_deduct'] + $value['vpf_deduct'] + $value['prof_tax'] + $value['lic'] + $value['hra_rent_deduct'] + $value['hra_security_deduct'] + $value['hra_garage_deduct'] + $value['hra_elect_deduct'] + $value['group_insurance_amt'] + $value['staff_welfare_fund'] + $value['medical_deduct'];
                          echo $mis_deduc; ?></td>
                          <td style="text-align: right;"><?php echo $value['total_deduction']; ?></td>
                          <td style="text-align: right;"><?php echo $value['payable_amt']; ?></td>
                      </tr>

                      <?php 

                      $total_basic =  $total_basic + $value['basic_salary'];
                      $total_allow = $total_allow + $mis_allow;
                      $total_gross = $total_gross + $value['gross_salary'];
                      $total_pf = $total_pf + $value['pf_own_deduct'];
                      $total_tds = $total_tds + $value['tds_deduct'];
                      $total_esi = $total_esi + $value['esi_deduct'];
                      $total_adv_ded = $total_adv_ded + $value['advance_salary_deduct'];
                      $total_mis_ded = $total_mis_ded + $mis_deduc;
                      $total_deduction = $total_deduction + $value['total_deduction'];
                      $total_net_sal = $total_net_sal + $value['payable_amt'];
                  ?>
                  <?php } ?>
              </tbody>
              <tfoot>
                <tr>  
                  <th style="background: #337ab7 !important; color: white !important;text-align: right;" colspan="4">Grand Total</th>  
                  <th style="background: #337ab7 !important; color: white !important;text-align: right;"><?php echo $total_basic; ?></th>  
                  <th style="background: #337ab7 !important; color: white !important;text-align: right;"><?php echo $total_allow; ?></th>  
                  <th style="background: #337ab7 !important; color: white !important;text-align: right;"><?php echo $total_gross; ?></th>  
                  <th style="background: #337ab7 !important; color: white !important;text-align: right;"><?php echo $total_pf; ?></th>  
                  <th style="background: #337ab7 !important; color: white !important;text-align: right;"><?php echo $total_tds; ?></th>  
                  <th style="background: #337ab7 !important; color: white !important;text-align: right;"><?php echo $total_adv_ded; ?></th>  
                  <th style="background: #337ab7 !important; color: white !important;text-align: right;"><?php echo $total_mis_ded; ?></th>  
                  <th style="background: #337ab7 !important; color: white !important;text-align: right;"><?php echo $total_deduction; ?></th>
                  <th style="background: #337ab7 !important; color: white !important;text-align: right;"><?php echo $total_net_sal; ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
  </div>
  </body>
</html>