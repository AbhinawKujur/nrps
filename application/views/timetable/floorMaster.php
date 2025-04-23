<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Timetable</a> <i class="fa fa-angle-right"></i> Floor Master</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;padding-top: 20px;">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <?php echo form_open('timetable/floormaster/create',array('role'=>'form','id'=>'createForm')); ?>
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Create Floor</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
                    <div class="form-group">
                      <label>Wing Name</label><span class="req">*</span>
                      <select class="form-control" name="wing_name" required="" id="wing_name">
                        <option value="">Select</option>
                        <?php foreach ($wingList as $key => $value) { ?>
                          <option value="<?php echo $value['ID']; ?>"><?php echo $value['NAME']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Floor Name</label><span class="req">*</span>
                      <input type="text" name="floor_name" class="form-control" id="floor_name" required="" style="text-transform: uppercase;" onchange="wingSelectFirst()" autocomplete="off">
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
                    <p class="box-title" style="font-weight: bold;">Floor List</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered dataTable table-striped">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">S.No.</th>
                          <th style="background: #337ab7; color: white !important;">Campus Name</th>
                          <th style="background: #337ab7; color: white !important;">Wing Name</th>
                          <th style="background: #337ab7; color: white !important;">Floor Name</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($floorList as $key => $value) { ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value['Campus_Name']; ?></td>
                            <td><?php echo $value['Wing_Name']; ?></td>
                            <td><?php echo $value['Floor_Name']; ?></td>
                            <td>
                              <a href="#" onclick="editFun(<?php echo $value['Floor_ID']; ?>)" class="btn-xs btn-black"><i class="fa fa-edit"></i> Edit </a>
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
        <h4 class="modal-title">Edit Floor</h4>
      </div>
      <?php echo form_open('timetable/floormaster/update',array('id'=>'editForm')); ?>
        <div class="modal-body">
          <div class="row"> 
            <input type="hidden" name="id" id="editID">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Wing Name</label><span class="req">*</span>
                <select class="form-control" name="wing_name" required="" id="edit_wing_name" onchange="clearFloorName()">
                  <option value="">Select</option>
                  <?php foreach ($wingList as $key => $value) { ?>
                    <option value="<?php echo $value['ID']; ?>"><?php echo $value['NAME']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Floor Name</label><span class="req">*</span>
                <input type="text" name="floor_name" class="form-control" id="edit_floor_name" required="" style="text-transform: uppercase;" onchange="editWingSelectFirst()" autocomplete="off">
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
            floor_name: {
                remote: {
                url: '<?php echo base_url('timetable/floormaster/checkName'); ?>',
                type: "post",
                data: {
                  floor_name: function() {
                    return $( "#floor_name" ).val();
                  },
                  wing_name: function() {
                    return $( "#wing_name" ).val();
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

function wingSelectFirst()
{
  var wing_name = $('#wing_name').val();
  if(wing_name=='')
  {
    alert('Please select wing first');
    $('#floor_name').val('');
  }
}

function editWingSelectFirst()
{
  var wing_name = $('#edit_wing_name').val();
  if(wing_name=='')
  {
    alert('Please select wing first');
    $('#edit_floor_name').val('');
  }
}

     //validation
$(document).ready(function () {

    $('#editForm').validate({ // initialize the plugin
        rules: {
            floor_name: {
                remote: {
                url: '<?php echo base_url('timetable/floormaster/checkNameatEdit'); ?>',
                type: "post",
                data: {
                  floor_name: function() {
                    return $( "#edit_floor_name" ).val();
                  },
                  wing_name: function() {
                    return $( "#edit_wing_name" ).val();
                  },
                  id: function() {
                    return $( "#editID" ).val();
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

function editFun(id)
{
  $('#editID').val(id);
  $.ajax({
      url: "<?php echo base_url('timetable/floormaster/getSingleData'); ?>",
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
        $('#edit_floor_name').val(response.Floor_Name);
        $('#edit_wing_name').val(response.Building_ID);
      }
    });
}

function clearFloorName()
{
  $('#edit_floor_name').val('');
}

  </script>