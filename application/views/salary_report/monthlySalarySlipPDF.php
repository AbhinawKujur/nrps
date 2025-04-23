 <html>
<head>
  <link href="assets/dash_css/font-awesome.css" rel="stylesheet"> 
  <style>
        .table {
          border-collapse: collapse;
          font-size: 15px;
        }

        .table, th, td {
          border: 1px solid black;
        }

        .detailstables tr td,.detailstables tr th{
          border: none;
          font-size: 10px;
        }
        body{
          font-family: Verdana,Geneva,sans-serif; 
        }
        .detailstables2 tr td,.detailstables2 tr th{
          border: none;
          font-size: 13px;
        }
        .name {
          text-align: left;
        }
        body{
          font-family: "Arial", Helvetica, sans-serif;
        }
    @page { margin: 50px 80px 20px 80px; }
     .border-none{
          border: none;
        }
        .text-center{
          text-align: center;
        }
  </style>
</head>
<body>
  <?php $cut = 0; $sno = 0;
  foreach ($payslipData as $key => $value) { 
    $cut += 1;$sno += 1;
    ?>
    <div id="content">
      <table style="width: 100%;border: none;font-size: 16px;">
      <tr>
        <td class="border-none" width="60px"><img src="<?php echo $school_setting['SCHOOL_LOGO']; ?>" width="80px" height="80px"></td>
        <td class="border-none text-center"><span style="font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span><br><span><?php echo $school_setting['School_Address'] ?> </span><br>
        <?php echo "Salary Month : ".date('M',strtotime($year.'-'.$month.'-1')).'-'.$year; ?></td>
      </tr>
    </table>
      <div>

          <?php  $allowance = $value['da_pay'] + $value['hra_pay'] + $value['ta_pay'] + $value['fixed_allowance'] + $value['shift_allowance'] + $value['second_shift_amount'] + $value['arrear_basic'] + $value['arrear_da'] + $value['arrear_hra'] + $value['arrear_ta'] + $value['arrear_fixed_allow'] + $value['arrear_shift_allow']; ?>
        <table class="table" style="width: 100%">
          <tr>
            <th style="text-align: center;"></th>
            <th style="text-align: center;">PAYABLE AMOUNT</th>
            <th style="text-align: center;">DEDUCTIONS</th>
          </tr>
          <tr>
             <td style="vertical-align: top;">
              <table class="detailstables2" style="width: 100%">
                <tr>
                  <td>S. No.</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo str_pad($sno, 4, '*', STR_PAD_LEFT); ?></td>
                </tr>
                <tr>
                  <td>Pers. ID</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                </tr>
                <tr>
                  <td>Name</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                </tr>
                <tr>
                  <td>Designation</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo $value['DESIG']; ?></td>
                </tr>
                 <tr>
                  <td>Bank A/c No</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo $value['BANK_AC_NO']; ?></td>
                </tr>
              </table>
            </td>
            <td style="vertical-align: top;">
              <table class="detailstables2" style="width: 100%">
                <tr>
                  <td>Basic</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['basic_salary'],2); ?></td>
                </tr>
                <tr>
                  <td>DA</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['da_pay'],2); ?></td>
                </tr>
                 <tr>
                  <td>HRA</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['hra_pay'],2); ?></td>
                </tr>
                <tr>
                  <td>TA</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['ta_pay'],2); ?></td>
                </tr>
                <?php if($value['fixed_allowance']>0){ ?>
                  <tr>
                    <td>Fixed Allowance</td>
                    <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['fixed_allowance'],2); ?></td>
                  </tr>
                <?php } ?>
                <?php if($value['shift_allowance']>0){ ?>
                  <tr>
                    <td>Shift Allowance</td>
                    <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['second_shift_amount'],2); ?></td>
                  </tr>
                <?php } ?>
                <?php if($value['sh_rent']>0){ ?>
                  <tr>
                    <td>SH Rent</td>
                    <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['sh_rent'],2); ?></td>
                  </tr>
                <?php } ?>
                <?php 
                  $arrear_basic = ($value['arrear_basic']=='')?0:$value['arrear_basic']; 
                  $arrear_da = ($value['arrear_da']=='')?0:$value['arrear_da']; 
                  $arrear_hra = ($value['arrear_hra']=='')?0:$value['arrear_hra']; 
                  $arrear_ta = ($value['arrear_ta']=='')?0:$value['arrear_ta']; 
                  $arrear_fixed_allow = ($value['arrear_fixed_allow']=='')?0:$value['arrear_fixed_allow']; 
                  $arrear_shift_allow = ($value['arrear_shift_allow']=='')?0:$value['arrear_shift_allow']; 
                  ?>
                <?php if($arrear_basic>0){ ?>
                  <tr>
                    <td>Arrear Basic</td>
                    <td style="text-align: right;font-weight: bold;">
                      <?php echo number_format($arrear_basic,2); ?>
                    </td>
                  </tr>
                <?php } ?>
                <?php if($arrear_da>0){ ?>
                  <tr>
                    <td>Arrear DA</td>
                    <td style="text-align: right;font-weight: bold;">
                      <?php echo number_format($arrear_da,2); ?>
                    </td>
                  </tr>
                <?php } ?>
                <?php if($arrear_hra>0){ ?>
                  <tr>
                    <td>Arrear HRA</td>
                    <td style="text-align: right;font-weight: bold;">
                      <?php echo number_format($arrear_hra,2); ?>
                    </td>
                  </tr>
                <?php } ?>
                <?php if($arrear_ta>0){ ?>
                  <tr>
                    <td>Arrear TA</td>
                    <td style="text-align: right;font-weight: bold;">
                      <?php echo number_format($arrear_ta,2); ?>
                    </td>
                  </tr>
                <?php } ?>
                <?php if($arrear_fixed_allow>0){ ?>
                  <tr>
                    <td>Arrear Fixed Allow.</td>
                    <td style="text-align: right;font-weight: bold;">
                      <?php echo number_format($arrear_fixed_allow,2); ?>
                    </td>
                  </tr>
                <?php } ?>
                <?php if($arrear_shift_allow>0){ ?>
                  <tr>
                    <td>Arrear Shift Allow.</td>
                    <td style="text-align: right;font-weight: bold;">
                      <?php echo number_format($arrear_shift_allow,2); ?>
                    </td>
                  </tr>
                <?php } ?>
              </table>
            </td>
            <td style="vertical-align: top;">
              <table class="detailstables2" style="width: 100%">
                <tr>
                  <td>Prov. Fund</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['pf_own_deduct'],2); ?></td>
                </tr>
                <tr>
                  <td>VPF</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['vpf_deduct'],2); ?></td>
                </tr>
                <tr>
                  <td>Prof. Tax</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['prof_tax'],2); ?></td>
                </tr>
                <tr>
                  <td>LIC</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['lic'],2); ?></td>
                </tr>
                <?php if($value['hra_app']==1){ ?>
                  <?php if($value['hra_rent_deduct']>0){ ?>
                    <tr>
                      <td>House Rent</td>
                      <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['hra_rent_deduct'],2); ?></td>
                    </tr>
                  <?php } ?>
                  <?php if($value['hra_elect_deduct']>0){ ?>
                    <tr>
                      <td>Electricity</td>
                      <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['hra_elect_deduct'],2); ?></td>
                    </tr>
                  <?php } ?>
                  <?php if($value['hra_security_deduct']>0){ ?>
                    <tr>
                      <td>Security</td>
                      <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['hra_security_deduct'],2); ?></td>
                    </tr>
                  <?php } ?>
                  <?php if($value['hra_garage_deduct']>0){ ?>
                    <tr>
                      <td>Garage</td>
                      <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['hra_garage_deduct'],2); ?></td>
                    </tr>
                  <?php } ?>
                <?php } ?>
                <tr>
                  <td>Group Insur.</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['group_insurance_amt'],2); ?></td>
                </tr>
                <tr>
                  <td>Staff Welfare</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['staff_welfare_fund'],2); ?></td>
                </tr>
                <tr>
                  <td>TDS</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['tds_deduct'],2); ?></td>
                </tr>
                <tr>
                  <td>Medical</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['medical_deduct'],2); ?></td>
                </tr>
                <tr>
                  <td>Advance Recovery</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['advance_salary_deduct'],2); ?></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              
            </td>
            <td>
              <table class="detailstables2" style="width: 100%">
                <tr>
                  <td>Gross Payable (Rs.)</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['gross_salary'],2); ?></td>
                </tr>
              </table>
            </td>
            <td>
              <table class="detailstables2" style="width: 100%">
                <tr>
                  <td>Gross Deduction (Rs.)</td>
                  <td style="text-align: right;font-weight: bold;"><?php echo number_format($value['total_deduction'],2); ?></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td colspan="3" style="font-weight: bold;">Net Salary Rs. <?php echo number_format(($value['gross_salary']-$value['total_deduction']),2); ?></td>
          </tr>
        </table>
        <br>
        <p style="text-align: right;font-weight: bold;">
          Authorised Signatory
          <br>
         </p>
      </div>
    </div>
    <br><br><br><br>
    <?php if($cut>=3){ $cut = 0; ?>
        <div style="clear: all;page-break-after: always;"></div>
      <?php } ?>
  <?php } ?>
  </body>
</html>