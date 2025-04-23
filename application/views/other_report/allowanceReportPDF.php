 <html>
<head>
  <title>Allowance Report</title>
  <style>
    @page { margin: 120px 25px 50px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }

        .table {
          border-collapse: collapse;
          font-size: 10px;
          width: 100%;
          white-space: nowrap;
        }

        .table, th, td {
          border: 1px solid black;
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
           border-color: black !important;
        }
  </style>
</head>
<body>
  <header id="header">
    <div style="text-align: center;">
      <span style="font-size: 25px;font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span>
      <br><span><?php echo $school_setting['School_Address'] ?> </span><br>
    </div>
    <div style="text-align: center;">Monthly Allowance Report (<?php echo date('F',strtotime($year.'-'.$month.'-1')).'-'.$year; ?>)</div>
  </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
  <div id="content">
    <div>
      <table class="table table-bordered table-striped table-hover datatable">
              <thead>
                <tr>
                  <th colspan="12" class="text-center thead-color"></th>
                  <th colspan="6" class="text-center thead-color">Arrear Salary</th>
                  <th class="text-center thead-color"></th>
                </tr>
                <tr>
                  <th class="thead-color text-center">S.No</th>
                  <th class="thead-color">Pers. ID</th> 
                  <th class="thead-color">Employee Name</th> 
                  <th class="thead-color">Designation</th>  
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
                </tr>
              </thead>
              <tbody>
                  <?php 
                  foreach ($resultData as $key => $value) {  ?>
                      <tr>
                          <td style="text-align: center;"><?php echo $key + 1; ?></td>
                          <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                          <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                          <td><?php echo $value['DESIG']; ?></td>
                          <td class="text-right"><?php echo $value['basic_salary']; ?></td>
                          <td class="text-right"><?php echo $value['da_pay']; ?></td>
                          <td class="text-right"><?php echo $value['hra_pay']; ?></td>
                          <td class="text-right"><?php echo $value['ta_pay']; ?></td>
                          <td class="text-right"><?php echo $value['fixed_allowance']; ?></td>
                          <td class="text-right"><?php echo $value['second_shift_amount']; ?></td>
                          <td class="text-right"><?php echo $value['medical_reimbursement']; ?></td>
                          <td class="text-right"><?php echo $value['sh_rent']; ?></td>
                          <td class="text-right"><?php echo $value['arrear_basic']; ?></td>
                          <td class="text-right"><?php echo $value['arrear_da']; ?></td>
                          <td class="text-right"><?php echo $value['arrear_hra']; ?></td>
                          <td class="text-right"><?php echo $value['arrear_ta']; ?></td>
                          <td class="text-right"><?php echo $value['arrear_fixed_allow']; ?></td>
                          <td class="text-right"><?php echo $value['arrear_shift_allow']; ?></td>
                          <td class="text-right"><?php echo $value['gross_salary']; ?></td>
                      </tr>
                  <?php } ?>
              </tbody>
            </table>
    </div>
  </div>
  </body>
</html>