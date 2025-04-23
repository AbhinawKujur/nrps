<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
  }
  .error{
    color: red;
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
.thead-color{
  background: #337ab7 !important; color: white !important;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
</style>
<?php $session_year = schoolData['School_Session']; 
  $year = explode('-', $session_year);
  $start_year = $year[0];
  $end_year = $year[1];
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">My Desk</a> <i class="fa fa-angle-right"></i> Apply Leave</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class="employee-dashboard">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){
                      echo $this->session->flashdata('msg');
                    } ?>
                    <a href="#" class="btn btn-black" onclick="addApplyLeave()"><i class="fa fa-plus"></i> Apply Leave</a>
                    
                    <hr>
                      <div class="table-responsive">
                        <table class="table table-bordered dataTable">
                          <thead style="background: #d2d6de;">
                            <tr>
                              <th class="thead-color">Apply Date</th>
                              <th class="thead-color">Leave Type</th>
                              <th class="thead-color">Date (From - To)</th>
                              <th class="thead-color">Day Type</th>
                              <th class="thead-color">Total Days</th>
                              <th class="thead-color">Leave Reason</th>
                              <th class="thead-color">Reason Details</th>
                              <th class="thead-color">Status</th>
                              <th class="thead-color">Document</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($leaveRequestList as $key => $value) { ?>
                              <tr>
                                <td><?php echo date('d-M-Y',strtotime($value['APPLY_DATE'])); ?></td>
                                <td><?php 
                                if($value['LEAVE_TYPE']!='')
                                {
                                  echo $leaveTypeList[$value['LEAVE_TYPE']];
                                } ?></td>
                                <td><?php echo date('d-M-Y',strtotime($value['DATE_FROM'])).' - ' .date('d-M-Y',strtotime($value['DATE_TO'])); ?></td>
                                <td><?php if($value['DAY_TYPE'] == 2){
                                  echo "Half Day";
                                }else{
                                  echo "Full Day";
                                } ?></td>
                                <td><?php echo $value['TOTAL_DAYS']*1; ?></td>
                                <td><?php echo $leaveReasonList[$value['REASON']]; ?></td>
                                <td><?php echo $value['REASON_DETAILS']; ?></td>
                                <td><?php if($value['STATUS'] == 0)
                                {
                                  echo "<label class='label label-warning'>Pending</label>";
                                }elseif($value['STATUS'] == 1)
                                {
                                  echo "<label class='label label-success'>Approved</label>";
                                }
                                else
                                {
                                  echo "<label class='label label-danger'>Disapproved</label>";
                                } ?></td>
                                <td><?php if($value['DOCUMENT'] != '')
                                {
                                  echo "<a href='".base_url($value['DOCUMENT'])."'>Your Document Here</a>";
                                } ?></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>   
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

<div class="modal fade" id="addApplyLeaveModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Apply Leave</h4>
      </div>
      <form id="addApplyLeaveForm" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Day Type</label><span class="req"> *</span>
                <select class="form-control" name="day_type" id="day_type" required="">
                  <option value="">Select Day Type</option>
                  <option value="1">Full Day</option>
                  <option value="2">Half Day</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Leave Reason </label><span class="req"> *</span>
                <select class="form-control" name="leave_reason" id="leave_reason" required="">
                  <option value="">Select Leave Reason</option>
                  <?php foreach ($leaveReasonList as $key => $value) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>From Date</label><span class="req"> *</span>
                <input type="text" class="form-control datepicker" name="from_date" id="from_date" autocomplete="off" required="" onchange="dateFromChange();" readonly="">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>To Date</label><span class="req"> *</span>
                <input type="text" class="form-control datepicker2" name="to_date"  id="to_date" autocomplete="off" required="" readonly="">
              </div>
            </div>
          </div>
          <div class="row" id="leave_reason_details">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Reason in Details</label><span class="req"> *</span>
                <textarea class="form-control" name="reason_details" required=""></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Document (If Available)</label>
                <input type="file" class="form-control" name="document" class="form-control" id="documents">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="save_btn" onclick="applyLeaveFormSubmit()"><i class="fa fa-paper-plane-o"></i> Send For Approval</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
 <script type="text/javascript">

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true,
    })
  });


     //Date picker
    $('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
      todayHighlight: true,
    });



function addApplyLeave()
{
  $('#addApplyLeaveModal').modal({
    backdrop: 'static',
    keyboard: false
  });
}

//validation
$(document).ready(function () {

    $('#addApplyLeaveForm').validate({ // initialize the plugin
        rules: {
            from_date: {
                remote: {
                url: '<?php echo base_url('leave/applyleave/checkEligibleForLeave'); ?>',
                type: "post",
                data: {
                  send_date: function() {
                    return $( "#from_date" ).val();
                  },
                  from_date: function() {
                    return $( "#from_date" ).val();
                  },
                  to_date: function() {
                    return $( "#from_date" ).val();
                  },
                }
              },
            },
            to_date: {
                remote: {
                url: '<?php echo base_url('leave/applyleave/checkEligibleForLeave'); ?>',
                type: "post",
                data: {
                  send_date: function() {
                    return $( "#to_date" ).val();
                  },
                  from_date: function() {
                    return $( "#to_date" ).val();
                  },
                  to_date: function() {
                    return $( "#to_date" ).val();
                  },
                }
              },
            },
            document:{
              extension: "jpeg|pdf|jpg|png",
            },
        },messages: {
          document:{
              extension:"Please upload .jpg or .png or .pdf file only.",
          }
        },

        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});


 $('.select2').select2();

 function showOtherReason()
 {
    var leave_reason = $('#leave_reason').val();
    if(leave_reason == 7)
    {
      $('#leave_reason_details').show(1000);
    }
    else
    {
      $('#leave_reason_details').hide(1000);
    }
 }

 function getTotalRestLeave()
 {
    var day_type = $('#day_type').val();
    if(day_type == '')
    {
      alert('Please Select Day Type');
      $('#leave_type').val('');
    }
    else
    {
      var leave_type = $('#leave_type').val();
      $('#save_btn').prop('disabled',false);
      $('.against_date_row').hide(1000);
      $('#leave_reason').val('');
      if(leave_type == 5)
      {
         $('#total_rest_leave_row').hide(1000);
         $('.against_date_row').show(1000);
         $('.mutlidatepicker').daterangepicker();
         $('#leave_reason').val(6);
      }
      else if(leave_type == 4)
      {
        $('#total_rest_leave_row').hide(1000);
         $('.mutlidatepicker').daterangepicker();
      }
      else
      {
        $.ajax({
            url: "<?php echo base_url('leave/applyleave/getTotalLeave'); ?>",
            data: {leave_type:leave_type},
            type: "POST",
            dataType: 'json',
            beforeSend:function()
            {
              showLoader();
            },
            success: function (result) {
              hideLoader();
              $('#total_rest_leave_row').show(1000);
              $('#total_rest_leave').val(result);
              if(result > 0)
              {
                 $('.mutlidatepicker').daterangepicker({
                  dateLimit: {
                        'days': Number(result)-1
                    }
                });
              }
              else
              {
                $('#formid').on('keyup keypress', function(e) {
                    var keyCode = e.keyCode || e.which;
                    if (keyCode === 13) { 
                      e.preventDefault();
                      return false;
                    }
                  });
                $('#save_btn').prop('disabled',true);
              }
            }
        });
      }
    }
 }

var st_date = '<?php echo $start_year.'-04-01'; ?>';
var end_dt = '<?php echo $end_year.'-'.'03-31'; ?>';
var startDate = new Date(st_date);
var endDate = new Date(end_dt);


$(".datepicker").datepicker({
 format: 'dd-M-yyyy',
    autoclose: true,
   startDate: startDate,
   endDate: endDate,
   orientation: "bottom",
});

dateFromChange();
function dateFromChange()
{
  var date_from = $('#from_date').val();
  $('#to_date').val(date_from);
  date_from = new Date(date_from);
  var day_type = $('#day_type').val();
  if(day_type==2)
  {
    endDate = date_from;
  }
  else
  {
    endDate = endDate;
  }
  $(".datepicker2").datepicker('destroy').datepicker({
   format: 'dd-M-yyyy',
      autoclose: true,
     startDate: date_from,
     endDate: endDate,
     orientation: "bottom",
  });
}


function applyLeaveFormSubmit()
{
  $('#addApplyLeaveForm').validate();
  if($('#addApplyLeaveForm').valid()==true)
  {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    $.ajax({
      url:"<?php echo base_url('leave/applyleave/checkEligibleForLeaveFormSubmit'); ?>",
      method:"post",
      dataType:"json",
      data:{from_date:from_date,to_date:to_date},
      beforeSend:function()
      {
        // showLoader();
      },
      success:function(response)
      { 
        // hideLoader();
        if(response==1)
        {
          $.toast({
              heading: 'Warning',
              text: 'You have already applied leave on this date. You are not able to reapply leave on this date.',
              showHideTransition: 'slide',
              icon: 'error',
              position: 'top-right',
          });
        }else if(response==2)
        {
          //leave saved in databasee from here
          var formval = $('#addApplyLeaveForm')[0];
          var form_data = new FormData(formval);  // Create a FormData object
          $.ajax({
            type:'POST',
            url: "<?= base_url('leave/applyleave/create'); ?>",
            data:form_data,
            cache:false,
            contentType: false,
            processData: false,
            success:function(res){
                if(res==1)
                {
                  $.toast({
                      heading: 'Success',
                      text: 'Leave applied succcessfully',
                      showHideTransition: 'slide',
                      icon: 'success',
                      position: 'top-right',
                  });
                  window.setTimeout(function(){location.reload()},3000);
                }
                else if(res == 2)
                {
                  $.toast({
                      heading: 'Error',
                      text: 'Failed !',
                      showHideTransition: 'slide',
                      icon: 'error',
                      position: 'top-right',
                  });
                }
            },
            error: function(res){
                alert(error);
            }
          });
        }
        else if(response==3)
        {
          $.toast({
              heading: 'Warning',
              text: 'Attendance generated as Present or Holiday. You are not able to apply leave on this date.',
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