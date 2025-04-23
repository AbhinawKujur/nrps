 <style type="text/css">
     .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    color: black;
    font-size: 11px;
}
  .table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
.thead-color{
  background: #abb0ac !important;
}
 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <h1 style="text-align: center;">Deduction Report</h1><hr>
   <form id="searchForm" method="post" action="<?php echo base_url('payroll_other_report/deduction_report'); ?>">
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
            <a href="<?php echo base_url('payroll_other_report/deduction_report/generatePDFReport/'.$year.'/'.$month); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate and View Report</a>
        </center>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
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
                title: 'Deduction Report',
                              
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