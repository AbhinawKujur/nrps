 <style type="text/css">
   .error{
    color: red;
   }
   .box-header>.box-tools {
        position: relative;
    }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
  .thead-color{
    background: #337ab7 !important; color: white !important;
  }
 </style>
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('employee/employee'); ?>">Monthly Entries</a> <i class="fa fa-angle-right"></i> Shift Attendance Generation</li>
</ol>
 <div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                    <div class="table-responsive">
                      <h4 class="text-center"><strong><?php echo date('F', strtotime(date($current_year.'-'. $current_month .'-d'))).'-'.$current_year; ?> Shift Attendance Generation</strong></h4><hr>
                      <form method="post" action="<?php echo base_url('payroll/salary/second_shift/attendanceGen'); ?>">
                        <input type="hidden" name="current_month" value="<?php echo $current_month; ?>">
                        <input type="hidden" name="current_year" value="<?php echo $current_year; ?>">
                        <table class="table table-striped table-bordered">
                          <thead id="header-fixed">
                            <tr>
                              <th class="thead-color">EMPID</th>
                              <th class="thead-color">Employee Name</th>
                              <th class="thead-color">Designation</th>
                              <th class="thead-color">Second Shift Amount</th>
                              <th class="thead-color">Shift Allowance</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(!empty($empData)) { ?>
                              <?php foreach ($empData as $key => $value) { ?>
                                <tr>
                                  <td><?php echo $value['EMPID']; ?></td>
                                  <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                                  <td><?php echo $value['DESIG']; ?></td>
                                  <td><input type="number" name="shift_amount_<?php echo $key; ?>" required="" value="<?php echo set_value(0,$value['shift_amount']); ?>"></td>
                                  <td><input type="text" name="shift_allowance_<?php echo $key; ?>" value="<?php echo set_value(0,number_format($value['shift_allowance_pay_control'])); ?>" readonly="" style="text-align: right;"></td>
                                </tr>
                              <?php } ?>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><button class="btn btn-success pull-right"><i class="fa fa-save" style="color: white;"></i> Save</button></td>
                              </tr>
                            <?php } else { ?>
                              <tr>
                                <td colspan="6" class="text-center">No Data Available</td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </form>
                    </div>
              </div>
            </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div><br><br>