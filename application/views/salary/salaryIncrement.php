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
  .i{
    color: white !important;
  }
 </style>
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('employee/employee'); ?>">Payroll</a> <i class="fa fa-angle-right"></i> Arrear Salary</li>
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
                      <h4 class="text-center"><strong><?php echo date('F', strtotime(date($current_year.'-'. $current_month .'-d'))).'-'.$current_year; ?> Arrear Salary</strong></h4><hr>
                      <form method="post" action="<?php echo base_url('payroll/salary/second_shift/attendanceGen'); ?>">
                        <input type="hidden" name="current_month" value="<?php echo $current_month; ?>">
                        <input type="hidden" name="current_year" value="<?php echo $current_year; ?>">
                        <table class="table table-striped table-bordered dataTable">
                          <thead id="header-fixed">
                            <tr>
                              <th class="thead-color text-center">EMPID</th>
                              <th class="thead-color text-center">Employee Name</th>
                              <th class="thead-color text-center">Increment Month</th>
                              <th class="thead-color text-center">Increment Year</th>
                              <th class="thead-color text-center">Old Level</th>
                              <th class="thead-color text-center">Old Year</th>
                              <th class="thead-color text-center">Old Basic</th>
                              <th class="thead-color text-center">New Level</th>
                              <th class="thead-color text-center">New Year</th>
                              <th class="thead-color text-center">New Basic</th>
                              <th class="thead-color text-center">Verify</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(!empty($empData)) { ?>
                              <?php foreach ($empData as $key => $value) { ?>
                                <tr>
                                  <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                                  <td class="text-center"><?php echo strtoupper($value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']); ?></td>
                                  <td class="text-center"><?php echo $value['salary_increase_month_name']; ?></td>
                                  <td class="text-center"><?php echo $value['salary_increase_year']; ?></td>
                                  <td class="text-center"><?php echo $value['old_level_no']; ?></td>
                                  <td class="text-center"><?php echo $value['old_level_year']; ?></td>
                                  <td class="text-center"><?php echo $value['old_basic']; ?></td>
                                  <td class="text-center"><?php echo $value['new_level_no']; ?></td>
                                  <td class="text-center"><?php echo $value['new_level_year']; ?></td>
                                  <td class="text-center"><?php echo $value['new_basic']; ?></td>
                                  <td class="text-center">
                                    <a href="#" onclick="approveFun('<?php echo $value['id']; ?>')" class="btn-xs btn-success approv_<?php echo $value['id']; ?>"><i class="fa fa-check-circle-o i"></i> Approve</a>

                                    <span class="approved_<?php echo $value['id']; ?>" style="display: none;">Approved</span>
                                  </td>
                                </tr>
                              <?php } ?>
                            <?php } else { ?>
                              <tr>
                                <td colspan="11" class="text-center">No Data Available</td>
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

<script type="text/javascript">
  
  function approveFun(emp_tbl_id)
  {
    $.ajax({
      url:"<?php echo base_url('payroll/salary/salincrement/approveArrearSalary'); ?>",
      data:{emp_id:emp_tbl_id},
      dataType:"json",
      method:"post",
      beforeSend:function()
      {
        showLoader();
      },
      success:function(response)
      {
        hideLoader();
        if(response == 1)
        {
          $.toast({
              heading: 'Success',
              text: 'Approved Successfully',
              showHideTransition: 'slide',
              icon: 'success',
              position: 'top-right',
          });
          $('.approved_'+emp_tbl_id).show();
          $('.approv_'+emp_tbl_id).hide();
        }
        else
        {
          $.toast({
              heading: 'Error',
              text: 'Failed !',
              showHideTransition: 'slide',
              icon: 'error',
              position: 'top-right',
          });
        }
      }
    });
  }

    $(function () {
      $('.dataTable').DataTable({
        'paging'      : false,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : true,
        "bSortCellsTop": true,
        dom: 'Bfrtip',
            buttons: [
                'excel',
            ],
      })
    });
</script>