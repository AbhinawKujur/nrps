<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Leave Type</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <form role="form" action="<?php echo base_url('payroll/master/leavetype/update/').$singleData['id']; ?>" method="post">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Edit Leave Type</h3><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
                   <div class="form-group">
                      <label>Name</label><span class="req">*</span>
                      <select name="name" class="form-control">
                        <option value="">Select Leave Type</option>
                        <?php foreach ($leaveTypes as $key => $value) { ?>
                          <option value="<?php echo $key; ?>" <?php if(set_value('name',$singleData['name'])==$key){ echo "selected"; } ?>><?php echo $value; ?></option>
                        <?php } ?>
                      </select>
                      <span class="validation_error"><?php echo form_error('name'); ?></span>
                    </div>   
                    <div class="form-group">
                      <label>Applicable For</label><span class="req">*</span>
                      <select class="form-control" name="applicable_for">
                        <option>Select</option>
                        <?php foreach ($applicablefor as $key => $value) { ?>
                          <option value="<?php echo $key; ?>" <?php if(set_value('applicable_for',$singleData['applicable_for'])==$key){ echo "selected"; } ?>><?php echo $value; ?></option>
                        <?php } ?>
                      </select>
                      <span class="validation_error"><?php echo form_error('applicable_for'); ?></span>
                    </div>   
                    <div class="form-group">
                      <label>No of Days</label><span class="req">*</span>
                      <input type="text" name="no_of_days" class="form-control" value="<?php echo set_value('no_of_days',$singleData['no_days']); ?>"  autocomplete="off">
                      <span class="validation_error"><?php echo form_error('no_of_days'); ?></span>
                    </div>
                  </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-black pull-right">Update</button>
                </div>
                </div>
              </form>
            </div>


            <div class="col-sm-8">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Leave Type List</h3><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered dataTable">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">Name</th>
                          <th style="background: #337ab7; color: white !important;">Applicable For</th>
                          <th style="background: #337ab7; color: white !important;">No of Days</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($leavetype as $key => $value) { ?>
                          <tr>
                            <td><?php echo $leaveTypes[$value['name']]; ?></td>
                            <td><?php echo $applicablefor[$value['applicable_for']]; ?></td>
                            <td><?php echo $value['no_days']; ?></td>
                            <td>
                              <a href="<?php echo base_url('payroll/master/leavetype/update/').$value['id']; ?>" class="btn-xs btn-black"><i class="fa fa-edit"></i> Edit </a> &nbsp; &nbsp;
                              <a href="<?php echo base_url('payroll/master/leavetype/delete/').$value['id']; ?>" onclick="return confirm('Do you want delete this record')" class="btn-xs btn-danger"><i class="fa fa-trash"></i> Delete </a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>    
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