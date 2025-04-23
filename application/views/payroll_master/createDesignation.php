<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Designation</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <form role="form" action="<?php echo base_url('payroll/master/designation'); ?>" method="post" enctype="multipart/form-data">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Create Designation</h3><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
                    <div class="form-group">
                      <label>Designation</label><span class="req">*</span>
                      <input type="text" name="designation" class="form-control" value="<?php echo set_value('designation'); ?>"  autocomplete="off" style="text-transform: uppercase;">
                      <span class="validation_error"><?php echo form_error('designation'); ?></span>
                    </div> 
                    <div class="form-group">
                      <label>Print Position</label><span class="req">*</span>
                      <input type="text" name="print_position" class="form-control" value="<?php echo set_value('print_position'); ?>"  autocomplete="off">
                      <span class="validation_error"><?php echo form_error('print_position'); ?></span>
                    </div>    
                  </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-black pull-right">Save</button>
                </div>
                </div>
              </form>
            </div>


            <div class="col-sm-8">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Designation List</h3><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered dataTable table-striped">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">Designation</th>
                          <th style="background: #337ab7; color: white !important;">Print Position</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($designation as $key => $value) { ?>
                          <tr>
                            <td><?php echo $value['DESIG']; ?></td>
                            <td><?php echo $value['print_position']; ?></td>
                            <td>
                              <a href="<?php echo base_url('payroll/master/designation/update/').$value['Sno']; ?>" class="btn-xs btn-black"><i class="fa fa-edit"></i> Edit </a> &nbsp; &nbsp;
                              <a href="<?php echo base_url('payroll/master/designation/delete/').$value['Sno']; ?>" onclick="return confirm('Do you want delete this record')" class="btn-xs btn-danger"><i class="fa fa-trash"></i> Delete </a>
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
</div><br><br>
  <script type="text/javascript">

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })
  });
  </script>