<html>
<head>
  <style>
        .table {
          border-collapse: collapse;
        }

        .table, th, td {
          border: 1px solid #abb5c4;
        }

        .detailstables tr td,.detailstables tr th{
          border: none;
          font-size: 13px;
        }

         .name {
          text-align: left;
        }
        .text-center{
          text-align: center;
          font-weight: bold;
        }
        .text-right{
          text-align: right;
        }
        .thead-color{
          background: #abb0ac !important;
        }
        body{
          font-family: "Arial", Helvetica, sans-serif;
        }
    @page { margin: 20px 30px 40px 30px; }
  </style>
</head>
<body>
  <div id="content">
    <div style="text-align: center;">
      <span style="font-size: 25px;font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span>
      <br><span><?php echo $school_setting['School_Address'] ?> </span><br>
      <p>STATEMENT OF PF/PENSION & ESI CONTRIBUTED DURING THE FINANCIAL YEAR <?php echo $school_setting['School_Session']; ?></p>
      <hr>
    </div><br>
          <div>
            <table style="width: 100%;" class="detailstables">
              <tr>
                <td>EMPLOYEE NAME</td>
                <td> : </td>
                <th><?php echo $employeeData['EMP_FNAME'].' '.$employeeData['EMP_MNAME'].' '.$employeeData['EMP_LNAME']; ?></th>
                <td>FATHER / HUSBAND NAME</td>
                <td> : </td>
                <th><?php if($employeeData['FATHERS_NAME']){
                  echo $employeeData['FATHERS_NAME'];
                }else{
                  echo $employeeData['G_NAME'];
                } ?></th>
              </tr>
              <tr>
                <td>DT. OF JOIN</td>
                <td> : </td>
                <th><?php echo date('d-M-Y',strtotime($employeeData['D_O_J'])); ?></th>
                <td>Gender</td>
                <td> : </td>
                <th><?php if($employeeData['SEX'] == 1){
                  echo "Male";
                }elseif($employeeData['SEX'] == 2){
                  echo "Female";
                }else{
                  echo "Other";
                } ?></th>
              </tr>
              <tr>
                <td>PF A/C No.</td>
                <td> : </td>
                <th><?php echo $employeeData['PF_AC_NO']; ?></th>
                <td>PF Joining Date</td>
                <td> : </td>
                <th><?php echo date('d-M-Y',strtotime($employeeData['PF_JOIN_DT'])); ?></th>
              </tr>
              
            </table>
            <br><br>
            <table class="table" style="width: 100%">
              <thead>
              <tr>
                <th class="text-center thead-color">S.No.</th>
                <th class="text-center thead-color">Year</th>
                <th class="text-center thead-color">Month</th>
                <th class="text-center thead-color">Gross Wages</th>
                <th class="text-center thead-color">EPF Wages</th>
                <th class="text-center thead-color">EPF Employee Cont.</th>
                <th class="text-center thead-color">Pension Cont.</th>
                <th class="text-center thead-color">ESI Employee Cont.</th>
                <th class="text-center thead-color">ESI Employer Cont.</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                $total_gross = 0;
                $total_basic = 0;
                $total_pf_deduct = 0;
                $total_pension = 0;
                $total_esi_own_deduct = 0;
                $total_esi_emp_deduct = 0;
                foreach ($payslipData as $key => $value) { ?>
                  <tr>
                    <td class="text-center"><?php echo $key + 1; ?></td>
                    <td class="text-center"><?php echo $value['payslip_year']; ?></td>
                    <td class="text-center"><?php echo $value['payslip_month']; ?></td>
                    <td class="name text-right"><?php echo $value['gross_salary']; ?></td>
                    <td class="name text-right"><?php echo $value['basic_salary']; ?></td>
                    <td class="name text-right"><?php echo $value['pf_own_deduct']; ?></td>
                    <td class="name text-right"><?php echo $pension = ($value['pension_rate'] * $value['basic_salary'])/100; ?></td>
                    <td class="name text-right"><?php echo $value['esi_deduct']; ?></td>
                    <td class="name text-right"><?php
                    $esi_emp_amt = 0;
                    if($value['esi_app'] == 1)
                    {
                      $esi_emp_amt = ($value['gross_salary'] * $value['esi_emp_rate']) / 100;
                      //esi amount changed just like 148.12 = 149 , 142.56 = 143
                      $esi_amt_int = (int)$esi_emp_amt;
                      if($esi_emp_amt > $esi_amt_int)
                      {
                        $esi_emp_amt = $esi_amt_int + 1;
                      }
                    }
                     echo $esi_emp_amt; ?></td>
                  </tr>
                <?php
                $total_gross = $total_gross + $value['gross_salary'];
                $total_basic = $total_basic + $value['basic_salary'];
                $total_pf_deduct =  $total_pf_deduct + $value['pf_own_deduct'];
                $total_pension =  $total_pension + $pension;
                $total_esi_own_deduct =  $total_esi_own_deduct + $value['esi_deduct'];
                $total_esi_emp_deduct =  $total_esi_emp_deduct + $esi_emp_amt;
                 } ?>
              </tbody>
              <tfoot>
                  <tr>
                    <td colspan="3" style="text-align: center;background: #9ea7b5 !important;">Total</td>
                    <td class="name text-right" style="background: #9ea7b5 !important;"><?php echo $total_gross; ?></td>
                    <td class="name text-right" style="background: #9ea7b5 !important;"><?php echo $total_basic; ?></td>
                    <td class="name text-right" style="background: #9ea7b5 !important;"><?php echo $total_pf_deduct; ?></td>
                    <td class="name text-right" style="background: #9ea7b5 !important;"><?php echo $total_pension; ?></td>
                    <td class="name text-right" style="background: #9ea7b5 !important;"><?php echo $total_esi_own_deduct; ?></td>
                    <td class="name text-right" style="background: #9ea7b5 !important;"><?php echo $total_esi_emp_deduct; ?></td>
                  </tr>
              </tfoot>
            </table>
            <br>
            <br>

            <p style="text-align: center;">
              ***************************************************************************************<br>This is computer generated statement, hence signature not required.</p>
          </div>
  </div>
  </body>
</html>