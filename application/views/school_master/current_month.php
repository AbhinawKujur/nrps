<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
  }
  .error{
    color: red;
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
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">General Setting </a> <i class="fa fa-angle-right"></i> Active Month for Payroll</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg'))
                    {
                      echo $this->session->flashdata('msg');
                    } ?>
                    <div class="row">
                      <div class="col-sm-4">
                        <form method="post" action="<?php echo base_url('school_master/setting/activeCurrentMonth'); ?>">
                          <div class="form-group">
                            <label>Month</label>
                            <select class="form-control" name="month">
                              <?php foreach ($monthList as $key => $value) { ?>
                                <option value="<?php echo $value['month_code']; ?>" <?php if($value['active_month'] == 1){ echo "selected"; } ?>><?php echo $value['month_name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<br><br>
