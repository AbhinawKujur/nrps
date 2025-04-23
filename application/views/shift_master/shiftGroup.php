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
   <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Shift Master</li>
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
                    <a href="#" class="btn btn-black" onclick="addNewShift()"><i class="fa fa-plus"></i> Add Shift</a><br><br>
                    <table class="table table-bordered dataTable">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">Sr. No</th>
                          <th style="background: #337ab7; color: white !important;">Shift Name</th>
                          <th style="background: #337ab7; color: white !important;">Short Name</th>
                          <th style="background: #337ab7; color: white !important;">Start Time</th>
                          <th style="background: #337ab7; color: white !important;">End Time</th>
                          <th style="background: #337ab7; color: white !important;">Shift Duration</th>
                          <th style="background: #337ab7; color: white !important;">Min Hour Half Day</th>
                          <th style="background: #337ab7; color: white !important;">Min Hour Full Day</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; foreach ($shiftMaster as $key => $value) { ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['SHIFT_NAME']; ?></td>
                            <td><?php echo $value['SHORT_NAME']; ?></td>
                            <td><?php echo $value['START_TIME']; ?></td>
                            <td><?php echo $value['STOP_TIME']; ?></td>
                            <td><?php echo $value['SHIFT_DURATION']; ?></td>
                            <td><?php echo $value['MIN_HRS_HALF']; ?></td>
                            <td><?php echo $value['MIN_HRS_FULL']; ?></td>
                            <td>
                              <a href="#" class="btn-xs btn-black" data-toggle="tooltip" title="Edit" onclick="editShift('<?php echo $value['ID']; ?>')"><i class="fa fa-pencil-square-o"></i> </a>
                            </td>
                          </tr>
                        <?php $i++; } ?>
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

<div class="modal fade" id="addNewShiftModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Shift</h4>
      </div>
      <form id="addNewShift">
        <div class="modal-body">
          <div class="row"> 
            <div class="col-sm-12">
              <div class="form-group">
                <label>Name</label><span class="req">*</span>
                <input type="text" name="name" class="form-control" placeholder="Enter Shift Name" autocomplete="off" style="text-transform: uppercase;">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Shift Short Name</label><span class="req">*</span> <a href="#" data-toggle="tooltip" title="Short name to idenitfy shift, maximum 3 characters & it should be unique" data-placement="right"> <i class="fa fa-question-circle"></i></a>
                <input type="text" name="short_name" class="form-control" placeholder="Enter Shift Short Name" autocomplete="off" style="text-transform: uppercase">
              </div>
            </div>   
            <div class="col-sm-3">
              <div class="form-group">
                <label>Start Time</label><span class="req">*</span>
                <input type="text" name="start_time" class="form-control clockpicker" id="start_time" autocomplete="off" onchange="timeCalculating()" placeholder="00:00" value="00:00" readonly="">
              </div>
            </div> 
            <div class="col-sm-3">
              <div class="form-group">
                <label>Stop Time</label><span class="req">*</span>
                <input type="text" name="end_time" class="form-control clockpicker" id="end_time" autocomplete="off" onchange="timeCalculating()" placeholder="00:00" value="00:00" readonly="">
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="form-group">
                <label>Shift Duration in hrs</label><span class="req">*</span>
                <input type="text" name="shift_duration" class="form-control" readonly="" id="time_duration" value="00:00">
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="form-group">
                <label>Recess Duration in hrs</label>
                <input type="text" name="recess_duration" class="form-control clockpicker" autocomplete="off" placeholder="00:00" readonly="">
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="form-group">
                <label>Min hrs for Half Day</label><span class="req">*</span><a href="#" data-toggle="tooltip" title="Enter Minimum hours required for half day" data-placement="right"> <i class="fa fa-question-circle"></i></a>
                <input type="text" name="half_day_min_hrs" class="form-control clockpicker" autocomplete="off" placeholder="00:00" readonly="">
              </div>
            </div> 
            <div class="col-sm-12">
              <div class="form-group">
                <label>Min hrs for Full Day (excl Recess Duration)</label><span class="req">*</span><a href="#" data-toggle="tooltip" title="Enter Minimum hours required for full day" data-placement="right"> <i class="fa fa-question-circle"></i></a>
                <input type="text" name="full_day_min_hrs" class="form-control clockpicker" autocomplete="off" placeholder="00:00" readonly="">
              </div>
            </div> 
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="save_btn">Save</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--edit Modal-->
<div class="modal fade" id="editShiftModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Shift</h4>
      </div>
      <form id="editShift">
        <input type="hidden" name="id" id="shift_id">
        <div class="modal-body">
          <div class="row"> 
            <div class="col-sm-12">
              <div class="form-group">
                <label>Name</label><span class="req">*</span>
                <input type="text" name="name" class="form-control" placeholder="Enter Shift Name" autocomplete="off" id="editName" style="text-transform: uppercase;">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Shift Short Name</label><span class="req">*</span> <a href="#" data-toggle="tooltip" title="Short name to idenitfy shift, maximum 3 characters & it should be unique" data-placement="right"> <i class="fa fa-question-circle"></i></a>
                <input type="text" name="short_name" class="form-control" placeholder="Enter Shift Short Name" autocomplete="off" style="text-transform: uppercase" id="edit_short_name">
              </div>
            </div>   
            <div class="col-sm-3">
              <div class="form-group">
                <label>Start Time</label><span class="req">*</span>
                <input type="text" name="start_time" class="form-control clockpicker" id="edit_start_time" autocomplete="off" onchange="timeCalculatingEdit()" placeholder="00:00" readonly="">
              </div>
            </div> 
            <div class="col-sm-3">
              <div class="form-group">
                <label>Stop Time</label><span class="req">*</span>
                <input type="text" name="end_time" class="form-control clockpicker" id="edit_end_time" autocomplete="off" onchange="timeCalculatingEdit()" placeholder="00:00" readonly="">
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="form-group">
                <label>Shift Duration in hrs</label><span class="req">*</span>
                <input type="text" name="shift_duration" class="form-control" readonly="" id="edit_time_duration">
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="form-group">
                <label>Recess Duration in hrs</label>
                <input type="text" name="recess_duration" class="form-control clockpicker" autocomplete="off" placeholder="00:00" readonly="" id="edit_recess_duration">
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="form-group">
                <label>Min hrs for Half Day</label><span class="req">*</span><a href="#" data-toggle="tooltip" title="Enter Minimum hours required for half day" data-placement="right"> <i class="fa fa-question-circle"></i></a>
                <input type="text" name="half_day_min_hrs" class="form-control clockpicker" autocomplete="off" placeholder="00:00" readonly="" id="edit_half_day_min_hrs">
              </div>
            </div> 
            <div class="col-sm-12">
              <div class="form-group">
                <label>Min hrs for Full Day (excl Recess Duration)</label><span class="req">*</span><a href="#" data-toggle="tooltip" title="Enter Minimum hours required for full day" data-placement="right"> <i class="fa fa-question-circle"></i></a>
                <input type="text" name="full_day_min_hrs" class="form-control clockpicker" autocomplete="off" placeholder="00:00" readonly="" id="edit_full_day_min_hrs">
              </div>
            </div> 
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="update_btn">Update</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="loader"></div>
 <script type="text/javascript">
$('.loader').hide();

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


function addNewShift()
{
  $('#addNewShiftModal').modal({
    backdrop: 'static',
    keyboard: false
  });
}

function editShift(id)
{
  $('#shift_id').val(id);
  $.ajax({
      url: "<?php echo base_url('shift_master/shiftgroup/getSingleShift'); ?>",
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
        $('#editShiftModal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $('#editName').val(response.SHIFT_NAME);
        $('#edit_short_name').val(response.SHORT_NAME);
        $('#edit_start_time').val(response.START_TIME);
        $('#edit_end_time').val(response.STOP_TIME);
        $('#edit_time_duration').val(response.SHIFT_DURATION);
        $('#edit_recess_duration').val(response.RECESS_DURATION);
        $('#edit_half_day_min_hrs').val(response.MIN_HRS_HALF);
        $('#edit_full_day_min_hrs').val(response.MIN_HRS_FULL);
      }
    });
}

$('.timepicker').timepicker({
  useCurrent: false,
  defaultTime: '00:00',
  timeFormat: 'HH:mm:ss' 
});

//validation of new shift creation
$(document).ready(function () {
    $('#addNewShift').validate({ // initialize the plugin
        rules: {
            name: {
                required: true
            },
            short_name: {
                required: true,
                maxlength: 3
            },
            start_time:{
              required: true
            },
            end_time:{
              required: true
            },
            shift_duration:{
              required: true
            },
            half_day_min_hrs:{
              required: true
            },
            full_day_min_hrs:{
              required: true
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

//validating shift edit
//validation of new advance salary
$(document).ready(function () {
    $('#editShift').validate({ // initialize the plugin
        rules: {
            name: {
                required: true
            },
            short_name: {
                required: true,
                maxlength: 3
            },
            start_time:{
              required: true
            },
            end_time:{
              required: true
            },
            shift_duration:{
              required: true
            },
            half_day_min_hrs:{
              required: true
            },
            full_day_min_hrs:{
              required: true
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

//validation of regex
$.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "It accept digits and point only"
);

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

//creating new shift
 $("#save_btn").on("click", function(event){
  $("#addNewShift").validate();
  if ($('#addNewShift').valid())
  {
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('shift_master/shiftgroup/create'); ?>",
      type: "POST",
      data: $("#addNewShift").serialize(),
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.msg == 1)
        {
          $('#addNewShift')[0].reset();
          $('#addNewShiftModal').modal('hide');
          swal({title: "Shift Created Successfully", text: "Shift Created Successfully", type: "success"},
             function(){ 
                 location.reload();
             }
          );          
        }
        else
        {
          swal("Creation Failed !");
        }
      }
    });
   }
});

  $('.clockpicker').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
});

  function timeCalculating()
  {
    var time1 = $("#start_time").val();
    var time2 = $("#end_time").val();
    var time1 = time1.split(':');
    var time2 = time2.split(':');
    var hours1 = parseInt(time1[0], 10), 
    hours2 = parseInt(time2[0], 10),
    mins1 = parseInt(time1[1], 10),
    mins2 = parseInt(time2[1], 10);
    var hours = hours2 - hours1, mins = 0;
    if(hours < 0) hours = 24 + hours;
    if(mins2 >= mins1) {
        mins = mins2 - mins1;
    }
    else {
      mins = (mins2 + 60) - mins1;
      hours--;
    }
    if(mins < 9)
    {
      mins = '0'+mins;
    }
    if(hours < 9)
    {
      hours = '0'+hours;
    }
    $("#time_duration").val(hours+':'+mins);
  }

  //time calculating at edit time
  function timeCalculatingEdit()
  {
    var time1 = $("#edit_start_time").val();
    var time2 = $("#edit_end_time").val();
    var time1 = time1.split(':');
    var time2 = time2.split(':');
    var hours1 = parseInt(time1[0], 10), 
    hours2 = parseInt(time2[0], 10),
    mins1 = parseInt(time1[1], 10),
    mins2 = parseInt(time2[1], 10);
    var hours = hours2 - hours1, mins = 0;
    if(hours < 0) hours = 24 + hours;
    if(mins2 >= mins1) {
        mins = mins2 - mins1;
    }
    else {
      mins = (mins2 + 60) - mins1;
      hours--;
    }
    if(mins < 9)
    {
      mins = '0'+mins;
    }
    if(hours < 9)
    {
      hours = '0'+hours;
    }
    $("#edit_time_duration").val(hours+':'+mins);
  }

  //updating shift data
 $("#update_btn").on("click", function(event){
  $("#editShift").validate();
  if ($('#editShift').valid())
  {
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('shift_master/shiftgroup/update'); ?>",
      type: "POST",
      data: $("#editShift").serialize(),
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.msg == 1)
        {
          $('#editShift')[0].reset();
          $('#editShiftModal').modal('hide');
          swal({title: "Shift Updated Successfully", text: "Shift Updated Successfully", type: "success"},
             function(){ 
                 location.reload();
             }
          );          
        }
        else
        {
          swal({title: "Updation Failed", text: "Updation Failed", type: "error"});    
        }
      }
    });
   }
});
  </script>