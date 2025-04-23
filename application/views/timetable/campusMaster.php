<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Timetable</a> <i class="fa fa-angle-right"></i> Campus Master</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;padding-top: 20px;">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <?php echo form_open('timetable/campusmaster/create',array('role'=>'form','id'=>'createForm')); ?>
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Create Campus</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
                    <div class="form-group">
                      <label>Name</label><span class="req">*</span>
                      <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" id="name" autocomplete="off" style="text-transform: uppercase;" required="">
                    </div>    
                  </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-black pull-right">Save</button>
                </div>
                </div>
              <?php echo form_close(); ?>
            </div>


            <div class="col-sm-8">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Campus List</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered dataTable table-striped">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">Name</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($campusList as $key => $value) { ?>
                          <tr>
                            <td><?php echo $value['Campus_Name']; ?></td>
                            <td>
                              <a href="#" onclick="editFun(<?php echo $value['Campus_ID']; ?>)" class="btn-xs btn-black"><i class="fa fa-edit"></i> Edit </a>
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

<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Campus</h4>
      </div>
      <?php echo form_open('timetable/campusmaster/update',array('id'=>'editForm')); ?>
        <div class="modal-body">
          <div class="row"> 
            <input type="hidden" name="id" id="editID">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Name</label><span class="req">*</span>
                <input type="text" name="name" class="form-control" autocomplete="off" style="text-transform: uppercase;" id="editName">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


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

     //validation
$(document).ready(function () {

    $('#createForm').validate({ // initialize the plugin
        rules: {
            name: {
                remote: {
                url: '<?php echo base_url('timetable/campusmaster/checkName'); ?>',
                type: "post",
                data: {
                  name: function() {
                    return $( "#name" ).val();
                  }
                }
              },
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

     //validation
$(document).ready(function () {

    $('#editForm').validate({ // initialize the plugin
        rules: {
            name: {
                remote: {
                url: '<?php echo base_url('timetable/campusmaster/checkNameatEdit'); ?>',
                type: "post",
                data: {
                  name: function() {
                    return $( "#editName" ).val();
                  },
                   id: function() {
                    return $( "#editID" ).val();
                  },
                }
              },
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

function editFun(id)
{
  $('#editID').val(id);
  $.ajax({
      url: "<?php echo base_url('timetable/campusmaster/getSingleData'); ?>",
      type: "POST",
      data: {id:id},
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        $('#editModal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $('#editName').val(response.Campus_Name);
      }
    });
}
  </script>