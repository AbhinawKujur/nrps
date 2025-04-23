 <style type="text/css">
     .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    color: black;
    font-size: 12px;
}
 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <b>Yearly Salary Report</b><hr>
      <hr>
     
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
              <thead>
                <tr>
                  <th style="background: #337ab7 !important; color: white !important;text-align: center;">S.No</th>
                  <th style="background: #337ab7 !important; color: white !important;">Employee ID</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Employee Name</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Mobile</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Email</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Gender</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Designation</th>  
                  <th style="background: #337ab7 !important; color: white !important;">Action</th>  
                </tr>
              </thead>
              <tbody>
                  <?php 
                  foreach ($employeeList as $key => $value) {  ?>
                      <tr>
                          <td style="text-align: center;"><?php echo $key + 1; ?></td>
                          <td><?php echo $value['EMPID']; ?></td>
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
                          <td><?php echo $value['DESIG']; ?></td>
                          <td>
                            <a href="<?php echo base_url('payroll_other_report/yearly_salary_report/generateSalaryPDFReport/'.$value['id']); ?>" class="btn btn-xs btn-success" target="_blank"><i class="fa fa-file-pdf-o" style="color: white;"></i> Generate Salary Report</a>
                          </td>
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