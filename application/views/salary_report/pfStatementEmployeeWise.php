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
    <b>PF Statement Employee Wise</b>
      <hr>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
              <thead id="header-fixed">
                <tr> 
                 <th style="background: #337ab7 !important; color: white !important;text-align: center !important;">S.No.</th>
                  <th style="background: #337ab7 !important; color: white !important;text-align: center !important;">EMP ID</th>
                  <th style="background: #337ab7 !important; color: white !important;text-align: center !important;">Name</th>
                  <th style="background: #337ab7 !important; color: white !important;text-align: center !important;">Mobile</th>
                  <th style="background: #337ab7 !important; color: white !important;text-align: center !important;">Father's / Husband Name</th>
                  <th style="background: #337ab7 !important; color: white !important;text-align: center !important;">UAN Number</th>
                  <th style="background: #337ab7 !important; color: white !important;text-align: center !important;">PF A/c No</th>
                  <th style="background: #337ab7 !important; color: white !important;text-align: center !important;">Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  foreach ($resultList as $key => $value) {  $eps_wages=0; ?>
                      <tr>
                        <td style="text-align: center;"><?php echo $key+1; ?></td>
                        <td><?php echo $value['EMPID']; ?></td>
                        <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                        <td class="text-right"><?php echo $value['C_MOBILE']; ?></td>
                        <td class="text-right">
                          <?php if($value['FATHERS_NAME']){
                              echo $value['FATHERS_NAME'];
                            }else{
                              echo $value['G_NAME'];
                            } ?>
                        </td>
                        <td class="text-right"><?php echo $value['UANNO']; ?></td>
                        <td class="text-right"><?php echo $value['PF_AC_NO']; ?></td>
                        <td class="text-right"><a href="<?php echo base_url('salary_report/pfstatement/generatePDF/'.$value['id']); ?>" class="btn btn-xs btn-success" target="_blank"><i style="color: white;" class="fa fa-file-pdf-o"></i> Generate Report</a></td>
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
                title: 'Montly PF Statement',
                              
              },
              {
                extend: 'pdfHtml5',
                title: 'Montly PF Statement',
                              
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