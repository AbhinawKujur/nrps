<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Separated Employee</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-stripped table-bordered dataTable">
                    <thead>
                      <tr>
                        <th style="background: #337ab7; color: white !important;">Employee ID</th>
                        <th style="background: #337ab7; color: white !important;">Name</th>
                        <th style="background: #337ab7; color: white !important;">Date Of Joining</th>
                        <th style="background: #337ab7; color: white !important;">Date of Birth</th>
                        <th style="background: #337ab7; color: white !important;">Gender</th>
                        <th style="background: #337ab7; color: white !important;">Role</th>
                        <th style="background: #337ab7; color: white !important;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($employeeDetails as $key => $value) { ?>
                        <tr>
                          <td><?php echo $value['EMPID']; ?></td>
                          <td><?php echo $value['EMP_FNAME'] . ' ' .$value['EMP_MNAME'].' ' .$value['EMP_LNAME'] ; ?></td>
                          <td><?php echo date("d-M-Y", strtotime($value['D_O_J'])); ?></td>
                          <td><?php echo date("d-M-Y", strtotime($value['D_O_B'])); ?></td>
                          <td><?php echo $gender[$value['SEX']]; ?></td>
                          <td><?php echo $value['Role_name']; ?></td>
                          <td>
                            <a href="<?php echo base_url('employee/employee/view/').$value['id']; ?>" class="btn-xs btn-black"><i class="fa fa-bars"></i></a> &nbsp; &nbsp; 
                            <!-- <a href="<?php echo base_url('employee/employee/update/').$value['id']; ?>" class="btn-xs btn-danger"><i class="fa fa-edit"></i></a> -->
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<br><br>
   <script type="text/javascript">

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
  </script>