<style type="text/css">
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Qualification</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;">
 <div class="row">
  <div class="col-sm-12">
    <div class="" style="padding-bottom: 20px;">
      <section class="content">
        <div class="row">
          <div class="col-sm-4">
            <form role="form" action="<?php echo base_url('payroll/master/qualification'); ?>" method="post" enctype="multipart/form-data" id="qualification_view">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Create Qualification</h3><hr>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <?php if($this->session->flashdata('msg')){ 
                    echo $this->session->flashdata('msg');
                   } ?>
                  <div class="form-group">
                    <label>Qualification</label><span class="req">*</span>
                    <select class="form-control dynamicSelect2" name="qualification">
                      <option value="">Select Qualification</option>
                      <?php foreach ($qualification as $key => $value) { ?>
                        <option value="<?php echo $value['qualification']; ?>" <?php if(set_value('qualification')==$value['qualification']){ echo "selected"; } ?>><?php echo $value['qualification']; ?></option>
                      <?php } ?>
                    </select>
                    <span class="validation_error"><?php echo form_error('qualification'); ?></span>
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
                  <h3 class="box-title">Qualification List</h3><hr>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered dataTable">
                    <thead style="background: #d2d6de;">
                      <tr>
                        <th style="background: #337ab7; color: white !important;">Qualification</th>
                        <th style="background: #337ab7; color: white !important;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($qualification as $key => $value) { ?>
                        <tr>
                          <td><?php echo $value['qualification']; ?></td>
                          <td>
                            <a href="<?php echo base_url('payroll/master/qualification/update/').$value['Sno']; ?>" class="btn-xs btn-black"><i class="fa fa-edit"></i> Edit </a> &nbsp; &nbsp;
                            <a href="<?php echo base_url('payroll/master/qualification/delete/').$value['Sno']; ?>" onclick="return confirm('Do you want delete this record')" class="btn-xs btn-danger"><i class="fa fa-trash"></i> Delete </a>
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
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
  </script>

   <script>
      //   $(document).ready(function() {
      //     $('#qualification_view').bootstrapValidator({
      //         // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      //         container: 'tooltip',
      //         feedbackIcons: {
      //             valid: 'glyphicon glyphicon-ok',
      //             invalid: 'glyphicon glyphicon-remove',
      //             validating: 'glyphicon glyphicon-refresh'
      //         },
      //         fields: {
      //             qualification: {
      //                 validators: {
      //                      regexp: {
      //                        regexp: /^[a-z/0-9/@()&/.//\s]+$/i,
      //                   message: 'It accepts alphabetical and numerical values and @ / and dot symbol only'
      //                     },
      //                 }
      //             },
      //            }
      //         })
      //         .on('success.form.bv', function(e) {
      //                 $('#qualification_view').data('bootstrapValidator').resetForm();

      //             // Prevent form submission
      //             e.preventDefault();

      //             // Get the form instance
      //             var $form = $(e.target);

      //             // Get the BootstrapValidator instance
      //             var bv = $form.data('bootstrapValidator');

      //             // Use Ajax to submit form data
      //             $.post($form.attr('action'), $form.serialize(), function(result) {
      //                 console.log(result);
      //             }, 'json');
      //         });
      // });
    </script>
    <script type="text/javascript">
      $(".dynamicSelect2").select2({
          tags: true
        });
    </script>