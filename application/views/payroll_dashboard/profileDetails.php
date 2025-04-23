<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
  }
   .loader {
      position: fixed;
      top: 50%;
      left: 50%;
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
      }

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
  .absent {
    background-color: #ff8793;
  }
  .present {
    background-color: #a3dba2;
  }
  .late_in {
    background-color: #ffb37c;
  }
  .before_out {
    background-color: #458ac6;
    color: white;
  }
  .late_in_before_out {
    background-color: #d61515;
    color: white;
  }
  .holiday {
    background-color: #e9eda6;
  }
  div.zabuto_calendar ul.legend>span
  {
    color: black;
    font-size: 15px;
    font-weight: bold;
  }
  .error{
    color: red;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">My Desk</a> <i class="fa fa-angle-right"></i> Profile Details</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div class="employee-dashboard">
    <div class="" style="padding-bottom: 20px;">
      <section class="content">
        <div class="row">
          <div class="col-sm-6">
            <table class="table table-stripped table-bordered" style="border: 1px solid #b2b9c4;padding-bottom: 20px;">
              <tr style="background: #b2b9c4;">
                <?php if($employeeData['profile_img'] == ''){ ?>
                  <td class="text-center" colspan="2"><img src="<?php echo base_url('assets/images/no_image.jpg'); ?>" class="img-circle" width="150" height="150" style="border: 2px solid #c6cad1;" alt="image"></td>
                <?php } else { ?>
                  <td class="text-center" colspan="2"><img src="<?php echo base_url($employeeData['profile_img']); ?>" class="img-circle" width="150" height="150" style="border: 2px solid #c6cad1;" alt="image"></td>
                <?php } ?>
              </tr>
              <tr>
               <th colspan="2" class="text-center"><?php echo $employeeData['EMPID']; ?></th>
              </tr>
               <tr>
               <th colspan="2" class="text-center"><?php echo strtoupper($employeeData['EMP_FNAME'].' ' .$employeeData['EMP_MNAME'].' ' .$employeeData['EMP_LNAME']); ?></th>
              </tr>
              <tr>
                <th>Designation</th>
                <td style="text-align: right;"><?php echo $employeeData['designation_name']; ?></td>
              </tr>
              <tr>
                <th>Role</th>
                <td style="text-align: right;"><?php echo $employeeData['role_name']; ?></td>
              </tr>
              <tr>
                <th>Mobile No</th>
                <td style="text-align: right;"><?php echo $employeeData['C_MOBILE']; ?></td>
              </tr>
              <tr>
                <th>Date of Birth</th>
                <td style="text-align: right;"><?php echo date("d-M-Y", strtotime($employeeData['D_O_B'])); ?></td>
              </tr>
              <tr>
                <th>Date of Joining</th>
                <td style="text-align: right;"><?php echo date("d-M-Y", strtotime($employeeData['D_O_J'])); ?></td>
              </tr>
              <tr>
                <th>Date of Retirement</th>
                <td class="text-right"><?php echo date("d-M-Y", strtotime($employeeData['D_O_RETIER'])); ?></td>
              </tr>
              <tr>
                <th>Email</th>
                <td style="text-align: right;"><?php echo $employeeData['C_EMAIL']; ?></td>
              </tr>
              <tr>
                <th>User Name</th>
                <td style="text-align: right;"><?php echo $login_data['username']; ?></td>
              </tr>
            </table>
          </div>

          <div class="col-sm-6">
            <table class="table table-stripped table-bordered" style="border: 1px solid #b2b9c4;margin-top: 10px;">
              <tr style="background: #b2b9c4;">
                <td colspan="2" style="font-weight: bold;font-size: 20px;">Update Data</td>
              </tr>
              <form method="post" action="<?php echo base_url('payroll/dashboard/dashboard/updateImage'); ?>" enctype="multipart/form-data">
                <tr>
                  <th>Update Image</th>
                  <td><input type="file" name="profile_img" class="form-control" required=""></td>
                </tr>
                <tr>
                  <td style="text-align: right;" colspan="2"><button class="btn btn-success"><i class="fa fa-upload" style="color: white;"></i> Upload Image</button></td>
                </tr>
              </form>
              <tr></tr>
              <tr></tr>
              <form method="post" action="<?php echo base_url('payroll/dashboard/dashboard/changeUserName'); ?>">
                <tr>
                  <th>Change Username</th>
                  <td><input type="text" name="username" class="form-control" required="" autocomplete="off"></td>
                </tr>
                <tr>
                  <td style="text-align: right;" colspan="2"><button class="btn btn-success"><i class="fa fa-save" style="color: white;"></i> Save</button></td>
                </tr>
              </form>
              <tr>
                <td colspan="2">
                  <?php if($this->session->flashdata('msg'))
                  {
                    echo $this->session->flashdata('msg');
                  } ?>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.box -->
      </section>
    </div>

</div><br><br>

<script type="text/javascript">

   $( document).ajaxComplete(function() {
      // Required for Bootstrap tooltips in DataTables
      $('[data-toggle="tooltip"]').tooltip({
          "html": true,
          "delay": {"show": 10, "hide": 0},
      });
  });
</script>