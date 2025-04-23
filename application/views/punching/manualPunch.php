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
  z-index: 999;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@media print {
  .hide-print {
    display: none;
  }
}

  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }

.thead-color{
background: #337ab7 !important; color: white !important;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    font-size: 12px;
    padding: 5px;
    white-space: nowrap;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Daily Employee Attendance</li>
</ol>
<iframe src="<?php echo base_url('start_link_connect.aspx'); ?>" style="display: none;"></iframe>
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
                    <a href="#" class="btn btn-black" onclick="addManualPunch()"><i class="fa fa-plus"></i> Add Manual Punch</a>
                    
                    <hr>
                    <form method="post" action="<?php echo base_url('punching/manualpunch'); ?>">
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date</label><span class="req">*</span>
                            <input type="text" name="time_from" class="form-control datepicker" value="<?php echo set_value('time_from'); ?>" data-date-end-date="0d" autocomplete="off" required="">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label></label>
                            <button class="btn btn-success form-control" type="submit" name="search"><i class="fa fa-search"></i> Search</button>
                          </div>
                        </div>
                      </div><hr>
                    </form>
                    <center>
                    <a href="<?php echo base_url('punching/manualpunch/pdfReport/'.$date); ?>" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> View Report</a></center><br>
                    <div class="text-center">
                      <strong><u>Attendance report of <?php echo date('d-M-Y',strtotime($date)); ?></u></strong>
                    </div><br><br>
                    <div  id="printableArea">
                      <div style="font-size: 12px;">
                        <span style="font-weight: bold !important;margin-right: 20px !important;">Total No. of Emp. = <?php echo $total_emp; ?></span>
                        <span style="font-weight: bold !important;margin-right: 20px !important;color: green !important;"> Total Present =  <?php echo $total_pre; ?></span>
                        <span style="font-weight: bold !important;color: red !important;"> Total Absent =  <?php echo $total_emp - $total_pre; ?></span>

                        <label style="position: absolute;right: 0px;">
                          <label class="label label-danger">Late IN / Before OUT</label>
                          <label class="label label-warning">Before IN / After OUT</label>
                          <label class="label label-success">Right Time</label>
                        </label>
                      </div><hr>
                      <div class="table-responsive">
                        <table class="table table-bordered dataTable">
                          <thead style="background: #d2d6de;">
                            <tr>
                              <th class="thead-color">EMP ID</th>
                              <th class="thead-color">EMP Name</th>
                              <th class="thead-color">Shift Time</th>
                              <th class="thead-color">In Time</th>
                              <th class="thead-color">IN Status</th>
                              <th class="thead-color">Out Time</th>
                              <th class="thead-color">Out Status</th>
                              <th class="thead-color">Shift <br> Duration</th>
                              <th class="thead-color">Work <br> Duration (W.D)</th>
                              <th class="thead-color">Total W.D</th>
                              <th class="thead-color">Punch Type</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($attendanceList as $keys => $val) {
                              $tot_dur = "00:00:00";
                            foreach ($val as $key => $value) { ?>
                              <tr>
                                <td><?php echo $value['EMPID']; ?></td>
                                <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                                <td><?php echo $value['SHIFT_IN_TIME'].' - '.$value['SHIFT_OUT_TIME']; ?></td>
                                <td><?php echo date('H:i:s',strtotime($value['IN_TIME'])); ?></td>
                                <td><?php if($value['IN_CHECK_DIFFER'][0] == '-') { ?>

                                  <label class="label label-warning"><?php echo $value['IN_CHECK_DIFFER']; ?></label>

                               <?php } else if(strcmp($value['IN_CHECK_DIFFER'], "00:00:00") == 0) { ?>

                                  <label class="label label-success"><?php echo $value['IN_CHECK_DIFFER']; ?></label>

                               <?php } else if($value['IN_CHECK_DIFFER'] == '') { ?>

                                  <label></label>

                              <?php } else {  ?>

                                 <label class="label label-danger"><?php echo $value['IN_CHECK_DIFFER']; ?></label>

                               <?php } ?>
                              </td>
                              <td><?php echo date('H:i:s',strtotime($value['OUT_TIME'])); ?></td>
                                <td><?php if($value['OUT_CHECK_DIFFER'][0] == '-') { ?>

                                  <label class="label label-warning"><?php echo $value['OUT_CHECK_DIFFER']; ?></label>

                               <?php } else if(strcmp($value['OUT_CHECK_DIFFER'], "00:00:00") == 0) { ?>

                                  <label class="label label-success"><?php echo $value['OUT_CHECK_DIFFER']; ?></label>

                                <?php } else if($value['OUT_CHECK_DIFFER'] == '') { ?>

                                  <label></label>

                                <?php  } else { ?>

                                   <label class="label label-danger"><?php echo $value['OUT_CHECK_DIFFER']; ?></label>
                                <?php } ?></td>
                                 <td><?php echo $value['SHIFT_DURATION']; ?></td>
                                 <td><?php echo $value['TOTAL_DURATION']; ?></td>

                                 <td><?php 
                                  $tot_dur = $this->custom_lib->CalculateTime($value['TOTAL_DURATION'],$tot_dur);

                                 $shift_tot_dur = $this->sumit->getTimeDiff($value['SHIFT_DURATION'],$tot_dur);

                                 if($shift_tot_dur['time_diff'][0] == '-') { ?>

                                  <i data-toggle="tooltip" title="<?php echo $value['REMARKS'] ?>" data-placement="auto"><span  class="label label-warning"><?php echo $tot_dur; ?></span></i>

                               <?php } else if(strcmp($shift_tot_dur['time_diff'], "00:00:00") == 0) { ?>

                                  <i data-toggle="tooltip" title="<?php echo $value['REMARKS'] ?>" data-placement="auto"><span class="label label-success"><?php echo $tot_dur; ?></span></i>

                                <?php } else if($shift_tot_dur['time_diff'] == '') { ?>

                                  <label></label>

                                <?php  } else { ?>

                                  <i data-toggle="tooltip" title="<?php echo $value['REMARKS'] ?>" data-placement="auto"> <span class="label label-danger"><?php echo $tot_dur; ?></span></i>
                                <?php } ?></td>
                                <td><?php if($value['PUNCH_TYPE']==1){
                                  echo "Manual";
                                 }else{
                                  echo "Machine";
                                 } ?></td>
                              </tr>
                            <?php } } ?>

                          </tbody>
                        </table>   
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

<div class="modal fade" id="addManualPunchModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Manual Punching</h4>
      </div>
      <form id="addManualPunchForm" class="form-horizontal">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-sm-3">Designation:</label>
            <div class="col-sm-9">
              <select class="form-control" name="designation" id="designation" onchange="getEmployee()">
                <option value="">Select Designation</option>
                <?php foreach ($designation as $key => $value) { ?>
                  <option value="<?php echo $value['Sno']; ?>"><?php echo $value['DESIG']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">Employee:</label>
            <div class="col-sm-9">
              <select class="form-control select2" id="employee" name="employee" style="width: 100%;" onchange="clearTimeandDate()">
                
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">Time (in 24 hours) :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control clockpicker" id="in_time" name="time" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">Date :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control datepicker" id="in_date" name="date" data-date-end-date="0d" onchange="checkHoliday();checkMonthlyAttendanceGenerated();" autocomplete="off">
              <span class="date_msg" style="display: none;"><div class="alert alert-warning">Today is Holiday.</div></span>
              <div class="alert alert-danger warning_msg_div" style="display: none;"><span class="warning_msg"></span></div>
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
<br>
<div class="loader"></div>
 <script type="text/javascript">
$('.loader').hide();

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true,
      'pageLength'  : 50,
      aaSorting: [[0, 'asc']]
    })
  });

      //Flat red color scheme for iCheck
    $('input[type="radio"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });

     //Date picker
    $('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
      todayHighlight: true,
    });

     $('.clockpicker').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        
    });


function addManualPunch()
{
  $('#addManualPunchModal').modal({
    backdrop: 'static',
    keyboard: false
  });
}


//validation
$(document).ready(function () {
    $('#addManualPunchForm').validate({ // initialize the plugin
        rules: {
            designation: {
                required: true
            },
            employee:{
              required: true
            },
            date:{
              required: true,
            },
            time:{
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

function checkHoliday()
{
  var in_date = $('#in_date').val();
  $.ajax({
      url: '<?php echo base_url('punching/manualpunch/checkHolidayDate'); ?>',
      type: "POST",
      data: {in_date:in_date},
      dataType: 'json',
       beforeSend:function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function(response){
          $('.loader').hide();
          $('body').css('opacity', '1.0');
          var date = new Date(in_date);
          if(date.getDay() == 0)
          {
            $('.date_msg').show();
          }
          else
          {
            if(response.message == 1)
            {
              $('.date_msg').show();
            }
            else
            {
              $('.date_msg').hide();
            }
          }
      }
    });
}

// function checkLeaveApplied()
// {
//   var in_date = $('#in_date').val();
//   var emp_id = $('#employee').val();
//   $.ajax({
//       url: '<?php echo base_url('punching/manualpunch/checkLeaveApplied'); ?>',
//       type: "POST",
//       data: {in_date:in_date,emp_id:emp_id},
//       dataType: 'json',
//       beforeSend:function()
//       {
//         $('.loader').show();
//         $('body').css('opacity', '0.5');
//       },
//       success: function(response){
//           $('.loader').hide();
//           $('body').css('opacity', '1.0');
//           if(response.message == 1)
//           {
//             $('.warning_msg_div').show();
//             $('.warning_msg').html('He / She has been applied for Leave on this day.');
//             $('#save_btn').hide();
//           }
//           else
//           {
//             $('.warning_msg_div').hide();
//             $('#save_btn').show();
//           }
//       }
//     });
// }

//this function checks that monthly attendance generated for this date or this month or not if generated then punching not allowed
function checkMonthlyAttendanceGenerated()
{
  var in_date = $('#in_date').val();
  var emp_id = $('#employee').val();
  $.ajax({
      url: '<?php echo base_url('punching/manualpunch/checkMonthlyAttendanceGenerated'); ?>',
      type: "POST",
      data: {in_date:in_date,emp_id:emp_id},
      dataType: 'json',
      beforeSend:function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function(response){
          $('.loader').hide();
          $('body').css('opacity', '1.0');
          if(response.message == 1)
          {
            $('.warning_msg_div').show();
            $('.warning_msg').html('Monthly Attendance Generated That&rsquo;s why You are not able for manual punching');
            $('#save_btn').hide();
          }
          else
          {
            $('.warning_msg_div').hide();
            $('#save_btn').show();
          }
      }
    });
}

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

//creating new shift
 $("#save_btn").on("click", function(event){
  $("#addManualPunchForm").validate();
  if ($('#addManualPunchForm').valid())
  {
    var time_check = $('.time_check').val();
    var url = '<?php echo base_url('punching/manualpunch/create'); ?>';
    event.preventDefault();
     $.ajax({
      url: url,
      type: "POST",
      data: $("#addManualPunchForm").serialize(),
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.msg == 1 || response.msg == 3)
        {
          $('#addManualPunchForm')[0].reset();
          $('#addManualPunchModal').modal('hide');
          if(response.msg == 1)
          {
            swal({title: "Attendance Marked Successfully", text: "Attendance Marked Successfully", type: "success"},
               function(){ 
                   location.reload();
               }
            );  
          }
          else
          {
            swal({title: "Attendance Marked Successfully", text: "Attendance Marked Successfully", type: "success"},
               function(){ 
                   location.reload();
               }
            );   
          }

        }
        else
        {
          swal({title: "Creation Failed!", text: "Creation Failed!", type: "error"});
        }
      }
    });
   }
});

 function clearTimeandDate()
 {
  $('#in_date').val('');
  $('#in_time').val('');
 }

 function getEmployee()
 {
  var div_data = "<option value=''>Select Employee</option>";
  var designation = $('#designation').val();
  $.ajax({
      url: "<?php echo base_url('punching/manualpunch/getEmployee'); ?>",
      data: {designation:designation},
      type: "POST",
      dataType: 'json',
      beforeSend:function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function (result) {
        $('.loader').hide();
        $('body').css('opacity', '1.0');
           $.each(result, function (key, val) {
                div_data += "<option value='"+val.id+"'>"+val.EMPID+' ' + val.EMP_FNAME+' ' + val.EMP_MNAME +' '+val.EMP_LNAME +"</option>";
            });
           $('#employee').html(div_data);
      }
  });
 }

 $('.select2').select2();
  </script>
  <script type="text/javascript">
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>