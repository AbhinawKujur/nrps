 <html>
<head>
  <title>Deduction Report</title>
  <style>
    @page { margin: 120px 25px 50px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }

      .table {
        border-collapse: collapse;
        font-size: 10px;
        white-space: nowrap;
        width: 100%;
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
    <div style="text-align: center;">Monthly Deduction Report (<?php echo date('F',strtotime($year.'-'.$month.'-1')).'-'.$year; ?>)</div>
  </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
  <div id="content">
    <div>
      <table class="table">
        <thead>
          <tr>
            <th class="text-center thead-color" colspan="5"></th>
            <th class="text-center thead-color" colspan="14">Deduction</th>
          </tr>
          <tr>
            <th class="thead-color">S.No</th>
            <th class="thead-color">Pers. ID</th> 
            <th class="thead-color">Employee Name</th> 
            <th class="thead-color">Designation</th>  
            <th class="thead-color text-center">Payable<br>Amt. of <br>Basic</th>    
            <th class="thead-color text-center">PF</th>   
            <th class="thead-color text-center">VPF</th>  
            <th class="thead-color text-center">Prof.<br>Tax</th>  
            <th class="thead-color text-center">LIC</th>  
            <th class="thead-color text-center">House<br>Rent</th>
            <th class="thead-color text-center">Elect</th>
            <th class="thead-color text-center">Security</th>
            <th class="thead-color text-center">Garage</th>
            <th class="thead-color text-center">Group<br>Ins.<br>Amt.</th>
            <th class="thead-color text-center">Staff<br>Welf.<br>Fund</th>
            <th class="thead-color text-center">TDS</th>
            <th class="thead-color text-center">Medical</th>
            <th class="thead-color text-center">Bus</th>
            <th class="thead-color text-center">Adv.<br>Salary</th>
          </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($resultData as $key => $value) {  ?>
                <tr>
                    <td class="text-center"><?php echo $key + 1; ?></td>
                    <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                    <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                    <td><?php echo $value['DESIG']; ?></td>
                    <td class="text-right"><?php echo $value['basic_salary']; ?></td>
                    <td class="text-right"><?php echo $value['pf_own_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['vpf_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['prof_tax']; ?></td>
                    <td class="text-right"><?php echo $value['lic']; ?></td>
                    <td class="text-right"><?php echo $value['hra_rent_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['hra_elect_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['hra_security_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['hra_garage_deduct']; ?></td>
                    <td class="text-right"><?php echo number_format($value['group_insurance_amt'],2); ?></td>
                    <td class="text-right"><?php echo $value['staff_welfare_fund']; ?></td>
                    <td class="text-right"><?php echo $value['tds_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['medical_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['bus_deduction']; ?></td>
                    <td class="text-right"><?php echo $value['advance_salary_deduct']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  </body>
</html>