<html>
<head>
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
      <div style="text-align: center;">Monthly Leave Report (<?php echo date('F',strtotime($year.'-'.$month.'-1')).'-'.$year; ?>)</div>
    </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
  <div id="content">  
    <div>
    <table class="table table-bordered table-striped table-hover datatable">
          <thead>
            <tr>
              <th class="text-center thead-color">S.No</th>
              <th class="thead-color text-center">Pers. ID</th>
              <th class="text-center thead-color">Employee Name</th>  
              <th class="text-center thead-color">Designation</th>  
              <?php for ($i=1; $i <= $total_days; $i++) { 
                $date = $year.'-'.$month.'-'.$i;
                ?>
                <th class="text-center thead-color"><?php echo $i.'<br> '.date("D", strtotime($date)); ?></th>
              <?php } ?>    
              <th class="text-center thead-color">Working<br>Days</th>  
              <th class="text-center thead-color">Present<br>Days</th>  
              <th class="text-center thead-color">Absent<br>Days</th>  
            </tr>
          </thead>
          <tbody>
              <?php 
              foreach ($attendaceData as $key => $value) {  $total_present = 0;$total_absent = 0;?>
                  <tr>
                      <td class="text-center"><?php echo $key + 1; ?></td>
                      <td class="text-center"><?php echo filter_var($value['EMPID'],FILTER_SANITIZE_NUMBER_INT); ?></td>
                      <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                      <td><?php echo $value['designation']; ?></td>
                      <?php for ($i=1; $i <= $total_days; $i++) { ?>
                        <td class="text-center">
                        <?php 
                          if($value[$i] == 'P' || $value[$i] == 'ELW')
                          {
                            $total_present += 1;
                          }elseif($value[$i] =='HD')
                          {
                            $total_present += 0.5;
                          }elseif($value[$i] =='HPL')
                          {
                            echo '<strong><span style="color:#418530;">'.$value[$i].'</span></strong>';
                            $total_present += 0.5;
                          }elseif($value[$i] == 'CL' || $value[$i] =='ML'||$value[$i] == 'EL'||$value[$i] == 'DDL')
                          {
                            echo '<strong><span style="color:#8a3e46;">'.$value[$i].'</span></strong>';
                            $total_present += 1;
                          }
                          elseif($value[$i]=='H')
                          {
                            $total_present += 1;
                          }
                          elseif($value[$i] == 'AB' || $value[$i] == 'LWP')
                          {
                            $total_absent += 1;
                          }
                         ?>
                         </td>
                      <?php } ?> 
                      <td class="text-center"><?php echo $total_days; ?></td>
                      <td class="text-center"><?php echo $total_present; ?></td>
                      <td class="text-center"><?php echo $total_absent; ?></td>
                  </tr>
              <?php } ?>
          </tbody>
        </table>
    </div>

</div>
</body>
</html>