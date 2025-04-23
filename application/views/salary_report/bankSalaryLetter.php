 <style type="text/css">
   .table{
    font-size: 12px;
   }
   .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .thead-color{
    background: #abb0ac !important;
  }
 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <h4 style="text-align: center;font-weight: bold;">Bank Salary Letter - (<?php echo date('F',strtotime('01-'.$current_month.'-'.$current_year)).' - '.$current_year; ?>)</h4><hr>
    <?php if(!empty($payslipData)){ ?>
      <center>
      <a href="<?php echo base_url('salary_report/bank_letter/generatePDF'); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate and View Report</a></center>
    <?php } ?>
     <table class="table table-bordered table-striped table-hover datatable">
        <thead>
          <tr>
            <th class="thead-color text-center">S.No</th>
            <th class="thead-color text-center">Employee ID</th>  
            <th class="thead-color text-center">Employee Name</th>  
            <th class="thead-color text-center">Bank A/c</th>  
            <th class="thead-color text-center">Payable Amount</th>   
          </tr>
        </thead>
        <tbody>
            <?php 

            $total_amt = 0;
            foreach ($payslipData as $key => $value) {  ?>
                <tr>
                    <td class="text-center"><?php echo $key + 1; ?></td>
                    <td class="text-center"><?php echo filter_var($value['EMPID'],FILTER_SANITIZE_NUMBER_INT); ?></td>
                    <td class="text-center"><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                    <td><?php echo $value['BANK_AC_NO']; ?></td>
                    <td class="text-right"><?php echo number_format((float)$value['payable_amt'], 2, '.', ''); ?></td>
                </tr>
            <?php $total_amt = $total_amt + $value['payable_amt']; } ?>
        </tbody>
      </table>
      <br>
</div><br>
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
                title: 'Bank Salary Letter',
                              
              },
          ],
        })
      });
</script>