 <style type="text/css">
     .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
    .table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    color: black;
    font-size: 11px;
}
.thead-color{
  background: #abb0ac !important;
}
 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <h1 style="text-align: center;">Allowance Report</h1><hr>
   <form id="searchForm" method="post" action="<?php echo base_url('payroll_other_report/allowance_report'); ?>">
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>Month and Year</label><span class="req"> *</span>
              <input type="text" name="date" class="form-control datepicker" id="date" autocomplete="off" value="<?php echo set_value('date'); ?>" required="">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label></label>
              <button type="submit" class="btn btn-success form-control" name="search"><i class="fa fa-search"></i> Search</button>
            </div>
          </div>
        </div>
      </form>
      <hr>
     
      <?php if(isset($resultData)){ ?>
        <center>
            <a href="<?php echo base_url('payroll_other_report/allowance_report/generatePDFReport/'.$year.'/'.$month); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate and View Report</a>
        </center>
          <div class="table-responsive">
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
          <br>
          <br>
      <?php }else{  ?>

        <?php if($this->session->flashdata('msg')){
          echo $this->session->flashdata('msg');
        } } ?>
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
                title: 'Allowance Report',
                              
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