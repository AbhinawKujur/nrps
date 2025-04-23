<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Timetable</a> <i class="fa fa-angle-right"></i> Floor Class Distribution</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;padding-top: 20px;">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <?php echo form_open('timetable/floorclassdistribution/create',array('role'=>'form','id'=>'createForm')); ?>
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Create Room No With Class</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
                    <div class="form-group">
                      <label>Wing Name</label><span class="req">*</span>
                      <select class="form-control" name="wing_name" required="" id="wing_name" onchange="getFloor();clearAll()">
                        <option value="">Select</option>
                        <?php foreach ($wingList as $key => $value) { ?>
                          <option value="<?php echo $value['ID']; ?>"><?php echo $value['NAME']; ?></option>
                        <?php } ?>
                      </select>
                      <span class="error"><?php echo form_error('wing_name'); ?></span>
                    </div>
                    <div class="form-group">
                      <label>Floor Name</label><span class="req">*</span>
                      <select class="form-control" name="floor_name" required="" id="floor_name" onchange="clearRoomNo()">

                      </select>
                      <span class="error"><?php echo form_error('floor_name'); ?></span>
                    </div>  
                    <div class="form-group">
                      <label>Class - Section</label><span class="req">*</span>
                      <select class="form-control select2" name="class_name_Roman" required="" id="class_name_Roman" style="width: 100%;">
                        <option value="">Select</option>
                        <?php foreach ($classSecList as $key => $value) { ?>
                          <option value="<?php echo $value['Class_name_Roman']; ?>"><?php echo $value['Class_name_Roman']; ?></option>
                        <?php } ?>
                      </select>
                      <span class="error"><?php echo form_error('class_name_Roman'); ?></span>
                    </div>  
                    <div class="form-group">
                      <label>Room No</label><span class="req">*</span>
                      <input type="text" name="room_no" id="room_no" class="form-control" autocomplete="off" style="text-transform: capitalize;" required="">
                      <span class="error"><?php echo form_error('room_no'); ?></span>
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
                    <p class="box-title" style="font-weight: bold;">Floor Class Distribution List</p><hr>
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
                          <th style="background: #337ab7; color: white !important;">Alloted Class</th>
                          <th style="background: #337ab7; color: white !important;">Room No</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($roomList as $key => $value) { ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value['Campus_Name']; ?></td>
                            <td><?php echo $value['Wing_Name']; ?></td>
                            <td><?php echo $value['Floor_Name']; ?></td>
                            <td><?php echo $value['Alloted_Class']; ?></td>
                            <td><?php echo $value['Room_Name']; ?></td>
                            <td>
                              <a href="#" onclick="deleteFun(<?php echo $value['Room_ID']; ?>)" class="btn-xs btn-danger"><i class="fa fa-trash"></i> Remove </a>
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

     //validation
$(document).ready(function () {

    $('#createForm').validate({ // initialize the plugin
        rules: {
            room_no: {
                remote: {
                url: '<?php echo base_url('timetable/floorclassdistribution/checkRoomNo'); ?>',
                type: "post",
                data: {
                  floor_name: function() {
                    return $( "#floor_name" ).val();
                  },
                  wing_name: function() {
                    return $( "#wing_name" ).val();
                  },
                   room_no: function() {
                    return $( "#room_no" ).val();
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

function clearAll()
{
  $('#floor_name').val('');
  $('#room_no').val('');
}

function clearRoomNo()
{
  $('#room_no').val('');
}

$('.select2').select2();


function getFloor()
{
  var wing_id = $('#wing_name').val();
  var div_data = '<option value="">Select</option>';
  $.ajax({
    url:'<?php echo base_url('timetable/floorclassdistribution/getFloor'); ?>',
    method:"post",
    data:{wing_id:wing_id},
    dataType:"json",
    success:function(response)
    {
      $.each(response,function(key,val){
        div_data += '<option value="'+val.Floor_ID+'">'+val.Floor_Name+'</option>';
      });
      $('#floor_name').html(div_data);
    }
  });
}

function deleteFun(id)
{
  if(confirm('Do you want to remove this record?'))
  {
    $.ajax({
        url:'<?php echo base_url('timetable/floorclassdistribution/deleteRecord'); ?>',
        method:"post",
        data:{id:id},
        dataType:"json",
        success:function(response)
        {
          if(response == 1)
          {
            $.toast({
                  heading: 'Success',
                  text: 'Removed Successfully',
                  showHideTransition: 'slide',
                  icon: 'success',
                  position: 'top-right',
              });
            window.setTimeout(function(){location.reload()},1000);
          }
          else if(response == 2)
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
}

  </script>