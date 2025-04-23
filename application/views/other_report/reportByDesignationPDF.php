<html>
<head>
  <style>
     @page { margin: 120px 25px 50px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }

      .table {
        border-collapse: collapse;
        font-size: 11px;
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
    <div style="text-align: center;">Employee List </div>
  </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
  <div id="content">
    <div class="table-responsive">
      <table class="table" style="width: 100%;">
        <thead>
          <tr>
            <th class="text-center thead-color">S.No</th>
            <th class="thead-color text-center">Pers. ID</th>
            <th class="text-center thead-color">Employee Name</th>  
            <th class="text-center thead-color">Mobile</th>  
            <th class="text-center thead-color">Email</th>  
            <th class="text-center thead-color">Gender</th>  
            <th class="text-center thead-color">Designation</th>  
            <th class="text-center thead-color">Staff Type</th>  
            <th class="text-center thead-color">Wing</th>    
            <th class="text-center thead-color">Basic Qual</th>    
            <th class="text-center thead-color">Master Qual</th>    
            <th class="text-center thead-color">Prof. Qual</th>    
            <th class="text-center thead-color">Level No</th>    
            <th class="text-center thead-color">Level Year</th>    
            <th class="text-center thead-color">Basic</th>    
            <th class="text-center thead-color">CL</th>    
            <th class="text-center thead-color">ML</th>    
            <th class="text-center thead-color">EL</th>    
          </tr>
        </thead>
        <tbody>
            <?php 
            
            foreach ($empData as $key => $value) {  ?>
                <tr>
                    <td style="text-align: center;"><?php echo $key + 1; ?></td>
                    <td class="text-center"><?php echo filter_var($value['EMPID'],FILTER_SANITIZE_NUMBER_INT); ?></td>
                    <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                    <td><?php echo $value['C_MOBILE']; ?></td>
                    <td><?php echo $value['C_EMAIL']; ?></td>
                    <td><?php if($value['SEX'] == 1)
                    {
                        echo "Male";
                    }elseif ($value['SEX'] == 2) {
                        echo "Female";
                    }else
                    {
                        echo "Other";
                    } ?></td>
                    <td><?php echo $value['designation']; ?></td>
                    <td><?php if($value['STAFF_TYPE'] !='')
                    {
                      echo $staffType[$value['STAFF_TYPE']];
                    } ?></td>
                    <td><?php echo $value['wing_name']; ?></td>
                    <td><?php echo substr($value['qualification_name'],0,15); ?></td>
                    <td><?php echo substr($value['masterqual_name'],0,15); ?></td>
                    <td><?php echo substr($value['profqual_name'],0,15); ?></td>
                    <td><?php echo $value['LEVEL_NO']; ?></td>
                    <td><?php echo $value['LEVEL_YEAR']; ?></td>
                    <td><?php echo $value['BASIC']; ?></td>
                    <td><?php echo $value['CAS_LEAVE']- $value['total_cl_leave_app']; ?></td>
                    <td><?php echo $value['ML']- $value['total_ml_leave_app']; ?></td>
                    <td><?php echo $value['EL']- $value['total_el_leave']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>
</div>
</body>
</html>