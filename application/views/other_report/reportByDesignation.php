 <style type="text/css">
     .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    color: black;
    font-size: 11px;
}
.thead-color{
  background: #abb0ac !important;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <h1 style="text-align: center;">Employee Report</h1><hr>
    <center>
      <a href="<?php echo base_url('payroll_other_report/designationreport/generateEmpReportPDF'); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate and View Report</a>
    </center>
      <div class="table-responsive">
        <table class="table table-striped table-hover datatable">
          <thead>
            <tr>
              <th class="text-center thead-color">S.No</th>
              <th class="thead-color text-center">Pers. ID</th>  
              <th class="thead-color text-center">Employee Name</th>  
              <th class="thead-color text-center">Mobile</th>  
              <th class="thead-color text-center">Email</th>  
              <th class="thead-color text-center">Gender</th>  
              <th class="thead-color text-center">Designation</th>  
              <th class="thead-color text-center">Staff Type</th>  
              <th class="thead-color text-center">Wing</th>    
              <th class="thead-color text-center">Basic Qual</th>    
              <th class="thead-color text-center">Master Qual</th>    
              <th class="thead-color text-center">Prof. Qual</th>    
              <th class="thead-color text-center">Level No</th>    
              <th class="thead-color text-center">Level Year</th>    
              <th class="thead-color text-center">Basic</th>    
              <th class="thead-color text-center">CL</th>    
              <th class="thead-color text-center">ML</th>    
              <th class="thead-color text-center">EL</th>    
            </tr>
          </thead>
          <tbody>
              <?php 
              foreach ($empData as $key => $value) {  ?>
                  <tr>
                      <td class="text-center"><?php echo $key + 1; ?></td>
                      <td class="text-center"><?php echo filter_var($value['EMPID'],FILTER_SANITIZE_NUMBER_INT); ?></td>
                      <td><strong><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></strong></td>
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
                      <td class="text-center"><?php echo $value['wing_name']; ?></td>
                      <td class="text-center"><?php echo $value['qualification_name']; ?></td>
                      <td class="text-center"><?php echo $value['masterqual_name']; ?></td>
                      <td class="text-center"><?php echo $value['profqual_name']; ?></td>
                      <td class="text-center"><?php echo $value['LEVEL_NO']; ?></td>
                      <td class="text-center"><?php echo $value['LEVEL_YEAR']; ?></td>
                      <td><?php echo $value['BASIC']; ?></td>
                      <td><?php echo $value['CAS_LEAVE']- $value['total_cl_leave_app']; ?></td>
                      <td><?php echo $value['ML']- $value['total_ml_leave_app']; ?></td>
                      <td><?php echo $value['EL']- $value['total_el_leave']; ?></td>
                  </tr>
              <?php } ?>
          </tbody>
        </table>
      </div>
      <br>
      <br>
</div>
<script type="text/javascript">
        $(function () {
        $('.datatable').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
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
</script>