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
    <b>Group Insurance Report</b>
      <hr>
     <?php echo form_open('salary_report/groupinsreport',array('id'=>'searchForm')); ?>
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
      <?php echo form_close(); ?>
      <hr>
      <?php if(isset($resultList) && !empty($resultList)){ ?>
        <div class="text-center">
          <a href="<?php echo base_url('salary_report/groupinsreport/generatePDFReport'); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate PDF Report</a>
        </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
              <thead id="header-fixed">
                <tr> 
                  <th class="thead-color text-center">Sl. No.</th>
                  <th class="thead-color">Pers. No.</th>
                  <th class="thead-color">Employee Name</th>
                  <th class="thead-color text-center">Policy amount</th>
                  <th class="thead-color text-center">Amt. Rs.</th>
                </tr>
              </thead>
              <tbody>
                  <?php  $i = 1;
                  foreach($resultList as $key => $value) {  ?>
                      <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                        <td class="text-center"><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                        <td class="text-right"><?php echo $value['INSURANCE_AMT']; ?></td>
                        <td class="text-right"><?php echo number_format($value['group_insurance_amt'],2); ?></td>
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
 <br>
          <br>

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
                title: 'Group Insurance Report',
                              
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