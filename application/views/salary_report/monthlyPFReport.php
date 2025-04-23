 <style type="text/css">
     .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
      white-space: nowrap;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    color: black;
    font-size: 11px;
}
.thead-color{
  background: #337ab7 !important; color: white !important;text-align: center !important;
}

 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <b>Monthly PF Statement</b>
      <hr>
     <form id="searchForm" method="post" action="<?php echo base_url('salary_report/monthlypf_report'); ?>">
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
      <?php if(isset($resultList) && !empty($resultList)){ ?>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
              <thead id="header-fixed">
                <tr> 
                  <th class="thead-color"></th>
                  <th class="thead-color"></th>
                  <th class="thead-color" colspan="4">Wages</th>
                  <th class="thead-color" colspan="4">Contibution<br> Remitted</th>
                  <th class="thead-color"></th>
                </tr>
                <tr> 
                 <th class="thead-color">UAN Number</th>
                  <th class="thead-color">UAN<br>Repository</th>
                  <th class="thead-color">Gross</th>
                  <th class="thead-color">EPF</th>
                  <th class="thead-color">EPS</th>
                  <th class="thead-color">EDLI</th>
                  <th class="thead-color">EPF<br> Cont.<br> Remitted</th>
                  <th class="thead-color">EPS<br>Cont.<br>Remitted</th>
                  <th class="thead-color">EPF<br>EPS<br>Diff<br>Remitted</th>
                  <th class="thead-color">NCP Days</th>
                  <th class="thead-color">Refunds</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  foreach ($resultList as $key => $value) {  $eps_wages=0; ?>
                      <tr>
                        <td><?php echo $value['UANNO']; ?></td>
                        <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                        <td class="text-right"><?php echo $epf_wages = $value['gross_salary']; ?></td>
                        <td class="text-right"><?php echo $value['basic_salary']; ?></td>
                        <td class="text-right"><?php if($value['basic_salary'] > 15000){
                          echo $eps_wages = "15000";
                        }else
                        {
                          echo $eps_wages = $value['basic_salary'];
                        } ?></td>
                        <td class="text-right"><?php echo $eps_wages; ?></td>
                        <td class="text-right"><?php echo $epf_cont = $value['pf_own_deduct']; ?></td>
                        <td class="text-right"><?php echo  $eps_cont = round(($eps_wages*$value['pension_rate'])/100); ?></td>
                        <td class="text-right"><?php echo $epf_cont - $eps_cont; ?></td>
                        <!-- <td class="text-right"><?php echo $value['total_working_days'] - $value['total_present']; ?></td> -->
                        <td class="text-right"><?php echo 0; ?></td>
                        <td class="text-right"><?php echo 0; ?></td>
                      </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
          <br>
      <?php } else { ?>
        <div class="row">
          <div class="col-sm-12">
            <?php if($this->session->flashdata('msg')){
              echo $this->session->flashdata('msg');
            } ?>
          </div>
        </div>
      <?php } ?>
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
              {
                extend: 'csvHtml5',
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